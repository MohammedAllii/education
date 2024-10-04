<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\TeacherSchedule;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function index()
    {
        $classes = Classe::all();
        return view('classes.classes', compact('classes'));
    }

    public function create()
    {
        return view('classes.addclasse');
    }

    public function store(Request $request)
    {
        $request->validate([
            'class_name' => 'required|string|max:255',
            'grade_level' => 'required|string|max:255',
            'school_year' => 'required|string|max:255',
            'classroom' => 'required|string|max:255',
        ]);

        $existingClass = Classe::where('class_name', $request->input('class_name'))
                               ->where('grade_level', $request->input('grade_level'))
                               ->where('school_year', $request->input('school_year'))
                               ->first();

        if ($existingClass) {
            return redirect()->back()->withInput()
                ->with('error', 'Une classe avec ce nom et ce niveau scolaire existe déjà.');
        }

        Classe::create([
            'class_name' => $request->input('class_name'),
            'grade_level' => $request->input('grade_level'),
            'school_year' => $request->input('school_year'),
            'classroom' => $request->input('classroom'),
        ]);

        return redirect()->route('classes.index')->with('success', 'Classe créée avec succès.');
    }

    public function show(Classe $class)
    {
        return view('classes.show', compact('class'));
    }

    public function edit(Classe $class)
    {
        return view('classes.edit', compact('class'));
    }

    public function update(Request $request, Classe $class)
    {
        $request->validate([
            'class_name' => 'required|string|max:255',
            'grade_level' => 'required|string|max:255',
            'school_year' => 'required|string|max:255',
            'classroom' => 'required|string|max:255',
        ]);

        $existingClass = Classe::where('class_name', $request->input('class_name'))
                               ->where('grade_level', $request->input('grade_level'))
                               ->where('id', '!=', $class->id)
                               ->first();

        if ($existingClass) {
            return redirect()->back()->withInput()
                ->with('error', 'Une classe avec ce nom et ce niveau scolaire existe déjà.');
        }

        $class->update([
            'class_name' => $request->input('class_name'),
            'grade_level' => $request->input('grade_level'),
            'school_year' => $request->input('school_year'),
            'classroom' => $request->input('classroom'),
        ]);

        return redirect()->route('classes.index')->with('success', 'Classe mise à jour avec succès.');
    }

    public function destroy(Classe $class)
    {
        $class->delete();

        return redirect()->route('classes.index')->with('success', 'Class deleted successfully.');
    }

    public function getClassSchedule($classId)
    {
        $schedules = TeacherSchedule::with('class')
            ->where('class_id', $classId)
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
}
