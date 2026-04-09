<!-- CARD: STOCK POR CATEGORÍA -->
<div class="bg-white rounded-[2.5rem] shadow-lg shadow-slate-200/50 border border-slate-100 overflow-hidden transition-all duration-300">

    <!-- HEADER -->
    <div class="px-8 py-6 border-b border-slate-100 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <div class="w-1.5 h-6 bg-slate-900 rounded-full"></div>
            <h3 class="text-lg font-black text-slate-900 uppercase tracking-tight">
                Stock por Categoría
            </h3>
        </div>
    </div>

    <!-- BODY -->
    <div class="p-8">
        <div class="relative h-72">
            <canvas id="categoryChart"></canvas>
        </div>
    </div>
</div>

<!-- CHART -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const categories = @json($data['by_category']);
    if (!categories || categories.length === 0) return;

    const labels = categories.map(c => c.name);
    const values = categories.map(c => c.products_sum_stock_actual ?? 0);

    const ctx = document.getElementById('categoryChart').getContext('2d');

    if (window.categoryChart instanceof Chart) {
        window.categoryChart.destroy();
    }

    window.categoryChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels,
            datasets: [{
                data: values,
                backgroundColor: [
                    '#0f172a', // Negro azulado (principal)
                    '#10b981', // Verde sistema
                    '#0ea5e9', // Azul profesional
                    '#f59e0b', // Ámbar suave
                    '#ef4444', // Rojo controlado
                    '#64748b'  // Gris neutro
                ],
                borderWidth: 3,
                borderColor: '#ffffff',
                hoverOffset: 10
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '68%',
            animation: {
                duration: 800,
                easing: 'easeOutQuart'
            },
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        usePointStyle: true,
                        padding: 18,
                        boxWidth: 8,
                        color: '#475569',
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
                    cornerRadius: 8,
                    displayColors: false,
                    callbacks: {
                        label: function(context) {
                            return context.label + ': ' + context.raw;
                        }
                    }
                }
            }
        }
    });

});
</script>