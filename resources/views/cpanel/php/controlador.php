<?php
require_once("config.php"); //Misma función con include_once

$conexion = new DBMysql();

// Verificar que la conexión está activa
if ($conexion->getConexion()) {

    if (isset($_GET["ope"])) {
        $ope = $_GET["ope"];
        switch ($ope) {
            case "borrarEstudiante":
                $id = $_GET["id"];
                $sql = "DELETE FROM estudiantes WHERE id=?";
                $consulta = $conexion->prepare($sql);
                $consulta->bind_param("i", $id);
                if ($consulta->execute()) {
                    header("Location: registros.php?mensaje=Estudiante $id ha sido borrado!");
                } else {
                    header("Location: registros.php?mensaje=No se pudo borrar el estudiante $id!");
                }
                break;
        }

    } elseif (isset($_POST["ope"])) {
        $ope = $_POST["ope"];

        switch ($ope) {

            case "eliminarEstudiantes":
                $codigos = $_POST["seleccionados"];
                $total = 0;
                foreach ($codigos as $codigo) {
                    $consulta = $conexion->prepare("DELETE FROM estudiantes WHERE id=?");
                    $consulta->bind_param("i", $codigo);
                    $consulta->execute();
                    if ($consulta->affected_rows > 0) $total++;
                }
                if ($total > 0)
                    header("Location: registros.php?mensaje=Se han eliminado $total estudiantes!");
                else
                    header("Location: registros.php?mensaje=No se pudo eliminar la lista de registros!");
                break;

            case "agregarEstudiante":
                $nombre = addslashes($_POST["nombre"]);
                $apellido_paterno = addslashes($_POST["apellido_paterno"]);
                $apellido_materno = addslashes($_POST["apellido_materno"]);
                $fecha_nacimiento = addslashes($_POST["fechaNacimiento"]);
                $sexo = addslashes($_POST["sexo"]);
                $curp = addslashes($_POST["curp"]);
                $telefono = addslashes($_POST["telefono"]);
                $correo = addslashes($_POST["correo"]);
                $nia = addslashes($_POST["nia"]);
                $grado = addslashes($_POST["grado"]);
                $grupo = addslashes($_POST["grupo"]);
                $usuario = addslashes($_POST["usuario"]);
                $contrasena = $_POST["contrasena"];
                $contrasena_hash = password_hash($contrasena, PASSWORD_DEFAULT);

                $consulta = $conexion->prepare("SELECT COUNT(*) FROM estudiantes WHERE nia=? OR usuario=?");
                $consulta->bind_param("ss", $nia, $usuario);
                $consulta->execute();
                $consulta->bind_result($total);
                $consulta->fetch();
                $consulta->close();

                if ($total == 0) {
                    $insertar = $conexion->prepare("INSERT INTO estudiantes (nombre, apellido_paterno, apellido_materno, fecha_nacimiento, sexo, curp, telefono, correo, nia, grado, grupo, usuario, contrasena_hash) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                    $insertar->bind_param("sssssssssssss", $nombre, $apellido_paterno, $apellido_materno, $fecha_nacimiento, $sexo, $curp, $telefono, $correo, $nia, $grado, $grupo, $usuario, $contrasena_hash);

                    if ($insertar->execute()) {
                        header("Location: registros.php?mensaje=Se agregó el estudiante $nombre!");
                    } else {
                        header("Location: registros.php?mensaje=No se pudo agregar el estudiante $nombre!");
                    }
                    $insertar->close();
                } else {
                    header("Location: registros.php?mensaje=El NIA o usuario ya existe, favor de verificar!");
                }
                break;

            case "obtenerEstudiante":
                $codigo = $_POST["cod"];
                $consulta = $conexion->prepare("SELECT * FROM estudiantes WHERE id=?");
                $consulta->bind_param("i", $codigo);
                $consulta->execute();
                $resultado = $consulta->get_result();
                if ($fila = $resultado->fetch_assoc()) {
                    $info = array(
                        "success" => true,
                        "id" => $fila["id"],
                        "nombre" => $fila["nombre"],
                        "apellido_paterno" => $fila["apellido_paterno"],
                        "apellido_materno" => $fila["apellido_materno"],
                        "fecha_nacimiento" => $fila["fecha_nacimiento"],
                        "sexo" => $fila["sexo"],
                        "curp" => $fila["curp"],
                        "telefono" => $fila["telefono"],
                        "correo" => $fila["correo"],
                        "nia" => $fila["nia"],
                        "grado" => $fila["grado"],
                        "grupo" => $fila["grupo"],
                        "usuario" => $fila["usuario"]
                    );
                } else {
                    $info = array(
                        "success" => false,
                        "error" => "Estudiante no encontrado"
                    );
                }
                echo json_encode($info);
                break;

            case "actualizarEstudiantes":
                $codigoO = addslashes($_POST["codigoE"]);
                $nombre = addslashes($_POST["nombreE"]);
                $apellido_paterno = addslashes($_POST["paternoE"]);
                $apellido_materno = addslashes($_POST["maternoE"]);
                $fecha_nacimiento = addslashes($_POST["fechaNacimientoE"]);
                $sexo = addslashes($_POST["sexoE"]);
                $curp = addslashes($_POST["curpE"]);
                $telefono = addslashes($_POST["telefonoE"]);
                $correo = addslashes($_POST["correoE"]);
                $nia = addslashes($_POST["niaE"]);
                $grado = addslashes($_POST["gradoE"]);
                $grupo = addslashes($_POST["grupoE"]);
                $usuario = addslashes($_POST["usuarioE"]);

                $contrasena = $_POST["contrasenaE"];
                if ($contrasena != "") {
                    $contrasena_hash = password_hash($contrasena, PASSWORD_DEFAULT);
                    $consulta = $conexion->prepare("UPDATE estudiantes SET nombre=?, apellido_paterno=?, apellido_materno=?, fecha_nacimiento=?, sexo=?, curp=?, telefono=?, correo=?, nia=?, grado=?, grupo=?, usuario=?, contrasena_hash=? WHERE id=?");
                    $consulta->bind_param("sssssssssssssi", $nombre, $apellido_paterno, $apellido_materno, $fecha_nacimiento, $sexo, $curp, $telefono, $correo, $nia, $grado, $grupo, $usuario, $contrasena_hash, $codigoO);
                } else {
                    $consulta = $conexion->prepare("UPDATE estudiantes SET nombre=?, apellido_paterno=?, apellido_materno=?, fecha_nacimiento=?, sexo=?, curp=?, telefono=?, correo=?, nia=?, grado=?, grupo=?, usuario=? WHERE id=?");
                    $consulta->bind_param("ssssssssssssi", $nombre, $apellido_paterno, $apellido_materno, $fecha_nacimiento, $sexo, $curp, $telefono, $correo, $nia, $grado, $grupo, $usuario, $codigoO);
                }

                if ($consulta->execute()) {
                    header("Location: registros.php?mensaje=Se actualizó el estudiante $nombre!");
                } else {
                    header("Location: registros.php?mensaje=No se pudo actualizar el estudiante $nombre!");
                }
                break;
        }
    }
}
?>
