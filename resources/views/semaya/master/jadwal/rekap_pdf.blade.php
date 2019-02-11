@extends('semaya.layouts.pdf')

@section('content')

    <h1 class="text-center">Jadwal Pelajaran Semester {{ $semester }} Hari {{ App\Hari::find($hari_id)->hari }}</h1>
    <div class="table-content">
      <table class="table">
        <thead>
          <tr>
            <th rowspan="2">No.</th>
            <th rowspan="2">Kelas</th>
            <th colspan="10">{{ App\Hari::find($hari_id)->hari }}</th>
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
        </tbody>
      </table>
    </div>

@endsection
