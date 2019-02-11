@extends('semaya.layouts.app')

@section('content')

<!-- Start breadcrumb content -->
    <div class="card-panel">
      <div class="row mar-bot">
        <div class="col s12 m12 l12">
          <h4 class="page-title">Tambah Siswa</h4>
        </div>
      </div>
      <div class="row mar-bot">
        <div class="col s12 m12 l12">
          <ul class="custom-breadcrumb">
            <li><a href="#">Master</a></li>
            <li><a href="#">Siswa</a></li>
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
      <form action="{{ route('siswa_store') }}" method="post" autocomplete="off">
        {!! csrf_field() !!}
        <div class="row">
          {{-- ini kiri --}}
          <div class="col s12 m6 l6">
            <div class="row">
              <div class="input-field col s12 m6 l6">
                <input id="nis" name="nis" type="text" class="validate" required value="{{ old('nis') }}">
                <label for="nis">NIS *</label>
              </div>
              <div class="input-field col s12 m6 l6">
                <input id="nisn" name="nisn" type="text" class="validate" required value="{{ old('nisn') }}">
                <label for="nisn">NISN *</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m12 l12">
                <input id="nik" name="nik" type="text" class="validate" required value="{{ old('nik') }}">
                <label for="nik">NIK *</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m12 l12">
                <input id="nama_lengkap" name="nama_lengkap" type="text" class="validate" required value="{{ old('nama_lengkap') }}">
                <label for="nama_lengkap">Nama Lengkap *</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m12 l12">
                <input id="nama_panggilan" name="nama_panggilan" type="text" class="validate" required value="{{ old('nama_panggilan') }}">
                <label for="nama_panggilan">Nama Panggilan *</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m12 l12">
                <select class="select2" style="width: 100%;" name="jenis_kelamin">
                  <option disabled selected>Jenis Kelamin *</option>
                  <option value="L" @if(old('jenis_kelamin') == 'L')selected @endif>Laki-laki</option>
                  <option value="P" @if(old('jenis_kelamin') == 'P')selected @endif>Perempuan</option>
                </select>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m6 l6">
                <input id="tempat_lahir" name="tempat_lahir" type="text" class="validate" required value="{{ old('tempat_lahir') }}">
                <label for="tempat_lahir">Tempat Lahir *</label>
              </div>
              <div class="input-field col s12 m6 l6">
                <input id="tanggal_lahir" name="tanggal_lahir" type="text" class="datepicker" value="{{ old('tanggal_lahir') }}">
                <label for="tanggal_lahir">Tanggal Lahir *</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m12 l12">
                <select class="select2" style="width: 100%;" name="agama">
                  <option disabled selected>Agama *</option>
                  @foreach ($agama as $value)
                    <option value="{{ $value['agama'] }}" @if(old('agama') == $value['agama'])selected @endif>{{ $value['agama'] }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m12 l12">
                <input id="telp" name="telp" type="text" class="validate" value="{{ old('telp') }}">
                <label for="telp">No. Telp</label>
              </div>
            </div>
          </div>
          {{-- ini kanan --}}
          <div class="col s12 m6 l6">
            <div class="row">
              <div class="input-field col s12 m12 l12">
                <input id="kewarganegaraan" name="kewarganegaraan" type="text" class="validate" value="{{ old('kewarganegaraan') }}">
                <label for="kewarganegaraan">Kewarganegaraan</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m12 l12">
                <input id="bahasa" name="bahasa" type="text" class="validate" value="{{ old('bahasa') }}">
                <label for="bahasa">Bahasa Sehari-hari</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m12 l12">
                <input id="anak_ke" name="anak_ke" type="text" class="validate" value="{{ old('anak_ke') }}">
                <label for="anak_ke">Anak Ke</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m6 l6">
                <input id="saudara_kandung" name="saudara_kandung" type="text" class="validate" value="{{ old('saudara_kandung') }}">
                <label for="saudara_kandung">Jumlah Saudara Kandung</label>
              </div>
              <div class="input-field col s12 m6 l6">
                <input id="saudara_angkat" name="saudara_angkat" type="text" class="validate" value="{{ old('saudara_angkat') }}">
                <label for="saudara_angkat">Jumlah Saudara Angkat</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m12 l12">
                <select class="select2" style="width: 100%;" name="yatim">
                  <option disabled selected>Yatim / Piatu / Yatim Piatu</option>
                  @foreach ($yatim as $value)
                    <option value="{{ $value['yatim'] }}" @if(old('yatim') == $value['yatim'])selected @endif>{{ $value['yatim'] }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m12 l12">
                <textarea id="alamat" name="alamat" class="materialize-textarea" required>{{ old('alamat') }}</textarea>
                <label for="alamat">Alamat *</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m12 l12">
                <select class="select2" style="width: 100%;" name="status_tinggal">
                  <option disabled selected>Status Tempat Tinggal</option>
                  @foreach ($tinggal as $value)
                    <option value="{{ $value['tinggal'] }}" @if(old('status_tinggal') == $value['tinggal'])selected @endif>{{ $value['tinggal'] }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m12 l12">
                <input id="jarak_tinggal" name="jarak_tinggal" type="text" class="validate" value="{{ old('jarak_tinggal') }}">
                <label for="jarak_tinggal">Jarak Tempat Tinggal ke Sekolah (KM)</label>
              </div>
            </div>
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
<!-- End content of page -->

@endsection

@section('asset_footer')
  <script>
  $(document).ready(function() {
    $('#nis').mask('0000000000');
    $('#nisn').mask('000000000000000');
    $('#nik').mask('00000000000000000000');
    $('#anak_ke').mask('000');
    $('#saudara_kandung').mask('000');
    $('#saudara_angkat').mask('000');
    $('#jarak_tinggal').mask('000');
    $('#telp').mask('000000000000000');
  });
  </script>
@endsection
