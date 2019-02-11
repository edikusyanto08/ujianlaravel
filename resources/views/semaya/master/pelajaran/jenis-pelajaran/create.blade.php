@extends('semaya.layouts.app')

@section('content')

<!-- Start breadcrumb content -->
    <div class="card-panel">
      <div class="row mar-bot">
        <div class="col s12 m12 l12">
          <h4 class="page-title">Tambah Kelompok Pelajaran</h4>
        </div>
      </div>
      <div class="row mar-bot">
        <div class="col s12 m12 l12">
          <ul class="custom-breadcrumb">
            <li><a href="#">Master</a></li>
            <li><a href="#">Kelompok Pelajaran</a></li>
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
        <form class="col s12 m12 l12" action="{{ route('kelompok_create') }}" method="post" autocomplete="off">
          {!! csrf_field() !!}
          <div class="row">
            <div class="input-field col s12 m6 l6">
              <input id="jenis_pelajaran" name="jenis_pelajaran" type="text" class="validate" required>
              <label for="jenis_pelajaran">Nama Kelompok</label>
            </div>
            <div class="input-field col s12 m6 l6">
              <div class="select2-label">
                Jurusan (Opsional)
              </div>
                <select class="select2" name="jurusan_id" id="jurusan_id">
                  <option value disabled selected>Pilih Jurusan</option>
                  <option value="0">Semua Jurusan</option>
                  @foreach ($jurusan as $value)
                    <option value="{{ $value->id }}">{{ $value->singkatan_jurusan }} - {{ $value->kode_jurusan }}</option>
                  @endforeach
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

<script type="text/javascript">
  $(document).ready(function () {
    // $('form').on('submit', function () {
    //   let jurusanId = $('#jurusan_id');
    //
    //   if (jurusanId.val() == null || jurusanId.val() == '') {
    //     alert('Pilih jurusan terlebih dahulu!');
    //     return false;
    //   }
    //
    //   return true;
    // });
  });
</script>

@endsection
