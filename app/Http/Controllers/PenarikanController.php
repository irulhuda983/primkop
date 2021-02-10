<?php

namespace App\Http\Controllers;

use App\Models\Penarikan;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class PenarikanController extends Controller
{

    public function index()
    {
        $data = Penarikan::getAllPenarikan();
        $total = Penarikan::getJumlahPenarikan();
        return view('dashboard.penarikan.index', compact('data', 'total'));
    }


    public function edit(Request $request)
    {
        $data = Penarikan::getPenarikanByKode($request->kode_transaksi);
        return view('dashboard.penarikan.edit', compact('data'));
    }


    public function update(Request $request, Penarikan $penarikan)
    {
        Penarikan::where('id', $penarikan->id)
                ->update([
                    'jumlah' => (int) $request->jumlah,
                ]);

        return redirect('/penarikan')->with('notif', 'Transaksi dengan kode '. $penarikan->kode_transaksi .' Berhasil Diubah.');
    }


    public function destroy(Penarikan $penarikan)
    {
        Transaksi::where('kode_transaksi', $penarikan->kode_transaksi)->delete();
        Penarikan::destroy($penarikan->id);

        return redirect('/penarikan')->with('notif', 'Transaksi dengan kode '. $penarikan->kode_transaksi .' Berhasil Dihapus.');
    }
}
