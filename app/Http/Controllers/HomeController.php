<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $log = Transaksi::limit(10)
                        ->orderby('tanggal', 'ASC')
                        ->get();
        return view('dashboard.homepage', compact('log'));
    }
}
