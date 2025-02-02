<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Psy\Command\WhereamiCommand;

use function Laravel\Prompts\select;

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

        //rician
        $anggaran = DB::table('detail_subkegiatan')
        ->where('id_subdet', $request->detail_subkegiatan)
        ->first();

        $realisasi = DB::table('spj')
        ->where('id_subdet', $request->detail_subkegiatan)
        ->sum('nominal_spj');


        //end rincian

        if ($detail_subkegiatan) {
            $spj = DB::table('spj')
            ->leftJoin('penyedia', 'spj.id_penyedia', '=', 'penyedia.id_penyedia')
            ->select('spj.*', 'penyedia.nama')
            ->where('id_subdet', $request->detail_subkegiatan)
            ->get();

            $det_spj= DB::table('det_spj')
            ->leftJoin('rekening_det', 'det_spj.id_rekdet', '=', 'rekening_det.id_rekdet')
            ->select('det_spj.*', 'rekening_det.uraian_rekdet')
            ->orderBy('id_det')
            ->get();

            //pajak
             $pajak = DB::table('inpajak')
             ->leftJoin('pajak', 'inpajak.id_pajak', '=', 'pajak.id_pajak')
             ->select('inpajak.*', 'pajak.jenis_pajak')
             ->get();

        } else {
            $spj = [];
        }

        // $spj = DB::table('spj')
        // ->orderBy('id_spj')
        // ->get();

        //select Kode Rekening Detail

        return view('admin.spj.view', compact('sub_kegiatan', 'detail_subkegiatan', 'spj', 'modal', 'penyedia', 'anggaran', 'realisasi', 'det_spj', 'pajak'));
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
        $id = Crypt::decrypt($id_spj);

        $det_spj= DB::table('det_spj')
        ->where('id_spj', $id)
        ->count();

        $pajak= DB::table('inpajak')
        ->where('id_spj', $id)
        ->count();

        if ($det_spj or $pajak> 0) {
            return Redirect::back()->with(['warning' => 'Belanja Tidak Bisa Dihapus Karena Masih Terdapat Rincian']);
            }
         try{
        DB::table('spj')->where('id_spj', $id)->delete();
        return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
        } catch (\Exception $e) {
            return Redirect::back()->with(['warning' => 'Data Gagal Dihapus']);
        }
    }

    public function edit(Request $request){
        $id_spj = $request->id_spj;
        $spj    = DB::table('spj')
        ->where('id_spj', $id_spj)
        ->first();

        $penyedia = DB::table('penyedia')
        ->orderBy('id_penyedia')
        ->get();

        return view('admin.spj.edit', compact('id_spj', 'spj', 'penyedia'));
    }

    public function update($id_spj, Request $request)
    {
        $id_spj = Crypt::decrypt($id_spj);
        $tgl_spj = $request->tgl_spj;
        $uraian_spj = $request->uraian_spj;
        $id_penyedia = $request->id_penyedia;

        $data = [
            'tgl_spj' => $tgl_spj,
            'uraian_spj' => $uraian_spj,
            'id_penyedia' => $id_penyedia
        ];

        $update = DB::table('spj')->where('id_spj', $id_spj)->update($data);
        if ($update) {
            return Redirect::back()->with(['success' => 'Data Berhasil Di Update']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Di Update']);
        }
    }

    public function rincian(Request $request){
        $id_spj = $request->id_spj;

        $spj    = DB::table('spj')
        ->where('id_spj', $id_spj)
        ->first();

        $id_subdet = $spj->id_subdet;

        $detail = DB::table('rekening_det')
        ->where('id_subdet', $id_subdet)
        ->get();

        return view('admin.spj.rincian', compact('id_spj', 'spj', 'detail'));
    }

    public function edit_rincian(Request $request){
        $id_det = $request->id_det;

        $det_spj    = DB::table('det_spj')
        ->where('id_det', $id_det)
        ->first();

        return view('admin.spj.edit_rincian', compact('det_spj'));
    }

    public function update_rincian($id_det, Request $request){

        $id_det = Crypt::decrypt($id_det);

        $det_spj = DB::table('det_spj')
        ->where('id_det', $id_det)
        ->first();

        $id_spj = $det_spj->id_spj;
        $id_rekdet = $det_spj->id_rekdet;

        $spj = DB::table('spj')
        ->where('id_spj', $id_spj)
        ->first();

        $nominal_baru= $request->nominal_baru;
        $nominal_det = $det_spj->nominal_det;
        $nominal_spj = $spj->nominal_spj;
        $pagu = str_replace(',', '', $nominal_baru);
        $jumlah      = $nominal_spj-$nominal_det+$pagu;

        $koefesien_baru= $request->koefesien_baru;
        $koefesien_lama = $det_spj->koefesien_det;
        //validasi pagu

        $tabel = DB::table('rekening_det')
        ->where('id_rekdet', $id_rekdet)
        ->first();

        $pagu_rekdet = $tabel->pagu_rekdet;
        $koefesien_rekdet = $tabel->koefesien_rekdet;

        $realisasi_anggaran = DB::table('det_spj')
        ->where('id_rekdet', $id_rekdet)
        ->sum('nominal_det');
        $realisasi_koefesien = DB::table('det_spj')
        ->where('id_rekdet', $id_rekdet)
        ->sum('koefesien_det');

        $ra = $pagu_rekdet-$realisasi_anggaran+$nominal_det;
        $rk = $koefesien_rekdet-$realisasi_koefesien+$koefesien_lama;

        $data = [
            'nominal_spj' => $jumlah
        ];

        $data2 = [
            'nominal_det' => $pagu,
            'koefesien_det' => $koefesien_baru
        ];
        if ($pagu > $ra) {
            return Redirect::back()->with(['warning' => 'Belanja Sudah Melebihi Batas Pagu Anggaran']);
             }
         if ($koefesien_baru > $rk) {
            return Redirect::back()->with(['warning' => 'Belanja Sudah Melebihi Batas Koefesien']);
             }
         try{
        DB::table('spj')->where('id_spj', $id_spj)->update($data);
        DB::table('det_spj')->where('id_det', $id_det)->update($data2);
        return Redirect::back()->with(['success' => 'Data Berhasil Disimpan']);
        } catch (\Exception $e) {
            return Redirect::back()->with(['warning' => 'Data Gagal Disimpan']);
        }
    }


    public function getData(Request $request)
    {
            $id = $request->input('id');
            $tabel = DB::table('rekening_det')
            ->where('id_rekdet', $id)
            ->first();

            $id_rekdet = $tabel->id_rekdet;
            $pagu = $tabel->pagu_rekdet;
            $koefesien = $tabel->koefesien_rekdet;

            $realisasi_anggaran = DB::table('det_spj')
            ->where('id_rekdet', $id_rekdet)
            ->sum('nominal_det');
            $realisasi_koefesien = DB::table('det_spj')
            ->where('id_rekdet', $id_rekdet)
            ->sum('koefesien_det');

            $sisa_anggaran = $pagu - $realisasi_anggaran;
            $sisa_koefesien = $koefesien - $realisasi_koefesien;



            $data = [
                'data' => $tabel,
                'sisa_anggaran' => $sisa_anggaran,
                'sisa_k' => $sisa_koefesien
            ];

            return response()->json($data);
    }

    public function save(Request $request)
    {

        $id_det=DB::table('det_spj')
        ->latest('id_spj', 'DESC')
        ->first();

        $kodeobjek ="DSP-";

        if($id_det == null){
            $nomorid  = "000001";

        }else{
            $nomorid = substr($id_det->id_det, 4, 6) + 1;
            $nomorid = str_pad($nomorid, 6, "0", STR_PAD_LEFT);
        }
        $id=$kodeobjek.$nomorid;

        $id_spj = $request->id_spj;
        $id_rekdet = $request->id_rekdet;
        $nominal_det = $request->nominal_det;
        $koefesien_det = $request->koefesien_det;


        $pagu = str_replace(',', '', $nominal_det);

        $spj=DB::table('spj')
        ->where('id_spj', $id_spj)
        ->first();

        $nominal = $spj->nominal_spj;
        $tambah  = $nominal+$pagu;

        //validasi pagu

        $tabel = DB::table('rekening_det')
        ->where('id_rekdet', $id_rekdet)
        ->first();

        $pagu2 = $tabel->pagu_rekdet;
        $koefesien = $tabel->koefesien_rekdet;

        $realisasi_anggaran = DB::table('det_spj')
        ->where('id_rekdet', $id_rekdet)
        ->sum('nominal_det');
        $realisasi_koefesien = DB::table('det_spj')
        ->where('id_rekdet', $id_rekdet)
        ->sum('koefesien_det');

        $sisa_anggaran = $pagu2 - $realisasi_anggaran;
        $sisa_koefesien = $koefesien - $realisasi_koefesien;




        //validasi kode
        $cekkode = DB::table('det_spj')
        ->where('id_spj', '=', $id_spj)
        ->where('id_rekdet', '=', $id_rekdet)
        ->count();
         if ($cekkode > 0) {
        return Redirect::back()->with(['warning' => 'Rincian Belanja Sudah Digunakan']);
         }
         if ($pagu > $sisa_anggaran) {
            return Redirect::back()->with(['warning' => 'Belanja Sudah Melebihi Batas Pagu Anggaran']);
             }
         if ($koefesien_det > $sisa_koefesien) {
            return Redirect::back()->with(['warning' => 'Belanja Sudah Melebihi Batas Koefesien']);
             }
         try{
        $data = [
            'id_det' => $id,
            'id_spj' => $id_spj,
            'id_rekdet' => $id_rekdet,
            'nominal_det' => $pagu,
            'koefesien_det' => $koefesien_det
        ];
        $data2 = [
            'nominal_spj' => $tambah
        ];
        DB::table('det_spj')->insert($data);
        DB::table('spj')->where('id_spj', $id_spj)->update($data2);
        return Redirect::back()->with(['success' => 'Data Berhasil Disimpan']);
        } catch (\Exception $e) {
            return Redirect::back()->with(['warning' => 'Data Gagal Disimpan']);
        }
    }

    public function hapus_rincian($id_det){

        $id = Crypt::decrypt($id_det);

        $det_spj= DB::table('det_spj')
        ->where('id_det', $id)
        ->first();

        $id_spj     = $det_spj->id_spj;
        $spj= DB::table('spj')
        ->where('id_spj', $id_spj)
        ->first();

        $nominal_det = $det_spj->nominal_det;
        $nominal_spj = $spj->nominal_spj;
        $jumlah     = $nominal_spj - $nominal_det;

        $data = [
            'nominal_spj' => $jumlah
        ];
        DB::table('spj')->where('id_spj', $id_spj)->update($data);

        $delete = DB::table('det_spj')->where('id_det', $id)->delete();
        if ($delete) {
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus !']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Dihapus !']);
        }
    }

    public function pajak(Request $request){

        $id_spj = $request->id_spj;

        $pajak = DB::table('pajak')
        ->get();

        return view('admin.spj.pajak', compact( 'pajak', 'id_spj'));
    }

    public function pajakin(Request $request)
    {

        $id_inpajak=DB::table('inpajak')
        ->latest('id_inpajak', 'DESC')
        ->first();

        $kodeobjek ="PIN-";

        if($id_inpajak == null){
            $nomorid  = "000001";

        }else{
            $nomorid = substr($id_inpajak->id_inpajak, 4, 6) + 1;
            $nomorid = str_pad($nomorid, 6, "0", STR_PAD_LEFT);
        }
        $id=$kodeobjek.$nomorid;

        $pajakppn = $request->pajakppn;
        $pajakpph = $request->pajakpph;
        $id_pajak = $request->id_pajak;
        $id_spj = $request->id_spj;

        $ppn = str_replace(',', '', $pajakppn);
        $pph = str_replace(',', '', $pajakpph);

        //validasi kode
        $cekkode = DB::table('inpajak')
        ->where('id_spj', '=', $id_spj)
        ->count();
         if ($cekkode > 0) {
        return Redirect::back()->with(['warning' => 'Pajak Sudah Digunakan']);
         }
         try{
        $data = [
            'id_inpajak' => $id,
            'id_spj' => $id_spj,
            'ppn' => $ppn,
            'pph' => $pph,
            'id_pajak' => $id_pajak
        ];
        DB::table('inpajak')->insert($data);
        return Redirect::back()->with(['success' => 'Data Berhasil Disimpan']);
        } catch (\Exception $e) {
            return Redirect::back()->with(['warning' => 'Data Gagal Disimpan']);
        }
    }

    public function edit_pajak(Request $request){
        $id_inpajak = $request->id_inpajak;

        $pajak    = DB::table('inpajak')
        ->where('id_inpajak', $id_inpajak)
        ->first();

        $detail = DB::table('pajak')
        ->get();

        return view('admin.spj.edit_pajak', compact('detail', 'id_inpajak', 'pajak'));
    }

    public function hapus_pajak($id_inpajak){
        $id = Crypt::decrypt($id_inpajak);
        $delete = DB::table('inpajak')->where('id_inpajak', $id)->delete();
        if ($delete) {
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus !']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Dihapus !']);
        }
    }

    public function update_pajak($id_inpajak, Request $request){

        $id_inpajak = Crypt::decrypt($id_inpajak);

        $pajakppn = $request->pajakppn;
        $pajakpph = $request->pajakpph;
        $id_pajak = $request->id_pajak;
        $ppn = str_replace(',', '', $pajakppn);
        $pph = str_replace(',', '', $pajakpph);
        $data = [
            'id_pajak' => $id_pajak,
            'ppn'      => $ppn,
            'pph'      => $pph
        ];
        $update = DB::table('inpajak')->where('id_inpajak', $id_inpajak)->update($data);
        if ($update) {
            return Redirect::back()->with(['success' => 'Data Berhasil Diubah !']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Diubah !']);
        }
    }

    public function kirim($id_spj){
        $id = Crypt::decrypt($id_spj);

        $spj= DB::table('spj')
        ->where('id_spj', $id)
        ->first();
        $nominal = $spj->nominal_spj;

        if ($nominal < 1) {
            return Redirect::back()->with(['warning' => 'Belanja Tidak Bisa Dikirim Karena Nominal Rp 0']);
            }
         try{

        $data=[
            'status_spj' => '1'
        ];
        DB::table('spj')->where('id_spj', $id)->update($data);
        return Redirect::back()->with(['success' => 'Data Berhasil Dikirim']);
        } catch (\Exception $e) {
            return Redirect::back()->with(['warning' => 'Data Gagal Dikirim']);
        }
    }

    public function batal($id_spj){
        $id = Crypt::decrypt($id_spj);

        $data=[
            'status_spj' => '0'
        ];
        $update=DB::table('spj')->where('id_spj', $id)->update($data);
        if ($update) {
            return Redirect::back()->with(['success' => 'Data Berhasil Dibatalkan !']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Dibatalkan !']);
        }
    }



}
