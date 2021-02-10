@extends('dashboard.base')

@section('css')
<link href="{{ asset('plugins/data-table/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid px-3">
    <div class="fade-in">
        <div class="card p-0">
            <div class="card-header pb-0 mb-0">
                <h5>Edit Transaksi Simpanan</h5>
            </div>
            <form action="/simpanan/{{$simpanan->id}}" method="POST">
            @method('patch')
            @csrf
            <div class="card-body row">
                <div class="col-6">
                    <h5>Transaksi</h5>
                    <hr>
                    <div class="form-group row">
                        <label for="Kode_transaksi" class="form-control-label col-4">Kode Transaksi</label>
                        <div class="col-8">
                            <input type="text" readonly class="form-control" placeholder="{{ $simpanan->kode_transaksi }}">
                            <input type="hidden" name="kode_transaksi" value="{{ $simpanan->kode_transaksi }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="sim_pokok" class="form-control-label">Simpanan Pokok</label>
                            <input type="number" name="sim_pokok" value="{{ $simpanan->sim_pokok }}" class="form-control">
                        </div>
    
                        <div class="form-group col-md-4">
                            <label for="sim_wajib" class="form-control-label">Simpanan Wajib</label>
                            <input type="number" name="sim_wajib" value="{{ $simpanan->sim_wajib }}" class="form-control">
                        </div>
    
                        <div class="form-group col-md-4">
                            <label for="sim_sukarela" class="form-control-label">Simpanan Pokok</label>
                            <input type="number" name="sim_sukarela" value="{{ $simpanan->sim_sukarela }}" class="form-control">
                        </div>
                    </div>


                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="/simpanan" class="btn btn-danger" type="button">Batal</a>
                    </div>
                </div>

                <div class="col-6">
                    <h5>Data Anggota</h5>
                    <hr>
                    <div class="form-group row mb-0">
                        <label for="" class="form-control-label col-4">NIA / NRP</label>
                        <p class="text-dark font-weight-bold col-8">{{ $simpanan->nia}} / {{ $simpanan->nrp }}</p>
                    </div>

                    <div class="form-group row mb-0"">
                        <label for="" class="form-control-label col-4">Nama Anggota</label>
                        <p class="text-dark font-weight-bold col-8">{{ $simpanan->nama}}</p>
                    </div>

                    <div class="form-group row mb-0"">
                        <label for="" class="form-control-label col-4">Tempat. Tanggal Lahir</label>
                        <p class="text-dark font-weight-bold col-8">{{ $simpanan->tempat}}, {{ date('d F Y', strtotime($simpanan->tanggal_lahir) )}}</p>
                    </div>

                    <div class="form-group row mb-0"">
                        <label for="" class="form-control-label col-4">Jenis Kelamin</label>
                        <p class="text-dark font-weight-bold col-8">{{ $simpanan->gender}}</p>
                    </div>

                    <div class="form-group mb-0"">
                        <label for="" class="form-control-label">Waktu Transaksi</label>
                        <p class="text-dark font-weight-bold">{{ \Carbon\Carbon::parse($simpanan->tanggal)->isoFormat('dddd, DD MMMM Y')}}</p>
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