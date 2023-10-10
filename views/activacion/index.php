<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      padding-top: 56px;
      position: relative;
      min-height: 100vh;
    }
    .footer {
      position: fixed;
      bottom: 0;
      width: 100%;
      text-align: center;
      padding: 10px 0;
      background-color: #f8f9fa;
    }
  </style>
  <title>Navbar con Bootstrap</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
    <a class="navbar-brand" href="#">
  <img src="<?= asset('images/cit.png') ?>" alt="Logotipo" style="max-width: 40px; height: auto;">
</a>
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button>

      <a class="navbar-brand" href="#">Examen Final</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="usuariosDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Usuarios Pendientes
            </a>
            <ul class="dropdown-menu" aria-labelledby="usuariosDropdown">
              <li><a class="dropdown-item" href="/examenf_prueba/activacion">Solicitud de Usuarios Pendientes</a></li>
              <li><a class="dropdown-item" href="/examenf_prueba/lista">Lista de Usuarios Activos</a></li>
            </ul>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="reportesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Habitaciones Del Hotel
            </a>
            <ul class="dropdown-menu" aria-labelledby="reportesDropdown">
            <li><a class="dropdown-item" href="/examenf_prueba/habitacionesadmin">Administrar Habitaciones</a></li>
            </ul>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="reportesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Reservaciones
            </a>
            <ul class="dropdown-menu" aria-labelledby="reportesDropdown">
            <li><a class="dropdown-item" href="/examenf_prueba/reservacionesadmin">Administrar Reservaciones</a></li>
            </ul>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="reportesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Reporte de Gráficas
            </a>
            <ul class="dropdown-menu" aria-labelledby="reportesDropdown">
            <li><a class="dropdown-item" href="/examenf_prueba/graficaAdmin">Reporte de cantidad de Habitaciones Disponibles, Ocupadas y Limpieza</a></li>
            </ul>
          </li>
        </ul>
        </div>
    <div class="d-flex">
      <a href="/examenf_prueba/menuAdministrador" class="btn btn-info me-2">Menu Principal</a>
      <a href="/examenf_prueba/logout" class="btn btn-danger">Cerrar Sesión</a>
    </div>
  </div>
</nav>
         

  <div class="container">
    <!-- //!FORMULARIO DE ASIGNACION DE ROLES A USARIOS PENDIENTES A ACTIVAR. -->
<div class="row justify-content-center">
            <form class="col-lg-8 border bg-light p-3">
            <h1 class="text-center">Asignacion de Rol al Usuario</h1><br>
            <input type="hidden" name="usu_id" id="usu_id">

            <!-- //!Nombre del Usuario -->
                <div class="row mb-3">
                    <div class="col">
                    <label for="usu_nombre">Nombre del Usuario</label>
                        <input type="text" name="usu_nombre" id="usu_nombre" class="form-control" >
                    </div>
                </div>

                <!-- //!Numero de DPI O Pasaporte -->
                <div class="row mb-3">
                    <div class="col">
                        <label for="usu_dpi">Numero de DPI</label>
                        <input type="number" name="usu_dpi" id="usu_dpi" class="form-control">
                    </div>
                </div>

                <!-- //!Password -->
                <div class="row mb-3" style="display: none;">
                    <div class="col">
                        <label for="usu_password" style="display: none;">CONTRASEÑA</label>
                        <input type="password" name="usu_password" id="usu_password" class="form-control">
                    </div>
                </div>

                <!-- //!Email -->
                <div class="row mb-3" style="display: none;">
                    <div class="col">
                        <label for="usu_email" style="display: none;">EMAIL</label>
                        <input type="email" name="usu_email" id="usu_email" class="form-control">
                    </div>
                </div>

                <!-- //!telefono -->
                <div class="row mb-3" style="display: none;">
                    <div class="col">
                        <label for="usu_telefono" style="display: none;">TELEFONO</label>
                        <input type="number" name="usu_telefono" id="usu_telefono" class="form-control">
                    </div>
                </div>

                <!-- //!Rol -->
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <label for="usu_rol">Asignar Rol a Usuario</label>
                        <select class="form-control" name="usu_rol" id="usu_rol">
                            <option value="">Seleccione un Rol...</option>
                            <?php
                            foreach ($roles as $key => $rol) {
                                if ($rol['rol_id'] <= 3) { 
                                    echo '<option value="' . $rol['rol_id'] . '">' . $rol['rol_nombre'] . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>


                <div class="row mb-3">
                    <div class="col-lg-2">
                        <button type="button" id="btnAsignarRol" class="btn btn-warning w-100">Asignar Rol</button>
                    </div>
                    <div class="col-lg-2">
                        <button type="button" id="btnCancelar" class="btn btn-danger w-100">Cancelar</button>
                    </div>

                </div>
            </form>
        </div>
        <div id="tablaUsuariosContainer" class="container mt-1">
            <div class="row justify-content-center mt-4">
                <div class="col-12 p-4 shadow"> 
                    <div class="text-center">
                        <h1>Solicitudes de Usuarios Pendientes</h1>
                    </div>
            <table id="tablaUsuarios" class="table table-bordered table-hover">
                <!-- Contenido de la tabla -->
            </table>
        </div>
    </div>
</div>
<script src="<?= asset('./build/js/activacion/index.js') ?>"></script>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>





