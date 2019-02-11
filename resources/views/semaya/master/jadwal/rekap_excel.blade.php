<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Rekapitulasi Jadwal Pelajaran</title>
  </head>
  <body>
    @php
    $css_table = 'style="border-collapse: collapse: border-spacing:0"';
    $css_thead = '';
    $css_th = 'width="10"; style="vertical-align: middle"';
    $css_td = 'width="10"; style="vertical-align: middle"';
    $css_td_total = 'width="15"; style="vertical-align: middle"';
    @endphp
    <table {!! $css_table !!}>
      <thead {!! $css_thead !!}>
        <tr>
          <th rowspan="2" {!! $css_th !!}>No.</th>
          <th rowspan="2" {!! $css_th !!}>Kelas</th>
          <th colspan="10" {!! $css_th !!}>{{ App\Hari::find($hari_id)->hari }}</th>
        </tr>
        <tr>
          <th {!! $css_th !!}></th>
          <th {!! $css_th !!}></th>
          <th {!! $css_th !!}>1</th>
          <th {!! $css_th !!}>2</th>
          <th {!! $css_th !!}>3</th>
          <th {!! $css_th !!}>4</th>
          <th {!! $css_th !!}>5</th>
          <th {!! $css_th !!}>6</th>
          <th {!! $css_th !!}>7</th>
          <th {!! $css_th !!}>8</th>
          <th {!! $css_th !!}>9</th>
          <th {!! $css_th !!}>10</th>
        </tr>
      </thead>
      <tbody>
        <tbody>
          @foreach ($kelas as $key => $value)
            @php
            $jadwal = App\Jadwal::where('semester', $semester)
            ->where('kelas_id', $value->id)
            ->where('hari_id', $hari_id)
            ->orderBy('jam_ke')
            ->get();
            @endphp
            <tr>
              <td {!! $css_td !!}>{{ $key + 1 }}</td>
              <td {!! $css_td !!}>{{ $value->nama_kelas }}</td>
              @foreach ($jadwal as $jadwals)
                <td {!! $css_td !!}>{{ $jadwals->pelajaran->pelajaran }}</td>
              @endforeach
            </tr>
          @endforeach
        </tbody>
      </tbody>
    </table>
  </body>
</html>
