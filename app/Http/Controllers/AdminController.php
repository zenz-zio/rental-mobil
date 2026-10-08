<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\Pelanggan;
use App\Models\Rental;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Total semua mobil
        $totalMobil = Mobil::count();

        // Mobil yang tersedia
        $mobilTersedia = Mobil::where('status', 'tersedia')->count();

        // Mobil yang sedang disewa
        $mobilDisewa = Mobil::where('status', 'disewa')->count();

        // Total pelanggan
        $totalPelanggan = Pelanggan::count();

        // Total rental: berjalan + selesai
        $totalRental = Rental::whereIn('status', [
            'berjalan',
            'selesai'
        ])->count();

        return view('dashboard.admin.index', compact(
            'totalMobil',
            'mobilTersedia',
            'mobilDisewa',
            'totalPelanggan',
            'totalRental'
        ));
    }
}