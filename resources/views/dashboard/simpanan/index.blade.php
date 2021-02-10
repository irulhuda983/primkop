@extends('dashboard.base')

@section('css')
<link href="{{ asset('plugins/data-table/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid px-3">
    <div class="fade-in">
        <div class="card">
            <div class="card-body px-2">
                <table class="table table-bordered" id="table-simpanan" style="width:100%">
                    <thead>
                      <tr>
                        <th class="align-middle">No. Transaksi /Tanggal</th>
                        <th class="align-middle">Nama Anggota /NIA</th>
                        <th class="align-middle text-right">Sim. Wajib</th>
                        <th class="align-middle text-right">Sim. Pokok</th>
                        <th class="align-middle text-right">Sim. Sukarela</th>
                        <th class="align-middle text-right">Jumlah</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($simpanan as $sim)
                            <tr>
                                <td class="align-middle">{{ $sim->kode_transaksi }} <br> <small>{{ $sim->tanggal }}</small> </td>
                                <td class="align-middle">{{ $sim->nama }} <br> <small>{{ $sim->nia }} / {{ $sim->no_rekening }}</small> </td>
                                <td class="align-middle text-right">Rp. {{ number_format($sim->sim_wajib, 0, ',', '.') }} </td>
                                <td class="align-middle text-right">Rp. {{ number_format($sim->sim_pokok, 0, ',', '.') }} </td>
                                <td class="align-middle text-right">Rp. {{ number_format($sim->sim_sukarela, 0, ',', '.') }} </td>
                                <td class="align-middle text-right">Rp. {{ number_format($sim->total_simpanan, 0, ',', '.') }} </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm" id="dropdownMenu2" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="cil-list"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenu2" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 34px, 0px); top: 0px; left: 0px; will-change: transform;">
                                            <a href="/simpanan/{{ $sim->kode_transaksi }}/edit" class="dropdown-item" type="button">
                                                <i class="cil-pencil mr-2"></i> Edit
                                            </a>
                                            <a href="/simpanan/{{ $sim->id }}" class="dropdown-item text-danger hapus-anggota" type="button">
                                                <i class="cil-trash mr-2"></i> Hapus
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="2" class="align-middle text-center">Total</th>
                            <th class="align-middle text-right">Rp. {{ number_format($total['sim_pokok'], 0, ',', '.') }} </th>
                            <th class="align-middle text-right">Rp. {{ number_format($total['sim_wajib'], 0, ',', '.') }} </th>
                            <th class="align-middle text-right">Rp. {{ number_format($total['sim_sukarela'], 0, ',', '.') }} </th>
                            <th class="align-middle text-right">Rp. {{ number_format($total['total_simpanan'], 0, ',', '.') }} </th>
                            <th></th>
                        </tr>
                    </tfoot>
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
<script>
    $(document).ready(() => {

        let notif = $('#notif').data('notif')

        if(notif > 0 ){
            $('#message').html($('#notif').data('message'))
            $('#toast').show()
            $('.toast').toast('show')
        }

        $('.hapus-anggota').on('click', function(e) {
            e.preventDefault()
            let href = $(this).attr('href')

            $('#form-delete').attr('action', href)
            const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success ml-2',
                cancelButton: 'btn btn-danger'
            },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Apa anda yakin ?',
                text: "Data yang di hapus tidak bisa di kembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#form-delete').submit()
                }
            })

            // 
        })

        $('#table-simpanan').DataTable();


    })
</script>
@endsection