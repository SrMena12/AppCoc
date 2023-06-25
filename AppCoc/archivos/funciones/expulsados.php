<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Icons+Outlined" />
  <link rel="stylesheet" href="../../css/bootstrap.min.css">
  <link rel="stylesheet" href="../../css/styles.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/spinkit@1.2.5/css/spinners.css">
  <style>
    .tablaInci {
      margin: 0 auto;
      max-width: 800px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th {
      font-weight: normal;
    }

    td {
      font-weight: normal;
    }

    tr:hover {
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
      transition: box-shadow 0.2s;
    }

    .activo {
      background-color: #c2f0c2 !important;
    }

    .expulsado {
      background-color: #f8d7da !important;
    }

    /* Estilos del footer */
    footer {
      background-color: #222;
      color: #fff;
      padding: 20px;
      text-align: center;
    }

    footer p {
      margin-bottom: 0;
    }

    /* Estilos de los enlaces */
    footer a {
      color: #fff;
      text-decoration: none;
      margin: 0 10px;
    }

    /* Estilos de los iconos */
    footer .fab {
      font-size: 24px;
      vertical-align: middle;
    }

    .activo {
      background-color: green;
      color: black;
    }

    .expulsado {
      background-color: red;
      color: white;
    }

    .btn-back {
      position: fixed;
      top: 10px;
      right: 10px;
      background-color: #007bff;
      border: none;
      outline: none;
      cursor: pointer;
      color: #fff;
      padding: 10px;
      font-size: 24px;
      border-radius: 50%;
      z-index: 999;
    }

    .btn-back:hover {
      background-color: #0069d9;
    }
  </style>
  <script src="../archivos/js/paginacion.js"></script>
  <title>Miembros</title>
</head>

<body>
  <?php
  require_once('conexion.php');

  try {
    $expulsados = "SELECT * FROM clanero WHERE estado = 'Expulsado'";
    $expulsados = $db->query($expulsados);

    echo '<a href="../miembros.php" class="btn btn-primary ml-auto">
          <i class="material-icons-outlined align-middle">logout</i>
      </a>';
    echo '<div class="tablaInci table-responsive-lg">';
    echo '<table class="table table-striped table-hover text-center">';
    echo '<thead style="background-color: #444; color: #fff; font-weight: bold;">';
    echo '<tr>';
    echo '<th scope="col">id</th>';
    echo '<th>Nombre</th>';
    echo '<th>Rango</th>';
    echo '<th>Estado</th>';
    echo '<th style="width: 180px;">Acciones</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    foreach ($expulsados as $row) {
      $id_clanero = $row["id_clanero"];
      $nombre = $row["nombre"];
      $rango = $row["rango"];
      $estado = $row["estado"];

      echo '<tr>';
      echo '<th scope="row">' . $id_clanero . '</th>';
      echo '<td>' . $nombre . '</td>';
      echo '<td>' . $rango . '</td>';
      echo '<td>' . $estado . '</td>';
      echo '<td style="width: 180px;" class="d-flex">';
      echo '<a class="btn btn-primary" title="Editar miembro" href="editarmiembro.php?id_clanero=' . $id_clanero . '" style="width: 30px; height: 30px; padding: 0; margin-right: 5px;"><i class="material-icons-outlined" style="font-size: 16px; line-height: 30px;">edit_document</i></a>';
      echo '</td>';
      echo '</tr>';
    }

    echo '</tbody></table></div>';
  } catch (PDOException $e) {
    echo 'Error con la base de datos: ' . $e->getMessage();
  }
  ?>

</body>

</html>