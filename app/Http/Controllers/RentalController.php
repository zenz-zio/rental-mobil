<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\Mobil;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RentalController extends Controller
{
    /**
     * Daftar semua rental
     */
    public function index()
    {
        $rentals = Rental::with([
            'mobil',
            'pelanggan',
            'pembayaran',
        ])
        ->latest()
        ->get();

        return view(
            'dashboard.admin.rental.index',
            compact('rentals')
        );
    }

    /**
     * Form tambah rental oleh admin
     */
    public function create()
    {
        $mobils = Mobil::where('status', 'tersedia')->get();

        $pelanggans = Pelanggan::latest()->get();

        return view(
            'dashboard.admin.rental.create',
            compact('mobils', 'pelanggans')
        );
    }

    /**
     * Simpan rental dari admin
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'mobil_id' => 'required|exists:mobils,id',
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'catatan' => 'nullable|string',
        ]);

        $mobil = Mobil::findOrFail($validated['mobil_id']);

        // Pastikan mobil tersedia
        if ($mobil->status !== 'tersedia') {
            return back()
                ->withErrors([
                    'mobil_id' => 'Mobil tersebut sedang disewa.'
                ])
                ->withInput();
        }

        // Hitung jumlah hari
        $mulai = Carbon::parse($validated['tanggal_mulai']);
        $selesai = Carbon::parse($validated['tanggal_selesai']);

        $jumlahHari = $mulai->diffInDays($selesai) + 1;

        // Hitung total harga
        $hargaPerHari = $mobil->harga_per_hari;
        $totalHarga = $jumlahHari * $hargaPerHari;

        Rental::create([
            'mobil_id' => $mobil->id,
            'pelanggan_id' => $validated['pelanggan_id'],
            'tanggal_mulai' => $validated['tanggal_mulai'],
            'tanggal_selesai' => $validated['tanggal_selesai'],
            'jumlah_hari' => $jumlahHari,
            'harga_per_hari' => $hargaPerHari,
            'total_harga' => $totalHarga,

            // Rental baru dari admin dianggap sudah disetujui,
            // tetapi belum berjalan karena belum dibayar.
            'status' => 'disetujui',

            'catatan' => $validated['catatan'] ?? null,
        ]);

        /*
        |--------------------------------------------------------------------------
        | PENTING
        |--------------------------------------------------------------------------
        | Jangan ubah mobil menjadi "disewa" di sini.
        |
        | Mobil baru menjadi "disewa" setelah pembayaran berhasil
        | melalui PembayaranController.
        */

        return redirect()
            ->route('admin.rental.index')
            ->with(
                'success',
                'Rental berhasil ditambahkan dan menunggu pembayaran pelanggan.'
            );
    }

    /**
     * Detail rental
     */
    public function show(Rental $rental)
    {
        $rental->load([
            'mobil',
            'pelanggan',
            'pembayaran',
        ]);

        return view(
            'dashboard.admin.rental.show',
            compact('rental')
        );
    }

    /**
     * Form edit rental
     */
    public function edit(Rental $rental)
    {
        $mobils = Mobil::all();

        $pelanggans = Pelanggan::all();

        return view(
            'dashboard.admin.rental.edit',
            compact(
                'rental',
                'mobils',
                'pelanggans'
            )
        );
    }

    /**
     * Update rental
     */
    public function update(Request $request, Rental $rental)
    {
        $validated = $request->validate([
            'mobil_id' => 'required|exists:mobils,id',
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'status' => 'required|in:menunggu,disetujui,berjalan,selesai,dibatalkan',
            'catatan' => 'nullable|string',
        ]);

        $mulai = Carbon::parse($validated['tanggal_mulai']);
        $selesai = Carbon::parse($validated['tanggal_selesai']);

        $jumlahHari = $mulai->diffInDays($selesai) + 1;

        $mobilBaru = Mobil::findOrFail($validated['mobil_id']);

        /*
        |--------------------------------------------------------------------------
        | Kalau mobil rental sebelumnya berbeda
        |--------------------------------------------------------------------------
        */

        if (
            $rental->mobil_id != $mobilBaru->id &&
            $rental->mobil
        ) {
            $rental->mobil->update([
                'status' => 'tersedia',
            ]);
        }

        $totalHarga =
            $jumlahHari * $mobilBaru->harga_per_hari;

        $rental->update([
            'mobil_id' => $mobilBaru->id,
            'pelanggan_id' => $validated['pelanggan_id'],
            'tanggal_mulai' => $validated['tanggal_mulai'],
            'tanggal_selesai' => $validated['tanggal_selesai'],
            'jumlah_hari' => $jumlahHari,
            'harga_per_hari' => $mobilBaru->harga_per_hari,
            'total_harga' => $totalHarga,
            'status' => $validated['status'],
            'catatan' => $validated['catatan'] ?? null,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Status mobil mengikuti status rental
        |--------------------------------------------------------------------------
        */

        if ($validated['status'] === 'berjalan') {

            // Rental sudah dibayar dan sedang berjalan
            $mobilBaru->update([
                'status' => 'disewa',
            ]);

        } elseif (
            $validated['status'] === 'selesai' ||
            $validated['status'] === 'dibatalkan'
        ) {

            // Rental selesai / dibatalkan
            $mobilBaru->update([
                'status' => 'tersedia',
            ]);

        } else {

            // Menunggu persetujuan / menunggu pembayaran
            $mobilBaru->update([
                'status' => 'tersedia',
            ]);
        }

        return redirect()
            ->route('admin.rental.index')
            ->with(
                'success',
                'Data rental berhasil diperbarui.'
            );
    }

    /**
     * Hapus rental
     */
    public function destroy(Rental $rental)
    {
        $mobil = $rental->mobil;

        $rental->delete();

        // Mobil kembali tersedia
        if ($mobil) {
            $mobil->update([
                'status' => 'tersedia',
            ]);
        }

        return redirect()
            ->route('admin.rental.index')
            ->with(
                'success',
                'Data rental berhasil dihapus.'
            );
    }
}