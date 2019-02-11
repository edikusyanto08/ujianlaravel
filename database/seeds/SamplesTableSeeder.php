<?php

use Illuminate\Database\Seeder;
use App\SekolahMaster;
use App\User;
use App\RoleUser;
use App\Admin;
use App\Root;

class SamplesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $sekolah = new SekolahMaster;
      $sekolah->nama = 'SMK Negeri 10 Jakarta';
      $sekolah->database = 'semaya_sas_smkn10';
      $sekolah->database2 = 'semaya_absensi_smkn10';
      $sekolah->database3 = 'semaya_tes_online_smkn10';
      $sekolah->database4 = 'semaya_perpustakaan_smkn10';
      $sekolah->expired = '2018-01-01';
      $sekolah->status = 1;
      $sekolah->save();

      $admin_user = new User;
      $admin_user->username = 'admin1';
      $admin_user->password = bcrypt('admin1');
      $admin_user->sekolah_id = $sekolah->id;
      $admin_user->save();

      $root_user = new User;
      $root_user->username = 'root1';
      $root_user->password = bcrypt('root1');
      $root_user->sekolah_id = $sekolah->id;
      $root_user->save();

      $role_admin_user = new RoleUser;
      $role_admin_user->user_id = $admin_user->id;
      $role_admin_user->role_id = 2;
      $role_admin_user->save();

      $role_root_user = new RoleUser;
      $role_root_user->user_id = $root_user->id;
      $role_root_user->role_id = 1;
      $role_root_user->save();

      $admin = new Admin;
      $admin->nama = 'Admin SAS SMKN 10 Jakarta';
      $admin->username = $admin_user->username;
      $admin->foto = 'avatar.jpg';
      $admin->save();

      $root = new Root;
      $root->nama = 'Root';
      $root->username = $root_user->username;
      $root->foto = 'avatar.jpg';
      $root->save();
    }
}
