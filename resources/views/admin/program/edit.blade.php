@extends('layouts.master')

@section('content')
<div class="">
    @csrf
    @php
    $messagewarning = Session::get('warning');
@endphp
@if (Session::get('warning'))
<a class="btn btn-danger btn-xs close-link text-succsess" href="#"><i class="fa fa-times text-succsess " > {{ $messagewarning }}</i></a>
<br>
@endif

<div class="col-md-12 col-sm-12 ">
    <div class="x_panel">
      <div class="x_title">
        <h2>PROGRAM</h2>
        <div class="clearfix"></div>
      </div>
        <div class="col-md-4">
          <div id="" class="pull-left" style="background: #fff;    padding: 5px 10px; border: 1px solid #ccc">
            <i class="fa fa-home"></i>
            <span><a href="/dashboard" style="color: #0a803f">Home</a> /
            <i class="fa fa-database"></i> <a href="/program/view" style="color: #0a803f">Program</a> /
            <i class="fa fa-pencil"></i> Edit Data</span> <b class="caret"></b>
          </div>
        </div>
								<div class="x_content">
									<br />
									<form action="/program/update" method="POST" data-parsley-validate class="form-horizontal form-label-left">
                                        @csrf
                                        <div class="item form-group">
                                        <div class="col-md-6 col-sm-6 ">
                                            <input type="hidden" name="kode_program" value="{{ $program->kode_program }}" id="first-name" required="required" class="form-control ">
                                        </div>
                                         </div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Kode Program
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" name="kodeprogram_baru" value="{{ $program->kode_program }}" id="first-name" required="required" class="form-control ">
											</div>
										</div>
                                        <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nama Program
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" name="nama_program" value="{{ $program->nama_program }}" id="first-name" required="required" class="form-control ">
											</div>
										</div>
                                        <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Pagu
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="number" name="pagu_program" value="{{ $program->pagu_program }}" id="first-name"  class="form-control ">
											</div>
										</div>
										<div class="ln_solid"></div>
										<div class="item form-group">
											<div class="col-md-6 col-sm-6 offset-md-3">
												<button type="submit" class="btn btn-success">Simpan</button>
                                                <a href="/program/view" class="btn btn-dark">Batal</a>
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
