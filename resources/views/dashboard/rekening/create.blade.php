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
            <form action="/rekening" method="post">
            @csrf
            <div class="card-body" style="height: 60vh; overflow-y: auto">
                <div class="row justify-content-center">
                    <div class="col-md-7">
                        <div class="form-group row">
                            <div class="col-md-4 text-muted">NIA</div>
                            <div class="col-md-8 text-left"> : {{ $anggota->nia }}</div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4 text-muted">NRP</div>
                            <div class="col-md-8 text-left"> : {{ $anggota->nrp }}</div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4 text-muted">Nama Lengkap</div>
                            <div class="col-md-8 text-left"> : {{ $anggota->nama }}</div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4 text-muted">Tempat, Tanggal Lahir</div>
                            <div class="col-md-8 text-left"> : {{ $anggota->tempat }}, {{ date('d F Y', strtotime($anggota->tanggal_lahir)) }}</div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4 text-muted">Jenis Kelamin</div>
                            <div class="col-md-8 text-left"> : {{ $anggota->gender }}</div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4 text-muted">Alamat</div>
                            <div class="col-md-8 text-left"> : {{ $anggota->alamat }}</div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="nia" class="form-control-label text-right">No. Rekening</label>
                            <input type="hidden" value="{{ $anggota->id }}" name="id">
                            <input type="hidden" value="050{{ date('Y').$anggota->nia }}" name="no_rek">
                            <input type="text" class="form-control form-control-sm @error('no_rek') is-invalid @enderror" name="prev_rek" autocomplete="off" value="050-{{ date('Y').$anggota->nia }}" disabled>
                                @error('no_rek')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                        </div>
                        <div class="form-group d-flex justify-content-between border-top py-3">
                            <button type="submit" class="btn btn-primary btn-sm"> <i class="cil-check"></i> Buat Rekekning </button>
                            <button type="button" class="btn btn-ghost-danger btn-sm back"> <i class="cil-arrow-left"></i> Kembali </button>
                        </div>
                    </div>

                    {{-- <div class="col-md-5">
                        <div class="form-group row">
                            <label for="nia" class="form-control-label col-2 text-right">NIA</label>
                            <div class="col-10">
                                <input type="text" class="form-control form-control-sm @error('nia') is-invalid @enderror" name="nia" autocomplete="off">
                                @error('nia')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div> --}}
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