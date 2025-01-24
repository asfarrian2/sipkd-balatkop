<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class TunaiController extends Controller
{
    public function view()
    {
        $tunai = DB::table('tunai')
            ->orderBy('tunai.id_tunai')
            ->get();

            return view('admin.tunai.view', compact('tunai'));
    }

    public function create()
    {
        return view('admin.tunai.create');
    }


    public function store(Request $request)
    {

        $id_tunai=DB::table('tunai')
        ->latest('id_tunai', 'DESC')
        ->first();

        $kodeobjek ="TN-";

        if($id_tunai == null){
            $nomorurut = "01";
        }else{
            $nomorurut = substr($id_tunai->id_tunai, 3, 2) + 1;
            $nomorurut = str_pad($nomorurut, 2, "0", STR_PAD_LEFT);
        }
        $id=$kodeobjek.$nomorurut;

        $id_tunai = $request->id_tunai;
        $tanggal = $request->tanggal;
        $uraian = $request->uraian;
        $nominal = $request->nominal;

        $pagu        = str_replace(',','', $nominal);

        $data = [
            'id_tunai' => $id,
            'tgl_tunai' => $tanggal,
            'uraian_tunai' => $uraian,
            'nominal_tunai' => $pagu,
            'metode_tunai' => 'tnt',
            'status_tunai' => '0'
        ];
        $simpan = DB::table('tunai')->insert($data);
        if ($simpan) {
            return Redirect('/tunai/view')->with(['success' => 'Data Berhasil Disimpan']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Disimpan']);
        }
    }

    public function edit($id_tunai)
    {
        $tunai = DB::table('tunai')
        ->where('id_tunai', $id_tunai)
        ->first();
        return view('admin.tunai.edit', compact('tunai'));

    }

    public function update(Request $request)
    {
        $id_tunai = $request->id_tunai;
        $tgl_tunai = $request->tgl_tunai;
        $nominal_tunai = $request->nominal_tunai;

        $pagu = str_replace(',', '', $nominal_tunai);

        $data = [
                    'tgl_tunai'       => $tgl_tunai,
                    'nominal_tunai'   => $pagu
                ];

        $update=DB::table('tunai')->where('id_tunai', $id_tunai)->update($data);
        if ($update){
            return redirect('/tunai/view')->with(['success' => 'Data Berhasil Diubah !']);
        }else{
            return Redirect::back()->with(['warning' => 'Data Gagal Diubah !']);
            }

        }


    public function hapus($id_tunai){

        $delete = DB::table('tunai')->where('id_tunai', $id_tunai)->delete();
        if ($delete) {
            return redirect('/tunai/view')->with(['success' => 'Data Berhasil Dihapus !']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Dihapus !']);
        }
    }
}
