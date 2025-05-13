<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Genres</title>
</head>
<body>
    <h1>Hello World!</h1>
    <p>Selamat datang di toko Genre!</p>

    <!-- Looping data genre -->
    @foreach ($genres as $genre)
        <ul>
            <li>{{ $genre['name'] }}</li>
        </ul>
    @endforeach
</body>
</html>
