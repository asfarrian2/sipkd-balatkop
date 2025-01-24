<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class BkuController extends Controller
{
    public function view(){

        $bku = DB::table('bku')
        ->get();

        return view('admin.bku.view', compact('bku'));

    }

    public function lock($id_bku){

        $data = [
            'status_bku' => '1',
        ];

        $update=DB::table('bku')->where('id_bku', $id_bku)->update($data);
        if ($update){
            return redirect('/bku/view')->with(['success' => 'Data Berhasil Dikunci !']);
        }else{
            return Redirect::back()->with(['warning' => 'Data Gagal Dikunci !']);
            }

    }

    public function hapus($id_bku){

        $bku = DB::table('bku')
        ->where('id_bku', $id_bku)
        ->first();

        $kd_jenis = $bku->kd_jenis;

        $up = DB::table('up')
        ->where('id_up', $kd_jenis)
        ->first();

        $tunai = DB::table('tunai')
        ->where('id_tunai', $kd_jenis)
        ->first();

        $dataup =[
            'status_up' => '0'
        ];
        $datatunai =[
            'status_tunai' => '0'
        ];


        if($tunai == null){
            DB::table('up')->where('id_up', $kd_jenis)->update($dataup);
        }else{
            DB::table('tunai')->where('id_tunai', $kd_jenis)->update($datatunai);
        }

        $delete = DB::table('bku')->where('id_bku', $id_bku)->delete();
        if ($delete) {
            return redirect('/bku/view')->with(['success' => 'Data Berhasil Dihapus !']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Dihapus !']);
        }
    }




    //uang_pelimpahan
    public function penerimaan(){

        $up = DB::table('up')
        ->where('status_up', '0')
        ->get();

        return view('admin.bku.penerimaan', compact('up'));

    }

    public function create_penerimaan($Request){

        $up = DB::table('up')
        ->where('status_up', '0')
        ->get();

        return view('admin.bku.penerimaan', compact('up'));

    }

    public function store_penerimaan($id_up)
    {

        $up=DB::table('up')
        ->where('id_up', $id_up)
        ->first();

        $id_bku=DB::table('bku')
        ->latest('id_bku', 'DESC')
        ->first();

        $kodeobjek ="BKU-";

        if($id_bku == null){
            $nomorurut = "0001";
        }else{
            $nomorurut = substr($id_bku->id_bku, 4, 4) + 1;
            $nomorurut = str_pad($nomorurut, 4, "0", STR_PAD_LEFT);
        }
        $id=$kodeobjek.$nomorurut;


        $pagu        = str_replace(',','', $up->nominal_up);

        $data = [
            'id_bku' => $id,
            'tgl_bku' => $up->tgl_up,
            'uraian_bku' => $up->uraian_up,
            'penerimaan_tnt' => $pagu,
            'penerimaan_t' => '0',
            'pengeluaran_tnt' => '0',
            'pengeluaran_t' => '0',
            'status_bku' => '0',
            'kd_jenis' => $id_up
        ];

        $data2 = [
            'status_up' => '1'
        ];

        $simpan = DB::table('bku')->insert($data);
        if ($simpan) {
            DB::table('up')->where('id_up', $id_up)->update($data2);
            return Redirect('/bku/view')->with(['success' => 'Data Berhasil Disimpan']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Disimpan']);
        }
    }

    //uang_pelimpahan
    public function tunai(){

        $tunai = DB::table('tunai')
        ->where('status_tunai', '0')
        ->get();

        return view('admin.bku.tunai', compact('tunai'));

    }

    public function store_tunai($id_tunai)
    {

        $tunai=DB::table('tunai')
        ->where('id_tunai', $id_tunai)
        ->first();

        $id_bku=DB::table('bku')
        ->latest('id_bku', 'DESC')
        ->first();

        $kodeobjek ="BKU-";

        if($id_bku == null) {
            $nomorurut = "0001";
        }else{
            $nomorurut = substr($id_bku->id_bku, 4, 4) + 1;
            $nomorurut = str_pad($nomorurut, 4, "0", STR_PAD_LEFT);
        }
        $id=$kodeobjek.$nomorurut;


        $pagu        = str_replace(',','', $tunai->nominal_tunai);

        $data = [
            'id_bku' => $id,
            'tgl_bku' => $tunai->tgl_tunai,
            'uraian_bku' => $tunai->uraian_tunai,
            'penerimaan_tnt' => '0',
            'penerimaan_t' => $pagu,
            'pengeluaran_tnt' => $pagu,
            'pengeluaran_t' => '0',
            'status_bku' => '0',
            'kd_jenis' => $id_tunai
        ];

        $data2 = [
            'status_tunai' => '1'
        ];

        $simpan = DB::table('bku')->insert($data);
        if ($simpan) {
            DB::table('tunai')->where('id_tunai', $id_tunai)->update($data2);
            return Redirect('/bku/view')->with(['success' => 'Data Berhasil Disimpan']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Disimpan']);
        }
    }




}
