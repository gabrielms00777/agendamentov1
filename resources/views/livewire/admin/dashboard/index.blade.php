<div>
    <x-breadcrumb :links="[
        ['text' => 'Dashboard', 'url' => route('admin.dashboard')],
    ]" />
    <div>
        <!-- Cards de Métricas -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Total de Agendamentos -->
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-lg font-semibold text-gray-700">Agendamentos Hoje</h2>
                <p class="text-2xl font-bold text-gray-900">{{ $totalAppointments }}</p>
            </div>

            <!-- Faturamento do Dia -->
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-lg font-semibold text-gray-700">Faturamento Hoje</h2>
                <p class="text-2xl font-bold text-gray-900">R$ {{ number_format($totalRevenue, 2, ',', '.') }}</p>
            </div>

            <!-- Serviços Mais Populares -->
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-lg font-semibold text-gray-700">Serviços Populares</h2>
                <ul class="mt-2">
                    @foreach ($popularServices as $service)
                    <li class="text-gray-600">{{ $service->name }} ({{ $service->appointments_count }}x)</li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Gráfico de Agendamentos -->
        <div class="bg-white p-6 rounded-lg shadow mb-8">
            <h2 class="text-lg font-semibold text-gray-700 mb-4">Agendamentos ao Longo do Dia</h2>
            <canvas id="appointmentsChart" class="w-full h-64"></canvas>
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

        <!-- Botão de Seleção de Período -->
        <div class="mt-6">
            <button class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 focus:outline-none">
                Selecionar Período
            </button>
        </div>
    </div>

    <!-- Script para o Gráfico -->
    <!-- @push('scripts') -->
    @script
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('livewire:load', function() {
            const ctx = document.getElementById('appointmentsChart').getContext('2d');
            const appointmentsChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['08:00', '10:00', '12:00', '14:00', '16:00', '18:00'],
                    datasets: [{
                        label: 'Agendamentos',
                        data: [5, 10, 8, 12, 7, 9],
                        backgroundColor: 'rgba(59, 130, 246, 0.2)',
                        borderColor: 'rgba(59, 130, 246, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
    @endscript
    <!-- @endpush -->
</div>