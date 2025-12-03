@extends('layouts.app')

@section('body')
@php
$days = [
    1 => 'Segunda',
    2 => 'Terça',
    3 => 'Quarta',
    4 => 'Quinta',
    5 => 'Sexta',
    6 => 'Sábado',
    7 => 'Domingo',
];
@endphp

<div class="px-5 py-4 w-full flex justify-center bg-white">
    <div class="w-full max-w-3xl bg-white rounded-2xl shadow-md p-6 ">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Lista de Alimentadores</h1>

        <div class="flex flex-col gap-3">
            @foreach($cleanedFeeders as $feeder)
                @if(count($cleanedFeeders) > 1)
                    <details class="group border border-gray-100 rounded-2xl p-4 shadow-sm bg-white relative ">
                @else
                    <div class="group border border-gray-100 rounded-2xl p-4 shadow-sm bg-white relative ">
                @endif

                <summary class="flex items-center justify-between @if(count($cleanedFeeders) > 1) cursor-pointer @endif">
                    <div>
                        <div class="text-lg font-semibold text-gray-800">{{ $feeder["name"] }}</div>
                        <div class="text-sm text-gray-500">ID: {{ $feeder["id"] }}</div>
                    </div>

                    <div class="flex items-center gap-2 {{ $feeder["status"] ? 'text-green-600' : 'text-red-500' }}">
                        <div class="h-3 w-3 rounded-full {{ $feeder["status"] ? 'bg-green-600' : 'bg-red-500' }} animate-pulse"></div>
                        <span class="text-sm font-semibold">{{ $feeder["status"] ? 'Online' : 'Offline' }}</span>
                        @if(count($cleanedFeeders) > 1)
                        <svg class="h-5 w-5 text-gray-700 transition-transform group-open:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                        @endif
                    </div>
                </summary>

                <div class="mt-4 bg-gray-50 border-gray-200 rounded-b-xl">
                    <span class="block font-medium text-white rounded-t-2xl bg-gray-900 p-4">Horários Programados</span>
                    <ul class="space-y-3 p-4 shadow-lg">
                        @forelse($feeder["schedules"] as $schedule)
                        <li class="flex justify-between items-center">
                            <div>
                                <div class="font-medium text-gray-700">
                                    {{ \Carbon\Carbon::parse($schedule["hour"])->format('H:i') }} — 
                                    @if($schedule["type"] == 'specific')
                                        @php
                                            $daysSelected = [];
                                            foreach($schedule["days"] as $day) {
                                                if(isset($days[$day])) {
                                                    $daysSelected[] = substr($days[$day], 0, 3);
                                                }
                                            }
                                        @endphp
                                        {{ implode(', ', $daysSelected) }}
                                    @else
                                        Todos os dias
                                    @endif
                                </div>                                
                                <div class="text-sm text-gray-500">Quantidade: ~{{ $schedule["quantity"] }}g</div>
                            </div>
                            <button 
                                class="openModalBtn text-blue-600 hover:text-blue-700 text-sm font-medium transition-colors"
                                data-feeder="{{ $feeder['id'] }}"
                                data-schedule-id="{{ $schedule['id'] }}"
                                data-hour="{{ $schedule['hour'] }}"
                                data-quantity="{{ $schedule['quantity'] }}"
                                data-type="{{ $schedule['type'] }}"
                                @if($schedule['type'] == 'specific')
                                    data-days="{{ implode(',', $schedule['days']) }}"
                                @endif
                            >
                                Editar
                            </button>
                        </li>
                        @empty
                        <div class="text-gray-800 text-sm text-center">
                            Nenhum horário associado a este alimentador...

                        </div>
                        @endforelse
                    </ul>
                </div>
                <div class="flex w-full mt-4">
                    <button class="openModalBtn bg-gray-900 w-full hover:bg-gray-800 transition-colors text-white font-medium px-6 py-3 rounded-xl" 
                        data-feeder="{{ $feeder['id'] }}">
                        + Adicionar horário
                    </button>
                </div>

                @if(count($cleanedFeeders) > 1)
                    </details>
                @else
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>

<div id="modalBackdrop" class="hidden fixed inset-0 bg-[rgba(0,0,0,0.6)] flex items-center justify-center z-50">
    <form action="" method="POST" class="w-full max-w-md m-4">
        @csrf
        <div class="bg-white rounded-2xl shadow-lg p-6 relative">

            <button id="closeModal" type="button" class="absolute top-3 right-4 text-gray-400 hover:text-gray-600 text-2xl leading-none">&times;</button>

            <h2 class="text-xl font-semibold text-gray-800 mb-4">Adicionar Horário</h2>

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Hora</label>
                    <input type="time" name="hour" required class="w-full border-gray-300 ring-2 ring-gray-200 rounded-lg px-3 py-2 focus:ring-gray-700">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Quantidade (g)</label>
                    <input type="number" name="quantity" required min="1" step="1" placeholder="Ex: 100" class="w-full border-gray-300 rounded-lg px-3 py-2 ring-2 ring-gray-200 focus:ring-gray-700" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tipo</label>
                    <select id="scheduleType" name="type" class="w-full border-gray-300 ring-2 ring-gray-200 rounded-lg px-3 py-2 focus:ring-gray-700">
                        <option value="always">Todos os dias</option>
                        <option value="specific">Dia específico</option>
                    </select>
                </div>

                <div id="daysSelector" class="hidden">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Dias da semana</label>
                    <div class="grid grid-cols-3 gap-2 text-sm">
                        @foreach ($days as $num => $day)
                            <label class="flex items-center gap-2">
                                <input type="checkbox" name="days[]" value="{{ $num }}">
                                <span>{{ $day }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="flex justify-end pt-4">
                    <button type="submit" class="bg-gray-900 hover:bg-gray-800 text-white font-medium px-6 py-2 rounded-xl">
                        Confirmar
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('modalBackdrop');
    const openBtns = document.querySelectorAll('.openModalBtn');
    const closeBtn = document.getElementById('closeModal');
    const form = modal.querySelector('form');
    const scheduleType = document.getElementById('scheduleType');
    const daysSelector = document.getElementById('daysSelector');
    const checkboxes = Array.from(daysSelector.querySelectorAll('input[type="checkbox"]'));
    const modalTitle = form.querySelector('h2');

    function updateDaysVisibility() {
        if (scheduleType.value === 'specific') {
            daysSelector.classList.remove('hidden');
            checkboxes.forEach(cb => cb.disabled = false);
        } else {
            daysSelector.classList.add('hidden');
            checkboxes.forEach(cb => { cb.checked = false; cb.disabled = true; });
        }
    }

    scheduleType.addEventListener('change', updateDaysVisibility);
    updateDaysVisibility();

    openBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const feederId = btn.dataset.feeder;
            const scheduleId = btn.dataset.scheduleId;
            const hour = btn.dataset.hour;
            const quantity = btn.dataset.quantity;
            const type = btn.dataset.type;
            const days = btn.dataset.days ? btn.dataset.days.split(',') : [];

            if (scheduleId) {
                form.action = `/schedule/update/${feederId}/${scheduleId}`;
                modalTitle.textContent = 'Editar Horário';
            } else {
                form.action = `/schedule/store/${feederId}`;
                modalTitle.textContent = 'Adicionar Horário';
            }

            form.querySelector('input[name="hour"]').value = hour || '';
            form.querySelector('input[name="quantity"]').value = quantity || '';
            scheduleType.value = type || 'always';
            updateDaysVisibility();

            checkboxes.forEach(cb => {
                cb.checked = days.includes(cb.value);
            });

            modal.classList.remove('hidden');
        });
    });

    closeBtn.addEventListener('click', () => modal.classList.add('hidden'));

    form.addEventListener('submit', function (e) {
        if (scheduleType.value === 'specific') {
            const anyChecked = checkboxes.some(cb => cb.checked);
            if (!anyChecked) {
                e.preventDefault();
                alert('Por favor selecione pelo menos um dia.');
            }
        }
    });
});
</script>
@endsection