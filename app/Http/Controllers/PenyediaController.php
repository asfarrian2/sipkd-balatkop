<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class PenyediaController extends Controller
{
    public function view()
    {
        $penyedia = DB::table('penyedia')
        ->get();

        return view('admin.penyedia.view', compact('penyedia'));
    }

    public function create()
    {
        return view('admin.penyedia.create');
    }

    public function store(Request $request)
    {
        $nama = $request->nama;
        $nip = $request->nip;
        $npwp = $request->npwp;
        $no_rekening = $request->no_rekening;
        $keterangan = $request->keterangan;
        $data = [
            'nama' => $nama,
            'nip' => $nip,
            'npwp' => $npwp,
            'no_rekening' => $no_rekening,
            'keterangan' => $keterangan
        ];
        $simpan = DB::table('penyedia')->insert($data);
        if ($simpan) {
            return Redirect('/penyedia/view')->with(['success' => 'Data Berhasil Disimpan']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Disimpan']);
        }
    }

    public function hapus($id_penyedia)
    {
       $delete = DB::table('penyedia')->where('id_penyedia', $id_penyedia)->delete();
       if ($delete) {
           return redirect('/penyedia/view')->with(['success' => 'Data Berhasil Dihapus !']);
       } else {
           return Redirect::back()->with(['warning' => 'Data Gagal Dihapus !']);
       }
    }

    public function edit($id_penyedia)
    {
        $penyedia = DB::table('penyedia')->where('id_penyedia', $id_penyedia)->first();
        return view('admin.penyedia.edit', compact('penyedia'));
    }

    public function update(Request $request)
    {
        $id_penyedia = $request->id_penyedia;
        $nama = $request->nama;
        $nip = $request->nip;
        $npwp = $request->npwp;
        $no_rekening = $request->no_rekening;
        $keterangan = $request->keterangan;

        $data =  [
                'nama' => $nama,
                'nip' => $nip,
                'npwp' => $npwp,
                'no_rekening' => $no_rekening,
                'keterangan' => $keterangan
            ];
            $update = DB::table('penyedia')->where('id_penyedia', $id_penyedia)->update($data);
            if ($update) {
                return redirect('/penyedia/view')->with(['success' => 'Data Berhasil Diubah !']);
            } else {
                return Redirect::back()->with(['warning' => 'Data Gagal Diubah !']);
            }
     }

}
