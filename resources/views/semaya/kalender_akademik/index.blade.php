@extends('semaya.layouts.app')

@section('asset_header')

<link rel="stylesheet" href="{{ url('assets/plugins/fullcalendar/fullcalendar.min.css?v=').config('etc.asset_ver') }}">
<link rel="stylesheet" href="{{ url('assets/plugins/fullcalendar/fullcalendar.print.min.css?v=').config('etc.asset_ver') }}" media="print">

@endsection

@section('content')

<!-- Start breadcrumb content -->
    <div class="card-panel">
      <div class="row mar-bot">
        <div class="col s12 m12 l12">
          <h4 class="page-title">Kalender Akademik</h4>
        </div>
      </div>
      <div class="row mar-bot">
        <div class="col s12 m9 l9">
          <ul class="custom-breadcrumb">
            <li>Kalender Akademik</li>
          </ul>
        </div>
        <div class="col s12 m3 l3">
          <div class="right">
            <a href="{{ route('kalender_akademik_create') }}" class="btn btn-plus indigo tooltipped waves-effect waves-light" data-position="top" data-delay="50" data-tooltip="Tambah Kalender Akademik"><i class="material-icons">add</i></a>
            <a href="javascript:void(0)" class="btn indigo tooltipped waves-effect waves-light" data-position="top" data-delay="50" data-tooltip="Lihat Kalender Akademik" id="btn-calendar"><i class="material-icons">event</i></a>
          </div>
        </div>
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
    <div class="card-panel">
      <div id="table-content">
        <table class="striped centered">
          <thead>
            <tr>
                <th>No.</th>
                <th>Nama Kegiatan</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Tipe</th>
                <th>Tindakan</th>
            </tr>
          </thead>
          <tbody>
            @foreach($kalender_akademik as $value)
            <tr>
              <td>{{ $no++ }}.</td>
              <td>{{ $value->nama_kegiatan }}</td>
              <!-- <td><a href="{{ route('kalender_akademik_show', ['id'=>$value->id]) }}">{{ $value->nama_kegiatan }}</a></td> -->
              <td>{{ $value->tanggal_mulai }}</td>
              <td>{{ $value->tanggal_selesai }}</td>
              @if($value->tipe == 1)
              <td>Liburan</td>
              @elseif($value->tipe == 2)
              <td>Magang</td>
              @elseif($value->tipe == 3)
              <td>Kegiatan (Libur)</td>
              @elseif($value->tipe == 4)
              <td>Kegiatan (Tidak Libur)</td>
              @endif
              <td>
                <a href="{{ route('kalender_akademik_edit', ['id'=>$value->id]) }}" class="btn btn-edit indigo tooltipped waves-effect waves-light" data-position="top" data-delay="50" data-tooltip="Ubah Kalender Akademik"><i class="material-icons">edit</i></a>
                <a href="{{ route('kalender_akademik_destroy', ['id'=>$value->id]) }}" class="btn btn-delete indigo tooltipped waves-effect waves-light" data-position="top" data-delay="50" data-tooltip="Hapus Kalender Akademik" onclick="return confirm('Apakah anda yakin ingin menghapus kegiatan {{ $value->nama_kegiatan }} dari daftar kalender akademik?')"><i class="material-icons">delete</i></a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="center">
        {{ $kalender_akademik->links() }}
      </div>
      <div id="calendar">

      </div>
    </div>
  </div>
</div>
<!-- End content of page -->

@endsection

@section('asset_footer')

<script src="{{ url('assets/plugins/momentjs/moment.min.js?v=').config('etc.asset_ver') }}"></script>
<script src="{{ url('assets/plugins/fullcalendar/fullcalendar.min.js?v=').config('etc.asset_ver') }}"></script>
<script type="text/javascript">
$(document).ready(function() {
  $('#btn-calendar').on('click', function () {
    isRender = $('#table-content').css('display');
    _this = $(this);

    $('.tooltipped').tooltip();

    if (isRender == 'block') {
      _this.find('.material-icons').html('arrow_back');

      $('#table-content').css('display', 'none');
      $('#calendar').fullCalendar({
          header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay,listWeek'
          },
          defaultDate: '{{ Carbon::now() }}',
          navLinks: true, // can click day/week names to navigate views
          editable: true,
          eventLimit: true, // allow "more" link when too many events
          events: [
            @foreach($kalender as $value)
            {
              id: {{ $value->id }},
              title: '{{ $value->nama_kegiatan }}',
              start: '{{ $value->tanggal_mulai }}',
              end: '{{ $value->tanggal_selesai }}',
              backgroundColor: '{{ $value->warna_label }}',
              borderColor: '{{ $value->warna_label }}',
              url: '{{ route('kalender_akademik_show', ['id'=>$value->id]) }}',
            },
            @endforeach
          ],
          eventClick: function (e) {
            if (e.url) {
              window.open(e.url);
              return false;
            }
          }
        });
    }
    else {
      _this.find('.material-icons').html('event');

      $('#table-content').css('display', 'block');
      $('#calendar').fullCalendar('destroy');
    }
  });
});
</script>

@endsection
