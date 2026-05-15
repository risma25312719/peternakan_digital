@extends('layouts.mantis')

@section('content')
<div class="container-fluid px-4 py-3">
    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">Data Kesehatan</h2>
            <p class="text-muted">Monitoring kondisi dan tindakan kesehatan ternak</p>
        </div>
        <a href="{{ route('kesehatan.create') }}" class="btn btn-primary">
            + Tambah Catatan
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
                        <th>Kode Ternak</th>
                        <th>Jenis Hewan</th>
                        <th>Tanggal</th>
                        <th>Kondisi</th>
                        <th>Tindakan</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kesehatan as $k)
                    <tr>
                        <td>{{ $kesehatan->firstItem() + $loop->index }}</td>
                        <td><strong>{{ $k->dataTernak->kode_ternak ?? '-' }}</strong></td>
                        <td>{{ ucfirst($k->dataTernak->jenis_hewan ?? '-') }}</td>
                        <td>{{ \Carbon\Carbon::parse($k->tanggal)->translatedFormat('d M Y') }}</td>
                        <td>
                            @php $kondisi = strtolower($k->kondisi); @endphp
                            @if($kondisi === 'sehat')
                                <span class="badge bg-success">Sehat</span>
                            @elseif(str_contains($kondisi, 'sakit'))
                                <span class="badge bg-danger">{{ ucfirst($k->kondisi) }}</span>
                            @else
                                <span class="badge bg-warning text-dark">{{ ucfirst($k->kondisi) }}</span>
                            @endif
                        </td>
                        <td class="text-truncate" style="max-width: 200px;">{{ $k->tindakan ?? '-' }}</td>
                        <td class="text-center">
                            <a href="{{ route('kesehatan.edit', $k->kesehatan_id) }}" class="btn btn-sm btn-success">Edit</a>
                            <form action="{{ route('kesehatan.destroy', $k->kesehatan_id) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Yakin hapus catatan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            <div class="fs-1">💉</div>
                            <p>Belum ada catatan kesehatan.</p>
                            <a href="{{ route('kesehatan.create') }}" class="btn btn-primary btn-sm">Tambah Catatan</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($kesehatan->hasPages())
            <div class="d-flex justify-content-between align-items-center px-3 py-2 border-top">
                <p class="text-muted mb-0 small">
                    Menampilkan {{ $kesehatan->firstItem() }}–{{ $kesehatan->lastItem() }} dari {{ $kesehatan->total() }} catatan
                </p>
                {{ $kesehatan->links() }}
            </div>
        @endif
    </div>
</div>
@endsection