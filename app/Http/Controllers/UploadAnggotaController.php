<?php

namespace App\Http\Controllers;

use App\Imports\AnggotaImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class UploadAnggotaController extends Controller
{
    
    public function index()
    {
        return view('dashboard.upload.index');
    }

    public function store(Request $request)
    {
        $file = $request->file('excel');

        Excel::import(new AnggotaImport, $file);
        
        return redirect('/upload')->with('notif', 'All good!');
    }
}
