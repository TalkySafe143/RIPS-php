<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Papa</title>
    <link rel="stylesheet" href="./style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'></script>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
    $(document).ready(function(){

        $('.input-daterange').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            calendarWeeks : true,
            clearBtn: true,
            disableTouchKeyboard: true,
        });

    });
    </script>
    <?php
    
    
    function connnect(){
        
        $conexion = mysqli_connect('localhost', 'root', '');
    
        if (mysqli_connect_errno()) {
            echo "NO SE PUDO CONECTAR JAJAJAJJA";
        }
    
        mysqli_select_db($conexion, 'usuarios') or die ("No se pudo encontrar la base de datos");

        mysqli_set_charset($conexion, 'utf-8');

        $cambio = "ALTER TABLE `hoja1` CHANGE `Fecha de la consulta` `Fecha de la consulta` DATE NULL DEFAULT NULL;";

        $result2 = mysqli_query($conexion, $cambio);

        if ($result2 === false) {
            $reason = mysqli_error($conexion);
            echo $reason;
            echo "<script>
            document.addEventListener('DOMContentLoaded', () => {
                swal({
                    icon: 'warning',
                    title: 'Error en el cambio de formato (Fechas)',
                    text: 'No se pudo cambiar el formato de las fechas, revisa la informacion'
                });
            });
        </script>";
            return;
        } else {
            $alerts = array('Se ha hecho el cambio correctamente');
        }
        
        $number = $_GET["codigo"];

        $waw = $_GET["fecha1"];

        $wow = $_GET["fecha2"];

        $norepetir = "SELECT DISTINCT `Tipo de Identificacion del Usuario`, `Numero de identificacion del usuario en el sistema`,`Codigo Entidad Administradora`, `Tipo de Usuario`, `Primer Apellido del usuario`, `Segundo apellido del usuario`, `Primer nombre del usuario`, `Segundo nombre del usuario`, `Edad`, `Unidad de medida de la Edad`, `Sexo`, `Codigo del departamento de residencia habitual`, `Localidad`, `Zona de residencia habitual` FROM `hoja1` WHERE `Fecha de la consulta` BETWEEN '$waw' AND '$wow' AND `Codigo del Prestador` = $number";
        
        $query = "SELECT * FROM `hoja1` WHERE `Fecha de la consulta` BETWEEN '$waw' AND '$wow' AND `Codigo del Prestador`= $number";
    
        $result = mysqli_query($conexion, $query);


        if ($result === false) {
            echo ("
            <script>
            document.addEventListener('DOMContentLoaded', function(){
                swal({
                    icon: 'error',
                    title: 'No se pudo hacer la consulta',
                    text: 'Revisa la informacion'
                });
            });
            </script>
            ");
        }

        $namea1 = $_GET["namea1"];
        $namea2 = $_GET["namea2"];
        $namea3 = $_GET["namea3"];

        $archivo1 = fopen("C:/Users/USER/Downloads/$namea1.txt", "wr");    // Abrir el archivo, creándolo si no existe

        if($archivo1 == true){
            array_push($alerts, 'Se creo el primer archivo correctamente');
        }

        $archivo2 = fopen("C:/Users/USER/Downloads/$namea2.txt", "wr");    // Abrir el archivo, creándolo si no existe

        if($archivo2 == true){
            array_push($alerts, 'Se creo el segundo archivo correctamente');
        }

        $archivo3 = fopen("C:/Users/USER/Downloads/$namea3.txt", "wr");    // Abrir el archivo, creándolo si no existe

        if($archivo3 == true){
            array_push($alerts, 'Se creo el tercer archivo correctamente');
        }

        while($fila = mysqli_fetch_row($result)){
            $fecha1 = $fila[0];
            $separado1 = explode('-', $fecha1);
            $fecha2 = $fila[26];
            $separado2 = explode('-', $fecha2);
            $fecha3 = $fila[27];
            $separado3 = explode('-', $fecha3);
            fwrite($archivo2, $fila[22] . "," . $fila[23] . "," . $fila[24] . "," . $fila[25] . "," . $fila[1] . "," . $separado1[2] . "/" . $separado1[1] . "/" . $separado1[0] . "," . $separado2[2] . "/" . $separado2[1] . "/" . $separado2[0] . "," . $separado3[2] . "/" . $separado3[1] . "/" . $separado3[0] . "," . $fila[17] . "," . $fila[28] . "," . $fila[29] . "," . $fila[30] . "," . $fila[31] . "," . $fila[32] . "," . $fila[33] . "," . $fila[34] . "," . $fila[35] . "\n");
            fwrite($archivo3, $fila[1] . "," . $fila[22] . "," . $fila[3] . "," . $fila[4] . "," . $separado1[2] . "/" . $separado1[1] . "/" . $separado1[0] . "," . $fila[36] . "," . $fila[12] . "," . $fila[13] . "," . $fila[14] . "," . $fila[15] . "," . $fila[37] . "," . $fila[38] . "," . $fila[39] . "," . $fila[16] . "," . $fila[2] . "," . $fila[40] . "," . $fila[41] . "\n");
        }

        $result3 = mysqli_query($conexion, $norepetir);

        if ($result3 === false){
            echo "<script>
            document.addEventListener('DOMContentLoaded', function(){
                swal({
                    icon: 'warning',
                    title: 'Error en un espacio en la base de datos o con el filtro de no repetir los datos',
                    text: 'No se hizo correctamente el filtro sin repetir o hay algún problema con los espacios de la base de datos de MySQL'
                });
            });
        </script>";
            return;
        } else {
            array_push($alerts, 'Se hizo el filtro sin repetir');
            echo ("
            <script>
                document.addEventListener('DOMContentLoaded', function(){
                    swal({
                        icon: 'success',
                        title: 'RIPS generados con exito',
                        text: 'Los archivos y los filtros se han realizado correctamente'
                    });
                });
            </script>
            ");
        }

        while ($consulta1 = mysqli_fetch_row($result3)){
            fwrite($archivo1, $consulta1[0] . "," . $consulta1[1] . "," . $consulta1[2] . "," . $consulta1[3]. "," . $consulta1[4] . "," . $consulta1[5] . "," . $consulta1[6] . "," . $consulta1[7] . "," . $consulta1[8] . "," . $consulta1[9] . "," . $consulta1[10] . "," . $consulta1[11] . "," . $consulta1[12] . "," . $consulta1[13] . "\n");
        }
        
        mysqli_close($conexion);
    }

    
    ?>
</head>
<header>
    <div class="container">
        <div>
            <h1 class="titulo">Generador de RIPS</h1>
        </div>
    </div>
</header>
<body>
<div class="container">
    <form method="get">
        <div class="row">
            <div class="form-floating col-md-4">
                <input type="number" name="codigo" class="form-control" id="floatingNumber" placeholder="Codigo del prestador: ">
                <label for="floatingNumber" id="ohhhh">Codigo del prestador: </label>
            </div>
            <div class="col-md-4">
                <img src="./style/linea-removebg-preview.png" alt="Linea que no carga JAJAJAJ" class="imagen">
            </div>
            <div class="col-md-4" id="desplegable">
            <div class="input-group input-daterange"> 
                <input type="text" id="start" class="form-control text-left mr-2 date" name="fecha1" autocomplete="off"> 
                <label class="ml-3 form-control-placeholder" id="start-p" for="start">Primera fecha</label> 
                <span class="fa fa-calendar" id="fa-1"></span> 
                <input type="text" id="end" class="form-control text-left ml-2 date" name="fecha2" autocomplete="off"> 
                <label class="ml-3 form-control-placeholder" id="end-p" for="end">Segunda Fecha</label>
                <span class="fa fa-calendar" id="fa-2"></span> 
            </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h1 class="titulo">Archivos</h1>
            </div>
        </div>
        <div class="row">
            <div class="form-floating col-md-4">
                <input type="text" name="namea1" class="form-control" id="floatingNumber" placeholder="Usuarios:">
                <label for="floatingNumber" id="ohhhh">Usuarios:</label>
            </div>
            <div class="form-floating col-md-4">
                <input type="text" name="namea2" class="form-control" id="floatingNumber" placeholder="Facturas:">
                <label for="floatingNumber" id="ohhhh">Facturas:</label>
            </div>
            <div class="form-floating col-md-4">
                <input type="text" name="namea3" class="form-control" id="floatingNumber" placeholder="Consultas:">
                <label for="floatingNumber" id="ohhhh">Consultas:</label>
            </div> 
        </div>
        <div class="row">
            <div class="col-md-4">
                &nbsp;
            </div>
            <div class="d-grid col-md-4 mx-auto">
                <input type="submit" class="btn btn-primary" name="enviar">
            </div>
            <div class="col-md-4">
                &nbsp;
            </div>
        </div>
    </form>
    </div>
    <?php
    
    if (isset($_GET['enviar'])) {
        connnect();
    }
    
    ?>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
</body>
</html>
