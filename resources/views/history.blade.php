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
                    <th>No.</th>
                    <th>Username</th>
                    <th>Tanggal</th>
                    <th>View</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>
        </div>
    </section>
@endsection