<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <title>Prova</title>
</head>

<body>
    <h1 class="text-4xl font-bold p-2">Crear Producto</h1>


    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
    <div class="m-4">
        <form class="" action="{{ route('products.store') }}" method="POST">
            @csrf
            <div class="mx-2">
                <label class="" for="name">Nombre del Producto:</label>
                <input class="border rounded p-1" type="text" name="name" id="name" required>
            </div>
            <div>
                <label for="price">Precio:</label>
                <input class="border rounded p-1" type="number" name="price" id="price" required step="0.01">
            </div>
            <div>
                <label for="description">Descripción:</label>
                <textarea class="border rounded p-1" name="description" id="description"></textarea>
            </div>
            <button
                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 border border-green-700 rounded"
                type="submit">
                Crear Producto</button>
        </form>
        <h2 class="text-2xl font-bold my-4">Lista de Productos</h2>
        @if ($products->isEmpty())
            <p class="bg-slate-100 p-4 rounded">No hay productos creados aún.</p>
        @else
            <div class="bg-white shadow-md rounded-lg p-4">
                <ul class="space-y-4">
                    @foreach ($products as $product)
                        <li class="flex justify-between items-center border-b pb-2 mb-2">
                            <div class="text-lg font-semibold">
                                {{ $product->name }} - ${{ number_format($product->price, 2) }}
                            </div>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="rounded bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2"
                                    type="submit">Eliminar</button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

    </div>
</body>

</html>
