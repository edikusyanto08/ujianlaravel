<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use App\User;
use App\Role;
use App\RoleUser;
use Validator;
use App\Http\Controllers\InterfaceHelper as IH;
use Auth;
use File;

class AdminController extends Controller
{
    public function index()
    {
      $q = '';
      $admin = Admin::orderBy('id','desc')->paginate(10);
      $no = $admin->firstItem();
      return view('semaya.master.admin.index',['q'=>$q,'admin'=>$admin,'no'=>$no]);
    }

    public function search(Request $r)
    {
      $q = $r->input('q');
      $admin = Admin::where('nama','like','%'.$q.'%')->orWhere('username','like','%'.$q.'%')->orderBy('id','desc')->paginate(10);
      $no = $admin->firstItem();
      return view('semaya.master.admin.index',['q'=>$q,'admin'=>$admin,'no'=>$no]);
    }

    public function create()
    {
      $roles = Role::where('name','like','%admin_%')->get();
      return view('semaya.master.admin.create',['roles'=>$roles]);
    }

    public function store(Request $r)
    {
      $interface_helper = new IH;
      $nama = $r->input('nama');
      $username = $r->input('nama_pengguna');
      $password = $r->input('password');
      $role_id = $r->input('tipe');
      $foto = $r->file('foto');

      $validator = Validator::make($r->all(),[
        'nama'=>'required',
        'nama_pengguna'=>'required|unique:semaya_master.users,username',
        'password'=>'required',
        'tipe'=>'required',
      ]);

      if ($validator->fails()) {
        return redirect()->route('admin_create')->with('message', $validator->errors()->all())->withInput();
      }

      $user = new User;
      $user->username = $username;
      $user->password = bcrypt($password);
      $user->sekolah_id = Auth::user()->sekolah_id;
      $user->save();

      $role = Role::find($role_id);

      $role_user = new RoleUser;
      $role_user->user_id = $user->id;
      $role_user->role_id = $role->id;
      $role_user->save();

      $admin = new Admin;
      $admin->nama = $nama;
      $admin->username = $username;
      if ($r->hasFile('foto')) {
        $rand_name = round(microtime(true));
        $ext = $foto->getClientOriginalExtension();
        $final_name = 'img_'.$rand_name.'.'.$ext;

        $foto->move('assets/img/users', $final_name);
        $admin->foto = $final_name;
      }
      else {
        $admin->foto = 'avatar.jpg';
      }
      $admin->save();

      return redirect()->route('admin_index')->with('message','Admin berhasil disimpan.');
    }

    public function edit($id)
    {
      $roles = Role::where('name','like','%admin_%')->get();
      $admin = Admin::find($id);
      $user = User::where('username',$admin->username)->first();
      $role_user = RoleUser::where('user_id',$user->id)->first();
      return view('semaya.master.admin.edit',['roles'=>$roles,'admin'=>$admin,'user'=>$user,'role_user'=>$role_user]);
    }

    public function update(Request $r)
    {
      $id = $r->input('id');
      $user_id = $r->input('user_id');
      $nama = $r->input('nama');
      $role_id = $r->input('tipe');
      $username = $r->input('nama_pengguna');
      $password = $r->input('password');
      $foto = $r->file('foto');

      $validator = Validator::make($r->all(),[
        'id'=>'required',
        'user_id'=>'required',
        'nama'=>'required',
        'tipe'=>'required',
        'nama_pengguna'=>'required|unique:semaya_master.users,username,'.$user_id,
      ]);

      if ($validator->fails()) {
        return redirect()->route('admin_edit', ['id'=>$id])->with('message', $validator->errors()->all())->withInput();
      }

      $user = User::find($user_id);
      $user->username = $username;
      if ($password!='') {
        $user->password = bcrypt($password);
      }
      $user->save();

      RoleUser::where('user_id', $user->id)->delete();

      $role_user = new RoleUser;
      $role_user->user_id = $user->id;
      $role_user->role_id = $role_id;
      $role_user->save();

      $admin = Admin::find($id);
      $admin->nama = $nama;
      $admin->username = $username;
      if ($r->hasFile('foto')) {
        $rand_name = round(microtime(true));
        $ext = $foto->getClientOriginalExtension();
        $final_name = 'img_'.$rand_name.'.'.$ext;

        $foto->move('assets/img/users', $final_name);
        $admin->foto = $final_name;
      }
      $admin->save();

      return redirect()->route('admin_index')->with('message','Admin berhasil diubah.');
    }

    public function destroy(Request $r, $id)
    {
      $admin = Admin::findOrFail($id);

      if ($admin->foto != 'avatar.jpg') {
        File::delete('assets/img/users/'.$admin->foto);
      }

      $user = User::where('username', $admin->username)->delete();

      $admin->delete();

      return redirect()->route('admin_index')->with('message','Admin berhasil dihapus.');
    }
}
