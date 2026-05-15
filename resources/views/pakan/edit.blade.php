@extends('layouts.mantis')

@section('content')
<div class="container-fluid px-4 py-3">
    <!-- Header -->
    <div class="mb-4">
        <h2 class="mb-1">Edit Data Pakan</h2>
        <p class="text-muted">Perbarui informasi pakan <strong>{{ $pakan->nama_pakan }}</strong></p>
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
        <form action="{{ route('pakan.update', $pakan->data_pakan_id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row g-3">
                <div class="col-12">
                    <label for="nama_pakan" class="form-label fw-semibold">
                        Nama Pakan <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="nama_pakan" id="nama_pakan"
                           value="{{ old('nama_pakan', $pakan->nama_pakan) }}"
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
                           value="{{ old('stok', $pakan->stok) }}"
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
                        <option value="kg" {{ old('satuan', $pakan->satuan) == 'kg' ? 'selected' : '' }}>kg</option>
                        <option value="liter" {{ old('satuan', $pakan->satuan) == 'liter' ? 'selected' : '' }}>liter</option>
                        <option value="karung" {{ old('satuan', $pakan->satuan) == 'karung' ? 'selected' : '' }}>karung</option>
                        <option value="ikat" {{ old('satuan', $pakan->satuan) == 'ikat' ? 'selected' : '' }}>ikat</option>
                        <option value="ton" {{ old('satuan', $pakan->satuan) == 'ton' ? 'selected' : '' }}>ton</option>
                    </select>
                    @error('satuan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-4 pt-2">
                <button type="button"
                        onclick="document.getElementById('form-hapus').submit()"
                        class="btn btn-danger">
                    Hapus Pakan
                </button>
                <div class="d-flex gap-2">
                    <a href="{{ route('pakan.index') }}" class="btn btn-light px-4">Batal</a>
                    <button type="submit" class="btn btn-primary px-4">Simpan Perubahan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Form delete terpisah -->
<form id="form-hapus" action="{{ route('pakan.destroy', $pakan->data_pakan_id) }}" method="POST" class="d-none">
    @csrf
    @method('DELETE')
</form>
@endsection