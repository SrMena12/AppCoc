<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Icons+Outlined" />
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/styles.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/spinkit@1.2.5/css/spinners.css">
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
  <title>Miembros</title>
</head>

<body>
  <?php require_once('funciones/header.php'); ?>
  <article>
    <section>
      <div class="container px-4 py-5" id="Incidencias">
        <h2 class="pb-2 mb-5 border-bottom">Listado de miembros</h2>
        <div class="p-4 rounded-3" style="background: #F5F4F4">
          <div>
            <div class="input-container mb-4 d-flex justify-content-between">
              <input type="search" placeholder="Buscar miembro" id="filtro" />
              <a href="funciones/aniadirmiembro.php" class="btn btn-primary btn-sm" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                <i class="material-icons-outlined" style="font-size: 24px;">person_add</i>
              </a>
            </div>

            <?php
            // Fichero para mostrar las Tareas del Administrador
            require_once('funciones/eliminarmiembro.php');
            require_once('funciones/mostrarmiembros.php');
            ?>


          </div>
          <div class="d-flex justify-content-center mt-5" id="tablaPaginacion">
            <nav>
              <ul class="pagination mr-2 " id="paginacion"></ul>
            </nav>
          </div>
        </div>
      </div>
    </section>
  </article>

  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#0099ff" fill-opacity="0.2" d="M0,96L40,80C80,64,160,32,240,58.7C320,85,400,171,480,197.3C560,224,640,192,720,186.7C800,181,880,203,960,218.7C1040,235,1120,245,1200,224C1280,203,1360,149,1400,122.7L1440,96L1440,320L1400,320C1360,320,1280,320,1200,320C1120,320,1040,320,960,320C880,320,800,320,720,320C640,320,560,320,480,320C400,320,320,320,240,320C160,320,80,320,40,320L0,320Z"></path></svg>
  <?php require_once('footer.php'); ?>
</body>

</html>

