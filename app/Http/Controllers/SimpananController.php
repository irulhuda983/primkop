<?php

namespace App\Http\Controllers;

use App\Models\Simpanan;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class SimpananController extends Controller
{

    public function index()
    {
        $simpanan = Simpanan::getAllSimpanan();
        $total = Simpanan::getJumlahSimpanan();
        return view('dashboard.simpanan.index', compact('simpanan', 'total'));
    }


    public function jenis()
    {
        $simpanan = Simpanan::all();
        return response()->json([
            'simpanan' => $simpanan
        ]);
    }


    public function edit(Request $request)
    {
        $simpanan = Simpanan::getSimpananByKode($request->kode_transaksi);

        return view('dashboard.simpanan.edit', compact('simpanan'));
    }


    public function update(Request $request, Simpanan $simpanan)
    {
        $total = (int) $request->sim_pokok + (int)  $request->sim_wajib + (int) $request->sim_sukarela;

        Simpanan::where('kode_transaksi', $request->kode_transaksi)
                ->update([
                    'sim_pokok' => (int) $request->sim_pokok,
                    'sim_wajib' => (int) $request->sim_wajib,
                    'sim_sukarela' => (int) $request->sim_sukarela,
                    'total_simpanan' => (int) $total,
                ]);

        return redirect('/simpanan')->with('notif', 'Transaksi dengan kode '. $request->kode_transaksi .' Berhasil Diubah.');
    }

    
    public function destroy(Simpanan $simpanan)
    {
        Transaksi::where('kode_transaksi', $simpanan->kode_transaksi)->delete();
        Simpanan::destroy($simpanan->id);

        return redirect('/simpanan')->with('notif', 'Transaksi dengan kode '. $simpanan->kode_transaksi .' Berhasil Dihapus.');
    }
}
