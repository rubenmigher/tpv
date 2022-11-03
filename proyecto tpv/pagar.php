<?php
    $cod_empleado = $_POST["cod_empleado"];
    $total = $_POST["total"];

    //1-me conecto con MySQL
    $conexion2 = new mysqli("localhost", "root", "", "tpv");

    //Inserto en ticket la fecha y el codigo del empleado
    $sql ="INSERT INTO ticket(fecha,cod_empleado) VALUES (now(), $cod_empleado)";
    //para ejecutar la orden
    $conexion2->query($sql);
    header("Location:index.php");

?>
