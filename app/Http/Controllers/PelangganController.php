<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggans = Pelanggan::latest()->get();

        return view('dashboard.admin.pelanggan.index', compact('pelanggans'));
    }

    public function create()
    {
        return view('dashboard.admin.pelanggan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'nik' => 'required|string|max:20|unique:pelanggans,nik',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string',
            'email' => 'nullable|email|max:255',
        ]);

        Pelanggan::create([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'email' => $request->email,
        ]);

        return redirect()
            ->route('admin.pelanggan.index')
            ->with('success', 'Data pelanggan berhasil ditambahkan.');
    }

    public function edit(Pelanggan $pelanggan)
    {
        return view(
            'dashboard.admin.pelanggan.edit',
            compact('pelanggan')
        );
    }

    public function update(Request $request, Pelanggan $pelanggan)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'nik' => 'required|string|max:20|unique:pelanggans,nik,' . $pelanggan->id,
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string',
            'email' => 'nullable|email|max:255',
        ]);

        $pelanggan->update([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'email' => $request->email,
        ]);

        return redirect()
            ->route('admin.pelanggan.index')
            ->with('success', 'Data pelanggan berhasil diperbarui.');
    }

    public function destroy(Pelanggan $pelanggan)
    {
        $pelanggan->delete();

        return redirect()
            ->route('admin.pelanggan.index')
            ->with('success', 'Data pelanggan berhasil dihapus.');
    }
}