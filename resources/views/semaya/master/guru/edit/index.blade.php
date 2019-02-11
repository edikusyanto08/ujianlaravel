@extends('semaya.layouts.app')

@section('content')

<!-- Start breadcrumb content -->
    <div class="card-panel">
      <div class="row mar-bot">
        <div class="col s12 m12 l12">
          <h4 class="page-title">Ubah Guru</h4>
        </div>
      </div>
      <div class="row mar-bot">
        <div class="col s12 m7 l7">
          <ul class="custom-breadcrumb">
            <li><a href="#">Master</a></li>
            <li><a href="#">Guru</a></li>
            <li><a href="#">Ubah</a></li>
            <li>Data Pribadi</li>
          </ul>
        </div>
        <div class="col s12 m5 l5">
          <a href="{{ route('guru_edit', ['id' => $data->id]) }}" class="btn btn-plus indigo tooltipped" data-position="top" data-delay="50" data-tooltip="Data Pribadi Guru"><i class="material-icons">person</i></a>
          <a href="{{ route('guru_edit_education', ['id' => $data->id]) }}" class="btn btn-plus indigo tooltipped" data-position="top" data-delay="50" data-tooltip="Data Pendidikan dan Kepegawaian Guru"><i class="material-icons">school</i></a>
          <a href="{{ route('guru_edit_experience', ['id' => $data->id]) }}" class="btn btn-plus indigo tooltipped" data-position="top" data-delay="50" data-tooltip="Data Keahlian Guru"><i class="material-icons">account_balance</i></a>
          <a href="{{ route('guru_edit_status', ['id' => $data->id]) }}" class="btn btn-plus indigo tooltipped" data-position="top" data-delay="50" data-tooltip="Data Status Guru"><i class="material-icons">verified_user</i></a>
        </div>
      </div>
    </div>
<!-- End breadcrumb content -->

<!-- Start content of page -->
<div class="row">
  <div class="col s12 m12 l12 child-content">
    @if ($errors->any())
      <div class="card-panel red white-text">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
      </div>
    @endif
    @if (session('message'))
      <div class="card-panel green white-text">
        {{ session('message') }}
      </div>
    @endif
    <div class="card-panel">
      <div class="center row">
        @if ($data->foto == "avatar.jpg")
          <img class="responsive-img" src="{{ url('assets/img/users/' . $data->foto) }}" alt="{{ $data->foto }}" width="150">
        @else
          <img class="responsive-img" src="{{ url('assets/img/users/guru/' . $data->foto) }}" alt="{{ $data->foto }}" width="150">
        @endif
      </div>
      <div class="row">
        <form class="col s12 m12 l12" action="{{ route('guru_update') }}" method="post" autocomplete="off" enctype="multipart/form-data">
          {!! csrf_field() !!}
          <input type="hidden" name="id_guru" value="{{ $data->id }}">
          <div class="row">
            <div class="input-field col s12 m6 l6">
              <input id="nip" name="nip" type="text" class="validate" value="{{ $data->nip }}">
              <label for="nip">NIP</label>
            </div>
            <div class="input-field col s12 m6 l6">
              <input id="nuptk" name="nuptk" type="text" class="validate" value="{{ $data->nuptk }}" required>
              <label for="nuptk">NUPTK</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m12 l12">
              <input id="no_ktp" name="no_ktp" type="text" class="validate" value="{{ $data->no_ktp }}" required>
              <label for="no_ktp">No. KTP</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m2 l2">
              <input id="gelar_depan" name="gelar_depan" type="text" class="validate" value="{{ $data->gelar_depan }}">
              <label for="gelar_depan">Gelar Depan</label>
            </div>
            <div class="input-field col s12 m8 l8">
              <input id="nama" name="nama" type="text" class="validate" value="{{ $data->nama }}" required>
              <label for="nama">Nama Lengkap</label>
            </div>
            <div class="input-field col s12 m2 l2">
              <input id="gelar_belakang" name="gelar_belakang" type="text" class="validate" value="{{ $data->gelar_belakang }}">
              <label for="gelar_belakang">Gelar Belakang</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m12 l12">
              <select class="select2" style="width: 100%;" name="kelamin">
                <option selected disabled>Jenis Kelamin</option>
                <option value="L" @if ( $data->kelamin == "L" ) selected @endif>Laki-laki</option>
                <option value="P" @if ( $data->kelamin == "P" ) selected @endif>Perempuan</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m6 l6">
              <input id="tempat_lahir" name="tempat_lahir" type="text" class="validate" value="{{ $data->tempat_lahir }}" required>
              <label for="tempat_lahir">Tempat Lahir</label>
            </div>
            <div class="input-field col s12 m6 l6">
              <input id="tgl_lahir" name="tgl_lahir" type="text" class="datepicker" value="{{ \Carbon\Carbon::createFromFormat('Y-m-d', $data->tgl_lahir)->format('d/m/Y') }}" required>
              <label for="tgl_lahir">Tanggal Lahir</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m12 l12">
              <select class="select2" style="width: 100%;" name="agama">
                <option selected disabled>Agama</option>
                @foreach ($agama as $value)
                  <option value="{{ $value['agama'] }}" @if ($value['agama'] == $data->agama) selected @endif>{{ $value['agama'] }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m12 l12">
              <textarea id="alamat" name="alamat" class="validate materialize-textarea">{{ $data->alamat }}</textarea>
              <label for="alamat">Alamat</label>
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
                @foreach ($provinsi as $value)
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
                @foreach ($kelurahan as $value_kelurahan)
                  <option value="{{ $value_kelurahan->id }}" @if($value_kelurahan->id == $data->kelurahan)selected @endif>{{ $value_kelurahan->nama_kelurahan }}</option>
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
            <div class="input-field col s12 m12 l12">
              <select class="select2" style="width: 100%;" name="status_kawin">
                <option selected disabled>Status Perkawinan</option>
                <option value="Kawin" @if ( $data->status_kawin == "Kawin") selected @endif>Kawin</option>
                <option value="Belum Kawin" @if ( $data->status_kawin == "Belum Kawin") selected @endif>Belum Kawin</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m6 l6">
              <input id="no_hp" name="no_hp" type="text" class="validate" value="{{ $data->no_hp }}">
              <label for="no_hp">No. HP</label>
            </div>
            <div class="input-field col s12 m6 l6">
              <input id="email" name="email" type="email" class="validate" value="{{ $data->email }}">
              <label for="email">Email</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m12 l12">
              <input id="nama_ibu" name="nama_ibu" type="text" class="validate" value="{{ $data->nama_ibu }}">
              <label for="nama_ibu">Nama Ibu</label>
            </div>
          </div>
          <div class="row">
            <div class="file-field input-field col s12 m6 l6">
              <div class="btn indigo">
                <span>Foto</span>
                <input type="file" name="foto">
              </div>
              <div class="file-path-wrapper">
                <input class="file-path validate" type="text" name="foto">
              </div>
            </div>
            <div class="input-field col s12 m6 l6">
              <select class="select2" style="width: 100%;" name="status">
                <option selected disabled>Status</option>
                <option value="1" @if ($data->status == 1) selected @endif>Aktif</option>
                <option value="0" @if ($data->status == 0) selected @endif>Tidak Aktif</option>
              </select>
            </div>
          </div>
          @if ($data->status == 0)
            <div class="row">
              <div class="input-field col s12 m12 l12">
                <label for="tgl_non_aktif">Tanggal Tidak Aktif</label>
                <input id="tgl_non_aktif" name="tgl_non_aktif" type="text" class="validate" value="{{ \Carbon\Carbon::createFromFormat('Y-m-d', $data->tgl_non_aktif)->format('d-m-Y') }}" disabled>
              </div>
            </div>
          @endif
          <div class="row">
            <div class="input-field col s12 m12 l12">
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
