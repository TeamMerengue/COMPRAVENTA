<!DOCTYPE html><html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú Compraventa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            text-align: center;
        }
        .logo {
           
            display: flex;
            justify-content: center;
            align-items: center;
            background-color:rgb(197, 210, 222);
            height: 300px;


        }

        .logo img{
            width: 600px;
            transition: transform 0.3s;
        }

        .logo img:hover{
            transform:scale(1.1);
        }
        .menu {
            background-color: #001f3f; /* Azul oscuro */
            padding: 15px 0;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
            position: relative;
            overflow: hidden;
        }
        .menu::after {
            content: "";
            position: absolute;
            width: 100%;
            height: 5px;
            background-color: #0074D9; /* Azul claro */
            bottom: 0;
            left: 0;
            animation: barra-animacion 2s infinite linear;
        }
        @keyframes barra-animacion {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }
        .menu ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: center;
        }
        .menu li {
            position: relative;
            margin: 0 15px;
        }
        .menu a {
            text-decoration: none;
            color: white;
            padding: 10px 15px;
            display: block;
            font-size: 18px;
            font-weight: bold;
            transition: background 0.3s, transform 0.2s;
            border-radius: 5px;
        }
        .menu a:hover {
            background-color: #FF4136; /* Rojo */
            transform: scale(1.1);
        }
        .video-container {
            width: 100%;
            height: 100vh;
            overflow: hidden;
        }
        .video-container video {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <div class="logo">
        <img src="img/logo.png" alt="Logo" width="150">
    </div>
    <nav class="menu">
        <ul>
            <li><a href="clientes.php">Clientes</a></li>
            <li><a href="productos.php">Productos</a></li>
            <li><a href="factura.php">Factura</a></li>
        </ul>
    </nav>
    <br><br>
    <div class="video-container">
    <iframe width="1200" height="680" src="https://www.youtube.com/embed/9JLhgXYz4Ak?si=VO8t2NGzKSwYTVK8" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

        </video>
        <br><br>
    </div>
</body>
</html>