<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomeLog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <style>
        body {
            background: linear-gradient(135deg, #6b5b95, #f7cac9);
            min-height: 100vh;
            margin: 0;
            font-family: 'Arial', sans-serif;
            display: flex;
            flex-direction: column;
        }

        .menu-container {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .menu-title {
            font-size: 2.5rem;
            margin-bottom: 2rem;
            font-weight: bold;
            letter-spacing: 1px;
            color: #fff;
        }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            width: 100%;
            max-width: 800px;
        }

        .menu-item {
            background: rgba(255, 255, 255, 0.15);
            border-radius: 1rem;
            padding: 2rem;
            text-align: center;
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            font-size: 1.25rem;
            transition: transform 0.3s, box-shadow 0.3s, background 0.3s;
            backdrop-filter: blur(10px);
        }

        .menu-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
            background: rgba(255, 255, 255, 0.3);
        }

        .btn-primary {
            background: linear-gradient(135deg, #ff7e5f, #feb47b);
            border: none;
            border-radius: 50px;
            padding: 12px 30px;
            font-size: 1.2rem;
            text-align: center;
            transition: transform 0.3s ease, background 0.3s ease;
            text-decoration: none;
            color: #fff;
        }

        .btn-primary:hover {
            transform: scale(1.1);
            background: linear-gradient(135deg, #feb47b, #ff7e5f);
        }

        footer {
            text-align: center;
            color: #fff;
            padding: 1rem;
        }
    </style>
</head>
<body>
    @include('fragments.navbar')

    <div class="menu-container">
        <div class="menu-title">Panel Principal</div>
        <div class="menu-grid">
            <!-- Botón de productos con el estilo modificado -->
            <a href="{{ route('Productos') }}" class="btn btn-primary">Productos</a>
            <a href="{{ route('users.index') }}" class="btn btn-primary">Usuarios</a>
        </div>
    </div>

    <footer>
        &copy; {{ date('Y') }} Todos los derechos reservados.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
