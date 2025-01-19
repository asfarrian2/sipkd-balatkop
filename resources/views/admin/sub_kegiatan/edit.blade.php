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
					<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Program
					</label>
					<div class="col-md-6 col-sm-6 ">
                    <select name="kode_kegiatan" id="kode_kegiatan" class="form-control">
                    <option value="">Pilih Kegiatan</option>
                        @foreach ($kegiatan as $d)
                            <option {{ $sub_kegiatan->kode_kegiatan == $d->kode_kegiatan ? 'selected' : '' }}
                                value="{{ $d->kode_kegiatan }}">{{ ($d->kode_program) }} - {{ ($d->kode_kegiatan) }}
                                {{ ($d->nama_kegiatan   ) }}</option>
                        @endforeach
                    </select>
					</div>
				</div>
				<div class="item form-group">
					<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Kode Sub kegiatan
					</label>
					<div class="col-md-6 col-sm-6 ">
						<input type="text" name="sub_kegiatan_baru" value="{{ $sub_kegiatan->kode_sub_kegiatan }}" id="first-name" required="required" class="form-control ">
					</div>
				</div>
                <div class="item form-group">
					<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nama Sub kegiatan
					</label>
					<div class="col-md-6 col-sm-6 ">
						<input type="text" name="nama_sub_kegiatan" value="{{ $sub_kegiatan->nama_sub_kegiatan }}" id="first-name" required="required" class="form-control ">
					</div>
				</div>
                <div class="item form-group">
					<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Pagu
					</label>
					<div class="col-md-6 col-sm-6 ">
						<input type="text" name="pagu_sub_kegiatan" value="{{ $sub_kegiatan->pagu_sub_kegiatan }}" id="pagu"  class="form-control ">
					</div>
                </div>
                <div class="item form-group">
					<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">PPTK
					</label>
					<div class="col-md-6 col-sm-6 ">
                    <select name="id_pejabat" id="id_pejabat" class="form-control">
                    <option value="">Pilih PPTK</option>
                        @foreach ($pptk as $d)
                            <option {{ $sub_kegiatan->id_pejabat == $d->id_pejabat ? 'selected' : '' }}
                                value="{{ $d->id_pejabat }}">{{ ($d->nama_pejabat) }} - {{ ($d->jabatan_pejabat) }}
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
				    </div>
		        	</form>
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
