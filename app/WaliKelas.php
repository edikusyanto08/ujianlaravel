<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WaliKelas extends Model
{
    protected $table = 'wali_kelas';

    public function guru()
    {
      return $this->belongsTo('App\Guru', 'guru_id', 'id');
    }
}
