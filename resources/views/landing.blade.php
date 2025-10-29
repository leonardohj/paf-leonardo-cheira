<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    @yield('scripts')
    <title>paf</title>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
</head>
<div class="border-b-1 border-gray-300">
    <x-header2/>
</div>
<div class="justify-center flex flex-col items-center mx-5 md:mx-15 my-6 gap-4">
    <div class="text-black flex items-center">
        <img src="{{ asset('img/logo_paf.png') }}" alt="" class="h-10 lg:h-12">
    </div>
    <div class="text-black  text-center text-4xl lg:text-6xl font-bold">
        Where technology and pet care come together
    </div>
    <div class="text-center md:text-xl px-2 lg:px-40">
        Pet Feeder helps pet owners create convenient feeding schedules they can personalize, manage, and monitor. By combining a web application with an automated device, it empowers owners to ensure their pets are fed on time and maintain a healthy routine.
    </div>
    <div class="flex flex-col md:flex-row gap-3">
        <div class="rounded-full text-center border border-gray-200 py-3 text-gray-900 px-5 bg-white">
            Buy our product
        </div>
        <div class="rounded-full text-center border  bg-gray-900 px-5 py-3 text-white ">
            Sign in
        </div>
    </div>
</div>
</html>