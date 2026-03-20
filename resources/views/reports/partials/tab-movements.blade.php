<div class="space-y-6">
    @include('reports.partials.filters')

    <div class="bg-white rounded-2xl border border-slate-100 p-6">
        @include('reports.partials.charts')
    </div>

    @include('reports.partials.products-most-moved')
</div>