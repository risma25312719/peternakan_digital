

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kandang — TernakDigital</title>
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

<div class="max-w-3xl mx-auto px-6 py-8">

    <div class="flex items-center gap-2 text-sm text-gray-400 mb-6">
        <a href="{{ route('kandang.index') }}" class="hover:text-emerald-600">Kandang</a>
        <span>/</span>
        <span class="text-gray-700">Tambah Kandang</span>
    </div>

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Tambah Kandang Baru</h1>
        <p class="text-sm text-gray-500 mt-1">Isi data kandang untuk didaftarkan ke sistem</p>
    </div>

    @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-3 rounded-lg mb-6">
            <strong class="font-semibold">Periksa kembali data berikut:</strong>
            <ul class="mt-2 list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('kandang.store') }}" method="POST"
          class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 space-y-5">
        @csrf

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2" for="nama_kandang">
                Nama Kandang <span class="text-red-500">*</span>
            </label>
            <input id="nama_kandang" name="nama_kandang" type="text"
                   value="{{ old('nama_kandang') }}"
                   placeholder="contoh: Kandang A"
                   class="w-full rounded-xl border @error('nama_kandang') border-red-400 @else border-gray-200 @enderror
                          px-4 py-3 text-sm focus:outline-none focus:border-emerald-500">
            @error('nama_kandang')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2" for="kapasitas">
                    Kapasitas <span class="text-red-500">*</span>
                </label>
                <input id="kapasitas" name="kapasitas" type="number" min="1"
                       value="{{ old('kapasitas') }}"
                       placeholder="contoh: 50"
                       class="w-full rounded-xl border @error('kapasitas') border-red-400 @else border-gray-200 @enderror
                              px-4 py-3 text-sm focus:outline-none focus:border-emerald-500">
                @error('kapasitas')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2" for="lokasi">
                    Lokasi
                </label>
                <input id="lokasi" name="lokasi" type="text"
                       value="{{ old('lokasi') }}"
                       placeholder="contoh: Blok Utara"
                       class="w-full rounded-xl border @error('lokasi') border-red-400 @else border-gray-200 @enderror
                              px-4 py-3 text-sm focus:outline-none focus:border-emerald-500">
                @error('lokasi')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="flex items-center justify-end gap-3 pt-2">
            <a href="{{ route('kandang.index') }}"
               class="inline-flex items-center justify-center rounded-xl border border-gray-200 bg-white px-5 py-3 text-sm font-medium text-gray-700 hover:bg-gray-50">
                Batal
            </a>
            <button type="submit"
                    class="inline-flex items-center justify-center rounded-xl bg-emerald-600 px-5 py-3 text-sm font-medium text-white hover:bg-emerald-700">
                Simpan Kandang
            </button>
        </div>

    </form>
</div>

</body>
</html>