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
              <h3>User</h3>
              <div class="row">
              <div class="col-12">
              <a href="/user/create" class="btn btn-primary btn-sm" id="btntambahpenyedia">
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
                            </div>
             </div>
             </div>
<div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Tabel Data</h2>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">
                      <div class="row">
                          <div class="col-sm-12">
                            <div class="card-box table-responsive">
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th width="10px" class="text-center">No.</th>
                          <th class="text-center">Nama</th>
                          <th class="text-center">Username</th>
                          <th class="text-center">NIP</th>
                          <th class="text-center">Tempat Lahir</th>
                          <th class="text-center">Tgl Lahir</th>
                          <th class="text-center">Pangkat/Golongan</th>
                          <th class="text-center">Jabatan</th>
                          <th class="text-center">No. Telepon</th>
                          <th class="text-center">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach ($users as $d)
                        <tr>
                          <td class="text-center">{{ $loop->iteration }}</td>
                          <td>{{ $d->name }}</td>
                          <td>{{ $d->email }}</td>
                          <td>{{ $d->nip }}</td>
                          <td>{{ $d->tempat_lahir }}</td>
                          <td>{{ $d->tgl_lahir }}</td>
                          <td>{{ $d->pangkat_golongan }}</td>
                          <td>{{ $d->jabatan }}</td>
                          <td>{{ $d->no_telp }}</td>
                          @csrf
                          <td>

                            <a href="/user/edit/{{ $d->id }}" title="Edit Data"><i class="fa fa-pencil text-succsess btn btn-warning btn-lg" ></i></a>
                            <form action="/user/{{ $d->id }}/hapus" method="POST" style="display:inline;" id="delete-form-{{ $d->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" class=" btn btn-danger btn-sm" onclick="confirmDelete({{ $d->id }})" title="Hapus Data"><i class="fa fa-trash" ></i></button>
                            </form>
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
