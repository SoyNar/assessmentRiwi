<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
</head>
<body>

<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('appointments.store') }}">
            @csrf

            <div class="mt-4">
                <x-label for="reason" value="{{ __('Reason for the appointment') }}" />
                <x-input id="reason" class="block mt-1 w-full" type="text" name="reason" required />
            </div>

            <div class="mt-4">
                <x-label for="schedule_id" value="{{ __('Select a Doctor Availability') }}" />
                <select id="schedule_id" name="schedule_id" class="block mt-1 w-full" required>
                    <option value="">Select a schedule</option>
                    @foreach ($availableSchedules as $schedule)
                        <option value="{{ $schedule->id }}">
                            {{ $schedule->user->name }} - {{ \Carbon\Carbon::parse($schedule->available_from)->format('d/m/Y H:i') }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ms-4">
                    {{ __('Book Appointment') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>

</body>
</html>
