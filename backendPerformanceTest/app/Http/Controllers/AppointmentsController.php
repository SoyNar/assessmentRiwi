<?php

namespace App\Http\Controllers;

use App\Models\MedicalSchedule;
use App\Models\ScheduledAppoinments;
use Illuminate\Http\Request;



class AppointmentsController extends Controller
{


    public function index()
    {
        $appointments = ScheduledAppoinments::with('doctor', 'user')->get();

        return view('appointments.index', compact('appointments'));
    }

    // Método para mostrar el formulario de agendar cita
    public function create()
    {
        $availableSchedules = MedicalSchedule::where('available', true)
            ->with('user')
            ->get();

        return view('appointments.create', compact('availableSchedules'));
    }

    public function store(Request $request)
    {
        dd($request->all());
        $request->validate([
            'schedule_id' => 'required|exists:medical_schedule,id',
            'reason' => 'required|string',
        ]);


        $schedule = MedicalSchedule::find($request->schedule_id);

        if (!auth()->user()->hasRole('patient')) {
            return redirect()->route('appointments.create')->with('error', 'Solo los pacientes pueden agendar citas.');
        }


        $appointment = ScheduledAppoinments::create([
            'user_id' => auth()->id(),
            'doctor_id' => $schedule->user_id,
            'appointment_date' => $schedule->available_from,
            'status' => 'Agendada',
            'reason' => $request->reason,
            'created_by' => auth()->id(),
        ]);

        dd($appointment);


        $schedule->update(['available' => false]);

        return redirect()->route('appointments.index')->with('success', 'Cita agendada correctamente');
    }


}
