@extends('layouts.app')

@section('content')
<div class="mx-auto h-full flex justify-center items-center bg-gray-200">
    <div class="w-96 bg-blue-900 rounded-lg shadow-xl p-6">
        {{--  LOGO  --}}
        <svg class="fill-current text-white w-20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path d="M3.9 4.2c-.5 0-.8.3-.8.8s.4.8.8.8c.5 0 .8-.4.8-.8.1-.5-.3-.8-.8-.8zM3.3 18.6c0 1.4-.2 2.1-1.5 2.1-.3 0-.7 0-.9-.1l-.3 1.1c.3.1.7.2 1.1.2 1.9 0 2.7-1.2 2.7-3.2V8.1H3.3v10.5zM9.4 17.5c1.4 0 2.3-.4 3-1.2.8-1 1.1-2.1 1.1-3.8 0-1.4-.2-2.7-1-3.5-.6-.7-1.5-1.1-2.9-1.1s-2.3.4-3 1.2c-.8 1-1.1 2.2-1.1 3.8 0 1.5.2 2.6 1 3.5.6.7 1.5 1.1 2.9 1.1zM7.5 9.7c.3-.4.9-.8 2-.8 1 0 1.6.3 1.9.7.5.6.7 1.7.7 2.9s-.2 2.4-.7 3.1c-.3.4-.9.8-2 .8-1 0-1.6-.3-1.9-.7-.5-.6-.7-1.6-.7-2.9 0-1.2.2-2.4.7-3.1zM15 14.4c0 2.1.4 3.1 2.5 3.1.6 0 1.3-.1 1.8-.2l-.1-1c-.5.1-1 .2-1.5.2-1.4 0-1.5-.6-1.5-2.1v-5h3V8.3h-3v-3l-1.2.2v2.7h-1.8v1.1H15v5.1zM6 18h17v1H6z"/>
        </svg>
        {{--  LOGO  --}}
        {{--  Greeting  --}}
        <h1 class="text-white text-3xl">Welcome back</h1>
        <h2 class="text-blue-300 pt-1">Enter your credentials</h2>
        {{--  Greeting  --}}
        {{--  FORM  --}}
        <form method="POST" action="{{ route('login') }}" class="pt-2">
            @csrf

            <div class="relative">
                <label for="email" class="uppercase text-blue-500 text-xs font-bold absolute pl-3 pt-2">{{ __('E-Mail Address') }}</label>
                <div class="">
                    <input
                    id="email"
                    type="email"
                    class="pt-8 w-full p-3 bg-blue-800 text-gray-100 outline-none focus:bg-blue-700 rounded @error('email') is-invalid @enderror"
                    name="email"
                    value="{{ old('email') }}"
                    autocomplete="off"
                    placeholder="Enter your email"
                    autofocus
                    >

                    @error('email')
                        <span class="invalid-feedback pt-1 pl-3 text-red-600 text-sm" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="mt-2 relative">
                <label for="password" class=" uppercase text-blue-500 text-xs font-bold absolute pl-3 pt-2">{{ __('Password') }}</label>

                <div class="col-md-6">
                    <input id="password"
                    type="password"
                    class="pt-8 w-full p-3 bg-blue-800 text-gray-100 outline-none focus:bg-blue-700 rounded   @error('password') is-invalid @enderror"
                    name="password"
                    autocomplete="off"
                    placeholder="Enter password"
                    >
                    @error('password')
                        <span class="invalid-feedback pt-1 pl-3 text-red-600 text-sm" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="pt-2">
                <div class="full-width">
                    <div class="">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="text-white " for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>
            </div>
            <div class="flex p-2">
                    <button type="submit" class="w-full bg-gray-400 text-blue-800 py-2  px=3 uppercase rounded text-gray-100 font-blod">{{ __('Login') }}</button>
            </div>
            <div class="flex pt-8 text-white justify-between">
                <a class="text-white text-sm font-bold hover:text-blue-300" href="{{ route('register') }}">{{ __('Register') }}</a>
                <a class="text-white text-sm font-bold hover:text-blue-300" href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
            </div>
        </form>
        {{--  FORM  --}}
    </div>
</div>
@endsection
