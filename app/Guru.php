<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = 'guru';

    public function guru_pelajaran()
    {
      return $this->belongsTo('App\GuruPelajaran', 'id', 'guru_id');
    }
}
