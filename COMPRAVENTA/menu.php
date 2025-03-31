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
        }
        .header {
            height: 180px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color:rgb(7, 243, 223); /* Azul oscuro */
            padding: 10px 20px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
            position: relative;
            margin-top: -70px;
           
           
        }
       
        .logo img{
            width: 250px;
            height: auto;
          margin-bottom: -65px;
        }

        .menu {
            position: relative;
            margin-bottom: -65px;
        }
        .menu::after {
            content: "";
            position: absolute;
            width: 100vw;
            height: 5px;
            background-color: #0074D9; /* Azul claro */
            bottom: -30px;
            left: 0;
            animation: barra-animacion 4s infinite linear;
            margin-bottom: -20px;

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
        }
        .menu li {
            margin: 0 15px;
        }
        .menu a {
            text-decoration: none;
            color:rgb(1, 15, 84);
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
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .video-container iframe {
            width: 1200px;
            height: 680px;
        }
    </style>
</head>
<body>
    <header class="header">
        <div class ="logo">
        <img src="img/logo.png" alt="Logo" class="logo"></div>
        <nav class="menu">
            <ul>
                <li><a href="clientes.php">Clientes</a></li>
                <li><a href="productos.php">Productos</a></li>
                <li><a href="factura.php">Factura</a></li>
                <li><a href="menu.php">Menú</a></li>
            </ul>
        </nav>
    </header><br>
    <div class="video-container">
    <iframe width="560" height="315" src="https://www.youtube.com/embed/9JLhgXYz4Ak?si=nUt2pSGfH40V5ZRH" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
    </div>
</body>
</html>