<?php

namespace App\Http\Controllers;

use App\Models\TeacherSchedule;
use App\Models\Classe; // Assuming you have a Class model
use Illuminate\Http\Request;

class TeacherScheduleController extends Controller
{
    // Fetch classes for the modal
    public function getTeacherData(Request $request)
    {
        $userId = $request->input('user_id');
        $classes = Classe::all(); 

        return response()->json([
            'user_id' => $userId,
            'classes' => $classes
        ]);
    }

    // Save the teacher's schedule
    public function saveSchedule(Request $request)
    {
        $validatedData = $request->validate([
            'class_id' => 'required|exists:classes,id',
            'user_id' => 'required|exists:users,id',
            'day' => 'required|string',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
        ]);

        // Check for overlapping schedules
        $overlapExists = TeacherSchedule::where('user_id', $validatedData['user_id'])
        ->where('day', $validatedData['day'])
        ->where(function ($query) use ($validatedData) {
            $query->where(function($query) use ($validatedData) {
                $query->where('start_time', '<', $validatedData['end_time'])
                    ->where('end_time', '>', $validatedData['start_time']);
            });
        })
        ->exists();


        if ($overlapExists) {
            return response()->json(['message' => 'Schedule overlaps with an existing schedule.'], 400);
        }

        // Create new schedule entry
        TeacherSchedule::create($validatedData);

        return response()->json(['message' => 'Schedule saved successfully!'], 201);
    }

    public function getTeacherSchedule($userId)
    {
        $schedules = TeacherSchedule::with('class')
            ->where('user_id', $userId)
            ->get();

        $events = [];

        foreach ($schedules as $schedule) {
            $class = $schedule->class;

            if ($class) {
                $events[] = [
                    'title' => $class->grade_level . ' ' . $class->class_name,
                    'day' => $schedule->day,
                    'start' => $schedule->start_time,
                    'end' => $schedule->end_time,
                    'id' => $schedule->id,
                    'classroom' => $class->classroom,
                ];
            }
        }

        // Return the array of events
        return response()->json($events);
    }

    public function deleteSchedule($id)
    {
        try {
            $schedule = TeacherSchedule::findOrFail($id);
            $schedule->delete();
            return response()->json(['message' => 'Horaire supprimé avec succès'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erreur lors de la suppression de l\'horaire', 'error' => $e->getMessage()], 500);
        }
    }
}
