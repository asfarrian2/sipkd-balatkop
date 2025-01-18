<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

use function Laravel\Prompts\select;

class KegiatanController extends Controller
{
    public function view()
    {
        $program = DB::table('program')

        ->get();

        $kegiatan = DB::table('kegiatan')
        ->leftJoin('program', 'kegiatan.kode_program', '=', 'program.kode_program')
        ->orderBy('kegiatan.kode_program')
        ->get();
        return view('admin.kegiatan.view', compact('kegiatan', 'program'));
    }

    public function create()
    {
        $program =DB::table('program')
        ->orderBy('kode_program')
        ->get();
        return view('admin.kegiatan.create', compact('program'));
    }

    public function store(Request $request)
    {
        $kode_program = $request->kode_program;
        $kode_kegiatan = $request->kode_kegiatan;
        $nama_kegiatan = $request->nama_kegiatan;
        $pagu_kegiatan = $request->pagu_kegiatan;
        $pagu         = str_replace(',','', $pagu_kegiatan);

        $cekkode = DB::table('kegiatan')
        ->where('kode_kegiatan', '=', $kode_kegiatan)
        ->count();
         if ($cekkode > 0) {
        return Redirect::back()->with(['warning' => 'Kode Kegiatan Sudah Digunakan']);
         }
        try {
            $data = [
                'kode_program' => $kode_program,
                'kode_kegiatan' => $kode_kegiatan,
                'nama_kegiatan' => $nama_kegiatan,
                'pagu_kegiatan' => $pagu
            ];
            DB::table('kegiatan')->insert($data);
            return redirect('/kegiatan/view')->with(['success' => 'Data Berhasil Disimpan !']);
            } catch (\Exception $e) {
            return Redirect::back()->with(['warning' => 'Data Gagal Disimpan !']);
            }

    }

}
