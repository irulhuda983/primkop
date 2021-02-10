<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Instansi;
use App\Models\Pangkat;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $data = Instansi::leftjoin('anggota', 'instansi.id', '=', 'anggota.instansi_id')
                        ->select(
                            'instansi.*',
                            DB::raw("count(anggota.nia) as jumlah"),
                        )
                        ->groupby('instansi.instansi')
                        ->get();
        return view('dashboard.anggota.index', compact('data'));
    }

    public function detail($id)
    {
        // dd($id);
        $anggota = Anggota::join('pangkat', 'anggota.pangkat_id', '=', 'pangkat.id')
            ->join('instansi', 'anggota.instansi_id', '=', 'instansi.id')
            ->leftJoin('rekening', 'anggota.id', '=', 'rekening.anggota_id')
            ->select('anggota.*', 'rekening.no_rekening', 'rekening.status', 'pangkat.pangkat', 'instansi.instansi')
            ->where('anggota.instansi_id', $id)
            ->get();
        return view('dashboard.anggota.detail', compact('anggota'));
    }

    public function setNia()
    {
        $rekening = Anggota::max('nia');
        $urutan = (int) substr($rekening, 3, 3);
        $urutan++;
        $nia = sprintf("%05s", $urutan);
        return $nia;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pangkat = Pangkat::all();
        $instansi = Instansi::all();
        $nia = $this->setNia();
        return view('dashboard.anggota.create', compact('pangkat', 'instansi', 'nia'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nia' => ['required', 'numeric'],
            'nrp' => ['numeric'],
            'nama' => ['required'],
            'pangkat' => ['required'],
            'instansi' => ['required'],
            'gender' => ['required']
        ]);

        Anggota::create([
            'nia' => $request->nia,
            'nrp' => $request->nrp,
            'nama' => $request->nama,
            'pangkat_id' => $request->pangkat,
            'instansi_id' => $request->instansi,
            'gender' => $request->gender,
            'tempat' => $request->tempat,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'foto' => '',
            'is_active' => 1,
            'tgl_masuk' => date('Y-m-d'),
            'tgl_keluar' => null,
        ]);

        return redirect('/anggota')->with('notif', 'Berhasil menambah satu anggota baru, Silahkan tambah anggota lagi atau kembali.');
    }

   
    public function showAll(Request $request)
    {
        // $key = $request->key;

        if($request->has('key')){
            $anggota = Anggota::join('pangkat', 'anggota.pangkat_id', '=', 'pangkat.id')
            ->join('instansi', 'anggota.instansi_id', '=', 'instansi.id')
            ->leftJoin('rekening', 'anggota.id', '=', 'rekening.anggota_id')
            ->select('anggota.*', 'rekening.no_rekening', 'rekening.status', 'pangkat.pangkat', 'instansi.instansi')
            ->where('nama', 'LIKE', '%'. $request->key .'%')
            ->get();
        }else{
            $anggota = Anggota::join('pangkat', 'anggota.pangkat_id', '=', 'pangkat.id')
            ->join('instansi', 'anggota.instansi_id', '=', 'instansi.id')
            ->leftJoin('rekening', 'anggota.id', '=', 'rekening.anggota_id')
            ->select('anggota.*', 'rekening.no_rekening', 'rekening.status', 'pangkat.pangkat', 'instansi.instansi')
            ->get();
        }

        return response()->json($anggota);
    }

    public function show(Anggota $anggota)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Anggota  $anggota
     * @return \Illuminate\Http\Response
     */
    public function edit(Anggota $anggota)
    {
        $pangkat = Pangkat::all();
        $instansi = Instansi::all();
        return view('dashboard.anggota.edit', compact('anggota', 'pangkat', 'instansi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Anggota  $anggota
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Anggota $anggota)
    {
        Anggota::where('id', $anggota->id)
                ->update([
                    'nia' => $request->nia,
                    'nrp' => $request->nrp,
                    'nama' => $request->nama,
                    'pangkat_id' => $request->pangkat,
                    'instansi_id' => $request->instansi,
                    'gender' => $request->gender,
                    'tempat' => $request->tempat,
                    'tanggal_lahir' => $request->tanggal_lahir,
                    'alamat' => $request->alamat,
                    'foto' => '',
                    'is_active' => $anggota->is_active,
                    'tgl_masuk' => $anggota->tgl_masuk,
                    'tgl_keluar' => $anggota->tgl_keluar,
                ]);
        
        return redirect('/anggota')->with('notif', 'Berhasil menambah satu anggota baru, Silahkan tambah anggota lagi atau kembali.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Anggota  $anggota
     * @return \Illuminate\Http\Response
     */
    public function destroy(Anggota $anggota)
    {
        Anggota::destroy($anggota->id);
        return redirect('/anggota')->with('notif', 'Anggota '. $anggota->nama.' Berhasil Dihapus.');
    }
}
