@extends('semaya.layouts.app')

@section('content')

<!-- Start breadcrumb content -->
    <div class="card-panel">
      <div class="row mar-bot">
        <div class="col s12 m12 l12">
          <h4 class="page-title">Tambah Tahun Ajaran</h4>
        </div>
      </div>
      <div class="row mar-bot">
        <div class="col s12 m12 l12">
          <ul class="custom-breadcrumb">
            <li><a href="#">Master</a></li>
            <li><a href="#">Tahun Ajaran</a></li>
            <li>Tambah</li>
          </ul>
        </div>
      </div>
    </div>
<!-- End breadcrumb content -->

<!-- Start content of page -->
<div class="row">
  <div class="col s12 m12 l12 child-content">
    @if (count($errors) > 0)
      <div class="card-panel red white-text">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
      </div>
    @endif
    <div class="card-panel">
      <div class="row">
        <form class="col s12 m12 l12" action="{{ route('tahun_store') }}" method="post" autocomplete="off">
          {!! csrf_field() !!}
          <div class="row">
            <div class="input-field col s12 m12 l12">
              <input id="tahun_ajaran" name="tahun_ajaran" type="text" class="validate" required>
              <label for="tahun_ajaran">Tahun Ajaran</label>
            </div>
          </div>
          <div class="row">
            <div class="row col s12 m6 l6">
              <div class="input-field">
                <input id="tanggal_mulai" name="tanggal_mulai" type="text" class="datepicker" required>
                <label for="tanggal_mulai">Tanggal Mulai</label>
              </div>
            </div>
            <div class="row col s12 m6 l6">
              <div class="input-field">
                <input id="tanggal_selesai" name="tanggal_selesai" type="text" class="datepicker" required>
                <label for="tanggal_selesai">Tanggal Selesai</label>
              </div>
            </div>
            <div class="input-field col s12 m12 l12">
              <select class="select2" style="width: 100%;" name="status">
                <option disabled selected>Status</option>
                <option value="1">Aktif</option>
                <option value="0">Tidak Aktif</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m12 l12">
              <button type="submit" class="waves-effect waves-light btn indigo">Tambah</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- End content of page -->

@endsection

@section('asset_footer')

  <script>
  $(document).ready(function() {
    $('#tahun_ajaran').mask('0000/0000');
  });
</script>

@endsection
