<?php

namespace App\Http\Controllers;

use App\Models\MedicalSchedule;
use Illuminate\Http\Request;

class MedicalSheduleController extends Controller
{


    public function store(Request $request)
    {
        $request->validate([
            'available_from' => 'required|date|after_or_equal:today',
            'available_to' => 'required|date|after:available_from',
        ]);

        // Guardamos la disponibilidad del médico
        $schedule = new MedicalSchedule([
            'user_id' => auth()->id(),
            'available_from' => $request->available_from,
            'available_to' => $request->available_to,
            'available' => true,
            'date' => $request->available_from,

        ]);

        $schedule->save();

        return redirect()->route('medical_schedule.index')->with('success', 'Disponibilidad guardada correctamente.');
    }

    // Mostrar la disponibilidad del médico
    public function index()
    {
        $schedules = MedicalSchedule::where('user_id', auth()->id())->get();
        return view('medical_schedule.index', compact('schedules'));
    }

    // Eliminar una disponibilidad
    public function destroy($id)
    {
        $schedule = MedicalSchedule::find($id);

        if ($schedule && $schedule->user_id == auth()->id()) {
            $schedule->delete();
            return back()->with('success', 'Disponibilidad eliminada correctamente.');
        }

        return back()->with('error', 'No tienes permiso para eliminar esta disponibilidad.');
    }
}
