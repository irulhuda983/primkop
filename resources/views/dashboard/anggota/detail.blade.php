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
                    {{-- <button class="btn btn-primary btn-sm add"> <i class="cil-plus"></i> Tambah Anggota</button> --}}
                    <button class="btn btn-primary btn-sm" id="reg-rekening"> <i class="cil-address-book"></i> Reg. Rekening</button>
                    {{-- <a href="/upload" class="btn btn-primary btn-sm" role="button">Upload Data</a> --}}
                </div>

                <div class="form-group">
                    <a href="/anggota" class="btn btn-danger btn-sm" role="button">Kembali</a>
                </div>
            </div>
            <div class="card-body py-2">
                <table class="table table-responsive-sm border-bottom" id="table-data-anggota">
                    <thead>
                      <tr>
                        <th width="10px">#</th>
                        <th>Nama/NIA/NIP</th>
                        <th>No. Rek</th>
                        <th>Pangkat/Kesatuan</th>
                        <th>Jenis kelamin</th>
                        <th>Tempat, Tanggal Lahir</th>
                        <th>Tanggal Masuk</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($anggota as $data)
                        <tr>
                            <td class="align-middle">
                                <input type="checkbox" class="pilih" value="{{ $data->id }}" style="cursor:pointer" />
                            </td>
                            <td class="align-middle"> <span class="text-success fw-bold">{{ $data->nama }}</span> <br> 
                                <small>{{ $data->nia }} / {{ $data->nrp }}</small>
                            </td>
                            <td class="align-middle">
                                @if($data->no_rekening)
                                    @if($data->status > 0)
                                    <span>{{ $data->no_rekening }}</span> <span class="badge badge-success">Aktif</span>
                                    @else
                                    <span>{{ $data->no_rekening }}</span> <span class="badge badge-danger">Nonaktif</span>
                                    @endif
                                @else
                                <span class="text-danger">Belum Ada</span>
                                @endif
                            </td>
                            <td class="align-middle">{{ $data->pangkat }} <br>
                                <small>{{ $data->instansi }}</small>
                            </td>
                            <td class="align-middle">{{ $data->gender }}</td>
                            <td class="align-middle">{{ $data->tempat }}, {{ $data->tanggal_lahir }}</td>
                            <td class="align-middle">{{ $data->tgl_masuk }}</td>
                            <td class="align-middle">
                                <div class="dropdown">
                                    <button class="btn btn-sm" id="dropdownMenu2" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="cil-list"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 34px, 0px); top: 0px; left: 0px; will-change: transform;">
                                        <a href="/anggota/{{ $data->id }}/edit" class="dropdown-item" type="button">
                                            <i class="cil-pencil mr-2"></i> Edit
                                        </a>
                                        <a href="/anggota/{{ $data->id }}" class="dropdown-item text-danger hapus-anggota" type="button">
                                            <i class="cil-trash mr-2"></i> Hapus
                                        </a>
                                    </div>
                                </div>
                            </td>
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