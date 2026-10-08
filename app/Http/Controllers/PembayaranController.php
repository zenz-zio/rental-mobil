<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Rental;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Midtrans\Config as MidtransConfig;
use Midtrans\Snap;
use Midtrans\Notification;

class PembayaranController extends Controller
{
    /**
     * Halaman pembayaran rental
     */
    public function show(Rental $rental)
    {
        $user = Auth::user();

        // Cari pelanggan berdasarkan email user
        $pelanggan = Pelanggan::where(
            'email',
            $user->email
        )->first();

        if (!$pelanggan) {
            return redirect()
                ->route('user.rental.index')
                ->with(
                    'error',
                    'Data pelanggan Anda belum tersedia.'
                );
        }

        // Pastikan rental milik user
        if ($rental->pelanggan_id !== $pelanggan->id) {
            abort(403);
        }

        // Rental harus disetujui terlebih dahulu
        if ($rental->status !== 'disetujui') {
            return redirect()
                ->route('user.rental.index')
                ->with(
                    'error',
                    'Rental belum disetujui atau sudah tidak dapat dibayar.'
                );
        }

        // Cari pembayaran
        $pembayaran = Pembayaran::where(
            'rental_id',
            $rental->id
        )->first();

        // Kalau sudah lunas
        if (
            $pembayaran &&
            in_array($pembayaran->transaction_status, [
                'settlement',
                'capture'
            ])
        ) {
            return redirect()
                ->route('user.rental.index')
                ->with(
                    'success',
                    'Rental ini sudah berhasil dibayar.'
                );
        }

        // Konfigurasi Midtrans
        MidtransConfig::$serverKey =
            config('services.midtrans.server_key');

        MidtransConfig::$isProduction =
            config('services.midtrans.is_production', false);

        MidtransConfig::$isSanitized = true;
        MidtransConfig::$is3ds = true;

        /*
        |--------------------------------------------------------------------------
        | Buat transaksi baru
        |--------------------------------------------------------------------------
        */

        if (
            !$pembayaran ||
            in_array($pembayaran->transaction_status, [
                'expire',
                'cancel',
                'deny'
            ])
        ) {
            $orderId =
                'RENTAL-' .
                $rental->id .
                '-' .
                strtoupper(Str::random(8));

            $params = [
                'transaction_details' => [
                    'order_id' =>
                        $orderId,

                    'gross_amount' =>
                        (int) $rental->total_harga,
                ],

                'customer_details' => [
                    'first_name' =>
                        $user->name,

                    'email' =>
                        $user->email,
                ],

                'item_details' => [
                    [
                        'id' =>
                            'RENTAL-' .
                            $rental->id,

                        'price' =>
                            (int) $rental->harga_per_hari,

                        'quantity' =>
                            (int) $rental->jumlah_hari,

                        'name' =>
                            'Rental Mobil ' .
                            $rental->mobil->merk .
                            ' ' .
                            $rental->mobil->model,
                    ],
                ],
            ];

            // Buat Snap Token
            $snapToken =
                Snap::getSnapToken($params);

            // Update pembayaran lama
            if ($pembayaran) {
                $pembayaran->update([
                    'order_id' =>
                        $orderId,

                    'transaction_id' =>
                        null,

                    'gross_amount' =>
                        $rental->total_harga,

                    'payment_type' =>
                        null,

                    'transaction_status' =>
                        'pending',

                    'payment_url' =>
                        $snapToken,

                    'paid_at' =>
                        null,
                ]);
            }

            // Buat pembayaran baru
            else {
                $pembayaran =
                    Pembayaran::create([
                        'rental_id' =>
                            $rental->id,

                        'order_id' =>
                            $orderId,

                        'gross_amount' =>
                            $rental->total_harga,

                        'transaction_status' =>
                            'pending',

                        'payment_url' =>
                            $snapToken,
                    ]);
            }
        }

        // Pembayaran masih pending
        else {
            $snapToken =
                $pembayaran->payment_url;
        }

        return view(
            'dashboard.user.pembayaran.show',
            compact(
                'rental',
                'pembayaran',
                'snapToken'
            )
        );
    }


    /**
     * Notification / Webhook dari Midtrans
     */
    public function notification(Request $request)
    {
        MidtransConfig::$serverKey =
            config('services.midtrans.server_key');

        MidtransConfig::$isProduction =
            config('services.midtrans.is_production', false);

        MidtransConfig::$isSanitized = true;
        MidtransConfig::$is3ds = true;

        $notification =
            new Notification();

        $orderId =
            $notification->order_id;

        $transactionStatus =
            $notification->transaction_status;

        $fraudStatus =
            $notification->fraud_status ?? null;

        $pembayaran =
            Pembayaran::where(
                'order_id',
                $orderId
            )->first();

        if (!$pembayaran) {
            return response()->json([
                'message' =>
                    'Pembayaran tidak ditemukan.'
            ], 404);
        }

        // Update pembayaran
        $pembayaran->update([
            'transaction_id' =>
                $notification->transaction_id ?? null,

            'payment_type' =>
                $notification->payment_type ?? null,

            'transaction_status' =>
                $transactionStatus,
        ]);

        /*
        |--------------------------------------------------------------------------
        | PEMBAYARAN BERHASIL
        |--------------------------------------------------------------------------
        */

        if (
            $transactionStatus === 'settlement'
            ||
            (
                $transactionStatus === 'capture'
                &&
                $fraudStatus === 'accept'
            )
        ) {
            if (!$pembayaran->paid_at) {
                $pembayaran->update([
                    'paid_at' =>
                        now(),
                ]);
            }

            $rental =
                $pembayaran->rental;

            if ($rental) {

                // Rental menjadi berjalan
                $rental->update([
                    'status' =>
                        'berjalan',
                ]);

                // Mobil menjadi disewa
                if ($rental->mobil) {
                    $rental->mobil->update([
                        'status' =>
                            'disewa',
                    ]);
                }
            }
        }

        /*
        |--------------------------------------------------------------------------
        | CANCEL / DENY
        |--------------------------------------------------------------------------
        */

        elseif (
            $transactionStatus === 'cancel'
            ||
            $transactionStatus === 'deny'
        ) {
            $rental =
                $pembayaran->rental;

            if ($rental) {

                // Rental tetap bisa dibayar lagi
                $rental->update([
                    'status' =>
                        'disetujui',
                ]);

                // Mobil tersedia kembali
                if ($rental->mobil) {
                    $rental->mobil->update([
                        'status' =>
                            'tersedia',
                    ]);
                }
            }
        }

        /*
        |--------------------------------------------------------------------------
        | EXPIRE
        |--------------------------------------------------------------------------
        */

        elseif ($transactionStatus === 'expire') {

            $rental =
                $pembayaran->rental;

            if ($rental) {

                // Rental tetap disetujui
                $rental->update([
                    'status' =>
                        'disetujui',
                ]);

                // Mobil tersedia kembali
                if ($rental->mobil) {
                    $rental->mobil->update([
                        'status' =>
                            'tersedia',
                    ]);
                }
            }
        }

        return response()->json([
            'message' =>
                'Notification berhasil diproses.'
        ]);
    }


    /**
     * Konfirmasi pembayaran berhasil
     *
     * Dipanggil dari halaman Midtrans
     * setelah pembayaran berhasil.
     */
    public function success(
        Request $request,
        Rental $rental
    ) {
        $user =
            Auth::user();

        // Cari pelanggan berdasarkan email user
        $pelanggan =
            Pelanggan::where(
                'email',
                $user->email
            )->first();

        // Pastikan rental milik user
        if (
            !$pelanggan ||
            $rental->pelanggan_id !== $pelanggan->id
        ) {
            return response()->json([
                'success' =>
                    false,

                'message' =>
                    'Anda tidak memiliki akses ke rental ini.'
            ], 403);
        }

        // Cari pembayaran
        $pembayaran =
            Pembayaran::where(
                'rental_id',
                $rental->id
            )->first();

        if (!$pembayaran) {
            return response()->json([
                'success' =>
                    false,

                'message' =>
                    'Data pembayaran tidak ditemukan.'
            ], 404);
        }

        /*
        |--------------------------------------------------------------------------
        | PEMBAYARAN BERHASIL
        |--------------------------------------------------------------------------
        */

        $pembayaran->update([
            'transaction_status' =>
                'settlement',

            'transaction_id' =>
                $request->transaction_id
                ?? $pembayaran->transaction_id,

            'payment_type' =>
                $request->payment_type
                ?? $pembayaran->payment_type
                ?? 'qris',

            'paid_at' =>
                $pembayaran->paid_at
                ?? now(),
        ]);

        /*
        |--------------------------------------------------------------------------
        | RENTAL MENJADI BERJALAN
        |--------------------------------------------------------------------------
        */

        $rental->update([
            'status' =>
                'berjalan',
        ]);

        /*
        |--------------------------------------------------------------------------
        | MOBIL MENJADI DISEWA
        |--------------------------------------------------------------------------
        */

        if ($rental->mobil) {
            $rental->mobil->update([
                'status' =>
                    'disewa',
            ]);
        }

        return response()->json([
            'success' =>
                true,

            'message' =>
                'Pembayaran berhasil. Rental sekarang sedang berjalan.'
        ]);
    }
}