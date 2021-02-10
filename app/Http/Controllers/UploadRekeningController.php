<?php

namespace App\Http\Controllers;

use App\Imports\RekeningImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class UploadRekeningController extends Controller
{
    
    public function store(Request $request)
    {
        $file = $request->file('excel');

        Excel::import(new RekeningImport, $file);
        
        return redirect('/upload')->with('notif', 'All good!');
    }

}
