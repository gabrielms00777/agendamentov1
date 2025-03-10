<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">
    <!-- Sidebar -->
    <div class="flex">
        <aside class="w-64 bg-white shadow-md h-screen fixed">
            <div class="p-4">
                <h1 class="text-2xl font-bold">Admin</h1>
                <nav class="mt-6">
                    <a href="{{ route('admin.dashboard') }}" class="block py-2 px-4 hover:bg-gray-200">Dashboard</a>
                    <a href="{{ route('admin.appointments.index') }}" class="block py-2 px-4 hover:bg-gray-200">Agendamentos</a>
                    <a href="{{ route('admin.services.index') }}" class="block py-2 px-4 hover:bg-gray-200">Serviços</a>
                    <a href="{{ route('admin.professionals.index') }}" class="block py-2 px-4 hover:bg-gray-200">Profissionais</a>
                    <a href="{{ route('admin.clients.index') }}" class="block py-2 px-4 hover:bg-gray-200">Clientes</a>
                    <a href="{{ route('admin.products.index') }}" class="block py-2 px-4 hover:bg-gray-200">Produtos</a>
                    <a href="{{ route('admin.reports.index') }}" class="block py-2 px-4 hover:bg-gray-200">Relatórios</a>
                </nav>
            </div>
        </aside>

        <!-- Conteúdo -->
        <main class="flex-1 ml-64 p-6">
            {{ $slot }}
        </main>
    </div>
</body>

</html>