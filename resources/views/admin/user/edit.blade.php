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
          <div class="page-title">
            <div class="title_left">
              <h3>User</h3>
            </div>
        </div>
        <!-- forminput -->
        <div class="clearfix"></div>
					<div class="row">
						<div class="col-md-12 col-sm-12 ">
							<div class="x_panel">
								<div class="x_title">
									<h2>Edit Data</h2>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<br />
									<form action="/user/update" method="POST" data-parsley-validate class="form-horizontal form-label-left">
                                        @csrf
                                        <div class="item form-group">
											<div class="col-md-6 col-sm-6 ">
												<input type="hidden" name="id" value="{{ $users->id }}" id="first-name"  class="form-control ">
											</div>
										</div>
                                        <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nama
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" name="nama" value="{{ $users->name }}" id="first-name" required="required" class="form-control ">
											</div>
										</div>

										<input type="hidden" name="email" value="{{ $users->email }}" id="first-name"  class="form-control ">

                                        <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">NIP
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" name="nip" value="{{ $users->nip }}" id="first-name"  class="form-control ">
											</div>
										</div>

										<input type="hidden" name="password" value="{{ $users->password }}" id="first-name"  class="form-control ">


                                        <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Tempat Lahir
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" name="tempat_lahir" value="{{ $users->tempat_lahir }}" id="first-name"  class="form-control ">
											</div>
										</div>
                                        <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Tanggal Lahir
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="date" name="tgl_lahir" value="{{ $users->tgl_lahir }}" id="first-name"  class="form-control ">
											</div>
										</div>
                                        <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Pangkat/Golongan
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" name="pangkat_golongan" value="{{ $users->pangkat_golongan }}" id="first-name"  class="form-control ">
											</div>
										</div>
                                        <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Jabatan
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" name="jabatan" value="{{ $users->jabatan }}" id="first-name"  class="form-control ">
											</div>
										</div>
                                        <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">No. Telepon
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" name="no_telp" value="{{ $users->no_telp }}" id="first-name"  class="form-control ">
											</div>
										</div>
										<div class="ln_solid"></div>
										<div class="item form-group">
											<div class="col-md-6 col-sm-6 offset-md-3">
												<button type="submit" class="btn btn-success">Simpan</button>
                                                <a href="/user/view" class="btn btn-dark">Batal</a>
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
