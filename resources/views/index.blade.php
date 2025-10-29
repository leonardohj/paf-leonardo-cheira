@extends('layouts.app')

@section('body')
<div class="px-5 py-2 flex justify-center items-center">
<div class="flex flex-col md:flex-row items-center max-w-3xl border-gray-50 border justify-between gap-6 p-4 bg-white rounded-2xl shadow-md">
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
</div>
</div>

<script>
  const buttonAssociateFeeder = document.getElementById('buttonAssociateFeeder');
  buttonAssociateFeeder.addEventListener('click', openModalAssociateFeeder);
</script>
@endsection