<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Books List</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f7fafc;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        .book-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            padding: 20px;
        }
        .book-card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .btn {
            display: inline-block;
            background-color: #4299e1;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 0.375rem;
            text-decoration: none;
            transition: background-color 0.2s;
        }
        .btn:hover {
            background-color: #3182ce;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Books List</h1>
        <a href="{{ url('/book/add') }}" class="btn">Add New Book</a>
        <div class="book-list">
            @foreach($books as $book)
                <div class="book-card">
                    <h2>{{ $book->title }}</h2>
                    <p>{{ $book->description }}</p>
                    <a href="{{ url('/book/' . $book->id) }}" class="btn">View Details</a>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>
