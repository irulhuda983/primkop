@extends('dashboard.errorBase')

@section('content')

    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="clearfix">
            <h1 class="float-left display-3 mr-4">403</h1>
            <h4 class="pt-3">Oops! Sesi Anda Telah Berakhir.</h4>
            <p class="text-muted">Silahkan Login untuk dapat mengakses page.</p>
          </div>
          <div class="input-prepend input-group">
              <a href="/login" class="btn btn-info btn-block" type="button">Ke halaman Login</a>
          </div>
        </div>
      </div>
    </div>

@endsection

@section('javascript')

@endsection