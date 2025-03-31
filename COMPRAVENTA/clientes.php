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
        $apellido = $_POST['apellido'];
        $email = $_POST['email'];
        $telefono = $_POST['telefono'];
        $direccion = $_POST['direccion'];
        
        $sql = "INSERT INTO clientes (nombre, apellido, email, telefono, direccion) VALUES ('$nombre', '$apellido', '$email', '$telefono', '$direccion')";
        $conn->query($sql);
    }
    
    if (isset($_POST['edit'])) {
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $email = $_POST['email'];
        $telefono = $_POST['telefono'];
        $direccion = $_POST['direccion'];
        
        $sql = "UPDATE clientes SET nombre='$nombre', apellido='$apellido', email='$email', telefono='$telefono', direccion='$direccion' WHERE id=$id";
        $conn->query($sql);
    }
    
    if (isset($_POST['delete'])) {
        $id = $_POST['id'];
        $sql = "DELETE FROM clientes WHERE id=$id";
        $conn->query($sql);
    }
}

$result = $conn->query("SELECT * FROM clientes");
?><!DOCTYPE html><html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Clientes</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; background-color: #f4f4f4; text-align: center; }
        .container { width: 80%; margin: auto; }
        .form-container { display: none; background: white; padding: 20px; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); margin-top: 10px; }
        input { width: 100%; padding: 10px; margin: 5px 0; border: 1px solid #ccc; border-radius: 5px; }
        .table-container { margin-top: 20px; overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; background: white; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #007bff; color: white; }
        button { padding: 10px 15px; font-size: 16px; border: none; cursor: pointer; margin: 5px; border-radius: 5px; }
        .add-btn { background-color: #28a745; color: white; }
        .edit-btn { background-color: #ffc107; color: black; }
        .delete-btn { background-color: #dc3545; color: white; }
        .submit-btn { background-color: #007bff; color: white; }
        .close-btn { background-color: #dc3545; color: white; }


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
        <button class="add-btn" onclick="toggleForm('addForm')">Agregar Cliente</button>
        <div id="addForm" class="form-container">
            <form method="post">
                <input type="text" name="nombre" placeholder="Nombre" required>
                <input type="text" name="apellido" placeholder="Apellido" required>
                <input type="email" name="email" placeholder="Correo" required>
                <input type="text" name="telefono" placeholder="Teléfono">
                <input type="text" name="direccion" placeholder="Dirección">
                <button type="submit" name="add" class="submit-btn">Agregar</button>
                <button type="button" class="close-btn" onclick="toggleForm('addForm')">Ocultar</button>
            </form>
        </div>
        <div class="table-container">
            <table>
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Correo</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Acciones</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['nombre'] ?></td>
                        <td><?= $row['apellido'] ?></td>
                        <td><?= $row['email'] ?></td>
                        <td><?= $row['telefono'] ?></td>
                        <td><?= $row['direccion'] ?></td>
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
                                    <input type="text" name="apellido" value="<?= $row['apellido'] ?>" required>
                                    <input type="email" name="email" value="<?= $row['email'] ?>" required>
                                    <input type="text" name="telefono" value="<?= $row['telefono'] ?>">
                                    <input type="text" name="direccion" value="<?= $row['direccion'] ?>">
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