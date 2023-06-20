<?php
require_once('conexion.php');
if (isset($_GET['id_sancion'])) {
  $id = $_GET['id_sancion'];


  // Ejemplo de código para eliminar la sanción utilizando MySQLi
  $sql = "DELETE FROM sanciones WHERE id_sancion = ?";
  $preparada_borrar = $db->prepare($sql);
  $preparada_borrar->execute(array($id));
  

  if ($result) {
    // Sanción eliminada correctamente, redireccionar a la página principal o mostrar un mensaje de éxito
    header("Location: ../sanciones.php");
    exit();
  } else {
    // Error al eliminar la sanción, redireccionar a la página principal o mostrar un mensaje de error
    header("Location: ../sanciones.php");
    exit();
  }
}
?>