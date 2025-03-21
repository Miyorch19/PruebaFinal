<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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

        .login-container {
            background: #fff;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 100%;
            animation: fadeIn 1s ease-in-out;
        }

        .login-container h2 {
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

        .form-check-label {
            font-size: 0.9rem;
        }

        .form-text {
            text-align: center;
            margin-top: 1rem;
            font-size: 0.9rem;
        }

        .form-text a {
            text-decoration: none;
            color: #6b5b95;
            font-weight: bold;
        }

        .form-text a:hover {
            color: #f7cac9;
        }

        .alert {
            border-radius: 50px;
            font-size: 1rem;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h2>Inicia Sesión</h2>

        <form action="{{ route('inicia-sesion') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="correo@ejemplo.com" required>
                @if(session('error_email'))
                    <div class="alert alert-danger mt-2">{{ session('error_email') }}</div>
                @endif
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="********" required>
                @if(session('error_password'))
                    <div class="alert alert-danger mt-2">{{ session('error_password') }}</div>
                @endif
            </div>

            <button type="submit" class="btn btn-primary w-100">Iniciar Sesión</button>
        </form>

        <div class="form-text mt-3">
            ¿No tienes cuenta? <a href="{{ route('register') }}">Regístrate aquí</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
