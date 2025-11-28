<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerificationController extends Controller
{
    /**
     * Show all registrations for verification
     */
    public function index()
    {
        $status = request('status', 'all');
        
        $query = Registration::latest();
        
        if ($status !== 'all') {
            $query->where('status', $status);
        }
        
        $registrations = $query->paginate(15);
        
        return view('admin.verification.index', compact('registrations', 'status'));
    }

    /**
     * Show registration detail for verification
     */
    public function show(Registration $registration)
    {
        return view('admin.verification.detail', compact('registration'));
    }

    /**
     * Verify registration
     */
    public function verify(Request $request, Registration $registration)
    {
        $validated = $request->validate([
            'verification_notes' => 'nullable|string|max:1000',
        ]);

        $registration->update([
            'status' => 'verified',
            'verified_by' => Auth::user()->name,
            'verified_at' => now(),
            'verification_notes' => $validated['verification_notes'],
        ]);

        // Send notification to user
        Notification::create([
            'user_id' => $registration->user_id,
            'registration_id' => $registration->id,
            'title' => 'Pendaftaran Terverifikasi',
            'message' => 'Pendaftaran Anda telah berhasil diverifikasi oleh admin.',
            'type' => 'success',
        ]);

        return back()->with('success', 'Registrasi berhasil diverifikasi!');
    }

    /**
     * Reject registration
     */
    public function reject(Request $request, Registration $registration)
    {
        $validated = $request->validate([
            'rejection_reason' => 'required|string|max:1000',
        ]);

        $registration->update([
            'status' => 'rejected',
            'rejection_reason' => $validated['rejection_reason'],
        ]);

        // Send notification to user
        Notification::create([
            'user_id' => $registration->user_id,
            'registration_id' => $registration->id,
            'title' => 'Pendaftaran Ditolak',
            'message' => 'Pendaftaran Anda ditolak. Alasan: ' . $validated['rejection_reason'],
            'type' => 'error',
        ]);

        return back()->with('success', 'Registrasi berhasil ditolak!');
    }
}
