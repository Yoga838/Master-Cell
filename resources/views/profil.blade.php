@extends('base')

@section('title', 'Profil')
@section('content')
    <section class="row justify-content-center">
        <div class="col-xl-3 mb-3 d-flex flex-column bg-dark align-items-center p-4">
            <img src="/images/user.png" alt="" class="img-fluid" style="width: 75%;filter: invert(100%) brightness(200%);">
            <h5 class="mt-2 font-weight-bold">{{ $data->name }}</h3>
            <h5>{{ $data->username }}</h5>
        </div>
        <div class="col-xl-8 ml-3 p-3 bg-dark">
            <div class="row">
                <form action="{{ route('update-profil', $data->id) }}" method="post" style="width: 100%">
                    @csrf
                    @method('PUT')
                    {{-- @foreach($data as $item) --}}
                    <div class="form-group">
                        <label for="username">Nama</label>
                        <input type="text" class="form-control" name="name" id="username" value="{{ $data->name }}" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <label for="Username">Username</label>
                        <input type="text" class="form-control" name="username" id="Username" value="{{ $data->username }}" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                    </div>
                    {{-- @endforeach --}}
                    <div class="d-flex to-right justify-content-end">
                        <a  href="{{ route('dashboard') }}" class="btn btn-danger">Batal</a>
                        <button type="submit" class="ml-2 btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
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
    </script>
@endpush
