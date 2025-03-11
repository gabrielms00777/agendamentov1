<div>
    <!-- Cards de Métricas -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Total de Agendamentos -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold text-gray-700">Agendamentos Hoje</h2>
            <p class="text-2xl font-bold text-gray-900">{{ $totalAppointments }}</p>
        </div>

        <!-- Total de Clientes -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold text-gray-700">Total de Clientes</h2>
            <p class="text-2xl font-bold text-gray-900">{{ $totalClients }}</p>
        </div>
    </div>

    <!-- Lista de Agendamentos do Dia -->
    <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">Agendamentos de Hoje</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cliente</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Serviço</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Horário</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($appointmentsToday as $appointment)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $appointment->client->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $appointment->service->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $appointment->date_time->format('H:i') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-sm rounded-full {{ $appointment->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : ($appointment->status === 'confirmed' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') }}">
                                {{ $appointment->status }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>