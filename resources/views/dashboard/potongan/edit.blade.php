@extends('dashboard.base')

@section('css')
<link href="{{ asset('plugins/data-table/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid px-3">
    <div class="fade-in">
        <div class="card p-0">
            <div class="card-header pb-0 mb-0">
                <h5>Edit Transaksi Potongan</h5>
            </div>
            <form action="/potongan/{{$pot->id}}" method="POST">
            @method('patch')
            @csrf
            <div class="card-body row">
                <div class="col-6">
                    <h5>Transaksi</h5>
                    <hr>
                    <div class="form-group row">
                        <label for="Kode_transaksi" class="form-control-label col-4">Kode Transaksi</label>
                        <div class="col-8">
                            <input type="text" readonly class="form-control" placeholder="{{ $pot->kode_transaksi }}">
                            <input type="hidden" name="kode_transaksi" value="{{ $pot->kode_transaksi }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="pot_uang" class="form-control-label">pot. Uang</label>
                            <input type="number" name="pot_uang" value="{{ $pot->pot_uang }}" class="form-control">
                        </div>
    
                        <div class="form-group col-md-6">
                            <label for="pot_bahan" class="form-control-label">Pot. Barang</label>
                            <input type="number" name="pot_barang" value="{{ $pot->pot_barang }}" class="form-control">
                        </div>
    
                        <div class="form-group col-md-6">
                            <label for="pot_bahan" class="form-control-label">Pot. Bahan</label>
                            <input type="number" name="pot_bahan" value="{{ $pot->pot_bahan }}" class="form-control">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="pot_lain" class="form-control-label">Pot. lain</label>
                            <input type="number" name="pot_lain" value="{{ $pot->pot_lain }}" class="form-control">
                        </div>
                    </div>


                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="/potongan" class="btn btn-danger" type="button">Batal</a>
                    </div>
                </div>

                <div class="col-6">
                    <h5>Data Anggota</h5>
                    <hr>
                    <div class="form-group row mb-0">
                        <label for="" class="form-control-label col-4">NIA / NRP</label>
                        <p class="text-dark font-weight-bold col-8">{{ $pot->nia}} / {{ $pot->nrp }}</p>
                    </div>

                    <div class="form-group row mb-0"">
                        <label for="" class="form-control-label col-4">Nama Anggota</label>
                        <p class="text-dark font-weight-bold col-8">{{ $pot->nama}}</p>
                    </div>

                    <div class="form-group row mb-0"">
                        <label for="" class="form-control-label col-4">Tempat. Tanggal Lahir</label>
                        <p class="text-dark font-weight-bold col-8">{{ $pot->tempat}}, {{ \Carbon\Carbon::parse($pot->tanggal_lahir)->isoFormat('dddd, DD MMMM Y') }}</p>
                    </div>

                    <div class="form-group row mb-0"">
                        <label for="" class="form-control-label col-4">Jenis Kelamin</label>
                        <p class="text-dark font-weight-bold col-8">{{ $pot->gender}}</p>
                    </div>

                    <div class="form-group mb-0"">
                        <label for="" class="form-control-label">Waktu Transaksi</label>
                        <p class="text-dark font-weight-bold">{{ \Carbon\Carbon::parse($pot->tanggal)->isoFormat('dddd, DD MMMM Y')}}</p>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>

@endsection


@section('javascript')

@endsection