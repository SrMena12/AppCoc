<?php
// Verificar si se ha proporcionado el parámetro codTarea en la URL
if (isset($_GET["id_clanero"])) {
  $clanero = $_GET["id_clanero"];

  // Realizar la consulta de los datos del clanero
  require_once('conexion.php');
  try {
    $consulta = "SELECT * FROM clanero WHERE id_clanero = ?";
    $preparada_consulta = $db->prepare($consulta);
    $preparada_consulta->execute(array($clanero));
    $datos_clanero = $preparada_consulta->fetch(PDO::FETCH_ASSOC);

    // Verificar si se encontraron datos del clanero
    if ($datos_clanero) {
      $nombre = $datos_clanero['nombre'];
      $rango = $datos_clanero['rango'];
      $estado = $datos_clanero['estado'];
    } else {
      echo '<div class="container mt-3"><div class="alert alert-danger">No se encontraron datos del clanero.</div></div>';
      exit;
    }
  } catch (Exception $e) {
    echo "Error: " . $e->getMessage();
    exit;
  }
} else {
  // Si no se proporcionó el parámetro id_clanero, redirigir a la página miembros.php sin realizar ninguna acción
  header("Location: ../miembros.php");
  exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Formulario Editar Clanero</title>
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
    <h1>Editar Clanero</h1>
    <form method="POST" action="">
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre; ?>" required>
        </div>
        <div class="form-group">
            <label for="rango">Rango:</label>
            <select class="form-control" id="rango" name="rango" required>
                <option value="Lider" <?php if ($rango == 'Lider') echo 'selected'; ?>>Lider</option>
                <option value="Colider" <?php if ($rango == 'Colider') echo 'selected'; ?>>Colider</option>
                <option value="Veterano" <?php if ($rango == 'Veterano') echo 'selected'; ?>>Veterano</option>
                <option value="Miembro" <?php if ($rango == 'Miembro') echo 'selected'; ?>>Miembro</option>
            </select>
        </div>
        <div class="form-group">
            <label for="estado">Estado:</label>
            <select class="form-control" id="estado" name="estado" required>
                <option value="Activo" <?php if ($estado == 'Activo') echo 'selected'; ?>>Activo</option>
                <option value="No activo" <?php if ($estado == 'No activo') echo 'selected'; ?>>No activo</option>
                <option value="Expulsado" <?php if ($estado == 'Expulsado') echo 'selected'; ?>>Expulsado</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Actualizar</button>
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
        $query = "UPDATE clanero SET nombre = ?, rango = ?, estado = ? WHERE id_clanero = ?";
        $preparada_query = $db->prepare($query);
        $preparada_query->execute(array($nombre, $rango, $estado, $clanero));
        echo '<div class="container mt-3"><div class="alert alert-success">Clanero actualizado correctamente.</div></div>';
    } catch (PDOException $e) {
        echo '<div class="container mt-3"><div class="alert alert-danger">Error al actualizar clanero: ' . $e->getMessage() . '</div></div>';
    }
}
?>

</body>
</html>