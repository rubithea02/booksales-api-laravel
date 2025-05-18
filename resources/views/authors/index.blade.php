<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Authors</title>
</head>
<body>
    <h1>Daftar Penulis</h1>
    <p>Selamat datang di toko Author!</p>

    <ul>
        @foreach ($authors as $author)
            <li>{{ $author->name }}</li>
        @endforeach
    </ul>
</body>
</html>
