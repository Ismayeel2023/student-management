@extends('layouts.app')

@section('content')
<div class="card">

<h2>Add Student</h2>

<form method="POST" action="/students">
@csrf

<label>Name</label>
<input type="text" name="name">

<label>Email</label>
<input type="email" name="email">

<label>Course</label>
<input type="text" name="course">

<label>Year</label>
<input type="number" name="year">

<button class="btn btn-primary" type="submit">Save</button>
</form>

</div>
@endsection
