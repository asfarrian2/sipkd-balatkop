<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class SubkegiatanController extends Controller
{
    public function view()
    {
        $sub_kegiatan = DB::table('sub_kegiatan')
        ->Join('kegiatan', 'sub_kegiatan.kode_kegiatan', '=', 'kegiatan.kode_kegiatan')
        ->Join('program', 'kegiatan.kode_program', '=', 'program.kode_program')
        ->Join('pejabat_pelaksana', 'sub_kegiatan.id_pejabat', '=', 'pejabat_pelaksana.id_pejabat')
        ->select('sub_kegiatan.*', 'kegiatan.*', 'program.*', 'pejabat_pelaksana.*')
        ->orderBy('kegiatan.kode_kegiatan')
        ->get();

        return view('admin.sub_kegiatan.view', compact('sub_kegiatan'));
    }

    public function create()
    {
        $program =DB::table('kegiatan')
        ->leftJoin('program', 'kegiatan.kode_program', '=', 'program.kode_program')
        ->select('kegiatan.*', 'program.*')
        ->orderBy('kegiatan.kode_program')
        ->get();

        $pptk =DB::table('pejabat_pelaksana')
        ->where('pelaksana_pejabat','PPTK')
        ->get();
        return view('admin.sub_kegiatan.create', compact('program', 'pptk'));
    }

    public function store(Request $request)
    {
        $kode_kegiatan     = $request->kode_kegiatan;
        $id_pejabat        = $request->id_pejabat;
        $kode_sub_kegiatan = $request->kode_sub_kegiatan;
        $nama_sub_kegiatan = $request->nama_sub_kegiatan;
        $pagu_sub_kegiatan = $request->pagu_sub_kegiatan;
        $pagu              = str_replace(',','', $pagu_sub_kegiatan);

        $cekkode = DB::table('sub_kegiatan')
        ->where('kode_sub_kegiatan', '=', $kode_sub_kegiatan)
        ->count();
         if ($cekkode > 0) {
        return Redirect::back()->with(['warning' => 'Kode Sub Kegiatan Sudah Digunakan']);
         }
        try {
            $data = [
                'kode_kegiatan' => $kode_kegiatan,
                'id_pejabat' => $id_pejabat,
                'kode_sub_kegiatan' => $kode_sub_kegiatan,
                'nama_sub_kegiatan' => $nama_sub_kegiatan,
                'pagu_sub_kegiatan' => $pagu
            ];
            DB::table('sub_kegiatan')->insert($data);
            return redirect('/sub_kegiatan/view')->with(['success' => 'Data Berhasil Disimpan !']);
            } catch (\Exception $e) {
                return Redirect::back()->with(['warning' => 'Data Gagal Disimpan !']);
            }

    }

    public function edit($kode_sub_kegiatan)
    {
        $kegiatan = DB::table('kegiatan')
        ->leftJoin('program', 'kegiatan.kode_program', '=', 'program.kode_program')
        ->orderBy('kegiatan.kode_program')
        ->get();

        $pptk =DB::table('pejabat_pelaksana')
        ->where('pelaksana_pejabat','PPTK')
        ->get();

        $sub_kegiatan = DB::table('sub_kegiatan')
        ->where('kode_sub_kegiatan', $kode_sub_kegiatan)
        ->first();

        return view('admin.sub_kegiatan.edit', compact('sub_kegiatan', 'kegiatan', 'pptk'));
    }


    public function update(Request $request)
    {
        $sub_kegiatan_baru = $request->sub_kegiatan_baru;
        $kode_sub_kegiatan = $request->kode_sub_kegiatan;
        $kode_kegiatan     = $request->kode_kegiatan;
        $nama_sub_kegiatan = $request->nama_sub_kegiatan;
        $pagu_sub_kegiatan = $request->pagu_sub_kegiatan;
        $id_pejabat        = $request->id_pejabat;
        $pagu              = str_replace(',','', $pagu_sub_kegiatan);


        $cekkode = DB::table('sub_kegiatan')
        ->where('kode_sub_kegiatan', $sub_kegiatan_baru)
        ->where('kode_sub_kegiatan', '!=', $kode_sub_kegiatan)
        ->count();
         if ($cekkode > 0) {
        return Redirect::back()->with(['warning' => 'Kode kegiatan Sudah Digunakan']);
         }
        try {
            $data =  [
                'kode_sub_kegiatan' => $sub_kegiatan_baru,
                'kode_kegiatan' => $kode_kegiatan,
                'nama_sub_kegiatan' => $nama_sub_kegiatan,
                'pagu_sub_kegiatan' => $pagu,
                'id_pejabat' => $id_pejabat
            ];
            $update = DB::table('sub_kegiatan')->where('kode_sub_kegiatan', $kode_sub_kegiatan)->update($data);
            return redirect('/sub_kegiatan/view')->with(['success' => 'Data Berhasil Diiubah !']);
            } catch (\Exception $e) {
            return Redirect::back()->with(['warning' => 'Data Gagal Diubah !']);
            }
     }

     public function hapus($kode_sub_kegiatan)
     {
        $delete = DB::table('sub_kegiatan')->where('kode_sub_kegiatan', $kode_sub_kegiatan)->delete();
        if ($delete) {
            return redirect('/sub_kegiatan/view')->with(['success' => 'Data Berhasil Dihapus !']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Dihapus !']);
        }
     }

     public function kode_rekening($kode_sub_kegiatan)
     {
        $kegiatan = DB::table('kegiatan')
        ->leftJoin('program', 'kegiatan.kode_program', '=', 'program.kode_program')
        ->orderBy('kegiatan.kode_program')
        ->get();

        $pptk =DB::table('pejabat_pelaksana')
        ->where('pelaksana_pejabat','PPTK')
        ->get();

        $sub_kegiatan = DB::table('sub_kegiatan')
        ->Join('kegiatan', 'sub_kegiatan.kode_kegiatan', '=', 'kegiatan.kode_kegiatan')
        ->Join('program', 'kegiatan.kode_program', '=', 'program.kode_program')
        ->Join('pejabat_pelaksana', 'sub_kegiatan.id_pejabat', '=', 'pejabat_pelaksana.id_pejabat')
        ->select('sub_kegiatan.*', 'kegiatan.*', 'program.*', 'pejabat_pelaksana.*')
        ->where('kode_sub_kegiatan', $kode_sub_kegiatan)
        ->first();

        $data_subdet = DB::table('detail_subkegiatan')
        ->Join('sub_kegiatan', 'detail_subkegiatan.kode_sub_kegiatan', '=', 'sub_kegiatan.kode_sub_kegiatan')
        ->Join('kode_rekening', 'detail_subkegiatan.kode_rekening', '=', 'kode_rekening.kode_rekening')
        ->select('detail_subkegiatan.*', 'sub_kegiatan.*', 'kode_rekening.*')
        ->orderBy('detail_subkegiatan.kode_rekening')
        ->get();

         return view('admin.sub_kegiatan.krekening', compact('sub_kegiatan', 'pptk', 'kegiatan', 'data_subdet'));
     }


}
