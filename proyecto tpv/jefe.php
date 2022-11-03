<?php
    $contraseña = $_POST["pw"];
    if($contraseña=="patata") {
?>
        <h1>Hola jefe</h1>
        <?php
        echo "<form action=jefe.php method=post name=f1>";
            echo "<input type=date name=date value='".$fecha."' onchange='this.form.submit()'>";
        echo "</form>";
        $date=$_POST['date'];
        echo $date;
        echo "Caja del dia .";
        ?>
       <table>
            <tr>
                <th>Concepto</th>
                <th>DIA</th>
                <th>MES</th>
                <th>AÑO</th>
                <th>Por dias</th>
                <th>Por meses</th>
                <th>Por años</th>
            </tr>
            <tr>
                <th>Articulo</th>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th>Empleado</th>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th>CAJA</th>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
       </table> 
<?php
    } else {
        echo "Contraseña incorrecta";
        echo "<br>";
        echo "<a href=index.php>Volver al inicio</a>";
    }
?>