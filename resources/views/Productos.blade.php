    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Gestión de Productos</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <style>
            body {
                background: linear-gradient(135deg, #6b5b95, #f7cac9);
                min-height: 100vh;
                margin: 0;
                font-family: 'Arial', sans-serif;
                padding-top: 70px; /* Espacio adicional para el navbar */
            }

            .container {
                padding: 2rem;
            }

            .table-container {
                padding: 2rem;
            }

            /* Estilo de la tabla */
            .table {
                width: 100%;
                border-collapse: collapse;
                border-radius: 8px; /* Bordes redondeados */
                overflow: hidden; /* Elimina el desbordamiento */
                box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2); /* Sombra sutil */
            }

            .table th, .table td {
                padding: 15px;
                text-align: center;
                background-color: #ffffff; /* Fondo blanco para las celdas */
                color: #333;
                font-size: 14px;
                border-bottom: 1px solid #ddd; /* Borde sutil entre filas */
            }

            /* Cambiar color de los encabezados */
            .table th {
                background-color: #6b5b95; /* Color morado suave para los encabezados */
                color: white;
                font-size: 14px;
                text-transform: uppercase;
                letter-spacing: 1px;
            }

            /* Estilo de las filas */
            .table tbody tr {
                background-color: #fafafa; /* Fondo suave para las filas */
                transition: background-color 0.3s ease; /* Transición suave para el hover */
            }

            .table tbody tr:hover {
                background-color: #f0f0f0; /* Efecto hover para filas */
                cursor: pointer; /* Cambiar cursor al pasar sobre las filas */
            }

            .btn-primary {
                background: linear-gradient(135deg, #ff7e5f, #feb47b);
                border: none;
                border-radius: 50px;
                padding: 10px 20px;
                font-size: 1rem;
                transition: transform 0.3s ease, background 0.3s ease;
            }

            .btn-primary:hover {
                transform: scale(1.1);
                background: linear-gradient(135deg, #feb47b, #ff7e5f);
            }

            .btn-danger {
                background: linear-gradient(135deg, #ff4b2b, #ff416c);
                border: none;
                border-radius: 8px;
            }

            .btn-danger:hover {
                background: linear-gradient(135deg, #ff6b6b, #ff4b2b);
            }

            .btn-warning {
                background: linear-gradient(135deg, #f39c12, #e67e22);
                border: none;
                border-radius: 8px;
            }

            .btn-warning:hover {
                background: linear-gradient(135deg, #e67e22, #f39c12);
            }

            /* Diseño del modal */
            .modal-content {
                border-radius: 1rem;
            }

            .form-control {
                border-radius: 8px;
            }

            .modal-confirmation {
                background-color: rgba(0, 0, 0, 0.8);
                color: #fff;
                padding: 1rem;
                border-radius: 15px;
                text-align: center;
            }

            /* Estilos para el navbar */
            .navbar {
                background-color: #000000;
                padding: 15px 30px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                z-index: 1000;
                position: fixed;
                width: 100%;
                top: 0;
            }

            .navbar-brand {
                font-size: 1.8rem;
                font-weight: bold;
                color: #FFFFFF;
                text-transform: uppercase;
                letter-spacing: 1.5px;
                transition: color 0.3s ease-in-out;
            }

            .navbar-brand:hover {
                color: #FF4D00;
            }

            .nav-link {
                color: #FFFFFF;
                font-size: 1rem;
                text-transform: uppercase;
                letter-spacing: 1px;
                margin: 0 15px;
                position: relative;
                transition: color 0.3s ease-in-out;
            }

            .nav-link:hover {
                color: #FF4D00;
            }

            /* Diseño de la tabla */
            .table-container {
                margin-top: 100px;
            }

        </style>
    </head>
    <body>
        @include('fragments.navbar')

        <div class="container">
            <h1 class="text-center text-white mb-4">Gestión de Productos</h1>

            <!-- Botón para abrir el modal -->
            <div class="text-center mb-4">
                <button class="btn btn-primary px-4 py-2" data-bs-toggle="modal" data-bs-target="#addProductModal">Registrar Producto</button>
            </div>

<!-- Campo de búsqueda -->
<div class="mb-4">
    <input type="text" 
           id="searchInput" 
           class="form-control" 
           placeholder="Buscar por nombre, descripción o categoría..."
           style="border-radius: 20px; padding: 10px 20px;">
</div>
            <!-- Modal para registrar producto -->
            <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addProductModalLabel">Registrar Producto</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('product.store') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="nombre" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                                </div>
                                <div class="mb-3">
                                    <label for="precio" class="form-label">Precio</label>
                                    <input type="number" step="0.01" class="form-control" id="precio" name="precio" required>
                                </div>
                                <div class="mb-3">
                                    <label for="descripcion" class="form-label">Descripción</label>
                                    <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="stock" class="form-label">Stock</label>
                                    <input type="number" class="form-control" id="stock" name="stock" required>
                                </div>
                                <div class="mb-3">
                                    <label for="categoria_id" class="form-label">Categoría</label>
                                    <select class="form-control" id="categoria_id" name="categoria_id" required>
                                        <option value="" disabled selected>Seleccionar categoría</option>
                                        @foreach($categorias as $categoria)
                                            <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Registrar</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Tabla de productos -->
            <div class="table-container mt-4">
                <table class="table">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Descripción</th>
                            <th>Stock</th>
                            <th>Categoría</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($productos as $producto)
                            <tr>
                                <td>{{ $producto->id }}</td>
                                <td>{{ $producto->nombre }}</td>
                                <td>${{ $producto->precio }}</td>
                                <td>{{ $producto->descripcion }}</td>
                                <td>{{ $producto->stock }}</td>
                                <td>{{ $producto->categoria->nombre }}</td>
                                <td>
                                    <!-- Botón eliminar con confirmación -->
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteConfirmModal{{ $producto->id }}">Eliminar</button>
                                    <!-- Modal de confirmación -->
                                    <div class="modal fade" id="deleteConfirmModal{{ $producto->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content modal-confirmation">
                                                <h5>¿Estás seguro de eliminar este producto?</h5>
                                                <form action="{{ route('product.destroy', $producto->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Sí, eliminar</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Botón editar -->
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editProductModal{{ $producto->id }}">Editar</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal de edición -->
<div class="modal fade" id="modalEdicion" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Producto</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="formEdicion">
                    <input type="hidden" id="editId">
                    <div class="form-group">
                        <label for="editNombre">Nombre</label>
                        <input type="text" id="editNombre" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="editPrecio">Precio</label>
                        <input type="number" id="editPrecio" class="form-control" step="0.01">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="guardarEdicion()">Guardar cambios</button>
            </div>
        </div>
    </div>
</div>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script>
                function abrirModalEdicion(id, nombre, precio) {
        document.getElementById('editId').value = id;
        document.getElementById('editNombre').value = nombre;
        document.getElementById('editPrecio').value = precio;
        $('#modalEdicion').modal('show');
    }

    function guardarEdicion() {
        let id = document.getElementById('editId').value;
        let nombre = document.getElementById('editNombre').value;
        let precio = document.getElementById('editPrecio').value;
        
        alert(`Producto actualizado:\nID: ${id}\nNombre: ${nombre}\nPrecio: ${precio}`);
        $('#modalEdicion').modal('hide');
    }
            document.getElementById('searchInput').addEventListener('input', function(e) {
                const searchTerm = e.target.value;
                
                fetch(`/productos/search?search=${searchTerm}`, {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(productos => {
                    const tbody = document.querySelector('.table tbody');
                    tbody.innerHTML = '';
                    
                    productos.forEach(producto => {
                        tbody.innerHTML += `
                            <tr>
                                <td>${producto.id}</td>
                                <td>${producto.nombre}</td>
                                <td>$${producto.precio}</td>
                                <td>${producto.descripcion}</td>
                                <td>${producto.stock}</td>
                                <td>${producto.categoria.nombre}</td>
                                <td>
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" 
                                            data-bs-target="#deleteConfirmModal${producto.id}">
                                        Eliminar
                                    </button>
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" 
                                            data-bs-target="#editProductModal${producto.id}">
                                        Editar
                                    </button>
                                </td>
                            </tr>
                        `;
                    });
                })
                .catch(error => console.error('Error:', error));
            });
            </script>
    </body>
    </html>
