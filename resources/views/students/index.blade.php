@extends('layouts.app')

@section('content')
<div class="card">
<h2>Students</h2>

@if($students->count() == 0)
    <p>No students found.</p>
@else
<table>
<tr>
    <th>Name</th>
    <th>Email</th>
    <th>Course</th>
    <th>Year</th>
    <th>Actions</th>
</tr>

@foreach($students as $student)
<tr>
    <td>{{ $student->name }}</td>
    <td>{{ $student->email }}</td>
    <td>{{ $student->course }}</td>
    <td>{{ $student->year }}</td>
    <td>
        <a class="btn btn-outline" href="/students/{{ $student->id }}/edit">Edit</a>

        <form method="POST" action="/students/{{ $student->id }}" style="display:inline;">
            @csrf @method('DELETE')
            <button class="btn btn-danger">Delete</button>
        </form>
    </td>
</tr>
@endforeach
</table>
@endif
</div>
@endsection
