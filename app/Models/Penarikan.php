<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Penarikan extends Model
{
    use HasFactory;

    protected $table = 'penarikan';

    protected $guarded = [];


    public static function getAllPenarikan()
    {
        $data = Penarikan::leftjoin('transaksi', 'penarikan.kode_transaksi', '=', 'transaksi.kode_transaksi')
                        ->leftjoin('rekening', 'transaksi.no_rekening', '=', 'rekening.no_rekening')
                        ->leftjoin('anggota', 'rekening.anggota_id', '=', 'anggota.id')
                        ->orderby('transaksi.tanggal', 'DESC')
                        ->get();

        return $data;
    }

    public static function getPenarikanByKode($kode)
    {
        $data = Penarikan::leftjoin('transaksi', 'penarikan.kode_transaksi', '=', 'transaksi.kode_transaksi')
                        ->leftjoin('rekening', 'transaksi.no_rekening', '=', 'rekening.no_rekening')
                        ->leftjoin('anggota', 'rekening.anggota_id', '=', 'anggota.id')
                        ->select('penarikan.*', 'transaksi.no_rekening', 'transaksi.tanggal', 'anggota.nia', 'anggota.nama', 'anggota.tempat', 'anggota.tanggal_lahir', 'anggota.gender')
                        ->where('penarikan.kode_transaksi', $kode)
                        ->first();

        return $data;
    }

    public static function getJumlahPenarikan()
    {
        $data = Penarikan::select(DB::raw("SUM(jumlah) as total"))->first();

        return $data;
    }

    // end
}
