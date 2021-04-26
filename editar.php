<?php
    if (isset($_GET['editar'])) {
        $editar_id = $_GET['editar'];
        $consulta = "select * from estudiantes where idEstudiante = $editar_id;";
        $ejecutarC = sqlsrv_query($con, $consulta);

        $fila = sqlsrv_fetch_array($ejecutarC);
        $id = $fila['idEstudiante'];
        $names = $fila['nombres'];
        $lastNames = $fila['apellidos'];
        $gen = $fila['genero'];
        $fechaN = $fila['fechaNac'];
        $auxFechaN = $fechaN->format('d/m/Y');                        
    }
?>
<br>
<div class="container">
    <div class="col-md-8 col-md-offset-2">        
        <form action="" method="post">
            <div class="form-group">
                <label for="">Nombres:</label>
                <input type="text" name="nombres" class="form-control" value=<?php echo $names ?>>
            </div>
            <div class="form-group">
                <label for="">Apellidos:</label>
                <input type="text" name="apellidos" class="form-control" value=<?php echo $lastNames ?>>
            </div>
            <div class="form-group">
                <label for="">Genero:</label>
                <input type="text" name="genero" class="form-control" value=<?php echo $gen ?>>
            </div>
            <div class="form-group">
                <label for="">Fecha de Nacimiento:</label>
            <input type="text" name="fechaNac" class="form-control" value=<?php echo $auxFechaN ?>> 
            </div>
            <div class="form-group">                    
                <input type="submit" name="actualizar" class="btn btn-warning" value="Actualizar Datos">
            </div>
        </form>
    </div>
</div>        

<?php
    if (isset($_POST['actualizar'])) {
        $actualizarNames = $_POST['nombres'];
        $actualizarLastNames = $_POST['apellidos'];
        $actualizarGen = $_POST['genero'];
        $actualizarFechaN = $_POST['fechaNac'];

        $actualizar = "update estudiantes set nombres='$actualizarNames', apellidos='$actualizarLastNames', genero='$actualizarGen', fechaNac='$actualizarFechaN' where idEstudiante='$id';";
        $ejecutarA = sqlsrv_query($con, $actualizar);
        if ($ejecutarA) {
            echo "<script>alert('Datos Actualizados Correctamente!')</script>";
            echo "<script>window.open('index.php', '_self')</script>";
        }
        else {
            echo '<h3> Ocurrió un error al Actualizar! :/ </h3>';
        }                        
    }
?>