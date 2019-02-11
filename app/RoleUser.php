<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    protected $connection = 'semaya_master';

    protected $table = 'role_user';

    public $timestamps = false;
}
