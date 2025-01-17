@extends('layouts.master')

@section('content')
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
          <div class="page-title">
            <div class="title_left">
              <h3>Kode Rekening</h3>
            </div>
        </div>
        <!-- forminput -->
        <div class="clearfix"></div>
					<div class="row">
						<div class="col-md-12 col-sm-12 ">
							<div class="x_panel">
								<div class="x_title">
									<h2>Tambah Data</h2>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<br />
									<form action="/koderekening/store" method="POST" data-parsley-validate class="form-horizontal form-label-left">
                                        @csrf
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Kode Rekening
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" name="kode_rekening" id="first-name" required="required" class="form-control ">
											</div>
										</div>
                                        <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nama Rekening
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" name="nama_rekening" id="first-name" required="required" class="form-control ">
											</div>
										</div>
                                        <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Keterangan
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" name="keterangan_rekening" id="first-name"  class="form-control ">
											</div>
										</div>
										<div class="ln_solid"></div>
										<div class="item form-group">
											<div class="col-md-6 col-sm-6 offset-md-3">
												<button type="submit" class="btn btn-success">Simpan</button>
                                                <a href="/koderekening_view" class="btn btn-dark">Batal</a>
											</div>
										</div>

									</form>
								</div>
							</div>
						</div>
					</div>
                <!-- forminput -->
                </div>
            </div>

@endsection
