@extends('layouts.auth')

@section('body')
<div class="flex-1 flex">
    <div class="flex-1 min-h-0 bg-white ">
        <div class="bg-gray-50">
            <div class="bg-white w-full rounded-tr-full h-5"></div>
        </div>
        <div class="flex justify-center items-center py-10">
            <form action="{{ route('login') }}" method="POST" class="w-full max-w-2xl">
                @csrf
                <div class="px-6 flex flex-col justify-center items-center gap-4">
                    <div class="text-3xl font-semibold w-full mb-5 text-left">Login</div>

                    <x-input name="email" label="Email" type="email" placeholder="Enter your email address"/>

                    <x-input name="password" label="Password" type="password" placeholder="Enter your password"/>

                    @if ($errors->has('credentials'))
                    <div class="font-semibold w-full text-left">
                        <p class="text-red-500 text-sm text-left">{{ $errors->first('credentials') }}</p>
                    </div>
                    @endif

                    <button 
                        type="submit"
                        class="text-white py-2 px-3 bg-gray-900 w-full max-w-2xl rounded-full cursor-pointer text-center mt-5 hover:bg-gray-800 transition-all duration-300"
                    >
                        Login
                    </button>

                    <div class="text-sm text-gray-700 mt-3 text-center">
                        New here? <a href="{{ route('register') }}" class="underline">Create an account</a>
                    </div>
                </div>
            </form>
            </div>
        </div>
    <div class="hidden lg:flex flex-1 min-h-0 bg-gray-50 justify-center items-center flex-col">
        <div class="">
            <img src="{{asset('img/en/login.png')}}" alt="">
        </div>
        <div class="flex-1 w-full min-h-0 bg-gray-200">
        </div>
    </div>
</div>
@endsection



