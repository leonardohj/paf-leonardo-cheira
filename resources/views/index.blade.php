@extends('layouts.app')

@section('body')
<div>
    <form action="" method="POST">
        @csrf
        <div class="max-w-60 p-1 bg-white border border-gray-300 rounded">
            <input inputmode="numeric" type="numbers" name="gramas" placeholder="Quantidade em gramas" class="p-1 outline-none">
        </div>
        <div class="max-w-60 p-1 bg-white border border-gray-300 rounded">
            <input type="date" name="data" class="p-1 outline-none">
        </div>
    </form> 
</div>
@endsection