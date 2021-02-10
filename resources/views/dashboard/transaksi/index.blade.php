@extends('dashboard.base')

@section('css')
<link href="{{ asset('plugins/data-table/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('plugins/chosen/css/chosen.min.css') }}">
@endsection

@section('content')
<div class="container-fluid px-3">
    <div class="fade-in">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card" style="height: 65vh; overflow-y: auto">
                    <div class="card-body">
                        {{-- <form action="#" id="form-rekening"> --}}
                        <label for="no_rek" class="form-control-label">Cek No. Rekening</label>
                        <div class="input-group">
                            <select id="no_rek" class="form-control form-control-chosen" data-placeholder="Masukkan No. Rekening">
                                <option></option>
                                @foreach($rekening as $rek)
                                <option value="{{ $rek->no_rekening }}">{{ $rek->no_rekening }} ({{ $rek->nama }})</option>                                
                                @endforeach
                              </select>
                            {{-- <input type="text" class="form-control" placeholder="Masukkan No. Rekening" aria-label="rekening"> --}}
                            <button type="submit" class="btn btn-primary" id="rek">OK</button>
                        </div>
                        {{-- </form> --}}
                        <hr>
                    </div>
                    
                    <div class="card-body">
                        <h5 class="mb-3"><i>Catatan</i></h5>
                        <div class="d-flex">
                            <i class="cil-arrow-thick-right mr-3 mt-1 text-warning font-weight-bolder"></i>
                            <p> Untuk melakukan Transaksi silahkan masukkan No Rekening anggota Koperasi, kemudian OK.</p>
                        </div>
                        <div class="d-flex">
                            <i class="cil-arrow-thick-right mr-3 mt-1 text-warning font-weight-bolder"></i>
                            <p>Silahkan pilih menu yang tersedia, pastikan data anggota sesuai dengan anggota ayng akan melakukan transaksi.</p>
                        </div>
                        <div class="d-flex">
                            <i class="cil-arrow-thick-right mr-3 mt-1 text-warning font-weight-bolder"></i>
                            <p>Pastikan anggota yang akan melakukan transaksi sudah memiliki Rekening dan tidak dalam kondisi di bekukan atau di tutup.</p>
                        </div>
                        <div class="d-flex">
                            <i class="cil-arrow-thick-right mr-3 mt-1 text-warning font-weight-bolder"></i>
                            <p>Untuk informasi anggota dan rekening ada dalam menu Anggota.</p>
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
<script>
    $(document).ready(() => {

        let notif = $('#notif').data('notif')

        if(notif > 0 ){
            $('#message').html($('#notif').data('message'))
            $('#toast').show()
            $('.toast').toast('show')
        }

        $('.form-control-chosen').chosen({
            allow_single_deselect: true,
            width: '100%'
        });

        $('#rek').on('click', () => {
            let no_rek = $('#no_rek').val()

            if(no_rek){
                window.location.href = baseUrl + '/transaksi/' + no_rek
            }else{
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success ml-2',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                    title: 'Warning ?',
                    text: "Masukkan No. Rekening!",
                    icon: 'warning',
                    showCancelButton: false,
                    confirmButtonText: 'Kembali',
                    cancelButtonText: 'Cancel',
                    reverseButtons: true
                })
            }

            // end
        })


    })
</script>
@endsection