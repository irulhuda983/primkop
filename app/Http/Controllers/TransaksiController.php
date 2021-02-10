<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Transaksi;
use App\Models\Rekening;
use App\Models\Simpanan;
use App\Models\Potongan;
use App\Models\Penarikan;
use App\Models\Anggota;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{


    public function index()
    {
        $rekening = Rekening::join('anggota', 'rekening.anggota_id', '=', 'anggota.id')->get();
        return view('dashboard.transaksi.index', compact('rekening'));
    }


    public function getAnggota(Request $request)
    {
        $anggota = Anggota::getAnggotaByRek($request->rekening);
        $kode = Transaksi::setKodeTransaksi();
        $saldoSimpanan = Transaksi::getSaldoSimpananSukarela($request->rekening);
        $data = [
            'anggota' => $anggota,
            'kode' => $kode,
            'saldo_simpanan_sukarela' => $saldoSimpanan
        ];
        return response()->json($data);
    }

    public function create(Request $request)
    {
        $data = Anggota::getAnggotaByRek($request->rekening);
        $saldo = Transaksi::getSaldo($request->rekening);
        $trans = Transaksi::leftjoin('simpanan', 'simpanan.kode_transaksi', '=', 'transaksi.kode_transaksi')
                            ->leftjoin('potongan', 'potongan.kode_transaksi', '=', 'transaksi.kode_transaksi')
                            ->leftjoin('penarikan', 'penarikan.kode_transaksi', '=', 'transaksi.kode_transaksi')
                            ->select('transaksi.*', 'simpanan.total_simpanan', 'potongan.total_potongan', 'penarikan.jumlah')
                            ->where('transaksi.no_rekening', $request->rekening)
                            ->orderByDesc('transaksi.tanggal')
                            ->limit(4)
                            ->get();
        
        return view('dashboard.transaksi.create', compact('data', 'trans', 'saldo'));
    }


    public function setor(Request $request)
    {
        $data = Anggota::getAnggotaByRek($request->rekening);
        $kode = Transaksi::setKodeTransaksi();
        $total = (int) $request->sim_pokok+ (int) $request->sim_wajib + (int) $request->sim_sukarela;
        if($request->keterangan == ""){
            $ket = 'Pembayaran Simpanan Anggota '. $data->nama;
        }else{
            $ket = $request->keterangan;
        }

        $rek = Transaksi::create([
            'kode_transaksi' => $kode,
            'no_rekening' => $data->no_rekening,
            'jenis_transaksi' => 'simpanan',
            'tanggal' => now(),
            'keterangan' => $ket,
        ]);

        if($rek->wasRecentlyCreated){
            Simpanan::create([
                'kode_transaksi' => $kode,
                'sim_pokok' => $request->sim_pokok,
                'sim_wajib' => $request->sim_wajib,
                'sim_sukarela' => $request->sim_sukarela,
                'total_simpanan' => $total,
            ]);

            return redirect('/transaksi/'.$data->no_rekening)->with('notif', 'Berhasil melakukan setoran simpanan.');
        }


        
    }

    public function potongan(Request $request)
    {
        $data = Anggota::getAnggotaByRek($request->rekening);
        $kode = Transaksi::setKodeTransaksi();
        $total = (int) $request->pot_uang + (int) $request->pot_barang + (int) $request->pot_bahan + (int) $request->pot_lain;
        if($request->keterangan == ""){
            $ket = 'Pembayaran Potongan Anggota '. $data->nama;
        }else{
            $ket = $request->keterangan;
        }

        $rek = Transaksi::create([
            'kode_transaksi' => $kode,
            'no_rekening' => $data->no_rekening,
            'jenis_transaksi' => 'potongan',
            'tanggal' => now(),
            'keterangan' => $ket,
        ]);

        if($rek->wasRecentlyCreated){
            Potongan::create([
                'kode_transaksi' => $kode,
                'pot_uang' => $request->pot_uang,
                'pot_barang' => $request->pot_barang,
                'pot_bahan' => $request->pot_bahan,
                'pot_lain' => $request->pot_lain,
                'total_potongan' => $total,
            ]);

            return redirect('/transaksi/'.$data->no_rekening)->with('notif', 'Berhasil melakukan setoran simpanan.');
        }
        // end
    }


    public function tarik(Request $request)
    {
        $data = Anggota::getAnggotaByRek($request->rekening);
        $kode = Transaksi::setKodeTransaksi();
        $total = (int) $request->total;
        if($request->keterangan == ""){
            $ket = 'Penarikan Simpanan Sukarela Anggota '. $data->nama;
        }else{
            $ket = $request->keterangan;
        }

        $rek = Transaksi::create([
            'kode_transaksi' => $kode,
            'no_rekening' => $data->no_rekening,
            'jenis_transaksi' => 'penarikan',
            'tanggal' => now(),
            'keterangan' => $ket,
        ]);

        if($rek->wasRecentlyCreated){
            Penarikan::create([
                'kode_transaksi' => $kode,
                'jumlah' => $total,
            ]);

            return redirect('/transaksi/'.$data->no_rekening)->with('notif', 'Berhasil melakukan setoran simpanan.');
        }
        // end
    }


    public function saldo(Request $request)
    {
        dd(Transaksi::getSaldo($request->rekening));
    }
    // end controler
}
