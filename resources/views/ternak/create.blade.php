@extends('layouts.mantis')

@section('content')
<div class="container-fluid px-4 py-3">
    <!-- Header -->
    <div class="mb-4">
        <h2 class="mb-1">Tambah Ternak Baru</h2>
        <p class="text-muted">Isi data ternak untuk didaftarkan ke sistem</p>
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
        <form action="{{ route('ternak.store') }}" method="POST">
            @csrf

            <div class="row g-3">
                <div class="col-md-6">
                    <label for="kode_ternak" class="form-label fw-semibold">
                        Kode Ternak <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="kode_ternak" id="kode_ternak"
                           value="{{ old('kode_ternak') }}"
                           class="form-control @error('kode_ternak') is-invalid @enderror"
                           placeholder="Contoh: TRN-001">
                    @error('kode_ternak')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="jenis_hewan" class="form-label fw-semibold">
                        Jenis Hewan <span class="text-danger">*</span>
                    </label>
                    <select name="jenis_hewan" id="jenis_hewan"
                            class="form-select @error('jenis_hewan') is-invalid @enderror">
                        <option value="">Pilih jenis hewan</option>
                        <option value="sapi" {{ old('jenis_hewan') == 'sapi' ? 'selected' : '' }}>Sapi</option>
                        <option value="kambing" {{ old('jenis_hewan') == 'kambing' ? 'selected' : '' }}>Kambing</option>
                        <option value="ayam" {{ old('jenis_hewan') == 'ayam' ? 'selected' : '' }}>Ayam</option>
                    </select>
                    @error('jenis_hewan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="jenis_kelamin" class="form-label fw-semibold">
                        Jenis Kelamin <span class="text-danger">*</span>
                    </label>
                    <select name="jenis_kelamin" id="jenis_kelamin"
                            class="form-select @error('jenis_kelamin') is-invalid @enderror">
                        <option value="">Pilih jenis kelamin</option>
                        <option value="jantan" {{ old('jenis_kelamin') == 'jantan' ? 'selected' : '' }}>Jantan</option>
                        <option value="betina" {{ old('jenis_kelamin') == 'betina' ? 'selected' : '' }}>Betina</option>
                    </select>
                    @error('jenis_kelamin')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="tanggal_masuk" class="form-label fw-semibold">
                        Tanggal Masuk <span class="text-danger">*</span>
                    </label>
                    <input type="date" name="tanggal_masuk" id="tanggal_masuk"
                           value="{{ old('tanggal_masuk') }}"
                           class="form-control @error('tanggal_masuk') is-invalid @enderror">
                    @error('tanggal_masuk')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="status" class="form-label fw-semibold">
                        Status <span class="text-danger">*</span>
                    </label>
                    <select name="status" id="status"
                            class="form-select @error('status') is-invalid @enderror">
                        <option value="">Pilih status</option>
                        <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="dijual" {{ old('status') == 'dijual' ? 'selected' : '' }}>Dijual</option>
                        <option value="mati" {{ old('status') == 'mati' ? 'selected' : '' }}>Mati</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="kandang_id" class="form-label fw-semibold">Kandang (Opsional)</label>
                    <select name="kandang_id" id="kandang_id"
                            class="form-select @error('kandang_id') is-invalid @enderror">
                        <option value="">Pilih kandang</option>
                        @foreach($kandang as $item)
                            <option value="{{ $item->kandang_id }}" {{ old('kandang_id') == $item->kandang_id ? 'selected' : '' }}>
                                {{ $item->nama_kandang }}
                            </option>
                        @endforeach
                    </select>
                    @error('kandang_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2 mt-4 pt-2">
                <a href="{{ route('ternak.index') }}" class="btn btn-light px-4">Batal</a>
                <button type="submit" class="btn btn-primary px-4">Simpan Ternak</button>
            </div>
        </form>
    </div>
</div>
@endsection