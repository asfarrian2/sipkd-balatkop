@extends('layouts.master')

@section('content')

<div class="">
    @csrf
    @php
    $messagewarning = Session::get('warning');
    $messagesuccess = Session::get('success');
@endphp
@if (Session::get('warning'))
<a class=" btn btn-danger btn-xs close-link" href="#"><i class="fa fa-check text-times" > {{ $messagewarning }}</i></a>
@endif

@if (Session::get('success'))
<a class=" btn btn-success btn-xs close-link" href="#"><i class="fa fa-check text-succsess" > {{ $messagesuccess }}</i></a>
@endif

<br>

          <div class="page-title">
            <div class="title_left">
              <h3>KODE REKENING</h3>
             </div>
            </div>

<div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Tabel Data</h2>
                    <div class="clearfix"></div>
                  </div>
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

                  <div class="x_content">
                      <div class="row">
                          <div class="col-sm-12">
                            <div class="card-box table-responsive">
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
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
                            <a onclick="myFunction()" href="/koderekening/{{ $d->kode_rekening }}/hapus" title="Hapus Data"><i class="fa fa-trash text-succsess btn btn-danger btn-sm" ></i></a>
                            <!-- <form action="/koderekening/{{ $d->kode_rekening }}/hapus" method="POST" style="display:inline;" id="delete-form-{{ $d->kode_rekening }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="confirmDelete({{ $d->kode_rekening }})">Hapus</button>
                            </form> -->
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
<script>
     function confirmDelete(itemId) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Data ini akan dihapus permanen!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit form untuk menghapus item
                    document.getElementById('delete-form-' + itemId).submit();
                }
            });
        }
    </script>
@endsection
