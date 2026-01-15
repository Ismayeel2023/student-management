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

@yield('content')

</body>
</html>
