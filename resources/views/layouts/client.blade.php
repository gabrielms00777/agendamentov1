<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">
    <!-- Sidebar -->
    <div class="flex">
        <aside class="w-64 bg-white shadow-md h-screen fixed">
            <div class="p-4">
                <h1 class="text-2xl font-bold">Cliente</h1>
                <nav class="mt-6">
                    <a href="{{ route('client.appointments.index') }}" class="block py-2 px-4 hover:bg-gray-200">Meus Agendamentos</a>
                    <a href="{{ route('client.loyalty.index') }}" class="block py-2 px-4 hover:bg-gray-200">Fidelidade</a>
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