<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\Pelanggan;
use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class UserMobilController extends Controller
{
        /**
     * Daftar mobil yang tersedia (dengan search, sort, filter)
     */
    public function index(Request $request)
    {
        $query = Mobil::query();

        // default: cuma tampilkan yang tersedia,
        // kecuali toggle "Hanya yang Tersedia" dimatikan
        if ($request->boolean('tersedia', true)) {
            $query->where('status', 'tersedia');
        }

        // Search merk / model
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('merk', 'like', '%' . $request->search . '%')
                  ->orWhere('model', 'like', '%' . $request->search . '%');
            });
        }

        // Filter transmisi
        if ($request->filled('transmisi')) {
            $query->where('transmisi', $request->transmisi);
        }

        // Filter tipe mobil (checkbox, bisa lebih dari satu)
        if ($request->filled('tipe')) {
            $query->whereIn('tipe_mobil', $request->tipe);
        }

        // Sort
        switch ($request->get('sort')) {
            case 'price-asc':
                $query->orderBy('harga_per_hari', 'asc');
                break;
            case 'price-desc':
                $query->orderBy('harga_per_hari', 'desc');
                break;
            case 'year-desc':
                $query->orderBy('tahun', 'desc');
                break;
            default:
                $query->latest();
        }

        $mobils = $query->get();

        return view(
            'dashboard.user.mobil.index',
            compact('mobils')
        );
    }


    /**
     * Form pengajuan rental
     */
    public function createRental(Mobil $mobil)
    {
        // Pastikan mobil masih tersedia
        if ($mobil->status !== 'tersedia') {
            return redirect()
                ->route('user.mobil.index')
                ->with(
                    'error',
                    'Mobil tersebut sedang disewa.'
                );
        }

        // Cari data pelanggan berdasarkan email user
        $pelanggan = Pelanggan::where(
            'email',
            Auth::user()->email
        )->first();

        return view(
            'dashboard.user.rental.create',
            compact(
                'mobil',
                'pelanggan'
            )
        );
    }


    /**
     * Simpan pengajuan rental dari user
     */
    public function storeRental(Request $request)
    {
        $validated = $request->validate([

    'mobil_id' =>
        'required|exists:mobils,id',

    'tanggal_mulai' =>
        'required|date|after_or_equal:today',

    'jam_mulai' =>
        'required|date_format:H:i',

    'tanggal_selesai' =>
        'required|date|after_or_equal:tanggal_mulai',

    'catatan' =>
        'nullable|string|max:1000',

]);


        // Ambil mobil
        $mobil = Mobil::findOrFail(
            $validated['mobil_id']
        );


        // Pastikan mobil masih tersedia
        if ($mobil->status !== 'tersedia') {

            return back()
                ->withErrors([
                    'mobil_id' =>
                        'Mobil tersebut sudah tidak tersedia.'
                ])
                ->withInput();

        }


        // Cari pelanggan berdasarkan email user
        $pelanggan = Pelanggan::where(
            'email',
            Auth::user()->email
        )->first();


        // User wajib memiliki data pelanggan
        if (!$pelanggan) {

            return back()
                ->with(
                    'error',
                    'Data pelanggan Anda belum tersedia.'
                )
                ->withInput();

        }


        // Hitung jumlah hari
        $mulai = Carbon::parse(
            $validated['tanggal_mulai']
        );

        $selesai = Carbon::parse(
            $validated['tanggal_selesai']
        );

        $jumlahHari =
            $mulai->diffInDays($selesai) + 1;


        // Harga rental
        $hargaPerHari =
            $mobil->harga_per_hari;


        // Total harga
        $totalHarga =
            $jumlahHari * $hargaPerHari;


        // Simpan rental
        Rental::create([

    'mobil_id' => $mobil->id,
    'pelanggan_id' => $pelanggan->id,
    'tanggal_mulai' => $validated['tanggal_mulai'],
    'jam_mulai' => $validated['jam_mulai'],
    'tanggal_selesai' => $validated['tanggal_selesai'],
    'jam_selesai' => $validated['jam_mulai'], // otomatis sama, bukan input terpisah
    'jumlah_hari' => $jumlahHari,
    'harga_per_hari' => $hargaPerHari,
    'total_harga' => $totalHarga,
    'status' => 'menunggu',
    'catatan' => $validated['catatan'] ?? null,

]);


        return redirect()
            ->route('user.rental.index')
            ->with(
                'success',
                'Pengajuan rental berhasil dikirim. Silakan tunggu persetujuan admin.'
            );
    }


    /**
     * Menampilkan rental milik user
     */
    public function rentalSaya()
{
    $pelanggan = Pelanggan::where(
        'email',
        Auth::user()->email
    )->first();

    $rentals = collect();

    if ($pelanggan) {
        $rentals = Rental::with(['mobil', 'pembayaran'])
            ->where('pelanggan_id', $pelanggan->id)
            ->latest()
            ->get();
    }

    return view(
        'dashboard.user.rental.index',
        compact('rentals')
    );
}
}