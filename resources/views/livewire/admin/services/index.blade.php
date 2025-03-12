<div>
    <!-- Breadcrumb -->
    <x-breadcrumb :links="[
        ['text' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['text' => 'Serviços', 'url' => route('admin.services.index')],
    ]" />

    <!-- Filtros -->
    <div x-data="{
        showFilters: @entangle('showFilters').live,
        filters: @entangle('filters').live,
        hasFilters: false,
        init() {
            // Verifica se há filtros aplicados
            this.hasFilters = Object.values(this.filters).some(value => value !== null && value !== '');
            // Abre o accordion se houver filtros
            if (this.hasFilters) {
                this.showFilters = true;
            }
        },
        applyFilters() {
            // Atualiza a URL com os filtros
            const queryParams = new URLSearchParams();
            if (this.filters.name) queryParams.set('name', this.filters.name);
            if (this.filters.price_min) queryParams.set('price_min', this.filters.price_min);
            if (this.filters.price_max) queryParams.set('price_max', this.filters.price_max);
            window.history.replaceState(null, null, `?${queryParams.toString()}`);
        },
        resetFilters() {
            // Limpa os filtros e a URL
            this.filters = { name: '', price_min: '', price_max: '' };
            window.history.replaceState(null, null, window.location.pathname);
            this.hasFilters = false;
        }
    }"
        x-init="init()"
        class="space-y-4">

        <!-- Botões de Cadastrar e Mostrar/Ocultar Filtros -->
        <div class="flex justify-between items-center">
            <button type="button" class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none" aria-haspopup="dialog" aria-expanded="false" aria-controls="hs-basic-modal" data-hs-overlay="#hs-basic-modal">
                <i data-lucid="plus"></i> Cadastrar
            </button>
            <button @click="showFilters = !showFilters" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 focus:outline-none">
                <span x-text="showFilters ? 'Ocultar Filtros' : 'Mostrar Filtros'"></span>
            </button>
        </div>

        <!-- Accordion de Filtros -->
        <div x-show="showFilters" x-collapse>
            <div class="bg-white p-6 rounded-lg shadow mt-4">
                <!-- Div de Filtros -->
                <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Filtro por Nome -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nome</label>
                        <input type="text" x-model="filters.name" @input.debounce.500ms="applyFilters" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>

                    <!-- Filtro por Preço Mínimo -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Preço Mínimo</label>
                        <input type="number" x-model="filters.price_min" @input.debounce.500ms="applyFilters" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>

                    <!-- Filtro por Preço Máximo -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Preço Máximo</label>
                        <input type="number" x-model="filters.price_max" @input.debounce.500ms="applyFilters" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                </div>

                <!-- Botão de Limpar Filtros -->
                <div class="mt-4">
                    <button @click="resetFilters" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 focus:outline-none">
                        Limpar Filtros
                    </button>
                </div>
            </div>
        </div>
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
                    @foreach ($this->services as $service)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $service->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $service->description }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $service->duration }} minutos</td>
                        <td class="px-6 py-4 whitespace-nowrap">R$ {{ number_format($service->price, 2, ',', '.') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <button @click="$dispatch('service-editModal', { service: $service->id }) class="text-blue-600 hover:text-blue-900">Editar</button>
                            <button wire:click="deleteService({{ $service->id }})" class="text-red-600 hover:text-red-900 ml-2">Excluir</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Paginação -->
        <div class="mt-4">
            {{ $this->services->links() }}
        </div>
    </div>

    <livewire:admin.services.create />
    <livewire:admin.services.edit />
</div>