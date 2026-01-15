@extends('layouts.app')

@section('content')
<div class="card">

<h2>Edit Student</h2>

<form method="POST" action="/students/{{ $student->id }}">
@csrf
@method('PUT')

<label>Name</label>
<input type="text" name="name" value="{{ $student->name }}">

<label>Email</label>
<input type="email" name="email" value="{{ $student->email }}">

<label>Course</label>
<input type="text" name="course" value="{{ $student->course }}">

<label>Year</label>
<input type="number" name="year" value="{{ $student->year }}">

<button class="btn btn-primary" type="submit">Update</button>
</form>

</div>
@endsection
