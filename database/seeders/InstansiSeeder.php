<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class InstansiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'POLRES BOJONEGORO',
            'MANUAL',
            'POLSEK KAPAS',
            'POLSEK SUKOSEWU',
            'POLSEK BALEN',
            'POLSEK SUGIHWARAS',
            'POLSEK TEMAYANG',
            'POLSEK DANDER',
            'POLSEKTA',
            'POLSEK BAURENO',
            'POLSEK KEPOH BARU',
            'POLSEK KEDUNGADEM',
            'POLSEK SUMBER REJO',
            'POLSEK KANOR',
            'POLSEK KALITIDU',
            'POLSEK MALO',
            'POLSEK NGASEM',
            'POLSEK BUBULAN',
            'POLSEK GONDANG',
            'POLSEK PADANGAN',
            'POLSEK KASIMAN',
            'POLSEK PURWOSARI',
            'POLSEK TAMBAK REJO',
            'POLSEK NGRAHO',
            'POLSEK MARGOMULYO',
            'POLSEK NGAMBON',
            'POLSEK SEKAR',
            'POLSEK TRUCUK',
            'POLSEK KEDEWAN',
            'PNS POLRES',
            'PNS POLSEK',
            'POLSEK GAYAM',
            'SIE WAS',
            'SIE PROPAM',
            'PIMPINAN',
            'SIUM POLRES',
            'SIKEU POLRES',
            'BAG OPS',
            'BAG REN',
            'BAG SUMDA',
            'SPKT',
            'SAT INTEL',
            'SAT RESKRIM',
            'SAT NARKOBA',
            'SAT BINMAS',
            'SAT SABHARA',
            'SAT LANTAS',
            'SAT PAM OBVIT',
            'SAT TAHTI',
            'SITIPOL',
        ];

        foreach($data as $instansi){
            DB::table('instansi')->insert([
                'instansi' => $instansi
            ]);
        }
    }
}
