@extends('base')

@section('title', 'Keranjang')

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
                    <th data-priority="1">Nama Barang</th>
                    <th data-priority="2">Harga</th>
                    <th data-priority="2">Quantity</th>
                    <th data-priority="2">Harga Total</th>
                    <th data-priority="1">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cartItems as $keranjang)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $keranjang->nama_barang }}</td>
                        <td>{{ $keranjang->Harga_jual }}</td>
                        <td>{{ $keranjang->quantity }}</td>
                        <td>{{ $keranjang->Harga_jual * $keranjang->quantity }}</td>
                        <td class="d-flex gap-4">
                            <button class="btn btn-danger waves-effect deleteBtn d-flex align-items-center" data-id="{{ $keranjang->id }}"><ion-icon name="trash-outline"></ion-icon></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>

    </section>
@endsection