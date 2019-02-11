@extends('semaya.layouts.app')

@section('content')

<!-- Start breadcrumb content -->
    <div class="card-panel">
      <div class="row mar-bot">
        <div class="col s12 m12 l12">
          <h4 class="page-title">Dashboard</h4>
        </div>
      </div>
      <div class="row mar-bot">
        <div class="col s12 m12 l12">
          <ul class="custom-breadcrumb">
            <li>Dashboard</li>
          </ul>
        </div>
      </div>
    </div>
<!-- End breadcrumb content -->

<!-- Start content of page -->
<div class="row">
  <div class="col s12 m12 l12 child-content">
    <!-- <div class="card-panel"> -->
      <div class="row">
        <div class="col s12 m12 l4">
            <div class="app-link-large card-panel light-blue darken-4 waves-effect waves-light waves-block" data-app="lgs/public">
              <i class="material-icons">language</i>
              <h5>Ujian Online</h5>
            </div>
        </div>
        <div class="col s12 m12 l4">
            <div class="card-panel cyan darken-1 waves-effect waves-light waves-block app-link" data-app="solution/public">
              <i class="material-icons small">fingerprint</i>
              <h5 class="small">Sistem Absensi Otomatis</h5>
            </div>
            <div class="card-panel pink darken-1 waves-effect waves-light waves-block app-link" data-app="digital-signage/public">
              <i class="material-icons small">tv</i>
              <h5 class="small">Digital Signage</h5>
            </div>
        </div>
        <div class="col s12 m12 l4">
            <div class="card-panel teal darken-2 waves-effect waves-light waves-block app-link" data-app="sp/public">
              <i class="material-icons small">local_library</i>
              <h5 class="small">Perpustakaan</h5>
            </div>
            <div class="card-panel deep-purple waves-effect waves-light waves-block app-link" data-app="">
              <i class="material-icons small">camera</i>
              <h5 class="small">CCTV</h5>
            </div>
        </div>
      </div>
    <!-- </div> -->
  </div>
</div>
<!-- End content of page -->

@endsection

@section('asset_footer')

<script type="text/javascript">
  $(document).ready(function() {
    $('[data-app]').on('click', function() {
        let appUri = $(this).attr('data-app');
        let webHost = window.location.origin;

        if (webHost.indexOf('localhost') == -1) {
          window.location.href = webHost + '/' + appUri;
        }
        else {
          window.location.href = webHost;
        }
    });
  });
</script>

@endsection
