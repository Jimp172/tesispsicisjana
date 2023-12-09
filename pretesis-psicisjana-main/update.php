<?php
// Inicializa la sesión
session_start();
 
// Verifique si el usuario ha iniciado sesión, si no, rediríjalo a la página de inicio de sesión
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<?php
// Incluir archivo de configuración
require_once "config.php";
 
// Definir variables e inicializar con valores vacíos
$name     = $estado     = $descripcion     = $tipo_alimento     = $fecha_inicio     = $total_siembra     = "";
$name_err = $estado_err = $descripcion_err = $tipo_alimento_err = $fecha_inicio_err = $total_siembra_err = "";

// Procesamiento de datos del formulario cuando se envía el formulario
if(isset($_POST["id"]) && !empty($_POST["id"]))
{
    // Obtener valor de entrada oculto
    $id = $_POST["id"];
    
    // Validar nombre
    $input_name = trim($_POST["name"]);
    if(empty($input_name))
    {
        $name_err = "Introduce un nombre.";
    }
    elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/"))))
    {
        $name_err = "Por favor ingrese un nombre valido.";
    }
    else
    {
        $name = $input_name;
    }

    // Valida estado
    $input_estado = trim($_POST["estado"]);
    if(empty($input_estado))
    {
        $position_err = "Por favor ingrese un estado.";
    }
    elseif(!($input_estado))
    {
        $estado_err = "Por favor ingrese un estado válido.";
    }
    else
    {
        $estado = $input_estado;
    }

    // Valida descripcion
    $input_descripcion = trim($_POST["descripcion"]);
    if(empty($input_descripcion))
    {
        $descripcion_err = "Por favor ingrese una oficina.";
    }
    elseif(!($input_descripcion))
    {
        $descripcion_err = "Introduzca una oficina válida.";
    }
    else
    {
        $descripcion = $input_descripcion;
    }
    // Valida tipo de alimento
    $input_tipo_alimento = trim($_POST["tipo_alimento"]);
    if(empty($input_tipo_alimento))
    {
        $tipo_alimento_err = "Por favor ingrese el tipo de alimento.";     
    } 
    elseif(!($input_tipo_alimento))
    {
        $tipo_alimento_err = "Introduzca un valor.";
    }
    else
    {
        $tipo_alimento = $input_tipo_alimento;
    }

    // Valida Fecha de inicio
    $input_fecha_inicio = trim($_POST["fecha_inicio"]);
    if(empty($input_fecha_inicio))
    {
        $fecha_inicio_err = "Por favor ingrese la fecha de inicio de inicio";     
    } 
    elseif(!($input_fecha_inicio))
    {
        $fecha_inicio_err = "Por favor ingrese una fecha";
    }
    else
    {
        $fecha_inicio = $input_fecha_inicio;
    }
    
    // valida total de siembra
    $input_total_siembra = trim($_POST["total_siembra"]);
    if(empty($input_total_siembra))
    {
        $total_siembra_err = "Por favor ingrese el total de siembra.";     
    } 
    elseif(!ctype_digit($input_total_siembra))
    {
        $total_siembra_err = "Introduzca un valor entero positivo.";
    }
    else
    {
        $total_siembra = $input_total_siembra;
    }
    
    // Verifica los errores de entrada antes de insertar en la base de datos
    if(empty($name_err) && empty($estado_err) && empty($descripcion_err) && empty($tipo_alimento_err) && empty($fecha_inicio_err) && empty($total_siembra_err))
    {
        // Prepare an update statement
        $sql = "UPDATE incubators SET name=?, estado=?, descripcion=?, tipo_alimento=?, fecha_inicio=?, total_siembra=? WHERE id=?";

        if($stmt = mysqli_prepare($conection_db, $sql))
        {
            // Vincula variables a la declaración preparada como parámetros
            mysqli_stmt_bind_param($stmt, "ssssssi", $name, $estado, $descripcion, $tipo_alimento, $fecha_inicio, $total_siembra, $param_id);
            
            // Establecer parámetros
            $name       = $name;
            $estado   = $estado;
            $descripcion     = $descripcion;
            $tipo_alimento        = $tipo_alimento;
            $fecha_inicio = $fecha_inicio;
            $total_siembra     = $total_siembra;
            $param_id = $id;
            
            // Intento de ejecutar la declaración preparada
            if(mysqli_stmt_execute($stmt))
            {
                // Registros actualizados con éxito. Redirigir a la página de destino
                header("location: form.php");
                exit();
            }
            else
            {
                echo "Algo salió mal. Por favor, inténtelo de nuevo más tarde.";
            }
        }
         
        // Cerrar declaración
        mysqli_stmt_close($stmt);
    }
    
    // Close conection_db
    mysqli_close($conection_db);
}
else
{
    // Verifique la existencia del parámetro id antes de continuar con el procesamiento
    if(isset($_GET["id"]) && !empty(trim($_GET["id"])))
    {
        // Obtener parámetro de URL
        $id =  trim($_GET["id"]);
        
        // Preparar una declaración selecta
        $sql = "SELECT * FROM incubators WHERE id = ?";
        if($stmt = mysqli_prepare($conection_db, $sql))
        {
            // Vincular variables a la declaración preparada como parámetros
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Establecer parámetros
            $param_id = $id;
            
            // Intento de ejecutar la declaración preparada
            if(mysqli_stmt_execute($stmt))
            {
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1)
                {
                    /* Obtiene la fila de resultados como una matriz asociativa. Dado que el conjunto de resultados
                    contiene solo una fila, no necesitamos usar while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Recuperar valor de campo individual
                    $name       = $row["name"];
                    $estado   = $row["estado"];
                    $descripcion     = $row["descripcion"];
                    $tipo_alimento        = $row["tipo_alimento"];
                    $fecha_inicio = $row["fecha_inicio"];
                    $total_siembra     = $row["total_siembra"];

                }
                else
                {
                    // La URL no contiene una identificación válida. Redirigir a la página de error
                    header("location: error.php");
                    exit();
                }
            }
            else
            {
                echo "¡Ups! Algo salió mal. Por favor, inténtelo de nuevo más tarde.";
            }
        }
        
        // Cerrar declaración
        mysqli_stmt_close($stmt);
        
        // Cerrar conexión_db
        mysqli_close($conection_db);
    }
    else
    {
        // La URL no contiene el parámetro id. Redirigir a la página de error
        header("location: error.php");
        exit();
    }
}

?>


<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Admin Dashboard</title>
<!-- style css php -->
<?php include_once 'css_style/style.php';?>
<!-- add style css -->
<!-- end style css php -->
	<body>
    <style>
        .help-block{
            color:red;
        }
    </style>
		<div id="wrapper">
            <!-- nav -->
            <?php include_once 'sidebar/nav_form.php';?>
			<!-- end nav -->
			<div id="page-wrapper" class="gray-bg dashbard-1">
                <!-- navbar -->
                <?php include_once 'sidebar/navbar.php';?>
                <!-- end navbar -->
				<div class="wrapper wrapper-content">
                    <div class="signup-form">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="page-header">
                                    <h2>Crear registro</h2>
                                </div>
                                <p>Complete este formulario y envíelo para agregar el registro del empleado a la base de datos.</p>
                                <form action="<?= htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                                    <div class="form-group <?= (!empty($name_err)) ? 'has-error' : ''; ?>">
                                        <label>Nombre</label>
                                        <input type="text" name="name" class="form-control" value="<?= $name; ?>">
                                        <span class="help-block"><?= $name_err;?></span>
                                    </div>
                                    <div class="form-group <?= (!empty($estado_err)) ? 'has-error' : ''; ?>">
                                        <label>Estado</label>
                                        <input type="text" name="estado" class="form-control" value="<?= $estado; ?>">
                                        <span class="help-block"><?= $estado_err;?></span>
                                    </div>
                                    <div class="form-group <?= (!empty($descripcion_err)) ? 'has-error' : ''; ?>">
                                        <label>Descripcion</label>
                                        <input type="text" name="descripcion" class="form-control" value="<?= $descripcion ?>">
                                        <span class="help-block"><?= $descripcion_err;?></span>
                                    </div>
                                    <div class="form-group <?= (!empty($tipo_alimento_err)) ? 'has-error' : ''; ?>">
                                        <label>Tipo_alimento</label>
                                        <input type="text" name="tipo_alimento" class="form-control" value="<?= $tipo_alimento; ?>">
                                        <span class="help-block"><?= $tipo_alimento_err;?></span>
                                    </div>
                                    <div class="form-group<?= (!empty($fecha_inicio_err)) ? 'has-error' : ''; ?>">
                                        <label>Fecha de inicio</label>
                                        <input type="text" name="fecha_inicio" class="form-control" value="<?= $fecha_inicio; ?>">
                                        <span class="help-block"><?= $fecha_inicio_err;?></span>
                                    </div>
                                    <div class="form-group <?= (!empty($total_siembra_err)) ? 'has-error' : ''; ?>">
                                        <label>Total de siembra</label>
                                        <input type="text" name="total_siembra" class="form-control" value="<?= $total_siembra; ?>">
                                        <span class="help-block"><?= $total_siembra_err;?></span>
                                    </div>
                                    <input type="hidden" name="id" value="<?= $id; ?>"/>
                                    <input type="submit" class="btn btn-primary" value="Submit">
                                    <a href="form.php" class="btn btn-default" style="color:red;">Cancelar</a>
                                </form>
                            </div>
                    </div>        
                </div>
                </div>
            </div>
                <!-- foodter -->
                <?php include_once 'foodter/foodter.php';?>
				<!-- end foodter -->
			</div>
            <!-- chart -->
            <?php include_once 'chart/chart.php'; ?>
            <!-- end chart -->
		</div>
	</body>
</html>

