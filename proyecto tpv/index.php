<html>
<head>
    <style>
        html {
            background-color: #1E152A;

        }

        div {
            align-items: center;
            display: flex;
            height: 100px;
            justify-content: center;
            width: 200px;
        }

        #indice {
            width: 100%;
            height: 25%;
            background-color: #1E152A;
            color: white;

        }

        #usuario {
            width: 100%;
            height: 50%;
            background-color: #4E6766;

        }

        #contabilidad {
            width: 100%;
            height: 25%;
            background-color: #5AB1BB;

        }

        .icon {
            height: 90;
            width: 90;
            outline: none;
            border-radius: 90px;
        }

        img {
            height: 60;
            width: 60;
        }

        button {
            outline: none;
        }
    </style>
</head>

<body>
    <?php
    //1-me conecto con MySQL
    $conexion = new mysqli("localhost", "root", "", "tpv");
    //2-Tengo que crear la orden SQL que necesito
    $orden = "SELECT cod_empleado,nombre FROM empleado WHERE activo=1";
    //3-Tengo que ejecutar la orden
    $chorizo = $conexion->query($orden);


    ?>

    <!-- Titulo del programa -->
    <div id="indice">
        <h1>TPV BAR-TOLO</h1>
    </div>
    <!-- Aqui iran los distintos usuarios que van a trabajar -->
    <div id="usuario">

        <!-- Nos muestra los empleados activos -->
        <?php
        // Imprimir la gente quien esta trabajando(activos)
        //La tabla la hago para que me queden en vertical
        echo "<table>";
        while ($rodaja = $chorizo->fetch_array()) {
            //Creo un formulario para cada usuario con la idea de que pueda enviar a aquel usuario que clico
            //y trabajar con el
            echo "<form action=index2.php method=POST>";

            echo "<tr>";
            echo "<td>";
            echo "<input type=hidden name=cod_empleado value=$rodaja[0]>";
            echo "<input type=hidden name=cod_categoria value=0>";
            echo "<input type=hidden name=cod_producto value=0>";
            echo "<input type=hidden name=cantidad value=0>";
            echo "<input type=hidden name=precio value=0>";
            $pedidos = array();
            echo "<input type=hidden name=pedidos value='" . serialize($pedidos) . "'>";
            echo "<button class=icon>
                                                <img src=./imagenes/$rodaja[1].png name=$rodaja[1] value=$rodaja[1]>$rodaja[1]                       
                                            </button>";
            echo "</td>";
            echo "</tr>";

            echo "</form>";
            echo "<br/>";
        }
        echo "</table>";
        ?>

    </div>
    <!-- Aqui voy a poner el jefe con su contraseña -->
    <div id="contabilidad">
        <?php
        echo "Jefe:";
        echo "<form action=jefe.php method=POST>";
        echo "<input type=password name=pw>";
        echo "<input type=submit name=caja value=caja><br/>";
        echo "</form>";
        ?>
    </div>
    </footer>
</body>

</html>