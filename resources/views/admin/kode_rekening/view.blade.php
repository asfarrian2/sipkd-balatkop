@extends('layouts.master')

@section('content')

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

<div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>KODE REKENING</h2>
                    <div class="clearfix"></div>
                  </div>
                    <div class="col-md-4">
                      <div id="" class="pull-left" style="background: #fff;    padding: 5px 10px; border: 1px solid #ccc">
                        <i class="fa fa-home"></i>
                        <span><a href="" style="color: #0a803f">Home</a> / Kode Rekening</span> <b class="caret"></b>
                      </div>
                    </div>
                    <br>
                    <br>
                    <div class="col-md-4">
                  <a href="/koderekening_create" class="btn btn-primary btn-sm" id="btntambahkoderekening">
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
                  <div class="x_content">
                      <div class="row">
                          <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <table id="datatable" class="table table-striped table-bordered" width="100%">
                      <thead>
                        <tr>
                          <th width="10px" class="text-center">No.</th>
                          <th width="150px" class="text-center">Kode Rekening</th>
                          <th class="text-center">Nama</th>
                          <th class="text-center">Keterangan</th>
                          <th class="text-center">Aksi</th>

                        </tr>
                      </thead>
                      <tbody>
                      @foreach ($koderekening as $d)
                        <tr>
                          <td class="text-center">{{ $loop->iteration }}</td>
                          <td>{{ $d->kode_rekening }}</td>
                          <td>{{ $d->nama_rekening }}</td>
                          <td>{{ $d->keterangan_rekening }}</td>
                          @csrf
                          <td><a href="/koderekening/edit/{{ $d->kode_rekening }}" title="Edit Data"><i class="fa fa-pencil text-succsess btn btn-warning btn-sm" ></i></a>
                             <a class="hapus" href="#" data-id="{{ $d->kode_rekening }}" title="Hapus Data"><i class="hapus fa fa-trash text-succsess btn btn-danger btn-sm" ></i></a>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
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
        var kode_rekening = $(this).attr('data-id');
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
        window.location = "/koderekening/"+kode_rekening+"/hapus"
        Swal.fire({
          title: "Data Berhasil Dihapus !",
          icon: "success"
        });
      }
    });
    });
    </script>
    <script>

        $("#tambah").click(function() {
           $("#modal-inputobjek").modal("show");
       });


       var span = document.getElementsByClassName("close")[0];
       </script>
@endpush
