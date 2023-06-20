<?php
require_once('conexion.php');
$contador = 0;

try {
    $miembros = "SELECT * FROM clanero";
    $miembros = $db->query($miembros);
    echo '<div class="tablaInci table-responsive-lg"> <table id="tablaScript" class="table table-striped table-hover text-center">';
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

    foreach ($miembros as $row) {
        // Sacamos todos los elementos de la tabla Tareas
        $id_clanero = $row["id_clanero"];
        $nombre = $row["nombre"];
        $rango = $row["rango"];
        $estado = $row["estado"];
        $contador++;

        $filaClass = '';
        if ($estado == 'Activo') {
            $filaClass = 'activo';
        } elseif ($estado == 'Expulsado') {
            $filaClass = 'expulsado';
        }

        echo '<tr class="' . $filaClass . '">';
        echo '<th scope="row">' . $contador . '</th>';
        echo '<td>' . $nombre . '</td>';
        echo '<td>' . $rango . '</td>';
        echo '<td>' . $estado . '</td>';
        echo '<td style="width: 180px;" class="d-flex">'; // Agregamos la clase "d-flex"

        echo '<a class="btn btn-primary" title="Editar" href="funciones/editarmiembro.php?id_clanero=' . $id_clanero . '" style="width: 30px; height: 30px; padding: 0; margin-right: 5px;"><i class="material-icons-outlined" style="font-size: 16px; line-height: 30px;">edit_document</i></a>';

        echo '<form method="POST">';
        echo '<input type="hidden" name="id_clanero" value="' . $id_clanero . '">';
        echo '<button class="btn btn-danger" name="eliminar" title="Eliminar" style="width: 30px; height: 30px; padding: 0; margin-right: 5px;"><i class="material-icons-outlined" style="font-size: 16px; line-height: 30px;">person_remove</i></button>';
        echo '</form>';

        echo '<a class="btn btn-primary" title="Ver sanciones" href="funciones/mostrarsancionesusuario.php?id_clanero=' . $id_clanero . '" style="width: 30px; height: 30px; padding: 0; margin-right: 5px;"><i class="material-icons-outlined" style="font-size: 16px; line-height: 30px;">gavel</i></a>';

        echo '</td>';
        echo '</tr>';
    }
    echo '</tbody></table></div>';

} catch (PDOException $e) {
    echo 'Error con la base de datos: ' . $e->getMessage();
}
?>

<script>
document.addEventListener("DOMContentLoaded", function () {
    var filtroInput = document.getElementById("filtro");

    filtroInput.addEventListener("input", function () {
        var filtro = filtroInput.value.toLowerCase();
        var filas = document.querySelectorAll("#tablaScript tbody tr");

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
</script>