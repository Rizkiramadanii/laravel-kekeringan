@extends('layouts.auth')

@section('title', 'Login')


@section('content')
<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container-guest">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header"><h3 class="text-center font-weight-light my-4">Masuk</h3></div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('processLogin') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputEmailAddress">Email</label>
                                        <input class="form-control py-4" id="inputEmailAddress" name="email" type="email" placeholder="Masukkan alamat email" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputPassword">Kata Sandi</label>
                                        <input class="form-control py-4" id="inputPassword" name="password" type="password" placeholder="Masukkan kata sandi" required>
                                    </div>
                                    <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                        <button class="btn btn-primary" type="submit">Masuk</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <div id="layoutAuthentication_footer">
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid">
                <div class="text-muted" style="position: absolute; bottom: 0; width: 100%; text-align: center; color: white; padding: 10px; ">
                    Hak Cipta &copy; Prediksi Kekeringan 2025
                </div>
                
            </div>
        </footer>
    </div>
</div>
@endsection