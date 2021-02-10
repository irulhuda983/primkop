<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class JenisTransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('jenis_transaksi')->insert([
            'jenis_transaksi' => 'debet',
            'transaksi' => 'simpanan'
        ]);

        DB::table('jenis_transaksi')->insert([
            'jenis_transaksi' => 'kredit',
            'transaksi' => 'pinjaman'
        ]);

        DB::table('jenis_transaksi')->insert([
            'jenis_transaksi' => 'kredit',
            'transaksi' => 'tagihan'
        ]);

        DB::table('jenis_transaksi')->insert([
            'jenis_transaksi' => 'kredit',
            'transaksi' => 'potongan'
        ]);
    }
}
