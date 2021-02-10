$(document).ready(() => {

    let notif = $('#notif').data('notif')
    let rekeningAnggota = $('#rekening-anggota').data('rekening')

    if(notif > 0 ){
        $('#message').html($('#notif').data('message'))
        $('#toast').show()
        $('.toast').toast('show')
    }

    $('.submenu-transaksi').on('click', async function(e) {
        e.preventDefault()
        let url = $(this).attr('href')
        let jenis = $(this).data('transaksi')
        $('#menu-transaksi').toggle()
        $('#form-transaksi').attr('action', url)
        $('#box-transaksi').show()
        $('#recent-transaksi').hide()
        let data = await axios.post('/api/transaksi/getAnggota', { rekening : rekeningAnggota }).then(res => res.data)

        if(jenis == 'setor'){
            $('#box-transaksi').html(getFormSetor(data))
            $('#form-transaksi .card-footer').show()
        }
        else if(jenis == 'potongan'){
            $('#box-transaksi').html(getFormPotongan(data))
            $('#form-transaksi .card-footer').show()
        }
        else if(jenis == 'tarik'){
            $('#box-transaksi').html(getFormTarik(data))
            $('#form-transaksi .card-footer').hide()
        }
        else if(jenis == 'saldo'){
            $('#box-transaksi').html(getFormSaldo())
            $('#form-transaksi .card-footer').show()
        }else{
            $('#box-transaksi').html('Tidak Ada Transaksi Di Pilih')
            $('#form-transaksi .card-footer').hide()
        }


        $('#form-transaksi .input-sim').on('keyup', function() {
            let sim_wajib = parseInt($('input[name=sim_wajib]').val())
            let sim_pokok = parseInt($('input[name=sim_pokok]').val())
            let sim_sukarela = parseInt($('input[name=sim_sukarela]').val())
            let total = parseInt(sim_wajib + sim_pokok + sim_sukarela)
            let hasil = formatRupiah(total, 'Rp.')

            $('input[name=total]').val(hasil)
        })

        $('#form-transaksi .input-pot').on('keyup', function() {
            let pot_uang = parseInt($('input[name=pot_uang]').val())
            let pot_barang = parseInt($('input[name=pot_barang]').val())
            let pot_bahan = parseInt($('input[name=pot_bahan]').val())
            let pot_lain = parseInt($('input[name=pot_lain]').val())
            let total = parseInt(pot_uang + pot_barang + pot_bahan + pot_lain)
            let hasil = formatRupiah(total, 'Rp.')

            $('input[name=total]').val(hasil)
        })

        // batal tarik
        $('.batal-tarik').on('click', function() {
            Swal.fire({
                icon: 'warning',
                title: 'Simpan perubahan ?',
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: `Simpan`,
                denyButtonText: `Jangan Simpan`,
                }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $('#form-transaksi').submit()
                } else if (result.isDenied) {
                    window.location.reload();
                }
            })
        })

        $('.back').on('click', function(){
            window.location.reload()
        })

        // end
    })

    $('#form-transaksi').on('submit', function(e) {
        e.preventDefault()
        let url = $(this).attr('action')
        let total = $('input[name=total]').val()
        let hasil = formatRupiah(total, 'Rp.')

        if(total == '' || total == 0){
            Swal.fire(
                'Gagal Transaksi!',
                'Anda tidak boleh melakukan transaksi Rp. 0 !',
                'warning'
            )
            return false;
        }

        const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success mr-2',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })
        
        swalWithBootstrapButtons.fire({
            html: '<p class="text-left">Lanjutkan transaksi sebesar ' + hasil+ ' ? <br/> Tekan ya untuk menyimpan</p>',
            showCancelButton: true,
            confirmButtonText: `Ya`,
            cancelButtonText: `Tidak`,
            }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                $(this).unbind('submit').submit()
            }
        })

    })

    $('#batal-transaksi').on('click', function(){
        Swal.fire({
            icon: 'warning',
            title: 'Simpan perubahan ?',
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: `Simpan`,
            denyButtonText: `Jangan Simpan`,
            }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                $('#form-transaksi').submit()
            } else if (result.isDenied) {
                window.location.reload();
            }
        })

        // end
    })


    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix){
        let number_string = angka.toString().replace(/[^,\d]/g, ''),
        split   		= number_string.split(','),
        sisa     		= split[0].length % 3,
        rupiah     		= split[0].substr(0, sisa),
        ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if(ribuan){
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }




    // ui
    function getFormSetor(data)
    {
        return `<h5 class="mb-3">Anggota</h5>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <label class="form-control-label col-md-3">No. Rekening</label>
                    <div class="input-group col-md-6">
                        <p class="form-control-static">: ${data.anggota.no_rekening}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group row">
                    <label class="form-control-label col-md-4">Nama Lengkap</label>
                    <div class="input-group col-md-6">
                        <p class="form-control-static">: ${data.anggota.nama}</p>
                    </div>
                </div>
            </div>
        </div>

        <hr>
        <div class="form-group row">
        <label class="form-control-label col-2">No. Transaksi</label>
            <div class="input-group col-6">
                <input type="text" class="form-control form-control-sm" placeholder="${data.kode}" readonly>
            </div>
        </div>
        <div class="row">
            <div class="col-md-7">
                <h6 class="mb-4">Setoran Simpanan</h6>
                <div class="form-group row">
                    <label class="form-control-label col-4">Sim. Wajib</label>
                    <div class="input-group col-7">
                        <input type="number" class="form-control form-control-sm input-sim" name="sim_wajib" value="0" autocomplete="off">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="form-control-label col-4">Sim. Pokok</label>
                    <div class="input-group col-7">
                        <input type="number" class="form-control form-control-sm input-sim" name="sim_pokok" value="0" autocomplete="off">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="form-control-label col-4">Sim. Sukarela</label>
                    <div class="input-group col-7">
                        <input type="number" class="form-control form-control-sm input-sim" name="sim_sukarela" value="0" autocomplete="off">
                    </div>
                </div>

            </div>

            <div class="col-md-5">
                <div class="form-group">
                    <label class="form-control-label">Keterangan</label>
                    <textarea class="form-control" name="keterangan"></textarea>
                </div>

                <div class="form-group">
                    <label class="form-control-label">Jumlah</label>
                    <input type="text" class="form-control form-control-sm" name="total" value="0" readonly>
                </div>

            </div>

        </div>`
    }

    function getFormPotongan(data)
    {
        return `<h5 class="mb-3">Anggota</h5>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <label class="form-control-label col-md-3">No. Rekening</label>
                    <div class="input-group col-md-6">
                        <p class="form-control-static">: ${data.anggota.no_rekening}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group row">
                    <label class="form-control-label col-md-4">Nama Lengkap</label>
                    <div class="input-group col-md-6">
                        <p class="form-control-static">: ${data.anggota.nama}</p>
                    </div>
                </div>
            </div>
        </div>

        <hr>
        <div class="form-group row">
        <label class="form-control-label col-2">No. Transaksi</label>
            <div class="input-group col-6">
                <input type="text" class="form-control form-control-sm" placeholder="${data.kode}" readonly>
            </div>
        </div>
        <div class="row">
            <div class="col-md-7">
                <h6 class="mb-4">Setoran Simpanan</h6>
                <div class="form-group row">
                    <label class="form-control-label col-4">Pot. Uang</label>
                    <div class="input-group col-7">
                        <input type="number" class="form-control form-control-sm input-pot" name="pot_uang" value="0" autocomplete="off">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="form-control-label col-4">Pot. Barang</label>
                    <div class="input-group col-7">
                        <input type="number" class="form-control form-control-sm input-pot" name="pot_barang" value="0" autocomplete="off">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="form-control-label col-4">Pot. Bahan</label>
                    <div class="input-group col-7">
                        <input type="number" class="form-control form-control-sm input-pot" name="pot_bahan" value="0" autocomplete="off">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="form-control-label col-4">Pot. Lain - Lain</label>
                    <div class="input-group col-7">
                        <input type="number" class="form-control form-control-sm input-pot" name="pot_lain" value="0" autocomplete="off">
                    </div>
                </div>

            </div>

            <div class="col-md-5">
                <div class="form-group">
                    <label class="form-control-label">Keterangan</label>
                    <textarea class="form-control" name="keterangan"></textarea>
                </div>

                <div class="form-group">
                    <label class="form-control-label">Jumlah</label>
                    <input type="text" class="form-control form-control-sm" name="total" value="0" readonly>
                </div>

            </div>

        </div>`
    }

    function getFormTarik(data)
    {
        let opsi = '';
        if(data.saldo_simpanan_sukarela > 0 ){
            opsi += `<div class="form-group">
                        <label class="form-control-label">Uang yang ingin di tarik</label>
                        <input type="number" class="form-control" placeholder="0" name="total">
                        <small class="text-danger">Masukkan nilai tanpa titik dan koma.</small>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary btn-sm tarik"><i class="cil-arrow-thick-from-top"></i> Tarik</button>
                        <button type="button" class="btn btn-danger btn-sm batal-tarik"><i class="cil-x"></i> Batal</button>
                    </div>`
        }else {
            opsi += `<div class="form-group">
                        <p class="text-danger">Tidak ada Uang Yang Bisa Ditarik.</p>
                    </div>
                    <div>
                        <button type="button" class="btn btn-danger btn-sm back"><i class="cil-x"></i> Batal</button>
                    </div>`
        }
        return `
        <div class="row justify-content-center mt-4">
            <div class="col-md-6">
            <h5 class="mb-3">Data Anggota</h5>
                <div class="form-group row">
                    <label class="form-control-label col-md-4">No. Rekening</label>
                    <div class="input-group col-md-6">
                        <p class="form-control-static">: ${data.anggota.no_rekening}</p>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="form-control-label col-md-4">NIA / NRP</label>
                    <div class="input-group col-md-6">
                        <p class="form-control-static">: ${data.anggota.nia} / ${data.anggota.nrp}</p>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="form-control-label col-md-4">Nama Lengkap</label>
                    <div class="input-group col-md-6">
                        <p class="form-control-static">: ${data.anggota.nama}</p>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="form-control-label col-md-4">Tempat, Tanggal Lahir</label>
                    <div class="input-group col-md-6">
                        <p class="form-control-static">: ${data.anggota.tempat}, ${data.anggota.tanggal_lahir}</p>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="form-control-label col-md-4">Jenis Kelamin</label>
                    <div class="input-group col-md-6">
                        <p class="form-control-static">: ${data.anggota.gender}</p>
                    </div>
                </div>

                <hr>

                <h5>Penarikan</h5>
                <div class="form-group">
                    <label class="form-control-label">Uang Yang Bisa Di tarik</label>
                    <p class="form-control-static text-dark font-weight-bold" style="font-size: 24px">${formatRupiah(data.saldo_simpanan_sukarela, 'Rp. ')}</p>
                </div>
                ${opsi}
            </div>

        </div>
        `
    }

    function getFormSaldo()
    {
        return `saldo`
    }

// end document
})
