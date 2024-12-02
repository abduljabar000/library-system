<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Welcome</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <!-- Styles -->
        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */
            html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}
            body {
                font-family: 'Nunito', sans-serif;
                background-color: #f7fafc;
            }
            .container {
                min-height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
                text-align: center;
            }
            .content {
                padding: 2rem;
            }
            h1 {
                font-size: 3rem;
                color: #2d3748;
                margin-bottom: 1rem;
            }
            p {
                color: #4a5568;
                margin-bottom: 2rem;
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
            <div class="content">
                <h1>Welcome to Our Application</h1>
                <p>Thank you for visiting. We're glad you're here!</p>
                <a href="{{ url('/books') }}" class="btn">View All Books</a>
                @if (Route::has('login'))
                    <div>
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="btn">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </body>
</html>
