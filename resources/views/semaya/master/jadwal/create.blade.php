@extends('semaya.layouts.app')

@section('content')

<!-- Start breadcrumb content -->
    <div class="card-panel">
      <div class="row mar-bot">
        <div class="col s12 m12 l12">
          <h4 class="page-title">Tambah Jadwal Pelajaran</h4>
        </div>
      </div>
      <div class="row mar-bot">
        <div class="col s12 m12 l12">
          <ul class="custom-breadcrumb">
            <li><a href="#">Master</a></li>
            <li><a href="#">Jadwal Pelajaran</a></li>
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
        <form class="col s12 m12 l12" action="{{ route('jadwal_store') }}" method="post" autocomplete="off">
          {!! csrf_field() !!}
          <div class="row">
            <div class="input-field col s12 m12 l12">
              <select class="select2" style="width: 100%;" name="hari">
                <option selected disabled>Hari</option>
                @foreach ($hari as $value)
                  <option value="{{ $value->id }}">{{ $value->hari }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m12 l12">
              <input id="jam_ke" name="jam_ke" type="text" class="validate" required>
              <label for="jam_ke">Jam Ke</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m6 l6">
              <input id="jam_mulai" name="jam_mulai" type="text" class="validate timepicker" required>
              <label for="jam_mulai">Jam Mulai</label>
            </div>
            <div class="input-field col s12 m6 l6">
              <input id="jam_selesai" name="jam_selesai" type="text" class="validate timepicker" required>
              <label for="jam_selesai">Jam Selesai</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m6 l6">
              <select class="select2" style="width: 100%;" name="guru">
                <option selected disabled>Guru</option>
                @foreach ($guru as $value)
                  <option value="{{ $value->id }}">
                    @if ($value->gelar_depan != null) {{ $value->gelar_depan }}.@endif
                    {{ $value->nama }}@if ($value->gelar_belakang != null), {{ $value->gelar_belakang }}@endif
                  </option>
                @endforeach
              </select>
            </div>
            <div class="input-field col s12 m6 l6">
              <select class="select2" style="width: 100%;" name="pelajaran">
                <option selected disabled>Pelajaran</option>
                @foreach ($pelajaran as $value)
                  <option value="{{ $value->id }}">{{ $value->pelajaran }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m6 l6">
              <select class="select2" style="width: 100%;" name="tingkat" id="tingkat">
                <option selected disabled>Tingkat</option>
                @foreach ($tingkat as $value)
                  <option value="{{ $value->id }}">{{ $value->nama_tingkat }}</option>
                @endforeach
              </select>
            </div>
            <div class="input-field col s12 m6 l6">
              <select class="select2" style="width: 100%;" name="kelas" id="kelas">
                <option selected disabled>Kelas</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m12 l12">
              <input id="semester" name="semester" type="text" class="validate" required>
              <label for="semester">Semester</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m12 l12">
              <select class="select2" style="width: 100%;" name="tahun_ajaran">
                <option selected disabled>Tahun Ajaran</option>
                @foreach ($tahun as $value)
                  <option value="{{ $value->id }}">{{ $value->nama }}</option>
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

<script>
  $(function() {
    $('#jam_ke').mask('00');
    $('#semester').mask('00');
    $('#jam_mulai').mask('00:00');
    $('#jam_selesai').mask('00:00');
    $("#tingkat").change(function() {
      var tingkatid = $("#tingkat").val();

      $.ajax({
        method: "GET",
        url: "{{ url("ajax/tingkat") }}" + "/" + tingkatid + "/kelas",
        data: {},
        dataType: 'json',
        success: function(json) {
          $('#kelas').empty();
          $('#kelas').append($('<option value="" selected disabled>Kelas</option>'));
          $.each(json, function(i, value) {
            $('#kelas').append($('<option>').text(value.nama_kelas).attr('value', value.id));
          });
        }, error: function(e) {
          console.log('ajax error');
        }
      });
    });
  })
</script>

@endsection
