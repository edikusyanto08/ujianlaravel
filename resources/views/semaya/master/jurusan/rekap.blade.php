@extends('semaya.layouts.app')

@section('content')

  <div id="modal-export" class="modal">
      <form action="{{ route('jurusan_ekspor') }}" method="get" autocomplete="off" class="no-loader">
        <div class="modal-content">
          <div class="row">
            <div class="col s12 m12 l12 mar-bot">
              <h4 class="mar-bot">Ekspor Data Rekapitulasi</h4>
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
          <h4 class="page-title">Rekapitulasi Jurusan</h4>
        </div>
      </div>
      <div class="row mar-bot">
        <div class="col s6 m6 l6">
          <ul class="custom-breadcrumb">
            <li><a href="#">Master</a></li>
            <li><a href="#">Jurusan</a></li>
            <li>Rekapitulasi</li>
          </ul>
        </div>
        <div class="col s6 m6 l6">
          <div class="right">
            <a href="#modal-export" class="btn indigo tooltipped modal-trigger" data-position="top" data-delay="50" data-tooltip="Ekspor Rekapitulasi Jurusan"><i class="material-icons">cloud_upload</i></a>
          </div>
        </div>
      </div>
    </div>
<!-- End breadcrumb content -->

<!-- Start content of page -->
<div class="row">
  <div class="col s12 m12 l12 child-content">
    <div class="card-panel">
      <div class="row">
        <table class="striped centered">
          <thead>
            <tr>
              <th rowspan="2">No</th>
              <th rowspan="2">Keahlian</th>
              <th colspan="3">X</th>
              <th colspan="3">XI</th>
              <th colspan="3">XII</th>
              <th colspan="2">JML</th>
              <th rowspan="2">Jumlah Total</th>
            </tr>
            <tr>
              @for ($i=0; $i < 3; $i++)
                <th>L</th>
                <th>P</th>
                <th>JML</th>
              @endfor
              <th>L</th>
              <th>P</th>
            </tr>
          </thead>
          <tbody>
            @foreach($data as $key => $jur)
              @php
                $i = $key + 1;
              @endphp
              <tr>
                <td class="text-center">{{$jur->id}}.</td>
                <td>{{$jur->kode_jurusan}}</td>
                @php
                  $cxkls = App\Kelas::where('jurusan_id', $jur->id)->where('tingkat_id', 1)->count();
                  if ($cxkls != 0) {
                    $xkls = App\Kelas::where('jurusan_id', $jur->id)->where('tingkat_id', 1)->get();
                    for($i=0; $i<$cxkls;$i++){
                      $sislx[$i] = App\Siswa::join('kelas_siswa', 'siswa.id', '=', 'kelas_siswa.siswa_id')->join('kelas', 'kelas.id', '=', 'kelas_siswa.kelas_id')->where('status', 1)->where('lulus', 0)->where('kelas_siswa.kelas_id', $xkls[$i]->id)->where('kelamin', 'L')->count();
                      $sispx[$i] = App\Siswa::join('kelas_siswa', 'siswa.id', '=', 'kelas_siswa.siswa_id')->join('kelas', 'kelas.id', '=', 'kelas_siswa.kelas_id')->where('status', 1)->where('lulus', 0)->where('kelas_siswa.kelas_id', $xkls[$i]->id)->where('kelamin', 'P')->count();
                      $sisx[$i] = App\Siswa::join('kelas_siswa', 'siswa.id', '=', 'kelas_siswa.siswa_id')->join('kelas', 'kelas.id', '=', 'kelas_siswa.kelas_id')->where('status', 1)->where('lulus', 0)->where('kelas_siswa.kelas_id', $xkls[$i]->id)->count();
                    }
                    if($cxkls == "5"){
                      $slx = $sislx[0]+$sislx[1]+$sislx[2]+$sislx[3]+$sislx[4];
                      $spx = $sispx[0]+$sispx[1]+$sispx[2]+$sispx[3]+$sispx[4];
                      $ssx = $sisx[0]+$sisx[1]+$sisx[2]+$sisx[3]+$sisx[4];
                    }else if($cxkls == "4"){
                      $slx = $sislx[0]+$sislx[1]+$sislx[2]+$sislx[3];
                      $spx = $sispx[0]+$sispx[1]+$sispx[2]+$sispx[3];
                      $ssx = $sisx[0]+$sisx[1]+$sisx[2]+$sisx[3];
                    }else if($cxkls == "3"){
                      $slx = $sislx[0]+$sislx[1]+$sislx[2];
                      $spx = $sispx[0]+$sispx[1]+$sispx[2];
                      $ssx = $sisx[0]+$sisx[1]+$sisx[2];
                    }else if($cxkls == "2"){
                      $slx = $sislx[0]+$sislx[1];
                      $spx = $sispx[0]+$sispx[1];
                      $ssx = $sisx[0]+$sisx[1];
                    }else{
                      $slx = $sislx[0];
                      $spx = $sispx[0];
                      $ssx = $sisx[0];
                    }
                  } else {
                    $slx = 0;
                    $spx = 0;
                    $ssx = 0;
                  }
                @endphp
                <td class="text-center">{{$slx}}</td>
                <td class="text-center">{{$spx}}</td>
                <td class="text-center">{{$ssx}}</td>
                @php
                  $cxikls = App\Kelas::where('jurusan_id', $jur->id)->where('tingkat_id', 2)->count();
                  if ($cxikls != 0) {
                    $xikls = App\Kelas::where('jurusan_id', $jur->id)->where('tingkat_id', 2)->get();
                    for($o=0; $o<$cxikls;$o++){
                      $sislxi[$o] = App\Siswa::join('kelas_siswa', 'siswa.id', '=', 'kelas_siswa.siswa_id')->join('kelas', 'kelas.id', '=', 'kelas_siswa.kelas_id')->where('status', 1)->where('lulus', 0)->where('kelas_siswa.kelas_id', $xikls[$o]->id)->where('kelamin', 'L')->count();
                      $sispxi[$o] = App\Siswa::join('kelas_siswa', 'siswa.id', '=', 'kelas_siswa.siswa_id')->join('kelas', 'kelas.id', '=', 'kelas_siswa.kelas_id')->where('status', 1)->where('lulus', 0)->where('kelas_siswa.kelas_id', $xikls[$o]->id)->where('kelamin', 'P')->count();
                      $sisxi[$o] = App\Siswa::join('kelas_siswa', 'siswa.id', '=', 'kelas_siswa.siswa_id')->join('kelas', 'kelas.id', '=', 'kelas_siswa.kelas_id')->where('status', 1)->where('lulus', 0)->where('kelas_siswa.kelas_id', $xikls[$o]->id)->count();
                    }
                    if($cxikls == "5"){
                      $slxi = $sislxi[0]+$sislxi[1]+$sislxi[2]+$sislxi[3]+$sislxi[4];
                      $spxi = $sispxi[0]+$sispxi[1]+$sispxi[2]+$sispxi[3]+$sispxi[4];
                      $ssxi = $sisxi[0]+$sisxi[1]+$sisxi[2]+$sisxi[3]+$sisxi[4];
                    }else if($cxikls == "4"){
                      $slxi = $sislxi[0]+$sislxi[1]+$sislxi[2]+$sislxi[3];
                      $spxi = $sispxi[0]+$sispxi[1]+$sispxi[2]+$sispxi[3];
                      $ssxi = $sisxi[0]+$sisxi[1]+$sisxi[2]+$sisxi[3];
                    }else if($cxikls == "3"){
                      $slxi = $sislxi[0]+$sislxi[1]+$sislxi[2];
                      $spxi = $sispxi[0]+$sispxi[1]+$sispxi[2];
                      $ssxi = $sisxi[0]+$sisxi[1]+$sisxi[2];
                    }else if($cxikls == "2"){
                      $slxi = $sislxi[0]+$sislxi[1];
                      $spxi = $sispxi[0]+$sispxi[1];
                      $ssxi = $sisxi[0]+$sisxi[1];
                    }else{
                      $slxi = $sislxi[0];
                      $spxi = $sispxi[0];
                      $ssxi = $sisxi[0];
                    }
                  } else {
                    $slxi = 0;
                    $spxi = 0;
                    $ssxi = 0;
                  }
                @endphp
                <td class="text-center">{{$slxi}}</td>
                <td class="text-center">{{$spxi}}</td>
                <td class="text-center">{{$ssxi}}</td>
                @php
                  $cxiikls = App\Kelas::where('jurusan_id', $jur->id)->where('tingkat_id', 3)->count();
                  if ($cxiikls != 0) {
                    $xiikls = App\Kelas::where('jurusan_id', $jur->id)->where('tingkat_id', 3)->get();
                    for($s=0; $s<$cxiikls;$s++){
                      $sislxii[$s] = App\Siswa::join('kelas_siswa', 'siswa.id', '=', 'kelas_siswa.siswa_id')->join('kelas', 'kelas.id', '=', 'kelas_siswa.kelas_id')->where('status', 1)->where('lulus', 0)->where('kelas_siswa.kelas_id', $xiikls[$s]->id)->where('kelamin', 'L')->count();
                      $sispxii[$s] = App\Siswa::join('kelas_siswa', 'siswa.id', '=', 'kelas_siswa.siswa_id')->join('kelas', 'kelas.id', '=', 'kelas_siswa.kelas_id')->where('status', 1)->where('lulus', 0)->where('kelas_siswa.kelas_id', $xiikls[$s]->id)->where('kelamin', 'P')->count();
                      $sisxii[$s] = App\Siswa::join('kelas_siswa', 'siswa.id', '=', 'kelas_siswa.siswa_id')->join('kelas', 'kelas.id', '=', 'kelas_siswa.kelas_id')->where('status', 1)->where('lulus', 0)->where('kelas_siswa.kelas_id', $xiikls[$s]->id)->count();
                    }
                    if($cxiikls == "5"){
                      $slxii = $sislxii[0]+$sislxii[1]+$sislxii[2]+$sislxii[3]+$sislxii[4];
                      $spxii = $sispxii[0]+$sispxii[1]+$sispxii[2]+$sispxii[3]+$sispxii[4];
                      $ssxii = $sisxii[0]+$sisxii[1]+$sisxii[2]+$sisxii[3]+$sisxii[4];
                    }else if($cxiikls == "4"){
                      $slxii = $sislxii[0]+$sislxii[1]+$sislxii[2]+$sislxii[3];
                      $spxii = $sispxii[0]+$sispxii[1]+$sispxii[2]+$sispxii[3];
                      $ssxii = $sisxii[0]+$sisxii[1]+$sisxii[2]+$sisxii[3];
                    }else if($cxiikls == "3"){
                      $slxii = $sislxii[0]+$sislxii[1]+$sislxii[2];
                      $spxii = $sispxii[0]+$sispxii[1]+$sispxii[2];
                      $ssxii = $sisxii[0]+$sisxii[1]+$sisxii[2];
                    }else if($cxiikls == "2"){
                      $slxii = $sislxii[0]+$sislxii[1];
                      $spxii = $sispxii[0]+$sispxii[1];
                      $ssxii = $sisxii[0]+$sisxii[1];
                    }else{
                      $slxii = $sislxii[0];
                      $spxii = $sispxii[0];
                      $ssxii = $sisxii[0];
                    }
                  } else {
                    $slxii = 0;
                    $spxii = 0;
                    $ssxii = 0;
                  }
                @endphp
                <td class="text-center">{{$slxii}}</td>
                <td class="text-center">{{$spxii}}</td>
                <td class="text-center">{{$ssxii}}</td>
                @php
                  $sisl = App\Jurusan::join('kelas', 'kelas.jurusan_id', '=', 'jurusan.id')->join('kelas_siswa', 'kelas_siswa.kelas_id', '=', 'kelas.id')->join('siswa', 'siswa.id', '=', 'kelas_siswa.siswa_id')->where('jurusan.id',  $jur->id)->where('status', 1)->where('lulus', 0)->where('siswa.kelamin',  'L')->groupBy('jurusan.kode_jurusan')->count();
                  $sisp = App\Jurusan::join('kelas', 'kelas.jurusan_id', '=', 'jurusan.id')->join('kelas_siswa', 'kelas_siswa.kelas_id', '=', 'kelas.id')->join('siswa', 'siswa.id', '=', 'kelas_siswa.siswa_id')->where('jurusan.id',  $jur->id)->where('status', 1)->where('lulus', 0)->where('siswa.kelamin',  'P')->groupBy('jurusan.kode_jurusan')->count();
                  $sis = App\Jurusan::join('kelas', 'kelas.jurusan_id', '=', 'jurusan.id')->join('kelas_siswa', 'kelas_siswa.kelas_id', '=', 'kelas.id')->join('siswa', 'siswa.id', '=', 'kelas_siswa.siswa_id')->where('jurusan.id',  $jur->id)->where('status', 1)->where('lulus', 0)->groupBy('jurusan.kode_jurusan')->count();
                @endphp
                <td class="text-center">{{$sisl}}</td>
                <td class="text-center">{{$sisp}}</td>
                <td class="text-center">{{$sis}}</td>
              </tr>
              @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- End content of page -->

@endsection
