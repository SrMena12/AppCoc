<!DOCTYPE html>
<html>
<head>
    <title>Formulario de Añadir Sanción</title>
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
    <h1>Añadir Sanción</h1>
    <form method="POST" action="">
        <div class="form-group">
        <label for="sancion">Sanción:</label>
        <select class="form-control" id="sancion" name="sancion" required>
            <option value="1 Guerra">1 Guerra</option>
            <option value="2 Guerras">2 Guerras</option>
            <option value="Expulsado">Expulsado</option>
        </select>
        </div>
        <div class="form-group">
            <label for="motivo">Motivo de la sanción:</label>
            <input type="text" class="form-control" id="motivo" name="motivo" required>
        </div>
        <div class="form-group">
            <label for="sancionado">Miembro sancionado:</label>
            <select class="form-control" id="sancionado" name="sancionado" required>
                <?php
                require_once('conexion.php');
                $query = "SELECT id_clanero, nombre FROM clanero";
                $result = $db->query($query);

                foreach ($result as $row) {
                    $id_clanero = $row['id_clanero'];
                    $nombre_clanero = $row['nombre'];
                    echo '<option value="' . $id_clanero . '">' . $nombre_clanero . '</option>';
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Guardar</button>
    </form>
</div>

<a href="../sanciones.php" class="btn-back"><i class="material-icons">arrow_back</i></a>

<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $motivo = $_POST['motivo'];
    $sancionado = $_POST['sancionado'];
    $sancion = $_POST['sancion'];

    try {
        $query = "INSERT INTO sanciones (nombre, descripcion, id_clanero) VALUES (?, ?, ?)";
        $preparada_sancion = $db->prepare($query);
        $preparada_sancion->execute(array($sancion, $motivo, $sancionado));
        echo '<div class="container mt-3"><div class="alert alert-success">Sanción añadida correctamente.</div></div>';
    } catch (PDOException $e) {
        echo '<div class="container mt-3"><div class="alert alert-danger">Error al añadir sanción: ' . $e->getMessage() . '</div></div>';
    }
}
?>

</body>
</html>