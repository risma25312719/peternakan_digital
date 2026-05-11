
@extends('layouts.mantis')

@section('content')
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <ul class="breadcrumb
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kandang — TernakDigital</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans">

<nav class="bg-white border-b border-gray-200 px-6 py-3 flex items-center justify-between">
    <div class="flex items-center gap-2">
        <div class="w-8 h-8 bg-emerald-600 rounded-lg flex items-center justify-center text-white text-sm">🐄</div>
        <span class="font-semibold text-gray-800">TernakDigital</span>
    </div>
    <div class="flex gap-6 text-sm text-gray-500">
        <a href="{{ route('ternak.index') }}" class="hover:text-gray-800">Data Ternak</a>
        <a href="{{ route('kandang.index') }}" class="text-emerald-600 font-medium">Kandang</a>
        <a href="#" class="hover:text-gray-800">Pakan</a>
        <a href="#" class="hover:text-gray-800">Kesehatan</a>
        <a href="#" class="hover:text-gray-800">Penjualan</a>
    </div>
</nav>

<div class="max-w-7xl mx-auto px-6 py-8">

    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Data Kandang</h1>
            <p class="text-sm text-gray-500 mt-1">Kelola semua kandang peternakan</p>
        </div>
        <a href="{{ route('kandang.create') }}"
           class="bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium px-4 py-2 rounded-lg">
            + Tambah Kandang
        </a>
    </div>

    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm px-4 py-3 rounded-lg mb-4">
            ✓ {{ session('success') }}
        </div>
    @endif

    {{-- STATS --}}
    <div class="grid grid-cols-3 gap-4 mb-6">
        <div class="bg-white border border-gray-200 rounded-xl px-5 py-4">
            <p class="text-sm text-gray-500">Total Kandang</p>
            <p class="text-2xl font-bold text-gray-800 mt-1">{{ $kandang->total() }}</p>
        </div>
        <div class="bg-white border border-gray-200 rounded-xl px-5 py-4">
            <p class="text-sm text-gray-500">Total Kapasitas</p>
            <p class="text-2xl font-bold text-emerald-600 mt-1">
                {{ $kandang->getCollection()->sum('kapasitas') }}
            </p>
        </div>
        <div class="bg-white border border-gray-200 rounded-xl px-5 py-4">
            <p class="text-sm text-gray-500">Total Ternak</p>
            <p class="text-2xl font-bold text-blue-600 mt-1">
                {{ $kandang->getCollection()->sum('data_ternak_count') }}
            </p>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200 text-gray-500 text-left">
                    <th class="px-4 py-3 font-medium">#</th>
                    <th class="px-4 py-3 font-medium">Nama Kandang</th>
                    <th class="px-4 py-3 font-medium">Lokasi</th>
                    <th class="px-4 py-3 font-medium">Kapasitas</th>
                    <th class="px-4 py-3 font-medium">Terisi</th>
                    <th class="px-4 py-3 font-medium">Sisa</th>
                    <th class="px-4 py-3 font-medium text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($kandang as $k)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-4 py-3 text-gray-400">{{ $kandang->firstItem() + $loop->index }}</td>
                    <td class="px-4 py-3 font-medium text-gray-800">{{ $k->nama_kandang }}</td>
                    <td class="px-4 py-3 text-gray-600">{{ $k->lokasi ?? '-' }}</td>
                    <td class="px-4 py-3 text-gray-600">{{ $k->kapasitas }}</td>
                    <td class="px-4 py-3">
                        <div class="flex items-center gap-2">
                            <span class="font-medium text-gray-800">{{ $k->data_ternak_count }}</span>
                            <div class="w-20 h-1.5 bg-gray-100 rounded-full overflow-hidden">
                                <div class="h-full bg-emerald-500 rounded-full"
                                     style="width: {{ $k->kapasitas > 0 ? min(100, ($k->data_ternak_count / $k->kapasitas) * 100) : 0 }}%">
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-3">
                        @php $sisa = $k->kapasitas - $k->data_ternak_count @endphp
                        <span class="text-gray-600">{{ $sisa }}</span>
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('kandang.show', $k->kandang_id) }}"
                               class="text-xs bg-gray-100 hover:bg-gray-200 text-gray-700 px-3 py-1.5 rounded-lg">
                                Detail
                            </a>
                            <a href="{{ route('kandang.edit', $k->kandang_id) }}"
                               class="text-xs bg-emerald-50 hover:bg-emerald-100 text-emerald-700 px-3 py-1.5 rounded-lg">
                                Edit
                            </a>
                            <form action="{{ route('kandang.destroy', $k->kandang_id) }}" method="POST"
                                  onsubmit="return confirm('Yakin hapus kandang {{ $k->nama_kandang }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="text-xs bg-red-50 hover:bg-red-100 text-red-600 px-3 py-1.5 rounded-lg">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-4 py-12 text-center text-gray-400">
                        <div class="text-4xl mb-2">🏠</div>
                        <div>Belum ada data kandang.</div>
                        <a href="{{ route('kandang.create') }}" class="text-emerald-600 hover:underline text-sm mt-1 inline-block">
                            Tambah kandang pertama
                        </a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        {{-- PAGINATION --}}
        @if($kandang->hasPages())
        <div class="px-4 py-3 border-t border-gray-100 flex items-center justify-between">
            <p class="text-sm text-gray-500">
                Menampilkan {{ $kandang->firstItem() }}–{{ $kandang->lastItem() }} dari {{ $kandang->total() }} kandang
            </p>
            {{ $kandang->links() }}
        </div>
        @endif

    </div>
</div>

</body>
</html>