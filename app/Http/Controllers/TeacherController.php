<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class TeacherController extends Controller
{
    // Afficher la liste des enseignants
    public function index()
    {
        $teachers = User::where('role', 1)->get();
        return view('teachers.teachers', compact('teachers'));
    }

    // Afficher le formulaire de création d'un enseignant
    public function create()
    {
        return view('teachers.addteacher');
    }

    // Enregistrer un nouvel enseignant
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:20',
            'speciality' => 'required|string|max:255',
            'status' => 'required|string|max:50',
            'password' => 'required|string|min:8|confirmed',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $teacher = new User($request->all());
        $teacher->password = bcrypt($request->password);

        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $teacher->avatar = $avatarPath;
        }

        $teacher->save();

        return redirect()->route('teachers.index')->with('success', 'Teacher created successfully.');
    }

    // Mettre à jour un enseignant
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'phone' => 'required|string|max:20',
            'speciality' => 'required|string|max:255',
            'status' => 'required|string|max:50',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $teacher = User::findOrFail($id);
        $teacher->fill($request->all());

        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $teacher->avatar = $avatarPath;
        }

        $teacher->save();

        return redirect()->route('teachers.index')->with('success', 'Teacher updated successfully.');
    }

    // Supprimer un enseignant
    public function destroy($id)
    {
        $teacher = User::findOrFail($id);
        $teacher->delete();

        return redirect()->route('teachers.index')->with('success', 'Teacher deleted successfully.');
    }

    // Afficher la page de calendrier pour un enseignant
    public function showSchedule($id)
    {
        $teacher = User::findOrFail($id);
        return view('teachers.calendar', compact('teacher'));
    }
}