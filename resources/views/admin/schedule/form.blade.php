@extends('layouts.app')

@section('title', (isset($schedule) ? 'Edit' : 'Buat') . ' Jadwal Seleksi')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h2 class="mb-4">
                {{ isset($schedule) ? 'Edit Jadwal Seleksi' : 'Buat Jadwal Seleksi Baru' }}
            </h2>

            <div class="card">
                <div class="card-body">
                    <form action="{{ isset($schedule) ? route('admin.schedules.update', $schedule) : route('admin.schedules.store') }}" 
                          method="POST">
                        @csrf
                        @if (isset($schedule))
                            @method('PUT')
                        @endif

                        <div class="mb-3">
                            <label class="form-label">Judul *</label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                   value="{{ old('title', $schedule->title ?? '') }}" required>
                            @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3">{{ old('description', $schedule->description ?? '') }}</textarea>
                            @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tahap *</label>
                                <select name="stage" class="form-select @error('stage') is-invalid @enderror" required>
                                    <option value="">-- Pilih Tahap --</option>
                                    <option value="registrasi" {{ (old('stage') ?? $schedule->stage ?? '') === 'registrasi' ? 'selected' : '' }}>Pendaftaran</option>
                                    <option value="tes_kesehatan" {{ (old('stage') ?? $schedule->stage ?? '') === 'tes_kesehatan' ? 'selected' : '' }}>Tes Kesehatan</option>
                                    <option value="tes_fisik" {{ (old('stage') ?? $schedule->stage ?? '') === 'tes_fisik' ? 'selected' : '' }}>Tes Fisik</option>
                                    <option value="tes_psikologi" {{ (old('stage') ?? $schedule->stage ?? '') === 'tes_psikologi' ? 'selected' : '' }}>Tes Psikologi</option>
                                    <option value="wawancara" {{ (old('stage') ?? $schedule->stage ?? '') === 'wawancara' ? 'selected' : '' }}>Wawancara</option>
                                    <option value="hasil_akhir" {{ (old('stage') ?? $schedule->stage ?? '') === 'hasil_akhir' ? 'selected' : '' }}>Hasil Akhir</option>
                                </select>
                                @error('stage') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kuota (Opsional)</label>
                                <input type="number" name="quota" class="form-control @error('quota') is-invalid @enderror"
                                       value="{{ old('quota', $schedule->quota ?? '') }}" min="1">
                                @error('quota') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanggal Mulai *</label>
                                <input type="datetime-local" name="start_date" class="form-control @error('start_date') is-invalid @enderror"
                                       value="{{ old('start_date', $schedule->start_date ? $schedule->start_date->format('Y-m-d\TH:i') : '') }}" required>
                                @error('start_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanggal Selesai *</label>
                                <input type="datetime-local" name="end_date" class="form-control @error('end_date') is-invalid @enderror"
                                       value="{{ old('end_date', $schedule->end_date ? $schedule->end_date->format('Y-m-d\TH:i') : '') }}" required>
                                @error('end_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Lokasi</label>
                            <textarea name="location" class="form-control @error('location') is-invalid @enderror" rows="2">{{ old('location', $schedule->location ?? '') }}</textarea>
                            @error('location') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle"></i> {{ isset($schedule) ? 'Perbarui' : 'Buat' }}
                            </button>
                            <a href="/admin/schedules" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
