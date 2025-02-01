@extends('layouts.master')

@section('content')

<!-- Begin Pesan Peringatan -->
<div class="">
    @csrf
    @php
    $messagewarning = Session::get('warning');
    $messagesuccess = Session::get('success');
@endphp
@if (Session::get('warning'))
<div class="x_content bs-example-popovers">
    <div class="alert alert-danger alert-dismissible " role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <i class="fa fa-warning"></i> &nbsp;
      {{ $messagewarning }}
      </div>
</div>
<br>
@endif

@if (Session::get('success'))
<div class="x_content bs-example-popovers">
    <div class="alert alert-success alert-dismissible " role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <i class="fa fa-check-circle"></i> &nbsp;
      {{ $messagesuccess }}
      </div>
</div>
<br>
@endif

<!-- End Pesan Peringatan -->

<!-- Begin Judul Halaman -->
<div class="row">
<div class="col-md-12 col-sm-12 ">
    <div class="x_panel">
        <div class="x_title">
            <h2>SPJ</h2>
            <div class="clearfix"></div>
        </div>
        <div class="col-md-4">
          <div id="" class="pull-left" style="background: #fff;    padding: 5px 10px; border: 1px solid #ccc">
            <i class="fa fa-home"></i>
            <span><a href="/dashboard" style="color: #0a803f">Home</a> /
                <i class="fa fa-shopping-cart"></i> Surat Pertanggung Jawaban</span> <b class="caret"></b>
          </div>
        </div>
        <br>
		<br>
        <div class="x_content">
        <br>
			<form action="/spj/view" method="GET" data-parsley-validate class="form-horizontal form-label-left">
                @csrf
                <div class="item form-group">
					<label class="col-form-label col-md-1 col-sm-3 label-align" for="first-name">Sub Kegiatan
					</label>
					<div class="col-md-10 col-sm-6 ">
                    <select id="selectSub" name="sub_keg" class="form-control" required="required">
                        <option value="">Pilih Sub Kegiatan</option>
                         @foreach ($sub_kegiatan as $d)
                        <option
                        {{ Request('sub_keg') == $d->kode_sub_kegiatan ? 'selected' : '' }}
                        value="{{ $d->kode_sub_kegiatan }}">{{ $d->kode_sub_kegiatan }} {{ $d->nama_sub_kegiatan}}</option>
                          @endforeach
                    </select>
					</div>
				</div>
                <div class="item form-group">
					<label class="col-form-label col-md-1 col-sm-3 label-align" for="first-name">Kode Rekening
					</label>
					<div class="col-md-10 col-sm-6 ">
                    <select id="detail_subkegiatan" name="detail_subkegiatan"class="form-control" required="required">
                        <option value="">Pilih Kode Rekening</option>
                        @foreach ($detail_subkegiatan as $d)
                        <option {{ Request('detail_subkegiatan') == $d->id_subdet ? 'selected' : '' }} value="{{ $d->id_subdet }}">{{ $d->kode_rekening }} {{ $d->nama_rekening }}</option>
                        @endforeach
                    </select>
					</div>
				</div>
				    <div class="item form-group">
				    	<div class="col-md-1 col-sm-1 offset-md-1">
				    		<button type="submit" class="btn btn-dark btn-md">Cari</button>
				    	</div>
				    </div>
        	        </form>
        		</div>
            </div>
<!-- End Judul Halaman -->

<!-- Begin Tabel -->
<div class="row">
<div class="col-md-12 col-sm-12 ">
<div class="x_panel">
        <div class="x_title">
        @if(count($detail_subkegiatan) == 0)
        @else
        <a href="#" class="btn btn-primary btn-md tambah"><i class="fa fa-plus"></i> Buat SPJ</a>
        @endif
            <div class="clearfix"></div>
        </div>
            <div class="row">
                <div class="col-sm-12">
                  <div class="card-box table-responsive">
                      <table id="datatable" class="table table-striped table-bordered" width="100%">
                        <thead>
                            <tr>
                            <th class="text-center">No.</th>
                            <th class="text-center">Nomor</th>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Uraian</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-center">Penerima</th>
                            <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($spj as $d)
                            <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $d->no_spj }}</td>
                            <td>{{ date('d-m-Y', strtotime($d->tgl_spj)) }}</td>
                            <td>{{ $d->uraian_spj }}
                                <ul>
                                @foreach($det_spj as $s)
                                @if($d->id_spj == $s->id_spj)
                                <li>
                                {{ $s->uraian_rekdet}} <br><b>Rp <?php echo number_format($s->nominal_det ,2,',','.')?></b>
                                @csrf
                                @if ($d->status_spj == 0)
                                <a class="editr" href="#" title="Edit Data" id_det="{{$s->id_det}}"><i class="fa fa-pencil text-succsess btn btn-warning btn-sm" ></i></a>
                                <a class="hapus2" href="#" data-id="{{ Crypt::encrypt($s->id_det) }}" title="Hapus Data"><i class="hapus fa fa-trash text-succsess btn btn-danger btn-sm" ></i></a>
                                </li>
                                @endif
                                @endif
                                 @endforeach
                                </ul>
                            </td>
                            <td><b>Rp <?php echo number_format($d->nominal_spj ,2,',','.')?></b>
                            <ul>
                                @foreach($pajak as $p)
                                @if($d->id_spj == $p->id_spj)
                                <li>
                                PPN: Rp<?php echo number_format($p->ppn ,2,',','.')?><br>
                                {{ $p->jenis_pajak}}:Rp<?php echo number_format($p->pph ,2,',','.')?>
                                @php
                                $diterima = 0;
                                $diterima = $d->nominal_spj - ($p->ppn + $p->pph);
                                @endphp
                                <b>Diterima: Rp<?php echo number_format($diterima ,2,',','.')?></b>
                                @csrf
                                @if ($d->status_spj == 0)
                                <a class="edit3" href="#" title="Edit Data" id_inpajak="{{$p->id_inpajak}}"><i class="fa fa-pencil text-succsess btn btn-warning btn-sm" ></i></a>
                                <a class="hapus3" href="#" data-id="{{ Crypt::encrypt($p->id_inpajak) }}" title="Hapus Data"><i class="hapus fa fa-trash text-succsess btn btn-danger btn-sm" ></i></a>
                                </li>
                                @endif
                                @endif
                                 @endforeach
                                </ul>
                            </td>
                            <td>{{ $d->nama }}</td>
                        @csrf
                            <td>
                            @if ($d->status_spj == 0)
                            <a class="rincian" href="#" title="Buat Rincian" id_spj="{{$d->id_spj}}"><i class="fa fa-plus text-succsess btn btn-primary btn-sm" ></i></a>
                            <a class="pajak" href="#" title="Tambah Pajak" id_spj="{{$d->id_spj}}"><i class="fa fa-money text-succsess btn btn-info btn-sm" ></i></a>
                            <a class="edit" href="#" title="Edit Data" id_spj="{{$d->id_spj}}"><i class="fa fa-pencil text-succsess btn btn-warning btn-sm" ></i></a>
                            <a class="hapus" href="#" data-id="{{ Crypt::encrypt($d->id_spj) }}" title="Hapus Data"><i class="hapus fa fa-trash text-succsess btn btn-danger btn-sm" ></i></a>
                            <a class="kirim" href="#" data-id="{{ Crypt::encrypt($d->id_spj) }}" title="Kirim Data"><i class="fa fa-send text-succsess btn btn-success btn-sm" ></i></a>
                            @elseif ($d->status_spj == 1)
                            <a class="batal" href="#"  data-id="{{ Crypt::encrypt($d->id_spj) }}" title="Batalkan"><i class="fa fa-ban text-succsess btn btn-danger btn-sm" ></i></a>
                            @else
                            <a href="#" title="Terverifikasi"><i class="fa fa-lock text-succsess btn btn-dark btn-sm" ></i></a>
                            @endif
                            </td>
                            </tr>
                            @empty
                                {{-- jika data tidak ada, tampilkan pesan data tidak tersedia --}}
                            <tr>
                                <td colspan="7">
                                    <div class="d-flex justify-content-center align-items-center">
                                       <p> <i class="fa fa-exclamation"></i> Tidak ada data tersedia.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                      </tbody>
                      <trfood>
                        <tr>
                        @if(count($detail_subkegiatan) == 0)
                        @else
                            <th colspan="4" style="text-align: right;">Jumlah Anggaran</th>
                            <th colspan="4">Rp <?php echo number_format($anggaran->pagu_subdet ,2,',','.')?></th>
                        @endif
                        </tr>
                        <tr>
                        @if(count($detail_subkegiatan) == 0)
                        @else
                            <th colspan="4" style="text-align: right;">Jumlah Realisasi s/d Ini</th>
                            <th colspan="4">Rp <?php echo number_format($realisasi ,2,',','.')?></th>
                        @endif
                        </tr>
                        @if(count($detail_subkegiatan) == 0)
                        @else
                        @php
                        $sisa_anggaran = $anggaran->pagu_subdet - $realisasi
                        @endphp
                        <tr>
                            <th colspan="4" style="text-align: right;">Sisa Anggaran</th>
                            <th colspan="4">Rp <?php echo number_format($sisa_anggaran ,2,',','.')?></th>
                        </tr>
                        @endif
                      </trfood>
                    </table>
                  </div>
                </div>
              </div>
            </div>
<!-- End Begin Tabel -->
<div class="modal modal-blur fade" id="modal-inputobjek" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Buat SPJ</h5>
                <div class="clearfix"></div>
                <button type="button" class="fa fa-close close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="/spj/store" method="POST" id="frmCabang">
                            @csrf
                                <input hidden type="text" id="" value="{{Request('detail_subkegiatan')}}" class="form-control"  name="id_subdet">
                                <input hidden type="text" id="" value="{{Request('sub_keg')}}" class="form-control"  name="kode_sub_kegiatan">
                                @if(count($detail_subkegiatan) == 0)
                                @else
                                <input hidden type="text" id="" value="{{ $modal->kode_kegiatan}}" class="form-control"  name="kode_kegiatan">
                                <input hidden type="text" id="" value="{{ $modal->kode_program}}" class="form-control"  name="kode_program">
                                @endif
                    <div class="row">
                        <div class="col-12">
                            <div class="input-icon mb-3 col-md-6 col-sm-6">
                                <span>Tanggal</span>
                                <input type="date" value="" name="tgl_spj" id="tgl_spj" class="form-control" placeholder="" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="input-icon mb-3 col-md-12 col-sm-6">
                                <span>Uraian</span>
                                <textarea name="uraian_spj" id="uraian_spj" class="form-control" placeholder="" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="input-icon mb-3 col-md-12 col-sm-6">
                                <span>Penerima</span>
                                <select name="id_penyedia" id="id_penyedia" class="form-control" required="required">
                                <option value="">Pilih Penerima</option>
                                @foreach ($penyedia as $d)
                                <option value="{{ $d->id_penyedia }}"> {{$d->nama }} </option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="form-group">
                                <button class="btn btn-success w-100">
                                    <i class="fa fa-save"></i> Simpan
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- begin modal updte SPJ -->
<div class="modal modal-blur fade" id="modal-editobjek" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit SPJ</h5>
                <button type="button" class="fa fa-close close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="loadeditform">

            </div>
        </div>
    </div>
</div>
<!-- end modal updte SPJ -->

<!-- begin modal Rincian SPJ -->
<div class="modal modal-blur fade" id="modal-rincian" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Rincian</h5>
                <button type="button" class="fa fa-close close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="loadtambahrincian">

            </div>
        </div>
    </div>
</div>
<!-- end modal Rincian SPJ -->

<!-- begin modal Edit Rincian SPJ -->
<div class="modal modal-blur fade" id="modal-edit-rincian" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Rincian</h5>
                <button type="button" class="fa fa-close close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="loadeditrincian">

            </div>
        </div>
    </div>
</div>
<!-- end modal Edit Rincian SPJ -->

<!-- begin modal Tambah Pajak -->
<div class="modal modal-blur fade" id="modal-pajak" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Pajak</h5>
                <button type="button" class="fa fa-close close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="loadtambahpajak">

            </div>
        </div>
    </div>
</div>
<!-- end modal Pajak SPJ -->

<!-- begin modal Tambah Pajak -->
<div class="modal modal-blur fade" id="modal-edit-pajak" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Pajak</h5>
                <button type="button" class="fa fa-close close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="loadeditpajak">

            </div>
        </div>
    </div>
</div>
<!-- end modal Pajak SPJ -->


</div>
</div>
</div>
</div>
</div>

@endsection
@push('myscript')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="/gentella/vendors/uang/jquery.mask.min.js"></script>


<script>
    $('.hapus').click(function(){
        var id_spj = $(this).attr('data-id');
    Swal.fire({
      title: "Apakah Anda Yakin Data Ini Ingin Di Hapus ?",
      text: "Jika Ya Maka Data Akan Terhapus Permanen",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Ya, Hapus Saja!"
    }).then((result) => {
      if (result.isConfirmed) {
        window.location = "/spj/"+id_spj+"/hapus"
        Swal.fire({
          title: "Data Berhasil Dihapus !",
          icon: "success"
        });
      }
    });
    });
    $('.batal').click(function(){
        var id_spj = $(this).attr('data-id');
    Swal.fire({
      title: "Apakah Anda Yakin Data Ini Ingin Dibatalkan ?",
      text: "Jika Ya Maka Data Akan Dikembalikan dan Bisa Dilakukan Pengeditan Ulang",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Ya, Batalkan!"
    }).then((result) => {
      if (result.isConfirmed) {
        window.location = "/spj/"+id_spj+"/batal"
        Swal.fire({
          title: "Data Berhasil DIbatalkan !",
          icon: "success"
        });
      }
    });
    });
    $('.kirim').click(function(){
        var id_spj = $(this).attr('data-id');
    Swal.fire({
      title: "Apakah Anda Yakin Data Ini Ingin Dikirim ?",
      text: "Jika Ya Maka Data Akan Dikirmkan untuk proses verifikasi oleh BPP",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Ya, Kirimkan!"
    }).then((result) => {
      if (result.isConfirmed) {
        window.location = "/spj/"+id_spj+"/kirim"
        Swal.fire({
          title: "Data Berhasil Dikirim !",
          icon: "success"
        });
      }
    });
    });
    </script>

<script>
    $('.hapus2').click(function(){
        var id_det = $(this).attr('data-id');
    Swal.fire({
      title: "Apakah Anda Yakin Data Ini Ingin Di Hapus ?",
      text: "Jika Ya Maka Data Akan Terhapus Permanen",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Ya, Hapus Saja!"
    }).then((result) => {
      if (result.isConfirmed) {
        window.location = "/spj/rincian/"+id_det+"/hapus"
        Swal.fire({
          title: "Data Berhasil Dihapus !",
          icon: "success"
        });
      }
    });
    });
    </script>

<script>
    $('.hapus3').click(function(){
        var id_inpajak = $(this).attr('data-id');
    Swal.fire({
      title: "Apakah Anda Yakin Data Ini Ingin Di Hapus ?",
      text: "Jika Ya Maka Data Akan Terhapus Permanen",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Ya, Hapus Saja!"
    }).then((result) => {
      if (result.isConfirmed) {
        window.location = "/spj/pajak/"+id_inpajak+"/hapus"
        Swal.fire({
          title: "Data Berhasil Dihapus !",
          icon: "success"
        });
      }
    });
    });
    </script>


<script>
    $(document).ready(function(){
        $("#selectSub").on('change', function(){
            var kode_sub_kegiatan = $(this).val();
           //console.log(id_wajibpajak);
           if (kode_sub_kegiatan) {
            $.ajax({
                url: '/filtersub/'+kode_sub_kegiatan,
                type: 'GET',
                data: {
                    '_token': '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function (data){
                    //console.log(data);
                     if (data) {
                        $("#detail_subkegiatan").empty();
                        $('#detail_subkegiatan').append('<option value=""> Pilih Kode Rekening </option>');
                        $.each(data, function(key, detail_subkegiatan){
                            $('select[name="detail_subkegiatan"]').append(
                                '<Option value="'+detail_subkegiatan.id_subdet+'">'+detail_subkegiatan.kode_rekening+' '+detail_subkegiatan.nama_rekening+'</Option>'
                            )
                        });
                     }else{
                        $("#detail_subkegiatan").empty();
                     }
                }
            });
           } else {
            $("#detail_subkegiatan").empty();
           }
        });
    });

    </script>


    <script>

        $(".tambah").click(function() {
           $("#modal-inputobjek").modal("show");
       });


       var span = document.getElementsByClassName("close")[0];
    </script>

<!-- Button Edit SPJ -->
<script>
$('.edit').click(function(){
    var id_spj = $(this).attr('id_spj');
    $.ajax({
                    type: 'POST',
                    url: '/spj/edit',
                    cache: false,
                    data: {
                        _token: "{{ csrf_token() }}",
                        id_spj: id_spj
                    },
                    success: function(respond) {
                        $("#loadeditform").html(respond);
                    }
                });
     $("#modal-editobjek").modal("show");

});
var span = document.getElementsByClassName("close")[0];
</script>
<!-- END Button Edit SPJ -->

<!-- Button Tambah Rincian -->
<script>
$('.rincian').click(function(){
    var id_spj = $(this).attr('id_spj');
    $.ajax({
                    type: 'POST',
                    url: '/spj/rincian',
                    cache: false,
                    data: {
                        _token: "{{ csrf_token() }}",
                        id_spj: id_spj
                    },
                    success: function(respond) {
                        $("#loadtambahrincian").html(respond);
                        // Format input rupiah
                $("#nominalduit").mask("#,##0", { reverse: true });
                    }
                });
     $("#modal-rincian").modal("show");
    });
var span = document.getElementsByClassName("close")[0];
</script>
<!-- END Button Tambah Rincian -->

<!-- Button Edit Rincian -->
<script>
$('.editr').click(function(){
    var id_det = $(this).attr('id_det');
    $.ajax({
                    type: 'POST',
                    url: '/spj/edit/rincian',
                    cache: false,
                    data: {
                        _token: "{{ csrf_token() }}",
                        id_det: id_det
                    },
                    success: function(respond) {
                        $("#loadeditrincian").html(respond);
                         // Format input rupiah
                        $("#nominalbaru").mask("#,##0", { reverse: true });
                    }
                });
     $("#modal-edit-rincian").modal("show");

});
var span = document.getElementsByClassName("close")[0];
</script>
<!-- END Button Edit Rincian -->

<!-- Button Tambah Pajak -->
<script>
$('.pajak').click(function(){
    var id_spj = $(this).attr('id_spj');
    $.ajax({
                    type: 'POST',
                    url: '/spj/pajak',
                    cache: false,
                    data: {
                        _token: "{{ csrf_token() }}",
                        id_spj: id_spj
                    },
                    success: function(respond) {
                        $("#loadtambahpajak").html(respond);
                        // Format input rupiah
                $("#pajakppn").mask("#,##0", { reverse: true });
                $("#pajakpph").mask("#,##0", { reverse: true });
                    }
                });
     $("#modal-pajak").modal("show");
    });
var span = document.getElementsByClassName("close")[0];
</script>
<!-- END Button Tambah Pajak -->

<!-- Button Edit Pajak -->
<script>
$('.edit3').click(function(){
    var id_inpajak = $(this).attr('id_inpajak');
    $.ajax({
                    type: 'POST',
                    url: '/spj/edit/pajak',
                    cache: false,
                    data: {
                        _token: "{{ csrf_token() }}",
                        id_inpajak: id_inpajak
                    },
                    success: function(respond) {
                        $("#loadeditpajak").html(respond);
                         // Format input rupiah
                        $("#ppnbaru").mask("#,##0", { reverse: true });
                        $("#pphbaru").mask("#,##0", { reverse: true });
                    }
                });
     $("#modal-edit-pajak").modal("show");

});
var span = document.getElementsByClassName("close")[0];
</script>




<script>
    function autofill() {
    var select = document.getElementById("select-option");
    var inputText = document.getElementById("input-text");
    var inputText2 = document.getElementById("input-text2");
    var inputText3 = document.getElementById("input-text3");
    var inputText4 = document.getElementById("input-text4");
    var id = select.value;

    $.ajax({
        type: 'GET',
        url: '/spj/get',
        data: {id: id},
        success: function(data) {
            var nilai = data.data.pagu_rekdet.toString();
            var nilai2 = data.sisa_anggaran.toString();
            var formattedNilai = nilai.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            var formattedNilai2 = nilai2.replace(/\B(?=(\d{3})+(?!\d))/g, ".");

            if (data && nilai){
            inputText.value = "Rp. " + formattedNilai;
            inputText2.value = data.data.koefesien_rekdet + ' ' +data.data.satuan_rekdet;
            inputText3.value = "Rp. " + formattedNilai2;
            inputText4.value = data.sisa_k + ' ' +data.data.satuan_rekdet;
            }else{
                inputText.value = '';
            }
        }

    });
}
</script>
@endpush
