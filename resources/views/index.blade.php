@extends('layouts.app')

@section('body')
@if(session('FeederAssociated'))
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
@else
<div class="p-5 shadow-sm rounded-lg text-center flex flex-col max-w-3xl justify-center items-center size-full h-50">
    Não tem nenhum feeder associado a sua conta!
    <button onclick="openModalAssociate()" class="mt-5 bg-gray-700 p-3 rounded text-white font-semibold cursor-pointer">Associar Feeder</button>
    
</div>
@endif
@endsection