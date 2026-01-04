<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $sneaker->name }} - Sneake Store</title>
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
        .sneaker-detail {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            margin-top: 2rem;
        }
        @media (max-width: 768px) {
            .sneaker-detail {
                grid-template-columns: 1fr;
            }
        }
        .sneaker-image-container {
            background: white;
            border-radius: 0.5rem;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        .sneaker-image {
            width: 100%;
            height: auto;
            display: block;
        }
        .sneaker-info {
            background: white;
            padding: 2rem;
            border-radius: 0.5rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        .sneaker-brand {
            font-size: 0.875rem;
            color: #706f6c;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.5rem;
        }
        .sneaker-name {
            font-size: 2rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        .sneaker-model {
            font-size: 1rem;
            color: #706f6c;
            margin-bottom: 1.5rem;
        }
        .sneaker-price {
            font-size: 2rem;
            font-weight: 600;
            color: #f53003;
            margin-bottom: 1.5rem;
        }
        .sneaker-description {
            font-size: 1rem;
            line-height: 1.8;
            color: #1b1b18;
            margin-bottom: 2rem;
        }
        .back-link {
            display: inline-block;
            margin-bottom: 2rem;
            padding: 0.5rem 1rem;
            text-decoration: none;
            color: #1b1b18;
            border: 1px solid #19140035;
            border-radius: 0.25rem;
            transition: all 0.2s;
        }
        .back-link:hover {
            border-color: #1915014a;
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <a href="{{ route('sneakers.index') }}" class="back-link">← Back to Sneakers</a>
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

        <div class="sneaker-detail">
            <div class="sneaker-image-container">
                <img src="{{ $sneaker->image_path }}" alt="{{ $sneaker->name }}" class="sneaker-image" onerror="this.src='https://via.placeholder.com/600x600?text={{ urlencode($sneaker->name) }}'">
            </div>
            <div class="sneaker-info">
                <div class="sneaker-brand">{{ $sneaker->brand }}</div>
                <h1 class="sneaker-name">{{ $sneaker->name }}</h1>
                <div class="sneaker-model">{{ $sneaker->model }}</div>
                <div class="sneaker-price">${{ number_format($sneaker->price, 2) }}</div>
                @if($sneaker->description)
                    <div class="sneaker-description">{{ $sneaker->description }}</div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>

