<?php

namespace App\Http\Controllers;

use App\Models\Potongan;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class PotonganController extends Controller
{
    

    public function index()
    {
        $potongan = Potongan::getAllPotongan();
        $total = Potongan::getJumlahPotongan();
        return view('dashboard.potongan.index', compact('potongan', 'total'));
    }

    public function edit(Request $request)
    {
        $pot = Potongan::getPotonganByKode($request->kode_transaksi);
        return view('dashboard.potongan.edit', compact('pot'));
    }

    public function update(Request $request, Potongan $potongan)
    {
        $total = (int) $request->pot_uang + (int)  $request->pot_barang + (int) $request->pot_bahan + (int) $request->pot_lain;

        Potongan::where('id', $potongan->id)
                ->update([
                    'pot_uang' => (int) $request->pot_uang,
                    'pot_barang' => (int) $request->pot_barang,
                    'pot_bahan' => (int) $request->pot_bahan,
                    'pot_lain' => (int) $request->pot_lain,
                    'total_potongan' => (int) $total,
                ]);

        return redirect('/potongan')->with('notif', 'Transaksi dengan kode '. $potongan->kode_transaksi .' Berhasil Diubah.');
    }

    public function destroy(Potongan $potongan)
    {
        Transaksi::where('kode_transaksi', $potongan->kode_transaksi)->delete();
        Potongan::destroy($potongan->id);

        return redirect('/potongan')->with('notif', 'Transaksi dengan kode '. $potongan->kode_transaksi .' Berhasil Dihapus.');
    }
}
