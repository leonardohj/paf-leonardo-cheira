@extends('layouts.app')

@section('body')
<div class="px-5 py-2 w-full ">
  <div class="flex w-full flex-wrap justify-center gap-3 ">
    <div class="flex flex-col gap-8 mb-10 w-full items-center">

      @if (empty($feeders))
      <div class="items-center w-full max-w-2xl border-gray-50 border justify-between gap-6 p-4 bg-white rounded-2xl shadow-md">
        <div class="flex flex-col m-2 p-2 justify-between items-center text-center md:text-left md:items-start flex-1">
          <h2 class="text-lg font-semibold text-gray-800">
            Não tens um alimentador associado à tua conta?
          </h2>
          <p class="text-gray-600 mb-4">
            Associa um alimentador para começares a monitorizar e gerir a alimentação facilmente.
          </p>
          <button id="buttonAssociateFeeder"
            class="bg-black hover:bg-gray-800 transition-colors w-full text-white font-medium px-6 py-3 rounded-xl">
            Associar alimentador
          </button>
        </div>
      </div>
      @else

      <div class="w-full flex justify-center items-center gap-2 mb-3">
        <select id="monthSelector" class="border rounded-lg px-2 py-1">
          @foreach($logsByMonth as $month => $weeks)
            <option value="{{ $month }}">{{ ucfirst($month) }}</option>
          @endforeach
        </select>
        <button onclick="changeLeft()" class="rounded-full w-10 h-10 bg-gray-200 text-lg font-bold">&lt;</button>
        <div class="w-[70%] h-96">
          <canvas id="myChart"></canvas>
        </div>
        <button onclick="changeRight()" class="rounded-full w-10 h-10 bg-gray-200 text-lg font-bold">&gt;</button>
      </div>

      <div class="flex gap-5 p-3 bg-gray-50 rounded-xl flex-col w-full max-w-4xl">
        <b class="text-lg">Estatísticas Mensais</b>
        <div class="flex gap-3">
          <div class="py-2 w-full px-5 bg-gray-100 rounded-xl text-center text-nowrap flex flex-col">
            Total Ração Libertada
            <b class="text-2xl">{{ $mensalStats["total"] }}</b>
          </div>
          <div class="py-2 w-full px-5 bg-gray-100 rounded-xl text-center text-nowrap flex flex-col">
            Total Media Libertada
            <b class="text-2xl">{{ $mensalStats["media"] }}</b>
          </div>
          <div class="py-2 w-full px-5 bg-gray-100 rounded-xl text-center text-nowrap flex flex-col">
            Nº de Alimentações
            <b class="text-2xl">{{ $mensalStats["alimentacoes"] }}</b>
          </div>
          <div class="py-2 w-full px-5 bg-gray-100 rounded-xl text-center text-nowrap flex flex-col">
            Ultima Alimentação
            <b class="text-2xl">{{ $mensalStats["last_alimentacao"] }}</b>
          </div>
        </div>
      </div>

      <div class="flex gap-5 p-3 bg-gray-50 rounded-xl flex-col w-full max-w-4xl">
        <b class="text-lg">Histórico de Alimentações</b>
        <div class="flex w-full">
          <table class="w-full">
            <thead class="bg-gray-200 w-full">
              <th class=" border-b rounded-tl-xl  border-gray-400">Data</th>
              <th class="border-b  border-gray-400">Hora</th>
              <th class="border-b py-1 border-gray-400">Quantidade (g)</th>
              <th class="border-b rounded-tr-xl border-gray-400">Alimentador</th>
            </thead>
            @foreach($classicLogs as $log)
            <tbody class="border-b mx-1">
              <td class="py-1 px-2">{{ $log["date"] }}</td>
              <td class="py-1 text-center">{{ $log["hour"] }}</td>
              <td class="py-1 text-center">{{ $log["quantity"] }}</td>
              <td class="py-1 text-center">{{ $log["alimentador"] }}</td>
            </tbody>
            @endforeach
          </table>
        </div>
      </div>
      @endif
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const buttonAssociateFeeder = document.getElementById('buttonAssociateFeeder');
    if (buttonAssociateFeeder) {
        buttonAssociateFeeder.addEventListener('click', openModalAssociateFeeder);
    }

    const monthSelector = document.getElementById('monthSelector');
    let selectedMonth = monthSelector.value;

    let weekIndex = 0;
    const data = @json($logsByMonth);

    function getWeeksForMonth(month) {
        return Object.keys(data[month]).sort((a,b)=>a-b);
    }

    let weeks = getWeeksForMonth(selectedMonth);

    const ctx = document.getElementById('myChart').getContext('2d');

    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb'],
            datasets: [{
                label: 'Gramas totais',
                data: data[selectedMonth][weeks[weekIndex]],
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: { y: { beginAtZero: true } }
        }
    });

    function updateChart() {
        weeks = getWeeksForMonth(selectedMonth);
        if (weekIndex >= weeks.length) weekIndex = weeks.length - 1;
        const week = weeks[weekIndex];
        myChart.data.datasets[0].data = data[selectedMonth][week];
        myChart.update();
    }

    monthSelector.addEventListener('change', () => {
        selectedMonth = monthSelector.value;
        weekIndex = 0;
        updateChart();
    });

    window.changeLeft = function() {
        if (weekIndex > 0) {
            weekIndex--;
            updateChart();
        }
    }

    window.changeRight = function() {
        if (weekIndex < weeks.length - 1) {
            weekIndex++;
            updateChart();
        }
    }

    window.addEventListener('resize', () => {
        myChart.resize();
    });

    updateChart();
});
</script>
@endsection
