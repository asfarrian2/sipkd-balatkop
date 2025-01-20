@extends('layouts.master')

@section('content')

<!-- Begin Pesan Peringatan -->
<div class="">
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

<div class="col-md-12 col-sm-12 ">
    <div class="x_panel">
        <div class="x_title">
            <h2>SUB KEGIATAN</h2>
            <div class="clearfix"></div>
        </div>
        <div class="col-md-4">
          <div id="" class="pull-left" style="background: #fff;    padding: 5px 10px; border: 1px solid #ccc">
            <i class="fa fa-home"></i>
            <span><a href="/dashboard" style="color: #0a803f">Home</a> /
            <i class="fa fa-database"></i> <a href="/sub_kegiatan/view" style="color: #0a803f">Sub Kegiatan</a> /
            <i class="fa fa-pencil"></i> Rekening</span> <b class="caret"></b>
          </div>
        </div>
		<div class="x_content">
		    <br>
                <div class="item form-group">
                    <div class="col-md-6 col-sm-6 ">
                        <input type="hidden" name="kode_sub_kegiatan" value="{{ $sub_kegiatan->kode_sub_kegiatan }}" id="first-name" required="required" class="form-control ">
                    </div>
                </div>
                <div class="item form-group">
					<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Kegiatan
					</label>
					<div class="col-md-6 col-sm-6 ">
						<input type="text" readonly name="kode_kegiatan" value="{{ $sub_kegiatan->kode_program }}.{{ $sub_kegiatan->kode_kegiatan }} - {{ $sub_kegiatan->nama_kegiatan}}" id="first-name" required="required" class="form-control ">
					</div>
				</div>
				<div class="item form-group">
					<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Kode Sub kegiatan
					</label>
					<div class="col-md-6 col-sm-6 ">
						<input type="text" readonly name="sub_kegiatan_baru" value="{{ $sub_kegiatan->kode_sub_kegiatan }}" id="first-name" required="required" class="form-control ">
					</div>
				</div>
                <div class="item form-group">
					<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nama Sub kegiatan
					</label>
					<div class="col-md-6 col-sm-6 ">
						<input type="text" readonly name="nama_sub_kegiatan" value="{{ $sub_kegiatan->nama_sub_kegiatan }}" id="first-name" required="required" class="form-control ">
					</div>
				</div>
                <div class="item form-group">
					<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Pagu
					</label>
					<div class="col-md-6 col-sm-6 ">
						<input type="text" readonly name="pagu_sub_kegiatan" value="{{ $sub_kegiatan->pagu_sub_kegiatan }}" id="pagu"  class="form-control ">
					</div>
                </div>
                <div class="item form-group">
					<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">PPTK
					</label>
					<div class="col-md-6 col-sm-6 ">
						<input type="text" readonly name="pagu_sub_kegiatan" value="{{ $sub_kegiatan->nama_pejabat }}" id="pagu"  class="form-control ">
					</div>
					</div>
				</div>
			</div>
            <!-- Begin Judul Halaman -->
<div class="row">
<div class="col-md-12 col-sm-12 ">
    <div class="x_panel">
        <div class="x_title">
            <h2>REKENING</h2>
            <div class="clearfix"></div>
        </div>
        <div class="col-md-4">
            <a href="#" class="btn btn-primary btn-sm objek" id="btntambahkoderekening">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus"
                  width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                  stroke="currentColor" fill="none" stroke-linecap="round"
                  stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <path d="M12 5l0 14"></path>
                  <path d="M5 12l14 0"></path>
              </svg>
              Tambah
            </a>
        </div>

<!-- End Judul Halaman -->

<!-- Begin Tabel -->
        <div class="x_content">
            <div class="row">
                <div class="col-sm-12">
                  <div class="card-box table-responsive">
                      <table id="datatable" class="table table-striped table-bordered" width="100%">
                        <thead>
                            <tr>
                            <th width="10px" class="text-center">No.</th>
                            <th width="100px" class="text-center">Kode Rekening</th>
                            <th width="300px" class="text-center">Nama Rekening</th>
                            <th class="text-center">Pagu</th>
                            <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data_subdet as $d)
                            <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $d->kode_rekening}}</td>
                            <td>{{ $d->nama_rekening }}</td>
                            <td>Rp <?php echo number_format($d->pagu_subdet ,2,',','.')?> </td>
                        @csrf
                            <td><a href="/sub_kegiatan/kode_rekening/{{ $d->kode_sub_kegiatan }}" title="Detail Kode Rekening"><i class="fa fa-tasks text-succsess btn btn-primary btn-sm" ></i></a>
                            <a href="/sub_kegiatan/edit/{{ $d->kode_sub_kegiatan }}" title="Edit Data"><i class="fa fa-pencil text-succsess btn btn-warning btn-sm" ></i></a>
                            <a class="hapus" href="#" data-id="{{ $d->id_subdet }}" title="Hapus Data"><i class="hapus fa fa-trash text-succsess btn btn-danger btn-sm" ></i></a>
                            </td>
                            </tr>
                        @endforeach
                      </tbody>
                      <tfoot>
                        <tr>
                        <th colspan="3" style="text-align: center;">Jumlah</th>
                        <th colspan="2">Rp <?php echo number_format($sum ,2,',','.')?> </th>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
              </div>
            </div>
<!-- End Begin Tabel -->
        </div>
    </div>
</div>
<!-- Modal Tambah -->
<div class="modal modal-blur fade" id="modal-inputobjek" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Rekening</h5>
                <button type="button" class="fa fa-close close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="/sub_kegiatan/subdet/store" method="POST" id="form_tambah_rekning">
                @csrf
                <div class="row">
                        <div class="col-12">
                            <div class="input-icon mb-3">
                            <span>REKENING</span>
                            <select name="input_kode_rekening" id="unit" class="form-control" required="required">
                            <option value="">Pilih Rekening</option>
                            @foreach ($kode_rekening as $d)
                            <option value="{{ $d->kode_rekening }}">{{$d->kode_rekening}} - {{$d->nama_rekening}} </option>
                             @endforeach
                            </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="input-icon mb-3">
                                <span>PAGU</span>
                                <input type="text" id="duit" class="form-control duit" name="pagu_sub_det" required>
                            </div>
                        </div>
                    </div>
                    <input hidden type="text" value="{{ $sub_kegiatan->kode_sub_kegiatan}}" id="" class="form-control duit" name="input_kode_sub_kegiatan" required>
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="form-group">
                                <button class="btn btn-success w-100">
                                    SIMPAN
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
              </div>
            </div>
<!-- Edit Modal -->

<div class="modal modal-blur fade" id="modal-edit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Rekening</h5>
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
<script src="/gentella/vendors/uang/jquery.mask.min.js"></script>
<script>
    $(document).ready(function(){
        $('#pagu').mask("#,##0", {
            reverse:true
        });
    });
</script>

<script>
    $(document).ready(function(){
        $('#duit').mask("#,##0", {
            reverse:true
        });
    });
</script>

<script>
 $(".objek").click(function() {
    $("#modal-inputobjek").modal("show");
});

var span = document.getElementsByClassName("close")[0];
</script>

<script>
    $(function() {
        $("#btnTambahCabang").click(function() {
            $("#modal-inputcabang").modal("show");
        });

        $(".edit").click(function() {
            var kode_cabang = $(this).attr('kode_cabang');
            $.ajax({
                type: 'POST'
                , url: '/cabang/edit'
                , cache: false
                , data: {
                    _token: "{{ csrf_token(); }}"
                    , kode_cabang: kode_cabang
                }
                , success: function(respond) {
                    $("#loadeditform").html(respond);
                }
            });
            $("#modal-editcabang").modal("show");
        });
    });
</script>
<script>
    $('.hapus').click(function(){
        var kode_sub_kegiatan = $(this).attr('data-id');
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
        window.location = "/sub_kegiatan/"+kode_sub_kegiatan+"/hapussubdet"
        Swal.fire({
          title: "Data Berhasil Dihapus !",
          icon: "success"
        });
      }
    });
    });
    </script>
@endpush
