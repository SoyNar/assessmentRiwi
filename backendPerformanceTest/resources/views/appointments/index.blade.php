<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointments</title>
</head>
<body>
<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <h2 class="text-lg font-bold mb-4">Citas Agendadas</h2>

        <!-- Mostrar mensaje de éxito si existe -->
        @if (session('success'))
            <div class="mb-4 text-green-500">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tabla para mostrar las citas -->
        <table class="min-w-full table-auto">
            <thead>
            <tr>
                <th class="px-4 py-2 border">#</th>
                <th class="px-4 py-2 border">Paciente</th>
                <th class="px-4 py-2 border">Médico</th>
                <th class="px-4 py-2 border">Fecha de la cita</th>
                <th class="px-4 py-2 border">Estado</th>
                <th class="px-4 py-2 border">Razón</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($appointments as $appointment)
                <tr>
                    <td class="px-4 py-2 border">{{ $appointment->id }}</td>
                    <td class="px-4 py-2 border">{{ $appointment->user->name }}</td>
                    <td class="px-4 py-2 border">{{ $appointment->doctor->name }}</td>
                    <td class="px-4 py-2 border">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d/m/Y H:i') }}</td>
                    <td class="px-4 py-2 border">{{ $appointment->status }}</td>
                    <td class="px-4 py-2 border">{{ $appointment->reason }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            <a href="{{ route('appointments.create') }}" class="inline-block px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-700">Agendar Nueva Cita</a>
        </div>
    </x-authentication-card>
</x-guest-layout>
</body>
</html>
