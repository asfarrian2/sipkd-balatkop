@extends('layouts.master')

@section('content')

<!-- Begin Pesan Peringatan -->
<div class="">
@csrf
    @php
        $messagewarning = Session::get('warning');
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
            <i class="fa fa-pencil"></i> Edit Data</span> <b class="caret"></b>
          </div>
        </div>
		<div class="x_content">
		    <br>
			<form action="/sub_kegiatan/update" method="POST" data-parsley-validate class="form-horizontal form-label-left">
                @csrf
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
            <h2>RINCIAN</h2>
            <div class="clearfix"></div>
        </div>
        <div class="col-md-4">
            <a href="/sub_kegiatan/create" class="btn btn-primary btn-sm" id="btntambahkoderekening">
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
                            <th width="200px" class="text-center">Kode Rekening</th>
                            <th width="500px" class="text-center">Nama Rekening</th>
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
                            <td>Rp <?php echo number_format($d->pagu_sub_kegiatan ,2,',','.')?> </td>
                        @csrf
                            <td><a href="/sub_kegiatan/kode_rekening/{{ $d->kode_sub_kegiatan }}" title="Detail Kode Rekening"><i class="fa fa-tasks text-succsess btn btn-primary btn-sm" ></i></a>
                            <a href="/sub_kegiatan/edit/{{ $d->kode_sub_kegiatan }}" title="Edit Data"><i class="fa fa-pencil text-succsess btn btn-warning btn-sm" ></i></a>
                            <a class="hapus" href="#" data-id="{{ $d->kode_sub_kegiatan }}" title="Hapus Data"><i class="hapus fa fa-trash text-succsess btn btn-danger btn-sm" ></i></a>
                            </td>
                            </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
<!-- End Begin Tabel -->
        </div>
    </div>
</div>
</div>
</div>


@endsection
@push('myscript')
<script src="/gentella/vendors/uang/jquery.mask.min.js"></script>
<script>
    $(document).ready(function(){
        $('#pagu').mask("#,##0", {
            reverse:true
        });
    });
</script>
@endpush
