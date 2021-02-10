<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Simpanan extends Model
{
    use HasFactory;

    protected $table = 'simpanan';

    protected $guarded = [];

    public static function getAllSimpanan()
    {
        $data = Simpanan::leftjoin('transaksi', 'simpanan.kode_transaksi', '=', 'transaksi.kode_transaksi')
                        ->leftjoin('rekening', 'transaksi.no_rekening', '=', 'rekening.no_rekening')
                        ->leftjoin('anggota', 'rekening.anggota_id', '=', 'anggota.id')
                        ->orderby('transaksi.tanggal', 'DESC')
                        ->get();

        return $data;
    }


    public static function getSimpananByKode($kode)
    {
        $data = Simpanan::leftjoin('transaksi', 'simpanan.kode_transaksi', '=', 'transaksi.kode_transaksi')
                        ->leftjoin('rekening', 'transaksi.no_rekening', '=', 'rekening.no_rekening')
                        ->leftjoin('anggota', 'rekening.anggota_id', '=', 'anggota.id')
                        ->select('simpanan.*', 'transaksi.no_rekening', 'transaksi.tanggal', 'anggota.nia', 'anggota.nama', 'anggota.tempat', 'anggota.tanggal_lahir', 'anggota.gender')
                        ->where('simpanan.kode_transaksi', $kode)
                        ->first();

        return $data;
    }

    public static function getJumlahSimpanan()
    {
        $total = Simpanan::select(DB::raw("SUM(total_simpanan) as total"))
                            ->first();

        $sim_pokok = Simpanan::select(DB::raw("SUM(sim_pokok) as total"))
                            ->first();
        
        $sim_wajib = Simpanan::select(DB::raw("SUM(sim_wajib) as total"))
                            ->first();
        
        $sim_sukarela = Simpanan::select(DB::raw("SUM(sim_sukarela) as total"))
                            ->first();

        $data = [
            'sim_pokok' => $sim_pokok->total,
            'sim_wajib' => $sim_wajib->total,
            'sim_sukarela' => $sim_sukarela->total,
            'total_simpanan' => $total->total,
        ];

        return $data;
    }

    // end
}
