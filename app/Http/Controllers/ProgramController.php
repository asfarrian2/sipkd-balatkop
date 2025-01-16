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

        $cekkode = DB::table('program')
        ->where('kode_program', '!=', $kode_program)
        ->count();
         if ($cekkode > 0) {
        return Redirect::back()->with(['warning' => 'Kode Program Sudah Digunakan']);
         }
        try {
            $data = [
                'kode_program' => $kode_program,
                'nama_program' => $nama_program,
                'pagu_program' => $pagu_program
            ];
            DB::table('program')->insert($data);
            return redirect('/program/view')->with(['success' => 'Data Berhasil Disimpan !']);
            } catch (\Exception $e) {
            return Redirect::back()->with(['warning' => 'Data Gagal Disimpan !']);
            }


    }

}
