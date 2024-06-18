@extends('navbar')
@section('content')
    <section class="container mx-auto row mt-5 d-flex justify-content-between">
        <img src="/images/login hero.png" alt="hero" class="img-fluid col-md-5 d-none d-md-block"> 
        <div class="form-input col-md-4 text-white p-4 rounded" style="background-color: rgba(255, 255, 255, 0.3); font-family: 'Open Sans', sans-serif">
            <form action="{{ route('login') }}" method="post">
                @csrf
                <h3 class="text-center">Selamat Datang</h3>
                <h1 class="text-center fw-bold">Masuk Ke akun Anda</h1>
                <div class="mb-3">
                    <label for="Username" class="form-label">Username</label>
                    <input type="Username" name="username" class="form-control border-0 custom-placeholder text-white" placeholder="masukkan username anda" id="Username" style="background-color: #1E1C1C" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control border-0 custom-placeholder text-white" placeholder="masukkan password anda" id="password" style="background-color: #1E1C1C" required>
                </div>
                <button type="submit" class="btn text-white rounded-pill w-100 fw-bolder" style="background-color: #FE5C04">Login</button>
            </form>
        </div>
    </section>
@endsection

@push('script')
<script>
    @if(Session('error'))
        Swal.fire({
            icon : 'error',
            title : 'Oops...',
            text : "{{ Session('error') }}"
        })
    @endif
</script>
@endpush