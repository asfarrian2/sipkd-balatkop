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

}
