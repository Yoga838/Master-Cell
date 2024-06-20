@extends('base')

@section('title', 'History')

@section('content')
    <section class="container">
        {{-- <div class="container-fluid">
            <div class="row d-flex justify-content-end mb-2">
                <button class="btn btn-primary mx-2 d-flex align-items-center " type="button" data-toggle="modal" data-target="#modalTambah">
                    <ion-icon name="add-outline"></ion-icon> Tambah Pengguna Baru
                </button>
                <button onclick="window.location.href='/pengguna/export'" class="btn btn-primary d-flex align-items-center" type="button" aria-expanded="false" onclick="window.location.href='/export-users'">
                    <ion-icon name="download-outline"></ion-icon> Ekspor
                </button>
            </div> --}}
        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead>
                <tr>
                    <th data-priority="1">No.</th>
                    <th data-priority="1">Username</th>
                    <th data-priority="2">Tanggal</th>
                    <th data-priority="1">View</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->username }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td class="d-flex gap-4">
                            <button class="btn btn-primary d-flex align-items-center" type="button" aria-expanded="false" data-toggle="modal" data-target="#modalEdit{{ $item->id }}">
                                <ion-icon name="eye-outline"></ion-icon>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </section>
    @foreach ($data as $item)
    <div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalEditLabel">Tambah Pengguna Baru</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
                <div class="modal-body">
                    <div class="input-group mb-3 d-flex flex-column">
                        <label for="nama-pengguna" class="form-label">Nama Pegawai</label>
                        <input class="form-control w-100" type="text" name="name" id="nama-pengguna" value="{{ $item->name }}"  disabled>
                    </div>
                    <div class="input-group mb-3 d-flex flex-column">
                        <label class="form-label" for="username">Barang Yang Dijual</label>
                        <input class="form-control w-100" type="text" name="username" id="username" value="{{ $item->nama_barang }}" disabled>
                    </div>
                    <div class="input-group mb-3 d-flex flex-column">
                        <label class="form-label" for="password">Quantity</label>
                        <input class="form-control w-100" type="text" name="password" id="password" value="{{ $item->quantity }}"  disabled>
                    </div>
                    <div class="input-group mb-3 d-flex flex-column">
                        <label class="form-label" for="username">Total</label>
                        <input class="form-control w-100" type="text" name="username" id="username" value="{{ $item->quantity*$item->Harga_jual }}" disabled>
                    </div>
                    
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
          </div>
        </div>
      </div>
    @endforeach

@endsection