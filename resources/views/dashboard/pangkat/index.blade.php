@extends('dashboard.base')

@section('css')
<link href="{{ asset('plugins/data-table/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
@endsection


@section('content')

        <div class="container-fluid">
            <div class="fade-in">

              <!-- /.row-->
                <div class="row data-table">
                    <div class="card col-sm-6 p-0">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <button class="btn btn-sm btn-primary" id="btn-add">
                                    <i class="cil-plus"></i> Tambah Pangkat
                                </button>

                                <form action="">
                                    <div class="input-group">
                                        <input type="text" name="cari" class="form-control form-control-sm">
                                        <button class="btn btn-primary btn-sm">
                                            <i class="cil-search"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <table id="data-pangkat" class="table table-responsive" style="width:100%; height: 60vh; overflow-y: scroll">
                                <thead>
                                    <tr>
                                        <th width="1%">No</th>
                                        <th>Kesatuan</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                               
                            </table>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="bg-white">
                            <form action="/pangkat/create" method="post" id="form-add" class="p-4" style="display: none">
                                @csrf
                                <div class="form-group d-flex justify-content-between align-items-center">
                                    <h5 class="text-muted">Tambah Pangkat</h5>
                                    <button type="button" class="btn btn-ghost-danger btn-sm btn-pill cancel-form">
                                        <i class="cil-x"></i>
                                    </button>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label for="pangkat1" class="form-control-label text-muted">Pangkat</label>
                                    <input type="text" class="form-control" name="pangkat" id="pangkat1" autocomplete="off" autofocus>
                                    <div class="invalid-feedback" id="pangkat-error">
                                        Pangkat Harus Diisi.
                                    </div>
                                </div>
    
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="cil-save"></i> Simpan
                                    </button>
                                </div>
                            </form>
                        </div>

                        <div class="bg-white">
                            <form method="post" id="form-edit" class="p-4" style="display: none">
                                @csrf
                                <input type="hidden" name="id" id="id">
                                <div class="form-group d-flex justify-content-between align-items-center">
                                    <h5 class="text-muted">Edit Pangkat</h5>
                                    <button type="button" class="btn btn-ghost-danger btn-sm btn-pill cancel-form">
                                        <i class="cil-x"></i>
                                    </button>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label for="pangkat2" class="form-control-label text-muted">Pangkat</label>
                                    <input type="text" class="form-control" name="pangkat" id="pangkat2" autocomplete="off" autofocus>
                                </div>
    
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="cil-save"></i> Simpan
                                    </button>

                                    <button type="button" class="btn btn-danger btn-sm" id="delete-form">
                                        <i class="cil-trash"></i> Delete
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>

@endsection

@section('javascript')
<script type="text/javascript" language="javascript" src="{{ asset('plugins/data-table/js/jquery.dataTables.js') }}"></script>
<script>

   
        // let table = $('#data-pangkat').DataTable( {
        //         scrollY: '53vh',
        //         scrollCollapse: true,
        //         paging: false,
        //         ordering: false,
        //         searching: false,
        // });


    $('.cancel-form').on('click', () => {
        $('#data-pangkat tbody tr').removeClass('bg-warning')
        $('#form-add').hide()
        $('#form-edit').hide()
    })

    $('#btn-add').on('click', function(){
        $('#form-add').show()
        $('#form-edit').hide()
        $('#data-pangkat tbody tr').removeClass('bg-warning')
        $('#form-add').attr('action', '/pangkat/create')
    });

    $('#data-pangkat tbody').on('click', 'tr', function() {
        let id = $(this).data('id')
        let pangkat = $(this).data('pangkat')

        // console.log(id)
        $('#data-pangkat tbody tr').removeClass('bg-warning')
        $(this).toggleClass('bg-warning')
        $('#form-add').hide()
        $('#form-edit').show()

        $('#form-edit').attr('action', `/api/pangkat/update/${id}`)
        $('#pangkat2').val(pangkat)
        $('#id').val(id)


    })


    // crud
    $('#form-add').on('submit', async function(e) {
        e.preventDefault()
        let pangkat = $('#pangkat1').val()
        data = {pangkat : pangkat}


        await axios.post('/api/pangkat/create', data)
        .then(response => {
            $('#pangkat1').removeClass('is-invalid')
            $('#pangkat1').val('')
            $('#message').html(response.data.message)
            $('.toast').toast('show')
            showTable()
        })
        .catch(e => {
            let error = e.response.data.errors.pangkat
            $('#pangkat1').addClass('is-invalid')
            $('#pangkat-error').html(error[0])
        })

    })

    $('#form-edit').on('submit', async function(e) {
        e.preventDefault()
        let pangkat = $('#pangkat2').val()
        let url = $(this).attr('action')
        data = {pangkat : pangkat}


        await axios.post(url, data)
        .then(response => {
            $('#message').html(response.data.message)
            $('.toast').toast('show')
            $('#form-edit').hide()
            showTable()
        })
        .catch(e => {
            let error = e.response.data.errors.pangkat
            $('#pangkat1').addClass('is-invalid')
            $('#pangkat-error').html(error[0])
        })

    })

    $('#delete-form').on('click', function(){
        const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success ml-2',
            cancelButton: 'btn btn-danger'
        },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                let id = $('#id').val()
                axios.delete('/api/pangkat/delete/'+ id).then(res => {
                    $('#message').html(res.data)
                    $('.toast').toast('show')
                    $('#form-edit').hide()
                    showTable()
                })
            }
        })
    })


    // ajax
    function getPangkat(url = '', data = {}) {
        let response = fetch(url, {
                method: 'GET',
                mode: 'cors',
                cache: 'no-cache',
                credentials: 'same-origin',
                headers: {
                    "Accept" : "application/json",
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                },
                redirect: 'follow',
                referrerPolicy: 'no-referrer',
            }).then(res => res.json());


            return response
    }

    function getData(){
        var jdata;
        $.ajax({
            type: "GET",
            cache: false,
            async: false,
            url: baseUrl + "/api/pangkat/showAll",
            contentType: "application/json; charset=utf-8"
        }).done(function (result) {
            jdata = result;
            return jdata;
        }).fail(function (xhr, result, status) {
            alert('GetPermissions ' + xhr.statusText + ' ' + xhr.responseText + ' ' + xhr.status);
        });
        return jdata;
    }

    async function showTable()
    {
        let data = await getData();
        let tr = ""

        data.forEach((item, i) => {
            tr +=    `<tr data-id="${item.id}" data-pangkat="${item.pangkat}" style="cursor: pointer">
                            <td>${i + 1}</td>
                            <td>${item.pangkat}</td>
                        </tr>`;
        })

        $('#data-pangkat tbody').html(tr)
        
    }

    showTable()

    
</script>
@endsection