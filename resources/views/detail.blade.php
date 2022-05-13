<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h1>{{ $product->name }}</h1>
    <h2>Ukuran : @foreach ($size as $s)
        {{ $s->size->size_value }}
        @endforeach </h2>
    <h2>Warna : @foreach ($colour as $c)
        {{ $c->colour->color_value }}
        @endforeach </h2>
    <h2>Gambar : @foreach ($picture as $p)
        {{ $p->picture_name }}
        @endforeach </h2>

</body>

</html>
