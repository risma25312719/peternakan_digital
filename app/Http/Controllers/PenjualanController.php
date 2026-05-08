<?php

namespace App\Http\Controllers;

use App\Penjualan;
use App\DetailPenjualan;
use App\DataTernak;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function index()
    {
        $penjualan = Penjualan::with('detailPenjualan')->latest()->paginate(10);
        return view('penjualan.index', compact('penjualan'));
    }

    public function create()
    {
        $ternak = DataTernak::where('status', 'aktif')->get();
        return view('penjualan.create', compact('ternak'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal'     => 'required|date',
            'pembeli'     => 'required|string|max:150',
            'ternak_id'   => 'required|array|min:1',
            'ternak_id.*' => 'exists:data_ternak,ternak_id',
            'harga'       => 'required|array|min:1',
            'harga.*'     => 'required|numeric|min:0',
        ]);

        $total = array_sum($request->harga);

        $penjualan = Penjualan::create([
            'tanggal'     => $request->tanggal,
            'pembeli'     => $request->pembeli,
            'total_harga' => $total,
        ]);

        foreach ($request->ternak_id as $index => $ternakId) {
            DetailPenjualan::create([
                'penjualan_id' => $penjualan->penjualan_id,
                'ternak_id'    => $ternakId,
                'harga'        => $request->harga[$index],
            ]);

            DataTernak::where('ternak_id', $ternakId)
                      ->update(['status' => 'dijual']);
        }

        return redirect()->route('penjualan.index')
                         ->with('success', 'Transaksi penjualan berhasil disimpan.');
    }

    public function show($id)
    {
        $penjualan = Penjualan::with('detailPenjualan.dataTernak')->findOrFail($id);
        return view('penjualan.show', compact('penjualan'));
    }

    public function edit($id)
    {
        $penjualan = Penjualan::with('detailPenjualan')->findOrFail($id);
        return view('penjualan.edit', compact('penjualan'));
    }

    public function update(Request $request, $id)
    {
        $penjualan = Penjualan::findOrFail($id);

        $request->validate([
            'tanggal'     => 'required|date',
            'pembeli'     => 'required|string|max:150',
            'total_harga' => 'required|numeric|min:0',
        ]);

        $penjualan->update($request->only('tanggal', 'pembeli', 'total_harga'));

        return redirect()->route('penjualan.index')
                         ->with('success', 'Data penjualan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $penjualan = Penjualan::with('detailPenjualan')->findOrFail($id);

        // kembalikan status ternak ke aktif
        foreach ($penjualan->detailPenjualan as $detail) {
            DataTernak::where('ternak_id', $detail->ternak_id)
                      ->update(['status' => 'aktif']);
        }

        $penjualan->delete();

        return redirect()->route('penjualan.index')
                         ->with('success', 'Data penjualan berhasil dihapus.');
    }
}