@extends('navbar')
@section('content')
{{-- hero 1 --}}
<section class="container mx-auto row section1" style="font-family: 'Open Sans', sans-serif">
    <img src="/images/hero1.png" alt="hero images" class="img-fluid col-md-6 d-none d-md-block">
    <div class="col-md-6 mt-4">
        <h1 class="text-white fw-bolder mt-5 pt-4" >Foto <span style="color: #FE5C04">Copy</span> </br>Center</h1>
        <p class="text-white">Menyediakan berbagai produk layanan percetakan, Stempel Flash, Jilid, Undangan, Alat Tulis Kantor, dll.</p>
        <a href="#" class="btn rounded-pill text-white px-4 py-2 mt-3" style="background-color: #FE5C04" data-toggle="modal" data-target="#myModal">
            <img src="/images/whatsapp(1).png" alt="" style="width: 25px"> Beli Sekarang
        </a>        
    </div>
</section>
{{-- hero 2 --}}
<section class="container mx-auto row section2 mt-5">
        <h1 class="fw-bolder text-white text-center">Kenapa Harus Memilih Master Cell</h1>
    <div class="row mt-5 d-flex justify-content-center">
        <img src="/images/Frame4.png" alt="" class="img-fluid">
    </div>
</section>
{{-- hero 3 --}}
<section id="product" class="container mx-auto row section3 mt-5">
    <h1 class="fw-bolder text-white text-center">Produk Kami</h1>
    <div class="konten-produk row mt-5 d-flex justify-content-center gap-5">

        <div class="card text-white" style="width: 17rem; background-color: #322D2D">
            <img src="/images/product.png" class="card-img-top" alt="...">
            <div class="card-body">
                <div class="row">
                    <h5 class="card-title col-md-9">Undangan Kertas</h5>
                    <h5 class="card-title col-md-3">1K</h5>
                </div>
              <p class="card-text">Minimal pembelian 200 pcs, tersedia 10 variasi, PO 3-5 hari</p>
              <a data-toggle="modal" data-target="#myModal" class="btn text-white rounded-pill w-100" style="background-color: #FE5C04;"><img src="/images/whatsapp(1).png" alt="" style="width: 25px"> Beli Sekarang</a>
            </div>
        </div>

        <div class="card text-white" style="width: 17rem; background-color: #322D2D">
            <img src="/images/product.png" class="card-img-top" alt="...">
            <div class="card-body">
                <div class="row">
                    <h5 class="card-title col-md-9">Undangan Kertas</h5>
                    <h5 class="card-title col-md-3">1K</h5>
                </div>
              <p class="card-text">Minimal pembelian 200 pcs, tersedia 10 variasi, PO 3-5 hari</p>
              <a data-toggle="modal" data-target="#myModal" class="btn text-white rounded-pill w-100" style="background-color: #FE5C04;"><img src="/images/whatsapp(1).png" alt="" style="width: 25px"> Beli Sekarang</a>
            </div>
        </div>

        <div class="card text-white" style="width: 17rem; background-color: #322D2D">
            <img src="/images/product.png" class="card-img-top" alt="...">
            <div class="card-body">
                <div class="row">
                    <h5 class="card-title col-md-9">Undangan Kertas</h5>
                    <h5 class="card-title col-md-3">1K</h5>
                </div>
              <p class="card-text">Minimal pembelian 200 pcs, tersedia 10 variasi, PO 3-5 hari</p>
              <a data-toggle="modal" data-target="#myModal" class="btn text-white rounded-pill w-100" style="background-color: #FE5C04;"><img src="/images/whatsapp(1).png" alt="" style="width: 25px"> Beli Sekarang</a>
            </div>
        </div>

        
    </div>
</section>

{{-- modal --}}
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="myModalLabel">Modal title</h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <h3>Hubungi Melalui Wa berikut :</h1>
            <a href="https://wa.me/6281333332321" class="text-decoration-none text-black">
                <div class="d-flex align-items-center gap-2 no1">
                    <img src="/images/whatsapp(1).png" alt="" style="width: 25px">
                    <p class="pt-3">081333332321</p>
                </div>
            </a>
            <a href="https://wa.me/6285204933611" class="text-decoration-none text-black">
                <div class="d-flex align-items-center gap-2 no1">
                    <img src="/images/whatsapp(1).png" alt="" style="width: 25px">
                    <p class="pt-3">085204933611</p>
                </div>
            </a>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  

@endsection
@section('footer')
  {{-- footer --}}
  <footer id="contact" class="row border-top border-white mt-5 pt-5">
    <div class="information d-flex justify-content-between">
        <div class="left-information ms-4 text-white">
            <h3>Master Cell</h3>
            <p style="color: #A8A8A8">
                Master Cell merupakan percetakan yang sudah </br> berdiri sejak tahun 2010.</br> 
                Master Cell menyediakan jasa percetekan,</br> pembuatan stampel Flash, Penjilidan dll 
            </p>
        </div>
        <div class="right-information d-flex   flex-column gap-2 ">
            <div class="telephone d-flex align-items-center gap-2 fw-bolder text-white">
                <img src="/images/telephone.png" alt="">
                <p>081333332321 - 085204933611</p>
            </div>  
            <div class="email d-flex align-items-center gap-2 fw-bolder text-white">
                <img src="/images/Email.png" alt="">
                <p>Suhaririyanto2@gmail.com</p>
            </div> 
            <div class="location d-flex align-items-center gap-2 fw-bolder text-white">
                <img src="/images/Location.png" alt="">
                <div class="text">
                    <p>Jl. Raya Pakem Depan Smpn 1 Pakem,</p>
                    <p>Jl. Raya Wringin Pasar Depan SDn 1 Wringin</p>
                </div>
            </div>
        </div>
    </div>
    <p class="text-white text-center mt-4">© 2024, All RIghts Reserved</p>
</footer>

@endsection