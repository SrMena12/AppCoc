<!DOCTYPE html>
<html>
<head>
    <title>Formulario de Añadir Clanero</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            position: relative;
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0069d9;
            border-color: #0062cc;
        }
        .btn-back {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #eee;
            border: none;
            outline: none;
            cursor: pointer;
            color: #333;
            padding: 10px;
            font-size: 24px;
        }
        .btn-back:hover {
            color: #007bff;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Añadir Clanero</h1>
    <form method="POST" action="">
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="form-group">
            <label for="rango">Rango:</label>
            <select class="form-control" id="rango" name="rango" required>
                <option value="Lider">Lider</option>
                <option value="Colider">Colider</option>
                <option value="Veterano">Veterano</option>
                <option value="Miembro">Miembro</option>
            </select>
        </div>
        <div class="form-group">
            <label for="estado">Estado:</label>
            <select class="form-control" id="estado" name="estado" required>
                <option value="Activo">Activo</option>
                <option value="No activo">No activo</option>
                <option value="Expulsado">Expulsado</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Guardar</button>
    </form>
</div>

<a href="../miembros.php" class="btn-back"><i class="material-icons">arrow_back</i></a>

<?php
require_once('conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $rango = $_POST['rango'];
    $estado = $_POST['estado'];

    try {
        $query = "INSERT INTO clanero (nombre, rango, estado) VALUES ('$nombre', '$rango', '$estado')";
        $db->query($query);
        echo '<div class="container mt-3"><div class="alert alert-success">Clanero añadido correctamente.</div></div>';
    } catch (PDOException $e) {
        echo '<div class="container mt-3"><div class="alert alert-danger">Error al añadir clanero: ' . $e->getMessage() . '</div></div>';
    }
}
?>

</body>
</html>