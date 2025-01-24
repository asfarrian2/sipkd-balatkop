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
            <h2>BUKU KAS UMUM MANUAL</h2>
            <div class="clearfix"></div>
        </div>
        <div class="col-md-4" class="pull-right">
            <a href="/bku/penerimaan" class="btn btn-success btn-sm" id="btntambahkoderekening">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus"
                  width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                  stroke="currentColor" fill="none" stroke-linecap="round"
                  stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <path d="M12 5l0 14"></path>
                  <path d="M5 12l14 0"></path>
              </svg>
                Uang Pelimpahan
            </a>
        </div>
        <div class="col-md-4" class="pull-right">
            <a href="/bku/tunai" class="btn btn-secondary btn-sm" id="btntambahkoderekening">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus"
                  width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                  stroke="currentColor" fill="none" stroke-linecap="round"
                  stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <path d="M12 5l0 14"></path>
                  <path d="M5 12l14 0"></path>
              </svg>
              Tarik Tunai
            </a>
        </div>
        <div class="col-md-4 class="pull-right>
            <a href="/bku/create_pengeluaran" class="btn btn-info btn-sm" id="btntambahkoderekening">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus"
                  width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                  stroke="currentColor" fill="none" stroke-linecap="round"
                  stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <path d="M12 5l0 14"></path>
                  <path d="M5 12l14 0"></path>
              </svg>
              Pengeluaraan
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
                            <th rowspan="2" class="text-center">No.</th>
                            <th rowspan="2" class="text-center">Kode</th>
                            <th rowspan="2" class="text-center">Tanggal</th>
                            <th rowspan="2" class="text-center">Uraian/Deskripsi/Keterangan</th>
                            <th rowspan="1" colspan="2" class="text-center">Kredit (Rp)</th>
                            <th rowspan="1" colspan="2" class="text-center">Debit (Rp)</th>
                            <th rowspan="1" colspan="2" class="text-center">Sisa Saldo (Rp)</th>
                            <th rowspan="2" class="text-center">Jumlah Saldo (Rp)</th>
                            <th rowspan="2" class="text-center">Aksi</th>
                            </tr>
                            <tr>
                            <th class="text-center">Tunai</th>
                            <th class="text-center">Non Tunai</th>
                            <th class="text-center">Tunai</th>
                            <th class="text-center">Non Tunai</th>
                            <th class="text-center">Tunai</th>
                            <th class="text-center">Non Tunai</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php
                            $tunai = 0;
                            $tnt = 0;
                            $jumlah = 0;
                        @endphp
                        @forelse ($bku as $d)
                            <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $d->id_bku }}</td>
                            <td>{{ date('d-m-Y', strtotime($d->tgl_bku)) }}</td>
                            <td>{{ $d->uraian_bku }}</td>
                            <td>Rp<?php echo number_format($d->penerimaan_t ,2,',','.')?> </td>
                            <td>Rp<?php echo number_format($d->penerimaan_tnt ,2,',','.')?> </td>
                            <td>Rp<?php echo number_format($d->pengeluaran_t ,2,',','.')?> </td>
                            <td>Rp<?php echo number_format($d->pengeluaran_tnt ,2,',','.')?> </td>
                            @php
                            $tunai = $tunai + ($d->penerimaan_t - $d->pengeluaran_t);
                            $tnt = $tnt + ($d->penerimaan_tnt - $d->pengeluaran_tnt);
                            $jumlah = $tunai + $tnt;
                            @endphp
                            <td>{{'Rp' . number_format($tunai ,2, ',','.') }}</td>
                            <td>{{'Rp' . number_format($tnt ,2, ',','.') }}</td>
                            <td>{{'Rp' . number_format($jumlah ,2, ',','.') }}</td>
                        @csrf
                            <td>
                            @if ($d->status_bku == 0)
                            <a class="kunci" href="#" data-id="{{ $d->id_bku }}" title="Kunci Data"><i class="fa fa-unlock text-succsess btn btn-success btn-sm" ></i></a>
                            <a href="/bku/edit/{{ $d->id_bku }}" title="Edit Data"><i class="fa fa-pencil text-succsess btn btn-warning btn-sm" ></i></a>
                            <a class="hapus" href="#" data-id="{{ $d->id_bku }}" title="Hapus Data"><i class="hapus fa fa-trash text-succsess btn btn-danger btn-sm" ></i></a>
                            @else
                            <a href="#" title="Terkunci "><i class="fa fa-lock text-succsess btn btn-info btn-sm" ></i></a>
                            @endif
                            </td>
                            </tr>
                            @empty
                                {{-- jika data tidak ada, tampilkan pesan data tidak tersedia --}}
                            <tr>
                                <td colspan="12">
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
    $('.hapus').click(function(){
        var id_bku = $(this).attr('data-id');
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
        window.location = "/bku/"+id_bku+"/hapus"
        Swal.fire({
          title: "Data Berhasil Dihapus !",
          icon: "success"
        });
      }
    });
    });
    </script>
    <script>
    $('.kunci').click(function(){
        var id_bku = $(this).attr('data-id');
    Swal.fire({
      title: "Apakah Anda Yakin Data Ini Ingin Di Kunci ?",
      text: "Jika Ya Maka Data Akan Bisa Di Edit Kembali",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Ya, Kunci Saja!"
    }).then((result) => {
      if (result.isConfirmed) {
        window.location = "/bku/kunci/"+id_bku
        Swal.fire({
          title: "Data Berhasil Dikunci !",
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
