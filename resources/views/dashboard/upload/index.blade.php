@extends('dashboard.base')

@section('css')
<link href="{{ asset('plugins/data-table/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid px-3">
    <div class="fade-in">
        <div class="card">
            <div class="card-header">
                <h4>Upload Data Anggota</h4>
            </div>
            <div class="card-body">
                <form action="/upload/anggota" method="post" enctype="multipart/form-data">
                    @csrf
                    <h5>Upload File Excel</h5>
                    <div class="mb-3">
                        <label for="formFileSm" class="form-label">Pilih data anggota dengan format excel</label>
                        <input class="form-control form-control-sm" id="formFileSm" type="file" name="excel">
                      </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4>Upload Data Rekening</h4>
            </div>
            <div class="card-body">
                <form action="/upload/rekening" method="post" enctype="multipart/form-data">
                    @csrf
                    <h5>Upload File Excel</h5>
                    <div class="mb-3">
                        <label for="formFileSm" class="form-label">Pilih data rekening dengan format excel</label>
                        <input class="form-control form-control-sm" id="formFileSm" type="file" name="excel">
                      </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection


@section('javascript')
<script>
    $(document).ready(() => {
        let notif = $('#notif').data('notif')

        if(notif > 0 ){
            $('#message').html($('#notif').data('message'))
            $('#toast').show()
            $('.toast').toast('show')
        }
    })
</script>
@endsection