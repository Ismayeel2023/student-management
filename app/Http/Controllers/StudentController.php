<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index() {
        $students = Student::all();
        return view('students.index', compact('students'));
    }

    public function create() {
        return view('students.create');
    }

        public function store(Request $request)
    {
        $validated = $request->validate([
            'name'   => 'required|string|max:255',
            'email'  => 'required|email|unique:students,email',
            'course' => 'required|string|max:100',
            'year'   => 'required|integer|min:1|max:5',
        ]);

        Student::create($validated);

        return redirect('/students')->with('success', 'Student added successfully');
    }


    public function edit($id) {
        $student = Student::findOrFail($id);
        return view('students.edit', compact('student'));
    }

        public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name'   => 'required|string|max:255',
            'email'  => 'required|email|unique:students,email,' . $id,
            'course' => 'required|string|max:100',
            'year'   => 'required|integer|min:1|max:5',
        ]);

        Student::findOrFail($id)->update($validated);

        return redirect('/students')->with('success', 'Student updated successfully');
    }


    public function destroy($id) {
        Student::destroy($id);
        return redirect('/students');
    }
}

