<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>You&Me Shop - Login</title>
    <link rel="icon" type="image/x-icon" href="{{asset('assets/img/logo31.jpg')}}"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/ltr/css/plugins.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/ltr/css/authentication/form-1.css')}}" rel="stylesheet" type="text/css" />
    {{--    <!-- END GLOBAL MANDATORY STYLES -->--}}
    <link rel="stylesheet" type="text/css" href="{{asset('assets/ltr/css/forms/theme-checkbox-radio.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/ltr/css/forms/switches.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900;1000&display=swap" rel="stylesheet">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=DM+Sans&display=swap');
        body{
            font-family: 'Poppins', sans-serif;
        }
        .form-content{
            background-color: white;padding: 30px;border-radius: 13px;
        }
        .switch.s-primary .slider:before {
            background-color:  #e96525;
        }
        .col-form{
            /*border: 2px #060000a8 solid;*/
            border-radius: 6%;
            padding: 2%;
            box-shadow:  #e96525 0px 0px 8px;
            background-color: white;
        }
        .switch.s-primary input:checked + .slider {
            background-color:  #e96525;
        }
    </style>
</head>
<body class="form" >

<x-auth-session-status class="mb-4" :status="session('status')" />

<div class="container">
    <div class="row justify-content-center py-5">
        <div class="col-lg-5 col-md-7 col-sm-9 col-12 col-form" >
            <!--messages errors -->
            <div class="row justify-content-center mt-1">
                <div class="col-12">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li style="text-align: left;">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
            <!--img logo-->
            <img src="{{asset('assets/img/logo31.jpg')}}" style="margin:auto;display: block;width: 70%;height: 30vh; !important ;padding: 3px;" alt="logo">
            <!--login form-->
            <div class="form" style="padding-top: 7%;padding-right: 7%;padding-left: 7%;padding-bottom: 0%;">
                <form method="POST" action="{{ route('login') }}">
                @csrf
                <!--email-->
                    <div id="username-field" class="field-wrapper input mb-4 d-flex" style="align-items: center;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user" style="color: #e96525  !important;"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        <input style="margin-right: 2%;" id="email" type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!--password-->
                    <div id="password-field" class="field-wrapper input mb-2 d-flex" style="align-items: center;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock" style="color: #e96525  !important;"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                        <input style="margin-right: 2%;" id="password" name="password" type="password" class="form-control" placeholder="Password" required autocomplete="current-password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!--show password button and login button-->
                    <div class="row">
                        <div class="col">
                            <div class="field-wrapper toggle-pass" style="margin-bottom: 5% !important;float: left">
                                <p class="d-inline-block" style="margin-bottom: 10px !important;">Show Password</p>
                                <label class="switch s-primary" style="margin: -6px 15px;">
                                    <input type="checkbox" id="toggle-password" class="d-none" style="display: none;">
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div style="text-align: center">
                                <button type="submit" class="btn btn-primary" value="" style="box-shadow: #1848a3  0px 1px 8px;border: 0;background-color: #1848a3  !important; border-color:  #1848a3  !important;">Login</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!--copy right-->
            <div class="row justify-content-center terms-conditions" style="margin-top: 5% !important;text-align: center !important;">
                <div class="col-8" style="color: black;">
                    All rights reserved © 2023
                </div>
            </div>
        </div>
    </div>
</div>

<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
<script src="{{asset('assets/ltr/js/libs/jquery-3.1.1.min.js')}}"></script>
<script src="{{asset('assets/bootstrap/js/popper.min.js')}}"></script>
<script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>

<!-- END GLOBAL MANDATORY SCRIPTS -->
<script src="{{asset('assets/ltr/js/authentication/form-1.js')}}"></script>

</body>
</html>
