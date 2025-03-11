<div>
    <!-- Breadcrumb -->
    <x-breadcrumb :links="[
        ['text' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['text' => 'Relatórios', 'url' => route('admin.reports.index')],
    ]" />

    <!-- Filtros -->
    <div class="bg-white p-6 rounded-lg shadow mt-4">
        <h2 class="text-lg font-semibold text-gray-700">Relatórios</h2>
        <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Filtro por Data Inicial -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Data Inicial</label>
                <input type="date" wire:model="startDate" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>

            <!-- Filtro por Data Final -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Data Final</label>
                <input type="date" wire:model="endDate" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
        </div>
    </div>

    <!-- Relatório de Agendamentos -->
    <div class="bg-white p-6 rounded-lg shadow mt-4">
        <h2 class="text-lg font-semibold text-gray-700">Agendamentos</h2>
        <div class="mt-4">
            <p>Total de Agendamentos: {{ $appointments->count() }}</p>
        </div>
    </div>

    <!-- Relatório de Faturamento -->
    <div class="bg-white p-6 rounded-lg shadow mt-4">
        <h2 class="text-lg font-semibold text-gray-700">Faturamento</h2>
        <div class="mt-4">
            <p>Faturamento Total: R$ {{ number_format($revenue, 2, ',', '.') }}</p>
        </div>
    </div>

    <!-- Relatório de Produtos Vendidos -->
    <div class="bg-white p-6 rounded-lg shadow mt-4">
        <h2 class="text-lg font-semibold text-gray-700">Produtos Vendidos</h2>
        <div class="mt-4">
            <ul>
                @foreach ($productsSold as $product)
                <li>{{ $product->name }}: {{ $product->sales_count }} vendas</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>