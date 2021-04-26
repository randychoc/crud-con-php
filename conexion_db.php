<?php
$serverName = 'localhost';
$connInfo = array("Database"=>"colegio", "UID"=>"randy", "PWD"=>"contra", "CharacterSet"=>"UTF-8");
$con = sqlsrv_connect($serverName, $connInfo);
# Probar conexion 
if ($con) {
    echo "Conexión Exitosa";
}
else {
    echo "Fallo en la Conexión";
    die(print_r(sqlsrv_errors(), true));
}
