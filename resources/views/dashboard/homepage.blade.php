@extends('dashboard.base')

@section('content')
<div class="container-fluid">
  <div class="fade-in">
    <!-- /.row-->
    <div class="row">
      <div class="col-md-3">

        <div class="card">
          <div class="card-body p-3 d-flex align-items-center">
            <div class="bg-warning p-3 mr-3">
              <svg class="c-icon c-icon-xl">
                <use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-wallet"></use>
              </svg>
            </div>
            <div>
              <div class="text-value text-warning">1.999.000</div>
              <div class="text-muted text-uppercase font-weight-bold small">Simpanan</div>
            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-body p-3 d-flex align-items-center">
            <div class="bg-warning p-3 mr-3">
              <svg class="c-icon c-icon-xl">
                <use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-fax"></use>
              </svg>
            </div>
            <div>
              <div class="text-value text-warning">1.999.000</div>
              <div class="text-muted text-uppercase font-weight-bold small">Potongan</div>
            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-body p-3 d-flex align-items-center">
            <div class="bg-warning p-3 mr-3">
              <svg class="c-icon c-icon-xl">
                <use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-dollar"></use>
              </svg>
            </div>
            <div>
              <div class="text-value text-warning">1.999.000</div>
              <div class="text-muted text-uppercase font-weight-bold small">Penarikan</div>
            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-body p-3 d-flex align-items-center">
            <div class="bg-warning p-3 mr-3">
              <svg class="c-icon c-icon-xl">
                <use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-money"></use>
              </svg>
            </div>
            <div>
              <div class="text-value text-warning">1.999.000</div>
              <div class="text-muted text-uppercase font-weight-bold small">Saldo</div>
            </div>
          </div>
        </div>


      </div>

      <div class="col-md-9">
        <div class="card">
          <div class="card-body p-0">
            <table class="table table-responsive-sm table-hover table-outline m-0">
              <thead>
                <tr>
                  <th colspan="5">Transaksi Terakhir</th>
                </tr>
              </thead>
              <tbody>
                @foreach($log as $data)
                <tr>
                  <td class="text-center">
                    <div class="c-avatar"><img class="c-avatar-img" src="assets/img/avatars/1.jpg" alt="user@email.com"><span class="c-avatar-status bg-success"></span></div>
                  </td>
                  <td>
                    <div>{{ $data->kode_transaksi }}</div>
                    <div class="small text-muted"><span>{{ $data->no_rekening}}</span></div>
                  </td>
                  <td>
                    <div class="clearfix">
                      <small><i class="text-muted">{{ $data->keterangan }}</i></small>
                    </div>
                  </td>
                  <td class="text-center">
                    <small>{{ $data->jenis_transaksi }}</small>
                  </td>
                  <td>
                    <div class="small text-muted">Waktu Transaksi</div><strong>{{ \Carbon\Carbon::parse($data->tanggal)->diffForHumans() }}</strong>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- /.col-->
    </div>

    <!-- /.row-->
  </div>
</div>
@endsection

@section('javascript')

    <script src="{{ asset('js/Chart.min.js') }}"></script>
    <script src="{{ asset('js/coreui-chartjs.bundle.js') }}"></script>
    <script src="{{ asset('js/main.js') }}" defer></script>
@endsection
