<?php

namespace App\Http\Controllers;

use App\DataPakan;
use Illuminate\Http\Request;

class PakanController extends Controller
{
    public function index()
    {
        $pakan = DataPakan::latest()->paginate(10);
        return view('pakan.index', compact('pakan'));
    }

    public function create()
    {
        return view('pakan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pakan' => 'required|string|max:50',
            'stok'       => 'required|numeric|min:0',
            'satuan'     => 'required|string|max:30',
        ]);

        DataPakan::create($request->all());

        return redirect()->route('pakan.index')
                         ->with('success', 'Data pakan berhasil ditambahkan.');
    }

    public function show($id)
    {
        $pakan = DataPakan::with('pemberianPakan')->findOrFail($id);
        return view('pakan.show', compact('pakan'));
    }

    public function edit($id)
    {
        $pakan = DataPakan::findOrFail($id);
        return view('pakan.edit', compact('pakan'));
    }

    public function update(Request $request, $id)
    {
        $pakan = DataPakan::findOrFail($id);

        $request->validate([
            'nama_pakan' => 'required|string|max:50',
            'stok'       => 'required|numeric|min:0',
            'satuan'     => 'required|string|max:30',
        ]);

        $pakan->update($request->all());

        return redirect()->route('pakan.index')
                         ->with('success', 'Data pakan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pakan = DataPakan::findOrFail($id);
        $pakan->delete();

        return redirect()->route('pakan.index')
                         ->with('success', 'Data pakan berhasil dihapus.');
    }
}