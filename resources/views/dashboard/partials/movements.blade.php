<div class="bg-white rounded-[2rem] shadow-lg shadow-slate-200/40 border border-slate-100 overflow-hidden">

    <!-- HEADER -->
    <div class="px-8 py-5 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <div class="w-1.5 h-6 bg-slate-900 rounded-full"></div>
            <h3 class="text-sm font-black text-slate-900 uppercase tracking-wide">
                Flujo de Inventario
            </h3>
        </div>

        <span class="text-[10px] font-semibold text-slate-400 uppercase tracking-[0.2em]">
            Últimos 7 días
        </span>
    </div>

    <!-- BODY -->
    <div class="px-8 pb-8">
        <div class="relative h-72">
            <canvas id="movementsChart"></canvas>
        </div>
    </div>

</div>

<!-- CHART -->
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
                    backgroundColor: 'rgba(16,185,129,0.08)',
                    fill: true,
                    borderWidth: 2.5,
                    tension: 0.4,
                    pointRadius: 3,
                    pointHoverRadius: 5,
                    pointBackgroundColor: '#10b981'
                },
                {
                    label: 'Salidas',
                    data: exits,
                    borderColor: '#ef4444',
                    backgroundColor: 'rgba(239,68,68,0.08)',
                    fill: true,
                    borderWidth: 2.5,
                    tension: 0.4,
                    pointRadius: 3,
                    pointHoverRadius: 5,
                    pointBackgroundColor: '#ef4444'
                }
            ]
        },

        options: {
            responsive: true,
            maintainAspectRatio: false,

            interaction: {
                mode: 'index',
                intersect: false
            },

            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        usePointStyle: true,
                        padding: 20,
                        color: '#64748b',
                        font: {
                            family: 'Inter',
                            size: 11,
                            weight: '600'
                        }
                    }
                },

                tooltip: {
                    backgroundColor: '#0f172a',
                    titleColor: '#fff',
                    bodyColor: '#e2e8f0',
                    padding: 10,
                    displayColors: true,
                    titleFont: { weight: 'bold' },
                    bodyFont: { weight: '500' }
                }
            },

            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0,0,0,0.04)',
                        drawBorder: false
                    },
                    ticks: {
                        color: '#94a3b8',
                        font: {
                            size: 10,
                            weight: '500'
                        }
                    }
                },

                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        color: '#94a3b8',
                        font: {
                            size: 10,
                            weight: '500'
                        }
                    }
                }
            }
        }
    });

});
</script>