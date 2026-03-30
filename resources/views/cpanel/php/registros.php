<?php
require_once("config.php"); //Misma función con include_onde

$conexion = new DBMysql();

//La conexión esta correcta
if ($conexion->getConexion()) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Control escolar</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">
        <link href="../css/estilos.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="../js/formulario.js?ver=0003"></script>
    </head>

    <body>

        <body style="background-image: linear-gradient(to right, rgba(255, 255, 255, 1), rgba(255, 253, 253, 0.95));"></body>

        <nav class="navbar sticky-bottom" style="background-color:rgb(153, 18, 16);" data-bs-theme="light">
            <div class="container-fluid">
                <a class="navbar-brand text-white" href="#">
                    <img src="../logo/Estudiantes.png" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
                    Control de Estudiantes BACHILLERATO GUSTAVO DIAZ ORDAZ
                </a>
            </div>
        </nav>
        <main class="container completo mt-3">
            <h3 class="text-dark">Registros de estudiantes</h3>

            <div class="row justify-content-center">
                <div class="col-md-6">
                    <?php
                    if (isset($_GET["mensaje"])) {
                        $mensaje = $_GET["mensaje"];

                        echo "<div class='alert alert-info alert-dismissible fade show' role='alert'>
                                    <strong>$mensaje</strong>
                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                </div>";
                    }
                    ?>
                </div>
            </div>
            <div class="row justify-content-end">
                <div class="col-md-6">
                    <button class="btn btn-outline-success" id="botonNuevo" data-bs-toggle="modal" data-bs-target="#modalAgregar">
                        <img src="../logo/Agregar.png" alt="Agregar" style="width:20px; height:20px; margin-right:5px;">
                        Nuevos estudiantes
                    </button>

                    <button class="btn btn-outline-danger" id="botonEliminar">
                        <img src="../logo/usuarioo.png" alt="usuarioo" style="width:20px; height:20px; margin-right:5px;">
                        Borrar estudiantes
                    </button>
                </div>
            </div>

            <div class="row mt-3">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="tablaEstudiantes">
                        <thead class="table-dark text-white">
                            <tr class="">
                                <th>Sel.</th>
                                <th>id</th>
                                <th>Nombre</th>
                                <th>Apellido paterno</th>
                                <th>Apellido materno</th>
                                <th>Fecha de nacimiento</th>
                                <th>Sexo</th>
                                <th>CURP</th>
                                <th>Teléfono</th>
                                <th>Correo</th>
                                <th>NIA</th>
                                <th>Grado</th>
                                <th>Grupo</th>
                                <th>Usuario</th>
                                <th>Act</th>
                            </tr>
                        </thead>
                        <tbody>
                            <form action="controlador.php" name="listaBorrado" id="listaBorrado" method="post">
                                <input type="hidden" name="ope" id="ope" value="eliminarEstudiantes">
                                <?php
                                $sql = "select * from estudiantes"; //condicion para generar la condicon con la BD

                                $resultado = $conexion->query($sql);

                                while ($fila = $resultado->fetch_array()) {
                                    echo "<tr>";
                                    echo "<td align='center'>
                                    <input class='form-check-input' type='checkbox' value='{$fila[0]}' name='seleccionados[]'>

                                </div>
                                </td>";
                                    echo "<td>" . $fila[0] . "</td>";  // id
                                    echo "<td>" . $fila[1] . "</td>";  // nombre
                                    echo "<td>" . $fila[2] . "</td>";  // apellido_paterno
                                    echo "<td>" . $fila[3] . "</td>";  // apellido_materno
                                    echo "<td>" . $fila[4] . "</td>";  // fecha_nacimiento
                                    echo "<td>" . $fila[5] . "</td>";  // sexo
                                    echo "<td>" . $fila[6] . "</td>";  // curp
                                    echo "<td>" . $fila[7] . "</td>";  // telefono
                                    echo "<td>" . $fila[8] . "</td>";  // correo
                                    echo "<td>" . $fila[9] . "</td>";  // nia
                                    echo "<td>" . $fila[10] . "</td>"; // grado
                                    echo "<td>" . $fila[11] . "</td>"; // grupo
                                    echo "<td>" . $fila[12] . "</td>"; // usuario
                                    echo "<td>";
                                    echo "<button class='btn btn-info btn-sm' data-id='{$fila[0]}' type='button'><i class='fa fa-edit'></i></button>";
                                    echo "<a class='btn btn-danger btn-sm' href='controlador.php?ope=borrarEstudiante&id={$fila[0]}' name='BorrarI'><i class='fa fa-trash'></i></a>"; //borrar con controlador.php
                                    echo "</td>";
                                    echo "</tr>";
                                }
                                ?>
                                </>
                            </form>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
        <!-- Modal de Agregar -->
        <div class="modal" tabindex="-1" id="modalAgregar" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title">Registrar estudiante</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>


                    <form action="controlador.php" method="post" class="needs-validation" novalidate id="formularioAgregar">
                        <input type="hidden" name="ope" value="agregarEstudiante">

                        <div class="modal-body">
                            <div class="row g-3">
                                <h5>Datos Personales</h5>
                                <div class="col-md-4">
                                    <label class="form-label">Nombre</label>
                                    <input type="text" name="nombre" id="nombre" class="form-control" required>
                                    <div class="invalid-feedback"></div>
                                    <div class="valid-feedback"></div>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Apellido Paterno</label>
                                    <input type="text" name="apellido_paterno" id="paterno" class="form-control" required>
                                    <div class="invalid-feedback"></div>
                                    <div class="valid-feedback"></div>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Apellido Materno</label>
                                    <input type="text" name="apellido_materno" id="materno" class="form-control" required>
                                    <div class="invalid-feedback"></div>
                                    <div class="valid-feedback"></div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Fecha de nacimiento</label>
                                    <input type="date" name="fechaNacimiento" id="fechaNacimiento" class="form-control" required>
                                    <div class="invalid-feedback"></div>
                                    <div class="valid-feedback"></div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Sexo</label>
                                    <select name="sexo" id="sexo" class="form-select" required>
                                        <option value="">Selecciona...</option>
                                        <option>Masculino</option>
                                        <option>Femenino</option>
                                        <option>Otro</option>
                                    </select>
                                    <div class="invalid-feedback"></div>
                                    <div class="valid-feedback"></div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">CURP</label>
                                    <input type="text" name="curp" id="curp" class="form-control" maxlength="18" required>
                                    <div class="invalid-feedback"></div>
                                    <div class="valid-feedback"></div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Teléfono</label>
                                    <input type="tel" name="telefono" id="telefono" class="form-control" maxlength="10" required>
                                    <div class="invalid-feedback"></div>
                                    <div class="valid-feedback"></div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Correo electrónico</label>
                                    <input type="email" name="correo" id="correo" class="form-control" required>
                                    <div class="invalid-feedback"></div>
                                    <div class="valid-feedback"></div>
                                </div>

                                <h5>Datos Escolares</h5>
                                <div class="col-md-6">
                                    <label class="form-label">NIA</label>
                                    <input type="text" name="nia" id="nia" class="form-control" required>
                                    <div class="invalid-feedback"></div>
                                    <div class="valid-feedback"></div>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Grado</label>
                                    <select name="grado" id="grado" class="form-select" required>
                                        <option value="">Selecciona...</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                    <div class="invalid-feedback"></div>
                                    <div class="valid-feedback"></div>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Grupo</label>
                                    <select name="grupo" id="grupo" class="form-select" required>
                                        <option value="">Selecciona...</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                    </select>
                                    <div class="invalid-feedback"></div>
                                    <div class="valid-feedback"></div>
                                </div>

                                <h5>Datos de Usuario</h5>
                                <div class="col-md-6">
                                    <label class="form-label">Usuario</label>
                                    <input type="text" name="usuario" id="usuario" class="form-control" required>
                                    <div class="invalid-feedback"></div>
                                    <div class="valid-feedback"></div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Contraseña</label>
                                    <input type="password" name="contrasena" id="contrasena" class="form-control" required minlength="6" maxlength="10">
                                    <div class="invalid-feedback"></div>
                                    <div class="valid-feedback"></div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Registrar</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <form name="geteEstudiante" id="getEstudiante">
            <input type="hidden" value="obtenerEstudiante" name="ope">
            <input type="hidden" value="" name="cod" id="cod">
        </form>
        <!-- Modal de Editar -->
        <div class="modal" tabindex="-1" id="modalEditar" name="modalEditar" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-info text-white">
                        <h5 class="modal-title">Editar Registro</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button><!--X para cerrar ventana-->
                    </div>
                    <div class="modal-body">
                        <form action="controlador.php" method="post" id="formEditar" name="formEditar">
                        <input type="hidden" name="ope" value="actualizarEstudiantes">
                        <input type="hidden" name="codigoE" id="codigoE" value="">
                        <div class="row mb-3">
                            <h5>Datos Personales</h5>
                            <div class="col-md-4">
                                <label class="form-label">Nombre</label>
                                <input type="text" name="nombreE" id="nombreE" class="form-control" required>
                                <div class="invalid-feedback"></div>
                                <div class="valid-feedback"></div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Apellido Paterno</label>
                                <input type="text" name="paternoE" id="paternoE" class="form-control" required>
                                <div class="invalid-feedback"></div>
                                <div class="valid-feedback"></div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Apellido Materno</label>
                                <input type="text" name="maternoE" id="maternoE" class="form-control" required>
                                <div class="invalid-feedback"></div>
                                <div class="valid-feedback"></div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Fecha de nacimiento</label>
                                <input type="date" name="fechaNacimientoE" id="fechaNacimientoE" class="form-control" required>
                                <div class="invalid-feedback"></div>
                                <div class="valid-feedback"></div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Sexo</label>
                                <select name="sexoE" id="sexoE" class="form-select" required>
                                    <option value="">Selecciona...</option>
                                    <option>Masculino</option>
                                    <option>Femenino</option>
                                    <option>Otro</option>
                                </select>
                                <div class="invalid-feedback"></div>
                                <div class="valid-feedback"></div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">CURP</label>
                                <input type="text" name="curpE" id="curpE" class="form-control" maxlength="18" required>
                                <div class="invalid-feedback"></div>
                                <div class="valid-feedback"></div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Teléfono</label>
                                <input type="tel" name="telefonoE" id="telefonoE" class="form-control" maxlength="10" required>
                                <div class="invalid-feedback"></div>
                                <div class="valid-feedback"></div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Correo electrónico</label>
                                <input type="email" name="correoE" id="correoE" class="form-control" required>
                                <div class="invalid-feedback"></div>
                                <div class="valid-feedback"></div>
                            </div>

                            <h5>Datos Escolares</h5>
                            <div class="col-md-6">
                                <label class="form-label">NIA</label>
                                <input type="text" name="niaE" id="niaE" class="form-control" required>
                                <div class="invalid-feedback"></div>
                                <div class="valid-feedback"></div>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Grado</label>
                                <select name="gradoE" id="gradoE" class="form-select" required>
                                    <option value="">Selecciona...</option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                </select>
                                <div class="invalid-feedback"></div>
                                <div class="valid-feedback"></div>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Grupo</label>
                                <select name="grupoE" id="grupoE" class="form-select" required>
                                    <option value="">Selecciona...</option>
                                    <option>A</option>
                                    <option>B</option>
                                    <option>C</option>
                                </select>
                                <div class="invalid-feedback"></div>
                                <div class="valid-feedback"></div>
                            </div>

                            <h5>Datos de Usuario</h5>
                            <div class="col-md-6">
                                <label class="form-label">Usuario</label>
                                <input type="text" name="usuarioE" id="usuarioE" class="form-control" required>
                                <div class="invalid-feedback"></div>
                                <div class="valid-feedback"></div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Contraseña</label>
                                <input type="password" name="contrasenaE" id="contrasenaE" class="form-control">
                                <div class="invalid-feedback"></div>
                                <div class="valid-feedback"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Actualizar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>


    <?php
}
    ?>