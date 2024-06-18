@extends('base')
@section('title', 'Dashboard')
@section('content')
    <section class="container">
        <div class="container-fluid">
            <div class="row">
                @if(Auth::user()->role == 'admin')
                <div class="col-md-3 d-flex flex-column align-items-center rounded p-1 mr-2" style="background-color: #FF0000">
                    <ion-icon class="mt-2 text-white" size="large" name="person"></ion-icon>
                    <h3 class="text-white mt-3">Pengguna</h3>
                    <p class="text-white">10</p>
                    <a class="text-white mb-2" href="/pengguna"><u> Lihat Selengkapnya -----></u></a>
                </div>
                @endif
                <div class="col-md-3 d-flex flex-column align-items-center rounded p-1" style="background-color: #97BE5A">
                    <ion-icon class="mt-2 text-white" size="large" name="file-tray-stacked"></ion-icon>
                    <h3 class="text-white mt-3">Stok Barang</h3>
                    <p class="text-white">10</p>
                    <a class="text-white mb-2" href="/stock-barang"><u> Lihat Selengkapnya -----></u></a>
                </div>
            </div>
        </div>
    </section>
@endsection()