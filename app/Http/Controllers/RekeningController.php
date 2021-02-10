<?php

namespace App\Http\Controllers;

use App\Models\Rekening;
use App\Models\Anggota;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class RekeningController extends Controller
{

    public function store(Request $request)
    {
        Rekening::create([
            'anggota_id' => $request->id,
            'no_rekening' => $request->no_rek,
            'descripsi' => 'Pembuatan Rekening Baru',
            'status' => 1
        ]);

        return redirect('/anggota')->with('notif', 'Berhasil Membuat rekening baru.');
    }


    public function show(Request $request)
    {
        $rekening = Rekening::join('anggota', 'rekening.anggota_id', '=', 'anggota.id')
                            ->where('anggota_id', $request->anggota)
                            ->first();
        if($rekening){
            return view('dashboard.rekening.edit', compact('rekening'));
        }else{
            $anggota = Anggota::find($request->anggota);
            return view('dashboard.rekening.create', compact('anggota'));
        }
    }


    public function update(Request $request, Rekening $rekening)
    {
        Rekening::where('id', $rekening->id)
                ->update([
                    'status' => $request->opsi
                ]);

        return redirect('/anggota')->with('notif', 'No. rekening'. $rekening->no_rekening.' Berhasil Ubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rekening  $rekening
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rekening $rekening)
    {
        //
    }
}
