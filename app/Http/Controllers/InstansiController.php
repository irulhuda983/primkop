<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use Illuminate\Http\Request;

class InstansiController extends Controller
{

    public function index()
    {
        return view('dashboard.instansi.index');
    }


    public function store(Request $request)
    {
        $instansi = $request->validate([
            'instansi' => ['required', 'unique:instansi']
        ]);

        $instansi = Instansi::create([
            'instansi' => $request->instansi
        ]);

        return response()->json([
            'message' => 'Instransi '.$request->instansi.' Berhasil Ditambahkan.',
            'instansi' => $instansi
        ]);
    }



    public function showAll()
    {
        $instansi = Instansi::all();
        return response()->json($instansi);
    }


    public function show(Instansi $instansi)
    {
        return $instansi;
    }



    public function update(Request $request, Instansi $instansi)
    {
        $data = $request->validate([
            'instansi' => ['required']
        ]);

        $data = Instansi::where(['id' => $instansi->id])
                            ->update([
                                'instansi' => $request->instansi
                            ]);

        return response()->json([
            'message' => 'Instansi '.$instansi->instansi.' Berhasil Diubah.',
            'instansi' => $data
        ]);
    }


    public function destroy(Instansi $instansi)
    {
        Instansi::destroy($instansi->id);

        return response('Data Berhasil Dihapus');
    }
}
