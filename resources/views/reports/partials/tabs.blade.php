<div class="inline-flex items-center p-1.5 bg-slate-100/50 rounded-[2rem] border border-slate-200/60 shadow-inner">
    <button onclick="showTab('inventory')" id="btn-inventory"
        class="tab-btn flex items-center gap-2 px-8 py-3 rounded-[1.8rem] text-[10px] font-black uppercase tracking-[0.15em] transition-all duration-300 ease-out">
        <span>📦</span>
        <span>Inventario Actual</span>
    </button>

    <button onclick="showTab('movements')" id="btn-movements"
        class="tab-btn flex items-center gap-2 px-8 py-3 rounded-[1.8rem] text-[10px] font-black uppercase tracking-[0.15em] transition-all duration-300 ease-out">
        <span>📈</span>
        <span>Movimientos</span>
    </button>

    <button onclick="showTab('valuation')" id="btn-valuation"
        class="tab-btn flex items-center gap-2 px-8 py-3 rounded-[1.8rem] text-[10px] font-black uppercase tracking-[0.15em] transition-all duration-300 ease-out">
        <span>💲</span>
        <span>Valorización</span>
    </button>
</div>

<script>
function showTab(tab) {
    // Ocultar paneles con transición (si tienes definida la clase en tu CSS)
    document.querySelectorAll('.tab-panel').forEach(el => el.classList.add('hidden'));

    // Estilo Inactivo: Transparente con texto slate
    document.querySelectorAll('.tab-btn').forEach(el => {
        el.classList.remove('bg-slate-900', 'text-white', 'shadow-xl', 'scale-105');
        el.classList.add('bg-transparent', 'text-slate-400', 'hover:text-slate-600');
    });

    // Mostrar panel activo
    const targetPanel = document.getElementById('panel-' + tab);
    if(targetPanel) targetPanel.classList.remove('hidden');

    // Estilo Activo: Negro Mate Premium (como en tu reporte)
    const targetBtn = document.getElementById('btn-' + tab);
    if(targetBtn) {
        targetBtn.classList.remove('text-slate-400', 'bg-transparent', 'hover:text-slate-600');
        targetBtn.classList.add('bg-slate-900', 'text-white', 'shadow-lg', 'shadow-slate-300/50');
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const urlParams = new URLSearchParams(window.location.search);
    const activeTab = urlParams.get('tab') || 'inventory';
    showTab(activeTab);
});
</script>