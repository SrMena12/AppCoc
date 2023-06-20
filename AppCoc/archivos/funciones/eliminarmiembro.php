<?php
require_once('conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['eliminar'])) {
    // Obtener la ID del clanero a eliminar
    $id_clanero = $_POST['id_clanero'];

    require_once('funciones/conexion.php');
    try {
      // Mostrar el cuadro de diálogo de confirmación utilizando SweetAlert
      echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>
        <script>
          Swal.fire({
            title: '¿Seguro que quieres borrar a este miembro?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí',
            cancelButtonText: 'No'
          }).then((result) => {
            if (result.isConfirmed) {
              // Si el usuario hace clic en 'Sí', se elimina la incidencia
              window.location = 'funciones/eliminar_miembro.php?id_clanero=$id_clanero';
            } else {
              // Si el usuario hace clic en 'No', se redirige a la página admin.php sin eliminar la incidencia
              window.location = 'miembros.php';
            }
          });
        </script>";
      exit;
    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
    }
  }
}
?>