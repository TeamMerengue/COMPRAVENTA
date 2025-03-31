<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "compraventa";



$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add'])) {
        $nombre_cliente = $_POST['nombre_cliente'];
        $nombre_producto = $_POST['nombre_producto'];
        $precio = $_POST['precio'];
        $cantidad = $_POST['cantidad'];
        $fecha_vencimiento = $_POST['fecha_vencimiento'];
        $fecha_compra = date("Y-m-d");
        $monto_total = $precio * $cantidad;
        
        $sql = "INSERT INTO factura (nombre_producto, precio, cantidad, fecha_vencimiento, fecha_compra, id_cliente, monto_total) 
                VALUES ('$nombre_producto', '$precio', '$cantidad', '$fecha_vencimiento', '$fecha_compra', 
                        (SELECT id FROM clientes WHERE nombre = '$nombre_cliente' LIMIT 1), '$monto_total')";
        $conn->query($sql);
    }
}

$result = $conn->query("SELECT factura.*, clientes.nombre AS nombre_cliente FROM factura INNER JOIN clientes ON factura.id_cliente = clientes.id");
?><!DOCTYPE html><html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Facturas</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; background-color: #f4f4f4; text-align: center; }
        .container { width: 80%; margin: auto; }
        button { padding: 10px 15px; font-size: 16px; border: none; cursor: pointer; margin: 5px; border-radius: 5px; }
        .add-btn { background-color: #28a745; color: white; }
        .close-btn { background-color: #dc3545; color: white; }
        .submit-btn { background-color: #007bff; color: white; }
        button:hover { opacity: 0.8; }
        .form-container { display: none; background: white; padding: 20px; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); margin-top: 10px; }
        input { width: 100%; padding: 10px; margin: 5px 0; border: 1px solid #ccc; border-radius: 5px; }
        table { width: 100%; border-collapse: collapse; background: white; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #007bff; color: white; }

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
    </style>
    <script>
        function toggleForm(id) {
            var form = document.getElementById(id);
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        }
    </script>
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
    </header>
    <div class="container">
        <button class="add-btn" onclick="toggleForm('addForm')">Agregar Factura</button>
        <div id="addForm" class="form-container">
            <form method="post">
                <input type="text" name="nombre_cliente" placeholder="Nombre del Cliente" required>
                <input type="text" name="nombre_producto" placeholder="Nombre del Producto" required>
                <input type="number" name="precio" placeholder="Precio" step="0.01" required>
                <input type="number" name="cantidad" placeholder="Cantidad" required>
                <input type="date" name="fecha_vencimiento" placeholder="Fecha de Vencimiento">
                <button type="submit" name="add" class="submit-btn">Agregar</button>
                <button type="button" class="close-btn" onclick="toggleForm('addForm')">Ocultar</button>
            </form>
        </div>
        <table>
            <tr>
                <th>Cliente</th>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Fecha de Compra</th>
                <th>Fecha de Vencimiento</th>
                <th>Monto Total</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['nombre_cliente'] ?></td>
                    <td><?= $row['nombre_producto'] ?></td>
                    <td><?= $row['precio'] ?></td>
                    <td><?= $row['cantidad'] ?></td>
                    <td><?= $row['fecha_compra'] ?></td>
                    <td><?= $row['fecha_vencimiento'] ?></td>
                    <td><?= $row['monto_total'] ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>