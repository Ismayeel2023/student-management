<!DOCTYPE html>
<html>
<head>
    <title>Student Management</title>
    <style>
        body { font-family: Arial; padding: 40px; }
        a { margin-right: 10px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ccc; padding: 8px; }
    </style>
</head>
<body>

<nav>
    <a href="/students">Students</a>
    <a href="/students/create">Add Student</a>
    <form method="POST" action="/logout" style="display:inline;">
        @csrf
        <button>Logout</button>
    </form>
</nav>

<hr>
@if ($errors->any())
    <div style="color:red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('success'))
    <div style="color:green;">
        {{ session('success') }}
    </div>
@endif

@yield('content')

</body>
</html>
