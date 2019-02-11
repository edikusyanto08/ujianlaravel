<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    public function tingkat()
    {
      return $this->belongsTo('App\Tingkat');
    }

    public function jurusan()
    {
      return $this->belongsTo('App\Jurusan');
    }

    public function wali_kelas()
    {
      return $this->belongsTo('App\WaliKelas', 'id', 'kelas_id');
    }
}
