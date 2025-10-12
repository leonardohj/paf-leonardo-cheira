@extends('layouts.app')

@section('body')
<div>
    <form action="/changeVariables" method="POST">
        @csrf
        <div class="max-w-60 p-1 bg-white border border-gray-300 rounded">
            <input inputmode="numeric" type="numbers" name="id_feeder" placeholder="Quantidade em gramas" class="p-1 outline-none">
        </div>
        <div class="max-w-60 p-1 bg-white border border-gray-300 rounded">
            <input type="time" name="time" class="p-1 outline-none">
        </div>
        <button type="submit" class="p-5 bg-blue-500"></button>
    </form> 
</div>
@endsection