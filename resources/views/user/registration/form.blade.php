@extends('layouts.app')

@section('title', '{{ isset($registration->id) ? "Edit" : "Buat" }} Formulir Pendaftaran')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4">
                <i class="bi bi-pencil"></i>
                {{ isset($registration->id) ? 'Edit Formulir Pendaftaran' : 'Formulir Pendaftaran Brimob' }}
            </h2>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <form action="{{ isset($registration->id) ? route('registration.store') : route('registration.store') }}" 
                  method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="registration_id" value="{{ isset($registration->id) ? $registration->id : '' }}">

                <!-- Data Diri -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bi bi-person"></i> Data Diri</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Lengkap *</label>
                                <input type="text" name="full_name" class="form-control @error('full_name') is-invalid @enderror"
                                       value="{{ old('full_name', $registration->full_name ?? '') }}" required>
                                @error('full_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Jenis Kelamin *</label>
                                <select name="gender" class="form-select @error('gender') is-invalid @enderror" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="laki-laki" {{ old('gender', $registration->gender ?? '') === 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="perempuan" {{ old('gender', $registration->gender ?? '') === 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('gender') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tempat Lahir *</label>
                                <input type="text" name="place_of_birth" class="form-control @error('place_of_birth') is-invalid @enderror"
                                       value="{{ old('place_of_birth', $registration->place_of_birth ?? '') }}" required>
                                @error('place_of_birth') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanggal Lahir *</label>
                                <input type="date" name="date_of_birth" class="form-control @error('date_of_birth') is-invalid @enderror"
                                       value="{{ old('date_of_birth', $registration->date_of_birth ?? '') }}" required>
                                @error('date_of_birth') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">NIK *</label>
                                <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror"
                                       value="{{ old('nik', $registration->nik ?? '') }}" maxlength="16" required>
                                @error('nik') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">No. Telepon *</label>
                                <input type="tel" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror"
                                       value="{{ old('phone_number', $registration->phone_number ?? '') }}" required>
                                @error('phone_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email *</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email', $registration->email ?? '') }}" required>
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                <!-- Alamat -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bi bi-geo-alt"></i> Alamat</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Alamat Jalan *</label>
                            <textarea name="street_address" class="form-control @error('street_address') is-invalid @enderror" rows="2" required>{{ old('street_address', $registration->street_address ?? '') }}</textarea>
                            @error('street_address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Desa/Kelurahan *</label>
                                <input type="text" name="village" class="form-control @error('village') is-invalid @enderror"
                                       value="{{ old('village', $registration->village ?? '') }}" required>
                                @error('village') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kecamatan *</label>
                                <input type="text" name="district" class="form-control @error('district') is-invalid @enderror"
                                       value="{{ old('district', $registration->district ?? '') }}" required>
                                @error('district') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kabupaten/Kota *</label>
                                <input type="text" name="regency" class="form-control @error('regency') is-invalid @enderror"
                                       value="{{ old('regency', $registration->regency ?? '') }}" required>
                                @error('regency') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Provinsi *</label>
                                <input type="text" name="province" class="form-control @error('province') is-invalid @enderror"
                                       value="{{ old('province', $registration->province ?? '') }}" required>
                                @error('province') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kode Pos *</label>
                            <input type="text" name="postal_code" class="form-control @error('postal_code') is-invalid @enderror"
                                   value="{{ old('postal_code', $registration->postal_code ?? '') }}" required>
                            @error('postal_code') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                <!-- Pendidikan -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bi bi-book"></i> Pendidikan</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tingkat Pendidikan *</label>
                                <select name="education_level" class="form-select @error('education_level') is-invalid @enderror" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="SMP" {{ old('education_level', $registration->education_level ?? '') === 'SMP' ? 'selected' : '' }}>SMP</option>
                                    <option value="SMA/SMK" {{ old('education_level', $registration->education_level ?? '') === 'SMA/SMK' ? 'selected' : '' }}>SMA/SMK</option>
                                    <option value="D1" {{ old('education_level', $registration->education_level ?? '') === 'D1' ? 'selected' : '' }}>D1</option>
                                    <option value="D2" {{ old('education_level', $registration->education_level ?? '') === 'D2' ? 'selected' : '' }}>D2</option>
                                    <option value="D3" {{ old('education_level', $registration->education_level ?? '') === 'D3' ? 'selected' : '' }}>D3</option>
                                    <option value="S1" {{ old('education_level', $registration->education_level ?? '') === 'S1' ? 'selected' : '' }}>S1</option>
                                    <option value="S2" {{ old('education_level', $registration->education_level ?? '') === 'S2' ? 'selected' : '' }}>S2</option>
                                </select>
                                @error('education_level') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tahun Lulus *</label>
                                <input type="number" name="graduation_year" class="form-control @error('graduation_year') is-invalid @enderror"
                                       value="{{ old('graduation_year', $registration->graduation_year ?? '') }}" min="1990" max="{{ date('Y') }}" required>
                                @error('graduation_year') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Sekolah/Universitas *</label>
                                <input type="text" name="school_name" class="form-control @error('school_name') is-invalid @enderror"
                                       value="{{ old('school_name', $registration->school_name ?? '') }}" required>
                                @error('school_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Jurusan/Program Studi</label>
                                <input type="text" name="major" class="form-control @error('major') is-invalid @enderror"
                                       value="{{ old('major', $registration->major ?? '') }}">
                                @error('major') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Fisik -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bi bi-person-check"></i> Data Fisik</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tinggi Badan (cm) *</label>
                                <input type="number" name="height" class="form-control @error('height') is-invalid @enderror"
                                       value="{{ old('height', $registration->height ?? '') }}" step="0.01" required>
                                @error('height') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Berat Badan (kg) *</label>
                                <input type="number" name="weight" class="form-control @error('weight') is-invalid @enderror"
                                       value="{{ old('weight', $registration->weight ?? '') }}" step="0.01" required>
                                @error('weight') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kontak Darurat -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bi bi-telephone"></i> Kontak Darurat</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Nama Kontak *</label>
                            <input type="text" name="emergency_contact_name" class="form-control @error('emergency_contact_name') is-invalid @enderror"
                                   value="{{ old('emergency_contact_name', $registration->emergency_contact_name ?? '') }}" required>
                            @error('emergency_contact_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Hubungan *</label>
                                <input type="text" name="emergency_contact_relationship" class="form-control @error('emergency_contact_relationship') is-invalid @enderror"
                                       value="{{ old('emergency_contact_relationship', $registration->emergency_contact_relationship ?? '') }}" required>
                                @error('emergency_contact_relationship') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">No. Telepon *</label>
                                <input type="tel" name="emergency_contact_phone" class="form-control @error('emergency_contact_phone') is-invalid @enderror"
                                       value="{{ old('emergency_contact_phone', $registration->emergency_contact_phone ?? '') }}" required>
                                @error('emergency_contact_phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Dokumen -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bi bi-file-pdf"></i> Dokumen</h5>
                    </div>
                    <div class="card-body">
                        <p class="text-muted small">Format: JPG, PNG, PDF | Ukuran maksimal: 5MB</p>

                        <div class="mb-3">
                            <label class="form-label">KTP</label>
                            <input type="file" name="ktp" class="form-control @error('ktp') is-invalid @enderror"
                                   accept=".jpg,.jpeg,.png,.pdf">
                            @if (isset($registration->id) && $registration->documents->where('document_type', 'ktp')->first())
                                <small class="text-muted d-block mt-2">
                                    <i class="bi bi-check-circle text-success"></i> File sudah terupload
                                </small>
                            @endif
                            @error('ktp') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ijazah</label>
                            <input type="file" name="ijazah" class="form-control @error('ijazah') is-invalid @enderror"
                                   accept=".jpg,.jpeg,.png,.pdf">
                            @if (isset($registration->id) && $registration->documents->where('document_type', 'ijazah')->first())
                                <small class="text-muted d-block mt-2">
                                    <i class="bi bi-check-circle text-success"></i> File sudah terupload
                                </small>
                            @endif
                            @error('ijazah') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Foto Formal 4x6 (PNG/JPG)</label>
                            <input type="file" name="foto_formal" class="form-control @error('foto_formal') is-invalid @enderror"
                                   accept=".jpg,.jpeg,.png">
                            @if (isset($registration->id) && $registration->documents->where('document_type', 'foto_formal')->first())
                                <small class="text-muted d-block mt-2">
                                    <i class="bi bi-check-circle text-success"></i> File sudah terupload
                                </small>
                            @endif
                            @error('foto_formal') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Surat Kesehatan</label>
                            <input type="file" name="surat_kesehatan" class="form-control @error('surat_kesehatan') is-invalid @enderror"
                                   accept=".jpg,.jpeg,.png,.pdf">
                            @if (isset($registration->id) && $registration->documents->where('document_type', 'surat_kesehatan')->first())
                                <small class="text-muted d-block mt-2">
                                    <i class="bi bi-check-circle text-success"></i> File sudah terupload
                                </small>
                            @endif
                            @error('surat_kesehatan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                <!-- Tombol Submit -->
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <button type="submit" name="action" value="save" class="btn btn-secondary w-100">
                                    <i class="bi bi-floppy"></i> Simpan sebagai Draft
                                </button>
                            </div>
                            <div class="col-md-6 mb-2">
                                <button type="submit" name="action" value="submit" class="btn btn-primary w-100">
                                    <i class="bi bi-check-circle"></i> Kirim Formulir
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <a href="{{ route('registration.history') }}" class="btn btn-outline-secondary w-100">
                                    <i class="bi bi-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-lg-4">
            <div class="card sticky-top" style="top: 20px;">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bi bi-info-circle"></i> Panduan</h5>
                </div>
                <div class="card-body">
                    <h6>Cara Mengisi Formulir:</h6>
                    <ol class="small">
                        <li>Isi semua data diri dengan lengkap dan akurat</li>
                        <li>Pastikan alamat sesuai dengan KTP</li>
                        <li>Masukkan tinggi dan berat badan dalam satuan cm dan kg</li>
                        <li>Siapkan dokumen yang diperlukan sebelum submit</li>
                        <li>Klik "Kirim Formulir" untuk submit pendaftaran</li>
                        <li>Anda akan menerima notifikasi setelah admin memverifikasi</li>
                    </ol>
                    <hr>
                    <h6>Persyaratan Dokumen:</h6>
                    <ul class="small mb-0">
                        <li>KTP: Fotokopi jelas</li>
                        <li>Ijazah: Fotokopi asli</li>
                        <li>Foto: 4x6 formal, latar belakang merah/biru</li>
                        <li>Surat Kesehatan: Dari klinik resmi</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
