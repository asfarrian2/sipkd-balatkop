<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;


class UsersController extends Controller
{
    public function view()
    {
        $users = DB::table('users')
        ->where('usertype', 'user')
        ->get();

        return view('admin.user.view', compact('users'));
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $nama = $request->nama;
        $email = $request->email;
        $nip = $request->nip;
        $tempat_lahir = $request->tempat_lahir;
        $tgl_lahir = $request->tgl_lahir;
        $pangkat_golongan = $request->pangkat_golongan;
        $jabatan = $request->jabatan;
        $no_telepon  = $request->no_telepon;

        $cekemail = DB::table('users')
        ->where('email', $email)
        ->where('email', '!=', $email)
        ->count();
         if ($cekemail > 0) {
        return Redirect::back()->with(['warning' => 'email Sudah Digunakan']);
         }
        try {
            $data = [
                'name' => $nama,
                'email' => $email,
                'nip' => $nip,
                'tempat_lahir' => $tempat_lahir,
                'tgl_lahir' => $tgl_lahir,
                'pangkat_golongan' => $pangkat_golongan,
                'jabatan' => $jabatan,
                'no_telp' => $no_telepon,
                'password' => Hash::make($no_telepon),
                'usertype' => 'user'
            ];
            DB::table('users')->insert($data);
            return redirect('/user/view')->with(['success' => 'Data Berhasil Disimpan !']);
            } catch (\Exception $e) {
            return Redirect::back()->with(['warning' => 'Data Gagal Disimpan !']);
            }
    }

    public function edit($id)
    {
        $users = DB::table('users')->where('id', $id)->first();
        return view('admin.user.edit', compact('users'));
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $nama = $request->nama;
        $username = $request->username;
        $nip = $request->nip;
        $tempat_lahir = $request->tempat_lahir;
        $tgl_lahir = $request->tgl_lahir;
        $pangkat_golongan = $request->pangkat_golongan;
        $jabatan = $request->jabatan;
        $no_telp = $request->no_telp;
        $email = $request->email;
        $password = $request->password;

        $data =  [
                'name' => $nama,
                'nip' => $nip,
                'tempat_lahir' => $tempat_lahir,
                'tgl_lahir' => $tgl_lahir,
                'pangkat_golongan' => $pangkat_golongan,
                'jabatan' => $jabatan,
                'no_telp' => $no_telp,
                'email' => $email,
                'password' => $password,
                'usertype' => 'user'
            ];
            $update = DB::table('users')->where('id', $id)->update($data);
            if ($update) {
                return redirect('user/view')->with(['success' => 'Data Berhasil Diubah !']);
            } else {
                return Redirect::back()->with(['warning' => 'Data Gagal Diubah !']);
            }
     }


}
