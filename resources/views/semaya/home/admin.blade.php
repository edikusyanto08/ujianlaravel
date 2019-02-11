<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>{{ config('app.name') }}</title>
    @include('semaya.layouts.main_asset')
    <link rel="stylesheet" href="{{ url('assets/plugins/font-awesome/css/font-awesome.min.css?v=').config('etc.asset_ver') }}">
  </head>
  <body class="dark-custom">
    <ul id="menu">
      <div class="home-container">
        <div class="left">
          <div class="home-logo-place">
            <a href="{{ route('home') }}" class="home-logo-text"><i class="material-icons home-logo-icon left">school</i>Semaya</a>
          </div>
        </div>
        <div class="right">
          <li class="waves-effect" data-menuanchor="main"><a href="#main">Aplikasi Utama</a></li>
          <li class="waves-effect" data-menuanchor="sources"><a href="#sources">Sumber Data</a></li>
          <li class="waves-effect" data-menuanchor="settings"><a href="#settings">Pengaturan</a></li>
          <li class="waves-effect" data-menuanchor="others"><a href="#others">Lain-Lain</a></li>
          <li class="waves-effect"><a href="#!">Keluar</a></li>
        </div>
      </div>
    </ul>
    <div id="fullpage">
    	<div class="section active" id="section0">
        <div class="home-container">
          <div class="row center">
            <div class="col s12 m4 l4">
              <div class="row mar-bot">
                <div class="col s12 m12 l12">
                  <div class="card-panel waves-effect waves-light waves-block light-blue darken-4" style="height:357px">
                    <div class="row" style="margin-top:35px">
                      <div class="col s12 m12 l12">
                        <i class="material-icons home-card-icon-large">language</i>
                      </div>
                    </div>
                    <div class="row mar-bot">
                      <div class="col s12 m12 l12">
                        <div class="home-card-text-large">
                          Ujian Online
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col s12 m4 l4">
              <div class="row mar-bot">
                <div class="col s12 m12 l12">
                  <div class="card-panel waves-effect waves-light waves-block cyan darken-1">
                    <div class="row">
                      <div class="col s12 m12 l12">
                        <i class="material-icons home-card-icon">fingerprint</i>
                      </div>
                    </div>
                    <div class="row mar-bot">
                      <div class="col s12 m12 l12">
                        <div class="home-card-text">
                          Sistem Absensi Otomatis
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row mar-bot">
                <div class="col s12 m12 l12">
                  <div class="card-panel waves-effect waves-light waves-block pink darken-1">
                    <div class="row">
                      <div class="col s12 m12 l12">
                        <i class="material-icons home-card-icon">tv</i>
                      </div>
                    </div>
                    <div class="row mar-bot">
                      <div class="col s12 m12 l12">
                        <div class="home-card-text">
                          Digital Signage
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col s12 m4 l4">
              <div class="row mar-bot">
                <div class="col s12 m12 l12">
                  <div class="card-panel waves-effect waves-light waves-block teal darken-2">
                    <div class="row">
                      <div class="col s12 m12 l12">
                        <i class="material-icons home-card-icon">local_library</i>
                      </div>
                    </div>
                    <div class="row mar-bot">
                      <div class="col s12 m12 l12">
                        <div class="home-card-text">
                          Perpustakaan
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row mar-bot">
                <div class="col s12 m12 l12">
                  <div class="card-panel waves-effect waves-light waves-block deep-purple">
                    <div class="row">
                      <div class="col s12 m12 l12">
                        <i class="material-icons home-card-icon">camera</i>
                      </div>
                    </div>
                    <div class="row mar-bot">
                      <div class="col s12 m12 l12">
                        <div class="home-card-text">
                          CCTV
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    	</div>
      <div class="section" id="section1">
        <div class="home-container">
          <div class="row center">
            <div class="col s12 m4 l4">
              <div class="row mar-bot">
                <div class="col s12 m12 l12">
                  <div class="card-panel waves-effect waves-light waves-block red darken-1">
                    <div class="row">
                      <div class="col s12 m12 l12">
                        <i class="material-icons home-card-icon">school</i>
                      </div>
                    </div>
                    <div class="row mar-bot">
                      <div class="col s12 m12 l12">
                        <div class="home-card-text">
                          Sekolah
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row mar-bot">
                <div class="col s12 m6 l6">
                  <div class="card-panel waves-effect waves-light waves-block orange darken-1">
                    <div class="row">
                      <div class="col s12 m12 l12">
                        <i class="material-icons home-card-icon">event_note</i>
                      </div>
                    </div>
                    <div class="row mar-bot">
                      <div class="col s12 m12 l12">
                        <div class="home-card-text">
                          Kalender Akademik
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col s12 m6 l6">
                  <div class="card-panel waves-effect waves-light waves-block green darken-2">
                    <div class="row">
                      <div class="col s12 m12 l12">
                        <i class="material-icons home-card-icon">event_available</i>
                      </div>
                    </div>
                    <div class="row mar-bot">
                      <div class="col s12 m12 l12">
                        <div class="home-card-text">
                          Tahun Ajaran
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col s12 m4 l4">
              <div class="row mar-bot">
                <div class="col s12 m6 l6">
                  <div class="card-panel waves-effect waves-light waves-block indigo">
                    <div class="row">
                      <div class="col s12 m12 l12">
                        <i class="material-icons home-card-icon">group</i>
                      </div>
                    </div>
                    <div class="row mar-bot">
                      <div class="col s12 m12 l12">
                        <div class="home-card-text">
                          Siswa
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col s12 m6 l6">
                  <div class="card-panel waves-effect waves-light waves-block deep-orange">
                    <div class="row">
                      <div class="col s12 m12 l12">
                        <i class="material-icons home-card-icon">tv</i>
                      </div>
                    </div>
                    <div class="row mar-bot">
                      <div class="col s12 m12 l12">
                        <div class="home-card-text">
                          Guru
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col s12 m6 l6">
                  <div class="card-panel waves-effect waves-light waves-block amber">
                    <div class="row">
                      <div class="col s12 m12 l12">
                        <i class="material-icons home-card-icon">fingerprint</i>
                      </div>
                    </div>
                    <div class="row mar-bot">
                      <div class="col s12 m12 l12">
                        <div class="home-card-text">
                          Jurusan
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col s12 m6 l6">
                  <div class="card-panel waves-effect waves-light waves-block pink darken-1">
                    <div class="row">
                      <div class="col s12 m12 l12">
                        <i class="material-icons home-card-icon">tv</i>
                      </div>
                    </div>
                    <div class="row mar-bot">
                      <div class="col s12 m12 l12">
                        <div class="home-card-text">
                          Kelas
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col s12 m4 l4">
              <div class="row mar-bot">
                <div class="col s12 m6 l6">
                  <div class="card-panel waves-effect waves-light waves-block brown">
                    <div class="row">
                      <div class="col s12 m12 l12">
                        <i class="material-icons home-card-icon">camera</i>
                      </div>
                    </div>
                    <div class="row mar-bot">
                      <div class="col s12 m12 l12">
                        <div class="home-card-text">
                          Karyawan
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col s12 m6 l6">
                  <div class="card-panel waves-effect waves-light waves-block purple">
                    <div class="row">
                      <div class="col s12 m12 l12">
                        <i class="material-icons home-card-icon">local_library</i>
                      </div>
                    </div>
                    <div class="row mar-bot">
                      <div class="col s12 m12 l12">
                        <div class="home-card-text">
                          Admin
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col s12 m6 l6">
                  <div class="card-panel waves-effect waves-light waves-block deep-purple">
                    <div class="row">
                      <div class="col s12 m12 l12">
                        <i class="material-icons home-card-icon">camera</i>
                      </div>
                    </div>
                    <div class="row mar-bot">
                      <div class="col s12 m12 l12">
                        <div class="home-card-text">
                          Pelajaran
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col s12 m6 l6">
                  <div class="card-panel waves-effect waves-light waves-block teal">
                    <div class="row">
                      <div class="col s12 m12 l12">
                        <i class="material-icons home-card-icon">local_library</i>
                      </div>
                    </div>
                    <div class="row mar-bot">
                      <div class="col s12 m12 l12">
                        <div class="home-card-text">
                          Alumni
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    	</div>
      <div class="section" id="section2">
        <div class="home-container">
          <div class="row center">
            <div class="col s12 m4 l4">
              <div class="row mar-bot">
                <div class="col s12 m12 l12">
                  <div class="card-panel waves-effect waves-light waves-block red darken-1">
                    <div class="row">
                      <div class="col s12 m12 l12">
                        <i class="material-icons home-card-icon">school</i>
                      </div>
                    </div>
                    <div class="row mar-bot">
                      <div class="col s12 m12 l12">
                        <div class="home-card-text">
                          Kenaikan Kelas
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col s12 m6 l6">
                  <div class="card-panel waves-effect waves-light waves-block orange darken-1">
                    <div class="row">
                      <div class="col s12 m12 l12">
                        <i class="material-icons home-card-icon">event_note</i>
                      </div>
                    </div>
                    <div class="row mar-bot">
                      <div class="col s12 m12 l12">
                        <div class="home-card-text">
                          Kurikulum
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col s12 m6 l6">
                  <div class="card-panel waves-effect waves-light waves-block green darken-2">
                    <div class="row">
                      <div class="col s12 m12 l12">
                        <i class="material-icons home-card-icon">event_available</i>
                      </div>
                    </div>
                    <div class="row mar-bot">
                      <div class="col s12 m12 l12">
                        <div class="home-card-text">
                          Jam Pelajaran
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col s12 m4 l4">
              <div class="row mar-bot">
                <div class="col s12 m12 l12">
                  <div class="card-panel waves-effect waves-light waves-block indigo">
                    <div class="row">
                      <div class="col s12 m12 l12">
                        <i class="material-icons home-card-icon">group</i>
                      </div>
                    </div>
                    <div class="row mar-bot">
                      <div class="col s12 m12 l12">
                        <div class="home-card-text">
                          Kategori Mutasi
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col s12 m6 l6">
                  <div class="card-panel waves-effect waves-light waves-block amber">
                    <div class="row">
                      <div class="col s12 m12 l12">
                        <i class="material-icons home-card-icon">fingerprint</i>
                      </div>
                    </div>
                    <div class="row mar-bot">
                      <div class="col s12 m12 l12">
                        <div class="home-card-text">
                          Mutasi Siswa
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col s12 m6 l6">
                  <div class="card-panel waves-effect waves-light waves-block pink darken-1">
                    <div class="row">
                      <div class="col s12 m12 l12">
                        <i class="material-icons home-card-icon">tv</i>
                      </div>
                    </div>
                    <div class="row mar-bot">
                      <div class="col s12 m12 l12">
                        <div class="home-card-text">
                          Mutasi Guru
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col s12 m4 l4">
              <div class="row mar-bot">
                <div class="col s12 m12 l12">
                  <div class="card-panel waves-effect waves-light waves-block brown">
                    <div class="row">
                      <div class="col s12 m12 l12">
                        <i class="material-icons home-card-icon">camera</i>
                      </div>
                    </div>
                    <div class="row mar-bot">
                      <div class="col s12 m12 l12">
                        <div class="home-card-text">
                          Root Menu
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    	</div>
      <div class="section" id="section3">
        <div class="home-container">
          <div class="row center">
            <div class="col s12 m4 l4">
              <div class="row mar-bot">
                <div class="col s12 m12 l12">
                  <div class="card-panel waves-effect waves-light waves-block red darken-1">
                    <div class="row">
                      <div class="col s12 m12 l12">
                        <i class="material-icons home-card-icon">school</i>
                      </div>
                    </div>
                    <div class="row mar-bot">
                      <div class="col s12 m12 l12">
                        <div class="home-card-text">
                          Buku Induk
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col s12 m6 l6">
                  <div class="card-panel waves-effect waves-light waves-block orange darken-1">
                    <div class="row">
                      <div class="col s12 m12 l12">
                        <i class="material-icons home-card-icon">event_note</i>
                      </div>
                    </div>
                    <div class="row mar-bot">
                      <div class="col s12 m12 l12">
                        <div class="home-card-text">
                          Rekap Jurusan
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col s12 m6 l6">
                  <div class="card-panel waves-effect waves-light waves-block green darken-2">
                    <div class="row">
                      <div class="col s12 m12 l12">
                        <i class="material-icons home-card-icon">event_available</i>
                      </div>
                    </div>
                    <div class="row mar-bot">
                      <div class="col s12 m12 l12">
                        <div class="home-card-text">
                          Rekap Kelas
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col s12 m4 l4">
              <div class="row mar-bot">
                <div class="col s12 m12 l12">
                  <div class="card-panel waves-effect waves-light waves-block indigo">
                    <div class="row">
                      <div class="col s12 m12 l12">
                        <i class="material-icons home-card-icon">group</i>
                      </div>
                    </div>
                    <div class="row mar-bot">
                      <div class="col s12 m12 l12">
                        <div class="home-card-text">
                          Update Aplikasi
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col s12 m12 l12">
                  <div class="card-panel waves-effect waves-light waves-block amber">
                    <div class="row">
                      <div class="col s12 m12 l12">
                        <i class="material-icons home-card-icon">fingerprint</i>
                      </div>
                    </div>
                    <div class="row mar-bot">
                      <div class="col s12 m12 l12">
                        <div class="home-card-text">
                          Jadwal Pelajaran
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col s12 m4 l4">
              <div class="row mar-bot">
                <div class="col s12 m12 l12">
                  <div class="card-panel waves-effect waves-light waves-block pink darken-1">
                    <div class="row">
                      <div class="col s12 m12 l12">
                        <i class="material-icons home-card-icon">tv</i>
                      </div>
                    </div>
                    <div class="row mar-bot">
                      <div class="col s12 m12 l12">
                        <div class="home-card-text">
                          Backup Database
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    	</div>
    </div>
  </body>
</html>
