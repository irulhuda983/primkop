@extends('dashboard.base')

@section('css')
<link href="{{ asset('plugins/data-table/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('plugins/chosen/css/chosen.min.css') }}">
@endsection

@section('content')
<div class="container-fluid px-3">
    <div class="fade-in">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="row justify-content-center" id="menu-transaksi">
                    <div id="rekening-anggota" data-rekening="{{ $data->no_rekening }}" style="display: none"></div>
                    <div class="col-md-3">
                        <a href="/transaksi/{{ $data->no_rekening }}/setor" class="submenu-transaksi" data-transaksi="setor">
                            <div class="card">
                                <div class="card-body text-center">
                                    <img src="{{ asset('icons/paymen/setor.png')}}" alt="">
                                    <h5 class="text-menu-transaksi">Setor Simpanan</h5>
                                    <small>Setoran Simpanan</small>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3">
                        <a href="/transaksi/{{ $data->no_rekening }}/potongan" class="submenu-transaksi" data-transaksi="potongan">
                            <div class="card">
                                <div class="card-body text-center">
                                    <img src="{{ asset('icons/paymen/potongan.png')}}" alt="">
                                    <h5 class="text-menu-transaksi">Potongan</h5>
                                    <small>Setor potongan anggota.</small>
                                </div>
                            </div>
                        </a>
                    </div>
        
                    <div class="col-md-3">
                        <a href="/transaksi/{{ $data->no_rekening }}/tarik" class="submenu-transaksi" data-transaksi="tarik">
                            <div class="card">
                                <div class="card-body text-center">
                                    <img src="{{ asset('icons/paymen/tarik.png')}}" alt="">
                                    <h5 class="text-menu-transaksi">Tarik Simpanan</h5>
                                    <small>Ambil uang dari rekening</small>
                                </div>
                            </div>
                        </a>
                    </div>
        
                    <div class="col-md-3">
                        <a href="/transaksi/{{ $data->no_rekening }}/saldo" class="submenu-transaksi" data-transaksi="saldo">
                            <div class="card">
                                <div class="card-body text-center">
                                    <img src="{{ asset('icons/paymen/saldo.png')}}" alt="">
                                    <h5 class="text-menu-transaksi">Saldo</h5>
                                    <small>Informsi saldo rekening.</small>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <form action="" method="post" id="form-transaksi">
                            @csrf
                            <div class="card-body" id="box-transaksi" style="display: none">

                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-sm save"><i class="cil-save"></i> Simpan</button>
                                <button type="button" class="btn btn-danger btn-sm" id="batal-transaksi"><i class="cil-x"></i> Batal</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card p-0" id="recent-transaksi">
                            <div class="card-header">
                                <h5>Transaksi Terakhir</h5>
                            </div>
                            <div class="card-body" class="m-0" style="padding: 0; height: 45vh; overflow-y: auto; oveflow-x: hidden;">
                                <ul class="list-group m-0">
                                    @foreach($trans as $log)
                                    <li class="list-group-item log-transaksi">
                                        <div class="row">
                                            <div class="box-icon col-md-1 col-sm-2 col-xs-2">
                                                @if($log->jenis_transaksi == 'simpanan')
                                                <i class="cil-cash"></i>
                                                @elseif($log->jenis_transaksi == 'potongan')
                                                <i class="cil-cut"></i>
                                                @elseif($log->jenis_transaksi == 'penarikan')
                                                <i class="cil-fax"></i>
                                                @endif
                                            </div>
                                            <div class="keterangan col-md-9 col-sm-7 col-xs-7">
                                                <span class="font-weight-bold">{{ $log->kode_transaksi }}<span> <br>
                                                <small class="text-muted">{{ $log->keterangan }}</small> <br>
                                                <small><i>{{ date('d-m-Y H:i:s', strtotime($log->tanggal)) }}</i></small>
                                            </div>
    
                                            <div class="jumlah col-md-2 col-sm-3 col-xs-3 text-right pr-4">
                                                @if($log->jenis_transaksi == 'simpanan')
                                                <span class="text-success font-weight-bold">+ Rp. {{ number_format($log->total_simpanan, 0, ',', '.') }}</span>
                                                @elseif($log->jenis_transaksi == 'potongan')
                                                <span class="text-success font-weight-bold">+ Rp. {{ number_format($log->total_potongan, 0, ',', '.') }}</span>
                                                @elseif($log->jenis_transaksi == 'penarikan')
                                                <span class="text-danger font-weight-bold">- Rp. {{ number_format($log->jumlah, 0, ',', '.') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                  </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


@section('javascript')
<script src="{{ asset('plugins/chosen/js/chosen.min.js')}}"></script>
<script src="{{ asset('plugins/primer/js/pages/transaksi.js')}}"></script>
@endsection