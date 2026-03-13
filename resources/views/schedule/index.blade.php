@extends('layouts.app')

@section('body')
<x-card>
    <x-search name="search" label="Pesquisar alimentadores" placeholder="Search something...">
        <x-mdi-magnify class="h-5 w-5 text-gray-500" />
    </x-search>
</x-card>

<div x-data="scheduleModal()" x-cloak>
    <x-card title="Lista de Alimentadores" titleSize="xl">
        @forelse($feeders as $feeder)
        <div class="border border-gray-100 rounded-2xl p-5 mb-4 shadow-sm bg-white relative">
            <div class="flex items-center justify-between mb-3">
                <div>
                    <div class="text-lg font-semibold text-gray-800">{{ $feeder->name }}</div>
                    <div class="text-sm text-gray-500">ID: {{ $feeder->id }}</div>
                </div>
                <div class="flex items-center gap-2">
                    <div class="h-3 w-3 rounded-full {{ $feeder->status ? 'bg-green-500 animate-pulse' : 'bg-red-500' }}"></div>
                    <span class="text-sm font-semibold {{ $feeder->status ? 'text-green-600' : 'text-red-600' }}">
                        {{ $feeder->status ? 'Online' : 'Offline' }}
                    </span>
                </div>
            </div>

            <!-- Dropdown for schedules -->
            <details class="group bg-gray-50 border-0">
                <summary class="flex cursor-pointer select-none items-center justify-between rounded-xl bg-gray-900 px-5 py-3 text-white font-medium hover:bg-gray-800 transition-colors">
                    <span>Horários Programados</span>
                    <svg class="h-5 w-5 text-white transition-transform group-open:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </summary>

                <div class="p-4 bg-gray-50 border-gray-200 text-gray-700 rounded-b-xl">
                    @if($feeder->schedules->isEmpty())
                        <p class="text-gray-500 text-sm">Nenhum horário programado.</p>
                    @else
                        <ul class="space-y-3">
                            @foreach($feeder->schedules as $schedule)
                            <li class="flex justify-between items-center">
                                <div>
                                    <div class="font-medium">
                                        {{ $schedule->time }} — 
                                        {{ $schedule->type === 'always' ? 'Todos os dias' : implode(', ', $schedule->days) }}
                                    </div>
                                    <div class="text-sm text-gray-500">Quantidade: {{ $schedule->quantity }}g</div>
                                </div>
                                <button
                                    type="button"
                                    class="text-blue-600 hover:text-blue-700 text-sm font-medium transition-colors"
                                    @click="openModal({{ $schedule->id }}, {{ $feeder->id }}, '{{ $schedule->time }}', {{ $schedule->quantity }}, '{{ $schedule->type }}', {{ json_encode($schedule->days) }})"
                                >
                                    Editar
                                </button>
                            </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </details>

            <!-- Add Schedule Button -->
            <div class="flex justify-end mt-4">
                <button @click="openModal(null, {{ $feeder->id }})" class="bg-gray-900 hover:bg-gray-800 transition-colors text-white font-medium px-6 py-3 rounded-xl">
                    + Adicionar horário
                </button>
            </div>
        </div>
        @empty
        <p class="text-gray-500 text-center">Nenhum alimentador associado à sua conta.</p>
        @endforelse
        <div x-show="modalOpen" x-transition class="fixed inset-0 bg-[rgba(0,0,0,0.6)] flex items-center justify-center z-50">
            <div class="bg-white rounded-2xl shadow-lg w-full max-w-md p-6 relative m-4">
                <button @click="closeModal()" class="absolute top-3 right-4 text-gray-400 hover:text-gray-600 text-2xl leading-none">&times;</button>

                <h2 class="text-xl font-semibold text-gray-800 mb-4" x-text="modalTitle"></h2>

                <form :action="formAction" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="feeder_id" :value="feederId">
                    <input type="hidden" name="_method" x-show="editing" value="PUT">

                    <!-- Hora -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Hora</label>
                        <input type="time" name="time" required class="w-full border-gray-300 ring-2 ring-gray-200 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-gray-700" x-model="time">
                    </div>

                    <!-- Quantidade -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Quantidade (g)</label>
                        <input type="number" name="quantity" required min="1" step="1" class="w-full border-gray-300 rounded-lg px-3 py-2 focus:outline-none ring-2 ring-gray-200 focus:ring-gray-700" x-model="quantity">
                    </div>

                    <!-- Tipo -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tipo</label>
                        <select name="type" class="w-full border-gray-300 ring-2 ring-gray-200 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-gray-700" x-model="type">
                            <option value="always">Todos os dias</option>
                            <option value="specific">Dia específico</option>
                        </select>
                    </div>

                    <!-- Dias da Semana -->
                    <div x-show="type==='specific'" class="grid grid-cols-3 gap-2 text-sm mt-2">
                        <template x-for="day in ['Seg','Ter','Qua','Qui','Sex','Sáb','Dom']" :key="day">
                            <label class="flex items-center gap-2">
                                <input type="checkbox" :value="day" name="days[]" :checked="days.includes(day)" @click="toggleDay(day)">
                                <span x-text="day"></span>
                            </label>
                        </template>
                    </div>

                    <div class="flex justify-end pt-4">
                        <button type="submit" class="bg-gray-900 hover:bg-gray-800 text-white font-medium px-6 py-2 rounded-xl">
                            Confirmar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </x-card>
</div>
        <!-- Header -->



        <!-- Modal -->
        


    <script>
        function scheduleModal() {
    return {
        modalOpen: false,
        modalTitle: 'Adicionar Horário',
        feederId: null,
        scheduleId: null,
        time: '',
        quantity: '',
        type: 'always',
        days: [],
        editing: false,

        openModal(scheduleId = null, feederId = null, time = '', quantity = '', type = 'always', days = []) {
            this.modalOpen = true;
            this.scheduleId = scheduleId;
            this.feederId = feederId;
            this.time = time;
            this.quantity = quantity;
            this.type = type;
            this.days = days || [];
            this.editing = !!scheduleId;
            this.modalTitle = this.editing ? 'Editar Horário' : 'Adicionar Horário';
        },

        closeModal() {
            this.modalOpen = false;
            this.scheduleId = null;
            this.feederId = null;
            this.time = '';
            this.quantity = '';
            this.type = 'always';
            this.days = [];
            this.editing = false;
        },

        toggleDay(day) {
            if (this.days.includes(day)) {
                this.days = this.days.filter(d => d !== day);
            } else {
                this.days.push(day);
            }
        }
    }
}
    </script>
</div>
@endsection