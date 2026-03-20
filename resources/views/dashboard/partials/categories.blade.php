<div class="bg-white rounded-[2.5rem] shadow-2xl shadow-slate-200/60 border border-slate-50 overflow-hidden">
    <div class="px-8 py-6 border-b border-slate-50 flex items-center gap-3">
        <div class="w-1.5 h-6 bg-black rounded-full"></div>
        <h3 class="text-lg font-black text-slate-900 uppercase tracking-tight">Stock por Categoría</h3>
    </div>

    <div class="p-8">
        <div class="relative h-72">
            <canvas id="categoryChart"></canvas>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const categories = @json($data['by_category']);
    if (!categories || categories.length === 0) return;

    const labels = categories.map(c => c.name);
    const values = categories.map(c => c.products_sum_stock_actual ?? 0);

    const ctx = document.getElementById('categoryChart').getContext('2d');

    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels,
            datasets: [{
                data: values,
                backgroundColor: ['#0f172a', '#10b981', '#f59e0b', '#ef4444', '#6366f1'],
                borderWidth: 4,
                borderColor: '#ffffff',
                hoverOffset: 20
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '70%',
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        usePointStyle: true,
                        padding: 20,
                        font: { family: 'Inter', size: 11, weight: 'bold' }
                    }
                }
            }
        }
    });
});
</script>