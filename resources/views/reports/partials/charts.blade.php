@php $movements = $data['movements'] ?? collect(); @endphp

<div class="bg-white rounded-2xl border border-slate-100 p-6 mb-6">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-[10px] font-black text-slate-500 uppercase tracking-[0.2em]">
            Tendencia de Movimientos
        </h3>
        <div class="flex gap-4">
            <div class="flex items-center gap-1.5">
                <div class="w-2 h-2 rounded-full bg-emerald-500"></div>
                <span class="text-[9px] font-bold text-slate-400 uppercase">Entradas</span>
            </div>
            <div class="flex items-center gap-1.5">
                <div class="w-2 h-2 rounded-full bg-rose-500"></div>
                <span class="text-[9px] font-bold text-slate-400 uppercase">Salidas</span>
            </div>
        </div>
    </div>

    <div class="relative h-64">
        <canvas id="movementsChart"></canvas>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const movements = @json($movements);
    if (!movements || movements.length === 0) return;

    const ctx = document.getElementById('movementsChart').getContext('2d');
    
    // Gradientes para un look Premium
    const greenGrad = ctx.createLinearGradient(0, 0, 0, 400);
    greenGrad.addColorStop(0, 'rgba(16, 185, 129, 0.1)');
    greenGrad.addColorStop(1, 'rgba(16, 185, 129, 0)');

    const redGrad = ctx.createLinearGradient(0, 0, 0, 400);
    redGrad.addColorStop(0, 'rgba(244, 63, 94, 0.1)');
    redGrad.addColorStop(1, 'rgba(244, 63, 94, 0)');

    window.movementsChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: movements.map(i => i.date),
            datasets: [
                {
                    label: 'Entradas',
                    data: movements.map(i => i.entries),
                    borderColor: '#10b981',
                    backgroundColor: greenGrad,
                    borderWidth: 2.5,
                    pointRadius: 0,
                    pointHoverRadius: 6,
                    tension: 0.4,
                    fill: true
                },
                {
                    label: 'Salidas',
                    data: movements.map(i => i.exits),
                    borderColor: '#f43f5e',
                    backgroundColor: redGrad,
                    borderWidth: 2.5,
                    pointRadius: 0,
                    pointHoverRadius: 6,
                    tension: 0.4,
                    fill: true
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { 
                    beginAtZero: true, 
                    grid: { color: '#f8fafc', drawBorder: false },
                    ticks: { font: { size: 9, weight: '600' }, color: '#94a3b8' }
                },
                x: { 
                    grid: { display: false },
                    ticks: { font: { size: 9, weight: '600' }, color: '#94a3b8' }
                }
            }
        }
    });
});
</script>