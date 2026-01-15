<!DOCTYPE html>
<html>
<head>
    <title>Student Management</title>
    <style>
     :root {
        --primary: #4f46e5;
        --bg: #f9fafb;
        --card: #ffffff;
        --border: #e5e7eb;
        --text: #111827;
        --muted: #6b7280;
    }

    body.dark {
        --primary: #818cf8;
        --bg: #0f172a;
        --card: #020617;
        --border: #1e293b;
        --text: #e5e7eb;
        --muted: #94a3b8;
    }

   body {
        margin: 0;
        font-family: "Segoe UI", system-ui, sans-serif;
        background: var(--bg);
        color: var(--text);
        transition: background 0.3s, color 0.3s;
    }

    .container {
        max-width: 1000px;
        margin: auto;
        padding: 30px;
    }

    /* Navbar */
    nav {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }

    nav a {
        text-decoration: none;
        color: var(--muted);
        margin-right: 15px;
        font-weight: 500;
    }

    nav a:hover {
        color: var(--primary);
    }

    /* Card */
    .card {
        background: var(--card);
        border: 1px solid var(--border);
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.03);
    }

    h2 {
        margin-top: 0;
    }

    /* Table */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
    }

    th {
        text-align: left;
        font-size: 13px;
        color: var(--muted);
        border-bottom: 1px solid var(--border);
        padding: 10px;
    }

    td {
        padding: 12px 10px;
        border-bottom: 1px solid var(--border);
    }

    tr:hover {
        background: #f3f4f6;
    }

    .btn {
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 13px;
        border: none;
        cursor: pointer;
    }

    .btn-primary {
        background: var(--primary);
        color: white;
    }

    .btn-danger {
        background: #ef4444;
        color: white;
    }

    .btn-outline {
        background: transparent;
        border: 1px solid var(--border);
        color: var(--muted);
    }

    .btn:hover {
        opacity: 0.9;
    }

    .btn-outline:hover {
        background: var(--border);
    }


    label {
        font-size: 13px;
        color: var(--muted);
    }

    input {
        width: 100%;
        padding: 8px 10px;
        border-radius: 6px;
        border: 1px solid var(--border);
        margin-top: 4px;
        margin-bottom: 15px;
    }

    input:focus {
        outline: none;
        border-color: var(--primary);
    }

    /* Alerts */
    .alert-success {
        background: #ecfdf5;
        color: #065f46;
        padding: 10px;
        border-radius: 6px;
        margin-bottom: 15px;
    }

    .alert-error {
        background: #fef2f2;
        color: #991b1b;
        padding: 10px;
        border-radius: 6px;
        margin-bottom: 15px;
    }
</style>

</head>
<body>
<div class="container">

<nav>
    <div>
        <a href="/students">Students</a>
        <a href="/students/create">Add Student</a>
    </div>

    <div>
        <button id="themeToggle" class="btn btn-outline">🌙</button>

        <form method="POST" action="/logout" style="display:inline;">
            @csrf
            <button class="btn btn-outline">Logout</button>
        </form>
    </div>
</nav>



@if ($errors->any())
    <div class="alert-error">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
@endif

@yield('content')

</div>

<script>
    const toggleBtn = document.getElementById('themeToggle');
    const body = document.body;

    // Load saved theme
    if (localStorage.getItem('theme') === 'dark') {
        body.classList.add('dark');
        toggleBtn.textContent = '☀️';
    }

    toggleBtn.addEventListener('click', () => {
        body.classList.toggle('dark');

        if (body.classList.contains('dark')) {
            localStorage.setItem('theme', 'dark');
            toggleBtn.textContent = '☀️';
        } else {
            localStorage.setItem('theme', 'light');
            toggleBtn.textContent = '🌙';
        }
    });
</script>

</body>

</html>
