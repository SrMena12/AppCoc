<!-- Enlaces a los archivos CSS de Bootstrap -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- Archivos JavaScript de Bootstrap (jQuery y Popper.js) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>

<!-- Archivo JavaScript de Bootstrap -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<style>
  .nav-link:hover {
    transform: scale(1.1);
    transition: transform 0.3s ease;
  }

  .btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
  }

  .nav-item.active .nav-link {
    background-color: #343a40;
  }
  
  .rounded-circle:hover {
    transform: scale(1.05);
  }
  
  @media (min-width: 992px) {
    .navbar-nav {
      align-items: center;
    }
    
    .navbar-collapse {
      justify-content: flex-start;
    }
  }
</style>

<script>
  // Obtener todos los elementos de enlace del menú
  const navLinks = document.querySelectorAll('.nav-link');

  // Iterar sobre los enlaces y agregar el evento click a cada uno
  navLinks.forEach(navLink => {
    navLink.addEventListener('click', function() {
      // Eliminar la clase 'active' de todos los elementos de enlace
      navLinks.forEach(link => link.parentElement.classList.remove('active'));
      // Agregar la clase 'active' al elemento de enlace seleccionado
      this.parentElement.classList.add('active');
    });
  });
</script>

<nav class="navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(to right, #2B3239, #000000);">
  <div class="container">
    <a class="navbar-brand" href="miembros.php">
      <img src="../images/coc.png" alt="Logo" width="50" height="50" class="rounded-circle">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="miembros.php">Miembros</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="sanciones.php">Sanciones</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" onclick="return false;" tabindex="-1" aria-disabled="true">Guerras</a>
        </li>
      </ul>
      <a href="../login.php" class="btn btn-primary ml-auto">
        <i class="material-icons-outlined align-middle">logout</i>
      </a>
    </div>
  </div>
</nav>