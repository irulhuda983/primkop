<?php

namespace App\Imports;

use App\Models\Anggota;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AnggotaImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Anggota([
            'nia' => $row['nia'],
            'nrp' => $row['nrp'],
            'nama' => $row['nama'],
            'pangkat_id' => $row['pangkat'],
            'instansi_id' => $row['instansi'],
            'gender' => $row['gender'],
            'tempat' => $row['tempat'],
            'tanggal_lahir' => $row['tanggal_lahir'],
            'alamat' => $row['alamat'],
            'foto' => $row['foto'],
            'is_active' => $row['status'],
            'tgl_masuk' => $row['tgl_masuk'],
            'tgl_keluar' => $row['tgl_keluar'],
        ]);
    }
}
