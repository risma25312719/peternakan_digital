<!-- resources/views/ternak/edit.blade.php -->

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Ternak — TernakDigital</title>
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
        <a href="{{ route('ternak.index') }}" class="hover:text-gray-800">Data Ternak</a>
        <a href="#" class="hover:text-gray-800">Kandang</a>
        <a href="#" class="hover:text-gray-800">Pakan</a>
        <a href="#" class="hover:text-gray-800">Kesehatan</a>
        <a href="#" class="hover:text-gray-800">Penjualan</a>
    </div>
</nav>

<div class="max-w-3xl mx-auto px-6 py-8">

    {{-- BREADCRUMB --}}
    <div class="flex items-center gap-2 text-sm text-gray-400 mb-6">
        <a href="{{ route('ternak.index') }}" class="hover:text-emerald-600">Data Ternak</a>
        <span>/</span>
        <span class="text-gray-700">Edit — {{ $ternak->kode_ternak }}</span>
    </div>

    {{-- HEADER --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Edit Data Ternak</h1>
        <p class="text-sm text-gray-500 mt-1">Perbarui informasi ternak <span class="font-medium text-gray-700">{{ $ternak->kode_ternak }}</span></p>
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

    <form action="{{ route('ternak.update', $ternak->ternak_id) }}" method="POST"
          class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 space-y-6">
        @csrf
        @method('PUT')

        <div class="grid gap-4 md:grid-cols-2">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2" for="kode_ternak">Kode Ternak</label>
                <input id="kode_ternak" name="kode_ternak" type="text"
                       value="{{ old('kode_ternak', $ternak->kode_ternak) }}"
                       class="w-full rounded-xl border border-gray-200 px-4 py-3 text-sm focus:border-emerald-500 focus:ring-emerald-500"
                       placeholder="Contoh: TRN-001">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2" for="jenis_hewan">Jenis Hewan</label>
                <select id="jenis_hewan" name="jenis_hewan"
                        class="w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm focus:border-emerald-500 focus:ring-emerald-500">
                    <option value="">Pilih jenis hewan</option>
                    <option value="sapi"    {{ old('jenis_hewan', $ternak->jenis_hewan) === 'sapi'    ? 'selected' : '' }}>Sapi</option>
                    <option value="kambing" {{ old('jenis_hewan', $ternak->jenis_hewan) === 'kambing' ? 'selected' : '' }}>Kambing</option>
                    <option value="ayam"    {{ old('jenis_hewan', $ternak->jenis_hewan) === 'ayam'    ? 'selected' : '' }}>Ayam</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2" for="jenis_kelamin">Jenis Kelamin</label>
                <select id="jenis_kelamin" name="jenis_kelamin"
                        class="w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm focus:border-emerald-500 focus:ring-emerald-500">
                    <option value="">Pilih jenis kelamin</option>
                    <option value="jantan" {{ old('jenis_kelamin', $ternak->jenis_kelamin) === 'jantan' ? 'selected' : '' }}>Jantan</option>
                    <option value="betina" {{ old('jenis_kelamin', $ternak->jenis_kelamin) === 'betina' ? 'selected' : '' }}>Betina</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2" for="tanggal_masuk">Tanggal Masuk</label>
                <input id="tanggal_masuk" name="tanggal_masuk" type="date"
                       value="{{ old('tanggal_masuk', $ternak->tanggal_masuk) }}"
                       class="w-full rounded-xl border border-gray-200 px-4 py-3 text-sm focus:border-emerald-500 focus:ring-emerald-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2" for="status">Status</label>
                <select id="status" name="status"
                        class="w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm focus:border-emerald-500 focus:ring-emerald-500">
                    <option value="aktif"  {{ old('status', $ternak->status) === 'aktif'  ? 'selected' : '' }}>Aktif</option>
                    <option value="dijual" {{ old('status', $ternak->status) === 'dijual' ? 'selected' : '' }}>Dijual</option>
                    <option value="mati"   {{ old('status', $ternak->status) === 'mati'   ? 'selected' : '' }}>Mati</option>
                </select>
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2" for="kandang_id">Kandang (opsional)</label>
                <select id="kandang_id" name="kandang_id"
                        class="w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm focus:border-emerald-500 focus:ring-emerald-500">
                    <option value="">Pilih kandang</option>
                    @foreach($kandang as $item)
                        <option value="{{ $item->kandang_id }}"
                            {{ old('kandang_id', $ternak->kandang_id) == $item->kandang_id ? 'selected' : '' }}>
                            {{ $item->nama_kandang }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            {{-- HAPUS --}}
            <form action="{{ route('ternak.destroy', $ternak->ternak_id) }}" method="POST"
                  onsubmit="return confirm('Yakin hapus ternak {{ $ternak->kode_ternak }}?')">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="inline-flex items-center justify-center rounded-xl border border-red-200 bg-red-50 px-5 py-3 text-sm font-medium text-red-600 hover:bg-red-100">
                    Hapus Ternak
                </button>
            </form>

            <div class="flex gap-3">
                <a href="{{ route('ternak.index') }}"
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
</div>

</body>
</html>