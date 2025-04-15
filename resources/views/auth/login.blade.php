<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Garage Management System') }}</title>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <link id="pagestyle" href="{{ asset('css/login.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <div class="login-card">
                <!-- Loading Overlay -->
                <div class="loading-overlay" id="loading-overlay">
                    <div class="loading-spinner"></div>
                </div>

                <div class="logo">
                    <img src="/api/placeholder/180/60" alt="Garage Management">
                </div>

                <h1>Sign In</h1>
                <p class="subtitle">Access your garage management dashboard</p>

                <x-auth-session-status class="mb-4 error-message" :status="session('status')" />

                <div class="form-area">
                    <form method="POST" action="{{ route('login') }}" id="login-form">
                        @csrf

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control"
                                value="{{ old('email') }}" required autofocus autocomplete="username">
                            <x-input-error :messages="$errors->get('email')" class="error-message" />
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" class="form-control"
                                required autocomplete="current-password">
                            <x-input-error :messages="$errors->get('password')" class="error-message" />
                        </div>

                        <div class="form-check form-switch" >

                            <input class="form-check-input" type="checkbox" id="remember" name="remember">
                            <label class="form-check-label" for="rememberMe">Remember me</label>
                        </div>

                        <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0" id="login-button">
                            <span class="btn-spinner" id="btn-spinner"></span>
                            <span class="btn-text">Sign in</span>
                        </button>
                    </form>
                </div>

                <div class="footer">
                    <p>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">Forgot password?</a>
                        @endif

                        {{-- @if (Route::has('register'))
                            <span class="mx-2">•</span>
                            <a href="{{ route('register') }}">Request access</a>
                        @endif --}}
                    </p>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const loginForm = document.getElementById('login-form');
                const loginButton = document.getElementById('login-button');
                const loadingOverlay = document.getElementById('loading-overlay');


                loginForm.addEventListener('submit', function(e) {

                    loginButton.classList.add('loading');

                    setTimeout(function() {

                        if (loginButton.classList.contains('loading')) {
                            loadingOverlay.classList.add('active');
                        }
                    }, 500);


                });


                if (document.querySelectorAll('.error-message').length > 0) {
                    loginButton.classList.remove('loading');
                    loadingOverlay.classList.remove('active');
                }
            });
        </script>
    </body>
</html>
