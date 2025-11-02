@extends('layouts.auth')

@section('body')
<div class="flex flex-1 h-screen overflow-hidden">
    <div class="flex-1 bg-white min-h-0">
        <div class="bg-gray-50">
            <div class="bg-white w-full rounded-tr-full h-5"></div>
        </div>
        <div class="w-full max-w-2xl px-6 flex justify-center items-center">
            <form action="register/store" method="POST" class="flex flex-col gap-4 w-full">
                @csrf
                <div class="text-3xl font-semibold mb-5 text-left">Register</div>

                <x-input name="name" label="Username" type="text" placeholder="Enter your username"/>
                <x-input name="email" label="Email" type="email" placeholder="Enter your email address"/>
                <x-input name="password" label="Password" type="password" placeholder="Enter your password"/>
                <x-input name="password_confirmation" label="Confirm Password" type="password" placeholder="Confirm your password"/>

                <button type="submit" class="text-white py-2 px-3 bg-gray-900 w-full rounded-full cursor-pointer text-center mt-5 transition hover:bg-gray-800">
                    Register
                </button>

                <div class="text-sm text-gray-700 mt-3 text-center">
                    Already have an account? <a href="/sign-in" class="underline text-gray-900 hover:text-gray-700">Log in</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Right Section: Illustration -->
    <div class="hidden lg:flex flex-1 min-h-0 bg-gray-50 justify-center items-center flex-col">
        <img src="{{ asset('img/en/register.png') }}" alt="Register illustration" class="max-h-screen object-contain">
        <div class="flex-1 w-full bg-gray-200"></div>

    </div>
</div>
@endsection
