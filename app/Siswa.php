<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';

    public function kelas_siswa()
    {
      return $this->belongsTo('App\KelasSiswa', 'id', 'siswa_id');
    }
}
