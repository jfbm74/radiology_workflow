<!doctype html>
<html lang="en" dir="ltr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">

<link rel="icon" href="favicon.ico" type="image/x-icon"/>

<title>:: Epic :: Login</title>

<!-- Bootstrap Core and vandor -->
<link rel="stylesheet" href="/admin/assets/plugins/bootstrap/css/bootstrap.min.css" />

<!-- Core css -->
<link rel="stylesheet" href="/admin/assets/css/main.css"/>
<link rel="stylesheet" href="/admin/assets/css/theme2.css"/>

</head>
<body class="font-montserrat">

<div class="auth">
    <div class="auth_left">
        <div class="card">
            <div class="text-center mb-2">
                {{-- <a class="header-brand" href="index.html"><i class="fe fe-command brand-logo"></i></a> --}}
                <img src="/LogoLogin.png" alt="">
            </div>
            <div class="card-body">
                <div class="card-title">{{ __('Login') }} al Portal</div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <input type="email" 
                                    class="form-control @error('email') is-invalid @enderror" 
                                    id="email" 
                                    name="email" 
                                    value="{{ old('email') }}" 
                                    aria-describedby="emailHelp" 
                                    placeholder="{{ __('E-Mail Address') }}"
                                    required 
                                    autocomplete="email" 
                                    autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror 
                        </div>
                        <div class="form-group">
                        <label class="form-label">{{ __('Password') }}</label>
                            
                            <input  type="password" 
                                    id="password"
                                    class="form-control @error('password') is-invalid @enderror" 
                                    name="password" 
                                    placeholder="{{ __('Password') }}"
                                    required 
                                    autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <a href="forgot-password.html" class="float-right small"> {{ __('Forgot Your Password?') }}</a>
                        </div>
                        <div class="form-group">
                            <label class="custom-control custom-checkbox">
                            <input  class="custom-control-input" 
                                    type="checkbox" 
                                    name="remember" 
                                    id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <span class="custom-control-label">{{ __('Remember Me') }}</span>
                            </label>
                        </div>
                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Login') }}
                            </button>
                        {{-- <a href="index.html" class="btn btn-primary btn-block" title=""> {{ __('Login') }}</a> --}}
                    </form>
                </div>
            </div>
        </div>        
    </div>
    <div class="container">
        <img src="/landing.jpeg" class="" alt="login">
    </div>
</div>

<script src="/admin/assets/bundles/lib.vendor.bundle.js"></script>
<script src="/admin/assets/js/core.js"></script>
</body>
</html>


