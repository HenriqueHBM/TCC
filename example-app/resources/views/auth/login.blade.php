@extends('layouts.app')
@section('title', 'ForLife')
@section('content')
{{-- <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script> --}}
<x-mensagem />
    <main class="main">
        
        <div class="container bg-light card-produto rounded-2 p-3" style="width: 600px">
            <form method="POST" action="{{ route('login') }}">

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                
                @csrf
                <div class="row pt-3 text-center">
                    <h4>Logar</h4>
                </div>

                <hr>

                <!-- Email Address -->
                <div class="row mt-3">
                    <div class="col-md-6 form-group">
                        <label for="email">Email</label>
                        <input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus>
                    </div>
                </div>

                <!-- Password -->
                <div class="row mt-3">
                    <div class="col-md-6 form-group">
                        <label for="password">Senha</label>
                        <input id="password" class="form-control"
                                    type="password"
                                    name="password"
                                    required autocomplete="current-password">
                    </div>
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="row px-3 py-1 justify-content-end">
                    @if (Route::has('password.request'))
                        <a class="underline col-md-4 text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                    <button class="btn btn-primary col-sm-4 save_edit">
                            {{ __('Log in') }}
                    </button>
                </div>
            </form>
        </div>
    </main>
@endsection
