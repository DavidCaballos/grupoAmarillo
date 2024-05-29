@include('navbar')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <style>
        /* Estilos personalizados */
    /* Estilos personalizados */


    .card-img-top {
        height: 80%; /* Ajustar la altura de la imagen al 80% de la tarjeta */
        width: 100%; /* Ajustar el ancho de la imagen al 100% de la tarjeta */
        object-fit: cover; /* La imagen se ajusta dentro del contenedor manteniendo la proporción */
    }
        body {
            background-color: #FFC107; /* Fondo gris claro */
        }

        .card {
            border: none; /* Eliminar bordes de las tarjetas */
        }

        .card:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sutil sombreado al pasar el ratón */
        }

        .card-img-top {
            height: 200px; /* Altura de la imagen */
            object-fit: cover; /* La imagen se ajusta dentro del contenedor manteniendo la proporción */
        }

        .btn-primary {
            background-color: #ffc107; /* Botón amarillo */
            border-color: #ffc107; /* Borde amarillo */
        }

        .btn-primary:hover {
            background-color: #ffca28; /* Botón amarillo claro al pasar el ratón */
            border-color: #ffca28; /* Borde amarillo claro al pasar el ratón */
        }

        .footer {
        background-color: #343a40; /* Fondo gris oscuro */
        color: #fff; /* Texto blanco */
        padding: 20px 0; /* Espaciado interno */
        position: fixed; /* Fijar el footer */
        width: 100%; /* Ancho completo */
        bottom: 0; /* Situarlo en la parte inferior */
        left: 0; /* Alinear a la izquierda */
    }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="{{ asset('assets/1.jpg') }}" class="card-img-top" alt="Product 1">
                    <div class="card-body">
                        <h5 class="card-title">Product 1</h5>
                        <p class="card-text">Description of Product 1.</p>
                        <p class="card-text"><strong>Precio: </strong> $10</p>
                        <a href="{{ route('addProduct.to.cart', 1) }}" class="btn btn-primary">Add to Cart</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="{{ asset('assets/2.jpg') }}" class="card-img-top" alt="Product 2">
                    <div class="card-body">
                        <h5 class="card-title">Product 2</h5>
                        <p class="card-text">Description of Product 2.</p>
                        <p class="card-text"><strong>Precio: </strong> $20</p>
                        <a href="{{ route('addProduct.to.cart', 2) }}" class="btn btn-primary">Add to Cart</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="{{ asset('assets/3.jpg') }}" class="card-img-top" alt="Product 3">
                    <div class="card-body">
                        <h5 class="card-title">Product 3</h5>
                        <p class="card-text">Description of Product 3.</p>
                        <p class="card-text"><strong>Precio: </strong> $30</p>
                        <a href="{{ route('addProduct.to.cart', 3) }}" class="btn btn-primary">Add to Cart</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="container text-center">
            &copy; 2024 GrupoAmarillo
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
