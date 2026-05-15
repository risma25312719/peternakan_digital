@extends('layouts.mantis')

@section('content')
<div class="container-fluid px-4 py-3">
    <!-- Header -->
    <div class="mb-4">
        <h2 class="mb-1">Edit Catatan Kesehatan</h2>
        <p class="text-muted">Perbarui catatan kondisi ternak</p>
    </div>

    <!-- Error Alert -->
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Periksa kembali data berikut:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Form -->
    <div class="border rounded-3 bg-white p-4 shadow-sm">
        <form action="{{ route('kesehatan.update', $kesehatan->kesehatan_id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row g-3">
                <div class="col-12">
                    <label for="ternak_id" class="form-label fw-semibold">
                        Pilih Ternak <span class="text-danger">*</span>
                    </label>
                    <select name="ternak_id" id="ternak_id"
                            class="form-select @error('ternak_id') is-invalid @enderror">
                        <option value="">— Pilih Ternak —</option>
                        @foreach($ternak as $t)
                            <option value="{{ $t->ternak_id }}"
                                {{ old('ternak_id', $kesehatan->ternak_id) == $t->ternak_id ? 'selected' : '' }}>
                                {{ $t->kode_ternak }} — {{ ucfirst($t->jenis_hewan) }}
                            </option>
                        @endforeach
                    </select>
                    @error('ternak_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="tanggal" class="form-label fw-semibold">
                        Tanggal <span class="text-danger">*</span>
                    </label>
                    <input type="date" name="tanggal" id="tanggal"
                           value="{{ old('tanggal', $kesehatan->tanggal) }}"
                           class="form-control @error('tanggal') is-invalid @enderror">
                    @error('tanggal')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="kondisi" class="form-label fw-semibold">
                        Kondisi <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="kondisi" id="kondisi"
                           value="{{ old('kondisi', $kesehatan->kondisi) }}"
                           class="form-control @error('kondisi') is-invalid @enderror"
                           placeholder="contoh: sehat, sakit ringan, luka">
                    @error('kondisi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <label for="tindakan" class="form-label fw-semibold">Tindakan</label>
                    <textarea name="tindakan" id="tindakan" rows="3"
                              class="form-control @error('tindakan') is-invalid @enderror"
                              placeholder="contoh: pemberian antibiotik, vaksin PMK, pemeriksaan rutin...">{{ old('tindakan', $kesehatan->tindakan) }}</textarea>
                    @error('tindakan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-4 pt-2">
                <button type="button"
                        onclick="document.getElementById('form-hapus').submit()"
                        class="btn btn-danger">
                    Hapus Catatan
                </button>
                <div class="d-flex gap-2">
                    <a href="{{ route('kesehatan.index') }}" class="btn btn-light px-4">Batal</a>
                    <button type="submit" class="btn btn-primary px-4">Simpan Perubahan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Form delete terpisah -->
<form id="form-hapus" action="{{ route('kesehatan.destroy', $kesehatan->kesehatan_id) }}" method="POST" class="d-none">
    @csrf
    @method('DELETE')
</form>
@endsection