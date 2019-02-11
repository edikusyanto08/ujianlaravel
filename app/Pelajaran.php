<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pelajaran extends Model
{
    protected $table = 'pelajaran';

    public function jenis_pelajaran()
    {
      return $this->belongsTo('App\JenisPelajaran');
    }
}
