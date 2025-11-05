@extends('layouts.app')

@section('body')
<div class="px-5 py-4 w-full flex justify-center">
    <div class="w-full max-w-3xl bg-white rounded-2xl shadow-md p-6">

        <!-- Header -->
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Lista de Alimentadores</h1>

        <!-- Feeder 1 -->
        <div class="border border-gray-100 rounded-2xl p-5 mb-4 shadow-sm bg-white relative">
            <div class="flex items-center justify-between mb-3">
                <div>
                    <div class="text-lg font-semibold text-gray-800">Feeder 1</div>
                    <div class="text-sm text-gray-500">ID: 001</div>
                </div>
                <div class="flex items-center gap-2">
                    <div class="h-3 w-3 rounded-full bg-green-500 animate-pulse"></div>
                    <span class="text-sm font-semibold text-green-600">Online</span>
                </div>
            </div>

            <!-- Dropdown -->
            <details class="group bg-gray-50 border-0">
                <summary class="flex cursor-pointer select-none items-center justify-between rounded-xl bg-gray-900 px-5 py-3 text-white font-medium hover:bg-gray-800 transition-colors">
                    <span>Horários Programados</span>
                    <svg class="h-5 w-5 text-white transition-transform group-open:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </summary>

                <div class="p-4 bg-gray-50 border-gray-200 text-gray-700 rounded-b-xl">
<ul class="space-y-3">
    <li class="flex justify-between items-center">
        <div>
            <div class="font-medium">11:00 — Todos os dias</div>
            <div class="text-sm text-gray-500">Quantidade: 150g</div>
        </div>
        <button class="text-blue-600 hover:text-blue-700 text-sm font-medium transition-colors">
            Editar
        </button>
    </li>
    <li class="flex justify-between items-center">
        <div>
            <div class="font-medium">12:00 — Quinta-feira</div>
            <div class="text-sm text-gray-500">Quantidade: 100g</div>
        </div>
        <button class="text-blue-600 hover:text-blue-700 text-sm font-medium transition-colors">
            Editar
        </button>
    </li>
</ul>

                </div>
            </details>

            <!-- Add Schedule Button -->
            <div class="flex justify-end mt-4">
                <button id="openModal" class="bg-gray-900 hover:bg-gray-800 transition-colors text-white font-medium px-6 py-3 rounded-xl">
                    + Adicionar horário
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="modalBackdrop" class="hidden fixed inset-0 bg-[rgba(0,0,0,0.6)] flex items-center justify-center z-50 ">
    <div class="bg-white rounded-2xl shadow-lg w-full max-w-md p-6 relative m-4">
        <!-- Close Button -->
        <button id="closeModal" class="absolute top-3 right-4 text-gray-400 hover:text-gray-600 text-2xl leading-none">&times;</button>

        <h2 class="text-xl font-semibold text-gray-800 mb-4">Adicionar Horário</h2>

        <form class="space-y-4">
            <!-- Hora -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Hora</label>
                <input type="time" required class="w-full border-gray-300 ring-2 ring-gray-200 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-gray-700">
            </div>

            <!-- Quantidade -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Quantidade (g)</label>
                <input 
                    type="number" 
                    required 
                    min="1" 
                    step="1" 
                    placeholder="Ex: 100"
                    class="w-full border-gray-300 rounded-lg px-3 py-2 focus:outline-none ring-2 ring-gray-200 focus:ring-gray-700"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                >
                <p class="text-xs text-gray-500 mt-1">Digite apenas números inteiros.</p>
            </div>

            <!-- Tipo -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tipo</label>
                <select id="scheduleType" class="w-full border-gray-300 ring-2 ring-gray-200 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-gray-700">
                    <option value="always">Todos os dias</option>
                    <option value="specific">Dia específico</option>
                </select>
            </div>

            <!-- Dias da Semana -->
            <div id="daysSelector" class="hidden">
                <label class="block text-sm font-medium text-gray-700 mb-2">Dias da semana</label>
                <div class="grid grid-cols-3 gap-2 text-sm">
                    <label class="flex items-center gap-2"><input type="checkbox"> Seg</label>
                    <label class="flex items-center gap-2"><input type="checkbox"> Ter</label>
                    <label class="flex items-center gap-2"><input type="checkbox"> Qua</label>
                    <label class="flex items-center gap-2"><input type="checkbox"> Qui</label>
                    <label class="flex items-center gap-2"><input type="checkbox"> Sex</label>
                    <label class="flex items-center gap-2"><input type="checkbox"> Sáb</label>
                    <label class="flex items-center gap-2"><input type="checkbox"> Dom</label>
                </div>
            </div>

            <!-- Confirm Button -->
            <div class="flex justify-end pt-4">
                <button type="button" id="closeModalBottom" class="bg-gray-900 hover:bg-gray-800 text-white font-medium px-6 py-2 rounded-xl">
                    Confirmar
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Scripts -->
<script>
    const modal = document.getElementById('modalBackdrop');
    const openBtn = document.getElementById('openModal');
    const closeBtn = document.getElementById('closeModal');
    const closeBottom = document.getElementById('closeModalBottom');
    const scheduleType = document.getElementById('scheduleType');
    const daysSelector = document.getElementById('daysSelector');

    openBtn.addEventListener('click', () => modal.classList.remove('hidden'));
    closeBtn.addEventListener('click', () => modal.classList.add('hidden'));
    closeBottom.addEventListener('click', () => modal.classList.add('hidden'));

    // Show/hide days based on selection
    scheduleType.addEventListener('change', () => {
        if (scheduleType.value === 'specific') {
            daysSelector.classList.remove('hidden');
        } else {
            daysSelector.classList.add('hidden');
        }
    });
</script>
@endsection
