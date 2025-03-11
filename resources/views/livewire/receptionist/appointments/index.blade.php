<div>
    <!-- Breadcrumb -->
    <x-breadcrumb :links="[
        ['text' => 'Dashboard', 'url' => route('receptionist.dashboard')],
        ['text' => 'Agendamentos', 'url' => route('receptionist.appointments.index')],
    ]" />

    <!-- Filtros -->
    <div class="bg-white p-6 rounded-lg shadow mt-4">
        <div class="flex justify-between items-center">
            <h2 class="text-lg font-semibold text-gray-700">Agendamentos</h2>
            <div>
                <button wire:click="toggleFilters" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 focus:outline-none">
                    {{ $showFilters ? 'Ocultar Filtros' : 'Mostrar Filtros' }}
                </button>
            </div>
        </div>

        <!-- Div de Filtros -->
        @if ($showFilters)
            <div class="mt-4 grid grid-cols-1 md:grid-cols-4 gap-4">
                <!-- Filtro por Data -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Data</label>
                    <input type="date" wire:model="filters.date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>

                <!-- Filtro por Status -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Status</label>
                    <select wire:model="filters.status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        <option value="">Todos</option>
                        @foreach ($statuses as $status)
                            <option value="{{ $status->value }}">{{ $status->value }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Filtro por Cliente -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Cliente</label>
                    <select wire:model="filters.client_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        <option value="">Todos</option>
                        @foreach ($clients as $client)
                            <option value="{{ $client->id }}">{{ $client->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Filtro por Profissional -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Profissional</label>
                    <select wire:model="filters.professional_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        <option value="">Todos</option>
                        @foreach ($professionals as $professional)
                            <option value="{{ $professional->id }}">{{ $professional->user->name }}</option>
                        @endforeach
                    </select>
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

    <!-- Lista de Agendamentos -->
    <div class="bg-white p-6 rounded-lg shadow mt-4">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cliente</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Serviço</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Profissional</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data/Horário</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($appointments as $appointment)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $appointment->client->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $appointment->service->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $appointment->professional->user->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $appointment->date_time->format('d/m/Y H:i') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-sm rounded-full {{ $appointment->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : ($appointment->status === 'confirmed' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') }}">
                                    {{ $appointment->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <button wire:click="updateStatus({{ $appointment->id }}, 'confirmed')" class="text-green-600 hover:text-green-900">Confirmar</button>
                                <button wire:click="updateStatus({{ $appointment->id }}, 'canceled')" class="text-red-600 hover:text-red-900 ml-2">Cancelar</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Paginação -->
        <div class="mt-4">
            {{ $appointments->links() }}
        </div>
    </div>
</div>