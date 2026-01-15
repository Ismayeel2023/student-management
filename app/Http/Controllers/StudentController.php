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

    public function store(Request $request) {
        Student::create($request->all());
        return redirect('/students');
    }

    public function edit($id) {
        $student = Student::findOrFail($id);
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, $id) {
        Student::findOrFail($id)->update($request->all());
        return redirect('/students');
    }

    public function destroy($id) {
        Student::destroy($id);
        return redirect('/students');
    }
}

