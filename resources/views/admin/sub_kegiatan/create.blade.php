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

<!-- Judul Halaman -->
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
                <i class="fa fa-plus"></i> Tambah Data</span> <b class="caret"></b>
          </div>
        </div>
<!-- Begin FormInput -->
        <div class="clearfix"></div>
			<div class="x_content">
				<br/>
				<form action="/sub_kegiatan/store" method="POST" data-parsley-validate class="form-horizontal form-label-left">
                    @csrf
                    <div class="item form-group">
						<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Kegiatan
						</label>
						<div class="col-md-6 col-sm-6 ">
                            <select name="kode_kegiatan" id="unit" class="form-control" required="required">
                                <option value="">Pilih Kegiatan</option>
                                @foreach ($program as $d)
                                <option value="{{ $d->kode_kegiatan }}">{{ $d->kode_program}} {{$d->nama_program }} |
                                {{ $d->kode_kegiatan}} {{$d->nama_kegiatan }}
                                </option>
                                @endforeach
                            </select>
						</div>
					</div>
					<div class="item form-group">
						<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Kode Sub Kegiatan
						</label>
						<div class="col-md-6 col-sm-6 ">
							<input type="text" name="kode_sub_kegiatan" id="first-name" required="required" class="form-control ">
						</div>
					</div>
                    <div class="item form-group">
						<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nama Sub Kegiatan
						</label>
						<div class="col-md-6 col-sm-6 ">
							<input type="text" name="nama_sub_kegiatan" id="first-name" required="required" class="form-control ">
						</div>
					</div>
                    <div class="item form-group">
						<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Pagu
						</label>
						<div class="col-md-6 col-sm-6 ">
							<input type="text" name="pagu_sub_kegiatan" id="pagu"  class="form-control ">
						</div>
					</div>
                    <div class="item form-group">
						<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">PPTK
						</label>
						<div class="col-md-6 col-sm-6 ">
                            <select name="id_pejabat" id="unit" class="form-control" required="required">
                                <option value="">Pilih PPTK</option>
                                @foreach ($pptk as $d)
                                <option value="{{ $d->id_pejabat }}">{{ $d->nama_pejabat}} - {{$d->jabatan_pejabat }}
                                </option>
                                @endforeach
                            </select>
						</div>
					</div>
					<div class="ln_solid"></div>
					<div class="item form-group">
						<div class="col-md-6 col-sm-6 offset-md-3">
							<button type="submit" class="btn btn-success">Simpan</button>
                            <a href="/sub_kegiatan/view" class="btn btn-dark">Batal</a>
						</div>
				        </form>
			        </div>
		        </div>
            </div>
        </div>
    </div>
</div>
<!-- End forminput -->

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
