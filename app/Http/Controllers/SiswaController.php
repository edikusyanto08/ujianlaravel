<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use App\Siswa;
use App\Jurusan;
use App\Kelas;
use App\KelasSiswa;
use App\User;
use App\RoleUser;
use App\Tingkat;
use Carbon\Carbon;
use Auth;
use Excel;
use App\Http\Controllers\ExcelController as ExcelHelper;
use PDF;
use App\Sekolah;
use Validator;

class SiswaController extends Controller
{
    public function __construct()
    {
      $this->excelHelper = new ExcelHelper;
    }

    public function index()
    {
      // $siswa = Siswa::paginate(10);
      $siswa = Siswa::where('lulus', 0)->paginate(10);
      $no = $siswa->firstItem();
      $tingkat = Tingkat::all();
      $kelas = Kelas::all();
      return view('semaya.master.siswa.index', ['data' => $siswa, 'tingkat' => $tingkat, 'kelas' => $kelas, 'no' => $no, 'q' => '']);
    }

    public function create()
    {
      $agama = [
        ['id' => 1, 'agama' =>'Islam'],
        ['id' => 2, 'agama' =>'Katolik'],
        ['id' => 3, 'agama' =>'Protestan'],
        ['id' => 4, 'agama' =>'Hindu'],
        ['id' => 5, 'agama' =>'Budha'],
        ['id' => 6, 'agama' =>'Konghucu'],
      ];
      $tinggal = [
        ['id' => 1, 'tinggal' => 'Orang Tua'],
        ['id' => 2, 'tinggal' => 'Saudara'],
        ['id' => 3, 'tinggal' => 'Asrama'],
        ['id' => 4, 'tinggal' => 'Kost'],
        ['id' => 5, 'tinggal' => 'Lainnya'],
      ];
      $yatim = [
        ['id' => 1, 'yatim' => 'Tidak'],
        ['id' => 2, 'yatim' => 'Yatim'],
        ['id' => 3, 'yatim' => 'Piatu'],
        ['id' => 4, 'yatim' => 'Yatim Piatu'],
      ];
      return view('semaya.master.siswa.create.index', ['agama' => $agama, 'yatim' => $yatim, 'tinggal' => $tinggal]);
    }

    public function store(Request $r)
    {
      $message = [
        'nis.required'  => 'NIS harus diisi!',
        'nisn.required'  => 'NISN harus diisi!',
        'nik.required'  => 'NIK harus diisi!',
        'nama_lengkap.required'  => 'Nama lengkap harus diisi!',
        'nama_panggilan.required'  => 'Nama panggilan harus diisi!',
        'jenis_kelamin.required'  => 'Jenis kelamin harus diisi!',
        'tempat_lahir.required'  => 'Tempat lahir harus diisi!',
        'tanggal_lahir.required'  => 'Tanggal lahir harus diisi!',
        'agama.required'  => 'Agama harus diisi!',
        'alamat.required'  => 'Alamat harus diisi!',
        'nis.numeric'  => 'NIS harus berupa angka!',
        'nisn.numeric'  => 'NISN harus berupa angka!',
        'nik.numeric'  => 'NIK harus berupa angka!',
        'anak_ke.numeric'  => 'Anak ke harus berupa angka!',
        'saudara_kandung.numeric'  => 'Saudara kandung harus berupa angka!',
        'saudara_angkat.numeric'  => 'Saudara angkat harus berupa angka!',
        'jarak_tinggal.numeric'  => 'Jarak tempat tinggal harus berupa angka!',
        'telp.numeric'  => 'No. telp harus berupa angka!',
      ];

      $this->validate($r, [
        'nis'  => 'required|numeric',
        'nisn'  => 'required|numeric',
        'nik'  => 'required|numeric',
        'nama_lengkap'  => 'required',
        'nama_panggilan'  => 'required',
        'jenis_kelamin'  => 'required',
        'tempat_lahir'  => 'required',
        'tanggal_lahir'  => 'required',
        'agama'  => 'required',
        'alamat'  => 'required',
        'anak_ke'  => 'nullable|numeric',
        'saudara_kandung'  => 'nullable|numeric',
        'saudara_angkat'  => 'nullable|numeric',
        'jarak_tinggal'  => 'nullable|numeric',
        'telp'  => 'nullable|numeric',
      ], $message);

      $pin = str_replace('/', '', $r->input('tanggal_lahir'));

      $siswa = new Siswa;
      $yatim = $r->input('yatim');
      $nis = $r->input('nis');
      $siswa->status = 1;
      $siswa->no_induk = $nis;
      $siswa->nis = $nis;
      $siswa->nisn = $r->input('nisn');
      $siswa->nik = $r->input('nik');
      $siswa->nama_lengkap = $r->input('nama_lengkap');
      $siswa->nama_panggilan = $r->input('nama_panggilan');
      $siswa->kelamin = $r->input('jenis_kelamin');
      $siswa->tempat_lahir = $r->input('tempat_lahir');
      $siswa->tgl_lahir = Carbon::createFromFormat('d/m/Y', $r->input('tanggal_lahir'))->toDateString();
      $siswa->agama = $r->input('agama');
      $siswa->kewarganegaraan = $r->input('kewarganegaraan');
      $siswa->anak_ke = $r->input('anak_ke');
      $siswa->saudara_kandung = $r->input('saudara_kandung');
      $siswa->saudara_angkat = $r->input('saudara_angkat');
      if ($yatim == 1) {
        $siswa->hidup_ayah = null;
        $siswa->hidup_ibu = null;
      } elseif ($yatim == 2) {
        $siswa->hidup_ayah = "Alm";
        $siswa->hidup_ibu = null;
      } elseif($yatim == 3) {
        $siswa->hidup_ayah = null;
        $siswa->hidup_ibu = "Almh";
      } elseif ($yatim == 4) {
        $siswa->hidup_ayah = "Alm";
        $siswa->hidup_ibu = "Almh";
      }
      $siswa->yatim = $yatim;
      $siswa->bahasa = $r->input('bahasa');
      $siswa->alamat = $r->input('alamat');
      $siswa->no_telp = $r->input('telp');
      $siswa->tinggal = $r->input('status_tinggal');
      $siswa->jarak_tinggal = $r->input('jarak_tinggal');
      $siswa->foto = 'avatar.jpg';
      $siswa->nomor_kartu = $nis;
      $siswa->pin = $pin;
      $siswa->lulus = 0;
      $siswa->save();

      $sekolah_id = Auth::user()->sekolah_id;
      if ($sekolah_id < 10) {
        $first_char = '0'.$sekolah_id.'-'.$siswa->nis;
      }
      else {
        $first_char = $sekolah_id.'-'.$siswa->nis;
      }
      $user = new User;
      $user->username = $first_char;
      $user->password = bcrypt($pin);
      $user->sekolah_id = $sekolah_id;
      $user->save();

      $role_user = new RoleUser;
      $role_user->user_id = $user->id;
      $role_user->role_id = 5;
      $role_user->save();

      $siswa = Siswa::whereNisn($r->input('nisn'))->first();
      session(['id_siswa' => $siswa->id]);
      return redirect()->route('siswa_create_health');
    }

    public function create_health()
    {
      if (session("id_siswa") == "") {
        return redirect()->route('siswa_index')->with('message', 'Tambahkan siswa dari awal!');
      }
      return view('semaya.master.siswa.create.health');
    }

    public function store_health(Request $r)
    {
      $message = [
        'berat.numeric'  => 'Berat badan harus berupa angka!',
        'tinggi.numeric'  => 'Tinggi badan harus berupa angka!',
      ];

      $this->validate($r, [
        'berat'  => 'nullable|numeric',
        'tinggi'  => 'nullable|numeric',
      ], $message);

      $id_siswa = $r->input('id_siswa');
      $siswa = Siswa::find($id_siswa);
      $siswa->gol_darah = $r->input('goldar');
      $siswa->penyakit = $r->input('penyakit');
      $siswa->kelainan = $r->input('kelainan');
      $siswa->tinggi = $r->input('tinggi');
      $siswa->berat = $r->input('berat');
      $siswa->save();

      session(['id_siswa' => $id_siswa]);
      return redirect(route('siswa_create_family'));
    }

    public function create_family()
    {
      if (session("id_siswa") == "") {
        return redirect()->route('siswa_index')->with('message', 'Tambahkan siswa dari awal!');
      }
      $agama = [
        ['id' => 1, 'agama' =>'Islam'],
        ['id' => 2, 'agama' =>'Katolik'],
        ['id' => 3, 'agama' =>'Protestan'],
        ['id' => 4, 'agama' =>'Hindu'],
        ['id' => 5, 'agama' =>'Budha'],
        ['id' => 6, 'agama' =>'Konghucu'],
      ];
      return view('semaya.master.siswa.create.family', ['agama' => $agama]);
    }

    public function store_family(Request $r)
    {
      $r['pengeluaran_ayah'] = str_replace('.', '', $r->input('pengeluaran_ayah'));
      $r['pengeluaran_ibu'] = str_replace('.', '', $r->input('pengeluaran_ibu'));
      $r['pengeluaran_wali'] = str_replace('.', '', $r->input('pengeluaran_wali'));
      $message = [
        'telp_ayah.numeric'  => 'Telp ayah harus berupa angka!',
        'telp_ibu.numeric'  => 'Telp ibu harus berupa angka!',
        'telp_wali.numeric'  => 'Telp wali harus berupa angka!',
      ];

      $this->validate($r, [
        'telp_ayah'  => 'nullable|numeric',
        'telp_ibu'  => 'nullable|numeric',
        'telp_wali'  => 'nullable|numeric',
      ], $message);
      $id_siswa = $r->input('id_siswa');
      $siswa = Siswa::find($id_siswa);
      $siswa->nama_ayah = $r->input('nama_ayah');
      $siswa->tempat_lahir_ayah = $r->input('tempat_lahir_ayah');
      if ($r->input('tanggal_lahir_ayah') != null) {
        $siswa->tgl_lahir_ayah = Carbon::createFromFormat('d/m/Y', $r->input('tanggal_lahir_ayah'))->toDateString();
      } else {
        $siswa->tgl_lahir_ayah = null;
      }
      $siswa->agama_ayah = $r->input('agama_ayah');
      $siswa->kewarganegaraan_ayah = $r->input('kewarganegaraan_ayah');
      $siswa->pendidikan_ayah = $r->input('pendidikan_ayah');
      $siswa->pekerjaan_ayah = $r->input('pekerjaan_ayah');
      $siswa->pengeluaran_ayah = $r->input('pengeluaran_ayah');
      $siswa->telp_ayah = $r->input('telp_ayah');
      $siswa->alamat_ayah = $r->input('alamat_ayah');
      $siswa->nama_ibu = $r->input('nama_ibu');
      $siswa->tempat_lahir_ibu = $r->input('tempat_lahir_ibu');
      if ($r->input('tanggal_lahir_ibu') != null) {
        $siswa->tgl_lahir_ibu = Carbon::createFromFormat('d/m/Y', $r->input('tanggal_lahir_ibu'))->toDateString();
      } else {
        $siswa->tgl_lahir_ibu = null;
      }
      $siswa->agama_ibu = $r->input('agama_ibu');
      $siswa->kewarganegaraan_ibu = $r->input('kewarganegaraan_ibu');
      $siswa->pendidikan_ibu = $r->input('pendidikan_ibu');
      $siswa->pekerjaan_ibu = $r->input('pekerjaan_ibu');
      $siswa->pengeluaran_ibu = $r->input('pengeluaran_ibu');
      $siswa->telp_ibu = $r->input('telp_ibu');
      $siswa->alamat_ibu = $r->input('alamat_ibu');
      $siswa->nama_wali = $r->input('nama_wali');
      $siswa->tempat_lahir_wali = $r->input('tempat_lahir_wali');
      if ($r->input('tanggal_lahir_wali') != null) {
        $siswa->tgl_lahir_wali = Carbon::createFromFormat('d/m/Y', $r->input('tanggal_lahir_wali'))->toDateString();
      } else {
        $siswa->tgl_lahir_wali = null;
      }
      $siswa->agama_wali = $r->input('agama_wali');
      $siswa->kewarganegaraan_wali = $r->input('kewarganegaraan_wali');
      $siswa->pendidikan_wali = $r->input('pendidikan_wali');
      $siswa->pekerjaan_wali = $r->input('pekerjaan_wali');
      $siswa->pengeluaran_wali = $r->input('pengeluaran_wali');
      $siswa->telp_wali = $r->input('telp_wali');
      $siswa->alamat_wali = $r->input('alamat_wali');
      $siswa->save();

      session(['id_siswa' => $id_siswa]);
      return redirect()->route('siswa_create_admin');
    }

    public function create_admin()
    {
      if (session("id_siswa") == "") {
        return redirect()->route('siswa_index')->with('message', 'Tambahkan siswa dari awal!');
      }
      $jurusan = Jurusan::orderBy('singkatan_jurusan')->get();
      return view('semaya.master.siswa.create.administration', ['jurusan' => $jurusan]);
    }

    public function store_admin(Request $r)
    {
      $message = [
        'kelas_id.required'  => 'Jurusan harus diisi!',
        'jurusan_id.required'  => 'Kelas harus diisi!',
      ];

      $this->validate($r, [
        'kelas_id'  => 'required',
        'jurusan_id'  => 'required',
      ], $message);
      $id_siswa = $r->input('id_siswa');
      $siswa = Siswa::find($id_siswa);
      $siswa->tamat_dari = $r->input('lulusan_dari');
      $siswa->no_ijazah = $r->input('no_ijazah');
      $siswa->no_skhun = $r->input('no_skhun');
      if ($r->input('tgl_ijazah') != null) {
        $siswa->tgl_ijazah = Carbon::createFromFormat('d/m/Y', $r->input('tgl_ijazah'))->toDateString();
      } else {
        $siswa->tgl_ijazah = null;
      }
      if ($r->input('tgl_skhun') != null) {
        $siswa->tgl_skhun = Carbon::createFromFormat('d/m/Y', $r->input('tgl_skhun'))->toDateString();
      } else {
        $siswa->tgl_skhun = null;
      }
      $siswa->dari_sekolah = $r->input('dari_sekolah');
      $siswa->alasan = $r->input('alasan_pindah');
      $siswa->tgl_diterima = Carbon::now();
      $siswa->save();

      $kelas = new KelasSiswa;
      $kelas->siswa_id = $id_siswa;
      $kelas->kelas_id = $r->input('kelas_id');
      $kelas->save();

      session()->flush();
      return redirect()->route('siswa_index');
    }

    public function edit($id)
    {
      $siswa = Siswa::find($id);
      $agama = [
        ['id' => 1, 'agama' =>'Islam'],
        ['id' => 2, 'agama' =>'Katolik'],
        ['id' => 3, 'agama' =>'Protestan'],
        ['id' => 4, 'agama' =>'Hindu'],
        ['id' => 5, 'agama' =>'Budha'],
        ['id' => 6, 'agama' =>'Konghucu'],
      ];
      $tinggal = [
        ['id' => 1, 'tinggal' => 'Orang Tua'],
        ['id' => 2, 'tinggal' => 'Saudara'],
        ['id' => 3, 'tinggal' => 'Asrama'],
        ['id' => 4, 'tinggal' => 'Kost'],
        ['id' => 5, 'tinggal' => 'Lainnya'],
      ];
      $yatim = [
        ['id' => 1, 'yatim' => 'Tidak'],
        ['id' => 2, 'yatim' => 'Yatim'],
        ['id' => 3, 'yatim' => 'Piatu'],
        ['id' => 4, 'yatim' => 'Yatim Piatu'],
      ];
      return view('semaya.master.siswa.edit.index', ['data' => $siswa, 'agama' => $agama, 'tinggal' => $tinggal, 'yatim' => $yatim]);
    }

    public function update(Request $r)
    {
      $message = [
        'nis.required'  => 'NIS harus diisi!',
        'nisn.required'  => 'NISN harus diisi!',
        'nik.required'  => 'NIK harus diisi!',
        'nama_lengkap.required'  => 'Nama lengkap harus diisi!',
        'nama_panggilan.required'  => 'Nama panggilan harus diisi!',
        'jenis_kelamin.required'  => 'Jenis kelamin harus diisi!',
        'tempat_lahir.required'  => 'Tempat lahir harus diisi!',
        'tanggal_lahir.required'  => 'Tanggal lahir harus diisi!',
        'agama.required'  => 'Agama harus diisi!',
        'alamat.required'  => 'Alamat harus diisi!',
        'nis.numeric'  => 'NIS harus berupa angka!',
        'nisn.numeric'  => 'NISN harus berupa angka!',
        'nik.numeric'  => 'NIK harus berupa angka!',
        'anak_ke.numeric'  => 'Anak ke harus berupa angka!',
        'saudara_kandung.numeric'  => 'Saudara kandung harus berupa angka!',
        'saudara_angkat.numeric'  => 'Saudara angkat harus berupa angka!',
        'jarak_tinggal.numeric'  => 'Jarak tempat tinggal harus berupa angka!',
        'telp.numeric'  => 'No. telp harus berupa angka!',
      ];

      $this->validate($r, [
        'nis'  => 'required|numeric',
        'nisn'  => 'required|numeric',
        'nik'  => 'required|numeric',
        'nama_lengkap'  => 'required',
        'nama_panggilan'  => 'required',
        'jenis_kelamin'  => 'required',
        'tempat_lahir'  => 'required',
        'tanggal_lahir'  => 'required',
        'agama'  => 'required',
        'alamat'  => 'required',
        'anak_ke'  => 'nullable|numeric',
        'saudara_kandung'  => 'nullable|numeric',
        'saudara_angkat'  => 'nullable|numeric',
        'jarak_tinggal'  => 'nullable|numeric',
        'telp'  => 'nullable|numeric',
      ], $message);

      $pin = str_replace('/', '', $r->input('tanggal_lahir'));

      $tgl_lahir = Carbon::createFromFormat('d/m/Y', $r->input('tanggal_lahir'))->toDateString();
      $yatim = $r->input('yatim');
      $id_siswa = $r->input('id_siswa');
      $nis = $r->input('nis');
      $siswa = Siswa::find($id_siswa);
      $siswa->status = $r->input('status');
      $siswa->no_induk = $nis;
      $siswa->nis = $nis;
      $siswa->nisn = $r->input('nisn');
      $siswa->nik = $r->input('nik');
      $siswa->nama_lengkap = $r->input('nama_lengkap');
      $siswa->nama_panggilan = $r->input('nama_panggilan');
      $siswa->kelamin = $r->input('jenis_kelamin');
      $siswa->tempat_lahir = $r->input('tempat_lahir');
      $siswa->tgl_lahir = $tgl_lahir;

      $sekolah_id = Auth::user()->sekolah_id;
      if ($sekolah_id < 10) {
        $first_char = '0'.$sekolah_id.'-'.$nis;
      }
      else {
        $first_char = $sekolah_id.'-'.$nis;
      }
      $user = User::where('username', 'like', '%'.$r->input('old_nis').'%')
                  ->where('sekolah_id', Auth::user()->sekolah_id)
                  ->update([
                      'username' => $first_char,
                      'password' => bcrypt($pin)
                    ]);
      // $select_user = User::find($user->id);
      // $select_user->username = $first_char;
      // $select_user->password = bcrypt($tgl_lahir);
      // $select_user->save();

      $siswa->agama = $r->input('agama');
      $siswa->kewarganegaraan = $r->input('kewarganegaraan');
      $siswa->anak_ke = $r->input('anak_ke');
      $siswa->saudara_kandung = $r->input('saudara_kandung');
      $siswa->saudara_angkat = $r->input('saudara_angkat');
      if ($yatim == 1) {
        $siswa->hidup_ayah = null;
        $siswa->hidup_ibu = null;
      } elseif ($yatim == 2) {
        $siswa->hidup_ayah = "Alm";
        $siswa->hidup_ibu = null;
      } elseif($yatim == 3) {
        $siswa->hidup_ayah = null;
        $siswa->hidup_ibu = "Almh";
      } elseif ($yatim == 4) {
        $siswa->hidup_ayah = "Alm";
        $siswa->hidup_ibu = "Almh";
      }
      $siswa->yatim = $yatim;
      $siswa->bahasa = $r->input('bahasa');
      $siswa->alamat = $r->input('alamat');
      $siswa->no_telp = $r->input('telp');
      $siswa->tinggal = $r->input('status_tinggal');
      $siswa->jarak_tinggal = $r->input('jarak_tinggal');
      $siswa->nomor_kartu = $nis;
      $siswa->pin = $pin;
      if ($r->input('foto') != "") {
        $imgName = 'img_'.time().'.'.$r->file('foto')->getClientOriginalExtension();
        $r->file('foto')->move(public_path('assets/img/users/siswa'), $imgName);
        $siswa->foto = $imgName;
      }
      $siswa->save();
      return redirect()->route('siswa_edit', ['id' => $id_siswa])->with('message', 'Data berhasil diubah!');
    }

    public function edit_health($id)
    {
      $siswa = Siswa::find($id);
      return view('semaya.master.siswa.edit.health', ['data' => $siswa]);
    }

    public function update_health(Request $r)
    {
      $message = [
        'berat.numeric'  => 'Berat badan harus berupa angka!',
        'tinggi.numeric'  => 'Tinggi badan harus berupa angka!',
      ];

      $this->validate($r, [
        'berat'  => 'nullable|numeric',
        'tinggi'  => 'nullable|numeric',
      ], $message);

      $id_siswa = $r->input('id_siswa');
      $siswa = Siswa::find($id_siswa);
      $siswa->gol_darah = $r->input('goldar');
      $siswa->penyakit = $r->input('penyakit');
      $siswa->kelainan = $r->input('kelainan');
      $siswa->tinggi = $r->input('tinggi');
      $siswa->berat = $r->input('berat');
      $siswa->save();
      return redirect()->route('siswa_edit_health', ['id' => $id_siswa])->with('message', 'Data berhasil diubah!');
    }

    public function edit_family($id)
    {
      $siswa = Siswa::find($id);
      $agama = [
        ['id' => 1, 'agama' =>'Islam'],
        ['id' => 2, 'agama' =>'Katolik'],
        ['id' => 3, 'agama' =>'Protestan'],
        ['id' => 4, 'agama' =>'Hindu'],
        ['id' => 5, 'agama' =>'Budha'],
        ['id' => 6, 'agama' =>'Konghucu'],
      ];
      return view('semaya.master.siswa.edit.family', ['data' => $siswa, 'agama' => $agama]);
    }

    public function update_family(Request $r)
    {
      $r['pengeluaran_ayah'] = str_replace('.', '', $r->input('pengeluaran_ayah'));
      $r['pengeluaran_ibu'] = str_replace('.', '', $r->input('pengeluaran_ibu'));
      $r['pengeluaran_wali'] = str_replace('.', '', $r->input('pengeluaran_wali'));
      $message = [
        'telp_ayah.numeric'  => 'Telp ayah harus berupa angka!',
        'telp_ibu.numeric'  => 'Telp ibu harus berupa angka!',
        'telp_wali.numeric'  => 'Telp wali harus berupa angka!',
      ];

      $this->validate($r, [
        'telp_ayah'  => 'nullable|numeric',
        'telp_ibu'  => 'nullable|numeric',
        'telp_wali'  => 'nullable|numeric',
      ], $message);

      $id_siswa = $r->input('id_siswa');
      $siswa = Siswa::find($id_siswa);
      $siswa->nama_ayah = $r->input('nama_ayah');
      $siswa->tempat_lahir_ayah = $r->input('tempat_lahir_ayah');
      if ($r->input('tanggal_lahir_ayah') != null) {
        $siswa->tgl_lahir_ayah = Carbon::createFromFormat('d/m/Y', $r->input('tanggal_lahir_ayah'))->toDateString();
      } else {
        $siswa->tgl_lahir_ayah = null;
      }
      $siswa->agama_ayah = $r->input('agama_ayah');
      $siswa->kewarganegaraan_ayah = $r->input('kewarganegaraan_ayah');
      $siswa->pendidikan_ayah = $r->input('pendidikan_ayah');
      $siswa->pekerjaan_ayah = $r->input('pekerjaan_ayah');
      $siswa->pengeluaran_ayah = $r->input('pengeluaran_ayah');
      $siswa->telp_ayah = $r->input('telp_ayah');
      $siswa->alamat_ayah = $r->input('alamat_ayah');
      $siswa->nama_ibu = $r->input('nama_ibu');
      $siswa->tempat_lahir_ibu = $r->input('tempat_lahir_ibu');
      if ($r->input('tanggal_lahir_ibu') != null) {
        $siswa->tgl_lahir_ibu = Carbon::createFromFormat('d/m/Y', $r->input('tanggal_lahir_ibu'))->toDateString();
      } else {
        $siswa->tgl_lahir_ibu = null;
      }
      $siswa->agama_ibu = $r->input('agama_ibu');
      $siswa->kewarganegaraan_ibu = $r->input('kewarganegaraan_ibu');
      $siswa->pendidikan_ibu = $r->input('pendidikan_ibu');
      $siswa->pekerjaan_ibu = $r->input('pekerjaan_ibu');
      $siswa->pengeluaran_ibu = $r->input('pengeluaran_ibu');
      $siswa->telp_ibu = $r->input('telp_ibu');
      $siswa->alamat_ibu = $r->input('alamat_ibu');
      $siswa->nama_wali = $r->input('nama_wali');
      $siswa->tempat_lahir_wali = $r->input('tempat_lahir_wali');
      if ($r->input('tanggal_lahir_wali') != null) {
        $siswa->tgl_lahir_wali = Carbon::createFromFormat('d/m/Y', $r->input('tanggal_lahir_wali'))->toDateString();
      } else {
        $siswa->tgl_lahir_wali = null;
      }
      $siswa->agama_wali = $r->input('agama_wali');
      $siswa->kewarganegaraan_wali = $r->input('kewarganegaraan_wali');
      $siswa->pendidikan_wali = $r->input('pendidikan_wali');
      $siswa->pekerjaan_wali = $r->input('pekerjaan_wali');
      $siswa->pengeluaran_wali = $r->input('pengeluaran_wali');
      $siswa->telp_wali = $r->input('telp_wali');
      $siswa->alamat_wali = $r->input('alamat_wali');
      $siswa->save();
      return redirect()->route('siswa_edit_family', ['id' => $id_siswa])->with('message', 'Data berhasil diubah!');
    }

    public function edit_admin($id)
    {
      $siswa = Siswa::find($id);
      $jurusan = Jurusan::orderBy('singkatan_jurusan')->get();
      $kelas = Kelas::whereJurusanId($siswa->kelas_siswa->kelas->jurusan->id)->orderBy('nama_kelas')->get();
      return view('semaya.master.siswa.edit.administration', ['data' => $siswa, 'jurusan' => $jurusan, 'kelas' => $kelas]);
    }

    public function update_admin(Request $r)
    {
      $message = [
        'kelas_id.required'  => 'Jurusan harus diisi!',
        'jurusan_id.required'  => 'Kelas harus diisi!',
      ];

      $this->validate($r, [
        'kelas_id'  => 'required',
        'jurusan_id'  => 'required',
      ], $message);

      $id_siswa = $r->input('id_siswa');
      $siswa = Siswa::find($id_siswa);
      $siswa->tamat_dari = $r->input('lulusan_dari');
      $siswa->no_ijazah = $r->input('no_ijazah');
      $siswa->no_skhun = $r->input('no_skhun');
      if ($r->input('tgl_ijazah') != null) {
        $siswa->tgl_ijazah = Carbon::createFromFormat('d/m/Y', $r->input('tgl_ijazah'))->toDateString();
      } else {
        $siswa->tgl_ijazah = null;
      }
      if ($r->input('tgl_skhun') != null) {
        $siswa->tgl_skhun = Carbon::createFromFormat('d/m/Y', $r->input('tgl_skhun'))->toDateString();
      } else {
        $siswa->tgl_skhun = null;
      }
      $siswa->dari_sekolah = $r->input('dari_sekolah');
      $siswa->alasan = $r->input('alasan_pindah');
      $siswa->tgl_diterima = Carbon::now();
      $siswa->save();

      $kelas = KelasSiswa::whereSiswaId($id_siswa)->first();
      $kelas->siswa_id = $id_siswa;
      $kelas->kelas_id = $r->input('kelas_id');
      $kelas->save();
      return redirect()->route('siswa_edit_admin', ['id' => $id_siswa])->with('message', 'Data berhasil diubah!');
    }

    public function edit_graduation($id)
    {
      $siswa = Siswa::find($id);
      return view('semaya.master.siswa.edit.graduation', ['data' => $siswa]);
    }

    public function update_graduation(Request $r)
    {
      $message = [
        'th_lulus.numeric'  => 'Tahun kelulusan harus berupa angka!',
      ];

      $this->validate($r, [
        'th_lulus'  => 'nullable|numeric',
      ], $message);

      $id_siswa = $r->input('id_siswa');
      $siswa = Siswa::find($id_siswa);
      if ($r->input('tgl_ijazah_lulus') != null) {
        $siswa->tgl_ijazah_lulus = Carbon::createFromFormat('d/m/Y', $r->input('tgl_ijazah_lulus'))->toDateString();
      } else {
        $siswa->tgl_ijazah_lulus = null;
      }
      $siswa->no_ijazah_lulus = $r->input('no_ijazah_lulus');
      if ($r->input('tgl_skhun_lulus') != null) {
        $siswa->tgl_skhun_lulus = Carbon::createFromFormat('d/m/Y', $r->input('tgl_skhun_lulus'))->toDateString();
      } else {
        $siswa->tgl_skhun_lulus = null;
      }
      $siswa->no_skhun_lulus = $r->input('no_skhun_lulus');
      $siswa->lanjut_di = $r->input('lanjut_di');
      $siswa->perusahaan = $r->input('perusahaan');
      if ($r->input('tgl_mulai_kerja') != null) {
        $siswa->tgl_mulai_kerja = Carbon::createFromFormat('d/m/Y', $r->input('tgl_mulai_kerja'))->toDateString();
      } else {
        $siswa->tgl_mulai_kerja = null;
      }
      $siswa->th_lulus = $r->input('th_lulus');
      $siswa->sekolah_pindah = $r->input('sekolah_pindah');
      if ($r->input('tgl_pindah_sekolah') != null) {
        $siswa->tgl_pindah_sekolah = Carbon::createFromFormat('d/m/Y', $r->input('tgl_pindah_sekolah'))->toDateString();
      } else {
        $siswa->tgl_pindah_sekolah = null;
      }
      $siswa->alasan_pindah = $r->input('alasan_pindah');
      $siswa->save();
      return redirect()->route('siswa_edit_graduation', ['id' => $id_siswa])->With('message', 'Data berhasil diubah!');
    }

    public function delete($id)
    {
      $siswa = Siswa::findOrFail($id);

      $user = User::where('username','like','%'.$siswa->nis.'%')->where('sekolah_id', Auth::user()->sekolah_id)->delete();

      $siswa->delete();

      return redirect()->route('siswa_index');
    }

    public function search(Request $r)
    {
      $q = $r->input('q');
      $siswa = Siswa::where('lulus', 0)
                    ->where(function($query) use($q) {
                      $query->where('nis', 'like', '%' . $q . '%')
                              ->orWhere('nama_lengkap', 'like', '%' . $q . '%');
                    })
                    ->paginate(10);
      $no = $siswa->firstItem();
      $tingkat = Tingkat::all();
      $kelas = Kelas::all();
      return view('semaya.master.siswa.index', ['data' => $siswa, 'tingkat' => $tingkat, 'kelas' => $kelas, 'no' => $no, 'q' => $q]);
    }

    public function exportToPdf(Request $r)
    {
      // ini_set('memory_limit', '2048M');
      // ini_set('max_execution_time', '0');
      $tingkat = $r->input('tingkat');

      if ($tingkat == "0") {
        $siswa = Siswa::select(['kelas.nama_kelas', 'siswa.nis', 'siswa.nama_lengkap', 'siswa.kelamin', 'siswa.tgl_lahir', 'siswa.agama'])
        ->join('kelas_siswa', 'kelas_siswa.siswa_id', '=', 'siswa.id')
        ->join('kelas', 'kelas.id', '=', 'kelas_siswa.kelas_id')
        ->join('tingkat', 'tingkat.id', '=', 'kelas.tingkat_id')
        // ->take(10)
        ->orderBy('kelas.id')
        ->orderBy('siswa.nis')
        ->get();
      }
      else {
        $siswa = Siswa::select(['kelas.nama_kelas', 'siswa.nis', 'siswa.nama_lengkap', 'siswa.kelamin', 'siswa.tgl_lahir', 'siswa.agama'])
                      ->join('kelas_siswa', 'kelas_siswa.siswa_id', '=', 'siswa.id')
                      ->join('kelas', 'kelas.id', '=', 'kelas_siswa.kelas_id')
                      ->join('tingkat', 'tingkat.id', '=', 'kelas.tingkat_id')
                      ->where('tingkat.id', $tingkat)
                      // ->take(10)
                      ->orderBy('kelas.id')
                      ->orderBy('siswa.nis')
                      ->get();
      }
      $sekolah_id = Auth::user()->sekolah_id;
      $sekolah = Sekolah::find($sekolah_id);

      $html = view('semaya.master.siswa.pdf', ['data' => $siswa, 'sekolah' => $sekolah]);
      $pdf = PDF::loadHTML($html)->setPaper('a4')->setOrientation('landscape');
      return $pdf->inline('Data Siswa - '.Carbon::now()->format('Ymd').'.pdf');
      // return $html;
    }

    public function exportToExcel(Request $r)
    {
      $excelHelper = $this->excelHelper;
      $tingkat = $r->input('tingkat');
      $format = $r->input('format');

      if ($tingkat == '0') {
        $kelas = Kelas::all();
      }
      else {
        $kelas = Kelas::where('tingkat_id', $tingkat)->get();
      }

      $excel_name_format = 'Ekspor Data Siswa - '.Carbon::now();

      if ($format == 'pdf') {
        return $this->exportToPdf($r);
      }
        Excel::create($excel_name_format, function($excel) use($kelas, $excelHelper){
          foreach ($kelas as $kelas_value) {

            $siswa = Siswa::join('kelas_siswa', 'siswa.id', '=', 'kelas_siswa.siswa_id')->where('kelas_siswa.kelas_id', $kelas_value->id)->where('siswa.lulus', 0)->get();

            $excel->sheet($kelas_value->nama_kelas, function ($sheet) use($siswa, $excelHelper){

              $sheet->setColumnFormat([
                'A'=>'@',
                'B'=>'@',
                'C'=>'@',
                'H'=>'yyyy-mm-dd',
                'AF'=>'yyyy-mm-dd',
              ]);

              $sheet->row(1, $excelHelper->siswaHeader());

              $sheet->row(1, function($row) {
                $row->setBackground('#3f51b5');
                $row->setFontColor('#ffffff');
                $row->setFontWeight('bold');
                $row->setFontSize(15);
              });

              $no = 2;
              foreach ($siswa as $siswa_value) {
                $num = $no++;
                $sheet->row($num, function($row) {
                  $row->setFontSize(15);
                });
                $sheet->row($num, [
                  $siswa_value->nis,
                  $siswa_value->nisn,
                  $siswa_value->nik,
                  $siswa_value->nama_lengkap,
                  $siswa_value->nama_panggilan,
                  $siswa_value->kelamin,
                  $siswa_value->tempat_lahir,
                  $siswa_value->tgl_lahir,
                  $siswa_value->agama,
                  $siswa_value->kewarganegaraan,
                  $siswa_value->anak_ke,
                  $siswa_value->saudara_kandung,
                  $siswa_value->saudara_angkat,
                  $siswa_value->yatim,
                  $siswa_value->bahasa,
                  $siswa_value->alamat,
                  $siswa_value->no_telp,
                  $siswa_value->tinggal,
                  $siswa_value->jarak_tinggal,
                  $siswa_value->gol_darah,
                  $siswa_value->penyakit,
                  $siswa_value->kelainan,
                  $siswa_value->tinggi,
                  $siswa_value->berat,
                  $siswa_value->tamat_dari,
                  $siswa_value->no_ijazah,
                  $siswa_value->no_skhun,
                  $siswa_value->tgl_ijazah,
                  $siswa_value->tgl_skhun,
                  $siswa_value->dari_sekolah,
                  $siswa_value->alasan,
                  $siswa_value->tgl_diterima,
                  $siswa_value->nama_ayah,
                  $siswa_value->tempat_lahir_ayah,
                  $siswa_value->tgl_lahir_ayah,
                  $siswa_value->agama_ayah,
                  $siswa_value->kewarganegaraan_ayah,
                  $siswa_value->pendidikan_ayah,
                  $siswa_value->pekerjaan_ayah,
                  $siswa_value->pengeluaran_ayah,
                  $siswa_value->telp_ayah,
                  $siswa_value->alamat_ayah,
                  $siswa_value->hidup_ayah,
                  $siswa_value->nama_ibu,
                  $siswa_value->tempat_lahir_ibu,
                  $siswa_value->tgl_lahir_ibu,
                  $siswa_value->agama_ibu,
                  $siswa_value->kewarganegaraan_ibu,
                  $siswa_value->pendidikan_ibu,
                  $siswa_value->pekerjaan_ibu,
                  $siswa_value->pengeluaran_ibu,
                  $siswa_value->telp_ibu,
                  $siswa_value->alamat_ibu,
                  $siswa_value->hidup_ibu,
                  $siswa_value->nama_wali,
                  $siswa_value->tempat_lahir_wali,
                  $siswa_value->tgl_lahir_wali,
                  $siswa_value->agama_wali,
                  $siswa_value->kewarganegaraan_wali,
                  $siswa_value->pendidikan_wali,
                  $siswa_value->pekerjaan_wali,
                  $siswa_value->pengeluaran_wali,
                  $siswa_value->telp_wali,
                  $siswa_value->alamat_wali,
                  $siswa_value->sekolah_pindah,
                  $siswa_value->tgl_pindah_sekolah,
                  $siswa_value->alasan_pindah,
                  $siswa_value->th_lulus,
                  $siswa_value->tgl_ijazah_lulus,
                  $siswa_value->tgl_skhun_lulus,
                  $siswa_value->no_ijazah_lulus,
                  $siswa_value->no_skhun_lulus,
                  $siswa_value->lanjut_di,
                  $siswa_value->tgl_mulai_kerja,
                  $siswa_value->perusahaan,
                  ]);
                }
              });
            }
          })->export($format);
    }

    public function importFromExcel(Request $r)
    {
      ini_set('max_execution_time', 0);
      $excel_file = $r->file('excel_file');

      $ext = $excel_file->getClientOriginalExtension();
      $file_name = 'excel_'.round(microtime(true)).'.'.$ext;

      $excel_file->move('assets/excel', $file_name);

      $message = [];

      Excel::load('assets/excel/'.$file_name, function($reader) {
        $reader->each(function($sheet) {
          $nama_kelas = $sheet->getTitle();
          $kelas = Kelas::where('nama_kelas', $nama_kelas)->first();

          // echo $nama_kelas.'<br>';

          if ($kelas != null) {
            $sheet->each(function($row) use($kelas) {
              // if ($row->nis  != '' && $row->nis  != null) {
              //   $tgl = $row->tanggal_lahir;
              //
              //   if ($row->tanggal_lahir == '') {
              //     $tgl = 'KOSONG';
              //   }
              //   echo $row->nis.' - '.$row->nama_lengkap.' - '.$tgl.'<br>';
              // }
              $nis = $row->nis;
              $tanggal_lahir_excel = date('Y-m-d', strtotime(strval($row->tanggal_lahir)));
              $tanggal_lahir_user_excel = date('dmY', strtotime(strval($row->tanggal_lahir)));
              $tanggal_lahir = $row->tanggal_lahir;

              if ($nis != '' && $tanggal_lahir != '') {
                $siswa = Siswa::where('nis', $nis)->first();

                if ($siswa == null) {
                  $sekolah_id = Auth::user()->sekolah_id;
                  if ($sekolah_id < 10) {
                    $first_char = '0'.$sekolah_id.'-'.$nis;
                  }
                  else {
                    $first_char = $sekolah_id.'-'.$nis;
                  }

                  $create_siswa = new Siswa;
                  $create_siswa->status = '1';
                  $create_siswa->no_induk = $nis;
                  $create_siswa->nis = $nis;
                  $create_siswa->nisn = $row->nisn;
                  $create_siswa->nik = $row->nik;
                  $create_siswa->nama_lengkap = $row->nama_lengkap;
                  $create_siswa->nama_panggilan = $row->nama_panggilan;
                  $create_siswa->kelamin = $row->jenis_kelamin;
                  $create_siswa->tempat_lahir = $row->tempat_lahir;
                  $create_siswa->tgl_lahir = $tanggal_lahir_excel;
                  $create_siswa->agama = $row->agama;
                  $create_siswa->kewarganegaraan = $row->kewarganegaraan;
                  $create_siswa->anak_ke = $row->anak_ke;
                  $create_siswa->saudara_kandung = $row->saudara_kandung;
                  $create_siswa->saudara_angkat = $row->saudara_angkat;
                  $create_siswa->yatim = $row->yatim;
                  $create_siswa->bahasa = $row->bahasa;
                  $create_siswa->alamat = $row->alamat;
                  $create_siswa->no_telp = $row->no_telepon;
                  $create_siswa->tinggal = $row->tinggal;
                  $create_siswa->jarak_tinggal = $row->jarak_tinggal;
                  //====================================================================
                  $create_siswa->gol_darah = $row->golongan_darah;
                  $create_siswa->penyakit = $row->penyakit;
                  $create_siswa->kelainan = $row->kelainan;
                  $create_siswa->tinggi = $row->tinggi_badan;
                  $create_siswa->berat = $row->berat_badan;
                  //====================================================================
                  $create_siswa->tamat_dari = $row->tamat_dari;
                  $create_siswa->no_ijazah = $row->no_ijazah;
                  $create_siswa->no_skhun = $row->no_skhun;
                  $create_siswa->tgl_ijazah = $row->tgl_ijazah;
                  $create_siswa->tgl_skhun = $row->tgl_skhun;
                  $create_siswa->dari_sekolah = $row->dari_sekolah;
                  $create_siswa->alasan = $row->alasan;
                  $create_siswa->tgl_diterima = $row->tanggal_diterima;
                  //====================================================================
                  $create_siswa->nama_ayah = $row->nama_ayah;
                  $create_siswa->tempat_lahir_ayah = $row->tempat_lahir_ayah;
                  $create_siswa->tgl_lahir_ayah = $row->tanggal_lahir_ayah;
                  $create_siswa->agama_ayah = $row->agama_ayah;
                  $create_siswa->kewarganegaraan_ayah = $row->kewarganegaraan_ayah;
                  $create_siswa->pendidikan_ayah = $row->pendidikan_ayah;
                  $create_siswa->pekerjaan_ayah = $row->pekerjaan_ayah;
                  $create_siswa->pengeluaran_ayah = $row->pengeluaran_ayah;
                  $create_siswa->telp_ayah = $row->telepon_ayah;
                  $create_siswa->alamat_ayah = $row->alamat_ayah;
                  $create_siswa->hidup_ayah = $row->hidup_ayah;
                  $create_siswa->nama_ibu = $row->nama_ibu;
                  $create_siswa->tempat_lahir_ibu = $row->tempat_lahir_ibu;
                  $create_siswa->tgl_lahir_ibu = $row->tanggal_lahir_ibu;
                  $create_siswa->agama_ibu = $row->agama_ibu;
                  $create_siswa->kewarganegaraan_ibu = $row->kewarganegaraan_ibu;
                  $create_siswa->pendidikan_ibu = $row->pendidikan_ibu;
                  $create_siswa->pekerjaan_ibu = $row->pekerjaan_ibu;
                  $create_siswa->pengeluaran_ibu = $row->pengeluaran_ibu;
                  $create_siswa->telp_ibu = $row->telepon_ibu;
                  $create_siswa->alamat_ibu = $row->alamat_ibu;
                  $create_siswa->hidup_ibu = $row->hidup_ibu;
                  $create_siswa->nama_wali = $row->nama_wali;
                  $create_siswa->tempat_lahir_wali = $row->tempat_lahir_wali;
                  $create_siswa->tgl_lahir_wali = $row->tanggal_lahir_wali;
                  $create_siswa->agama_wali = $row->agama_wali;
                  $create_siswa->kewarganegaraan_wali = $row->kewarganegaraan_wali;
                  $create_siswa->pendidikan_wali = $row->pendidikan_wali;
                  $create_siswa->pekerjaan_wali = $row->pekerjaan_wali;
                  $create_siswa->pengeluaran_wali = $row->pengeluaran_wali;
                  $create_siswa->telp_wali = $row->telepon_wali;
                  $create_siswa->alamat_wali = $row->alamat_wali;
                  //====================================================================
                  $create_siswa->sekolah_pindah = $row->pendah_sekolah_ke;
                  $create_siswa->tgl_pindah_sekolah = $row->tanggal_pindah_sekolah;
                  $create_siswa->alasan_pindah = $row->alasan_pindah;
                  //====================================================================
                  $create_siswa->th_lulus = $row->tahun_lulus;
                  $create_siswa->tgl_ijazah_lulus = $row->tanggal_ijazah_lulus;
                  $create_siswa->tgl_skhun_lulus = $row->tanggal_skhun_lulus;
                  $create_siswa->no_ijazah_lulus = $row->no_ijazah_lulus;
                  $create_siswa->no_skhun_lulus = $row->no_skhun_lulus;
                  $create_siswa->lanjut_di = $row->lanjut_ke;
                  $create_siswa->tgl_mulai_kerja = $row->tanggal_mulai_kerja;
                  $create_siswa->perusahaan = $row->perusahaan;
                  //====================================================================
                  $create_siswa->foto = 'avatar.jpg';
                  $create_siswa->nomor_kartu = $first_char;
                  $create_siswa->pin = $tanggal_lahir_user_excel;
                  // $create_siswa->pin = Carbon::createFromFormat('Y-m-d', $tanggal_lahir)->format('dmY');
                  //====================================================================
                  $create_siswa->lulus = 0;
                  $create_siswa->save();

                  $kelas_siswa = new KelasSiswa;
                  $kelas_siswa->siswa_id = $create_siswa->id;
                  $kelas_siswa->kelas_id = $kelas->id;
                  $kelas_siswa->save();

                  $user = new User;
                  $user->username = $first_char;
                  $user->password = bcrypt($create_siswa->pin);
                  $user->sekolah_id = $sekolah_id;
                  $user->save();

                  $role_user = new RoleUser;
                  $role_user->user_id = $user->id;
                  $role_user->role_id = 5;
                  $role_user->save();
                }
              }
            });
          }
        });
      });

      // die();

      return redirect()->route('siswa_index')->with('message', 'Siswa berhasil diimpor.');
    }

    public function data_ujian(Request $r)
    {
      $sekolah_id = Auth::user()->sekolah_id;
      $sekolah = Sekolah::find($sekolah_id);
      $format = $r->input('format');
      $no = 1;
      $kelas_id = $r->input('kelas_id');
      $siswa = KelasSiswa::select('siswa.nama_lengkap as siswa_nama_lengkap',
                                  'siswa.nomor_kartu as siswa_nama_pengguna',
                                  'siswa.pin as siswa_kata_sandi',
                                  'kelas.nama_kelas as siswa_kelas')
                          ->join('siswa', 'kelas_siswa.siswa_id', '=', 'siswa.id')
                          ->join('kelas', 'kelas_siswa.kelas_id', '=', 'kelas.id')
                          ->where('kelas_siswa.kelas_id', $kelas_id)->get();
      if ($format == 'pdf') {
        $html = view('semaya.master.siswa.data_ujian.pdf', ['data' => $siswa, 'sekolah' => $sekolah]);
        $pdf = PDF::loadHTML($html)->setPaper('a4')->setOrientation('portrait');
        return $pdf->inline('LAPORAN_DATA_UJIAN_SISWA_'.Carbon::now()->format('Ymd').'.pdf');
      } else {
        Excel::create('LAPORAN_DATA_UJIAN_SISWA', function ($excel) use($siswa, $no){
          $excel->sheet('LAPORAN DATA UJIAN', function ($sheet) use($siswa, $no){
            $sheet->setAutoSize(true);
            $start_from = 2;

            //Start First Row Settings
            $sheet->cell('A1', function ($cell) {
              $cell->setValue('No');
            });
            $sheet->cell('B1', function ($cell) {
              $cell->setValue('Nama Lengkap');
            });
            $sheet->cell('C1', function ($cell) {
              $cell->setValue('Kelas');
            });
            $sheet->cell('D1', function ($cell) {
              $cell->setValue('Nama Pengguna');
            });
            $sheet->cell('E1', function ($cell) {
              $cell->setValue('Kata Sandi');
            });

            foreach ($siswa as $value) {
              $sheet->appendRow($start_from++, [
                $no++,
                $value->siswa_nama_lengkap,
                $value->siswa_kelas,
                $value->siswa_nama_pengguna,
                $value->siswa_kata_sandi,
              ]);
            }
            $last_row = $start_from - 1;
            $sheet->setBorder('A1:E'.$last_row, 'thin');
          });
        })->export($format);
      }
    }

    public function excelSample()
    {
      $excelHelper = $this->excelHelper;
      $excel_name_format = 'Contoh Data Siswa - '.Carbon::now();

      Excel::create($excel_name_format, function($excel) use($excelHelper){

        $excel->sheet('Nama Kelas 1', function ($sheet) use($excelHelper){

          $sheet->setColumnFormat([
            'A'=>'@',
            'B'=>'@',
            'C'=>'@',
            'H'=>'General',
            'AF'=>'@',
          ]);

          $sheet->row(1, $excelHelper->siswaHeader());

          $sheet->row(1, function($row) {
            $row->setBackground('#3f51b5');
            $row->setFontColor('#ffffff');
            $row->setFontWeight('bold');
            $row->setFontSize(15);
          });

          $sheet->row(2, function($row) {
            $row->setFontSize(15);
          });

          $sheet->cell('A1', function($cell) {
            $cell->setBackground('#E53935');
          });
          $sheet->cell('A2', function($cell) {
            $cell->setValue('10588');
          });

          $sheet->cell('H1', function($cell) {
            $cell->setBackground('#E53935');
          });
          $sheet->cell('H2', function($cell) {
            $cell->setValue('1999-05-19');
          });

        });

        $excel->sheet('Nama Kelas 2', function ($sheet) use($excelHelper){

          $sheet->setColumnFormat([
            'A'=>'@',
            'B'=>'@',
            'C'=>'@',
            'H'=>'@',
            'AF'=>'@',
          ]);

          $sheet->row(1, $excelHelper->siswaHeader());

          $sheet->row(1, function($row) {
            $row->setBackground('#3f51b5');
            $row->setFontColor('#ffffff');
            $row->setFontWeight('bold');
            $row->setFontSize(15);
          });

          $sheet->row(2, function($row) {
            $row->setFontSize(15);
          });

          $sheet->cell('A1', function($cell) {
            $cell->setBackground('#E53935');
          });
          $sheet->cell('A2', function($cell) {
            $cell->setValue('10578');
          });

          $sheet->cell('H1', function($cell) {
            $cell->setBackground('#E53935');
          });
          $sheet->cell('H2', function($cell) {
            $cell->setValue('1999-04-19');
          });

        });

      })->export('xls');
    }

    public function customExport(Request $r)
    {
      $kelas_id = $r->input('kelas_id');
      $jenis_laporan = $r->input('jenis_laporan');
      $format = $r->input('format');

      $validator = Validator::make($r->all(), [
        'kelas_id' => 'required',
        'jenis_laporan' => 'required',
        'format' => 'required',
      ]);

      if ($validator->fails()) {
        return redirect()->route('siswa_index');
      }

      $kelas = Kelas::findOrFail($kelas_id);

      if ($jenis_laporan == '2') {
        if ($kelas != null) {
          $nama_file = "REPORT_8355_KELAS_".strtoupper(str_slug($kelas->nama_kelas, '_'))."_".round(microtime(true));
          $no = 1;
          $siswa = KelasSiswa::select('siswa.nama_lengkap as siswa_nama',
                                      'siswa.nis as siswa_nis',
                                      'siswa.nisn as siswa_nisn',
                                      'siswa.nama_lengkap as siswa_nama',
                                      'siswa.kelamin as siswa_kelamin',
                                      'siswa.tempat_lahir as siswa_tempat_lahir',
                                      'siswa.tgl_lahir as siswa_tanggal_lahir',
                                      'siswa.agama as siswa_agama',
                                      'siswa.nama_ayah as siswa_nama_ayah',
                                      'siswa.alamat_ayah as siswa_alamat_ayah',
                                      'siswa.no_ijazah as siswa_no_ijazah',
                                      'siswa.tgl_ijazah as siswa_tgl_ijazah')
                              ->join('siswa', 'kelas_siswa.siswa_id', '=', 'siswa.id')
                              ->where('kelas_siswa.kelas_id', $kelas_id)->get();

          if ($format == 'pdf') {
              // dd($siswa);

              $pdf = PDF::loadView('semaya.master.siswa.report_8355.pdf', ['kelas' => $kelas, 'no' => $no, 'siswa' => $siswa]);
              return $pdf->setPaper('a4','landscape')->stream($nama_file . '.pdf');
              // return view('semaya.master.siswa.report_8355.pdf', ['no' => $no, 'siswa' => $siswa]);
          }
          else {
            Excel::create($nama_file, function ($excel) use($kelas, $siswa, $no){
              $excel->sheet($kelas->nama_kelas, function ($sheet) use($kelas, $siswa, $no){
                $sheet->setAutoSize(true);
                $start_from = 4;

                //Start First Row Settings
                $sheet->cell('A1', function ($cell) {
                  $cell->setValue('NOMOR');
                });
                $sheet->cell('D1', function ($cell) {
                  $cell->setValue('NAMA PESERTA DIDIK');
                });
                $sheet->cell('E1', function ($cell) {
                  $cell->setValue('L/P');
                });
                $sheet->cell('F1', function ($cell) {
                  $cell->setValue('TEMPAT.TANGGAL  LAHIR');
                });
                $sheet->cell('H1', function ($cell) {
                  $cell->setValue('AGAMA');
                });
                $sheet->cell('I1', function ($cell) {
                  $cell->setValue('NAMA ORANG TUA');
                });
                $sheet->cell('J1', function ($cell) {
                  $cell->setValue('ALAMAT ORANG TUA / WALI');
                });
                $sheet->cell('K1', function ($cell) {
                  $cell->setValue('TAHUN RAPORT');
                });
                $sheet->cell('N1', function ($cell) {
                  $cell->setValue('NOMOR IJAZAH SLTP');
                });
                $sheet->cell('O1', function ($cell) {
                  $cell->setValue('TAHUN IJAZAH');
                });
                $sheet->mergeCells('A1:C1');
                $sheet->mergeCells('F1:G2');
                $sheet->mergeCells('F3:G3');
                $sheet->mergeCells('K1:M2');
                //End First Row Settings

                //Start Second Row Settings
                $sheet->cell('A2', function ($cell) {
                  $cell->setValue('URUT');
                });
                $sheet->cell('B2', function ($cell) {
                  $cell->setValue('NIS');
                });
                $sheet->cell('C2', function ($cell) {
                  $cell->setValue('NISN');
                });
                // $sheet->cell('A2:C2', function ($cell) {
                //   $cell->setAlignment('center');
                //   $cell->setValignment('center');
                // });
                $sheet->cells('A1:O2', function ($cells) {
                  $cells->setAlignment('center');
                  $cells->setValignment('center');
                });
                //End Second Row Settings

                //Start Third Row Settings
                $sheet->cell('A3', function ($cell) {
                  $cell->setValue('1');
                });
                $sheet->cell('B3', function ($cell) {
                  $cell->setValue('2');
                });
                $sheet->cell('C3', function ($cell) {
                  $cell->setValue('3');
                });
                $sheet->cell('D3', function ($cell) {
                  $cell->setValue('4');
                });
                $sheet->cell('E3', function ($cell) {
                  $cell->setValue('5');
                });
                $sheet->cell('F3', function ($cell) {
                  $cell->setValue('6');
                });
                $sheet->cell('H3', function ($cell) {
                  $cell->setValue('7');
                });
                $sheet->cell('I3', function ($cell) {
                  $cell->setValue('8');
                });
                $sheet->cell('J3', function ($cell) {
                  $cell->setValue('9');
                });
                $sheet->cell('K3', function ($cell) {
                  $cell->setValue('10');
                });
                $sheet->cell('L3', function ($cell) {
                  $cell->setValue('11');
                });
                $sheet->cell('M3', function ($cell) {
                  $cell->setValue('12');
                });
                $sheet->cell('N3', function ($cell) {
                  $cell->setValue('13');
                });
                $sheet->cell('O3', function ($cell) {
                  $cell->setValue('14');
                });
                $sheet->cells('A3:O3', function ($cell) {
                  $cell->setAlignment('center');
                  $cell->setValignment('center');
                });
                //End Third Row Settings

                $sheet->setMergeColumn([
                  'columns' => ['D', 'E', 'H', 'I', 'J', 'N', 'O'],
                  'rows' => [
                    [1, 2],
                  ]
                ]);

                foreach ($siswa as $value) {
                  $sheet->appendRow($start_from++, [
                    $no++,
                    $value->siswa_nis,
                    $value->siswa_nisn,
                    $value->siswa_nama,
                    $value->siswa_kelamin,
                    $value->siswa_tempat_lahir,
                    Carbon::parse($value->siswa_tanggal_lahir)->format('d F Y'),
                    $value->siswa_agama,
                    $value->siswa_nama_ayah,
                    $value->siswa_alamat_ayah,
                    '-',
                    '-',
                    '-',
                    $value->siswa_no_ijazah,
                    Carbon::parse($value->siswa_tgl_ijazah)->format('Y'),
                  ]);
                }

                $last_row = $start_from - 1;
                $sheet->setBorder('A1:O'.$last_row, 'thin');
              });
            })->export($format);
          }
        }
      } elseif ($jenis_laporan == 1) {
        if ($kelas != null) {
          $nama_file = "REPORT_3A_KELAS_".strtoupper(str_slug($kelas->nama_kelas, '_'))."_".round(microtime(true));
          $no = 1;
          $siswa = KelasSiswa::select('siswa.nama_lengkap as siswa_nama',
                                      'siswa.nis as siswa_nis',
                                      'siswa.nisn as siswa_nisn',
                                      'siswa.nama_lengkap as siswa_nama',
                                      'siswa.kelamin as siswa_kelamin',
                                      'siswa.tempat_lahir as siswa_tempat_lahir',
                                      'siswa.tgl_lahir as siswa_tanggal_lahir',
                                      'siswa.agama as siswa_agama',
                                      'siswa.nama_ayah as siswa_nama_ayah',
                                      'siswa.alamat_ayah as siswa_alamat_ayah',
                                      'siswa.no_ijazah as siswa_no_ijazah',
                                      'siswa.tgl_ijazah as siswa_tgl_ijazah')
                              ->join('siswa', 'kelas_siswa.siswa_id', '=', 'siswa.id')
                              ->where('kelas_siswa.kelas_id', $kelas_id)->get();

          if ($format == 'pdf') {
              $pdf = PDF::loadView('semaya.master.siswa.report_3a.pdf', ['kelas' => $kelas, 'no' => $no, 'siswa' => $siswa]);
              return $pdf->setPaper('a4','landscape')->stream($nama_file . '.pdf');
          }
          else {
            Excel::create($nama_file, function ($excel) use($kelas, $siswa, $no){
              $excel->sheet($kelas->nama_kelas, function ($sheet) use($kelas, $siswa, $no){
                $sheet->setAutoSize(true);
                $start_from = 4;

                //Start First Row Settings
                $sheet->cell('A1', function ($cell) {
                  $cell->setValue('NOMOR');
                });
                $sheet->cell('D1', function ($cell) {
                  $cell->setValue('NAMA PESERTA DIDIK');
                });
                $sheet->cell('E1', function ($cell) {
                  $cell->setValue('L/P');
                });
                $sheet->cell('F1', function ($cell) {
                  $cell->setValue('TEMPAT.TANGGAL  LAHIR');
                });
                $sheet->cell('H1', function ($cell) {
                  $cell->setValue('AGAMA');
                });
                $sheet->cell('I1', function ($cell) {
                  $cell->setValue('NAMA ORANG TUA');
                });
                $sheet->cell('J1', function ($cell) {
                  $cell->setValue('ALAMAT ORANG TUA / WALI');
                });
                $sheet->cell('K1', function ($cell) {
                  $cell->setValue('NOMOR IJAZAH SLTP');
                });
                $sheet->cell('L1', function ($cell) {
                  $cell->setValue('TAHUN IJAZAH');
                });
                $sheet->mergeCells('A1:C1');
                $sheet->mergeCells('F1:G2');
                $sheet->mergeCells('F3:G3');
                //End First Row Settings

                //Start Second Row Settings
                $sheet->cell('A2', function ($cell) {
                  $cell->setValue('URUT');
                });
                $sheet->cell('B2', function ($cell) {
                  $cell->setValue('NIS');
                });
                $sheet->cell('C2', function ($cell) {
                  $cell->setValue('NISN');
                });
                // $sheet->cell('A2:C2', function ($cell) {
                //   $cell->setAlignment('center');
                //   $cell->setValignment('center');
                // });
                $sheet->cells('A1:O2', function ($cells) {
                  $cells->setAlignment('center');
                  $cells->setValignment('center');
                });
                //End Second Row Settings

                //Start Third Row Settings
                $sheet->cell('A3', function ($cell) {
                  $cell->setValue('1');
                });
                $sheet->cell('B3', function ($cell) {
                  $cell->setValue('2');
                });
                $sheet->cell('C3', function ($cell) {
                  $cell->setValue('3');
                });
                $sheet->cell('D3', function ($cell) {
                  $cell->setValue('4');
                });
                $sheet->cell('E3', function ($cell) {
                  $cell->setValue('5');
                });
                $sheet->cell('F3', function ($cell) {
                  $cell->setValue('6');
                });
                $sheet->cell('H3', function ($cell) {
                  $cell->setValue('7');
                });
                $sheet->cell('I3', function ($cell) {
                  $cell->setValue('8');
                });
                $sheet->cell('J3', function ($cell) {
                  $cell->setValue('9');
                });
                $sheet->cell('K3', function ($cell) {
                  $cell->setValue('10');
                });
                $sheet->cell('L3', function ($cell) {
                  $cell->setValue('11');
                });
                $sheet->cells('A3:O3', function ($cell) {
                  $cell->setAlignment('center');
                  $cell->setValignment('center');
                });
                //End Third Row Settings

                $sheet->setMergeColumn([
                  'columns' => ['D', 'E', 'H', 'I', 'J', 'K', 'L'],
                  'rows' => [
                    [1, 2],
                  ]
                ]);

                foreach ($siswa as $value) {
                  $sheet->appendRow($start_from++, [
                    $no++,
                    $value->siswa_nis,
                    $value->siswa_nisn,
                    $value->siswa_nama,
                    $value->siswa_kelamin,
                    $value->siswa_tempat_lahir,
                    Carbon::parse($value->siswa_tanggal_lahir)->format('d F Y'),
                    $value->siswa_agama,
                    $value->siswa_nama_ayah,
                    $value->siswa_alamat_ayah,
                    $value->siswa_no_ijazah,
                    Carbon::parse($value->siswa_tgl_ijazah)->format('Y'),
                  ]);
                }

                $last_row = $start_from - 1;
                $sheet->setBorder('A1:L'.$last_row, 'thin');
              });
            })->export($format);
          }
        }
      }
    }

    // public function deleteData()
    // {
    //   // $siswa = Siswa::all();
    //   //
    //   // foreach ($siswa as $value) {
    //   User::where('id', '>', 4)->delete();
    //     // User::where('username', '!=', 'admin1')->where('username', '!=', 'root1')->delete();
    //   // }
    //   //
    //   // Siswa::where('id','!=',0)->delete();
    //
    //   return redirect()->route('home');
    // }
}
