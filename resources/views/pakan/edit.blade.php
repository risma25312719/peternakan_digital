<!-- resources/views/pakan/edit.blade.php -->

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pakan — TernakDigital</title>
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

<div class="max-w-3xl mx-auto px-6 py-8">

    <div class="flex items-center gap-2 text-sm text-gray-400 mb-6">
        <a href="{{ route('pakan.index') }}" class="hover:text-emerald-600">Pakan</a>
        <span>/</span>
        <span class="text-gray-700">Edit — {{ $pakan->nama_pakan }}</span>
    </div>

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Edit Data Pakan</h1>
        <p class="text-sm text-gray-500 mt-1">Perbarui informasi pakan <span class="font-medium text-gray-700">{{ $pakan->nama_pakan }}</span></p>
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

    <form action="{{ route('pakan.update', $pakan->data_pakan_id) }}" method="POST"
          class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2" for="nama_pakan">
                Nama Pakan <span class="text-red-500">*</span>
            </label>
            <input id="nama_pakan" name="nama_pakan" type="text"
                   value="{{ old('nama_pakan', $pakan->nama_pakan) }}"
                   placeholder="contoh: Rumput Gajah"
                   class="w-full rounded-xl border @error('nama_pakan') border-red-400 @else border-gray-200 @enderror
                          px-4 py-3 text-sm focus:outline-none focus:border-emerald-500">
            @error('nama_pakan')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2" for="stok">
                    Stok <span class="text-red-500">*</span>
                </label>
                <input id="stok" name="stok" type="number" step="0.01" min="0"
                       value="{{ old('stok', $pakan->stok) }}"
                       placeholder="contoh: 100"
                       class="w-full rounded-xl border @error('stok') border-red-400 @else border-gray-200 @enderror
                              px-4 py-3 text-sm focus:outline-none focus:border-emerald-500">
                @error('stok')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2" for="satuan">
                    Satuan <span class="text-red-500">*</span>
                </label>
                <select id="satuan" name="satuan"
                        class="w-full rounded-xl border @error('satuan') border-red-400 @else border-gray-200 @enderror
                               bg-white px-4 py-3 text-sm focus:outline-none focus:border-emerald-500">
                    <option value="">— Pilih Satuan —</option>
                    <option value="kg"     {{ old('satuan', $pakan->satuan) == 'kg'     ? 'selected' : '' }}>kg</option>
                    <option value="liter"  {{ old('satuan', $pakan->satuan) == 'liter'  ? 'selected' : '' }}>liter</option>
                    <option value="karung" {{ old('satuan', $pakan->satuan) == 'karung' ? 'selected' : '' }}>karung</option>
                    <option value="ikat"   {{ old('satuan', $pakan->satuan) == 'ikat'   ? 'selected' : '' }}>ikat</option>
                    <option value="ton"    {{ old('satuan', $pakan->satuan) == 'ton'    ? 'selected' : '' }}>ton</option>
                </select>
                @error('satuan')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="flex items-center justify-between pt-2">
            <button type="button"
                    onclick="document.getElementById('form-hapus').submit()"
                    class="inline-flex items-center justify-center rounded-xl border border-red-200 bg-red-50 px-5 py-3 text-sm font-medium text-red-600 hover:bg-red-100">
                Hapus Pakan
            </button>

            <div class="flex gap-3">
                <a href="{{ route('pakan.index') }}"
                   class="inline-flex items-center justify-center rounded-xl border border-gray-200 bg-white px-5 py-3 text-sm font-medium text-gray-700 hover:bg-gray-50">
                    Batal
                </a>
                <button type="submit"
                        class="inline-flex items-center justify-center rounded-xl bg-emerald-600 px-5 py-3 text-sm font-medium text-white hover:bg-emerald-700">
                    Simpan Perubahan
                </button>
            </div>
        </div>

    </form>

    <form id="form-hapus" action="{{ route('pakan.destroy', $pakan->data_pakan_id) }}" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>

</div>

</body>
</html>