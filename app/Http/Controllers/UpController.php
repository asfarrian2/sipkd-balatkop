<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class UpController extends Controller
{
    public function view()
    {
        $up = DB::table('up')
            ->orderBy('up.id_up')
            ->get();

            return view('admin.up.view', compact('up'));
    }

    public function create()
    {
        return view('admin.up.create');
    }

    public function store(Request $request)
    {

        $id_up=DB::table('up')
        ->latest('id_up', 'DESC')
        ->first();

        $kodeobjek ="UP-";

        if($id_up == null){
            $nomorurut = "01";
        }else{
            $nomorurut = substr($id_up->id_up, 3, 2) + 1;
            $nomorurut = str_pad($nomorurut, 2, "0", STR_PAD_LEFT);
        }
        $id=$kodeobjek.$nomorurut;

        $id_up = $request->id_up;
        $tanggal = $request->tanggal;
        $uraian = $request->uraian;
        $nominal = $request->nominal;

        $pagu        = str_replace(',','', $nominal);

        $data = [
            'id_up' => $id,
            'tgl_up' => $tanggal,
            'uraian_up' => $uraian,
            'nominal_up' => $pagu,
            'status_up' => '0'
        ];
        $simpan = DB::table('up')->insert($data);
        if ($simpan) {
            return Redirect('/up/view')->with(['success' => 'Data Berhasil Disimpan']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Disimpan']);
        }
    }

    public function edit($id_up)
    {
        $up = DB::table('up')
        ->where('id_up', $id_up)
        ->first();
        return view('admin.up.edit', compact('up'));

    }

    public function update(Request $request)
    {
        $id_up = $request->id_up;
        $tgl = $request->tgl;
        $nominal = $request->nominal;

        $pagu = str_replace(',', '', $nominal);

        $data = [
                    'tgl'       => $tgl,
                    'nominal'   => $pagu
                ];

        $update=DB::table('up')->where('id_up', $id_up)->update($data);
        if ($update){
            return redirect('/up/view')->with(['success' => 'Data Berhasil Diubah !']);
        }else{
            return Redirect::back()->with(['warning' => 'Data Gagal Diubah !']);
            }

        }

        public function hapus($id_up){

            $delete = DB::table('up')->where('id_up', $id_up)->delete();
            if ($delete) {
                return redirect('/up/view')->with(['success' => 'Data Berhasil Dihapus !']);
            } else {
                return Redirect::back()->with(['warning' => 'Data Gagal Dihapus !']);
            }
        }

        public function lock($id_up){

            $up = DB::table('up')
            ->where('id_up', $id_up)
            ->first();

            $tgl_bku = $up->tgl;

            $data = [
                'status' => '1',
                'tgl_bku' => $tgl_bku
            ];

            $update=DB::table('up')->where('id_up', $id_up)->update($data);
            if ($update){
                return redirect('/up/view')->with(['success' => 'Data Berhasil Diverifikasi !']);
            }else{
                return Redirect::back()->with(['warning' => 'Data Gagal Diferivikasi !']);
                }

        }


}
