@extends('semaya.layouts.app')

@section('content')

<!-- Start breadcrumb content -->
    <div class="card-panel">
      <div class="row mar-bot">
        <div class="col s12 m12 l12">
          <h4 class="page-title">Tambah Karyawan</h4>
        </div>
      </div>
      <div class="row mar-bot">
        <div class="col s12 m12 l12">
          <ul class="custom-breadcrumb">
            <li><a href="#">Master</a></li>
            <li><a href="#">Karyawan</a></li>
            <li><a href="#">Tambah</a></li>
            <li>Data Pribadi</li>
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
        <form class="col s12 m12 l12" action="{{ route('karyawan_store') }}" method="post" autocomplete="off">
          {!! csrf_field() !!}
          <!-- <div class="row">
            <div class="input-field col s12 m12 l12">
              <select class="select2" style="width: 100%;" name="sekolah">
                <option selected disabled>Sekolah</option>
                @foreach ($sekolah as $value)
                  <option value="{{ $value->npsn }}">{{ $value->nama_sekolah }}</option>
                @endforeach
              </select>
            </div>
          </div> -->
          <div class="row">
            <div class="input-field col s12 m6 l6">
              <input id="nip" name="nip" type="text" class="validate">
              <label for="nip">NIP</label>
            </div>
            <div class="input-field col s12 m6 l6">
              <input id="nuptk" name="nuptk" type="text" class="validate" required>
              <label for="nuptk">NUPTK *</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m12 l12">
              <input id="no_ktp" name="no_ktp" type="text" class="validate" required>
              <label for="no_ktp">No. KTP *</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m2 l2">
              <input id="gelar_depan" name="gelar_depan" type="text" class="validate">
              <label for="gelar_depan">Gelar Depan</label>
            </div>
            <div class="input-field col s12 m8 l8">
              <input id="nama" name="nama" type="text" class="validate" required>
              <label for="nama">Nama Lengkap *</label>
            </div>
            <div class="input-field col s12 m2 l2">
              <input id="gelar_belakang" name="gelar_belakang" type="text" class="validate">
              <label for="gelar_belakang">Gelar Belakang</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m12 l12">
              <select class="select2" style="width: 100%;" name="kelamin">
                <option selected disabled>Jenis Kelamin *</option>
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m6 l6">
              <input id="tempat_lahir" name="tempat_lahir" type="text" class="validate" required>
              <label for="tempat_lahir">Tempat Lahir *</label>
            </div>
            <div class="input-field col s12 m6 l6">
              <input id="tgl_lahir" name="tgl_lahir" type="text" class="datepicker" required>
              <label for="tgl_lahir">Tanggal Lahir *</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m12 l12">
              <select class="select2" style="width: 100%;" name="agama">
                <option selected disabled>Agama *</option>
                @foreach ($agama as $value)
                  <option value="{{ $value['agama'] }}">{{ $value['agama'] }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m12 l12">
              <textarea id="alamat" name="alamat" class="validate materialize-textarea" required></textarea>
              <label for="alamat">Alamat *</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m6 l6">
              <input id="rt" name="rt" type="text" class="validate">
              <label for="rt">RT</label>
            </div>
            <div class="input-field col s12 m6 l6">
              <input id="rw" name="rw" type="text" class="validate">
              <label for="rw">RW</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m6 l6">
              <select class="select2" style="width: 100%;" name="provinsi" id="provinsi">
                <option selected disabled>Provinsi</option>
                @foreach ($provinsi as $value)
                  <option value="{{ $value->id }}">{{ $value->nama_provinsi }}</option>
                @endforeach
              </select>
            </div>
            <div class="input-field col s12 m6 l6">
              <select class="select2" style="width: 100%;" name="kota" id="kota">
                <option selected disabled>Kota</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m6 l6">
              <select class="select2" style="width: 100%;" name="kecamatan" id="kecamatan">
                <option selected disabled>Kecamatan</option>
              </select>
            </div>
            <div class="input-field col s12 m6 l6">
              <select class="select2" style="width: 100%;" name="kelurahan" id="kelurahan">
                <option selected disabled>Kelurahan</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m12 l12">
              <input id="kode_pos" name="kode_pos" type="text" class="validate">
              <label for="kode_pos">Kode Pos</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m12 l12">
              <select class="select2" style="width: 100%;" name="status_kawin">
                <option selected disabled>Status Perkawinan *</option>
                <option value="Kawin">Kawin</option>
                <option value="Belum Kawin">Belum Kawin</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m6 l6">
              <input id="no_hp" name="no_hp" type="text" class="validate">
              <label for="no_hp">No. HP</label>
            </div>
            <div class="input-field col s12 m6 l6">
              <input id="email" name="email" type="email" class="validate">
              <label for="email">Email</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m12 l12">
              <input id="nama_ibu" name="nama_ibu" type="text" class="validate">
              <label for="nama_ibu">Nama Ibu</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m12 l12">
              <button type="submit" class="waves-effect waves-light btn indigo">Selanjutnya</button>
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
    $('#nip').mask('00000000000000000000');
    $('#nuptk').mask('00000000000000000000');
    $('#no_ktp').mask('00000000000000000000');
    $('#no_hp').mask('000000000000000');
    $('#rt').mask('0000');
    $('#rw').mask('0000');
    $('#kode_pos').mask('000000');

    $("#provinsi").change(function() {
      var provid = $("#provinsi").val();

      $.ajax({
        method: "GET",
        url: "{{ url("ajax") }}" + "/" + provid + "/kota",
        data: {},
        dataType: 'json',
        success: function(json) {
          $('#kota').empty();
          $('#kota').append($('<option value="" selected disabled>Kota</option>'));
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
