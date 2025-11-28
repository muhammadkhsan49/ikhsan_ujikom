<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SelectionSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'stage',
        'location',
        'quota',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    /**
     * Get stage label
     */
    public function getStageLabel()
    {
        return match($this->stage) {
            'registrasi' => 'Pendaftaran',
            'tes_kesehatan' => 'Tes Kesehatan',
            'tes_fisik' => 'Tes Fisik',
            'tes_psikologi' => 'Tes Psikologi',
            'wawancara' => 'Wawancara',
            'hasil_akhir' => 'Hasil Akhir',
            default => 'Tahap Seleksi',
        };
    }

    /**
     * Check if schedule is active
     */
    public function isActive()
    {
        $now = now();
        return $now->between($this->start_date, $this->end_date);
    }
}
