@extends('dashboard.base')

@section('css')
<link href="{{ asset('plugins/data-table/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid px-3">
    <div class="fade-in">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center pb-0 mb-0">
                <div class="form-group">
                    <button class="btn btn-primary btn-sm add"> <i class="cil-plus"></i> Tambah Anggota</button>
                    <a href="/download" class="btn btn-primary btn-sm" role="button">Download Anggota</a>
                    {{-- <a href="/upload" class="btn btn-primary btn-sm" role="button">Upload Anggota</a> --}}
                </div>
            </div>
            <div class="card-body py-2">
                <table class="table table-responsive-sm border-bottom table-bordered" id="table-data-anggota-instansi">
                    <thead>
                      <tr>
                        <th width="10px">No</th>
                        <th>Kesatuan</th>
                        <th width="150px">Jumlah Anggota</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $data)
                        <tr>
                            <td class="align-middle">{{ $loop->iteration }}</td>
                            <td class="align-middle"> <a href="/anggota/kesatuan/{{ $data->id }}" class="text-success fw-bold">{{ $data->instansi }}</a> 
                            </td>
                            <td class="align-middle">{{ $data->jumlah }} Orang</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <form action="#" method="post" id="form-delete">
                    @method('delete')
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>

@endsection


@section('javascript')
<script type="text/javascript" language="javascript" src="{{ asset('plugins/data-table/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" language="javascript" src="{{ asset('plugins/data-table/js/dataTables.bootstrap4.js') }}"></script>
<script src="{{ asset('plugins/primer/js/pages/anggota.js') }}"></script>
@endsection