<?php

namespace App\Imports;

use App\Models\Rekening;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class RekeningImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Rekening([
            'anggota_id' => $row['anggota_id'],
            'no_rekening' => $row['no_rekening'],
            'descripsi' => $row['descripsi'],
            'status' => $row['status'],
        ]);
    }
}
