<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class RekeningdetailController extends Controller
{
    public function view($id_subdet)
    {
        $data_subdet = DB::table('detail_subkegiatan')
        ->Join('sub_kegiatan', 'detail_subkegiatan.kode_sub_kegiatan', '=', 'sub_kegiatan.kode_sub_kegiatan')
        ->Join('kegiatan', 'sub_kegiatan.kode_kegiatan', '=', 'kegiatan.kode_kegiatan')
        ->Join('kode_rekening', 'detail_subkegiatan.kode_rekening', '=', 'kode_rekening.kode_rekening')
        ->Join('pejabat_pelaksana', 'sub_kegiatan.id_pejabat', '=', 'pejabat_pelaksana.id_pejabat')
        ->select('detail_subkegiatan.*', 'sub_kegiatan.*', 'kode_rekening.*', 'kegiatan.*', 'pejabat_pelaksana.*')
        ->where('detail_subkegiatan.id_subdet', $id_subdet)
        ->orderBy('detail_subkegiatan.kode_rekening')
        ->first();

        $data_rekening = DB::table('rekening_det')
        ->where('rekening_det.id_subdet', $id_subdet)
        ->get();

        $sum = DB::table('rekening_det')
        ->where('rekening_det.id_subdet', $id_subdet)
        ->sum('pagu_rekdet');


        return view('admin.rekening_detail.view', compact('data_subdet', 'data_rekening', 'sum'));

    }

    public function store(Request $request)
    {

        $id_rekdet=DB::table('rekening_det')
        ->latest('id_rekdet', 'DESC')
        ->first();

        $kodeobjek ="RD";

        if($id_rekdet == null){
            $nomorurut = "0001";
        }else{
            $nomorurut = substr($id_rekdet->id_rekdet, 2, 4) + 1;
            $nomorurut = str_pad($nomorurut, 4, "0", STR_PAD_LEFT);
        }
        $id=$kodeobjek.$nomorurut;

        $id_subdet = $request->id_subdet;
        $uraian = $request->uraian;
        $pagu_rekdet = $request->pagu_rekdet;
        $koefesien = $request->koefesien;
        $satuan = $request->satuan;

        $pagu        = str_replace(',','', $pagu_rekdet);

        $data = [
            'id_rekdet' => $id,
            'id_subdet' => $id_subdet,
            'uraian_rekdet' => $uraian,
            'pagu_rekdet' => $pagu,
            'koefesien_rekdet' => $koefesien,
            'satuan_rekdet' => $satuan
        ];
        $simpan = DB::table('rekening_det')->insert($data);
        if ($simpan) {
            return Redirect('/rekeningdetail/'.$id_subdet)->with(['success' => 'Data Berhasil Disimpan']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Disimpan']);
        }
    }

    public function edit($id_rekdet)
    {

        $data_rekening = DB::table('rekening_det')
        ->where('rekening_det.id_rekdet', $id_rekdet)
        ->first();
        return view('admin.rekening_detail.edit', compact('data_rekening'));

    }

    public function update(Request $request)
    {
        $id_subdet = $request->id_subdet;
        $id_rekdet = $request->id_rekdet;
        $uraian_rekdet   = $request->uraian;
        $pagu_rekdet = $request->pagu_rekdet;
        $satuan_rekdet = $request->satuan_rekdet;
        $koefesien_rekdet = $request->koefesien_rekdet;

        $pagu        = str_replace(',','', $pagu_rekdet);

        $data =  [
                'uraian_rekdet' => $uraian_rekdet,
                'koefesien_rekdet' => $koefesien_rekdet,
                'satuan_rekdet' => $satuan_rekdet,
                'pagu_rekdet' => $pagu
            ];
            $update = DB::table('rekening_det')->where('id_rekdet', $id_rekdet)->update($data);
            if ($update) {
                return redirect('/rekeningdetail/'.$id_subdet)->with(['success' => 'Data Berhasil Diubah !']);
            } else {
                return Redirect::back()->with(['warning' => 'Data Gagal Diubah !']);
            }
     }



}
