<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    protected $guarded = [];

    public static function getSaldoSimpananSukarela($rekening)
    {
        $simpanan = Transaksi::rightjoin('simpanan', 'simpanan.kode_transaksi', '=', 'transaksi.kode_transaksi')
                    ->select(DB::raw("SUM(simpanan.sim_sukarela) as total_simpanan"))
                    ->where('transaksi.no_rekening', $rekening)
                    ->first();

        $penarikan = Transaksi::rightjoin('penarikan', 'penarikan.kode_transaksi', '=', 'transaksi.kode_transaksi')
                    ->select(DB::raw("SUM(penarikan.jumlah) as total_penarikan"))
                    ->where('transaksi.no_rekening', $rekening)
                    ->first();
        
        $data = (int) $simpanan->total_simpanan - (int) $penarikan->total_penarikan;
        return $data;
    }

    public static function getSaldo($rekening)
    {
        $simpanan = Transaksi::rightjoin('simpanan', 'simpanan.kode_transaksi', '=', 'transaksi.kode_transaksi')
                            ->select(DB::raw("SUM(simpanan.total_simpanan) as total_simpanan"))
                            ->where('transaksi.no_rekening', $rekening)
                            ->first();

        $potongan = Transaksi::rightjoin('potongan', 'potongan.kode_transaksi', '=', 'transaksi.kode_transaksi')
                            ->select(DB::raw("SUM(potongan.total_potongan) as total_potongan"))
                            ->where('transaksi.no_rekening', $rekening)
                            ->first();

        $penarikan = Transaksi::rightjoin('penarikan', 'penarikan.kode_transaksi', '=', 'transaksi.kode_transaksi')
                            ->select(DB::raw("SUM(penarikan.jumlah) as total_penarikan"))
                            ->where('transaksi.no_rekening', $rekening)
                            ->first();

        $total = [$simpanan->total_simpanan, $potongan->total_potongan];
        $data = [
            'simpanan' => $simpanan->total_simpanan,
            'potongan' => $potongan->total_potongan,
            'total' => array_sum($total) - $penarikan->total_penarikan,
        ];  
        return $data;
    }


    public static function setKodeTransaksi()
    {
        $last_kode = Transaksi::max('kode_transaksi');
        $arr_kode = explode('-', $last_kode);
        $id = $id = (int) end($arr_kode);
        if($id % 999 == 0){
            $id = 0;
        }
        $id++;
        $setKode = sprintf("%03s", $id);
        $kode = 'TR-'.date('dmy').'-'.$setKode;
        return $kode;
    }
    // end
}
