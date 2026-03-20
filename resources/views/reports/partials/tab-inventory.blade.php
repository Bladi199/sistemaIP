<div class="space-y-6">
    @include('reports.partials.kpis')

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        @include('reports.partials.category-distribution')
        @include('reports.partials.tables')
    </div>
</div>