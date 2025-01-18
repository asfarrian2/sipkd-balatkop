<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class ProgramController extends Controller
{
    public function view()
    {
        $program = DB::table('program')
        ->orderBy('kode_program')
        ->get();

        return view('admin.program.view', compact('program'));
    }

    public function create()
    {
        return view('admin.program.create');
    }

    public function store(Request $request)
    {
        $kode_program = $request->kode_program;
        $nama_program = $request->nama_program;
        $pagu_program = $request->pagu_program;
        $pagu         = str_replace(',','', $pagu_program);

        $cekkode = DB::table('program')
        ->where('kode_program', '=', $kode_program)
        ->count();
         if ($cekkode > 0) {
        return Redirect::back()->with(['warning' => 'Kode Program Sudah Digunakan']);
         }
        try {
            $data = [
                'kode_program' => $kode_program,
                'nama_program' => $nama_program,
                'pagu_program' => $pagu
            ];
            DB::table('program')->insert($data);
            return redirect('/program/view')->with(['success' => 'Data Berhasil Disimpan !']);
            } catch (\Exception $e) {
            return Redirect::back()->with(['warning' => 'Data Gagal Disimpan !']);
            }

    }

    public function edit($kode_program)
    {
        $program = DB::table('program')->where('kode_program', $kode_program)->first();
        return view('admin.program.edit', compact('program'));
    }

    public function update(Request $request)
    {
        $program_baru = $request->program_baru;
        $kode_program = $request->kode_program;
        $nama_program = $request->nama_program;
        $pagu_program = $request->pagu_program;
        $pagu         = str_replace(',','', $pagu_program);


        $cekkode = DB::table('program')
        ->where('kode_program', $program_baru)
        ->where('kode_program', '!=', $kode_program)
        ->count();
         if ($cekkode > 0) {
        return Redirect::back()->with(['warning' => 'Kode Program Sudah Digunakan']);
         }
        try {
            $data =  [
                'kode_program' => $program_baru,
                'nama_program' => $nama_program,
                'pagu_program' => $pagu
            ];
            $update = DB::table('program')->where('kode_program', $kode_program)->update($data);
            return redirect('/program/view')->with(['success' => 'Data Berhasil Diiubah !']);
            } catch (\Exception $e) {
            return Redirect::back()->with(['warning' => 'Data Gagal Diubah !']);
            }
     }

     public function hapus($kode_program)
     {
        $delete = DB::table('program')->where('kode_program', $kode_program)->delete();
        if ($delete) {
            return redirect('/program/view')->with(['success' => 'Data Berhasil Dihapus !']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Dihapus !']);
        }
     }


}
