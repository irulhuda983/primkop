<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Potongan extends Model
{
    use HasFactory;

    protected $table = 'potongan';

    protected $guarded = [];


    public static function getAllPotongan()
    {
        $data = Potongan::leftjoin('transaksi', 'potongan.kode_transaksi', '=', 'transaksi.kode_transaksi')
                        ->leftjoin('rekening', 'transaksi.no_rekening', '=', 'rekening.no_rekening')
                        ->leftjoin('anggota', 'rekening.anggota_id', '=', 'anggota.id')
                        ->orderby('transaksi.tanggal', 'DESC')
                        ->get();

        return $data;
    }

    public static function getPotonganByKode($kode)
    {
        $data = Potongan::leftjoin('transaksi', 'potongan.kode_transaksi', '=', 'transaksi.kode_transaksi')
                        ->leftjoin('rekening', 'transaksi.no_rekening', '=', 'rekening.no_rekening')
                        ->leftjoin('anggota', 'rekening.anggota_id', '=', 'anggota.id')
                        ->select('potongan.*', 'transaksi.no_rekening', 'transaksi.tanggal', 'anggota.nia', 'anggota.nama', 'anggota.tempat', 'anggota.tanggal_lahir', 'anggota.gender')
                        ->where('potongan.kode_transaksi', $kode)
                        ->first();

        return $data;
    }


    public static function getJumlahPotongan()
    {
        $total = Potongan::select(DB::raw("SUM(total_potongan) as total"))->first();
        $pot_uang = Potongan::select(DB::raw("SUM(pot_uang) as total"))->first();
        $pot_barang = Potongan::select(DB::raw("SUM(pot_barang) as total"))->first();     
        $pot_bahan = Potongan::select(DB::raw("SUM(pot_bahan) as total"))->first();
        $pot_lain = Potongan::select(DB::raw("SUM(pot_lain) as total"))->first();

        $data = [
            'pot_uang' => $pot_uang->total,
            'pot_barang' => $pot_barang->total,
            'pot_bahan' => $pot_bahan->total,
            'pot_lain' => $pot_lain->total,
            'total_potongan' => $total->total,
        ];

        return $data;
    }
}
