@extends('layouts.master')

@section('content')
    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name">FH+</h1>

            </div>
            <h3>Register to FH+</h3>
            <p>Create account to see it in action.</p>
            @if ($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                           name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Name">
                </div>
                <div class="form-group">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                           name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">
                </div>
                <div class="form-group">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                           name="password" required autocomplete="new-password" placeholder="Enter your password">
                </div>

                <div class="form-group">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                           required autocomplete="new-password" placeholder="Repeat password">
                </div>

                <div class="form-group">
                    <div class="checkbox i-checks">
                        <label>
                            <input id="agreement" type="checkbox" class="@error('agreement') is-invalid @enderror"
                                   name="agreement" required>
                            <i></i> Agree the terms and policy
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary block full-width m-b">Register</button>

                <p class="text-muted text-center"><small>Already have an account?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="{{ route('login') }}">Login</a>
            </form>
            <p class="m-t"> <small>Copyright &copy; 2019</small> </p>
        </div>
    </div>
@endsection