<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>paf</title>
</head>
<div id="append">
    <x-header/>
</div>
<body>
    <div class="p-4">
        @yield('body')
    </div>
</body>
</html>