<!-- resources/views/kesehatan/edit.blade.php -->

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Catatan Kesehatan — TernakDigital</title>
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
        <a href="#" class="hover:text-gray-800">Pakan</a>
        <a href="{{ route('kesehatan.index') }}" class="text-emerald-600 font-medium">Kesehatan</a>
        <a href="#" class="hover:text-gray-800">Penjualan</a>
    </div>
</nav>

<div class="max-w-3xl mx-auto px-6 py-8">

    <div class="flex items-center gap-2 text-sm text-gray-400 mb-6">
        <a href="{{ route('kesehatan.index') }}" class="hover:text-emerald-600">Kesehatan</a>
        <span>/</span>
        <span class="text-gray-700">Edit Catatan</span>
    </div>

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Edit Catatan Kesehatan</h1>
        <p class="text-sm text-gray-500 mt-1">Perbarui catatan kondisi ternak</p>
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

    <form action="{{ route('kesehatan.update', $kesehatan->kesehatan_id) }}" method="POST"
          class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2" for="ternak_id">
                Pilih Ternak <span class="text-red-500">*</span>
            </label>
            <select id="ternak_id" name="ternak_id"
                    class="w-full rounded-xl border @error('ternak_id') border-red-400 @else border-gray-200 @enderror
                           bg-white px-4 py-3 text-sm focus:outline-none focus:border-emerald-500">
                <option value="">— Pilih Ternak —</option>
                @foreach($ternak as $t)
                    <option value="{{ $t->ternak_id }}"
                        {{ old('ternak_id', $kesehatan->ternak_id) == $t->ternak_id ? 'selected' : '' }}>
                        {{ $t->kode_ternak }} — {{ $t->jenis_hewan }}
                    </option>
                @endforeach
            </select>
            @error('ternak_id')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2" for="tanggal">
                    Tanggal <span class="text-red-500">*</span>
                </label>
                <input id="tanggal" name="tanggal" type="date"
                       value="{{ old('tanggal', $kesehatan->tanggal) }}"
                       class="w-full rounded-xl border @error('tanggal') border-red-400 @else border-gray-200 @enderror
                              px-4 py-3 text-sm focus:outline-none focus:border-emerald-500">
                @error('tanggal')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2" for="kondisi">
                    Kondisi <span class="text-red-500">*</span>
                </label>
                <input id="kondisi" name="kondisi" type="text"
                       value="{{ old('kondisi', $kesehatan->kondisi) }}"
                       placeholder="contoh: sehat, sakit ringan, luka"
                       class="w-full rounded-xl border @error('kondisi') border-red-400 @else border-gray-200 @enderror
                              px-4 py-3 text-sm focus:outline-none focus:border-emerald-500">
                @error('kondisi')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2" for="tindakan">Tindakan</label>
            <textarea id="tindakan" name="tindakan" rows="3"
                      placeholder="contoh: pemberian antibiotik, vaksin PMK..."
                      class="w-full rounded-xl border @error('tindakan') border-red-400 @else border-gray-200 @enderror
                             px-4 py-3 text-sm focus:outline-none focus:border-emerald-500 resize-none">{{ old('tindakan', $kesehatan->tindakan) }}</textarea>
            @error('tindakan')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-between pt-2">
            <button type="button"
                    onclick="document.getElementById('form-hapus').submit()"
                    class="inline-flex items-center justify-center rounded-xl border border-red-200 bg-red-50 px-5 py-3 text-sm font-medium text-red-600 hover:bg-red-100">
                Hapus Catatan
            </button>

            <div class="flex gap-3">
                <a href="{{ route('kesehatan.index') }}"
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

    <form id="form-hapus" action="{{ route('kesehatan.destroy', $kesehatan->kesehatan_id) }}" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>

</div>

</body>
</html>