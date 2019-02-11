@extends('semaya.layouts.app')

@section('content')

<!-- Start breadcrumb content -->
    <div class="card-panel">
      <div class="row mar-bot">
        <div class="col s12 m12 l12">
          <h4 class="page-title">Ubah Siswa</h4>
        </div>
      </div>
      <div class="row mar-bot">
        <div class="col s6 m6 l6">
          <ul class="custom-breadcrumb">
            <li><a href="#">Master</a></li>
            <li><a href="#">Siswa</a></li>
            <li><a href="#">Ubah</a></li>
            <li>Data Pribadi</li>
          </ul>
        </div>
        <div class="col s6 m6 l6">
          <a href="{{ route('siswa_edit', ['id' => $data->id]) }}" class="btn btn-plus indigo tooltipped" data-position="top" data-delay="50" data-tooltip="Data Pribadi Siswa"><i class="material-icons">person</i></a>
          <a href="{{ route('siswa_edit_health', ['id' => $data->id]) }}" class="btn btn-plus indigo tooltipped" data-position="top" data-delay="50" data-tooltip="Data Kesehatan Siswa"><i class="material-icons">local_hospital</i></a>
          <a href="{{ route('siswa_edit_family', ['id' => $data->id]) }}" class="btn btn-plus indigo tooltipped" data-position="top" data-delay="50" data-tooltip="Data Orang Tua Siswa"><i class="material-icons">group</i></a>
          <a href="{{ route('siswa_edit_admin', ['id' => $data->id]) }}" class="btn btn-plus indigo tooltipped" data-position="top" data-delay="50" data-tooltip="Data Administrasi Siswa"><i class="material-icons">location_city</i></a>
          <a href="{{ route('siswa_edit_graduation', ['id' => $data->id]) }}" class="btn btn-plus indigo tooltipped" data-position="top" data-delay="50" data-tooltip="Data Kepindahan/Kelulusan Siswa"><i class="material-icons">school</i></a>
        </div>
      </div>
    </div>
<!-- End breadcrumb content -->

<!-- Start content of page -->
<div class="row">
  <div class="col s12 m12 l12 child-content">
    @if (session('message'))
      <div class="card-panel green white-text">
        {{ session('message') }}
      </div>
    @endif
    @if (count($errors) > 0)
      <div class="card-panel red white-text">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
      </div>
    @endif
    <div class="card-panel">
      <div class="center row">
        @if ($data->foto == "avatar.jpg")
          <img class="responsive-img" src="{{ url('assets/img/users/' . $data->foto) }}" alt="{{ $data->foto }}" width="150">
        @else
          <img class="responsive-img" src="{{ url('assets/img/users/siswa/' . $data->foto) }}" alt="{{ $data->foto }}" width="150">
        @endif
      </div>
      <div class="row">
        <form class="col s12 m12 l12" action="{{ route('siswa_update') }}" method="post" autocomplete="off" enctype="multipart/form-data">
          {!! csrf_field() !!}
          <input type="hidden" name="id_siswa" value="{{ $data->id }}">
          <input type="hidden" name="old_nis" value="{{ $data->nis }}">
          {{-- ini kiri --}}
          <div class="row col s12 m6 l6">
            <div class="row">
              <div class="input-field col s12 m6 l6">
                <input id="nis" name="nis" type="text" class="validate" value="{{ $data->nis }}" required>
                <label for="nis">NIS</label>
              </div>
              <div class="input-field col s12 m6 l6">
                <input id="nisn" name="nisn" type="text" class="validate" value="{{ $data->nisn }}" required>
                <label for="nisn">NISN</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m12 l12">
                <input id="nik" name="nik" type="text" class="validate" value="{{ $data->nik }}" required>
                <label for="nik">NIK</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m12 l12">
                <input id="nama_lengkap" name="nama_lengkap" type="text" class="validate" value="{{ $data->nama_lengkap }}" required>
                <label for="nama_lengkap">Nama Lengkap</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m12 l12">
                <input id="nama_panggilan" name="nama_panggilan" type="text" class="validate" value="{{ $data->nama_panggilan }}" required>
                <label for="nama_panggilan">Nama Panggilan</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m12 l12">
                <select class="select2" style="width: 100%;" name="jenis_kelamin">
                  <option disabled selected>Jenis Kelamin</option>
                  <option value="L" @if ($data->kelamin == "L") selected @endif>Laki-laki</option>
                  <option value="P" @if ($data->kelamin == "P") selected @endif>Perempuan</option>
                </select>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m6 l6">
                <input id="tempat_lahir" name="tempat_lahir" type="text" class="validate" value="{{ $data->tempat_lahir }}" required>
                <label for="tempat_lahir">Tempat Lahir</label>
              </div>
              <div class="input-field col s12 m6 l6">
                <input id="tanggal_lahir" name="tanggal_lahir" type="text" class="datepicker" value="{{ \Carbon\Carbon::createFromFormat('Y-m-d', $data->tgl_lahir)->format('d/m/Y') }}">
                <label for="tanggal_lahir">Tanggal Lahir</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m12 l12">
                <select class="select2" style="width: 100%;" name="agama">
                  <option disabled selected>Agama</option>
                  @foreach ($agama as $value)
                    <option value="{{ $value['agama'] }}" @if ($value['agama'] == $data->agama) selected @endif>{{ $value['agama'] }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m12 l12">
                <input id="telp" name="telp" type="text" class="validate" value="{{ $data->no_telp }}">
                <label for="telp">No. Telp</label>
              </div>
            </div>
            <div class="row">
              <div class="file-field input-field col s12 m12 l12">
                <div class="btn indigo">
                  <span>Foto</span>
                  <input type="file" name="foto">
                </div>
                <div class="file-path-wrapper">
                  <input class="file-path validate" type="text" name="foto">
                </div>
              </div>
            </div>
          </div>
          {{-- ini kanan --}}
          <div class="row col s12 m6 l6">
            <div class="row">
              <div class="input-field col s12 m12 l12">
                <input id="kewarganegaraan" name="kewarganegaraan" type="text" class="validate" value="{{ $data->kewarganegaraan }}">
                <label for="kewarganegaraan">Kewarganegaraan</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m12 l12">
                <input id="bahasa" name="bahasa" type="text" class="validate" value="{{ $data->bahasa }}">
                <label for="bahasa">Bahasa Sehari-hari</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m12 l12">
                <input id="anak_ke" name="anak_ke" type="text" class="validate" value="{{ $data->anak_ke }}">
                <label for="anak_ke">Anak Ke</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m6 l6">
                <input id="saudara_kandung" name="saudara_kandung" type="text" class="validate" value="{{ $data->saudara_kandung }}">
                <label for="saudara_kandung">Jumlah Saudara Kandung</label>
              </div>
              <div class="input-field col s12 m6 l6">
                <input id="saudara_angkat" name="saudara_angkat" type="text" class="validate" value="{{ $data->saudara_angkat }}">
                <label for="saudara_angkat">Jumlah Saudara Angkat</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m12 l12">
                <select class="select2" style="width: 100%;" name="yatim">
                  <option disabled selected>Yatim / Piatu / Yatim Piatu</option>
                  @foreach ($yatim as $value)
                    <option value="{{ $value['yatim'] }}" @if ($value['yatim'] == $data->yatim) selected @endif>{{ $value['yatim'] }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m12 l12">
                <textarea id="alamat" name="alamat" class="materialize-textarea" required>{{ $data->alamat }}</textarea>
                <label for="alamat">Alamat</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m12 l12">
                <select class="select2" style="width: 100%;" name="status_tinggal">
                  <option disabled selected>Status Tempat Tinggal</option>
                  @foreach ($tinggal as $value)
                    <option value="{{ $value['tinggal'] }}" @if ($value['tinggal'] == $data->tinggal) selected @endif>{{ $value['tinggal'] }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m12 l12">
                <input id="jarak_tinggal" name="jarak_tinggal" type="text" class="validate" value="{{ $data->jarak_tinggal }}">
                <label for="jarak_tinggal">Jarak Tempat Tinggal ke Sekolah (KM)</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m12 l12">
                <select class="select2" style="width: 100%;" name="status">
                  <option disabled selected>Status</option>
                  <option value="1" @if ($data->status == 1) selected @endif>Aktif</option>
                  <option value="0" @if ($data->status == 0) selected @endif>Tidak Aktif</option>
                </select>
              </div>
            </div>
          </div>
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
