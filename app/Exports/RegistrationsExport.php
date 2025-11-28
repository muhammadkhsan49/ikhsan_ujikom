<?php

namespace App\Exports;

use App\Models\Registration;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class RegistrationsExport implements FromCollection, WithHeadings, WithMapping
{
    protected $registrations;

    public function __construct($registrations)
    {
        $this->registrations = $registrations;
    }

    public function collection()
    {
        return $this->registrations;
    }

    public function headings(): array
    {
        return [
            'Nomor Pendaftaran',
            'Nama Lengkap',
            'Email',
            'NIK',
            'No. Telepon',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Pendidikan',
            'Asal Sekolah/Universitas',
            'Tinggi Badan (cm)',
            'Berat Badan (kg)',
            'Alamat',
            'Status',
            'Tanggal Verifikasi',
            'Diverifikasi Oleh',
        ];
    }

    public function map($registration): array
    {
        return [
            $registration->registration_number,
            $registration->full_name,
            $registration->email,
            $registration->nik,
            $registration->phone_number,
            $registration->place_of_birth,
            $registration->date_of_birth->format('d-m-Y'),
            $registration->education_level,
            $registration->school_name,
            $registration->height,
            $registration->weight,
            $registration->street_address . ', ' . $registration->village . ', ' . $registration->district . ', ' . $registration->regency . ', ' . $registration->province,
            ucfirst($registration->status),
            $registration->verified_at ? $registration->verified_at->format('d-m-Y H:i') : '-',
            $registration->verified_by ?? '-',
        ];
    }
}
