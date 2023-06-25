<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <style>
    body {
      background: linear-gradient(120deg, #2980b9, #3498db);
    }
    
    .login-container {
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
    
    .login-container h2 {
      text-align: center;
      margin-bottom: 20px;
    }
    
    .login-container .form-control {
      height: 40px;
    }
    
    .login-container .btn {
      margin-top: 20px;
      width: 100%;
      background-color: #2980b9;
      border-color: #2980b9;
      color: #fff;
    }
    
    .login-container .btn:hover {
      background-color: #2980b9;
      border-color: #2980b9;
      color: #fff;
      opacity: 0.8;
    }
    
    .register-link {
      display: block;
      text-align: center;
      margin-top: 20px;
      color: #3498db;
    }
    
    .register-link:hover {
      color: blue;
      text-decoration: none;
    }
    
    .register-button {
      display: block;
      margin-top: 10px;
      text-align: center;
      color: #fff;
      text-decoration: underline;
      cursor: pointer;
    }
    
    .register-button:hover {
      color: #eee;
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
    <div class="login-container">
      <h2>Login</h2>
      <?php 
      $err = false;
      if ($err): ?>
        <div class="alert alert-danger" role="alert">
          Usuario o contraseña incorrectos. Por favor, inténtalo de nuevo.
        </div>
      <?php endif; ?>
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Correo" name="typeEmailX">
        </div>
        <div class="form-group">
          <input type="password" class="form-control" placeholder="Contraseña" name="typePasswordX">
        </div>
        <button type="submit" class="btn btn-primary" name="login">Iniciar Sesión</button>
        <a href="registrarse.php" class="register-link">¿No tienes una cuenta?</a>
      </form>
    </div>
  </div>

  <?php
  /* Funcion para comprobar si el usuario esta en la base de datos */
  function comprobar_usuario($email, $clave){
      try {
          //Hago la conexion a la base de datos
          $db = require_once('archivos/funciones/conexion.php');
          //Consulta seleccionando todo de la base de datos donde el email y la clave son los que se ingresa en el formulario
          $sql = "SELECT * FROM usuario WHERE correo=? AND contraseña=?";
          //Preparo la consulta
          $consulta = $db->prepare($sql);
          //Pasar a traves de un array los valores escritos en el formulario
          //Los valores se recogen por parametros en la función
          $consulta->execute(array($email, $clave));

          //si la consulta devuelve algo, es que todo va bien
          if ($consulta->rowCount() > 0){
              // Como solo va a devolver una linea la consulta ya que el email es unique usamos fetch
              $us = $consulta->fetch();
              //Retornar a traves de un array todos los valores del usuario que hizo login
              return $us;
          //Si no me devuelve nada al hacer la consulta retornar FALSE
          } else return FALSE;
      } catch (PDOException $e) {
          echo "Error en la base de datos ".$e->getMessage();
      }
  }

  //Si el formulario envía los datos en método POST
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])){
    $usu = comprobar_usuario($_POST["typeEmailX"], $_POST["typePasswordX"]);

    if ($usu == FALSE){
        $err = TRUE;
        $usuario = $_POST["typeEmailX"];
    } else {
        session_start();
        $_SESSION["usuario_login"] = $usu;

        header("Location: selector.php");
        exit();
    }
}
  ?>

</body>
</html>