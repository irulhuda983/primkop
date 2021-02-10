@extends('dashboard.errorBase')

@section('content')

    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="clearfix">
            <h1 class="float-left display-3 mr-4">404</h1>
            <h4 class="pt-3">Oops!</h4>
            <p class="text-muted">Halaman Yang Anda Tuju Tidak Ditemukan.</p>
          </div>
          <a href="/" class="btn btn-info btn-block" type="button">Kembali Ke Dashboard</a>
        </div>
      </div>
    </div>

@endsection

@section('javascript')

@endsection