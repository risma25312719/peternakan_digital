

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pakan — TernakDigital</title>
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
        <a href="{{ route('kandang.index') }}" class="hover:text-gray-800">Kandang</a>
        <a href="{{ route('pakan.index') }}" class="text-emerald-600 font-medium">Pakan</a>
        <a href="{{ route('kesehatan.index') }}" class="hover:text-gray-800">Kesehatan</a>
        <a href="#" class="hover:text-gray-800">Penjualan</a>
    </div>
</nav>

<div class="max-w-7xl mx-auto px-6 py-8">

    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Data Pakan</h1>
            <p class="text-sm text-gray-500 mt-1">Kelola stok dan jenis pakan ternak</p>
        </div>
        <a href="{{ route('pakan.create') }}"
           class="bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium px-4 py-2 rounded-lg">
            + Tambah Pakan
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
            <p class="text-sm text-gray-500">Total Jenis Pakan</p>
            <p class="text-2xl font-bold text-gray-800 mt-1">{{ $pakan->total() }}</p>
        </div>
        <div class="bg-white border border-gray-200 rounded-xl px-5 py-4">
            <p class="text-sm text-gray-500">Stok Tersedia</p>
            <p class="text-2xl font-bold text-emerald-600 mt-1">
                {{ $pakan->getCollection()->where('stok', '>', 0)->count() }}
            </p>
        </div>
        <div class="bg-white border border-gray-200 rounded-xl px-5 py-4">
            <p class="text-sm text-gray-500">Stok Habis</p>
            <p class="text-2xl font-bold text-red-500 mt-1">
                {{ $pakan->getCollection()->where('stok', '<=', 0)->count() }}
            </p>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200 text-gray-500 text-left">
                    <th class="px-4 py-3 font-medium">#</th>
                    <th class="px-4 py-3 font-medium">Nama Pakan</th>
                    <th class="px-4 py-3 font-medium">Stok</th>
                    <th class="px-4 py-3 font-medium">Satuan</th>
                    <th class="px-4 py-3 font-medium">Status Stok</th>
                    <th class="px-4 py-3 font-medium text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($pakan as $p)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-4 py-3 text-gray-400">{{ $pakan->firstItem() + $loop->index }}</td>
                    <td class="px-4 py-3 font-medium text-gray-800">{{ $p->nama_pakan }}</td>
                    <td class="px-4 py-3 text-gray-600">{{ number_format($p->stok, 2) }}</td>
                    <td class="px-4 py-3 text-gray-600">{{ $p->satuan }}</td>
                    <td class="px-4 py-3">
                        @if($p->stok <= 0)
                            <span class="bg-red-100 text-red-700 text-xs font-medium px-2.5 py-1 rounded-full">Habis</span>
                        @elseif($p->stok <= 10)
                            <span class="bg-amber-100 text-amber-700 text-xs font-medium px-2.5 py-1 rounded-full">Hampir Habis</span>
                        @else
                            <span class="bg-emerald-100 text-emerald-700 text-xs font-medium px-2.5 py-1 rounded-full">Tersedia</span>
                        @endif
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('pakan.edit', $p->data_pakan_id) }}"
                               class="text-xs bg-emerald-50 hover:bg-emerald-100 text-emerald-700 px-3 py-1.5 rounded-lg">
                                Edit
                            </a>
                            <form action="{{ route('pakan.destroy', $p->data_pakan_id) }}" method="POST"
                                  onsubmit="return confirm('Yakin hapus pakan {{ $p->nama_pakan }}?')">
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
                    <td colspan="6" class="px-4 py-12 text-center text-gray-400">
                        <div class="text-4xl mb-2">🍽️</div>
                        <div>Belum ada data pakan.</div>
                        <a href="{{ route('pakan.create') }}" class="text-emerald-600 hover:underline text-sm mt-1 inline-block">
                            Tambah pakan pertama
                        </a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        @if($pakan->hasPages())
        <div class="px-4 py-3 border-t border-gray-100 flex items-center justify-between">
            <p class="text-sm text-gray-500">
                Menampilkan {{ $pakan->firstItem() }}–{{ $pakan->lastItem() }} dari {{ $pakan->total() }} pakan
            </p>
            {{ $pakan->links() }}
        </div>
        @endif
    </div>
</div>

</body>
</html>