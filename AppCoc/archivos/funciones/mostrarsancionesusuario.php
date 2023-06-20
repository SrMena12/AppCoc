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
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <style>
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
</style>
  <script src="../archivos/js/paginacion.js"></script>
  <title>Sanciones</title>
</head>
<body>


<?php
require_once('conexion.php');

// Verificar si se pasó un ID de miembro válido mediante GET
if (isset($_GET['id_clanero']) && !empty($_GET['id_clanero'])) {
    $id_clanero = $_GET['id_clanero'];

    $query = "SELECT s.id_sancion, s.nombre, s.descripcion, s.estado, c.nombre AS nombre_clanero 
              FROM sanciones s 
              INNER JOIN clanero c ON s.id_clanero = c.id_clanero
              WHERE s.id_clanero = ?";
    
    $stmt = $db->prepare($query);
    $stmt->execute([$id_clanero]);
    
    if ($stmt->rowCount() > 0) {
        echo '<div class="container px-4 py-5" id="Incidencias">
                <h2 class="pb-2 mb-5 border-bottom">Listado de sanciones</h2>
                <a href="../miembros.php" class="btn-back"><i class="material-icons">arrow_back</i></a>
                <div class="p-4 rounded-3" style="background: #F5F4F4">
                  <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Sancion</th>
                          <th>Descripción</th>
                          <th>Miembro</th>
                          <th>Estado</th>
                        </tr>
                      </thead>
                      <tbody>';
        
                      foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
                        $id_sancion = $row['id_sancion'];
                        $nombre_sancion = $row['nombre'];
                        $descripcion_sancion = $row['descripcion'];
                        $nombre_clanero = $row['nombre_clanero'];
                        $estado = $row['estado'];
                        $color = ($estado == 'Sin cumplir') ? '#f8d7da' : '#c2f0c2';
                    
                        echo '<tr style="background-color: ' . $color . '">
                                <td>' . $id_sancion . '</td>
                                <td>' . $nombre_sancion . '</td>
                                <td>' . $descripcion_sancion . '</td>
                                <td>' . $nombre_clanero . '</td>
                                <td>' . $estado . '</td>
                              </tr>';
                    }
        
        echo '</tbody>
              </table>
            </div>
          </div>
        </div>';
    } else {
        echo '<div class="alert alert-info">No se encontraron sanciones para este miembro.</div>';
    }
} else {
    echo '<div class="alert alert-danger">ID de miembro no válido.</div>';
}
?>

<div class="d-flex justify-content-center mt-5" id="tablaPaginacion">
            <nav>
              <ul class="pagination mr-2 " id="paginacion"></ul>
            </nav>
          </div>
        </div>
      </div>
    </section>
  </article>

  
</body>

</html>