@extends('layouts.app')

@section('body')
<div class="px-5 py-2 w-full">
  <div class="flex w-full flex-wrap justify-center gap-3">
    <div class="flex flex-col gap-8 mb-10 w-full items-center">

      <!-- Alimentações Feitas Chart Section -->
      <div class="relative w-full max-w-4xl mx-auto mt-10 px-4 flex items-center justify-center">
        <!-- Left Button -->
        <button id="prevFeeder" class="absolute left-0 bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-full shadow transition">
          ‹
        </button>

        <!-- Chart Container -->
        <div class="w-full px-10">
          <canvas id="feedingChart" class="w-full h-80"></canvas>
        </div>

        <!-- Right Button -->
        <button id="nextFeeder" class="absolute right-0  bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-full shadow transition">
          ›
        </button>
      </div>

      <!-- Estatísticas -->
      <div class="w-full max-w-5xl bg-white rounded-xl shadow-md p-6">
        <h2 class="text-xl font-semibold mb-4 text-gray-800">Estatísticas Semanais/Mensais</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-center">
          <div class="bg-gray-100 rounded-lg p-4">
            <p class="text-sm text-gray-500">Total Ração Libertada</p>
            <p id="totalFeed" class="text-2xl font-bold text-gray-900">0g</p>
          </div>
          <div class="bg-gray-100 rounded-lg p-4">
            <p class="text-sm text-gray-500">Média Diária</p>
            <p id="avgFeed" class="text-2xl font-bold text-gray-900">0g</p>
          </div>
          <div class="bg-gray-100 rounded-lg p-4">
            <p class="text-sm text-gray-500">Número de Alimentações</p>
            <p id="feedCount" class="text-2xl font-bold text-gray-900">0</p>
          </div>
          <div class="bg-gray-100 rounded-lg p-4">
            <p class="text-sm text-gray-500">Última Alimentação</p>
            <p id="lastFeed" class="text-2xl font-bold text-gray-900">–</p>
          </div>
        </div>
      </div>

      <!-- Histórico -->
      <div class="w-full max-w-5xl bg-white rounded-xl shadow-md p-6 overflow-x-auto">
        <div class="flex justify-between items-center mb-4">
          <h2 class="text-xl font-semibold text-gray-800">Histórico de Alimentações</h2>
          <div class="flex gap-2">
            <button id="exportBtn" class="px-3 py-1.5 text-sm rounded-full hover:bg-blue-700 text-white transition">
            </button>
            <button id="clearBtn" class="px-3 py-1.5 text-sm rounded-full hover:bg-red-700 text-white transition">
            </button>
          </div>
        </div>

        <table class="min-w-full text-sm text-gray-700">
          <thead class="bg-gray-100 rounded-t-full">
            <tr>
              <th class="py-2 px-4 border-b border-gray-600 rounded-tl-xl text-left">Data</th>
              <th class="py-2 px-4 border-b border-gray-600 text-left">Hora</th>
              <th class="py-2 px-4 border-b border-gray-600 text-left">Quantidade (g)</th>
              <th class="py-2 px-4 border-b border-gray-600 rounded-tr-xl text-left">Alimentador</th>
            </tr>
          </thead>
          <tbody id="feedTableBody"></tbody>
        </table>
      </div>

    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  // Dados simulados
  const feeders = [
    {
      name: "Feeder 1",
      labels: ["Seg", "Ter", "Qua", "Qui", "Sex", "Sáb", "Dom"],
      data: [120, 100, 90, 110, 95, 130, 80],
    },
    {
      name: "Feeder 2",
      labels: ["Seg", "Ter", "Qua", "Qui", "Sex", "Sáb", "Dom"],
      data: [90, 85, 100, 70, 120, 110, 95],
    },
    {
      name: "Feeder 3",
      labels: ["Seg", "Ter", "Qua", "Qui", "Sex", "Sáb", "Dom"],
      data: [0, 0, 0, 0, 0, 0, 0],
    }
  ];

  const feedData = [
    { date: '2025-11-01', time: '08:00', amount: 120, feeder: 'Feeder 1' },
    { date: '2025-11-01', time: '18:00', amount: 110, feeder: 'Feeder 2' },
    { date: '2025-11-02', time: '09:00', amount: 130, feeder: 'Feeder 1' },
    { date: '2025-11-03', time: '19:00', amount: 115, feeder: 'Feeder 2' },
  ];

  let currentFeeder = 0;
  const ctx = document.getElementById('feedingChart').getContext('2d');
  const tableBody = document.getElementById('feedTableBody');

  // 🔧 Chart container fix to avoid overlapping modals
  ctx.canvas.parentElement.style.position = 'relative';
  ctx.canvas.parentElement.style.zIndex = '0';
  ctx.canvas.style.zIndex = '0';
  ctx.canvas.style.position = 'relative';

  // Chart inicial
  let feedingChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: feeders[currentFeeder].labels,
      datasets: [{
        label: feeders[currentFeeder].name,
        data: feeders[currentFeeder].data,
        backgroundColor: 'rgba(75, 85, 99, 0.8)',
        borderRadius: 6
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false, // ✅ avoids chart resizing issues
      scales: {
        y: {
          beginAtZero: true,
          title: { display: true, text: 'Quantidade (g)' }
        },
        x: {
          title: { display: true, text: 'Dia da Semana' }
        }
      },
      plugins: {
        legend: { display: false },
        title: {
          display: true,
          text: feeders[currentFeeder].name + " - Alimentações Feitas"
        }
      },
      layout: {
        padding: { top: 10, bottom: 10 }
      }
    }
  });

  // Atualiza gráfico e tabela
  function updateChart() {
    feedingChart.data.labels = feeders[currentFeeder].labels;
    feedingChart.data.datasets[0].data = feeders[currentFeeder].data;
    feedingChart.data.datasets[0].label = feeders[currentFeeder].name;
    feedingChart.options.plugins.title.text = feeders[currentFeeder].name + " - Alimentações Feitas";
    feedingChart.update();

    const currentName = feeders[currentFeeder].name;
    const filtered = feedData.filter(f => f.feeder === currentName);

    // Atualizar tabela
    tableBody.innerHTML = filtered.map(f => `
      <tr>
        <td class="py-2 px-4 border-b border-gray-300">${f.date}</td>
        <td class="py-2 px-4 border-b border-gray-300">${f.time}</td>
        <td class="py-2 px-4 border-b border-gray-300">${f.amount}g</td>
        <td class="py-2 px-4 border-b border-gray-300">${f.feeder}</td>
      </tr>
    `).join('');

    // Atualizar estatísticas
    const total = filtered.reduce((sum, f) => sum + f.amount, 0);
    const avg = filtered.length ? total / filtered.length : 0;
    const lastFeed = filtered[filtered.length - 1];
    document.getElementById('totalFeed').innerText = total + 'g';
    document.getElementById('avgFeed').innerText = avg.toFixed(1) + 'g';
    document.getElementById('feedCount').innerText = filtered.length;
    document.getElementById('lastFeed').innerText = lastFeed ? lastFeed.date + ' ' + lastFeed.time : '–';
  }

  // Botões
  document.getElementById('prevFeeder').addEventListener('click', () => {
    currentFeeder = (currentFeeder - 1 + feeders.length) % feeders.length;
    updateChart();
  });

  document.getElementById('nextFeeder').addEventListener('click', () => {
    currentFeeder = (currentFeeder + 1) % feeders.length;
    updateChart();
  });

  // Exportar CSV
  document.getElementById('exportBtn').addEventListener('click', () => {
    const currentName = feeders[currentFeeder].name;
    const filtered = feedData.filter(f => f.feeder === currentName);
    const csv = [
      ['Data', 'Hora', 'Quantidade', 'Alimentador'],
      ...filtered.map(f => [f.date, f.time, f.amount, f.feeder])
    ].map(e => e.join(",")).join("\n");

    const blob = new Blob([csv], { type: 'text/csv' });
    const a = document.createElement('a');
    a.href = URL.createObjectURL(blob);
    a.download = 'historico_alimentacoes.csv';
    a.click();
  });

  // Limpar
  document.getElementById('clearBtn').addEventListener('click', () => {
    if (confirm("Deseja realmente limpar o histórico?")) {
      tableBody.innerHTML = "";
      feedingChart.data.datasets[0].data = [];
      feedingChart.update();
      document.getElementById('totalFeed').innerText = "0g";
      document.getElementById('avgFeed').innerText = "0g";
      document.getElementById('feedCount').innerText = "0";
      document.getElementById('lastFeed').innerText = "–";
    }
  });

  // Inicializar
  updateChart();
</script>

@endsection
