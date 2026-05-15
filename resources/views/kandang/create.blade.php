@extends('layouts.mantis')

@section('content')
<div class="container-fluid px-4 py-3">
    <div class="mb-4">
        <h2>Tambah Kandang Baru</h2>
        <p class="text-muted">Masukkan detail data kandang peternakan</p>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('kandang.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Nama Kandang</label>
                    <input type="text" name="nama_kandang" class="form-control @error('nama_kandang') is-invalid @enderror" value="{{ old('nama_kandang') }}" required>
                    @error('nama_kandang') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Kapasitas</label>
                    <input type="number" name="kapasitas" class="form-control @error('kapasitas') is-invalid @enderror" value="{{ old('kapasitas') }}" required>
                    @error('kapasitas') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Lokasi (Opsional)</label>
                    <input type="text" name="lokasi" class="form-control @error('lokasi') is-invalid @enderror" value="{{ old('lokasi') }}">
                    @error('lokasi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-success">Simpan Kandang</button>
                    <a href="{{ route('kandang.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection