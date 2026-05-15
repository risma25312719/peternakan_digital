@extends('layouts.mantis')

@section('content')
<div class="container-fluid px-4 py-3">
    {{-- Header --}}
    <div class="mb-4">
        <h2 class="mb-1">Edit Kandang</h2>
        <p class="text-muted">Perbarui informasi kandang <strong>{{ $kandang->nama_kandang }}</strong></p>
    </div>

    {{-- Error Alert --}}
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

    {{-- Form --}}
    <div class="border rounded-3 bg-white p-4 shadow-sm">
        <form action="{{ route('kandang.update', $kandang->kandang_id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row g-3">
                <div class="col-md-6">
                    <label for="nama_kandang" class="form-label fw-semibold">
                        Nama Kandang <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="nama_kandang" id="nama_kandang"
                           value="{{ old('nama_kandang', $kandang->nama_kandang) }}"
                           class="form-control @error('nama_kandang') is-invalid @enderror"
                           placeholder="contoh: Kandang A">
                    @error('nama_kandang')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="kapasitas" class="form-label fw-semibold">
                        Kapasitas <span class="text-danger">*</span>
                    </label>
                    <input type="number" name="kapasitas" id="kapasitas" min="1"
                           value="{{ old('kapasitas', $kandang->kapasitas) }}"
                           class="form-control @error('kapasitas') is-invalid @enderror"
                           placeholder="contoh: 50">
                    @error('kapasitas')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <label for="lokasi" class="form-label fw-semibold">Lokasi</label>
                    <input type="text" name="lokasi" id="lokasi"
                           value="{{ old('lokasi', $kandang->lokasi) }}"
                           class="form-control @error('lokasi') is-invalid @enderror"
                           placeholder="contoh: Blok Utara">
                    @error('lokasi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-4 pt-2">
                <button type="button"
                        onclick="document.getElementById('form-hapus').submit()"
                        class="btn btn-danger">
                    Hapus Kandang
                </button>
                <div class="d-flex gap-2">
                    <a href="{{ route('kandang.index') }}" class="btn btn-light px-4">Batal</a>
                    <button type="submit" class="btn btn-primary px-4">Simpan Perubahan</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Form delete terpisah --}}
<form id="form-hapus" action="{{ route('kandang.destroy', $kandang->kandang_id) }}" method="POST" class="d-none">
    @csrf
    @method('DELETE')
</form>
@endsection