@extends('layouts.mantis')

@section('title', 'Dashboard - Peternakan Digital')

@section('content')
<div class="row">
    <!-- Header Welcome -->
    <div class="col-12 mb-4">
        <h2 class="fw-800 text-dark">Dashboard Overview</h2>
        <p class="text-muted">Monitoring data ternak dan pakan di P4 secara real-time.</p>
    </div>

    <!-- Statistik Cards (Data dari Controller) -->
    <div class="col-md-3 mb-4">
        <div class="card border-0 shadow-sm text-white" style="border-radius: 20px; background: #1b7a3a;">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="mb-1 fw-600" style="color: rgba(255,255,255,0.8);">Total Ternak</p>
                        <h3 class="fw-800 mb-0">{{ $totalTernak }}</h3>
                    </div>
                    <div class="p-3 rounded-circle" style="background: rgba(255,255,255,0.2);">
                        <i class="ti ti-cow text-white" style="font-size: 2rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card border-0 shadow-sm text-white" style="border-radius: 20px; background: #1b7a3a;">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="mb-1 fw-600" style="color: rgba(255,255,255,0.8);">Stok Pakan</p>
                        <h3 class="fw-800 mb-0">{{ number_format($totalPakan) }} <small class="text-sm">kg</small></h3>
                    </div>
                    <div class="p-3 rounded-circle" style="background: rgba(255,255,255,0.2);">
                        <i class="ti ti-plant-2 text-white" style="font-size: 2rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card border-0 shadow-sm text-white" style="border-radius: 20px; background: #28a745;">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="mb-1 fw-600" style="color: rgba(255,255,255,0.8);">Total Kandang</p>
                        <h3 class="fw-800 mb-0">{{ $totalKandang }}</h3>
                    </div>
                    <div class="p-3 rounded-circle" style="background: rgba(255,255,255,0.2);">
                        <i class="ti ti-home text-white" style="font-size: 2rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Aktivitas Kesehatan Terbaru -->
    <div class="col-12 mt-2">
        <div class="card border-0 shadow-sm" style="border-radius: 25px;">
            <div class="card-header bg-transparent border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                <h5 class="fw-800 mb-0">Catatan Kesehatan Terbaru</h5>
            </div>
            <div class="card-body px-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4">ID Ternak</th>
                                <th>Kondisi</th>
                                <th>Tanggal Periksa</th>
                                <th class="pe-4">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($aktivitasTerbaru as $item)
                            <tr>
                                <td class="ps-4 fw-600">{{ $item->dataTernak->nama_ternak ?? 'N/A' }}</td>
                                <td>{{ $item->kondisi }}</td>
                                <td>{{ $item->created_at->format('d M Y | H:i') }}</td>
                                <td class="pe-4">
                                    <span class="badge bg-light-success text-success px-3 py-2 rounded-pill">Checked</span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-4">Belum ada aktivitas kesehatan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .fw-800 { font-weight: 800; }
    .fw-600 { font-weight: 600; }
    .bg-light-success { background-color: #e8f5e9; }
    .text-success { color: #1b7a3a !important; }
    
    .table thead th {
        font-size: 0.75rem;
        text-transform: uppercase;
        color: #8a92a6;
        border-bottom: none;
        padding: 15px 10px;
    }
</style>
@endpush