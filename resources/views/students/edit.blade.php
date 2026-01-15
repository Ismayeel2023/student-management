@extends('layouts.app')

@section('content')
<h2>Edit Student</h2>

<form method="POST" action="/students/{{ $student->id }}">
@csrf
@method('PUT')

<label>Name</label><br>
<input type="text" name="name" value="{{ $student->name }}"><br><br>

<label>Email</label><br>
<input type="email" name="email" value="{{ $student->email }}"><br><br>

<label>Course</label><br>
<input type="text" name="course" value="{{ $student->course }}"><br><br>

<label>Year</label><br>
<input type="number" name="year" value="{{ $student->year }}"><br><br>

<button type="submit">Update</button>
</form>
@endsection
