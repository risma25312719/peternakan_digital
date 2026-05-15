@extends('layouts.mantis')

@section('content')
<div class="container-fluid px-4 py-3">
    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">Data Pakan</h2>
            <p class="text-muted">Kelola stok dan jenis pakan ternak</p>
        </div>
        <a href="{{ route('pakan.create') }}" class="btn btn-primary">
            + Tambah Pakan
        </a>
    </div>

    {{-- Flash message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            ✓ {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- TABLE --}}
    <div class="border rounded-3 bg-white shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>No.</th>
                        <th>Nama Pakan</th>
                        <th>Stok</th>
                        <th>Satuan</th>
                        <th>Status Stok</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pakan as $p)
                    <tr>
                        <td>{{ $pakan->firstItem() + $loop->index }}</td>
                        <td><strong>{{ $p->nama_pakan }}</strong></td>
                        <td>{{ number_format($p->stok, 2) }}</td>
                        <td>{{ $p->satuan }}</td>
                        <td>
                            @if($p->stok <= 0)
                                <span class="badge bg-danger">Habis</span>
                            @elseif($p->stok <= 10)
                                <span class="badge bg-warning text-dark">Hampir Habis</span>
                            @else
                                <span class="badge bg-success">Tersedia</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('pakan.edit', $p->data_pakan_id) }}" class="btn btn-sm btn-success">Edit</a>
                            <form action="{{ route('pakan.destroy', $p->data_pakan_id) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Yakin hapus pakan {{ $p->nama_pakan }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <div class="fs-1">🍽️</div>
                            <p>Belum ada data pakan.</p>
                            <a href="{{ route('pakan.create') }}" class="btn btn-primary btn-sm">Tambah Pakan</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($pakan->hasPages())
            <div class="d-flex justify-content-between align-items-center px-3 py-2 border-top">
                <p class="text-muted mb-0 small">
                    Menampilkan {{ $pakan->firstItem() }}–{{ $pakan->lastItem() }} dari {{ $pakan->total() }} pakan
                </p>
                {{ $pakan->links() }}
            </div>
        @endif
    </div>
</div>
@endsection