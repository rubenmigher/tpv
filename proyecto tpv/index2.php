<?php
$cod_empleado = $_POST["cod_empleado"];
$cod_categoria = $_POST["cod_categoria"];
$cod_producto = $_POST["cod_producto"];
$precio = $_POST["precio"];
$cantidad = $_POST['cantidad'];
$pedidos = unserialize($_POST['pedidos']);

if ($cod_producto > 0) {

    if (isset($pedidos[$cod_producto][0])) {
        $pedidos[$cod_producto][0] = $pedidos[$cod_producto][0] + $cantidad;
        $pedidos[$cod_producto][1] = $precio;
    } else {
        $pedidos[$cod_producto][0] = $cantidad;
        $pedidos[$cod_producto][1] = $precio;
    }
}

$fecha = date('m-d-Y h:i:s a');
date_default_timezone_set('Europe/Amsterdam');
$hora = time();
$hoy = getdate();

//1-me conecto con MySQL
$conexion2 = new mysqli("localhost", "root", "", "tpv");
//2-Tengo que crear la orden SQL que necesito(en este caso necesito el cod_cat y el nombre de categoria)
$orden2 = "SELECT cod_categoria,nombre FROM categoria";
//3-Tengo que ejecutar la orden
$chorizo = $conexion2->query($orden2);
?>

<html>

<head>
    <style>
        html {
            background-color: #1E152A;

        }

        #indice {
            width: 100%;
            height: 10%;
            align-items: center;
            display: flex;
            justify-content: center;
            background-color: #1E152A;
            color: white;
        }

        #categoria {
            width: 20%;
            height: 90%;
            display: inline;
            background-color: #5AB1BB;
        }

        #seleccion {
            width: 50%;
            height: 90%;
            display: inline;
            background-color: #A5C882;
        }

        #ticket {
            width: 30%;
            height: 90%;
            display: inline;
            background-color: #F7DD72;
        }
        div{
            align-items: center;
            display: flex;
            height: 100px;
            justify-content: center;
            width: 200px;
        }

        .container {
            width: 100%;
            height: 100%;
            display: flex;
            margin: auto;
        }

        .ima_cat {
            /* height: 60px; */
            width: 60px;
        }
        
        .ima_pro {
            height: 50%;
            width: 100px;
        }

        #categorias{
            align-items: center;
            margin-top: 20%;
            margin-left: 30%;

        }

        #tabla_cabecera {
            margin: 60px;
            padding: 80px;
            width: 100%;
            font-size: 22px;
            font-style: bold;
            color: white;
        }

        #cancelar {
            margin-top: 20px;
            font-size: 22px;
            font-family: Verdana, Helvetica;
            font-weight: bold;
            color: white;
            background: #4E6766;
            border: 1px;
            width: 180px;
            height: 40px;
        }

        #cancelar:hover {
            color: black;
            background: #5AB1BB;
            transition: 3s;
        }

        #botoncobro{
            /* margin-top: 90%; */
            /* margin-bottom: 0%; */
            margin-left:60px;
            font-size: 22px;
            font-family: Verdana, Helvetica;
            font-weight: bold;
            color: white;
            background: #4E6766;
            border: 1px;
            width: 180px;
            height: 40px;
        }
        #botoncobro:hover {
            color: black;
            background: #5AB1BB;
            transition: 3s;
        }
        

        #seleccionpro {
            margin-top: 10%;
            margin-left: 40%;

        }

        #productos th {
            padding: 10px;
            align-items: center;
        }

        #productos td {
            padding: 10px;
            align-items: center;
        }

        #total {
            text-align: center;
            font-style: italic;
        }
    </style>
</head>

<body>
    <!-- Titulo del programa -->
    <div id="indice">
        <table id="tabla_cabecera">
            <tr>
                <?php
                // Recupero el nombre del empleado
                $orden3 = "SELECT nombre FROM empleado WHERE cod_empleado=" . $cod_empleado;
                $chorizo3 = $conexion2->query($orden3);
                $fila3 = $chorizo3->fetch_array();

                echo "<td id=tabla_cabecera>Empleado:" . $fila3[0] . "</td>
                      <td id=tabla_cabecera>Fecha:$hoy[mday]/$hoy[mon]/$hoy[year]</td><td id=tabla_cabecera>Hora:$hoy[hours]:$hoy[minutes]:$hoy[seconds]</td>
                        <td id=tabla_cabecera>
                            <form action=index.php method=post>
                                <input type=submit value=cancelar name=cancelar id=cancelar>
                            </form>
                        </td>"
                ?>
            </tr>
        </table>
    </div>
    <div class="container">
        <div id="categoria">
            <?php
            // Imprimir las categorias
            //La tabla la hago para que me queden en vertical
            echo "<table id=categorias>";
            while ($rodaja = $chorizo->fetch_array()) {
                //Creo un formulario para cada usuario con la idea de que pueda enviar a aquel usuario que clico
                //y trabajar con el
                echo "<form action=index2.php method=POST >";
                echo "<tr>";
                    echo "<td>";
                        echo "<button><input type=image class=ima_cat src=./imagenes/categorias/$rodaja[1].png name=$rodaja[1] value=$rodaja[1]></button>";
                    echo "</td>";
                echo "</tr>";
                echo "<input type=hidden name=cod_categoria value=$rodaja[0]>";
                echo "<input type=hidden name=cod_producto value=0>";
                echo "<input type=hidden name=cantidad value=0>";
                echo "<input type=hidden name=precio value=0>";
                echo "<input type=hidden name=pedidos value='" . serialize($pedidos) . "'>";
                echo "<input type=hidden name=cod_empleado value=" . $cod_empleado . ">";
                echo "</form>";
            }
            echo "</table>";
            ?>

        </div>
        <!-- Aqui pondre los productos que puede comprar -->
        <div id="seleccion">
            <?php
            //Orden para los productos
            $orden3 = "SELECT cod_producto, nombre, precio FROM producto WHERE cod_categoria = " . $cod_categoria;
            //3-Tengo que ejecutar la orden
            $chorizo2 = $conexion2->query($orden3);
            echo "<table id=seleccionpro>";
            while ($rodaja = $chorizo2->fetch_array()) {
                //Creo un formulario para cada usuario con la idea de que pueda enviar a aquel usuario que clico
                //y trabajar con el
                echo "<form action=index2.php method=POST>";
                echo "<tr>";
                    echo "<td>";
                        echo "<button id=ima_cat><input type=image class=ima_pro src=./imagenes/productos/$rodaja[1].png name=$rodaja[0] value=$rodaja[0] alt=prueba></button>";
                        echo "<td>";
                            echo "<select name=cantidad>";
                                echo  "<option value=1>1</option>";
                                echo  "<option value=2>2</option>";
                                echo  "<option value=3>3</option>";
                                echo  "<option value=-1>-1</option>";
                                echo  "<option value=-2>-2</option>";
                                echo  "<option value=-3>-3</option>";
                            echo "</select>";
                        echo "</td>";
                    echo "</td>";
                echo "</tr>";
                echo "<input type=hidden name=cod_categoria value=" . $cod_categoria . ">";
                echo "<input type=hidden name=cod_producto value=" . $rodaja[0] . ">";
                echo "<input type=hidden name=precio value=" . $rodaja[2] . ">";
                echo "<input type=hidden name=cod_empleado value=" . $cod_empleado . ">";
                
                echo "<input type=hidden name=pedidos value='" . serialize($pedidos) . "'>";
                echo "</form>";
            }
            echo "</table>";

            ?>


        </div>
        <!-- el ticket -->
        <div id="ticket">
            <?php
            echo "<table id=productos>";
                echo "<tr>";
                    echo "<th> PRODUCTO </th>";
                    echo "<th> CANTIDAD </th>";
                    echo "<th> SUBTOTAL </th>";
                echo "</tr>";
            $total = 0;
            foreach ($pedidos as $indice => $fila) {
                //Recupero el nombre del producto
                $orden4 = "SELECT nombre FROM producto WHERE cod_producto=" . $indice;
                $chorizo4 = $conexion2->query($orden4);
                $fila4 = $chorizo4->fetch_array();
                echo "<tr>";
                    echo "<td>";
                        echo $fila4[0];
                    echo "</td>";
                    echo "<td>";
                        echo $pedidos[$indice][0];
                    echo "</td>";
                    echo "<td>";
                        $subtotal = $pedidos[$indice][0] * $pedidos[$indice][1];
                        $total = $total + $subtotal;
                        echo $subtotal;
                    echo "</td>";
            }
                echo "<tr>";
                    echo "<td colspan=3> <hr></td>";
                echo "</tr>";
                echo "<tr >";
                    echo "<th> TOTAL</th>";
                    echo "<td colspan=2 id=total>$total €  (IVA inc.)</td>";
                echo "</tr>";
            echo "</table>";
            
            echo"<form action=pagar.php method=post><input type=submit value=Pagar name=cobrar id=botoncobro>";
            echo "<input type=hidden name=cod_empleado value=" . $cod_empleado . ">";
            echo "<input type=hidden name=total value=" . $total . ">";
            echo "</form>";
            ?>
        </div>
    </div>
    </footer>
</body>

</html>