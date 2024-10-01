<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    <title>Prova</title>
</head>
<body>
<p>Hola pepsicola</p>
    <h1>Crear Producto</h1>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <div>
            <label for="name">Nombre del Producto:</label>
            <input type="text" name="name" id="name" required>
        </div>
        <div>
            <label for="price">Precio:</label>
            <input type="number" name="price" id="price" required step="0.01">
        </div>
        <div>
            <label for="description">Descripción:</label>
            <textarea name="description" id="description"></textarea>
        </div>
        <button type="submit">Crear Producto</button>
    </form>
    <h2>Lista de Productos</h2>
    @if($products->isEmpty())
        <p>No hay productos creados aún.</p>
    @else
    <div>
        <ul>
            @foreach($products as $product)
                <li class="border">{{ $product->name }} - ${{ number_format($product->price, 2) }}</li>
            @endforeach
        </ul>
    </div>
    @endif

</body>

</html>
