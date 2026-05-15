@extends('layouts.mantis')

@section('content')
<div class="container-fluid px-4 py-3">
    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">Data Kandang</h2>
            <p class="text-muted">Kelola semua kandang peternakan</p>
        </div>
        <a href="{{ route('kandang.create') }}" class="btn btn-primary">
            + Tambah Kandang
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
                        <th>Nama Kandang</th>
                        <th>Lokasi</th>
                        <th>Kapasitas</th>
                        <th>Terisi</th>
                        <th>Sisa</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kandang as $k)
                    <tr>
                        <td>{{ $kandang->firstItem() + $loop->index }}</td>
                        <td><strong>{{ $k->nama_kandang }}</strong></td>
                        <td>{{ $k->lokasi ?? '-' }}</td>
                        <td>{{ $k->kapasitas }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <span>{{ $k->data_ternak_count }}</span>
                                <div class="progress flex-grow-1" style="height: 6px;">
                                    <div class="progress-bar bg-success"
                                         style="width: {{ $k->kapasitas > 0 ? min(100, ($k->data_ternak_count / $k->kapasitas) * 100) : 0 }}%">
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            @php $sisa = $k->kapasitas - $k->data_ternak_count; @endphp
                            <span class="{{ $sisa <= 0 ? 'text-danger fw-bold' : 'text-muted' }}">
                                {{ $sisa <= 0 ? 'Penuh' : $sisa }}
                            </span>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('kandang.show', $k->kandang_id) }}" class="btn btn-sm btn-light">Detail</a>
                            <a href="{{ route('kandang.edit', $k->kandang_id) }}" class="btn btn-sm btn-success">Edit</a>
                            <form action="{{ route('kandang.destroy', $k->kandang_id) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Yakin hapus kandang {{ $k->nama_kandang }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            <div class="fs-1">🏠</div>
                            <p>Belum ada data kandang.</p>
                            <a href="{{ route('kandang.create') }}" class="btn btn-primary btn-sm">Tambah Kandang</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($kandang->hasPages())
            <div class="d-flex justify-content-between align-items-center px-3 py-2 border-top">
                <p class="text-muted mb-0 small">
                    Menampilkan {{ $kandang->firstItem() }}–{{ $kandang->lastItem() }} dari {{ $kandang->total() }} kandang
                </p>
                {{ $kandang->links() }}
            </div>
        @endif
    </div>
</div>
@endsection