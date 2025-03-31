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
        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        $cantidad = $_POST['cantidad'];
        $marca = $_POST['marca'];
        $estado = $_POST['estado'];
        $id_categoria = $_POST['id_categoria'];
        
        $sql = "INSERT INTO productos (nombre, precio, cantidad, marca, estado, id_categoria) VALUES ('$nombre', '$precio', '$cantidad', '$marca', '$estado', '$id_categoria')";
        $conn->query($sql);
    }
    
    if (isset($_POST['edit'])) {
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        $cantidad = $_POST['cantidad'];
        $marca = $_POST['marca'];
        $estado = $_POST['estado'];
        $id_categoria = $_POST['id_categoria'];
        
        $sql = "UPDATE productos SET nombre='$nombre', precio='$precio', cantidad='$cantidad', marca='$marca', estado='$estado', id_categoria='$id_categoria' WHERE id=$id";
        $conn->query($sql);
    }
    
    if (isset($_POST['delete'])) {
        $id = $_POST['id'];
        $sql = "DELETE FROM productos WHERE id=$id";
        $conn->query($sql);
    }
}

$result = $conn->query("SELECT * FROM productos");
?><!DOCTYPE html><html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Productos</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; background-color: #f4f4f4; text-align: center; }
        .container { width: 80%; margin: auto; }
        button { padding: 10px 15px; font-size: 16px; border: none; cursor: pointer; margin: 5px; border-radius: 5px; }
        .add-btn { background-color: #28a745; color: white; }
        .close-btn { background-color: #dc3545; color: white; }
        .submit-btn { background-color: #007bff; color: white; }
        .edit-btn { background-color: #ffc107; color: black; }
        .delete-btn { background-color: #dc3545; color: white; }
        button:hover { opacity: 0.8; }
        .form-container { display: none; background: white; padding: 20px; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); margin-top: 10px; }
        input, select { width: 100%; padding: 10px; margin: 5px 0; border: 1px solid #ccc; border-radius: 5px; }
        .table-container { margin-top: 20px; overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; background: white; }
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
        <button class="add-btn" onclick="toggleForm('addForm')">Agregar Producto</button>
        <div id="addForm" class="form-container">
            <form method="post">
                <input type="text" name="nombre" placeholder="Nombre" required>
                <input type="number" name="precio" placeholder="Precio" required>
                <input type="number" name="cantidad" placeholder="Cantidad" required>
                <input type="text" name="marca" placeholder="Marca" required>
                <select name="estado">
                    <option value="disponible">Disponible</option>
                    <option value="agotado">Agotado</option>
                </select>
                <input type="number" name="id_categoria" placeholder="ID Categoría" required>
                <button type="submit" name="add" class="submit-btn">Agregar</button>
                <button type="button" class="close-btn" onclick="toggleForm('addForm')">Ocultar</button>
            </form>
        </div><div class="table-container">
        <table>
            <tr>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Marca</th>
                <th>Estado</th>
                <th>Categoría</th>
                <th>Acciones</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['nombre'] ?></td>
                    <td><?= $row['precio'] ?></td>
                    <td><?= $row['cantidad'] ?></td>
                    <td><?= $row['marca'] ?></td>
                    <td><?= $row['estado'] ?></td>
                    <td><?= $row['id_categoria'] ?></td>
                    <td>
                        <button class="edit-btn" onclick="toggleForm('editForm<?= $row['id'] ?>')">Editar</button>
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            <button type="submit" name="delete" class="delete-btn">Eliminar</button>
                        </form>
                        <div id="editForm<?= $row['id'] ?>" class="form-container">
                            <form method="post">
                                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                <input type="text" name="nombre" value="<?= $row['nombre'] ?>" required>
                                <input type="number" name="precio" value="<?= $row['precio'] ?>" required>
                                <input type="number" name="cantidad" value="<?= $row['cantidad'] ?>" required>
                                <input type="text" name="marca" value="<?= $row['marca'] ?>" required>
                                <select name="estado">
                                    <option value="disponible" <?= $row['estado'] == 'disponible' ? 'selected' : '' ?>>Disponible</option>
                                    <option value="agotado" <?= $row['estado'] == 'agotado' ? 'selected' : '' ?>>Agotado</option>
                                </select>
                                <input type="number" name="id_categoria" value="<?= $row['id_categoria'] ?>" required>
                                <button type="submit" name="edit" class="submit-btn">Guardar</button>
                                <button type="button" class="close-btn" onclick="toggleForm('editForm<?= $row['id'] ?>')">Ocultar</button>
                            </form>
                        </div>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</div>

</body>
</html>