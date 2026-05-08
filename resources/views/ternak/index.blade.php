<!-- resources/views/ternak/index.blade.php -->

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Ternak — TernakDigital</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans">

{{-- NAVBAR --}}
<nav class="bg-white border-b border-gray-200 px-6 py-3 flex items-center justify-between">
    <div class="flex items-center gap-2">
        <div class="w-8 h-8 bg-emerald-600 rounded-lg flex items-center justify-center text-white text-sm">🐄</div>
        <span class="font-semibold text-gray-800">TernakDigital</span>
    </div>
    <div class="flex gap-6 text-sm text-gray-500">
        <a href="{{ route('ternak.index') }}" class="text-emerald-600 font-medium">Data Ternak</a>
        <a href="#" class="hover:text-gray-800">Kandang</a>
        <a href="#" class="hover:text-gray-800">Pakan</a>
        <a href="#" class="hover:text-gray-800">Kesehatan</a>
        <a href="#" class="hover:text-gray-800">Penjualan</a>
    </div>
</nav>

<div class="max-w-7xl mx-auto px-6 py-8">

    {{-- HEADER --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Data Ternak</h1>
            <p class="text-sm text-gray-500 mt-1">Kelola semua data ternak terdaftar</p>
        </div>
        <a href="{{ route('ternak.create') }}"
           class="bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium px-4 py-2 rounded-lg">
            + Tambah Ternak
        </a>
    </div>

    {{-- ALERT SUCCESS --}}
    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm px-4 py-3 rounded-lg mb-4">
            ✓ {{ session('success') }}
        </div>
    @endif

    {{-- STATS --}}
    <div class="grid grid-cols-3 gap-4 mb-6">
        <div class="bg-white border border-gray-200 rounded-xl px-5 py-4">
            <p class="text-sm text-gray-500">Total Ternak</p>
            <p class="text-2xl font-bold text-gray-800 mt-1">{{ $ternak->total() }}</p>
        </div>
        <div class="bg-white border border-gray-200 rounded-xl px-5 py-4">
            <p class="text-sm text-gray-500">Aktif</p>
            <p class="text-2xl font-bold text-emerald-600 mt-1">
                {{ $ternak->getCollection()->where('status', 'aktif')->count() }}
            </p>
        </div>
        <div class="bg-white border border-gray-200 rounded-xl px-5 py-4">
            <p class="text-sm text-gray-500">Dijual / Mati</p>
            <p class="text-2xl font-bold text-red-500 mt-1">
                {{ $ternak->getCollection()->whereIn('status', ['dijual', 'mati'])->count() }}
            </p>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200 text-gray-500 text-left">
                    <th class="px-4 py-3 font-medium">#</th>
                    <th class="px-4 py-3 font-medium">Kode Ternak</th>
                    <th class="px-4 py-3 font-medium">Jenis Hewan</th>
                    <th class="px-4 py-3 font-medium">Jenis Kelamin</th>
                    <th class="px-4 py-3 font-medium">Kandang</th>
                    <th class="px-4 py-3 font-medium">Tanggal Masuk</th>
                    <th class="px-4 py-3 font-medium">Status</th>
                    <th class="px-4 py-3 font-medium text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($ternak as $t)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-4 py-3 text-gray-400">{{ $ternak->firstItem() + $loop->index }}</td>
                    <td class="px-4 py-3 font-medium text-gray-800">{{ $t->kode_ternak }}</td>
                    <td class="px-4 py-3 text-gray-600 capitalize">{{ $t->jenis_hewan }}</td>
                    <td class="px-4 py-3 text-gray-600 capitalize">{{ $t->jenis_kelamin }}</td>
                    <td class="px-4 py-3 text-gray-600">{{ $t->kandang->nama_kandang ?? '-' }}</td>
                    <td class="px-4 py-3 text-gray-600">
                        {{ \Carbon\Carbon::parse($t->tanggal_masuk)->format('d M Y') }}
                    </td>
                    <td class="px-4 py-3">
                        @if($t->status === 'aktif')
                            <span class="bg-emerald-100 text-emerald-700 text-xs font-medium px-2.5 py-1 rounded-full">Aktif</span>
                        @elseif($t->status === 'dijual')
                            <span class="bg-blue-100 text-blue-700 text-xs font-medium px-2.5 py-1 rounded-full">Dijual</span>
                        @else
                            <span class="bg-red-100 text-red-700 text-xs font-medium px-2.5 py-1 rounded-full">Mati</span>
                        @endif
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('ternak.show', $t->ternak_id) }}"
                               class="text-xs bg-gray-100 hover:bg-gray-200 text-gray-700 px-3 py-1.5 rounded-lg">
                                Detail
                            </a>
                            <a href="{{ route('ternak.edit', $t->ternak_id) }}"
                               class="text-xs bg-emerald-50 hover:bg-emerald-100 text-emerald-700 px-3 py-1.5 rounded-lg">
                                Edit
                            </a>
                            <form action="{{ route('ternak.destroy', $t->ternak_id) }}" method="POST"
                                  onsubmit="return confirm('Yakin hapus ternak {{ $t->kode_ternak }}?')">
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
                    <td colspan="8" class="px-4 py-12 text-center text-gray-400">
                        <div class="text-4xl mb-2">🐄</div>
                        <div>Belum ada data ternak.</div>
                        <a href="{{ route('ternak.create') }}" class="text-emerald-600 hover:underline text-sm mt-1 inline-block">
                            Tambah ternak pertama
                        </a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        {{-- PAGINATION --}}
        @if($ternak->hasPages())
        <div class="px-4 py-3 border-t border-gray-100 flex items-center justify-between">
            <p class="text-sm text-gray-500">
                Menampilkan {{ $ternak->firstItem() }}–{{ $ternak->lastItem() }} dari {{ $ternak->total() }} ternak
            </p>
            {{ $ternak->links() }}
        </div>
        @endif

    </div>
</div>

</body>
</html>