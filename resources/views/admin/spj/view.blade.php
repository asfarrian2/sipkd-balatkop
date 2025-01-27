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
        <a href="#" class="btn btn-primary btn-md tambah"><i class="fa fa-plus"></i> Tambah</a>
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
                            <th class="text-center">Nominal</th>
                            <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($spj as $d)
                            <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $d->no_spj }}</td>
                            <td>{{ date('d-m-Y', strtotime($d->tgl_spj)) }}</td>
                            <td>{{ $d->uraian_spj }}</td>
                            <td>Rp <?php echo number_format($d->nominal_spj ,2,',','.')?> </td>
                        @csrf
                            <td>
                            @if ($d->status_spj == 0)
                            {{-- <a href="/up/verifikasi/{{ $d->id_spj }}" title="Verifikasi Data"><i class="fa fa-unlock text-succsess btn btn-info btn-sm" ></i></a> --}}
                            <a class="edit" href="#" title="Edit Data" id_spj="{{$d->id_spj}}"><i class="fa fa-pencil text-succsess btn btn-warning btn-sm" ></i></a>
                            <a class="hapus" href="#" data-id="{{ $d->id_spj }}" title="Hapus Data"><i class="hapus fa fa-trash text-succsess btn btn-danger btn-sm" ></i></a>
                            @else
                            <a href="#" title="Terverifikasi"><i class="fa fa-lock text-succsess btn btn-success btn-sm" ></i></a>
                            @endif
                            </td>
                            </tr>
                            @empty
                                {{-- jika data tidak ada, tampilkan pesan data tidak tersedia --}}
                            <tr>
                                <td colspan="6">
                                    <div class="d-flex justify-content-center align-items-center">
                                       <p> <i class="fa fa-exclamation"></i> Tidak ada data tersedia.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                      </tbody>
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
</div>

</div>

@endsection
@push('myscript')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
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
                        $("#detail_subkegiatan").empty('<option value=""> Pilih Kode Rekening </option>');
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



// $(".edit").click(function() {
//    $("#modal-editobjek").modal("show");
// });


var span = document.getElementsByClassName("close")[0];
</script>
@endpush
