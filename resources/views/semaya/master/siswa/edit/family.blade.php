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
            <li>Data Keluarga</li>
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
      <div class="row">
        <form class="col s12 m12 l12" action="{{ route('siswa_update_family') }}" method="post" autocomplete="off">
          {!! csrf_field() !!}
          <input type="hidden" name="id_siswa" value="{{ $data->id }}">
          {{-- Ayah --}}
          <div class="row">
            <div class="center">
              <h4>Data Ayah @if ($data->hidup_ayah != null) (Alm) @endif</h4>
            </div>
            <div class="row">
              <div class="input-field col s12 m12 l12">
                <input id="nama_ayah" name="nama_ayah" type="text" class="validate" value="{{ $data->nama_ayah }}">
                <label for="nama_ayah">Nama Lengkap</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m6 l6">
                <input id="tempat_lahir_ayah" name="tempat_lahir_ayah" type="text" class="validate" value="{{ $data->tempat_lahir_ayah }}">
                <label for="tempat_lahir_ayah">Tempat Lahir</label>
              </div>
              <div class="input-field col s12 m6 l6">
                <input id="tanggal_lahir_ayah" name="tanggal_lahir_ayah" type="text" class="datepicker" @if ($data->tgl_lahir_ayah != null)
                  value="{{ \Carbon\Carbon::createFromFormat('Y-m-d', $data->tgl_lahir_ayah)->format('d/m/Y') }}" @endif>
                <label for="tanggal_lahir_ayah">Tanggal Lahir</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m12 l12">
                <select class="select2" style="width: 100%;" name="agama_ayah">
                  <option disabled selected>Agama</option>
                  @foreach ($agama as $value)
                    <option value="{{ $value['agama'] }}" @if ($value['agama'] == $data->agama_ayah) selected @endif>{{ $value['agama'] }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m6 l6">
                <input id="telp_ayah" name="telp_ayah" type="text" class="validate" value="{{ $data->telp_ayah }}">
                <label for="telp_ayah">No. Telp</label>
              </div>
              <div class="input-field col s12 m6 l6">
                <input id="kewarganegaraan_ayah" name="kewarganegaraan_ayah" type="text" class="validate" value="{{ $data->kewarganegaraan_ayah }}">
                <label for="kewarganegaraan_ayah">Kewarganegaraan</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m12 l12">
                <textarea id="alamat_ayah" name="alamat_ayah" class="validate materialize-textarea">{{ $data->alamat_ayah }}</textarea>
                <label for="alamat_ayah">Alamat</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m12 l12">
                <input id="pendidikan_ayah" name="pendidikan_ayah" type="text" class="validate" value="{{ $data->pendidikan_ayah }}">
                <label for="pendidikan_ayah">Pendidikan Terakhir</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m6 l6">
                <input id="pekerjaan_ayah" name="pekerjaan_ayah" type="text" class="validate" value="{{ $data->pekerjaan_ayah }}">
                <label for="pekerjaan_ayah">Pekerjaan</label>
              </div>
              <div class="input-field col s12 m6 l6">
                <input id="pengeluaran_ayah" name="pengeluaran_ayah" type="text" class="validate" value="{{ $data->pengeluaran_ayah }}">
                <label for="pengeluaran_ayah">Pengeluaran</label>
              </div>
            </div>
          </div>
          {{-- Bagi 2 --}}
          <div class="row">
            {{-- Ibu --}}
            <div class="col s12 m6 l6">
              <div class="row">
                <div class="center">
                  <h4>Data Ibu @if ($data->hidup_ibu != null) (Almh) @endif</h4>
                </div>
                <div class="row">
                  <div class="input-field col s12 m12 l12">
                    <input id="nama_ibu" name="nama_ibu" type="text" class="validate" value="{{ $data->nama_ibu }}">
                    <label for="nama_ibu">Nama Lengkap</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12 m6 l6">
                    <input id="tempat_lahir_ibu" name="tempat_lahir_ibu" type="text" class="validate" value="{{ $data->tempat_lahir_ibu }}">
                    <label for="tempat_lahir_ibu">Tempat Lahir</label>
                  </div>
                  <div class="input-field col s12 m6 l6">
                    <input id="tanggal_lahir_ibu" name="tanggal_lahir_ibu" type="text" class="datepicker" @if ($data->tgl_lahir_ibu != null)
                      value="{{ \Carbon\Carbon::createFromFormat('Y-m-d', $data->tgl_lahir_ibu)->format('d/m/Y') }}" @endif>
                    <label for="tanggal_lahir_ibu">Tanggal Lahir</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12 m12 l12">
                    <select class="select2" style="width: 100%;" name="agama_ibu">
                      <option disabled selected>Agama</option>
                      @foreach ($agama as $value)
                        <option value="{{ $value['agama'] }}" @if ($value['agama'] == $data->agama_ibu) selected @endif>{{ $value['agama'] }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12 m6 l6">
                    <input id="telp_ibu" name="telp_ibu" type="text" class="validate" value="{{ $data->telp_ibu }}">
                    <label for="telp_ibu">No. Telp</label>
                  </div>
                  <div class="input-field col s12 m6 l6">
                    <input id="kewarganegaraan_ibu" name="kewarganegaraan_ibu" type="text" class="validate" value="{{ $data->kewarganegaraan_ibu }}">
                    <label for="kewarganegaraan_ibu">Kewarganegaraan</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12 m12 l12">
                    <textarea id="alamat_ibu" name="alamat_ibu" class="validate materialize-textarea">{{ $data->alamat_ibu }}</textarea>
                    <label for="alamat_ibu">Alamat</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12 m12 l12">
                    <input id="pendidikan_ibu" name="pendidikan_ibu" type="text" class="validate" value="{{ $data->pendidikan_ibu }}">
                    <label for="pendidikan_ibu">Pendidikan Terakhir</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12 m6 l6">
                    <input id="pekerjaan_ibu" name="pekerjaan_ibu" type="text" class="validate" value="{{ $data->pekerjaan_ibu }}">
                    <label for="pekerjaan_ibu">Pekerjaan</label>
                  </div>
                  <div class="input-field col s12 m6 l6">
                    <input id="pengeluaran_ibu" name="pengeluaran_ibu" type="text" class="validate" value="{{ $data->pengeluaran_ibu }}">
                    <label for="pengeluaran_ibu">Pengeluaran</label>
                  </div>
                </div>
              </div>
            </div>
            {{-- Wali --}}
            <div class="col s12 m6 l6">
              <div class="row">
                <div class="center">
                  <h4>Data Wali</W4>
                </div>
                <div class="row">
                  <div class="input-field col s12 m12 l12">
                    <input id="nama_wali" name="nama_wali" type="text" class="validate" value="{{ $data->nama_wali }}">
                    <label for="nama_wali">Nama Lengkap</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12 m6 l6">
                    <input id="tempat_lahir_wali" name="tempat_lahir_wali" type="text" class="validate" value="{{ $data->tempat_lahir_wali }}">
                    <label for="tempat_lahir_wali">Tempat Lahir</label>
                  </div>
                  <div class="input-field col s12 m6 l6">
                    <input id="tanggal_lahir_wali" name="tanggal_lahir_wali" type="text" class="datepicker" @if ($data->tgl_lahir_wali != null)
                      value="{{ \Carbon\Carbon::createFromFormat('Y-m-d', $data->tgl_lahir_wali)->format('d/m/Y') }}" @endif>
                    <label for="tanggal_lahir_wali">Tanggal Lahir</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12 m12 l12">
                    <select class="select2" style="width: 100%;" name="agama_wali">
                      <option disabled selected>Agama</option>
                      @foreach ($agama as $value)
                        <option value="{{ $value['agama'] }}" @if ($value['agama'] == $data->agama_wali) selected @endif>{{ $value['agama'] }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12 m6 l6">
                    <input id="telp_wali" name="telp_wali" type="text" class="validate" value="{{ $data->telp_wali }}">
                    <label for="telp_wali">No. Telp</label>
                  </div>
                  <div class="input-field col s12 m6 l6">
                    <input id="kewarganegaraan_wali" name="kewarganegaraan_wali" type="text" class="validate" value="{{ $data->kewarganegaraan_wali }}">
                    <label for="kewarganegaraan_wali">Kewarganegaraan</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12 m12 l12">
                    <textarea id="alamat_wali" name="alamat_wali" class="validate materialize-textarea">{{ $data->alamat_wali }}</textarea>
                    <label for="alamat_wali">Alamat</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12 m12 l12">
                    <input id="pendidikan_wali" name="pendidikan_wali" type="text" class="validate" value="{{ $data->pendidikan_wali }}">
                    <label for="pendidikan_wali">Pendidikan Terakhir</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12 m6 l6">
                    <input id="pekerjaan_wali" name="pekerjaan_wali" type="text" class="validate" value="{{ $data->pekerjaan_wali }}">
                    <label for="pekerjaan_wali">Pekerjaan</label>
                  </div>
                  <div class="input-field col s12 m6 l6">
                    <input id="pengeluaran_wali" name="pengeluaran_wali" type="text" class="validate" value="{{ $data->pengeluaran_wali }}">
                    <label for="pengeluaran_wali">Pengeluaran</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m12 l12">
                <button type="submit" class="waves-effect waves-light btn indigo">Simpan</button>
              </div>
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
    $('#telp_ayah').mask('000000000000000');
    $('#telp_ibu').mask('000000000000000');
    $('#telp_wali').mask('000000000000000');
    $('#pengeluaran_ayah').mask("#.##0", {reverse: true});
    $('#pengeluaran_ibu').mask("#.##0", {reverse: true});
    $('#pengeluaran_wali').mask("#.##0", {reverse: true});
  });
  </script>
@endsection
