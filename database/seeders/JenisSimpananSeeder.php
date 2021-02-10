<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class JenisSimpananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = ['Pokok', 'Wajib', 'sukarela'];

        foreach($data as $jenis){
            DB::table('jenis_simpanan')->insert([
                'simpanan' => $jenis,
                'jumlah' => 0
            ]);
        }
    }
}
