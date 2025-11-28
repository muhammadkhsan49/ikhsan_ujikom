<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    /**
     * Export registrations to Excel
     */
    public function exportExcel(Request $request)
    {
        $status = $request->query('status', 'all');
        
        $query = Registration::query();
        
        if ($status !== 'all') {
            $query->where('status', $status);
        }
        
        $registrations = $query->get();
        
        return Excel::download(new \App\Exports\RegistrationsExport($registrations), 'pendaftar-' . date('Y-m-d') . '.xlsx');
    }

    /**
     * Export registrations to PDF
     */
    public function exportPdf(Request $request)
    {
        $status = $request->query('status', 'all');
        
        $query = Registration::query();
        
        if ($status !== 'all') {
            $query->where('status', $status);
        }
        
        $registrations = $query->get();
        
        $pdf = Pdf::loadView('admin.export.pdf', compact('registrations'));
        return $pdf->download('pendaftar-' . date('Y-m-d') . '.pdf');
    }
}
