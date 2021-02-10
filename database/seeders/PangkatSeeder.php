<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class PangkatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'AKBP',
            'KOMPOL',
            'AKP',
            'IPTU',
            'IPDA',
            'AIPTU',
            'AIPDA',
            'BRIPKA',
            'BRIGADIR',
            'BRIPTU',
            'BRIPDA',
            'ABRIP',
            'ABRIPTU',
            'ABRIPDA',
            'BHARAKA',
            'BHARATU',
            'BHARADA',
            'PENATA I',
            'PENATA',
            'PENDA I',
            'PENDA',
            'PENGATUR I',
            'PENGATUR',
            'PENGDA I',
            'PENGDA',
            'JURU I',
            'JURU',
        ];

        foreach($data as $pangkat){
            DB::table('pangkat')->insert([
                'pangkat' => $pangkat
            ]);
        }
    }
}
