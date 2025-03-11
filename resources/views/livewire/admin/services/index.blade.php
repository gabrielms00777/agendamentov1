<div>
    <!-- Breadcrumb -->
    <x-breadcrumb :links="[
        ['text' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['text' => 'Serviços', 'url' => route('admin.services.index')],
    ]" />

    <!-- Filtros -->
    <div class="bg-white p-6 rounded-lg shadow mt-4">
        <div class="flex justify-between items-center">
            <h2 class="text-lg font-semibold text-gray-700">Serviços</h2>
            <div>
                <button wire:click="toggleFilters" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 focus:outline-none">
                    {{ $showFilters ? 'Ocultar Filtros' : 'Mostrar Filtros' }}
                </button>
                <a href="#" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 focus:outline-none ml-2">
                    <i class="lucide lucide-plus"></i> Cadastrar
                </a>
            </div>
        </div>

        <!-- Div de Filtros -->
        @if ($showFilters)
        <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Filtro por Nome -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Nome</label>
                <input type="text" wire:model="filters.name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>

            <!-- Filtro por Preço Mínimo -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Preço Mínimo</label>
                <input type="number" wire:model="filters.price_min" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>

            <!-- Filtro por Preço Máximo -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Preço Máximo</label>
                <input type="number" wire:model="filters.price_max" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
        </div>

        <!-- Botão de Limpar Filtros -->
        <div class="mt-4">
            <button wire:click="resetFilters" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 focus:outline-none">
                Limpar Filtros
            </button>
        </div>
        @endif
    </div>

    <!-- Lista de Serviços -->
    <div class="bg-white p-6 rounded-lg shadow mt-4">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nome</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Descrição</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Duração</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Preço</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($services as $service)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $service->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $service->description }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $service->duration }} minutos</td>
                        <td class="px-6 py-4 whitespace-nowrap">R$ {{ number_format($service->price, 2, ',', '.') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="#" class="text-blue-600 hover:text-blue-900">Editar</a>
                            <button wire:click="deleteService({{ $service->id }})" class="text-red-600 hover:text-red-900 ml-2">Excluir</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Paginação -->
        <div class="mt-4">
            {{ $services->links() }}
        </div>
    </div>
</div>