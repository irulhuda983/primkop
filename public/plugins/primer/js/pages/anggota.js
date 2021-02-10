
    $(document).ready(() => {

        let notif = $('#notif').data('notif')

        if(notif > 0 ){
            $('#message').html($('#notif').data('message'))
            $('#toast').show()
            $('.toast').toast('show')
        }

        $('.add').on('click', () => { window.location.href = baseUrl + '/anggota/create' });

        $('#table-data-anggota').DataTable();
        $('#table-data-anggota-instansi').DataTable();
        // -----------------------
        // config checkbox
        // -----------------------

        $(document).on("click", function (e) {
            if(e.target.classList.contains("pilih")){
                let check = e.target;
                if(check.checked){
                    $("input[type=checkbox]").prop("checked", false);
                    $('table tbody tr').removeClass('bg-gray-100', 'text-dark')
                    check.checked = true;
                    check.parentElement.parentElement.classList.add('bg-gray-100', 'text-dark');
                }else{
                    $('table tbody tr').removeClass('bg-gray-100', 'text-dark')
                }
            }
        });

        $('#reg-rekening').on('click', function(e){
            e.preventDefault
            let id = $("input:checked").val();
            if(id != undefined){
                window.location.href = baseUrl + '/rekening/'+id
            }else{
                const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success ml-2',
                    cancelButton: 'btn btn-danger'
                },
                    buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                    icon: 'error',
                    text: 'Pilih salah satu anggota!',
                })
            }

        })

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


        // -----------------------
        // tampil table
        // -----------------------



        // end

    })