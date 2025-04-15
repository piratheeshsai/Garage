{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}


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

                <h1>Forgot Password?</h1>
                <p class="subtitle">{{ __('No problem. Just let us know your email address and we will email you a password reset link') }}</p>

                <x-auth-session-status class="mb-4 error-message" :status="session('status')" />

                <div class="form-area">
                    <form method="POST" action="{{ route('password.email') }}" id="login-form">
                        @csrf

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control"
                                value="{{ old('email') }}" required autofocus autocomplete="email">
                            <x-input-error :messages="$errors->get('email')" class="error-message" />
                        </div>

                        <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0" id="login-button">
                            <span class="btn-spinner" id="btn-spinner"></span>
                            <span class="btn-text">{{ __('Email Password Reset Link') }}</span>
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
