<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

use Inertia\Inertia;

class StudentController extends Controller
{
    public function index(Request $request) {
        $query = Student::with('course');

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $students = $query->paginate(10);
        return Inertia::render('Students/Index', [
            'students' => $students
        ]);
    }

    public function create() {
        $courses = Course::all();
        return Inertia::render('Students/Create', [
            'courses' => $courses
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'            => 'required|string|max:255',
            'email'           => 'required|email|unique:students,email',
            'course_id'       => 'required|exists:courses,id',
            'year'            => 'required|integer|min:1|max:5',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('students', 'public');
            $validated['profile_picture'] = $path;
        }

        Student::create($validated);

        return redirect('/students')->with('success', 'Student added successfully');
    }


    public function edit($id) {
        $student = Student::findOrFail($id);
        $courses = Course::all();
        return Inertia::render('Students/Edit', [
            'student' => $student,
            'courses' => $courses
        ]);
    }

    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        $validated = $request->validate([
            'name'            => 'required|string|max:255',
            'email'           => 'required|email|unique:students,email,' . $id,
            'course_id'       => 'required|exists:courses,id',
            'year'            => 'required|integer|min:1|max:5',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('profile_picture')) {
            // Delete old image
            if ($student->profile_picture) {
                Storage::disk('public')->delete($student->profile_picture);
            }
            $path = $request->file('profile_picture')->store('students', 'public');
            $validated['profile_picture'] = $path;
        }

        $student->update($validated);

        return redirect('/students')->with('success', 'Student updated successfully');
    }


    public function destroy($id) {
        $student = Student::findOrFail($id);
        if ($student->profile_picture) {
            Storage::disk('public')->delete($student->profile_picture);
        }
        $student->delete();
        return redirect('/students');
    }
}

