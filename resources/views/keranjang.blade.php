@extends('base')

@section('title', 'Keranjang')

@section('content')
    <section class="container">
        <div class="container-fluid">
            <div class="row d-flex justify-content-end mb-2">
                <button class="btn btn-success mx-2 d-flex align-items-center " type="button" id="btnCheckout">
                    <ion-icon name="bag-check-outline"></ion-icon> Checkout
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

@push('script')
<script>
    $(document).ready(function() {
    $("#btnCheckout").click(function(){
            Swal.fire({
                title : 'Apakah Anda Yakin ?',
                text : "Anda Akan Mencheckout Semua Barang Yang Ada Di Keranjang",
                icon : 'warning',
                showCancelButton : true,
                confirmButtonColor : '#28a745',
                cancelButtonColor : '#3085d6',
                confirmButtonText : "Ya, Checkout!"
            }).then((result) => {
                if(result.isConfirmed){
                   $.ajax({
                    type: "POST",
                    url: "{{ route('checkout') }}",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success : function(response) {
                        Swal.fire({ 
                            title : "Sukses !",
                            text : "Berhasil Mencheckout Barang!",
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
<script>
    $(document).ready(function() {
    $(".deleteBtn").click(function(){
        var barang_model_id = $(this).data('id');
        var user_id = "{{ Auth::user()->id }}";
            Swal.fire({
                title : 'Apakah Anda Yakin ?',
                text : "Anda tidak akan dapat mengembalikan ini!",
                icon : 'warning',
                showCancelButton : true,
                confirmButtonColor : '#d33',
                cancelButtonColor : '#3085d6',
                confirmButtonText : "Ya, Hapus Item!"
            }).then((result) => {
                if(result.isConfirmed){
                   $.ajax({
                    type: "POST",
                    url: "{{ route('delete-chart') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        barang_model_id : barang_model_id,
                        user_id : user_id
                    },
                    success : function(response) {
                        Swal.fire({ 
                            title : "Sukses !",
                            text : "Item Berhasil Dihapus!",
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