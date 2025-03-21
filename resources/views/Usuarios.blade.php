<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Gestión de Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <style>
        body {
            background: linear-gradient(135deg, #6b5b95, #f7cac9);
            min-height: 100vh;
            margin: 0;
            font-family: 'Arial', sans-serif;
            padding-top: 70px;
        }

        .container {
            padding: 2rem;
        }

        .table th {
            background-color: #6b5b95;
            color: white;
        }

        .btn-primary {
            background: linear-gradient(135deg, #ff7e5f, #feb47b);
            border-radius: 50px;
        }

        .btn-danger {
            background: linear-gradient(135deg, #ff4b2b, #ff416c);
            border-radius: 8px;
        }

        .btn-warning {
            background: linear-gradient(135deg, #f39c12, #e67e22);
            border-radius: 8px;
        }

        .message-container {
            max-height: 300px;
            overflow-y: auto;
        }
        .message {
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 8px;
        }
        .sent-message {
            background-color: #e3f2fd;
            margin-left: 20%;
        }
        .received-message {
            background-color: #f5f5f5;
            margin-right: 20%;
        }
    </style>
</head>
<body>
    @include('fragments.navbar')

    <div class="container">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalRegistrar">Registrar Usuario</button>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditar{{ $user->id }}">Editar</button>
                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalEliminar{{ $user->id }}">Eliminar</button>
                            @if($user->id !== auth()->id())
                                <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modalMensajes{{ $user->id }}">Mensajes</button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No hay usuarios registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Modales de usuarios -->
    @foreach($users as $user)
        <!-- Modal Editar -->
        <div class="modal fade" id="modalEditar{{ $user->id }}" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar Usuario</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="{{ route('users.update', $user) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <input type="text" name="name" value="{{ $user->name }}" class="form-control mb-3" required>
                            <input type="email" name="email" value="{{ $user->email }}" class="form-control mb-3" required>
                            <input type="password" name="password" class="form-control mb-3" placeholder="Nueva Contraseña (opcional)">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-warning">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Eliminar -->
        <div class="modal fade" id="modalEliminar{{ $user->id }}" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Eliminar Usuario</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">¿Está seguro de que desea eliminar este usuario?</div>
                    <div class="modal-footer">
                        <form action="{{ route('users.destroy', $user) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Mensajes -->
        @if($user->id !== auth()->id())
        <div class="modal fade" id="modalMensajes{{ $user->id }}" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Mensajes con {{ $user->name }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="message-container mb-3" id="messageContainer{{ $user->id }}">
                            <!-- Messages will be loaded here via JavaScript -->
                        </div>
                        <form id="messageForm{{ $user->id }}" onsubmit="sendMessage(event, {{ $user->id }})">
                            @csrf
                            <div class="input-group">
                                <input type="text" name="content" class="form-control" placeholder="Escribe tu mensaje..." required>
                                <button type="submit" class="btn btn-primary">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endif
    @endforeach

    <!-- Modal Registrar -->
    <div class="modal fade" id="modalRegistrar" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Registrar Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="text" name="name" class="form-control mb-3" placeholder="Nombre" required>
                        <input type="email" name="email" class="form-control mb-3" placeholder="Correo Electrónico" required>
                        <input type="password" name="password" class="form-control mb-3" placeholder="Contraseña" required>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script>
        function loadMessages(userId) {
            fetch(`/messages/${userId}`)
                .then(response => response.json())
                .then(messages => {
                    const container = document.getElementById(`messageContainer${userId}`);
                    container.innerHTML = '';
                    
                    messages.forEach(message => {
                        const messageDiv = document.createElement('div');
                        messageDiv.className = `message ${message.sender_id === {{ auth()->id() }} ? 'sent-message' : 'received-message'}`;
                        messageDiv.innerHTML = `
                            <strong>${message.sender.name}:</strong>
                            <p>${message.content}</p>
                            <small class="text-muted">${new Date(message.created_at).toLocaleString()}</small>
                        `;
                        container.appendChild(messageDiv);
                    });
                    
                    container.scrollTop = container.scrollHeight;
                });
        }

        function sendMessage(event, userId) {
            event.preventDefault();
            const form = event.target;
            const formData = new FormData(form);
            formData.append('receiver_id', userId);

            fetch('/messages', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(Object.fromEntries(formData))
            })
            .then(response => response.json())
            .then(() => {
                form.reset();
                loadMessages(userId);
            });
        }

        // Load messages when modal is opened
        document.querySelectorAll('[id^="modalMensajes"]').forEach(modal => {
            modal.addEventListener('show.bs.modal', function() {
                const userId = this.id.replace('modalMensajes', '');
                loadMessages(userId);
            });
        });
    </script>
</body>
</html>