@extends('base')
@section('title', 'Dashboard')
@section('content')
    <section class="container">
        <div class="container-fluid">
            <div class="row">
                @if(Auth::user()->role == 'admin')
                <div class="col-md-5 col-sm-3 d-flex flex-column align-items-center rounded p-1 mr-2" style="background-color: #FF0000">
                    <ion-icon class="mt-2 text-white" size="large" name="person"></ion-icon>
                    <h3 class="text-white mt-3">Pegawai</h3>
                    <p class="text-white">{{ $jumlah_pengguna }}</p>
                    <a class="text-white mb-2" href="/pengguna"><u> Lihat Selengkapnya -----></u></a>
                </div>
                @endif
                <div class="col-md-5 col-sm-3 d-flex flex-column align-items-center rounded p-1" style="background-color: #97BE5A">
                    <ion-icon class="mt-2 text-white" size="large" name="file-tray-stacked"></ion-icon>
                    <h3 class="text-white mt-3">Stok Barang</h3>
                    <p class="text-white">{{ $jumlah_barang }}</p>
                    <a class="text-white mb-2" href="/stock-barang"><u> Lihat Selengkapnya -----></u></a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="mx-auto col-xl-9" id="myChart"></div>
        </div>
    </section>
@endsection()

@push('script')
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
  <script>
    data= @json($data);
    console.log(data)
    new Morris.Bar({
      element: 'myChart',
      data : @json($data),
      xkey: ['created_month'],
      ykeys: ['total_penjualan'],
      labels: ['Total Penjualan'],
      hideHover: 'auto',
      stacked : false,
      yLabelFormat : function(y) {return Math.round(y)},
    });
  </script>

@endpush