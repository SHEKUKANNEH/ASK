<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sneaker Store - Home</title>
    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Instrument Sans', sans-serif;
            background-color: #FDFDFC;
            color: #1b1b18;
            line-height: 1.6;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 3rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #e3e3e0;
        }
        h1 {
            font-size: 2rem;
            font-weight: 600;
        }
        .nav-links {
            display: flex;
            gap: 1rem;
        }
        .nav-links a {
            padding: 0.5rem 1rem;
            text-decoration: none;
            color: #1b1b18;
            border: 1px solid #19140035;
            border-radius: 0.25rem;
            transition: all 0.2s;
        }
        .nav-links a:hover {
            border-color: #1915014a;
            background-color: #f5f5f5;
        }
        .sneakers-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }
        .sneaker-card {
            background: white;
            border-radius: 0.5rem;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            transition: transform 0.2s, box-shadow 0.2s;
            text-decoration: none;
            color: inherit;
            display: block;
        }
        .sneaker-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        .sneaker-image {
            width: 100%;
            height: 250px;
            object-fit: cover;
            background-color: #f5f5f5;
        }
        .sneaker-info {
            padding: 1.5rem;
        }
        .sneaker-brand {
            font-size: 0.875rem;
            color: #706f6c;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.5rem;
        }
        .sneaker-name {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        .sneaker-model {
            font-size: 0.875rem;
            color: #706f6c;
            margin-bottom: 1rem;
        }
        .sneaker-price {
            font-size: 1.5rem;
            font-weight: 600;
            color: #f53003;
        }
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: #706f6c;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>🏃 Sneaker Store</h1>
            <nav class="nav-links">
                @auth
                    <a href="{{ url('/dashboard') }}">Dashboard</a>
                @else
                    <a href="{{ route('login') }}">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                    @endif
                @endauth
            </nav>
        </header>

        @if($sneakers->count() > 0)
            <div class="sneakers-grid">
                @foreach($sneakers as $sneaker)
                    <a href="{{ route('sneakers.show', $sneaker) }}" class="sneaker-card">
                        <img src="{{ $sneaker->image_path }}" alt="{{ $sneaker->name }}" class="sneaker-image" onerror="this.src='https://via.placeholder.com/400x300?text={{ urlencode($sneaker->name) }}'">
                        <div class="sneaker-info">
                            <div class="sneaker-brand">{{ $sneaker->brand }}</div>
                            <div class="sneaker-name">{{ $sneaker->name }}</div>
                            <div class="sneaker-model">{{ $sneaker->model }}</div>
                            <div class="sneaker-price">${{ number_format($sneaker->price, 2) }}</div>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <h2>No sneakers available</h2>
                <p>Check back soon for new arrivals!</p>
            </div>
        @endif
    </div>
</body>
</html>

