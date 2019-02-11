@extends('semaya.layouts.app')

@section('content')

<!-- Start breadcrumb content -->
    <div class="card-panel">
      <div class="row mar-bot">
        <div class="col s12 m12 l12">
          <h4 class="page-title">Tambah Mutasi Siswa</h4>
        </div>
      </div>
      <div class="row mar-bot">
        <div class="col s12 m6 l6">
          <ul class="custom-breadcrumb">
            <li><a href="#">Mutasi Siswa</a></li>
            <li>Tambah</li>
          </ul>
        </div>
      </div>
    </div>
<!-- End breadcrumb content -->

<!-- Start content of page -->
<div class="row">
  <div class="col s12 m12 l12 child-content">
    @if ($errors->any())
      <div class="card-panel red white-text">
        <ul class="error-list">
          @foreach($errors->all() as $error)
          <li>
            {{ $error }}
          </li>
          @endforeach
        </ul>
      </div>
    @endif
    <div class="card-panel">
      <form action="{{ route('mutasi_siswa_store') }}" method="post" autocomplete="off">
        {{ csrf_field() }}
        <div class="row">
          <div class="input-field col s12 m12 l6">
            <select class="select2" name="kelas_id">
              <option value selected disabled>Pilih Kelas:</option>
              @foreach($kelas as $value)
              <option value="{{ $value->id }}">{{ $value->nama_kelas }}</option>
              @endforeach
            </select>
          </div>
          <div class="input-field col s12 m12 l6">
            <select class="select2" name="siswa_id">
              <option value selected disabled>Pilih Siswa:</option>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12 m12 l12">
            <select class="select2" name="jenis_mutasi_id">
              <option value selected disabled>Pilih Jenis Mutasi:</option>
              @foreach($jenis_mutasi as $value)
              <option value="{{ $value->id }}" @if(old('jenis_mutasi_id') == $value->id)selected @endif>{{ $value->mutasi }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="row mar-bot">
          <div class="input-field col s12 m12 l6">
            <select class="select2" name="tahun_ajaran_id">
              <option value selected disabled>Pilih Tahun Ajaran:</option>
              @foreach($tahun_ajaran as $value)
              <option value="{{ $value->id }}" @if(old('tahun_ajaran_id') == $value->id)selected @endif>{{ $value->nama }}</option>
              @endforeach
            </select>
          </div>
          <div class="input-field col s12 m12 l6">
            <input type="text" class="datepicker" name="tanggal" id="tanggal_mutasi" value="{{ old('tanggal') }}">
            <label for="tanggal_mutasi">Tanggal Mutasi</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12 m12 l6">
            <textarea id="alasan_mutasi" class="materialize-textarea" name="alasan" required>{{ old('alasan') }}</textarea>
            <label for="alasan_mutasi">Alasan Mutasi</label>
          </div>
          <div class="input-field col s12 m12 l6">
            <input id="mutasi_ke" type="text" class="validate" name="mutasi_ke" required value="{{ old('mutasi_ke') }}">
            <label for="mutasi_ke">Mutasi Ke</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12 m12 l12">
            <button type="submit" class="btn indigo waves-effect waves-light">Simpan</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- End content of page -->

@endsection

@section('asset_footer')

<script type="text/javascript">
  $(document).ready(function () {
    $('select[name=kelas_id]').on('change', function () {
      let _this = $(this);
      let siswa_select = $('select[name=siswa_id]');
      siswa_select.find('.addition-opt').remove();
      // siswa_select.val(0);

      $.ajax({
        url: '{{ url('ajax') }}/' + _this.val() + '/siswa/all',
        type: 'get',
        dataType: 'json',
        success:function (data) {
          let no = 0;

          for (let siswa_val of data.siswa) {
            no++;
            let newOpt = $('<option>');
            newOpt.attr('value', siswa_val.siswa_id);
            newOpt.addClass('addition-opt');
            newOpt.text(siswa_val.siswa_nama);
            siswa_select.append(newOpt);

            // if (no == 1) {
            //   siswa_select.val(siswa_val.siswa_id);
            // }
          }
        },
        error:function () {

        }
      })
    });
  });
</script>
@endsection
