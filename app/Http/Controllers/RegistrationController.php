<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\Document;
use App\Models\SelectionSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class RegistrationController extends Controller
{
    /**
     * Show user dashboard
     */
    public function dashboard()
    {
        $user = Auth::user();
        $registrations = $user->registrations()->latest()->get();
        $activeSchedule = SelectionSchedule::where('stage', 'registrasi')->first();
        
        return view('user.dashboard', compact('registrations', 'activeSchedule'));
    }

    /**
     * Show registration form
     */
    public function create()
    {
        $registration = Auth::user()->registrations()->whereIn('status', ['draft'])->first() 
                        ?? new Registration();
        
        return view('user.registration.form', compact('registration'));
    }

    /**
     * Store registration
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'gender' => 'required|in:laki-laki,perempuan',
            'date_of_birth' => 'required|date',
            'place_of_birth' => 'required|string|max:255',
            'nik' => 'required|string|size:16|unique:registrations,nik,' . $request->registration_id,
            'phone_number' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'street_address' => 'required|string|max:500',
            'village' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'regency' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
            'education_level' => 'required|string',
            'school_name' => 'required|string|max:255',
            'major' => 'nullable|string|max:255',
            'graduation_year' => 'required|integer|min:1990|max:' . date('Y'),
            'height' => 'required|numeric|min:100|max:250',
            'weight' => 'required|numeric|min:30|max:200',
            'emergency_contact_name' => 'required|string|max:255',
            'emergency_contact_relationship' => 'required|string|max:255',
            'emergency_contact_phone' => 'required|string|max:20',
            'action' => 'required|in:save,submit',
        ]);

        $status = $validated['action'] === 'submit' ? 'submitted' : 'draft';
        
        $registration = Registration::updateOrCreate(
            ['id' => $request->registration_id ?? null, 'user_id' => Auth::id()],
            array_merge($validated, [
                'user_id' => Auth::id(),
                'status' => $status,
                'registration_number' => Registration::generateRegistrationNumber(),
            ])
        );

        if ($request->hasAny(['ktp', 'ijazah', 'foto_formal', 'surat_kesehatan'])) {
            $this->storeDocuments($request, $registration);
        }

        if ($status === 'submitted') {
            return redirect('/registration-history')->with('success', 'Formulir berhasil disubmit!');
        }

        return back()->with('success', 'Data berhasil disimpan sebagai draft.');
    }

    /**
     * Store documents
     */
    private function storeDocuments(Request $request, Registration $registration)
    {
        $documentTypes = ['ktp', 'ijazah', 'foto_formal', 'surat_kesehatan'];
        
        foreach ($documentTypes as $type) {
            if ($request->hasFile($type)) {
                $file = $request->file($type);
                $path = $file->store("registrations/{$registration->id}", 'public');
                
                Document::updateOrCreate(
                    ['registration_id' => $registration->id, 'document_type' => $type],
                    [
                        'file_path' => $path,
                        'original_filename' => $file->getClientOriginalName(),
                    ]
                );
            }
        }
    }

    /**
     * Show registration history
     */
    public function history()
    {
        $registrations = Auth::user()->registrations()->latest()->paginate(10);
        
        return view('user.registration.history', compact('registrations'));
    }

    /**
     * Show registration detail
     */
    public function show(Registration $registration)
    {
        $this->authorize('view', $registration);
        
        return view('user.registration.detail', compact('registration'));
    }

    /**
     * Print PDF
     */
    public function printPdf(Registration $registration)
    {
        $this->authorize('view', $registration);
        
        $pdf = Pdf::loadView('user.registration.pdf', compact('registration'));
        return $pdf->download('bukti-pendaftaran-' . $registration->registration_number . '.pdf');
    }

    /**
     * Edit registration
     */
    public function edit(Registration $registration)
    {
        $this->authorize('update', $registration);
        
        if (!in_array($registration->status, ['draft', 'rejected'])) {
            return back()->with('error', 'Anda tidak dapat mengubah registrasi ini.');
        }
        
        return view('user.registration.form', compact('registration'));
    }

    /**
     * Delete registration
     */
    public function destroy(Registration $registration)
    {
        $this->authorize('delete', $registration);
        
        if ($registration->status !== 'draft') {
            return back()->with('error', 'Hanya registrasi draft yang dapat dihapus.');
        }
        
        // Delete documents
        foreach ($registration->documents as $document) {
            Storage::disk('public')->delete($document->file_path);
            $document->delete();
        }
        
        $registration->delete();
        
        return redirect('/registration-history')->with('success', 'Registrasi berhasil dihapus.');
    }
}
