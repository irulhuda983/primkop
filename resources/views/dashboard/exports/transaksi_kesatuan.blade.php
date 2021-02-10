<table>
    <thead>
      <tr>
        <th colspan="10" align="center"><h5>PRIMER KOPERASI KEPOLISIAN RI</h5></th>
      </tr>
      <tr>
        <th colspan="10" align="center">JL. MH.THAMRIN NO. 50 BOJONEGORO JAWA TIMUR</th>
      </tr>
      <tr>
        <th colspan="10" align="center">REKAPITULASI TAGIHAN ANGGOTA</th>
      </tr>
      <tr>
        <th colspan="10" align="center">{{ $bulan_lengkap[$bulan] }} {{ $tahun }}</th>
      </tr>
      <tr>
        <th colspan="10"></th>
      </tr>

      <tr>
        <th colspan="2">Kesatuan</th>
        <th>: {{ $kesatuan->instansi }}</th>
      </tr>
      <tr></tr>
      <tr>
        <th align="center" rowspan="2">No.</th>
        <th align="center" rowspan="2">Nama Anggota</th>
        <th align="center" colspan="3">Simpanan</th>
        <th align="center" colspan="4">Potongan</th>
        <th align="right" rowspan="2">Jumlah</th>
      </tr>
      <tr>
        <th align="right">Sim. Pokok</th>
        <th align="right">Sim. Wajib</th>
        <th align="right">Sim. Sukarela</th>
        <th align="right">Pot. Uang</th>
        <th align="right">Pot. Barang</th>
        <th align="right">Pot. Bahan</th>
        <th align="right">Pot. Lain</th>
      </tr>
    </thead>
    <tbody>
        @foreach($anggota as $data)
        <?php
            $sim_pokok = App\Http\Controllers\ReportController::simAnggotaPokok($data->id, $bulan, $tahun);
            $sim_wajib = App\Http\Controllers\ReportController::simAnggotaWajib($data->id, $bulan, $tahun);
            $sim_sukarela = App\Http\Controllers\ReportController::simAnggotaSukarela($data->id, $bulan, $tahun);
            $pot_uang = App\Http\Controllers\ReportController::potAnggotaUang($data->id, $bulan, $tahun);
            $pot_barang = App\Http\Controllers\ReportController::potAnggotaBarang($data->id, $bulan, $tahun);
            $pot_bahan = App\Http\Controllers\ReportController::potAnggotaBahan($data->id, $bulan, $tahun);
            $pot_lain = App\Http\Controllers\ReportController::potAnggotaLain($data->id, $bulan, $tahun);
            $total = array_sum([$sim_pokok, $sim_wajib, $sim_sukarela, $pot_uang, $pot_barang, $pot_bahan, $pot_lain]);
        ?>
        <tr>
            <th align="center">{{ $loop->iteration }}</th>
            <td>
                <span>{{ $data->nama }}</span>
            </td>
            <td align="right">{{ (int) $sim_pokok }}</td>
            <td align="right">{{ (int) $sim_wajib }}</td>
            <td align="right">{{ (int) $sim_sukarela }}</td>
            <td align="right">{{ (int) $pot_uang }}</td>
            <td align="right">{{ (int) $pot_barang }}</td>
            <td align="right">{{ (int) $pot_bahan }}</td>
            <td align="right">{{ (int) $pot_lain }}</td>
            <th align="right">{{ (int) $total }}</th>
        </tr>
        @endforeach
    </tbody>
</table>