@extends('base')
@section('title', 'Pengguna')
@section('content')
    <section class="container">
        <div class="container-fluid">
                <div class="row d-flex justify-content-end mb-2">
                    <button class="btn btn-primary mx-2 d-flex align-items-center " type="button" data-toggle="modal" data-target="#modalTambah">
                        <ion-icon name="add-outline"></ion-icon> Tambah Pengguna Baru
                    </button>
                    <button onclick="window.location.href='/pengguna/export'" class="btn btn-primary d-flex align-items-center" type="button" aria-expanded="false" onclick="window.location.href='/export-users'">
                        <ion-icon name="download-outline"></ion-icon> Ekspor
                    </button>
                </div>
            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                    <tr>
                        <th data-priority="1">No.</th>
                        <th data-priority="1">Nama Pengguna</th>
                        <th data-priority="2">Username</th>
                        <th data-priority="2">Role</th>
                        <th data-priority="1">Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->role }}</td>
                            <td class="d-flex gap-4">
                                <button class="btn btn-primary d-flex align-items-center" type="button" aria-expanded="false" data-toggle="modal" data-target="#modalEdit{{ $user->id }}">
                                    <ion-icon name="create-outline"></ion-icon>
                                </button>
                                <button class="btn btn-danger waves-effect deleteBtn d-flex align-items-center" data-id="{{ $user->id }}"><ion-icon name="trash-outline"></ion-icon></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>

    {{-- modal tambah --}}
    <div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="modalTambahLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalTambahLabel">Tambah Pengguna Baru</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{ route('add-pengguna') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="input-group mb-3 d-flex flex-column">
                        <label for="nama-pengguna" class="form-label">nama pengguna</label>
                        <input class="form-control w-100" type="text" name="name" id="nama-pengguna" required>
                    </div>
                    <div class="input-group mb-3 d-flex flex-column">
                        <label class="form-label" for="username">username</label>
                        <input class="form-control w-100" type="text" name="username" id="username" required>
                    </div>
                    <div class="input-group mb-3 d-flex flex-column">
                        <label class="form-label" for="password">password</label>
                        <input class="form-control w-100" type="password" name="password" id="password" required>
                    </div>
                    <div class="input-group mb-3 d-flex flex-column">
                        <label class="form-label" for="role">role</label>
                        <select class="form-control w-100" name="role" id="role" required>
                            <option>select - role</option>
                            <option value="admin">admin</option>
                            <option value="pegawai">pegawai</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Tambahkan</button>
                </div>
            </form>
          </div>
        </div>
      </div>

      {{-- modal edit --}}
      @foreach ($data as $user)
    <div class="modal fade" id="modalEdit{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalEditLabel">Tambah Pengguna Baru</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{ route('update-pengguna', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="input-group mb-3 d-flex flex-column">
                        <label for="nama-pengguna" class="form-label">nama pengguna</label>
                        <input class="form-control w-100" type="text" name="name" id="nama-pengguna" value="{{ $user->name  }}" required>
                    </div>
                    <div class="input-group mb-3 d-flex flex-column">
                        <label class="form-label" for="username">username</label>
                        <input class="form-control w-100" type="text" name="username" id="username" value="{{ $user->username }}" required>
                    </div>
                    <div class="input-group mb-3 d-flex flex-column">
                        <label class="form-label" for="password">password</label>
                        <input class="form-control w-100" type="password" name="password" id="password" value="{{ $user->password }}" required>
                    </div>
                    <div class="input-group mb-3 d-flex flex-column">
                        <label class="form-label" for="role">role</label>
                        <select class="form-control w-100" name="role" id="role" required>
                            @php
                                $role = ["admin", "pegawai"];
                            @endphp
                            @if(@empty($user->role))
                                <option selected disabled>select - role</option>
                            @endif
                            @foreach ($role as $r)
                                <option value="{{ $r }}" {{ $user->role == $r ? 'selected' : ''  }}>{{ $r }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">perbarui</button>
                </div>
            </form>
          </div>
        </div>
      </div>
      @endforeach
@endsection()

@push('script')
    <script>
        @if(Session('success'))
            Swal.fire({ 
                title : "Sukses !",
                text : "{{ Session('success') }}",
                icon : "success"
            })
        @endif
        @if(Session('error'))
            Swal.fire({
                icon : 'error',
                title : 'Oops...',
                text : "{{ Session('error') }}"
            })
        @endif
    </script>
    <script>
        $(document).ready(function() {
        $(".deleteBtn").click(function(){
            var id = $(this).data('id');
                Swal.fire({
                    title : 'Apakah Anda Yakin ?',
                    text : "Anda tidak akan dapat mengembalikan ini!",
                    icon : 'warning',
                    showCancelButton : true,
                    confirmButtonColor : '#d33',
                    cancelButtonColor : '#3085d6',
                    confirmButtonText : "Ya, Hapus Data!"
                }).then((result) => {
                    if(result.isConfirmed){
                       $.ajax({
                        type: "POST",
                        url: "{{ route('delete-pengguna') }}",
                        data: {
                            _token: "{{ csrf_token() }}",
                            id : id
                        },
                        success : function(response) {
                            Swal.fire({ 
                                title : "Sukses !",
                                text : "Data Berhasil Dihapus!",
                                icon : "success"
                            }).then((result) => {
                                location.reload();
                            })
                        },
                        error : function(error) {
                            Swal.fire({
                                icon : 'error',
                                title : 'Oops...',
                                text : "Terjadi Kesalahan!"
                            })
                        }
                       })
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        Swal.fire (
                            'Batal',
                            'Tidak ada perubahan yang dilakukan.',
                            'info'
                        ).then((result) => {
                            location.reload();
                        })
                    }
                }
            )
            })
        })
    </script>
@endpush
