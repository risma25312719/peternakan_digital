<?php

namespace App\Http\Controllers;

use App\PemberianPakan;
use App\DataTernak;
use App\DataPakan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PemberianPakanController extends Controller
{
    public function index()
    {
        $pemberian = PemberianPakan::with('dataternak', 'datapakan')->latest()->paginate(10);
        return view('pemberian_pakan.index', compact('pemberian'));
    }

    public function create()
    {
        $ternak = DataTernak::where('status', 'aktif')->get();
        $pakan  = DataPakan::where('stok', '>', 0)->get();
        return view('pemberian_pakan.create', compact('ternak', 'pakan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ternak_id' => 'required|exists:data_ternak,ternak_id',
            'pakan_id'  => 'required|exists:data_pakan,data_pakan_id',
            'tanggal'   => 'required|date',
            'jumlah'    => 'required|numeric|min:0.01',
        ]);

        $pakan = DataPakan::findOrFail($request->pakan_id);

        if ($pakan->stok < $request->jumlah) {
            return back()->withErrors([
                'jumlah' => 'Jumlah melebihi stok tersedia (' . $pakan->stok . ' ' . $pakan->satuan . ')'
            ])->withInput();
        }

        DB::transaction(function () use ($request, $pakan) {
            PemberianPakan::create($request->all());
            $pakan->decrement('stok', $request->jumlah);
        });

        return redirect()->route('pemberian-pakan.index')
                         ->with('success', 'Pemberian pakan berhasil dicatat.');
    }

    public function show($id)
    {
        $pemberian = PemberianPakan::with('dataternak', 'datapakan')->findOrFail($id);
        return view('pemberian_pakan.show', compact('pemberian'));
    }

    public function edit($id)
    {
        $pemberian = PemberianPakan::findOrFail($id);
        $ternak    = DataTernak::where('status', 'aktif')->get();
        $pakan     = DataPakan::all();
        return view('pemberian_pakan.edit', compact('pemberian', 'ternak', 'pakan'));
    }

    public function update(Request $request, $id)
    {
        $pemberian = PemberianPakan::findOrFail($id);

        $request->validate([
            'ternak_id' => 'required|exists:data_ternak,ternak_id',
            'pakan_id'  => 'required|exists:data_pakan,data_pakan_id',
            'tanggal'   => 'required|date',
            'jumlah'    => 'required|numeric|min:0.01',
        ]);

        DB::transaction(function () use ($request, $pemberian) {
            // kembalikan stok lama
            $pakanLama = DataPakan::findOrFail($pemberian->pakan_id);
            $pakanLama->increment('stok', $pemberian->jumlah);

            // cek stok baru
            $pakanBaru = DataPakan::findOrFail($request->pakan_id);
            if ($pakanBaru->stok < $request->jumlah) {
                throw new \Exception('Jumlah melebihi stok tersedia (' . $pakanBaru->stok . ' ' . $pakanBaru->satuan . ')');
            }

            $pemberian->update($request->all());
            $pakanBaru->decrement('stok', $request->jumlah);
        });

        return redirect()->route('pemberian-pakan.index')
                         ->with('success', 'Data pemberian pakan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pemberian = PemberianPakan::findOrFail($id);

        // kembalikan stok pakan
        $pakan = DataPakan::findOrFail($pemberian->pakan_id);
        $pakan->increment('stok', $pemberian->jumlah);

        $pemberian->delete();

        return redirect()->route('pemberian-pakan.index')
                         ->with('success', 'Data pemberian pakan berhasil dihapus.');
    }
}