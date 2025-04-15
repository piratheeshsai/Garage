<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ __('Reset Password') }} - {{ config('app.name', 'Garage Management System') }}</title>

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

                <h1>{{ __('Reset Password') }}</h1>
                <p class="subtitle">{{ __('Create a new password for your account') }}</p>

                <x-auth-session-status class="mb-4 error-message" :status="session('status')" />

                <div class="form-area">
                    <form method="POST" action="{{ route('password.store') }}" id="reset-form">
                        @csrf
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <!-- Email Address -->
                        <div class="form-group">
                            <label for="email">{{ __('Email') }}</label>
                            <input type="email" id="email" name="email" class="form-control"
                                value="{{ old('email', $request->email) }}"
                                required autofocus autocomplete="username">
                            <x-input-error :messages="$errors->get('email')" class="error-message" />
                        </div>

                        <!-- Password -->
                        <div class="form-group">
                            <label for="password">{{ __('Password') }}</label>
                            <input type="password" id="password" name="password"
                                class="form-control" required autocomplete="new-password">
                            <x-input-error :messages="$errors->get('password')" class="error-message" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="form-group">
                            <label for="password_confirmation">{{ __('Confirm Password') }}</label>
                            <input type="password" id="password_confirmation"
                                name="password_confirmation" class="form-control"
                                required autocomplete="new-password">
                            <x-input-error :messages="$errors->get('password_confirmation')" class="error-message" />
                        </div>

                        <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">
                            <span class="btn-text">{{ __('Reset Password') }}</span>
                        </button>
                    </form>
                </div>

                <div class="footer text-center mt-3">
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-gray-900">
                            {{ __('Back to login') }}
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </body>
</html>
