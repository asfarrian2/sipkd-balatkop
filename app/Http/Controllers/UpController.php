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
        $up = DB::table('transaksi')
            ->orderBy('transaksi.id_transaksi')
            ->get();

            return view('admin.up.view', compact('up'));
    }

    public function create()
    {
        return view('admin.up.create');
    }

    public function store(Request $request)
    {

        $id_transaksi=DB::table('transaksi')
        ->latest('id_transaksi', 'DESC')
        ->first();

        $kodeobjek ="BKU-";

        if($id_transaksi == null){
            $nomorurut = "0001";
        }else{
            $nomorurut = substr($id_transaksi->id_transaksi, 4, 4) + 1;
            $nomorurut = str_pad($nomorurut, 4, "0", STR_PAD_LEFT);
        }
        $id=$kodeobjek.$nomorurut;

        $id_transaksi = $request->id_transaksi;
        $tanggal = $request->tanggal;
        $uraian = $request->uraian;
        $nominal = $request->nominal;

        $pagu        = str_replace(',','', $nominal);

        $data = [
            'id_transaksi' => $id,
            'tgl' => $tanggal,
            'uraian' => $uraian,
            'nominal' => $pagu,
            'jenis' => 'UP',
            'tipe' => 'masuk',
            'metode' => 'non tunai',
            'status' => '0'
        ];
        $simpan = DB::table('transaksi')->insert($data);
        if ($simpan) {
            return Redirect('/up/view')->with(['success' => 'Data Berhasil Disimpan']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Disimpan']);
        }
    }

    public function edit($id_transaksi)
    {
        $up = DB::table('transaksi')
        ->where('id_transaksi', $id_transaksi)
        ->first();
        return view('admin.up.edit', compact('up'));

    }

    public function update(Request $request)
    {
        $id_transaksi = $request->id_transaksi;
        $tgl = $request->tgl;
        $nominal = $request->nominal;

        $pagu = str_replace(',', '', $nominal);

        $data = [
                    'tgl'       => $tgl,
                    'nominal'   => $pagu
                ];

        $update=DB::table('transaksi')->where('id_transaksi', $id_transaksi)->update($data);
        if ($update){
            return redirect('/up/view')->with(['success' => 'Data Berhasil Diubah !']);
        }else{
            return Redirect::back()->with(['warning' => 'Data Gagal Diubah !']);
            }

        }

        public function hapus($id_transaksi){

            $delete = DB::table('transaksi')->where('id_transaksi', $id_transaksi)->delete();
            if ($delete) {
                return redirect('/up/view')->with(['success' => 'Data Berhasil Dihapus !']);
            } else {
                return Redirect::back()->with(['warning' => 'Data Gagal Dihapus !']);
            }
        }

        public function lock($id_transaksi){

            $transaksi = DB::table('transaksi')
            ->where('id_transaksi', $id_transaksi)
            ->first();

            $tgl_bku = $transaksi->tgl;

            $data = [
                'status' => '1',
                'tgl_bku' => $tgl_bku
            ];

            $update=DB::table('transaksi')->where('id_transaksi', $id_transaksi)->update($data);
            if ($update){
                return redirect('/up/view')->with(['success' => 'Data Berhasil Diverifikasi !']);
            }else{
                return Redirect::back()->with(['warning' => 'Data Gagal Diferivikasi !']);
                }

        }


}
