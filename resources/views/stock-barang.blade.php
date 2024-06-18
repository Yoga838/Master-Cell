@extends('base')
@section('title', 'Stock Barang')

@push('css')
<style>
    .product-card {
        transition: transform 0.3s, opacity 0.3s;
    }

    .product-card.highlight {
        transform: scale(1.05);
    }

    .product-card.fade-out {
        opacity: 0;
        pointer-events: none;
    }
    /* .quantity-input {
            display: flex;
            align-items: center;
        } */
        /* .quantity-input input[type="number"] {
            width: 10px;
        } */
</style>
@endpush

@section('content')
    <section class="container">
        <div class="container-fluid">
            @if(Auth::user()->role == 'admin')
            <div class="row d-flex justify-content-end mb-2">
                <button class="btn btn-primary mx-2 d-flex align-items-center " type="button" data-toggle="modal" data-target="#modalTambah">
                    <ion-icon name="add-outline"></ion-icon> Tambah Barang Baru
                </button>
                <button onclick="window.location.href='/stock-barang/export'" class="btn btn-primary d-flex align-items-center" type="button" aria-expanded="false" onclick="window.location.href='/export-users'">
                    <ion-icon name="download-outline"></ion-icon> Ekspor
                </button>
            </div>
        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Barang</th>
                    <th>Harga Ambil</th>
                    <th>Harga Jual</th>
                    <th>Stok</th>
                    <th>foto produk</th>
                    <th>edit</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nama_barang }}</td>
                        <td>{{ $item->Harga_ambil }}</td>
                        <td>{{ $item->Harga_jual }}</td>
                        <td>{{ $item->stok }}</td>
                        <td ><img src="{{ asset('fotoproduk/'.$item->foto_produk) }}" alt="foto produk" width="100px"></td>
                        <td class="d-flex gap-4">
                            <button class="btn btn-primary d-flex align-items-center" type="button" aria-expanded="false" data-toggle="modal" data-target="#modalEdit{{ $item->id }}">
                                <ion-icon name="create-outline"></ion-icon>
                            </button>
                            <button class="btn btn-danger waves-effect deleteBtn d-flex align-items-center" data-id="{{ $item->id }}"><ion-icon name="trash-outline"></ion-icon></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @endif
        @if(Auth::user()->role == 'pegawai')
        <div class="row d-flex justify-content-end mb-2">
            <a  href="/keranjang" class="btn btn-primary mx-2 d-flex align-items-center" type="button">
                <ion-icon name="basket"></ion-icon> Keranjang
            </a>
        </div>        
        <input id="search-input" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        
        <div class="row mt-4" id="product-container">
            @foreach ($data as $item)
            <div class="card m-3 rounded product-card" style="width: 18rem;">
                <img class="card-img-top mx-auto mt-2" src="{{ asset('fotoproduk/'.$item->foto_produk) }}" style="height: 175px; width:175px" alt="Card image cap">
                <div class="card-body">
                  <h5 class="card-title font-weight-bold product-name">{{$item->nama_barang}}</h5>
                  <p class="card-text">Rp. {{ $item->Harga_jual }} / pcs <br/>
                    Stok : {{ $item->stok }}
                  </p>
                  <div class="button-to-right d-flex justify-content-end">
                        <form action="" method="">
                            <a href="#" type="submit" class="add-to-cart" data-id="{{ $item->id }}">
                                <ion-icon class="text-primary" size="large" name="add-circle"></ion-icon>
                            </a>
                        </form>
                        <input type="number" id="quantity" style="width: 60px" class="form-control" value="1" min="1">
                  </div>
                </div>
            </div>
            @endforeach
        </div>        
        
        </div>
        @endif

        </div>
    </section>

        {{-- modal tambah --}}
        <div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="modalTambahLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modalTambahLabel">Tambah Barang Baru</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="{{ route('add-barang') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="input-group mb-3 d-flex flex-column">
                            <label for="nama-barang" class="form-label">nama barang</label>
                            <input class="form-control w-100" type="text" name="nama_barang" id="nama-barang" required>
                        </div>
                        <div class="input-group mb-3 d-flex flex-column">
                            <label class="form-label" for="Harga-ambil">Harga Ambil</label>
                            <input class="form-control w-100" type="number" name="Harga_ambil" id="Harga-ambil" required>
                        </div>
                        <div class="input-group mb-3 d-flex flex-column">
                            <label class="form-label" for="Harga-jual">Harga Jual</label>
                            <input class="form-control w-100" type="text" name="Harga_jual" id="Harga-jual" required>
                        </div>
                        <div class="input-group mb-3 d-flex flex-column">
                            <label class="form-label" for="stok">stok</label>
                            <input class="form-control w-100" type="number" name="stok" id="stok" required>
                        </div>
                        <div class="input-group mb-3 d-flex flex-column">
                            <label class="form-label" for="foto-produk">foto produk</label>
                            <input class="file-upload-field" type="file" accept="image/*" name="foto_produk" id="foto-produk" required>
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
        @foreach ($data as $item)
        <div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modalEditLabel">Tambah Barang Baru</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="{{ route('update-barang', $item->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="input-group mb-3 d-flex flex-column">
                            <label for="nama-barang" class="form-label">nama barang</label>
                            <input class="form-control w-100" type="text" name="nama_barang" id="nama-barang" required value="{{ $item->nama_barang  }}">
                        </div>
                        <div class="input-group mb-3 d-flex flex-column">
                            <label class="form-label" for="Harga-ambil">Harga Ambil</label>
                            <input class="form-control w-100" type="number" name="Harga_ambil" id="Harga-ambil" required value="{{ $item->Harga_ambil  }}">
                        </div>
                        <div class="input-group mb-3 d-flex flex-column">
                            <label class="form-label" for="Harga-jual">Harga Jual</label>
                            <input class="form-control w-100" type="text" name="Harga_jual" id="Harga-jual" required value="{{ $item->Harga_jual  }}">
                        </div>
                        <div class="input-group mb-3 d-flex flex-column">
                            <label class="form-label" for="stok">stok</label>
                            <input class="form-control w-100" type="number" name="stok" id="stok" required value="{{ $item->stok  }}">
                        </div>
                        <div class="input-group mb-3 d-flex flex-column">
                            <label class="form-label" for="foto-produk">foto produk</label>
                            <input class="file-upload-field" type="file" accept="image/*" name="foto_produk" id="foto-produk">
                        </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Perbarui</button>
                    </div>
                </form>
              </div>
            </div>
          </div>
        @endforeach
@endsection

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

        $(document).ready(function() {
            // Handle delete button click
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
                        url: "{{ route('delete-barang') }}",
                        data: {
                            _token: "{{ csrf_token() }}",
                            id : id
                        },
                        success : function(response) {
                            console.log(response);
                            Swal.fire({ 
                                title : "Sukses !",
                                text :  response.success ,
                                icon : "success"
                            }).then((result) => {
                                location.reload();
                            })
                        },
                        error : function(error) {
                            Swal.fire({
                                icon : 'error',
                                title : 'Oops...',
                                text : response.error
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
                })
            });

            // Handle add to cart button click
            $(".add-to-cart").click(function(e){
                e.preventDefault();
                var barang_model_id = $(this).data('id');
                var quantity = $(this).closest('.product-card').find('input#quantity').val();

                $.ajax({
                    type: "POST",
                    url: "{{ route('add-chart') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        user_id: "{{ Auth::user()->id }}",
                        barang_model_id: barang_model_id,
                        quantity: quantity
                    },
                    success: function(response) {
                        Swal.fire({
                            title: "Sukses !",
                            text: response.success,
                            icon: "success"
                        });
                    },
                    error: function(error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: "Terjadi Kesalahan!"
                        });
                    }
                });
            });
        });

        // Handle search input
        document.getElementById('search-input').addEventListener('keyup', function() {
            var searchQuery = this.value.toLowerCase();
            var productCards = document.querySelectorAll('.product-card');

            productCards.forEach(function(card) {
                var productName = card.querySelector('.product-name').textContent.toLowerCase();
                if (productName.includes(searchQuery)) {
                    card.classList.remove('fade-out');
                    card.classList.add('highlight');
                } else {
                    card.classList.remove('highlight');
                    card.classList.add('fade-out');
                }
            });
        });

        // Handle quantity increment and decrement
        function decrementQuantity() {
            var quantityInput = document.getElementById('quantity');
            var currentValue = parseInt(quantityInput.value);
            if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
            }
        }

        function incrementQuantity() {
            var quantityInput = document.getElementById('quantity');
            var currentValue = parseInt(quantityInput.value);
            quantityInput.value = currentValue + 1;
        }
    </script>
@endpush
