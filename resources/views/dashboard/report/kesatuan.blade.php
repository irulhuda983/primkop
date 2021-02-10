@extends('dashboard.base')

@section('css')
<link href="{{ asset('plugins/data-table/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid px-3">
    <div class="fade-in">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                {{-- <form action="/report/kesatuan/{{ $idKesatuan }}" method="GET" style="width: 50%">
                    <div class="input-prepend input-group">
                        <select name="bulan" id="bulan" class="form-control">
                            <option value="1" @if($bulan == 1) selected @endif>Januari</option>
                            <option value="2" @if($bulan == 2) selected @endif>Februari</option>
                            <option value="3" @if($bulan == 3) selected @endif>Maret</option>
                            <option value="4" @if($bulan == 4) selected @endif>April</option>
                            <option value="5" @if($bulan == 5) selected @endif>Mei</option>
                            <option value="6" @if($bulan == 6) selected @endif>Juni</option>
                            <option value="7" @if($bulan == 7) selected @endif>Juli</option>
                            <option value="8" @if($bulan == 8) selected @endif>Agustus</option>
                            <option value="9" @if($bulan == 9) selected @endif>September</option>
                            <option value="10" @if($bulan == 10) selected @endif>Oktober</option>
                            <option value="11" @if($bulan == 11) selected @endif>November</option>
                            <option value="12" @if($bulan == 12) selected @endif>Desember</option>
                        </select>
                        <input class="form-control" id="prependedInput" size="12" type="text" placeholder="Masukkan tahun" name="tahun" value="{{ $tahun }}">
                        <span class="input-group-append">
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form> --}}
                <div></div>
                <div class="btn-group" role="group" aria-label="First group">
                    <a href="/report/export/{{ $idKesatuan }}/{{ $bulan }}/{{ $tahun }}" class="btn btn-primary" type="button">
                        <i class="far fa-file-excel"></i> Export Excel
                    </a>
                    {{-- <button class="btn btn-primary" type="button">
                        <i class="fas fa-print"></i>
                    </button> --}}
                </div>
            </div>
            <div class="card-body px-2" style="width:100%; overflow-x: auto">
                <table class="table table-bordered" id="table-report" style="width:100%; overflow-x: auto;">
                    <thead>
                      <tr>
                        <th class="align-middle" rowspan="2" width="1%">No.</th>
                        <th class="align-middle" rowspan="2">Nama Anggota</th>
                        <th class="align-middle text-center" colspan="3">Simpanan</th>
                        <th class="align-middle text-center" colspan="4">Potongan</th>
                        <th class="align-middle text-right" rowspan="2">Jumlah</th>
                      </tr>
                      <tr>
                        <th class="align-middle text-right">Sim. Pokok</th>
                        <th class="align-middle text-right">Sim. Wajib</th>
                        <th class="align-middle text-right">Sim. Sukarela</th>
                        <th class="align-middle text-right">Pot. Uang</th>
                        <th class="align-middle text-right">Pot. Barang</th>
                        <th class="align-middle text-right">Pot. Bahan</th>
                        <th class="align-middle text-right">Pot. Lain</th>
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
                            <th class="align-middle">{{ $loop->iteration }}</th>
                            <td class="align-middle">
                                <span class="text-success">{{ $data->nama }}</span>
                            </td>
                            <td class="align-middle text-right">Rp. {{ number_format((int) $sim_pokok, 0, ',', '.') }}</td>
                            <td class="align-middle text-right">Rp. {{ number_format((int) $sim_wajib, 0, ',', '.') }}</td>
                            <td class="align-middle text-right">Rp. {{ number_format((int) $sim_sukarela, 0, ',', '.') }}</td>
                            <td class="align-middle text-right">Rp. {{ number_format((int) $pot_uang, 0, ',', '.') }}</td>
                            <td class="align-middle text-right">Rp. {{ number_format((int) $pot_barang, 0, ',', '.') }}</td>
                            <td class="align-middle text-right">Rp. {{ number_format((int) $pot_bahan, 0, ',', '.') }}</td>
                            <td class="align-middle text-right">Rp. {{ number_format((int) $pot_lain, 0, ',', '.') }}</td>
                            <th class="align-middle text-right">Rp. {{ number_format((int) $total, 0, ',', '.') }}</th>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection


@section('javascript')
<script type="text/javascript" language="javascript" src="{{ asset('plugins/data-table/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" language="javascript" src="{{ asset('plugins/data-table/js/dataTables.bootstrap4.js') }}"></script>
<script>
    $(document).ready(() => {

        let notif = $('#notif').data('notif')

        if(notif > 0 ){
            $('#message').html($('#notif').data('message'))
            $('#toast').show()
            $('.toast').toast('show')
        }

        $('#table-report').DataTable();


    })
</script>
@endsection