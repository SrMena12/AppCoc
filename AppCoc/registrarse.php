<?php
require_once 'archivos/funciones/conexion.php';

$mostrarAlerta = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Verificar que se haya enviado el formulario
  $nombre = $_POST["nombre"];
  $correo = $_POST["correo"];
  $contraseña = $_POST["contraseña"];

  try {
    // Sentencia SQL para insertar el usuario en la tabla
    $consulta_insertar_usuario = "INSERT INTO Usuario (nombre, correo, contraseña) VALUES (?, ?, ?)";
    
    // Preparar la sentencia
    $stmt = $db->prepare($consulta_insertar_usuario);
    
    // Ejecutar la sentencia con los datos del formulario
    $stmt->execute([$nombre, $correo, $contraseña]);

    // Cerrar el cursor
    $stmt->closeCursor();

    // Cerrar la conexión a la base de datos
    $db = null;

    $mostrarAlerta = true;

    // Redirigir a login.php después de 5 segundos
    header("refresh:5; url=login.php");
  } catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Registro</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <style>
    body {
      background: linear-gradient(120deg, #2980b9, #3498db);
    }
    
    .register-container {
      max-width: 400px;
      margin: 0 auto;
      margin-top: 100px;
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      opacity: 0;
      transform: translateY(-50px);
      animation: slideIn 0.5s ease forwards;
    }
    
    .register-container h2 {
      text-align: center;
      margin-bottom: 20px;
    }
    
    .register-container .form-control {
      height: 40px;
    }
    
    .register-container .btn {
      margin-top: 20px;
      width: 100%;
      background-color: #2980b9;
      border-color: #2980b9;
      color: #fff;
    }
    
    .register-container .btn:hover {
      background-color: #2980b9;
      border-color: #2980b9;
      color: #fff;
      opacity: 0.8;
    }
    
    .register-link {
      display: block;
      text-align: center;
      margin-top: 20px;
      color: #fff;
    }
    
    .register-link:hover {
      color: #eee;
      text-decoration: none;
    }
    
    @keyframes slideIn {
      0% {
        opacity: 0;
        transform: translateY(-50px);
      }
      100% {
        opacity: 1;
        transform: translateY(0);
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="register-container">
      <h2>Registro</h2>
      <form method="POST">
        <div class="form-group">
          <input type="text" class="form-control" name="nombre" placeholder="Nombre" required>
        </div>
        <div class="form-group">
          <input type="email" class="form-control" name="correo" placeholder="Correo" required>
        </div>
        <div class="form-group">
          <input type="password" class="form-control" name="contraseña" placeholder="Contraseña" required>
        </div>
        <button type="submit" class="btn btn-primary">Registrarse</button>
      </form>
    </div>
  </div>
  
  <?php if ($mostrarAlerta) { ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
      Swal.fire({
        icon: "success",
        title: "Usuario añadido correctamente",
        showConfirmButton: false,
        timer: 5000
      });
    </script>
  <?php } ?>
</body>
</html>