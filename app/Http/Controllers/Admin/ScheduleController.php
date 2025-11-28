<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SelectionSchedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Show all schedules
     */
    public function index()
    {
        $schedules = SelectionSchedule::latest()->paginate(10);
        
        return view('admin.schedule.index', compact('schedules'));
    }

    /**
     * Show create schedule form
     */
    public function create()
    {
        return view('admin.schedule.form');
    }

    /**
     * Store schedule
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'start_date' => 'required|date_format:Y-m-d H:i',
            'end_date' => 'required|date_format:Y-m-d H:i|after:start_date',
            'stage' => 'required|in:registrasi,tes_kesehatan,tes_fisik,tes_psikologi,wawancara,hasil_akhir',
            'location' => 'nullable|string|max:500',
            'quota' => 'nullable|integer|min:1',
        ]);

        SelectionSchedule::create($validated);

        return redirect('/admin/schedules')->with('success', 'Jadwal berhasil ditambahkan!');
    }

    /**
     * Show edit schedule form
     */
    public function edit(SelectionSchedule $schedule)
    {
        return view('admin.schedule.form', compact('schedule'));
    }

    /**
     * Update schedule
     */
    public function update(Request $request, SelectionSchedule $schedule)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'start_date' => 'required|date_format:Y-m-d H:i',
            'end_date' => 'required|date_format:Y-m-d H:i|after:start_date',
            'stage' => 'required|in:registrasi,tes_kesehatan,tes_fisik,tes_psikologi,wawancara,hasil_akhir',
            'location' => 'nullable|string|max:500',
            'quota' => 'nullable|integer|min:1',
        ]);

        $schedule->update($validated);

        return redirect('/admin/schedules')->with('success', 'Jadwal berhasil diperbarui!');
    }

    /**
     * Delete schedule
     */
    public function destroy(SelectionSchedule $schedule)
    {
        $schedule->delete();

        return back()->with('success', 'Jadwal berhasil dihapus!');
    }
}
