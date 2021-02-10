<?php

namespace App\Http\Controllers;

use App\Models\Pangkat;
use Illuminate\Http\Request;

class PangkatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pangkat = Pangkat::all();
        return view('dashboard.pangkat.index', compact('pangkat'));
    }


    public function store(Request $request)
    {
        $pangkat = $request->validate([
            'pangkat' => ['required', 'unique:pangkat']
        ]);

        $pangkat = Pangkat::create([
            'pangkat' => $request->pangkat
        ]);

        return response()->json([
            'message' => 'Pangkat '.$request->pangkat.' Berhasil Ditambahkan.',
            'pangkat' => $pangkat
        ]);
    }



    public function showAll()
    {
        $pangkat = Pangkat::all();
        return response()->json($pangkat);
    }


    public function show(Pangkat $pangkat)
    {
        return $pangkat;
    }



    public function update(Request $request, Pangkat $pangkat)
    {
        $data = $request->validate([
            'pangkat' => ['required']
        ]);

        $data = Pangkat::where(['id' => $pangkat->id])
                            ->update([
                                'pangkat' => $request->pangkat
                            ]);

        return response()->json([
            'message' => 'Pangkat '.$pangkat->pangkat.' Berhasil Diubah.',
            'pangkat' => $data
        ]);
    }


    public function destroy(Pangkat $pangkat)
    {
        Pangkat::destroy($pangkat->id);

        return response('Data Berhasil Dihapus');
    }
}
