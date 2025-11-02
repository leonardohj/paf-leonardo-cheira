@extends('layouts.app')

@section('body')

<div class="px-5 py-2 w-full">
  <div class="flex w-full flex-wrap flex-row  justify-center md:justify-start gap-3" >
    @if(isset($feeders))
        @foreach($feeders as $feeder)
        <div class="items-center w-full max-w-md border-gray-50 border justify-between gap-6 p-4 bg-white rounded-2xl shadow-md">
          {{ $feeder->nome }}
            </div>
        @endforeach
    @endif
  </div>

<div class="flex justify-center items-center">
  
<div class="flex flex-col md:flex-row items-center max-w-3xl border-gray-50 border justify-between gap-6 p-4 bg-white rounded-2xl shadow-md">
 {{--  @if(empty($feeder))
  <div class="flex flex-col m-2 p-2 justify-between items-center text-center md:text-left md:items-start flex-1">
    <h2 class="text-lg font-semibold text-gray-800">
      Não tens um alimentador associado à tua conta?
    </h2>
    <p class="text-gray-600 mb-4">
      Associa um alimentador para começares a monitorizar e gerir a alimentação facilmente.
    </p>
    <button id="buttonAssociateFeeder" class="bg-black hover:bg-gray-800 transition-colors  w-full text-white font-medium px-6 py-3 rounded-xl">
      Associar alimentador
    </button>
  </div>
  @else --}}

  <form action="{{route('feeder.create')}}" method="POST">
    @csrf
    <button class="bg-black hover:bg-gray-800 transition-colors  w-full text-white font-medium px-6 py-3 rounded-xl"> + Criar feeder</button>
  </form>
</div>
</div>
</div>

<script>
  const buttonAssociateFeeder = document.getElementById('buttonAssociateFeeder');
  buttonAssociateFeeder.addEventListener('click', openModalAssociateFeeder);
</script>
@endsection