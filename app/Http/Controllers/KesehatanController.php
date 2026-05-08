<?php

namespace App\Http\Controllers;

use App\Kesehatan;
use App\DataTernak;
use Illuminate\Http\Request;

class KesehatanController extends Controller
{
    public function index()
    {
        $kesehatan = Kesehatan::with('dataTernak')->latest()->paginate(10);
        return view('kesehatan.index', compact('kesehatan'));
    }

    public function create()
    {
        $ternak = DataTernak::where('status', 'aktif')->get();
        return view('kesehatan.create', compact('ternak'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ternak_id' => 'required|exists:data_ternak,ternak_id',
            'tanggal'   => 'required|date',
            'kondisi'   => 'required|string|max:100',
            'tindakan'  => 'nullable|string',
        ]);

        Kesehatan::create($request->all());

        return redirect()->route('kesehatan.index')
                         ->with('success', 'Data kesehatan berhasil ditambahkan.');
    }

    public function show($id)
    {
        $kesehatan = Kesehatan::with('dataTernak')->findOrFail($id);
        return view('kesehatan.show', compact('kesehatan'));
    }

    public function edit($id)
    {
        $kesehatan = Kesehatan::findOrFail($id);
        $ternak    = DataTernak::where('status', 'aktif')->get();
        return view('kesehatan.edit', compact('kesehatan', 'ternak'));
    }

    public function update(Request $request, $id)
    {
        $kesehatan = Kesehatan::findOrFail($id);

        $request->validate([
            'ternak_id' => 'required|exists:data_ternak,ternak_id',
            'tanggal'   => 'required|date',
            'kondisi'   => 'required|string|max:100',
            'tindakan'  => 'nullable|string',
        ]);

        $kesehatan->update($request->all());

        return redirect()->route('kesehatan.index')
                         ->with('success', 'Data kesehatan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kesehatan = Kesehatan::findOrFail($id);
        $kesehatan->delete();

        return redirect()->route('kesehatan.index')
                         ->with('success', 'Data kesehatan berhasil dihapus.');
    }
}