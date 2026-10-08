<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function dashboard()
    {
        $pelanggan = Pelanggan::where(
            'email',
            Auth::user()->email
        )->first();

        $totalRental = 0;
        $rentalAktif = 0;
        $rentalSelesai = 0;

        if ($pelanggan) {

            $totalRental = Rental::where('pelanggan_id', $pelanggan->id)
                ->count();

            $rentalAktif = Rental::where('pelanggan_id', $pelanggan->id)
                ->whereIn('status', ['menunggu', 'disetujui', 'berjalan'])
                ->count();

            $rentalSelesai = Rental::where('pelanggan_id', $pelanggan->id)
                ->where('status', 'selesai')
                ->count();

        }

        return view(
            'dashboard.user.index',
            compact('totalRental', 'rentalAktif', 'rentalSelesai')
        );
    }

    // Profil user
    public function profil()
    {
        $pelanggan = Pelanggan::where(
            'email',
            Auth::user()->email
        )->first();

        return view(
            'dashboard.user.profil',
            compact('pelanggan')
        );
    }

    public function updateProfil(Request $request)
    {
        $pelanggan = Pelanggan::where(
            'email',
            Auth::user()->email
        )->firstOrFail();

        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'nik' => 'required|string|size:16|unique:pelanggans,nik,' . $pelanggan->id,
            'no_hp' => 'required|string|min:10|max:13',
            'alamat' => 'required|string|max:500',
        ], [
            'nik.size' => 'NIK harus 16 digit.',
            'nik.unique' => 'NIK sudah digunakan.',
            'no_hp.min' => 'Nomor HP minimal 10 digit.',
            'no_hp.max' => 'Nomor HP maksimal 13 digit.',
        ]);

        $pelanggan->update($validated);

        return back()->with(
            'success',
            'Profil berhasil diperbarui.'
        );
    }
}