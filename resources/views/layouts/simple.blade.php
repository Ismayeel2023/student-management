<!DOCTYPE html>
<html>
<head>
    <title>Student Management</title>
    <style>
        :root {
            --primary: #4f46e5;
            --primary-light: #eef2ff;

            --success: #16a34a;
            --success-light: #ecfdf5;

            --danger: #dc2626;
            --danger-light: #fef2f2;

            --bg: #f8fafc;
            --card: #ffffff;
            --border: #e5e7eb;

            --text: #0f172a;
            --muted: #64748b;
        }

        body {
            margin: 0;
            font-family: "Segoe UI", system-ui, sans-serif;
            background: linear-gradient(135deg, #f8fafc, #e2e8f0);
            color: var(--text);
            transition: background 0.3s, color 0.3s;
        }

        body.dark {
            --bg: #020617;
            --card: #020617;
            --border: #1e293b;

            --text: #e5e7eb;
            --muted: #94a3b8;

            --primary: #60a5fa;
            --primary-light: #1e293b;

            --success: #4ade80;
            --success-light: #022c22;

            --danger: #fb7185;
            --danger-light: #450a0a;

            background: linear-gradient(135deg, #0f172a, #020617);
        }

        .container {
            max-width: 1000px;
            margin: auto;
            padding: 30px;
        }

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

        .card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            transition: transform 0.15s ease, box-shadow 0.15s ease;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.08);
        }

        h2 {
            margin-top: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th {
            background: var(--primary-light);
            color: var(--muted);
            text-align: left;
            font-size: 13px;
            border-bottom: 1px solid var(--border);
            padding: 12px;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid var(--border);
            color: var(--text);
        }

        tr:hover {
            background: rgba(0,0,0,0.04);
        }

        body.dark tr:hover {
            background: rgba(255,255,255,0.04);
        }

        .btn {
            padding: 6px 14px;
            border-radius: 8px;
            font-size: 13px;
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background: linear-gradient(to right, #4f46e5, #6366f1);
            color: white;
        }

        .btn-primary:hover {
            background: linear-gradient(to right, #4338ca, #4f46e5);
        }

        .btn-danger {
            background: linear-gradient(to right, #dc2626, #ef4444);
            color: white;
        }

        .btn-outline {
            background: var(--primary-light);
            color: var(--primary);
        }

        .btn-outline:hover {
            background: var(--primary);
            color: white;
        }

        label {
            font-size: 13px;
            color: var(--muted);
        }

        input {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid var(--border);
            margin-top: 6px;
            margin-bottom: 18px;
            background: var(--card);
            color: var(--text);
        }

        input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 2px rgba(96,165,250,0.3);
        }

        .alert-success {
            background: var(--success-light);
            color: var(--success);
            border-left: 4px solid var(--success);
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .alert-error {
            background: var(--danger-light);
            color: var(--danger);
            border-left: 4px solid var(--danger);
            padding: 12px;
            border-radius: 8px;
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
