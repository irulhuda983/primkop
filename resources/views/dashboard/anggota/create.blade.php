@extends('dashboard.base')

@section('css')
<link href="{{ asset('plugins/data-table/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid px-3">
    <div class="fade-in">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center py-3 mb-0">
                <h5>Tambah Anggota Baru</h5>
            </div>
            <form action="/anggota" method="post">
            @csrf
            <div class="card-body" style="height: 60vh; overflow-y: auto">
                <div class="form-group row">
                    <label for="nia" class="form-control-label col-2 text-right">NIA</label>
                    <div class="col-10">
                        <h6><a>{{ $nia }}</a></h6>
                        <input type="hidden" class="form-control form-control-sm @error('nia') is-invalid @enderror" name="nia" autocomplete="off" value="{{ $nia }}">
                        @error('nia')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="nrp" class="form-control-label col-2 text-right">NRP</label>
                    <div class="col-10">
                        <input type="text" class="form-control form-control-sm @error('nrp') is-invalid @enderror" name="nrp" id="nrp" autocomplete="off" autofocus>
                        @error('nrp')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="nama" class="form-control-label col-2 text-right">Nama Lengkap</label>
                    <div class="col-10">
                        <input type="text" class="form-control form-control-sm @error('nama') is-invalid @enderror" id="nama" name="nama" autocomplete="off">
                        @error('nama')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="pangkat" class="form-control-label col-2 text-right">Pangkat</label>
                    <div class="col-10">
                        <select name="pangkat" id="pangkat" class="form-control form-control-sm @error('pangkat') is-invalid @enderror">
                            <option value="">Pilih Pangkat</option>
                            @foreach($pangkat as $pkt)
                            <option value="{{ $pkt->id }}">{{ $pkt->pangkat }}</option>
                            @endforeach
                        </select>
                        @error('pangkat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="instansi" class="form-control-label col-2 text-right">Instansi</label>
                    <div class="col-10">
                        <select name="instansi" id="instansi" class="form-control form-control-sm @error('instansi') is-invalid @enderror">
                            <option value="">Pilih Instansi</option>
                            @foreach($instansi as $ins)
                            <option value="{{ $ins->id }}">{{ $ins->instansi }}</option>
                            @endforeach
                        </select>
                        @error('instansi')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="Jenis kelamin" class="form-control-label col-2 text-right @error('instansi') is-invalid @enderror">Jenis Kelamin</label>
                    <div class="col-10 px-5">
                        <div class="row">
                            <div class="form-check col-3">
                                <input class="form-check-input" type="radio" name="gender" id="gender1" value="Laki - laki" checked>
                                <label class="form-check-label" for="gender1">
                                  Laki - laki
                                </label>
                              </div>
                              <div class="form-check col-3">
                                <input class="form-check-input" type="radio" name="gender" id="gender2" value="Perempuan">
                                <label class="form-check-label" for="gender2">
                                  perempuan
                                </label>
                            </div>
                        </div>
                        @error('gender')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="tempat" class="form-control-label col-2 text-right">Tempat</label>
                    <div class="col-4">
                        <input type="text" class="form-control form-control-sm @error('tempat') is-invalid @enderror" id="tempat" name="tempat" autocomplete="off">
                        @error('tempat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <label for="tanggal_lahir" class="form-control-label col-2 text-right">Tanggal Lahir</label>
                    <div class="col-4">
                        <input type="date" class="form-control form-control-sm @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" name="tanggal_lahir" autocomplete="off">
                        @error('tanggal_lahir')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="alamat" class="form-control-label col-2 text-right">Alamat</label>
                    <div class="col-10">
                        <textarea name="alamat" id="alamat" cols="30" rows="3" class="form-control form-control-sm"></textarea>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end">
                <div>
                    <button type="button" class="btn btn-ghost-danger btn-sm back"> <i class="cil-arrow-left"></i> Kembali </button>
                    <button type="submit" class="btn btn-primary btn-sm"> <i class="cil-save"></i> Save </button>
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