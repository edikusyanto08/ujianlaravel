@extends('semaya.layouts.app')

@section('content')

  <div id="modal-export" class="modal">
      <form action="{{ route('jadwal_ekspor', ['semester' => $semester, 'hari_id' => $hari_id]) }}" method="get" autocomplete="off" class="no-loader">
        <div class="modal-content">
          <div class="row">
            <div class="col s12 m12 l12 mar-bot">
              <h4 class="mar-bot">Ekspor Jadwal Semester {{ $semester }} Hari {{ ($hari_id) ? App\Hari::find($hari_id)->hari : 'Hari' }}</h4>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m12 l12">
              <div class="label-block">Pilih format</div>
              <select class="select2" name="format">
                <option value="xls">.xls</option>
                <option value="pdf">.pdf</option>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-indigo btn-flat">Tutup</a>
          <button type="submit" class="waves-effect waves-indigo btn-flat">Ekspor</button>
        </div>
      </form>
    </div>

<!-- Start breadcrumb content -->
    <div class="card-panel">
      <div class="row mar-bot">
        <div class="col s12 m12 l12">
          <h4 class="page-title">Rekapitulasi Jadwal Pelajaran</h4>
        </div>
      </div>
      <div class="row mar-bot">
        <div class="col s6 m6 l6">
          <ul class="custom-breadcrumb">
            <li>Jadwal Pelajaran</li>
          </ul>
        </div>
        @if ($semester && $hari_id)
          <div class="col s6 m6 l6">
            <div class="right">
              <a href="#modal-export" class="btn indigo tooltipped modal-trigger" data-position="top" data-delay="50" data-tooltip="Ekspor Rekapitulasi Jadwal"><i class="material-icons">cloud_upload</i></a>
            </div>
          </div>
        @endif
      </div>
    </div>
<!-- End breadcrumb content -->

<!-- Start content of page -->
<div class="row">
  <div class="col s12 m12 l12 child-content">
    @if (session('message'))
      <div class="card-panel teal white-text">
        {{ session('message') }}
      </div>
    @endif
    @if ($errors->any())
      <div class="card-panel red white-text">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
      </div>
    @endif
    <div class="card-panel">
      <form action="{{ route('naik_kelas_process') }}" method="post">
        <div class="row">
          <div class="col s12 m12 l6">
            <span class="naik-kelas-text">Semester</span>
            <select name="semester" class="select2">
              <option value selected disabled>Pilih Semester</option>
              @for ($i=1; $i <= 6; $i++)
                <option value="{{ $i }}" @if ($i == $semester) selected @endif>{{ $i }}</option>
              @endfor
            </select>
          </div>
          <div class="col s12 m12 l6">
            <span class="naik-kelas-text">Hari</span>
            <select name="hari" class="select2">
              <option value selected disabled>Pilih Hari</option>
              @foreach ($hari as $value)
                <option value="{{ $value->id }}" @if ($value->id == $hari_id) selected @endif>{{ $value->hari }}</option>
              @endforeach
            </select>
          </div>
        </div>
      </form>
      <div class="row">
        <div class="col s12 m12 l12">
          <table class="striped centered">
            <thead>
              <tr>
                <th rowspan="2">No.</th>
                <th rowspan="2">Kelas</th>
                <th colspan="10">{{ ($hari_id) ? App\Hari::find($hari_id)->hari : 'Hari'}}</th>
              </tr>
              <tr>
                <th>1</th>
                <th>2</th>
                <th>3</th>
                <th>4</th>
                <th>5</th>
                <th>6</th>
                <th>7</th>
                <th>8</th>
                <th>9</th>
                <th>10</th>
              </tr>
            </thead>
            <tbody>
              @if ($semester && $hari_id)
                @foreach ($kelas as $key => $value)
                  @php
                  $jadwal = App\Jadwal::where('semester', $semester)
                  ->where('kelas_id', $value->id)
                  ->where('hari_id', $hari_id)
                  ->orderBy('jam_ke')
                  ->get();
                  @endphp
                  <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $value->nama_kelas }}</td>
                    @foreach ($jadwal as $jadwals)
                      <td>{{ $jadwals->pelajaran->pelajaran }}</td>
                    @endforeach
                  </tr>
                @endforeach
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End content of page -->

@endsection

@section('asset_footer')
  <script>
    $(function() {
      $("select[name=semester]").change(function() {
        var semester = $("select[name=semester]").val();
        var hari = $("select[name=hari]").val();
        if (semester && hari) {
          $(location).attr('href', '{{ url('jadwal-pelajaran/rekap') }}' + '/' + semester + '/' + hari);
        }
      });

      $("select[name=hari]").change(function() {
        var semester = $("select[name=semester]").val();
        var hari = $("select[name=hari]").val();
        if (semester && hari) {
          $(location).attr('href', '{{ url('jadwal-pelajaran/rekap') }}' + '/' + semester + '/' + hari);
        }
      });
    });
  </script>
@endsection
