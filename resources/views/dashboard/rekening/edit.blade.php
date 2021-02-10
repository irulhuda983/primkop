@extends('dashboard.base')

@section('css')
<link href="{{ asset('plugins/data-table/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid px-3">
    <div class="fade-in">
        <div class="card">
            <div class="card-body py-3 mb-0">
                <h5>Buka Rekening Baru</h5>
                <span>Buka Rekening untuk melakukan transaksi, periksa dengan teliti detail informasi anggota.</span>
                <hr />
            </div>
            <form action="/rekening/{{ $rekening->id }}/update" method="post">
            @method('patch')
            @csrf
            <div class="card-body" style="height: 60vh; overflow-y: auto">
                <div class="row justify-content-center">
                    <div class="col-md-7">
                        <div class="form-group row">
                            <div class="col-md-4 text-muted">No. Rekening</div>
                            <div class="col-md-8 text-left"> : {{ $rekening->no_rekening }}</div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4 text-muted">NIA</div>
                            <div class="col-md-8 text-left"> : {{ $rekening->nia }}</div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4 text-muted">NRP</div>
                            <div class="col-md-8 text-left"> : {{ $rekening->nrp }}</div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4 text-muted">Nama Lengkap</div>
                            <div class="col-md-8 text-left"> : {{ $rekening->nama }}</div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4 text-muted">Tempat, Tanggal Lahir</div>
                            <div class="col-md-8 text-left"> : {{ $rekening->tempat }}, {{ date('d F Y', strtotime($rekening->tanggal_lahir)) }}</div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4 text-muted">Jenis Kelamin</div>
                            <div class="col-md-8 text-left"> : {{ $rekening->gender }}</div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4 text-muted">Alamat</div>
                            <div class="col-md-8 text-left"> : {{ $rekening->alamat }}</div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <div class="col-md-4 text-muted">Status Rekening</div>
                            <div class="col-md-8 text-left"> : 
                                <span class="badge @if($rekening->status > 0) badge-success @else badge-danger @endif">@if($rekening->status > 0) Aktif @else Nonaktif @endif</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="#" class="form-group-label col-4">opsi</label>
                            <div class="col-8">
                                <select name="opsi" id="opsi" class="form-control form-control-sm">
                                    @if($rekening->status > 0)
                                    <option value="1">Aktifkan</option>
                                    <option value="0" selected >Nonaktifkan</option>
                                    @else
                                    <option value="1" selected>Aktifkan</option>
                                    <option value="0">Nonaktifkan</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group d-flex justify-content-between border-top py-3">
                            <button type="submit" class="btn btn-primary btn-sm"> <i class="cil-check"></i> Save </button>
                            <button type="button" class="btn btn-ghost-danger btn-sm back"> <i class="cil-arrow-left"></i> Kembali </button>
                        </div>
                    </div>

                </div>
                

            </div>
            </form>
        </div>
    </div>
</div>

@endsection


@section('javascript')
<script>
    $(document).ready(function() {

        let notif = $('#notif').data('notif')

        if(notif > 0 ){
            $('#message').html($('#notif').data('message'))
            $('#toast').show()
            $('.toast').toast('show')
        }
        
        $('.back').on('click', () => {
            window.location.href = baseUrl + '/anggota';
        })
    });
</script>
@endsection