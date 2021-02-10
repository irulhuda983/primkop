@extends('dashboard.base')

@section('css')
<link href="{{ asset('plugins/data-table/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid px-3">
    <div class="fade-in">
        <div class="card p-0">
            <div class="card-header pb-0 mb-0">
                <h5>Detail Penarikan</h5>
            </div>
            
            <div class="card-body row">
                <div class="col-6">
                    <h5>Transaksi</h5>
                    <hr>
                    <div class="form-group row">
                        <label for="Kode_transaksi" class="form-control-label col-4">Kode Transaksi</label>
                        <div class="col-8">
                            <input type="text" readonly class="form-control" placeholder="{{ $data->kode_transaksi }}">
                            <input type="hidden" name="kode_transaksi" value="{{ $data->kode_transaksi }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="pot_lain" class="form-control-label">Jumlah Uang Yang Ditarik</label>
                        <input type="number" name="jumlah" value="{{ $data->jumlah }}" class="form-control">
                    </div>


                    <div class="form-group">
                        <button class="btn btn-primary"><i class="cil-save"></i> Print</button>
                        <a href="/penarikan" class="btn btn-danger" type="button"><i class="cil-x"></i> Kembali</a>
                    </div>
                </div>

                <div class="col-6">
                    <h5>Data Anggota</h5>
                    <hr>
                    <div class="form-group row mb-0">
                        <label for="" class="form-control-label col-4">NIA / NRP</label>
                        <p class="text-dark font-weight-bold col-8">{{ $data->nia}} / {{ $data->nrp }}</p>
                    </div>

                    <div class="form-group row mb-0"">
                        <label for="" class="form-control-label col-4">Nama Anggota</label>
                        <p class="text-dark font-weight-bold col-8">{{ $data->nama}}</p>
                    </div>

                    <div class="form-group row mb-0"">
                        <label for="" class="form-control-label col-4">Tempat. Tanggal Lahir</label>
                        <p class="text-dark font-weight-bold col-8">{{ $data->tempat}}, {{ \Carbon\Carbon::parse($data->tanggal_lahir)->isoFormat('dddd, DD MMMM Y') }}</p>
                    </div>

                    <div class="form-group row mb-0"">
                        <label for="" class="form-control-label col-4">Jenis Kelamin</label>
                        <p class="text-dark font-weight-bold col-8">{{ $data->gender}}</p>
                    </div>

                    <div class="form-group mb-0"">
                        <label for="" class="form-control-label">Waktu Transaksi</label>
                        <p class="text-dark font-weight-bold">{{ \Carbon\Carbon::parse($data->tanggal)->isoFormat('dddd, DD MMMM Y')}}</p>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

@endsection


@section('javascript')

@endsection