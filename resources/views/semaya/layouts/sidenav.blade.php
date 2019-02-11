@php
$active_dashboard = false;
if (str_is(url()->current(), route('home'))) {
  $active_dashboard = true;
}

$active_data_sekolah = false;
if (str_is(route('sekolah_index').'*', url()->current())) {
  $active_data_sekolah = true;
}
$active_tahun_ajaran = false;
if (str_is(route('tahun_index').'*', url()->current())) {
  $active_tahun_ajaran = true;
}
$active_hari = false;
if (str_is(route('hari_index').'*', url()->current())) {
  $active_hari = true;
}
$active_kalender_akademik = false;
if (str_is(route('kalender_akademik_index').'*', url()->current())) {
  $active_kalender_akademik = true;
}
$active_buku_induk = false;
if (str_is(route('buku_induk_index').'*', url()->current())) {
  $active_buku_induk = true;
}

$active_tingkat = false;
if (str_is(route('tingkat_index').'*', url()->current())) {
  $active_tingkat = true;
}
$active_jurusan = false;
if (str_is(route('jurusan_index').'*', url()->current())) {
  $active_jurusan = true;
}
$active_kelas = false;
if (str_is(route('kelas_index').'*', url()->current())) {
  $active_kelas = true;
}
$active_naik_kelas = false;
if (str_is(route('naik_kelas_index').'*', url()->current())) {
  $active_naik_kelas = true;
}

$active_admin = false;
if (str_is(route('admin_index').'*', url()->current())) {
  $active_admin = true;
}
$active_siswa = false;
if (str_is(route('siswa_index').'*', url()->current())) {
  $active_siswa = true;
}
$active_alumni = false;
if (str_is(route('alumni_index').'*', url()->current())) {
  $active_alumni = true;
}
$active_guru = false;
if (str_is(route('guru_index').'*', url()->current())) {
  $active_guru = true;
}
$active_karyawan = false;
if (str_is(route('karyawan_index').'*', url()->current())) {
  $active_karyawan = true;
}

$active_kelompok_pelajaran = false;
if (str_is(route('kelompok_index').'*', url()->current())) {
  $active_kelompok_pelajaran = true;
}
$active_pelajaran = false;
if (str_is(route('pelajaran_index').'*', url()->current())) {
  $active_pelajaran = true;
}
$active_jadwal = false;
if (str_is(route('jadwal_index').'*', url()->current())) {
  $active_jadwal = true;
}

$active_jenis_mutasi = false;
if (str_is(route('jenis_mutasi_index').'*', url()->current())) {
  $active_jenis_mutasi = true;
}
$active_mutasi_siswa = false;
if (str_is(route('mutasi_siswa_index').'*', url()->current())) {
  $active_mutasi_siswa = true;
}
$active_mutasi_guru = false;
if (str_is(route('mutasi_guru_index').'*', url()->current())) {
  $active_mutasi_guru = true;
}
$active_mutasi_karyawan = false;
if (str_is(route('mutasi_karyawan_index').'*', url()->current())) {
  $active_mutasi_karyawan = true;
}

$active_cctv = false;
if (str_is(route('cctv_index').'*', url()->current())) {
  $active_cctv = true;
}
$active_cloud = false;
if (str_is(route('cloud_computing_index').'*', url()->current())) {
  $active_cloud = true;
}
@endphp

<ul id="slide-out" class="side-nav fixed">
  <div class="bg-auth indigo">
    <div class="row mar-bot">
      <div class="col s12 m12 l12">
        <div class="center">
          <i class="material-icons logo-icon">school</i>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col s12 m12 l12">
        <div class="logo-text">
          Semaya
        </div>
        <div class="role-text hide-on-large-only">
          <span>
            {{ $role->display_name }}
          </span>
        </div>
      </div>
    </div>
  </div>
  <li @if($active_dashboard)class="active" @endif><a href="{{ route('home') }}" class="waves-effect waves-light"><i class="material-icons">dashboard</i>Dashboard</a></li>
  <li class="no-padding">
    <ul class="collapsible collapsible-accordion">
      @if ($role->id == 1 || $role->id == 2)
      <li>
        <a class="collapsible-header waves-effect waves-light @if($active_data_sekolah || $active_tahun_ajaran || $active_hari || $active_kalender_akademik || $active_buku_induk)active @endif"><i class="material-icons">school</i>Master Sekolah</a>
        <div class="collapsible-body">
          <ul>
            <li @if($active_data_sekolah)class="active" @endif><a href="{{ route('sekolah_index') }}" class="waves-effect waves-light">Data Sekolah</a></li>
            <li @if($active_tahun_ajaran)class="active" @endif><a href="{{ route('tahun_index') }}" class="waves-effect waves-light">Tahun Ajaran</a></li>
            <li @if($active_hari)class="active" @endif><a href="{{ route('hari_index') }}" class="waves-effect waves-light">Hari</a></li>
            <li @if($active_kalender_akademik)class="active" @endif><a href="{{ route('kalender_akademik_index') }}" class="waves-effect waves-light">Kalender Akademik</a></li>
            <li @if($active_buku_induk)class="active" @endif><a href="{{ route('buku_induk_index') }}" class="waves-effect waves-light">Buku Induk</a></li>
          </ul>
        </div>
      </li>
      <li>
        <a class="collapsible-header waves-effect waves-light @if($active_tingkat || $active_jurusan || $active_kelas || $active_naik_kelas)active @endif"><i class="material-icons">assessment</i>Master Pendidikan</a>
        <div class="collapsible-body">
          <ul>
            <li @if($active_tingkat)class="active" @endif><a href="{{ route('tingkat_index') }}" class="waves-effect waves-light">Tingkat</a></li>
            <li @if($active_jurusan)class="active" @endif><a href="{{ route('jurusan_index') }}" class="waves-effect waves-light">Jurusan</a></li>
            <li @if($active_kelas)class="active" @endif><a href="{{ route('kelas_index') }}" class="waves-effect waves-light">Kelas</a></li>
            <li @if($active_naik_kelas)class="active" @endif><a href="{{ route('naik_kelas_index') }}" class="waves-effect waves-light">Naik Kelas</a></li>
          </ul>
        </div>
      </li>
      <li>
        <a class="collapsible-header waves-effect waves-light @if($active_admin || $active_siswa || $active_alumni || $active_guru || $active_karyawan)active @endif"><i class="material-icons">supervisor_account</i>Master Pengguna</a>
        <div class="collapsible-body">
          <ul>
            <li @if($active_admin)class="active" @endif><a href="{{ route('admin_index') }}" class="waves-effect waves-light">Admin</a></li>
            <li @if($active_siswa)class="active" @endif><a href="{{ route('siswa_index') }}" class="waves-effect waves-light">Siswa</a></li>
            <li @if($active_alumni)class="active" @endif><a href="{{ route('alumni_index') }}" class="waves-effect waves-light">Alumni</a></li>
            <li @if($active_guru)class="active" @endif><a href="{{ route('guru_index') }}" class="waves-effect waves-light">Guru</a></li>
            <li @if($active_karyawan)class="active" @endif><a href="{{ route('karyawan_index') }}" class="waves-effect waves-light">Karyawan</a></li>
          </ul>
        </div>
      </li>
      <li>
        <a class="collapsible-header waves-effect waves-light @if($active_kelompok_pelajaran || $active_pelajaran || $active_jadwal)active @endif"><i class="material-icons">book</i>Master Pelajaran</a>
        <div class="collapsible-body">
          <ul>
            <li @if($active_kelompok_pelajaran)class="active" @endif><a href="{{ route('kelompok_index') }}" class="waves-effect waves-light">Kelompok Pelajaran</a></li>
            <li @if($active_pelajaran)class="active" @endif><a href="{{ route('pelajaran_index') }}" class="waves-effect waves-light">Pelajaran</a></li>
            <li @if($active_jadwal)class="active" @endif><a href="{{ route('jadwal_index') }}" class="waves-effect waves-light">Jadwal Pelajaran</a></li>
          </ul>
        </div>
      </li>
      <li>
        <a class="collapsible-header waves-effect waves-light @if($active_jenis_mutasi || $active_mutasi_siswa || $active_mutasi_guru || $active_mutasi_karyawan)active @endif"><i class="material-icons">forward</i>Master Mutasi</a>
        <div class="collapsible-body">
          <ul>
            <li @if($active_jenis_mutasi)class="active" @endif><a href="{{ route('jenis_mutasi_index') }}" class="waves-effect waves-light">Jenis Mutasi</a></li>
            <li @if($active_mutasi_siswa)class="active" @endif><a href="{{ route('mutasi_siswa_index') }}" class="waves-effect waves-light">Mutasi Siswa</a></li>
            <li @if($active_mutasi_guru)class="active" @endif><a href="{{ route('mutasi_guru_index') }}" class="waves-effect waves-light">Mutasi Guru</a></li>
            <li @if($active_mutasi_karyawan)class="active" @endif><a href="{{ route('mutasi_karyawan_index') }}" class="waves-effect waves-light">Mutasi Karyawan</a></li>
          </ul>
        </div>
      </li>
        @if ($role->id == 1)
        <li>
          <a class="collapsible-header waves-effect waves-light @if($active_cctv || $active_cloud)active @endif"><i class="material-icons">extension</i>Lainnya</a>
          <div class="collapsible-body">
            <ul>
              <li @if($active_cctv)class="active" @endif><a href="{{ route('cctv_index') }}" class="waves-effect waves-light">CCTV</a></li>
              <li @if($active_cloud)class="active" @endif><a href="{{ route('cloud_computing_index') }}" class="waves-effect waves-light">Semaya Cloud</a></li>
            </ul>
          </div>
        </li>
        @endif
      @elseif ($role->id == 4)
        <li class="waves-effect waves-light waves-block"><a href="{{ route('absensi_guru') }}"><i class="material-icons">fingerprint</i>Laporan Kehadiran</a></li>
        <li class="waves-effect waves-light waves-block"><a href="#!"><i class="material-icons">cloud</i>Menu Guru 2</a></li>
        <li class="waves-effect waves-light waves-block"><a href="#!"><i class="material-icons">cloud</i>Menu Guru 3</a></li>
      @elseif ($role->id == 5)
        <li class="waves-effect waves-light waves-block"><a href="{{ route('absensi_siswa') }}"><i class="material-icons">fingerprint</i>Laporan Kehadiran</a></li>
        <li class="waves-effect waves-light waves-block"><a href="#!"><i class="material-icons">cloud</i>Menu Siswa 2</a></li>
        <li class="waves-effect waves-light waves-block"><a href="#!"><i class="material-icons">cloud</i>Menu Siswa 3</a></li>
      @endif
    </ul>
  </li>
  <li class="hide-on-large-only"><a class="waves-effect waves-light"><i class="material-icons">account_circle</i>{{ strlen($user_name) > 15 ? substr($user_name, 0, 12).'...' : $user_name }}</a></li>
  <li class="hide-on-large-only"><a href="{{ route('logout') }}" class="waves-effect waves-light"><i class="material-icons">power_settings_new</i>Keluar</a></li>
</ul>
