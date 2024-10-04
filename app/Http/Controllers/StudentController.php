<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Classe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('class')->get();
        $classes = Classe::get();
        return view('students.students', compact('students', 'classes'));
    }

    public function create()
    {
        $classes = Classe::all(); 
        return view('students.addstudent', compact('classes'));
    }

    public function filter(Request $request)
    {
        $classId = $request->input('class_filter');
        $enrollmentDate = $request->input('enrollment_date_filter');

        // Fetch the classes for the dropdown
        $classes = Classe::all(); 

        $query = Student::query();

        if (!empty($classId)) {
            $query->where('class_id', $classId);
        }

        if (!empty($enrollmentDate)) {
            $query->whereDate('enrollment_date', $enrollmentDate);
        }

        // Use paginate instead of get to handle pagination
        $students = $query->with('class')->get();

        // Return empty response if no students found
        if ($students->isEmpty()) {
            return response()->json(['message' => 'No students found'], 204); 
        }

        if ($request->ajax()) {
            // Return only the table portion if it's an AJAX request
            return view('students.students_table', compact('students'))->render();
        }

        // Return the full view if it's not an AJAX request
        return view('students.students_table', compact('students', 'classes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female',
            'address' => 'nullable|string|max:255',
            'parent_name' => 'required|string|max:255',
            'parent_phone' => 'required|string|max:15',
            'parent_email' => 'nullable|email',
            'enrollment_date' => 'required|date',
            'class_id' => 'required|exists:classes,id',
            'status' => 'required|in:active,transferred,suspended',
            'avatar' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048', 
            'medical_notes' => 'nullable|string'
        ]);

        $data = $request->all();

        if ($request->hasFile('avatar')) {
            $fileName = time() . '_' . $request->file('avatar')->getClientOriginalName();
            $path = $request->file('avatar')->move(public_path('assets/students'), $fileName);
            $data['avatar'] = 'assets/students/' . $fileName; 
        }

        Student::create($data);
        return Redirect::route('students.index')->with('success', 'Student created successfully.');
    }

    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        $classes = Classe::all(); 
        return view('students.edit', compact('student', 'classes'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female',
            'address' => 'nullable|string|max:255',
            'parent_name' => 'required|string|max:255',
            'parent_phone' => 'required|string|max:15',
            'parent_email' => 'nullable|email',
            'enrollment_date' => 'required|date',
            'class_id' => 'required|exists:classes,id',
            'status' => 'required|in:active,transferred,suspended',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'medical_notes' => 'nullable|string'
        ]);
    
        // Update student details
        $student->full_name = $request->full_name;
        $student->date_of_birth = $request->date_of_birth;
        $student->gender = $request->gender;
        $student->address = $request->address;
        $student->parent_name = $request->parent_name;
        $student->parent_phone = $request->parent_phone;
        $student->parent_email = $request->parent_email;
        $student->enrollment_date = $request->enrollment_date;
        $student->class_id = $request->class_id;
        $student->status = $request->status;
        $student->medical_notes = $request->medical_notes;
    
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $imageName = time() . '.' . $avatar->getClientOriginalExtension();
            $avatar->move(public_path('assets/students'), $imageName);
            $student->avatar = 'assets/students/' . $imageName;
        }
    
        $student->save(); // Use save() to persist the changes
    
        return redirect()->route('students.index')->with('success', 'Student updated successfully');
    }

    public function destroy(Student $student)
    {
        $student->delete();
    
        return redirect()->route('students.index')->with('success', 'Student deleted successfully');
    }
}
