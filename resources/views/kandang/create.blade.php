@extends('layouts.mantis')

@section('content')

<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('kandang.index') }}">Kandang</a></li>
                    <li class="breadcrumb-item active">Tambah Kandang</li>
                </ul>
            </div>
            <div class="col-md-12">
                <div class="page-header-title">
                    <h2 class="mb-sm-0">Tambah Kandang Baru</h2>
                    <p class="text-muted mb-0">Isi data kandang untuk didaftarkan ke sistem</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-md-8">

        @if($errors->any())
            <div class="alert alert-danger">
                <strong>Periksa kembali data berikut:</strong>
                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <form action="{{ route('kandang.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="nama_kandang" class="form-label">
                            Nama Kandang <span class="text-danger">*</span>
                        </label>
                        <input id="nama_kandang" name="nama_kandang" type="text"
                               value="{{ old('nama_kandang') }}"
                               placeholder="contoh: Kandang A"
                               class="form-control @error('nama_kandang') is-invalid @enderror">
                        @error('nama_kandang')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="kapasitas" class="form-label">
                                Kapasitas <span class="text-danger">*</span>
                            </label>
                            <input id="kapasitas" name="kapasitas" type="number" min="1"
                                   value="{{ old('kapasitas') }}"
                                   placeholder="contoh: 50"
                                   class="form-control @error('kapasitas') is-invalid @enderror">
                            @error('kapasitas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="lokasi" class="form-label">Lokasi</label>
                            <input id="lokasi" name="lokasi" type="text"
                                   value="{{ old('lokasi') }}"
                                   placeholder="contoh: Blok Utara"
                                   class="form-control @error('lokasi') is-invalid @enderror">
                            @error('lokasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-2">
                        <a href="{{ route('kandang.index') }}" class="btn btn-light">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan Kandang</button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>

@endsection