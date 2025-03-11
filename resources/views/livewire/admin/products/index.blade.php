<div>
    <!-- Breadcrumb -->
    <x-breadcrumb :links="[
        ['text' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['text' => 'Produtos', 'url' => route('admin.products.index')],
    ]" />

    <!-- Filtros -->
    <div class="bg-white p-6 rounded-lg shadow mt-4">
        <div class="flex justify-between items-center">
            <h2 class="text-lg font-semibold text-gray-700">Produtos</h2>
            <div>
                <button wire:click="toggleFilters" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 focus:outline-none">
                    {{ $showFilters ? 'Ocultar Filtros' : 'Mostrar Filtros' }}
                </button>
                <button wire:click="openModal('create')" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 focus:outline-none ml-2">
                    <i class="lucide lucide-plus"></i> Cadastrar
                </button>
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

    <!-- Lista de Produtos -->
    <div class="bg-white p-6 rounded-lg shadow mt-4">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nome</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Descrição</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Preço</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($products as $product)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $product->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $product->description }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">R$ {{ number_format($product->price, 2, ',', '.') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <button wire:click="openModal('edit', {{ $product->id }})" class="text-blue-600 hover:text-blue-900">Editar</button>
                            <button wire:click="deleteProduct({{ $product->id }})" class="text-red-600 hover:text-red-900 ml-2">Excluir</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Paginação -->
        <div class="mt-4">
            {{ $products->links() }}
        </div>
    </div>

    <!-- Modal de Cadastro/Edição -->
    <div x-data="{ open: @entangle('showModal') }" x-show="open" class="fixed inset-0 z-50 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4">
            <!-- Overlay -->
            <div x-show="open" class="fixed inset-0 bg-black opacity-50" @click="open = false"></div>

            <!-- Modal -->
            <div class="bg-white rounded-lg shadow-lg w-full max-w-md relative">
                <div class="p-6">
                    <h2 class="text-lg font-semibold text-gray-700">{{ $modalType === 'create' ? 'Cadastrar Produto' : 'Editar Produto' }}</h2>
                    <form wire:submit.prevent="saveProduct">
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700">Nome</label>
                            <input type="text" wire:model="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700">Descrição</label>
                            <textarea wire:model="description" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                            @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700">Preço</label>
                            <input type="number" wire:model="price" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @error('price') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div class="mt-6">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 focus:outline-none">
                                Salvar
                            </button>
                            <button type="button" @click="open = false" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 focus:outline-none ml-2">
                                Cancelar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>