<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Instansi;
use App\Models\Penarikan;
use App\Models\Potongan;
use App\Models\Simpanan;
use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Exports\TransaksiExport;
use App\Exports\TransaksiKesatuanExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{

    public function index(Request $request)
    {
        if(!$request->bulan){
            $bulan = date('n');
        }else{
            $bulan = $request->bulan;
        }

        if(!$request->tahun){
            $tahun = date('Y');
        }else{
            $tahun = $request->tahun;
        }

        $instansi = Instansi::all();
        return view('dashboard.report.index', compact('instansi', 'bulan', 'tahun'));
    }

    public function showBykesatuan(Request $request)
    {
        $idKesatuan = $request->kesatuan;
        if(!$request->bulan){
            $bulan = date('n');
        }else{
            $bulan = $request->bulan;
        }

        if(!$request->tahun){
            $tahun = date('Y');
        }else{
            $tahun = $request->tahun;
        }

        $anggota = Anggota::where('instansi_id', $idKesatuan)->get();
        return view('dashboard.report.kesatuan', compact('anggota', 'bulan', 'tahun', 'idKesatuan'));
    }

    public function export(Request $request) 
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $bulan_lengkap = ['', 'January', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'November', 'Desember'];
        return Excel::download(new TransaksiExport($bulan, $tahun), 'Laporan Kesatuan-'.$bulan_lengkap[$bulan].'-'.$tahun.'.xlsx');
    }

    public function exportbyKesatuan(Request $request) 
    {
        $kesatuan = $request->kesatuan;
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $bulan_lengkap = ['', 'January', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'November', 'Desember'];
        $nama_kesatuan = Instansi::where('id', $kesatuan)->first();
        return Excel::download(new TransaksiKesatuanExport($kesatuan, $bulan, $tahun), 'Laporan Anggota '.$nama_kesatuan->instansi.'-'.$bulan_lengkap[$bulan].'-'.$tahun.'.xlsx');
    }

    public static function simPokok($instansi, $bulan, $tahun)
    {
        $data = Transaksi::leftjoin('simpanan', 'simpanan.kode_transaksi', '=', 'transaksi.kode_transaksi')
                        ->leftjoin('rekening', 'rekening.no_rekening', '=', 'transaksi.no_rekening')
                        ->leftjoin('anggota', 'anggota.id', '=', 'rekening.anggota_id')
                        ->select(DB::raw("SUM(simpanan.sim_pokok) as total"))
                        ->where('anggota.instansi_id', $instansi)
                        ->whereMonth('transaksi.tanggal', $bulan)
                        ->whereYear('transaksi.tanggal', $tahun)
                        ->first();

        
        return $data['total'];
    }

    public static function simWajib($instansi, $bulan, $tahun)
    {
        $data = Transaksi::leftjoin('simpanan', 'simpanan.kode_transaksi', '=', 'transaksi.kode_transaksi')
                        ->leftjoin('rekening', 'rekening.no_rekening', '=', 'transaksi.no_rekening')
                        ->leftjoin('anggota', 'anggota.id', '=', 'rekening.anggota_id')
                        ->select(DB::raw("SUM(simpanan.sim_wajib) as total"))
                        ->where('anggota.instansi_id', $instansi)
                        ->whereMonth('transaksi.tanggal', $bulan)
                        ->whereYear('transaksi.tanggal', $tahun)
                        ->first();

        
        return $data['total'];
    }

    public static function simSukarela($instansi, $bulan, $tahun)
    {
        $data = Transaksi::leftjoin('simpanan', 'simpanan.kode_transaksi', '=', 'transaksi.kode_transaksi')
                        ->leftjoin('rekening', 'rekening.no_rekening', '=', 'transaksi.no_rekening')
                        ->leftjoin('anggota', 'anggota.id', '=', 'rekening.anggota_id')
                        ->select(DB::raw("SUM(simpanan.sim_sukarela) as total"))
                        ->where('anggota.instansi_id', $instansi)
                        ->whereMonth('transaksi.tanggal', $bulan)
                        ->whereYear('transaksi.tanggal', $tahun)
                        ->first();

        
        return $data['total'];
    }

    public static function potUang($instansi, $bulan, $tahun)
    {
        $data = Transaksi::leftjoin('potongan', 'potongan.kode_transaksi', '=', 'transaksi.kode_transaksi')
                        ->leftjoin('rekening', 'rekening.no_rekening', '=', 'transaksi.no_rekening')
                        ->leftjoin('anggota', 'anggota.id', '=', 'rekening.anggota_id')
                        ->select(DB::raw("SUM(potongan.pot_uang) as total"))
                        ->where('anggota.instansi_id', $instansi)
                        ->whereMonth('transaksi.tanggal', $bulan)
                        ->whereYear('transaksi.tanggal', $tahun)
                        ->first();

        
        return $data['total'];
    }

    public static function potBarang($instansi, $bulan, $tahun)
    {
        $data = Transaksi::leftjoin('potongan', 'potongan.kode_transaksi', '=', 'transaksi.kode_transaksi')
                        ->leftjoin('rekening', 'rekening.no_rekening', '=', 'transaksi.no_rekening')
                        ->leftjoin('anggota', 'anggota.id', '=', 'rekening.anggota_id')
                        ->select(DB::raw("SUM(potongan.pot_barang) as total"))
                        ->where('anggota.instansi_id', $instansi)
                        ->whereMonth('transaksi.tanggal', $bulan)
                        ->whereYear('transaksi.tanggal', $tahun)
                        ->first();

        
        return $data['total'];
    }

    public static function potBahan($instansi, $bulan, $tahun)
    {
        $data = Transaksi::leftjoin('potongan', 'potongan.kode_transaksi', '=', 'transaksi.kode_transaksi')
                        ->leftjoin('rekening', 'rekening.no_rekening', '=', 'transaksi.no_rekening')
                        ->leftjoin('anggota', 'anggota.id', '=', 'rekening.anggota_id')
                        ->select(DB::raw("SUM(potongan.pot_bahan) as total"))
                        ->where('anggota.instansi_id', $instansi)
                        ->whereMonth('transaksi.tanggal', $bulan)
                        ->whereYear('transaksi.tanggal', $tahun)
                        ->first();

        
        return $data['total'];
    }

    public static function PotLain($instansi, $bulan, $tahun)
    {
        $data = Transaksi::leftjoin('potongan', 'potongan.kode_transaksi', '=', 'transaksi.kode_transaksi')
                        ->leftjoin('rekening', 'rekening.no_rekening', '=', 'transaksi.no_rekening')
                        ->leftjoin('anggota', 'anggota.id', '=', 'rekening.anggota_id')
                        ->select(DB::raw("SUM(potongan.pot_lain) as total"))
                        ->where('anggota.instansi_id', $instansi)
                        ->whereMonth('transaksi.tanggal', $bulan)
                        ->whereYear('transaksi.tanggal', $tahun)
                        ->first();

        
        return $data['total'];
    }

    // by anggota
    public static function simAnggotaPokok($anggota, $bulan, $tahun)
    {
        $data = Transaksi::leftjoin('simpanan', 'simpanan.kode_transaksi', '=', 'transaksi.kode_transaksi')
                        ->leftjoin('rekening', 'rekening.no_rekening', '=', 'transaksi.no_rekening')
                        ->leftjoin('anggota', 'anggota.id', '=', 'rekening.anggota_id')
                        ->select(DB::raw("SUM(simpanan.sim_pokok) as total"))
                        ->where('anggota.id', $anggota)
                        ->whereMonth('transaksi.tanggal', $bulan)
                        ->whereYear('transaksi.tanggal', $tahun)
                        ->first();

        
        return $data['total'];
    }

    public static function simAnggotaWajib($anggota, $bulan, $tahun)
    {
        $data = Transaksi::leftjoin('simpanan', 'simpanan.kode_transaksi', '=', 'transaksi.kode_transaksi')
                        ->leftjoin('rekening', 'rekening.no_rekening', '=', 'transaksi.no_rekening')
                        ->leftjoin('anggota', 'anggota.id', '=', 'rekening.anggota_id')
                        ->select(DB::raw("SUM(simpanan.sim_wajib) as total"))
                        ->where('anggota.id', $anggota)
                        ->whereMonth('transaksi.tanggal', $bulan)
                        ->whereYear('transaksi.tanggal', $tahun)
                        ->first();

        
        return $data['total'];
    }

    public static function simAnggotaSukarela($anggota, $bulan, $tahun)
    {
        $data = Transaksi::leftjoin('simpanan', 'simpanan.kode_transaksi', '=', 'transaksi.kode_transaksi')
                        ->leftjoin('rekening', 'rekening.no_rekening', '=', 'transaksi.no_rekening')
                        ->leftjoin('anggota', 'anggota.id', '=', 'rekening.anggota_id')
                        ->select(DB::raw("SUM(simpanan.sim_sukarela) as total"))
                        ->where('anggota.id', $anggota)
                        ->whereMonth('transaksi.tanggal', $bulan)
                        ->whereYear('transaksi.tanggal', $tahun)
                        ->first();

        
        return $data['total'];
    }

    public static function potAnggotaUang($anggota, $bulan, $tahun)
    {
        $data = Transaksi::leftjoin('potongan', 'potongan.kode_transaksi', '=', 'transaksi.kode_transaksi')
                        ->leftjoin('rekening', 'rekening.no_rekening', '=', 'transaksi.no_rekening')
                        ->leftjoin('anggota', 'anggota.id', '=', 'rekening.anggota_id')
                        ->select(DB::raw("SUM(potongan.pot_uang) as total"))
                        ->where('anggota.id', $anggota)
                        ->whereMonth('transaksi.tanggal', $bulan)
                        ->whereYear('transaksi.tanggal', $tahun)
                        ->first();

        
        return $data['total'];
    }

    public static function potAnggotaBarang($anggota, $bulan, $tahun)
    {
        $data = Transaksi::leftjoin('potongan', 'potongan.kode_transaksi', '=', 'transaksi.kode_transaksi')
                        ->leftjoin('rekening', 'rekening.no_rekening', '=', 'transaksi.no_rekening')
                        ->leftjoin('anggota', 'anggota.id', '=', 'rekening.anggota_id')
                        ->select(DB::raw("SUM(potongan.pot_barang) as total"))
                        ->where('anggota.id', $anggota)
                        ->whereMonth('transaksi.tanggal', $bulan)
                        ->whereYear('transaksi.tanggal', $tahun)
                        ->first();

        
        return $data['total'];
    }

    public static function potAnggotaBahan($anggota, $bulan, $tahun)
    {
        $data = Transaksi::leftjoin('potongan', 'potongan.kode_transaksi', '=', 'transaksi.kode_transaksi')
                        ->leftjoin('rekening', 'rekening.no_rekening', '=', 'transaksi.no_rekening')
                        ->leftjoin('anggota', 'anggota.id', '=', 'rekening.anggota_id')
                        ->select(DB::raw("SUM(potongan.pot_bahan) as total"))
                        ->where('anggota.id', $anggota)
                        ->whereMonth('transaksi.tanggal', $bulan)
                        ->whereYear('transaksi.tanggal', $tahun)
                        ->first();

        
        return $data['total'];
    }

    public static function PotAnggotaLain($anggota, $bulan, $tahun)
    {
        $data = Transaksi::leftjoin('potongan', 'potongan.kode_transaksi', '=', 'transaksi.kode_transaksi')
                        ->leftjoin('rekening', 'rekening.no_rekening', '=', 'transaksi.no_rekening')
                        ->leftjoin('anggota', 'anggota.id', '=', 'rekening.anggota_id')
                        ->select(DB::raw("SUM(potongan.pot_lain) as total"))
                        ->where('anggota.id', $anggota)
                        ->whereMonth('transaksi.tanggal', $bulan)
                        ->whereYear('transaksi.tanggal', $tahun)
                        ->first();

        
        return $data['total'];
    }

// end

}
