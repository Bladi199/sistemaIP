<div class="bg-white rounded-[2.5rem] shadow-2xl shadow-slate-200/60 border border-slate-50 overflow-hidden">
    <div class="px-8 py-6 border-b border-slate-50 flex items-center justify-between bg-slate-50/30">
        <div class="flex items-center gap-3">
            <div class="w-1.5 h-6 bg-emerald-500 rounded-full"></div>
            <h3 class="text-lg font-black text-slate-900 uppercase tracking-tight">Flujo de Inventario</h3>
        </div>
        <span class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Últimos 7 días</span>
    </div>

    <div class="p-8">
        <div class="relative h-72">
            <canvas id="movementsChart"></canvas>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const movements = @json($data['movements']);
    if (!movements || movements.length === 0) return;

    const labels  = movements.map(i => i.date);
    const entries = movements.map(i => i.entries);
    const exits   = movements.map(i => i.exits);

    const ctx = document.getElementById('movementsChart').getContext('2d');

    if (window.movementsChart instanceof Chart) {
        window.movementsChart.destroy();
    }

    window.movementsChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels,
            datasets: [
                {
                    label: 'Entradas',
                    data: entries,
                    borderColor: '#10b981',
                    backgroundColor: 'rgba(16, 185, 129, 0.05)',
                    fill: true,
                    borderWidth: 3,
                    tension: 0.4,
                    pointRadius: 4,
                    pointBackgroundColor: '#10b981'
                },
                {
                    label: 'Salidas',
                    data: exits,
                    borderColor: '#f59e0b',
                    backgroundColor: 'rgba(245, 158, 11, 0.05)',
                    fill: true,
                    borderWidth: 3,
                    tension: 0.4,
                    pointRadius: 4,
                    pointBackgroundColor: '#f59e0b'
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        usePointStyle: true,
                        padding: 25,
                        font: { family: 'Inter', size: 11, weight: 'bold' }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { display: true, color: '#f8fafc' },
                    ticks: { font: { size: 10, weight: 'bold' }, color: '#94a3b8' }
                },
                x: {
                    grid: { display: false },
                    ticks: { font: { size: 10, weight: 'bold' }, color: '#94a3b8' }
                }
            }
        }
    });
});
</script>