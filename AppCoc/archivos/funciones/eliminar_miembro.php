<?php
// Verificar si se ha proporcionado el parámetro codTarea en la URL
if (isset($_GET["id_clanero"])) {
  $clanero = $_GET["id_clanero"];

  // Realizar la eliminación de la incidencia
  require_once('conexion.php');
  try {
    $deleteparticipa = "DELETE FROM participa WHERE id_clanero = ?";
    $preparada = $db->prepare($deleteparticipa);
    $preparada->execute(array($clanero));

    $deleteIncidencia = "DELETE FROM clanero WHERE id_clanero = ?";
    $preparada = $db->prepare($deleteIncidencia);
    $preparada->execute(array($clanero));

    // Redirigir a la página admin.php después de la eliminación exitosa
    header("Location: ../miembros.php");
    exit;
  } catch (Exception $e) {
    echo "Error: " . $e->getMessage();
  }
} else {
  // Si no se proporcionó el parámetro codTarea, redirigir a la página admin.php sin realizar ninguna acción
  header("Location: ../miembros.php");
  exit;
}
?>


