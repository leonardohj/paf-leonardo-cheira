@extends('layouts.auth')

@section('body')
<div class="flex-1 flex">
    <div class="flex-1 min-h-0 bg-white ">
        <div class="bg-gray-50">
            <div class="bg-white w-full rounded-tr-full h-5"></div>
        </div>
        <div class="flex justify-center items-center py-10">
            <form action="login/login" method="POST" class="w-full max-w-2xl">
                @csrf
                <div class="px-6 flex flex-col justify-center items-center gap-4">
                    <div class="text-3xl font-semibold w-full mb-5 text-left">Sign in</div>
            
            <x-input name="email" label="Email" type="email" placeholder="Enter your email address"/>

            <x-input name="password" label="Password" type="password" placeholder="Enter your password"/>
            
            <div class="text-white py-2 px-3 bg-gray-900 w-full max-w-2xl rounded-full text-center mt-5">
                <button>Sign in</button>
            </div>
            <div class="text-sm text-gray-700 mt-3 text-center">
                New here? <a href="/register" class="underline">Create an account</a>
            </div>
            </div>
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
