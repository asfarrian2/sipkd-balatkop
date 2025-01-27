<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class SpjController extends Controller
{
    public function view(Request $request): view
    {
        $penyedia = DB::table('penyedia')
        ->orderBy('id_penyedia')
        ->get();


        //select Sub Kegiatan
        $sub_kegiatan = DB::table('sub_kegiatan')
        ->orderBy('kode_sub_kegiatan')
        ->get();


        $detail_subkegiatan=DB::table('detail_subkegiatan')
        ->leftJoin('kode_rekening', 'detail_subkegiatan.kode_rekening', '=', 'kode_rekening.kode_rekening')
        ->where('kode_sub_kegiatan',  $request->sub_keg)
        ->get();

        $modal = DB::table('sub_kegiatan')
        ->leftJoin('kegiatan', 'sub_kegiatan.kode_kegiatan', '=', 'kegiatan.kode_kegiatan')
        ->leftJoin('program', 'kegiatan.kode_program', '=', 'program.kode_program')
        ->where('kode_sub_kegiatan',  $request->sub_keg)
        ->first();


        if ($detail_subkegiatan) {
            $spj = DB::table('spj')->where('id_subdet', $request->detail_subkegiatan)->get();
        } else {
            $spj = [];
        }

        // $spj = DB::table('spj')
        // ->orderBy('id_spj')
        // ->get();

        //select Kode Rekening Detail

        return view('admin.spj.view', compact('sub_kegiatan', 'detail_subkegiatan', 'spj', 'modal', 'penyedia'));
    }

    public function getobjek($kode_sub_kegiatan){
        $detail_subkegiatan = DB::table('detail_subkegiatan')
        ->leftJoin('kode_rekening', 'detail_subkegiatan.kode_rekening', '=', 'kode_rekening.kode_rekening')
        ->where('kode_sub_kegiatan', $kode_sub_kegiatan)
        ->get();

        return response()->json($detail_subkegiatan);
    }


    public function store(Request $request)
    {

        $id_spj=DB::table('spj')
        ->latest('id_spj', 'DESC')
        ->first();


        $kodedata ="KWT-";

        $kodeobjek ="SPJ-";

        if($id_spj == null){
            $nomorid  = "00001";
            $nomorspj = "00001";

        }else{
            $nomorid = substr($id_spj->id_spj, 4, 5) + 1;
            $nomorid = str_pad($nomorid, 5, "0", STR_PAD_LEFT);
            $nomorspj = substr($id_spj->id_spj, 4, 5) + 1;
            $nomorspj = str_pad($nomorspj, 5, "0", STR_PAD_LEFT);
        }
        $no_spj=$kodeobjek.$nomorspj;
        $id=$kodedata.$nomorid;

        $kode_program = $request->kode_program;
        $kode_kegiatan = $request->kode_kegiatan;
        $kode_sub_kegiatan = $request->kode_sub_kegiatan;
        $id_subdet = $request->id_subdet;
        $tgl_spj = $request->tgl_spj;
        $uraian_spj = $request->uraian_spj;
        $id_penyedia = $request->id_penyedia;


        $data = [
            'id_spj' => $id,
            'no_spj' => $no_spj,
            'tgl_spj' => $tgl_spj,
            'uraian_spj' => $uraian_spj,
            'id_subdet' => $id_subdet,
            'kode_program' => $kode_program,
            'kode_kegiatan' => $kode_kegiatan,
            'kode_sub_kegiatan' => $kode_sub_kegiatan,
            'id_penyedia' => $id_penyedia,
            'nominal_spj' => '0',
            'status_spj' => '0'
        ];
        $simpan = DB::table('spj')->insert($data);
        if ($simpan) {
            return Redirect::back()->with(['success' => 'Data Berhasil Disimpan']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Disimpan']);
        }
    }

    public function hapus($id_spj){

        $delete = DB::table('spj')->where('id_spj', $id_spj)->delete();
        if ($delete) {
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus !']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Dihapus !']);
        }
    }

    public function edit(Request $request){
        $id_spj = $request->id_spj;
        return view('admin.spj.edit', compact('id_spj'));
    }



}
