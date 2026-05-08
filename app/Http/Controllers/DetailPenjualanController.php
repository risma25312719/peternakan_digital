<?php

namespace App\Http\Controllers;

use App\DetailPenjualan;
use App\Penjualan;
use App\DataTernak;
use Illuminate\Http\Request;

class DetailPenjualanController extends Controller
{
    public function index()
    {
        $detail = DetailPenjualan::with('penjualan', 'dataternak')->latest()->paginate(10);
        return view('detail_penjualan.index', compact('detail'));
    }

    public function create()
    {
        $penjualan = Penjualan::all();
        $ternak    = DataTernak::where('status', 'aktif')->get();
        return view('detail_penjualan.create', compact('penjualan', 'ternak'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'penjualan_id' => 'required|exists:penjualan,penjualan_id',
            'ternak_id'    => 'required|exists:data_ternak,ternak_id',
            'harga'        => 'required|numeric|min:0',
        ]);

        DetailPenjualan::create($request->all());

        // update total harga di penjualan
        $penjualan = Penjualan::findOrFail($request->penjualan_id);
        $total     = DetailPenjualan::where('penjualan_id', $penjualan->penjualan_id)->sum('harga');
        $penjualan->update(['total_harga' => $total]);

        // update status ternak jadi dijual
        DataTernak::where('ternak_id', $request->ternak_id)
                  ->update(['status' => 'dijual']);

        return redirect()->route('detail-penjualan.index')
                         ->with('success', 'Detail penjualan berhasil ditambahkan.');
    }

    public function show($id)
    {
        $detail = DetailPenjualan::with('penjualan', 'dataternak')->findOrFail($id);
        return view('detail_penjualan.show', compact('detail'));
    }

    public function edit($id)
    {
        $detail    = DetailPenjualan::findOrFail($id);
        $penjualan = Penjualan::all();
        $ternak    = DataTernak::where('status', 'aktif')->get();
        return view('detail_penjualan.edit', compact('detail', 'penjualan', 'ternak'));
    }

    public function update(Request $request, $id)
    {
        $detail = DetailPenjualan::findOrFail($id);

        $request->validate([
            'penjualan_id' => 'required|exists:penjualan,penjualan_id',
            'ternak_id'    => 'required|exists:data_ternak,ternak_id',
            'harga'        => 'required|numeric|min:0',
        ]);

        // kembalikan status ternak lama ke aktif
        DataTernak::where('ternak_id', $detail->ternak_id)
                  ->update(['status' => 'aktif']);

        $detail->update($request->all());

        // update status ternak baru ke dijual
        DataTernak::where('ternak_id', $request->ternak_id)
                  ->update(['status' => 'dijual']);

        // recalculate total harga penjualan
        $penjualan = Penjualan::findOrFail($request->penjualan_id);
        $total     = DetailPenjualan::where('penjualan_id', $penjualan->penjualan_id)->sum('harga');
        $penjualan->update(['total_harga' => $total]);

        return redirect()->route('detail-penjualan.index')
                         ->with('success', 'Detail penjualan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $detail = DetailPenjualan::findOrFail($id);

        // kembalikan status ternak ke aktif
        DataTernak::where('ternak_id', $detail->ternak_id)
                  ->update(['status' => 'aktif']);

        // recalculate total harga penjualan
        $penjualan = Penjualan::findOrFail($detail->penjualan_id);
        $detail->delete();
        $total = DetailPenjualan::where('penjualan_id', $penjualan->penjualan_id)->sum('harga');
        $penjualan->update(['total_harga' => $total]);

        return redirect()->route('detail-penjualan.index')
                         ->with('success', 'Detail penjualan berhasil dihapus.');
    }
}