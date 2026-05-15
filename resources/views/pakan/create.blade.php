@extends('layouts.mantis')

@section('content')
<div class="container-fluid px-4 py-3">
    <!-- Header -->
    <div class="mb-4">
        <h2 class="mb-1">Tambah Pakan Baru</h2>
        <p class="text-muted">Isi data pakan untuk didaftarkan ke sistem</p>
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
        <form action="{{ route('pakan.store') }}" method="POST">
            @csrf

            <div class="row g-3">
                <div class="col-12">
                    <label for="nama_pakan" class="form-label fw-semibold">
                        Nama Pakan <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="nama_pakan" id="nama_pakan"
                           value="{{ old('nama_pakan') }}"
                           class="form-control @error('nama_pakan') is-invalid @enderror"
                           placeholder="contoh: Rumput Gajah">
                    @error('nama_pakan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="stok" class="form-label fw-semibold">
                        Stok <span class="text-danger">*</span>
                    </label>
                    <input type="number" name="stok" id="stok" step="0.01" min="0"
                           value="{{ old('stok') }}"
                           class="form-control @error('stok') is-invalid @enderror"
                           placeholder="contoh: 100">
                    @error('stok')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="satuan" class="form-label fw-semibold">
                        Satuan <span class="text-danger">*</span>
                    </label>
                    <select name="satuan" id="satuan"
                            class="form-select @error('satuan') is-invalid @enderror">
                        <option value="">— Pilih Satuan —</option>
                        <option value="kg" {{ old('satuan') == 'kg' ? 'selected' : '' }}>kg</option>
                        <option value="liter" {{ old('satuan') == 'liter' ? 'selected' : '' }}>liter</option>
                        <option value="karung" {{ old('satuan') == 'karung' ? 'selected' : '' }}>karung</option>
                        <option value="ikat" {{ old('satuan') == 'ikat' ? 'selected' : '' }}>ikat</option>
                        <option value="ton" {{ old('satuan') == 'ton' ? 'selected' : '' }}>ton</option>
                    </select>
                    @error('satuan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2 mt-4 pt-2">
                <a href="{{ route('pakan.index') }}" class="btn btn-light px-4">Batal</a>
                <button type="submit" class="btn btn-primary px-4">Simpan Pakan</button>
            </div>
        </form>
    </div>
</div>
@endsection