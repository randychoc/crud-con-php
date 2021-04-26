<!DOCTYPE html>
<?php
    include("conexion_db.php");
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD PHP SQLSERVER</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="col-md-8 col-md-offset-2">
            <h1 class="text-center">CRUD CON PHP Y SQL SERVER</h1>
            <form action="index.php" method="post">
                <div class="form-group">
                    <label for="">Nombres:</label>
                    <input type="text" name="nombres" class="form-control" placeholder="Escriba sus nombres">
                </div>
                <div class="form-group">
                    <label for="">Apellidos:</label>
                    <input type="text" name="apellidos" class="form-control" placeholder="Escriba sus apellidos">
                </div>
                <div class="form-group">
                    <label for="">Genero:</label>
                    <input type="text" name="genero" class="form-control" placeholder="M = masculino / F = femenino">
                </div>
                <div class="form-group">
                    <label for="">Fecha de Nacimiento:</label>
                    <input type="text" name="fechaNac" class="form-control" placeholder="dd-mm-aaaa (ej. 29-12-1997)"> 
                </div>
                <div class="form-group">                    
                    <input type="submit" name="insert" class="btn btn-warning" value="Registrar Estudiante">
                </div>
            </form>
        </div>
    </div>
    <br><br><br>    

    <!-- función INSERTAR -->
    <?php
        if (isset($_POST['insert'])) {
            $names = $_POST['nombres'];
            $lastNames = $_POST['apellidos'];
            $gen = $_POST['genero'];
            $fechaN = $_POST['fechaNac'];

            $insertar = "insert into estudiantes (nombres, apellidos, genero, fechaNac) values ('$names', '$lastNames', '$gen', '$fechaN');";
            $ejecutar = sqlsrv_query($con, $insertar);
            if ($ejecutar) {
                echo '<h3> Estudiantes registrado con éxito! </h3>';
            }
            else {
                echo '<h3> Ocurrió un error al Insertar! :/ </h3>';
            }
        }
        else {
            echo '<h3> Ocurrió un problema en el IF </h3>';
        }
    ?>
    <!-- función CONSULTAR -->
    <div class="container">
        <div class="col-md-8 col-md-offset-2">
            <table class="table table-bordered table-responsive">
                <tr>
                    <td>ID</td>
                    <td>Nombres</td>
                    <td>Apellidos</td>
                    <td>Genero</td>
                    <td>Fecha de Nacimiento</td>
                    <td>Editar</td>
                    <td>Borrar</td>
                </tr>
                <?php
                    $consulta = "select * from estudiantes;";
                    $ejecutarC = sqlsrv_query($con, $consulta);
                    $i = 0;
                    while ($fila = sqlsrv_fetch_array($ejecutarC)) {
                        $id = $fila['idEstudiante'];
                        $names = $fila['nombres'];
                        $lastNames = $fila['apellidos'];
                        $gen = $fila['genero'];
                        $fechaN = $fila['fechaNac'];
                        $auxFechaN = $fechaN->format('d/m/Y'); 
                        $i++;                    
                ?>
                <tr align="center">
                    <td><?php echo $id ?></td>
                    <td><?php echo $names ?></td>
                    <td><?php echo $lastNames ?></td>
                    <td><?php echo $gen ?></td>
                    <td><?php echo $auxFechaN ?></td>
                    <td><a href="index.php?editar=<?php echo $id; ?>">EDITAR</a></td>
                    <td><a href="index.php?borrar=<?php echo $id; ?>">BORRAR</a></td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>

    <!-- función EDITAR -->
    <?php
        if (isset($_GET['editar'])) {
            include("editar.php");
        }
    ?>

    <!-- función BORRAR -->
    <?php
    if (isset($_GET['borrar'])) {
        $borrar_Id = $_GET['borrar'];    

        $consultaB = "delete from estudiantes where idEstudiante='$borrar_Id';";
        $ejecutarB = sqlsrv_query($con, $consultaB);
        if ($ejecutarB) {
            echo "<script>alert('Se eliminó el Registro Correctamente!')</script>";
            echo "<script>window.open('index.php', '_self')</script>";
        }
        else {
            echo '<h3> Ocurrió un error al Borrar! :/ </h3>';
        }                        
    }
    ?>

</body>

</html>