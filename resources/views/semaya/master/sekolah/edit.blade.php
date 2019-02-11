@extends('semaya.layouts.app')

@section('content')

<!-- Start breadcrumb content -->
<div class="card-panel">
  <div class="row mar-bot">
    <div class="col s12 m12 l12">
      <h4 class="page-title">Data Sekolah</h4>
    </div>
  </div>
  <div class="row mar-bot">
    <div class="col s12 m12 l12">
      <ul class="custom-breadcrumb">
        <li><a href="#">Master</a></li>
        <li>Data Sekolah</li>
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
    @if (session('message'))
      <div class="card-panel teal white-text">
        {{ session('message') }}
      </div>
    @endif
    <div class="card-panel">
      <div class="row">
        <div class="col s12 m12 l12">
          <div class="center">
            <img src="{{ url('assets/img/sekolah/'.$data->logo) }}" alt="{{ $data->nama_sekolah }}" height="200">
          </div>
        </div>
      </div>
      <div class="row">
        <form class="col s12 m12 l12" action="{{ route('sekolah_update') }}" method="post" autocomplete="off" enctype="multipart/form-data">
          {!! csrf_field() !!}
          <input type="hidden" name="id_sekolah" value="{{ $data->id }}">
          <div class="row">
            <div class="input-field col s12 m6 l6">
              <input id="npsn" name="npsn" type="text" class="validate" value="{{ $data->npsn }}" required>
              <label for="npsn">NPSN *</label>
            </div>
            <div class="input-field col s12 m6 l6">
              <input id="nama_sekolah" name="nama_sekolah" type="text" class="validate" value="{{ $data->nama_sekolah }}" required>
              <label for="nama_sekolah">Nama Sekolah *</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m12 l12">
              <textarea id="alamat" name="alamat" class="validate materialize-textarea" required>{{ $data->alamat }}</textarea>
              <label for="alamat">Alamat *</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m6 l6">
              <input id="rt" name="rt" type="text" class="validate" value="{{ $data->rt }}">
              <label for="rt">RT</label>
            </div>
            <div class="input-field col s12 m6 l6">
              <input id="rw" name="rw" type="text" class="validate" value="{{ $data->rw }}">
              <label for="rw">RW</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m6 l6">
              <select class="select2" style="width: 100%;" name="provinsi" id="provinsi">
                <option selected disabled>Provinsi</option>
                @foreach ($prov as $value)
                  <option value="{{ $value->id }}" @if ($value->id == $data->provinsi) selected @endif>{{ $value->nama_provinsi }}</option>
                @endforeach
              </select>
            </div>
            <div class="input-field col s12 m6 l6">
              <select class="select2" style="width: 100%;" name="kota" id="kota">
                <option selected disabled>Kota</option>
                @foreach ($kota as $value)
                  <option value="{{ $value->id }}" @if ($value->id == $data->kota) selected @endif>{{ $value->nama_kota }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m6 l6">
              <select class="select2" style="width: 100%;" name="kecamatan" id="kecamatan">
                <option selected disabled>Kecamatan</option>
                @foreach ($kecamatan as $value)
                  <option value="{{ $value->id }}" @if ($value->id == $data->kecamatan) selected @endif>{{ $value->nama_kecamatan }}</option>
                @endforeach
              </select>
            </div>
            <div class="input-field col s12 m6 l6">
              <select class="select2" style="width: 100%;" name="kelurahan" id="kelurahan">
                <option selected disabled>Kelurahan</option>
                @foreach ($kelurahan as $value)
                  <option value="{{ $value->id }}" @if ($value->id == $data->kelurahan) selected @endif>{{ $value->nama_kelurahan }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m12 l12">
              <input id="kode_pos" name="kode_pos" type="text" class="validate" value="{{ $data->kode_pos }}">
              <label for="kode_pos">Kode Pos</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m2 l2">
              <input id="kode_area_telp" name="kode_area_telp" type="text" class="validate" value="{{ $data->kode_area_telp }}">
              <label for="kode_area_telp">Kode Area Telp</label>
            </div>
            <div class="input-field col s12 m5 l5">
              <input id="no_telp" name="no_telp" type="text" class="validate" value="{{ $data->no_telp }}">
              <label for="no_telp">No. Telp</label>
            </div>
            <div class="input-field col s12 m5 l5">
              <input id="no_fax" name="no_fax" type="text" class="validate" value="{{ $data->no_fax }}">
              <label for="no_fax">No. Fax</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m12 l12">
              <input id="email" name="email" type="email" class="validate" value="{{ $data->email }}">
              <label for="email">Email</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m12 l12">
              <input id="daerah_khusus" name="daerah_khusus" type="text" class="validate" value="{{ $data->daerah_khusus }}">
              <label for="daerah_khusus">Daerah Khusus</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m12 l12">
              <input id="sk_daerah_khusus" name="sk_daerah_khusus" type="text" class="validate" value="{{ $data->sk_daerah_khusus }}">
              <label for="sk_daerah_khusus">No. SK Daerah Khusus</label>
            </div>
          </div>
          <div class="row">
            <div class="file-field input-field col s12 m12 l12">
              <div class="btn indigo">
                <span>Logo</span>
                <input type="file" name="logo" accept="image/*">
              </div>
              <div class="file-path-wrapper">
                <input class="file-path validate" type="text">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <button type="submit" class="waves-effect waves-light btn indigo">Simpan</button>
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
      $("#npsn").mask('0000000000');
      $("#rt").mask('0000');
      $("#rw").mask('0000');
      $("#kode_pos").mask('000000');
      $("#kode_area_telp").mask('0000');
      $("#no_telp").mask('00000000');
      $("#no_fax").mask('00000000');

      $("#provinsi").change(function() {
        var provid = $("#provinsi").val();

        $.ajax({
          method: "GET",
          url: "{{ url("ajax") }}" + "/" + provid + "/kota",
          data: {},
          dataType: 'json',
          success: function(json) {
            $('#kota').empty();
            $('#kecamatan').empty();
            $('#kelurahan').empty();
            $('#kota').append($('<option value="" selected disabled>Kota</option>'));
            $('#kecamatan').append($('<option value="" selected disabled>Kecamatan</option>'));
            $('#kelurahan').append($('<option value="" selected disabled>Kelurahan</option>'));
            $.each(json, function(i, value) {
              $('#kota').append($('<option>').text(value.nama_kota).attr('value', value.id));
            });
          }, error: function(e) {
            console.log('ajax error');
          }
        });
      });

      $("#kota").change(function() {
        var kotaid = $("#kota").val();

        $.ajax({
          method: "GET",
          url: "{{ url("ajax") }}" + "/" + kotaid + "/kecamatan",
          data: {},
          dataType: 'json',
          success: function(json) {
            $('#kecamatan').empty();
            $('#kecamatan').append($('<option value="" selected disabled>Kecamatan</option>'));
            $.each(json, function(i, value) {
              $('#kecamatan').append($('<option>').text(value.nama_kecamatan).attr('value', value.id));
            });
          }, error: function(e) {
            console.log('ajax error');
          }
        });
      });

      $("#kecamatan").change(function() {
        var kecid = $("#kecamatan").val();

        $.ajax({
          method: "GET",
          url: "{{ url("ajax") }}" + "/" + kecid + "/kelurahan",
          data: {},
          dataType: 'json',
          success: function(json) {
            $('#kelurahan').empty();
            $('#kelurahan').append($('<option value="" selected disabled>Kelurahan</option>'));
            $.each(json, function(i, value) {
              $('#kelurahan').append($('<option>').text(value.nama_kelurahan).attr('value', value.id));
            });
          }, error: function(e) {
            console.log('ajax error');
          }
        });
      });
    });
  </script>
@endsection
