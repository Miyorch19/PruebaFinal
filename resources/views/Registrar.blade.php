<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <style>
        body {
            background: linear-gradient(135deg, #6b5b95, #f7cac9);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Arial', sans-serif;
            margin: 0;
        }

        .register-container {
            background: #fff;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 100%;
        }

        .register-container h2 {
            text-align: center;
            margin-bottom: 1.5rem;
            font-size: 2rem;
            font-weight: bold;
            color: #6b5b95;
        }

        .form-control {
            border-radius: 50px;
            border: 1px solid #ccc;
            padding: 0.75rem 1rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, #6b5b95, #f7cac9);
            border: none;
            border-radius: 50px;
            padding: 0.75rem 1rem;
            transition: transform 0.3s ease, background 0.3s ease;
        }

        .btn-primary:hover {
            transform: scale(1.05);
            background: linear-gradient(135deg, #f7cac9, #6b5b95);
        }

        .alert {
            border-radius: 8px;
            padding: 1rem;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 1.5rem;
        }

        .alert-danger {
            background-color: #ffe6e6;
            color: #d9534f;
            border: 1px solid #f5c6cb;
        }

        .alert-success {
            background-color: #d4edda;
            color: #28a745;
            border: 1px solid #c3e6cb;
        }

        .alert-info {
            background-color: #d1ecf1;
            color: #17a2b8;
            border: 1px solid #bee5eb;
        }

        .alert-warning {
            background-color: #fff3cd;
            color: #856404;
            border: 1px solid #ffeeba;
        }

        .input-group {
            position: relative;
        }

        .input-group .material-symbols-outlined {
            cursor: pointer;
            color: #6b5b95;
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            transition: color 0.3s ease;
        }

        .input-group .material-symbols-outlined:hover {
            color: #f7cac9; 
        }

        .form-text a {
            text-decoration: none;
            color: #6b5b95;
            font-weight: bold;
        }

        .form-text a:hover {
            color: #f7cac9;
        }

        .input-group .form-control {
            border-radius: 50px; 
        }

        .input-group .form-control:first-child {
            border-radius: 50px 0 0 50px; 
        }

        .input-group .form-control:last-child {
            border-radius: 0 50px 50px 0;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>Regístrate</h2>
        <form method="POST" action="{{ route('validar-registro') }}">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Tu nombre" value="{{ old('name') }}" required>
                @error('name')
                    <div class="alert alert-danger">¡Este campo es obligatorio!</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="correo@ejemplo.com" value="{{ old('email') }}" required>
                @error('email')
                    <div class="alert alert-danger">¡Correo inválido!</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <div class="input-group">
                    <input type="password" name="password" class="form-control" id="password" placeholder="********" required>
                    <span class="material-symbols-outlined" onclick="togglePassword()">visibility</span>
                </div>
                @error('password')
                    <div class="alert alert-danger">¡Contraseña demasiado corta!</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary w-100">Registrarse</button>
        </form>

        <div class="form-text mt-3">
            ¿Ya tienes cuenta? <a href="{{ route('login') }}">Inicia sesión aquí</a>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordField = document.getElementById('password');
            const icon = document.querySelector('.material-symbols-outlined');
            const isPassword = passwordField.type === 'password';
            passwordField.type = isPassword ? 'text' : 'password';
            icon.textContent = isPassword ? 'visibility_off' : 'visibility';
        }
    </script>
</body>
</html>
