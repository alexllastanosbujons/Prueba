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
            <div class="">
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
                class="my-2 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 border border-green-700 rounded"
                type="submit">
                Crear Producto</button>
        </form>
        <h2 class="text-2xl font-bold my-4">Lista de Productos</h2>
        @if ($products->isEmpty())
            <p class="bg-slate-100 p-4 rounded">No hay productos creados aún.</p>
        @else

            <div id="editModal" class="fixed inset-0 flex items-center justify-center hidden bg-black bg-opacity-50">
                <div class="bg-white rounded-lg p-6 w-1/3">
                    <h2 class="text-lg font-bold mb-4">Editar Producto</h2>
                    <form id="editForm" action="" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="editName" class="block">Nombre del Producto:</label>
                            <input class="border rounded p-1 w-full" type="text" name="name" id="editName"
                                required>
                        </div>
                        <div class="mb-4">
                            <label for="editPrice" class="block">Precio:</label>
                            <input class="border rounded p-1 w-full" type="number" name="price" id="editPrice"
                                required step="0.01">
                        </div>
                        <div class="mb-4">
                            <label for="editDescription" class="block">Descripción:</label>
                            <textarea class="border rounded p-1 w-full" name="description" id="editDescription"></textarea>
                        </div>
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4"
                            type="submit">Actualizar</button>
                        <button type="button" class="ml-2 bg-gray-300 hover:bg-gray-500 text-white font-bold py-1 px-4"
                            onclick="closeModal()">Cancelar</button>
                    </form>
                </div>
            </div>

            <ul>
                @foreach ($products as $product)
                    <li class="flex justify-center items-center border-b pb-2 mb-2 ">
                        <div class="text-lg font-semibold mx-4">
                            {{ $product->name }} - ${{ number_format($product->price, 2) }}
                        </div>
                        <button class="rounded bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 mx-2"
                            onclick="openModal({{ json_encode($product) }})">Editar</button>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="rounded bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 mx-2"
                                type="submit">Eliminar</button>
                        </form>
                    </li>
                @endforeach
            </ul>

        @endif

    </div>
</body>
<script>
    function openModal(product) {
        document.getElementById('editModal').classList.remove('hidden');
        document.getElementById('editName').value = product.name;
        document.getElementById('editPrice').value = product.price;
        document.getElementById('editDescription').value = product.description;
        document.getElementById('editForm').action = '/products/' + product.id;
    }

    function closeModal() {
        document.getElementById('editModal').classList.add('hidden');
    }
</script>
</html>
