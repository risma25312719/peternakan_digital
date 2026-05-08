<?php

namespace App\Http\Controllers;

use App\DataTernak;
use App\Kandang;
use Illuminate\Http\Request;

class TernakController extends Controller
{
    public function index()
    {
        $ternak = DataTernak::with('kandang')->latest()->paginate(10);
        return view('ternak.index', compact('ternak'));
    }

    public function create()
    {
        $kandang = Kandang::all();
        return view('ternak.create', compact('kandang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_ternak'   => 'required|string|max:50|unique:data_ternak,kode_ternak',
            'jenis_hewan'   => 'required|in:sapi,kambing,ayam',
            'jenis_kelamin' => 'required|in:jantan,betina',
            'tanggal_masuk' => 'required|date',
            'status'        => 'required|in:aktif,dijual,mati',
            'kandang_id'    => 'nullable|exists:kandang,kandang_id',
        ]);

        DataTernak::create($request->all());

        return redirect()->route('ternak.index')
                         ->with('success', 'Ternak berhasil ditambahkan.');
    }

    public function show($id)
    {
        $ternak = DataTernak::with('kandang', 'kesehatan', 'pemberianPakan')
                            ->findOrFail($id);
        return view('ternak.show', compact('ternak'));
    }

    public function edit($id)
    {
        $ternak  = DataTernak::findOrFail($id);
        $kandang = Kandang::all();
        return view('ternak.edit', compact('ternak', 'kandang'));
    }

    public function update(Request $request, $id)
    {
        $ternak = DataTernak::findOrFail($id);

        $request->validate([
            'kode_ternak'   => 'required|string|max:50|unique:data_ternak,kode_ternak,' . $id . ',ternak_id',
            'jenis_hewan'   => 'required|in:sapi,kambing,ayam',
            'jenis_kelamin' => 'required|in:jantan,betina',
            'tanggal_masuk' => 'required|date',
            'status'        => 'required|in:aktif,dijual,mati',
            'kandang_id'    => 'nullable|exists:kandang,kandang_id',
        ]);

        $ternak->update($request->all());

        return redirect()->route('ternak.index')
                         ->with('success', 'Data ternak berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $ternak = DataTernak::findOrFail($id);
        $ternak->delete();

        return redirect()->route('ternak.index')
                         ->with('success', 'Ternak berhasil dihapus.');
    }
}