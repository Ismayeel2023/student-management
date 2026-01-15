@extends('layouts.app')

@section('content')
<h2>Add Student</h2>

<form method="POST" action="/students">
@csrf

<label>Name</label><br>
<input type="text" name="name"><br><br>

<label>Email</label><br>
<input type="email" name="email"><br><br>

<label>Course</label><br>
<input type="text" name="course"><br><br>

<label>Year</label><br>
<input type="number" name="year"><br><br>

<button type="submit">Save</button>
</form>
@endsection
