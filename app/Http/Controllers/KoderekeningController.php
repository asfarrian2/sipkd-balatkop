<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class KoderekeningController extends Controller
{
    public function koderekening_view()
    {
        $koderekening = DB::table('kode_rekening')
        ->orderBy('kode_rekening')
        ->get();

        return view('admin.kode_rekening.view', compact('koderekening'));
    }

    public function koderekening_create()
    {
        return view('admin.kode_rekening.create');
    }

    public function store(Request $request)
    {
        $kode_rekening = $request->kode_rekening;
        $nama_rekening = $request->nama_rekening;
        $keterangan_rekening = $request->keterangan_rekening;

        $cekkode = DB::table('kode_rekening')
        ->where('kode_rekening', '=', $kode_rekening)
        ->count();
         if ($cekkode > 0) {
        return Redirect::back()->with(['warning' => 'Kode Rekening Sudah Digunakan']);
         }
        try {
            $data = [
                'kode_rekening' => $kode_rekening,
                'nama_rekening' => $nama_rekening,
                'keterangan_rekening' => $keterangan_rekening
            ];
            DB::table('kode_rekening')->insert($data);
            return redirect('koderekening_view')->with(['success' => 'Data Berhasil Disimpan !']);
            } catch (\Exception $e) {
            return Redirect::back()->with(['warning' => 'Data Gagal Disimpan !']);
            }


    }

    public function edit($kode_rekening)
    {
        $tb_kode_rekening = DB::table('kode_rekening')->where('kode_rekening', $kode_rekening)->first();
        return view('admin.kode_rekening.edit', compact('tb_kode_rekening'));
    }

    public function update(Request $request)
    {
        $koderekening_baru = $request->koderekening_baru;
        $kode_rekening = $request->koderekening;
        $nama_rekening = $request->nama_rekening;
        $keterangan_rekening = $request->keterangan_rekening;

        $cekkode = DB::table('kode_rekening')
        ->where('kode_rekening', $koderekening_baru)
        ->where('kode_rekening', '!=', $kode_rekening)
        ->count();
         if ($cekkode > 0) {
        return Redirect::back()->with(['warning' => 'Kode Rekening Sudah Digunakan']);
         }
        try {
            $data =  [
                'kode_rekening' => $koderekening_baru,
                'nama_rekening' => $nama_rekening,
                'keterangan_rekening' => $keterangan_rekening
            ];
            $update = DB::table('kode_rekening')->where('kode_rekening', $kode_rekening)->update($data);
            return redirect('koderekening_view')->with(['success' => 'Data Berhasil Diiubah !']);
            } catch (\Exception $e) {
            return Redirect::back()->with(['warning' => 'Data Gagal Diubah !']);
            }
     }

     public function hapus($kode_rekening)
     {
        $delete = DB::table('kode_rekening')->where('kode_rekening', $kode_rekening)->delete();
        if ($delete) {
            return redirect('koderekening_view')->with(['success' => 'Data Berhasil Dihapus !']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Dihapus !']);
        }
     }

}
