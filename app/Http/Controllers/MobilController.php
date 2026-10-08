<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use Illuminate\Http\Request;

class MobilController extends Controller
{
    public function index()
{
    $mobils = Mobil::latest()->get();

    return view('dashboard.admin.mobil.index', compact('mobils'));
}

    public function create()
    {
        return view('dashboard.admin.mobil.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'merk' => 'required|string|max:100',
            'model' => 'required|string|max:100',
            'no_plat' => 'required|string|max:20|unique:mobils,no_plat',
            'tahun' => 'required|digits:4',
            'harga_per_hari' => 'required|numeric|min:0',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'required|in:tersedia,disewa',
        ]);

        $data = $request->only([
            'merk',
            'model',
            'no_plat',
            'tahun',
            'harga_per_hari',
            'status',
        ]);

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $namaFoto = time() . '_' . $foto->getClientOriginalName();

            $foto->move(
                public_path('uploads/mobil'),
                $namaFoto
            );

            $data['foto'] = $namaFoto;
        }

        Mobil::create($data);

        return redirect()
            ->route('admin.mobil.index')
            ->with('success', 'Data mobil berhasil ditambahkan.');
    }

    public function edit(Mobil $mobil)
    {
        return view('dashboard.admin.mobil.edit', compact('mobil'));
    }

    public function update(Request $request, Mobil $mobil)
    {
       $request->validate([
    'merk' => 'required|string|max:100',
    'model' => 'required|string|max:100',
    'no_plat' => 'required|string|max:20|unique:mobils,no_plat,' . $mobil->id,
    'tahun' => 'required|digits:4',
    'transmisi' => 'required|in:Matic,Manual',
    'tipe_mobil' => 'nullable|in:City Car,Sedan,SUV,MPV',
    'harga_per_hari' => 'required|numeric|min:0',
    'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    'status' => 'required|in:tersedia,disewa',
    'deskripsi' => 'nullable|string|max:2000',
]);

$data = $request->only([
    'merk',
    'model',
    'no_plat',
    'tahun',
    'transmisi',
    'tipe_mobil',
    'harga_per_hari',
    'status',
    'deskripsi',
]);

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $namaFoto = time() . '_' . $foto->getClientOriginalName();

            $foto->move(
                public_path('uploads/mobil'),
                $namaFoto
            );

            $data['foto'] = $namaFoto;
        }

        $mobil->update($data);

        return redirect()
            ->route('admin.mobil.index')
            ->with('success', 'Data mobil berhasil diperbarui.');
    }

    public function destroy(Mobil $mobil)
    {
        $mobil->delete();

        return redirect()
            ->route('admin.mobil.index')
            ->with('success', 'Data mobil berhasil dihapus.');
    }
}