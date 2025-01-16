<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;


class PejabatpelaksanaController extends Controller
{
    public function view()
    {
        $pejabat_pelaksana = DB::table('pejabat_pelaksana')
        ->orderBy('id_pejabat')
        ->get();

        return view('admin.pejabatpelaksana.view', compact('pejabat_pelaksana'));
    }

    public function edit($id_pejabat)
    {
        $pejabat_pelaksana = DB::table('pejabat_pelaksana')->where('id_pejabat', $id_pejabat)->first();
        return view('admin.pejabatpelaksana.edit', compact('pejabat_pelaksana'));
    }

    public function update(Request $request)
    {
        $id_pejabat = $request->id_pejabat;
        $nama_pejabat = $request->nama_pejabat;
        $nip_pejabat = $request->nip_pejabat;
        $jabatan_pejabat = $request->jabatan_pejabat;

            $data =  [
                'nama_pejabat' => $nama_pejabat,
                'nip_pejabat' => $nip_pejabat,
                'jabatan_pejabat' => $jabatan_pejabat
            ];
            $update = DB::table('pejabat_pelaksana')->where('id_pejabat', $id_pejabat)->update($data);
            if ($update) {
                return redirect('/pejabatpelaksana/view')->with(['success' => 'Data Berhasil Diubah !']);
            } else {
                return Redirect::back()->with(['warning' => 'Data Gagal Diubah !']);
            }

     }

}
