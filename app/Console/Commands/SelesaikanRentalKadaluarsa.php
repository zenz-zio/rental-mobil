<?php

namespace App\Console\Commands;

use App\Models\Rental;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SelesaikanRentalKadaluarsa extends Command
{
    protected $signature = 'rental:selesaikan-kadaluarsa';

    protected $description = 'Otomatis mengubah status rental jadi selesai kalau tanggal & jam selesai sudah lewat';

    public function handle()
    {
        $kandidat = Rental::with(['pembayaran', 'mobil'])
            ->whereIn('status', ['disetujui', 'berjalan'])
            ->whereDate('tanggal_selesai', '<=', now()->toDateString())
            ->get();

        $selesai = 0;
        $dibatalkan = 0;

        foreach ($kandidat as $rental) {

            // Kalau jam_selesai ada, pakai itu sebagai batas waktu pasti.
            // Kalau rental lama yang belum punya jam (null), anggap batasnya akhir hari itu.
            $batasWaktu = $rental->jam_selesai
                ? Carbon::parse($rental->tanggal_selesai->format('Y-m-d') . ' ' . $rental->jam_selesai)
                : $rental->tanggal_selesai->copy()->endOfDay();

            if (now()->greaterThan($batasWaktu)) {

                $sudahBayar = $rental->pembayaran?->transaction_status === 'settlement';

                if ($rental->status === 'berjalan' || $sudahBayar) {
                    $rental->update(['status' => 'selesai']);
                    $selesai++;
                } else {
                    // disetujui tapi tidak pernah dibayar
                    $rental->update(['status' => 'dibatalkan']);
                    $dibatalkan++;
                }

                // Bebaskan mobil, sama seperti yang dilakukan admin di RentalController@update
                $rental->mobil?->update(['status' => 'tersedia']);
            }
        }

        $this->info("Selesai: {$selesai} rental, dibatalkan (tidak dibayar): {$dibatalkan} rental.");
    }
}