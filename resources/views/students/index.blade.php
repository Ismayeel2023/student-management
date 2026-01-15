@extends('layouts.app')

@section('content')
<h2>Students List</h2>
    
@if($students->count() == 0)
    <p>No students found.</p>
@endif

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
        <a href="/students/{{ $student->id }}/edit">Edit</a>
        <form method="POST" action="/students/{{ $student->id }}" style="display:inline;">
            @csrf @method('DELETE')
            <button>Delete</button>
        </form>
    </td>
</tr>
@endforeach
</table>
@endsection
