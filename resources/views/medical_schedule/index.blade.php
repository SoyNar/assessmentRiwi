<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestión de Disponibilidad Médica</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
<div class="min-h-screen py-8">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 text-center">
                Gestión de Disponibilidad
            </h1>
            <p class="mt-2 text-center text-gray-600">
                Configure sus horarios de atención médica
            </p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <form action="{{ route('medical_schedule.store') }}" method="POST" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label for="available_from" class="block text-sm font-medium text-gray-700">
                            Hora de Inicio
                        </label>
                        <input
                            type="datetime-local"
                            name="available_from"
                            id="available_from"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                            required
                        >
                    </div>

                    <div class="space-y-2">
                        <label for="available_to" class="block text-sm font-medium text-gray-700">
                            Hora de Finalización
                        </label>
                        <input
                            type="datetime-local"
                            name="available_to"
                            id="available_to"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                            required
                        >
                    </div>
                </div>

                <div class="flex justify-end">
                    <button
                        type="submit"
                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                    >
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        Guardar Disponibilidad
                    </button>
                </div>
            </form>
        </div>

        <!-- Schedule List Card -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">
                Horarios Programados
            </h2>

            @if($schedules->isEmpty())
                <p class="text-gray-500 text-center py-4">
                    No hay horarios disponibles programados.
                </p>
            @else
                <div class="space-y-4">
                    @foreach($schedules as $schedule)
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                            <div class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span class="text-sm text-gray-700">
                                        {{ \Carbon\Carbon::parse($schedule->available_from)->format('d/m/Y H:i') }} -
                                        {{ \Carbon\Carbon::parse($schedule->available_to)->format('d/m/Y H:i') }}
                                    </span>
                            </div>

                            <form action="{{ route('medical_schedule.destroy', $schedule->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button
                                    type="submit"
                                    class="inline-flex items-center px-3 py-1 border border-transparent rounded-md text-sm font-medium text-red-600 hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                                >
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
</body>
</html>
