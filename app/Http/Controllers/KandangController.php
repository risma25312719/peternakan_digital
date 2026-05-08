<?php

namespace App\Http\Controllers;

use App\Kandang;
use Illuminate\Http\Request;

class KandangController extends Controller
{
    public function index()
    {
        $kandang = Kandang::withCount('dataTernak')->latest()->paginate(10);
        return view('kandang.index', compact('kandang'));
    }

    public function create()
    {
        return view('kandang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kandang' => 'required|string|max:50',
            'kapasitas'    => 'required|integer|min:1',
            'lokasi'       => 'nullable|string|max:30',
        ]);

        Kandang::create($request->all());

        return redirect()->route('kandang.index')
                         ->with('success', 'Kandang berhasil ditambahkan.');
    }

    public function show($id)
    {
        $kandang = Kandang::with('dataTernak')->findOrFail($id);
        return view('kandang.show', compact('kandang'));
    }

    public function edit($id)
    {
        $kandang = Kandang::findOrFail($id);
        return view('kandang.edit', compact('kandang'));
    }

    public function update(Request $request, $id)
    {
        $kandang = Kandang::findOrFail($id);

        $request->validate([
            'nama_kandang' => 'required|string|max:50',
            'kapasitas'    => 'required|integer|min:1',
            'lokasi'       => 'nullable|string|max:30',
        ]);

        $kandang->update($request->all());

        return redirect()->route('kandang.index')
                         ->with('success', 'Data kandang berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kandang = Kandang::findOrFail($id);
        $kandang->delete();

        return redirect()->route('kandang.index')
                         ->with('success', 'Kandang berhasil dihapus.');
    }
}