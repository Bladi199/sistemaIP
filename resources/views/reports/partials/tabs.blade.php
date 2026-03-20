<div class="flex items-center gap-2">
    <button onclick="showTab('inventory')" id="btn-inventory"
        class="tab-btn px-6 py-2 rounded-lg text-[10px] font-black uppercase tracking-wider transition-all duration-200 border border-slate-100 bg-white text-slate-400">
        📦 Inventario Actual
    </button>

    <button onclick="showTab('movements')" id="btn-movements"
        class="tab-btn px-6 py-2 rounded-lg text-[10px] font-black uppercase tracking-wider transition-all duration-200 border border-slate-100 bg-white text-slate-400">
        📈 Movimientos
    </button>

    <button onclick="showTab('valuation')" id="btn-valuation"
        class="tab-btn px-6 py-2 rounded-lg text-[10px] font-black uppercase tracking-wider transition-all duration-200 border border-slate-100 bg-white text-slate-400">
        💲 Valorización
    </button>
</div>

<script>
function showTab(tab) {
    // Ocultar paneles
    document.querySelectorAll('.tab-panel').forEach(el => {
        el.classList.add('hidden')
    })

    // Resetear estilos de botones (clases premium inactivas)
    document.querySelectorAll('.tab-btn').forEach(el => {
        el.classList.remove('bg-[#0f172a]', 'text-white', 'shadow-sm')
        el.classList.add('bg-white', 'text-slate-400', 'border-slate-100')
    })

    // Mostrar panel activo
    const targetPanel = document.getElementById('panel-' + tab);
    if(targetPanel) targetPanel.classList.remove('hidden');

    // Aplicar estilo activo premium (Negro Mate como tu imagen)
    const targetBtn = document.getElementById('btn-' + tab);
    if(targetBtn) {
        targetBtn.classList.add('bg-[#0f172a]', 'text-white', 'shadow-sm')
        targetBtn.classList.remove('bg-white', 'text-slate-400', 'border-slate-100')
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const urlParams = new URLSearchParams(window.location.search);
    const activeTab = urlParams.get('tab') || 'inventory';
    showTab(activeTab);
});
</script>