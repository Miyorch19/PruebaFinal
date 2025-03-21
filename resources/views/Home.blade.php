<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home - Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background-color: #121212;
            color: #FFFFFF;
        }

        .hero-section {
            position: relative;
            height: 100vh;
            background: url('././img/2222.png') no-repeat center center/cover;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: #FFFFFF;
        }

        .hero-section h1 {
            font-size: 4rem;
            font-weight: bold;
            text-transform: uppercase;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.7);
            animation: fadeIn 2s ease-in-out;
        }

        .hero-section p {
            font-size: 1.5rem;
            margin-top: 15px;
            text-shadow: 1px 1px 8px rgba(0, 0, 0, 0.6);
        }

        .hero-section .btn {
            background-color: #FF4D00;
            border: none;
            padding: 10px 20px;
            font-size: 1.2rem;
            text-transform: uppercase;
            color: #FFFFFF;
            transition: transform 0.3s ease, background-color 0.3s ease;
        }

        .hero-section .btn:hover {
            transform: scale(1.1);
            background-color: #FF3300;
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

        .products-section {
            padding: 50px 20px;
        }

        .product-card {
            background-color: #222222;
            border: 1px solid #333333;
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .product-card img:hover {
            transform: scale(1.1);
        }

        .product-card .card-body {
            padding: 20px;
        }

        .product-card .card-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #FF4D00;
        }

        .product-card .card-text {
            color: #CCCCCC;
            margin: 15px 0;
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 20px rgba(255, 77, 0, 0.3);
        }

        .footer {
            background-color: #000000;
            padding: 20px;
            text-align: center;
            color: #CCCCCC;
            font-size: 0.9rem;
            margin-top: 50px;
        }
    </style>
</head>
<body>

    @include('fragments.navbar') 

    <!-- Hero Section -->
    <div class="hero-section">
        <div>
            <h1>Bienvenidos a nuestra tienda</h1>
            <p>Descubre los mejores productos con ofertas increíbles</p>
            <a href="#" class="btn">Explorar Productos</a>
        </div>
    </div>

    <div class="products-section container">
        <h2 class="text-center text-uppercase mb-5">Nuestros productos</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="product-card">
                    <img src="././img/coca.jpg" alt="Producto 1">
                    <div class="card-body">
                        <h5 class="card-title">Bebidas</h5>
                        <p class="card-text">Descripción breve del producto. Alta calidad garantizada.</p>
                        <a href="#" class="btn btn-outline-light">Comprar ahora</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="product-card">
                    <img src="././img/2222.png" alt="Producto 2">
                    <div class="card-body">
                        <h5 class="card-title">Despensa</h5>
                        <p class="card-text">Bebidas de todos los sabores.Todos los productos que desees!</p>
                        <a href="#" class="btn btn-outline-light">Comprar ahora</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="product-card">
                    <img src="././img/carne.jpg" alt="Producto 3">
                    <div class="card-body">
                        <h5 class="card-title">Carnes</h5>
                        <p class="card-text">Carnes de todos los tipo, rojas, pollo, pescado. La mejor calidad!</p>
                        <a href="#" class="btn btn-outline-light">Comprar ahora</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
        &copy; 2025 Tienda de Productos. Todos los derechos reservados.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
