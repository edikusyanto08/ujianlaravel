<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KelasSiswa extends Model
{
    protected $table = 'kelas_siswa';

    public function kelas()
    {
      return $this->belongsTo('App\Kelas');
    }
}
