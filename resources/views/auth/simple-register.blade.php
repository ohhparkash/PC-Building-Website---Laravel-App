@extends('layouts.site')

@section('title', 'Register')

@section('content')
<section class="py-5" style="background:#0f0f0f; min-height: calc(100vh - 150px);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card border-0 shadow" style="background:#1a1a1a;">
                    <div class="card-body p-4">
                        <h2 class="text-white text-center mb-4">Register</h2>

                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label text-white">Name</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required autofocus>
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-white">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-white">Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-white">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control" required>
                            </div>

                            <button type="submit" class="btn btn-warning text-dark fw-semibold w-100">Register</button>
                        </form>

                        <div class="text-center mt-3">
                            <span class="text-white-50">Already have an account? </span>
                            <a href="{{ route('login') }}" class="text-warning">Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
