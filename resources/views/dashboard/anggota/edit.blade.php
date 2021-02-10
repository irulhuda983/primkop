@extends('dashboard.base')

@section('css')
<link href="{{ asset('plugins/data-table/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid px-3">
    <div class="fade-in">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center py-3 mb-0">
                <h5>Edit Anggota</h5>
            </div>
            <form action="/anggota/{{ $anggota->id }}" method="post">
            @method('patch')
            @csrf
            <div class="card-body" style="height: 60vh; overflow-y: auto">
                <div class="form-group row">
                    <label for="nia" class="form-control-label col-2 text-right">NIA</label>
                    <div class="col-10">
                        <h6><a>{{ $anggota->nia }}</a></h6>
                        <input type="hidden" class="form-control form-control-sm @error('nia') is-invalid @enderror" name="nia" autocomplete="off" value="{{ $anggota->nia }}">
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
                        <input type="text" class="form-control form-control-sm @error('nrp') is-invalid @enderror" name="nrp" id="nrp" autocomplete="off" autofocus value="{{ $anggota->nrp }}">
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
                        <input type="text" class="form-control form-control-sm @error('nama') is-invalid @enderror" id="nama" name="nama" autocomplete="off" value="{{ $anggota->nama }}">
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
                            @foreach($pangkat as $pkt)
                            @if($pkt->id == $anggota->pangkat_id)
                            <option value="{{ $pkt->id }}" selected>{{ $pkt->pangkat }}</option>
                            @else
                            <option value="{{ $pkt->id }}">{{ $pkt->pangkat }}</option>
                            @endif
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
                            @foreach($instansi as $ins)
                            @if($ins->id == $anggota->instansi_id)
                            <option value="{{ $ins->id }}" selected>{{ $ins->instansi }}</option>
                            @else
                            <option value="{{ $ins->id }}">{{ $ins->instansi }}</option>
                            @endif
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
                    <label for="Jenis kelamin" class="form-control-label col-2 text-right @error('instansi') is-invalid @enderror">Instansi</label>
                    <div class="col-10 px-5">
                        <div class="row">
                            <div class="form-check col-3">
                                <input class="form-check-input" type="radio" name="gender" id="gender1" value="Laki - laki" @if($anggota->gender == 'Laki - laki') checked @endif>
                                <label class="form-check-label" for="gender1">
                                  Laki - laki
                                </label>
                              </div>
                              <div class="form-check col-3">
                                <input class="form-check-input" type="radio" name="gender" id="gender2" value="Perempuan" @if($anggota->gender == 'Perempuan') checked @endif>
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
                        <input type="text" class="form-control form-control-sm @error('tempat') is-invalid @enderror" id="tempat" name="tempat" autocomplete="off" value="{{ $anggota->tempat }}">
                        @error('tempat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <label for="tanggal_lahir" class="form-control-label col-2 text-right">Tanggal Lahir</label>
                    <div class="col-4">
                        <input type="date" class="form-control form-control-sm @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" name="tanggal_lahir" autocomplete="off" value="{{ $anggota->tanggal_lahir }}">
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
                        <textarea name="alamat" id="alamat" cols="30" rows="3" class="form-control form-control-sm">{{ $anggota->alamat }}</textarea>
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