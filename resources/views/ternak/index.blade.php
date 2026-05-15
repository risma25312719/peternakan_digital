@extends('layouts.mantis')

@section('content')
<div class="container-fluid px-4 py-3">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">Data Ternak</h2>
            <p class="text-muted">Kelola semua data ternak</p>
        </div>
        <a href="{{ route('ternak.create') }}" class="btn btn-primary">
            + Tambah Ternak
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            ✓ {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="border rounded-3 bg-white shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>No.</th>
                        <th>Kode Ternak</th>
                        <th>Jenis</th>
                        <th>Kelamin</th>
                        <th>Tanggal Masuk</th>
                        <th>Status</th>
                        <th>Kandang</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ternak as $t)
                    <tr>
                        <td>{{ $loop->iteration + ($ternak->currentPage() - 1) * $ternak->perPage() }}</td>
                        <td><strong>{{ $t->kode_ternak }}</strong></td>
                        <td>{{ ucfirst($t->jenis_hewan) }}</td>
                        <td>{{ ucfirst($t->jenis_kelamin) }}</td>
                        <td>{{ \Carbon\Carbon::parse($t->tanggal_masuk)->format('d/m/Y') }}</td>
                        <td>
                            @php
                                $badgeClass = $t->status == 'aktif' ? 'bg-success' : ($t->status == 'dijual' ? 'bg-warning' : 'bg-danger');
                            @endphp
                            <span class="badge {{ $badgeClass }}">{{ ucfirst($t->status) }}</span>
                        </td>
                        <td>{{ $t->kandang->nama_kandang ?? '-' }}</td>
                        <td class="text-center">
                            <a href="{{ route('ternak.show', $t->ternak_id) }}" class="btn btn-sm btn-light">Detail</a>
                            <a href="{{ route('ternak.edit', $t->ternak_id) }}" class="btn btn-sm btn-success">Edit</a>
                            <form action="{{ route('ternak.destroy', $t->ternak_id) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Yakin hapus ternak {{ $t->kode_ternak }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-5 text-muted">
                            <div class="fs-1">🐄</div>
                            <p>Belum ada data ternak.</p>
                            <a href="{{ route('ternak.create') }}" class="btn btn-primary btn-sm">Tambah Ternak</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($ternak->hasPages())
            <div class="d-flex justify-content-between align-items-center px-3 py-2 border-top">
                <p class="text-muted mb-0 small">
                    Menampilkan {{ $ternak->firstItem() }}–{{ $ternak->lastItem() }} dari {{ $ternak->total() }} ternak
                </p>
                {{ $ternak->links() }}
            </div>
        @endif
    </div>
</div>
@endsection 