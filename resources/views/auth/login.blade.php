@extends('layouts.app')
@section('content')
    <div id="app">

        <!-- Form-->
        <div class="form">
            <div class="form-toggle"></div>
            <div class="form-panel one">
                <div class="form-header">
                    <h1>Account Login</h1>
                </div>
                <div class="form-content">
                    <form>
                        <div class="form-group">
                            <label for="username">Email or Phone number</label>
                            <input id="username" type="text" name="username" required="required"/>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input id="password" type="password" name="password" required="required"/>
                        </div>
                        <div class="form-group">
                            <label class="form-remember">
                                <input type="checkbox"/>Remember Me
                            </label><a class="form-recovery" href="#">Forgot Password?</a>
                        </div>
                        <div class="form-group">
                            <button type="submit">SIGN In</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="form-panel two">
            </div>
        </div>

        <div class="pen-footer">
            <a href="/"><i class="material-icons">arrow_backward</i>Home</a>
            <a href="/register">Don't have account? Register<i class="material-icons">arrow_forward</i></a></div>
    </div>
@endsection

@push('style')
    <link rel="stylesheet" href="{{url('/css/auth.css')}}">
@endpush
