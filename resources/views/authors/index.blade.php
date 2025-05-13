<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authors</title>
</head>
<body>
    <h1>Hello World!</h1>
    <p>Selamat datang di toko Author!</p>

    <!-- Looping data author -->
    @foreach ($authors as $author)
        <ul>
            <li>{{ $author['name'] }}</li>
        </ul>
    @endforeach
</body>
</html>