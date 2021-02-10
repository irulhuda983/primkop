<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
// use Laravel\Scout\Searchable;

class Anggota extends Model
{
    use HasFactory;

    protected $table = 'anggota';

    protected $guarded = [];

    public static function getAnggotaByRek($rekening)
    {
        $data = DB::table('anggota')
                ->join('rekening', 'anggota.id', '=', 'rekening.anggota_id')
                ->join('pangkat', 'anggota.pangkat_id', '=', 'pangkat.id')
                ->join('instansi', 'anggota.instansi_id', '=', 'instansi.id')
                ->select('anggota.*', 'rekening.no_rekening', 'rekening.status', 'pangkat.pangkat', 'instansi.instansi')
                ->where('no_rekening', $rekening)
                ->first();
        return $data;
    }

}
