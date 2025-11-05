@extends('layouts.app')

@section('body')
<div class="px-5 py-2 w-full">
    <div class="flex w-full flex-wrap flex-row justify-center gap-3">
        <div class="items-center w-full max-w-md border border-gray-50 justify-between gap-6 p-4 bg-white rounded-2xl shadow-md">

            <!-- Feeder Image -->
            <img src="{{ asset('img/img.webp') }}" alt="img" class="w-full max-h-45 mb-1 scale-x-[-1] rounded-xl">

            <!-- Feeder Name -->
            <div class="text-2xl font-semibold text-center mb-3 text-gray-800">
                {{ $feeder->nome }}
            </div>

            <!-- Feeder Info (ID + Status) -->

            <div class="flex flex-col mb-6">
                <div class="text-gray-600 font-medium">
                    <span class="font-semibold">ID:</span> {{ $feeder->id }}
                </div>
                <div class="flex items-center gap-2">
                    <span class="font-semibold text-gray-600">Status:</span>
                    <div class="flex items-center gap-2">
                        <div class="h-3 w-3 rounded-full bg-green-500 animate-pulse"></div>
                        <span class="text-green-600 font-semibold">Online</span>
                    </div>
                </div>
            </div>

            <!-- Horários Button -->
            <div class="bg-gray-900 hover:bg-gray-800 transition-colors flex w-full text-white font-medium px-6 py-3 rounded-xl mb-6 cursor-pointer">
                <div>Horários</div>
                <div class="flex-1"></div>
                <div><x-radix-arrow-right class="h-6 w-6 text-white" /></div>
            </div>

            <!-- Feeding Schedule Table -->
            <div>
                <div class="font-semibold mb-3">
                    Histórico de alimentações
                </div>
                <table class="min-w-full text-sm text-white">
                    <thead class="bg-gray-900 hover:bg-gray-800 rounded-t-full">
                        <tr>
                            <th class="py-2 px-4 border-b border-gray-900 rounded-tl-xl text-left">Data</th>
                            <th class="py-2 px-4 border-b border-gray-900 text-left">Hora</th>
                            <th class="py-2 px-4 border-b border-gray-900 text-left rounded-tr-xl">Quantidade (g)</th>
                        </tr>
                    </thead>
                    <tbody id="feedTableBody">
                        <tr class="text-black">
                            <td class="py-2 px-4 border-b border-gray-300">04/11/2025</td>
                            <td class="py-2 px-4 border-b border-gray-300">09:00</td>
                            <td class="py-2 px-4 border-b border-gray-300">150</td>
                        </tr>
                        <tr class="text-black">
                            <td class="py-2 px-4 border-b border-gray-300">04/11/2025</td>
                            <td class="py-2 px-4 border-b border-gray-300">13:00</td>
                            <td class="py-2 px-4 border-b border-gray-300">100</td>
                        </tr>
                        <tr class="text-black">
                            <td class="py-2 px-4 border-b border-gray-300">04/11/2025</td>
                            <td class="py-2 px-4 border-b border-gray-300">21:00</td>
                            <td class="py-2 px-4 border-b border-gray-300">100</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection
