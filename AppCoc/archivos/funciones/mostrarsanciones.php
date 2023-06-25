<?php
require_once('conexion.php');

$query = "SELECT s.id_sancion, s.nombre, s.descripcion, s.estado, c.nombre AS nombre_clanero FROM sanciones s INNER JOIN clanero c ON s.id_clanero = c.id_clanero";
$result = $db->query($query);

if ($result->rowCount() > 0) {
    echo '<div class="table-responsive">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Nombre</th>
                  <th>Descripción</th>
                  <th>Clanero</th>
                  <th>Estado</th>
                  <th class="acciones-columna" style="width: 10px;">Acciones</th>
                </tr>
              </thead>
              <tbody>';

              foreach ($result as $row) {
                $id_sancion = $row['id_sancion'];
                $nombre_sancion = $row['nombre'];
                $descripcion_sancion = $row['descripcion'];
                $nombre_clanero = $row['nombre_clanero'];
                $estado_sancion = $row['estado'];
            
                // Omitir las sanciones con nombre "Expulsado"
                if ($nombre_sancion == 'Expulsado') {
                    continue;
                }
            
                $color = ($estado_sancion == 'Cumplida') ? '#c2f0c2' : '#f8d7da';
            
                echo '<tr style="background-color: ' . $color . '">
                        <td>' . $id_sancion . '</td>
                        <td>' . $nombre_sancion . '</td>
                        <td>' . $descripcion_sancion . '</td>
                        <td>' . $nombre_clanero . '</td>
                        <td><span id="estado-' . $id_sancion . '">' . $estado_sancion . '</span></td>
                        <td style="white-space: nowrap;">
                          <button onclick="eliminarSancion(' . $id_sancion . ')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                          <button onclick="editarEstado(' . $id_sancion . ', \'' . $estado_sancion . '\')" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></button>
                        </td>
                      </tr>';
            }

    echo '</tbody>
          </table>
        </div>';
} else {
    echo '<div class="alert alert-info">No se encontraron sanciones.</div>';
}

echo '<a class="btn btn-primary" title="Expulsados" href="funciones/expulsados.php">Expulsados</a>';
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<style>
  .acciones-columna {
    width: 1%;
    white-space: nowrap;
  }
</style>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    var filtroInput = document.getElementById("filtro");

    filtroInput.addEventListener("input", function () {
      var filtro = filtroInput.value.toLowerCase();
      var filas = document.querySelectorAll("table tbody tr");

      for (var i = 0; i < filas.length; i++) {
        var fila = filas[i];
        var textoFila = fila.innerText.toLowerCase();

        if (textoFila.includes(filtro)) {
          fila.style.display = "";
        } else {
          fila.style.display = "none";
        }
      }
    });
  });

  function eliminarSancion(idSancion) {
    Swal.fire({
      title: '¿Seguro que quieres eliminar esta sanción?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Sí',
      cancelButtonText: 'No'
    }).then((result) => {
      if (result.isConfirmed) {
        // Si el usuario hace clic en 'Sí', se elimina la sanción
        window.location.href = 'funciones/eliminarsancion.php?id_sancion=' + idSancion;
      } else {
        // Si el usuario hace clic en 'No', no se realiza ninguna acción
      }
    });
  }

  function editarEstado(idSancion, estado) {
    var nuevoEstado = (estado === 'Sin cumplir') ? 'Cumplida' : 'Sin cumplir';

    // Realizar una redirección GET a actualizar_estado.php
    window.location.href = 'funciones/actualizarestado.php?idSancion=' + idSancion + '&estado=' + nuevoEstado;
  }
</script>