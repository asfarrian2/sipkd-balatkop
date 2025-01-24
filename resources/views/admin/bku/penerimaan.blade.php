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
            <h2>PENERIMAAN - UANG PELIMPAHAN</h2>
            <div class="clearfix"></div>
        </div>
        <div class="col-md-4">
          <div id="" class="pull-left" style="background: #fff;    padding: 5px 10px; border: 1px solid #ccc">
            <i class="fa fa-home"></i>
            <span><a href="/dashboard" style="color: #0a803f">Home</a> /
            <i class="fa fa-credit-card"></i> <a href="/bku/view" style="color: #0a803f">Buku Kas Umum</a> /
                 Uang Pelimpahan</span> <b class="caret"></b>
          </div>
        </div>
        <br>


<!-- End Judul Halaman -->

<!-- Begin Tabel -->
        <div class="x_content">
            <div class="row">
                <div class="col-sm-12">
                  <div class="card-box table-responsive">
                      <table id="datatable" class="table table-striped table-bordered" width="100%">
                        <thead>
                            <tr>
                            <th class="text-center">No.</th>
                            <th class="text-center">Kode</th>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Uraian</th>
                            <th class="text-center">Nominal</th>
                            <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($up as $d)
                            <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $d->id_up }}</td>
                            <td>{{ date('d-m-Y', strtotime($d->tgl_up)) }}</td>
                            <td>{{ $d->uraian_up }}</td>
                            <td>Rp <?php echo number_format($d->nominal_up ,2,',','.')?> </td>
                        @csrf
                            <td>
                            <a href="#" title="Tambah"><i class="fa fa-plus text-succsess btn btn-primary btn-lg tambah" data-id="{{ $d->id_up }}"></i></a>
                            </td>
                            </tr>
                            @php
                            $total =+ $d->nominal_up;
                            @endphp
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
</div>
</div>
</div>
</div>

@endsection
@push('myscript')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $('.tambah').click(function(){
        var id_up = $(this).attr('data-id');
    Swal.fire({
      title: "Apakah Anda Ingin Menambahkan Pembukuan Uang Pelimpahan ?",
      text: "Jika Ya Maka Data Akan Masuk pada Buku Kas Umum",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Ya, Tambahkan!"
    }).then((result) => {
      if (result.isConfirmed) {
        window.location = "/bku/store_penerimaan/"+id_up
        Swal.fire({
          title: "Data Berhasil Di Masukkan !",
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
