<?php

// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$name     = $estado     = $descripcion     = $tipo_alimento     = $fecha_inicio     = $total_siembra     = "";
$name_err = $estado_err = $descripcion_err = $tipo_alimento_err = $fecha_inicio_err = $total_siembra_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    // Validate name
    $input_name = trim($_POST["name"]);
    if(empty($input_name))
    {
        $name_err = "Please enter a name.";
    }
    elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/"))))
    {
        $name_err = "Please enter a valid name.";
    }
    else
    {
        $name = $input_name;
    }

    // Validate position
    $input_estado = trim($_POST["estado"]);
    if(empty($input_estado))
    {
        $position_err = "Please enter a estado.";
    }
    elseif(!($input_estado))
    {
        $estado_err = "Please enter a valid estado.";
    }
    else
    {
        $estado = $input_estado;
    }

    // Validate office
    $input_descripcion = trim($_POST["descripcion"]);
    if(empty($input_descripcion))
    {
        $descripcion_err = "Please enter a office.";
    }
    elseif(!($input_descripcion))
    {
        $descripcion_err = "Please enter a valid office.";
    }
    else
    {
        $descripcion = $input_descripcion;
    }

    // Validate age
    $input_tipo_alimento = trim($_POST["tipo_alimento"]);
    if(empty($input_tipo_alimento))
    {
        $tipo_alimento_err = "Please enter the age.";     
    } 
    elseif(!($input_tipo_alimento))
    {
        $tipo_alimento_err = "Please enter a positive integer value.";
    }
    else
    {
        $tipo_alimento = $input_tipo_alimento;
    }

    // Validate date
    $input_fecha_inicio = trim($_POST["fecha_inicio"]);
    if(empty($input_fecha_inicio))
    {
        $fecha_inicio_err = "Please enter the start date.";     
    } 
    elseif(!($input_fecha_inicio))
    {
        $fecha_inicio_err = "Please enter a positive integer value.";
    }
    else
    {
        $fecha_inicio = $input_fecha_inicio;
    }
    
    // Validate salary
    $input_total_siembra = trim($_POST["total_siembra"]);
    if(empty($input_total_siembra))
    {
        $total_siembra_err = "Please enter the salary amount.";     
    } 
    elseif(!ctype_digit($input_total_siembra))
    {
        $total_siembra_err = "Please enter a positive integer value.";
    }
    else
    {
        $total_siembra = $input_total_siembra;
    }
    
    // Check input errors before inserting in database
    if(empty($name_err) && empty($estado_err) && empty($descripcion_err) && empty($tipo_alimento_err) && empty($fecha_inicio_err) && empty($total_siembra_err))
    {
        // Prepare an insert statement
        $sql = "INSERT INTO incubators (name, estado, descripcion, tipo_alimento, fecha_inicio, total_siembra) VALUES (?,?,?,?,?,?)";
         
        if($stmt = mysqli_prepare($conection_db, $sql))
        {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssss", $name, $estado, $descripcion, $tipo_alimento, $fecha_inicio, $total_siembra);
            
            // Set parameters
            $name       = $name;
            $estado   = $estado;
            $descripcion     = $descripcion;
            $tipo_alimento         = $tipo_alimento;
            $fecha_inicio = $fecha_inicio;
            $total_siembra     = $total_siembra;
            $param_id   = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: form.php");
                exit();
            }
            else
            {
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close conection_db
    mysqli_close($conection_db);
}
?>

<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
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
                                    <h2>Create Record</h2>
                                </div>
                                <p>Please fill this form and submit to add employee record to the database.</p>
                                <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                    <div class="form-group <?= (!empty($name_err)) ? 'has-error' : ''; ?>">
                                        <label>Name</label>
                                        <input type="text" name="name" class="form-control" value="<?= $name; ?>">
                                        <span class="help-block"><?= $name_err;?></span>
                                    </div>
                                    <div class="form-group <?= (!empty($estado_err)) ? 'has-error' : ''; ?>">
                                        <label>Position</label>
                                        <input type="text" name="estado" class="form-control" value="<?= $estado; ?>">
                                        <span class="help-block"><?= $estado_err;?></span>
                                    </div>
                                    <div class="form-group <?= (!empty($descripcion_err)) ? 'has-error' : ''; ?>">
                                        <label>Office</label>
                                        <input type="text" name="descripcion" class="form-control" value="<?= $descripcion; ?>">
                                        <span class="help-block"><?= $total_siembra_err;?></span>
                                    </div>
                                    <div class="form-group <?= (!empty($tipo_alimento_err)) ? 'has-error' : ''; ?>">
                                        <label>Age</label>
                                        <input type="number" name="tipo_alimento" class="form-control" value="<?= $tipo_alimento; ?>">
                                        <span class="help-block"><?= $tipo_alimento_err;?></span>
                                    </div>
                                    <div class="form-group<?= (!empty($fecha_inicio_err)) ? 'has-error' : ''; ?>">
                                        <label>Start Date</label>
                                        <input type="date" name="fecha_inicio" class="form-control" value="<?= $fecha_inicio; ?>">
                                        <span class="help-block"><?= $fecha_inicio_err;?></span>
                                    </div>
                                    <div class="form-group <?= (!empty($total_siembra_err)) ? 'has-error' : ''; ?>">
                                        <label>Salary</label>
                                        <input type="text" name="total_siembra" class="form-control" value="<?= $total_siembra; ?>">
                                        <span class="help-block"><?= $total_siembra_err;?></span>
                                    </div>
                                    <input type="submit" class="btn btn-primary" value="Submit">
                                    <a href="form.php" class="btn btn-default" style="color:red;">Cancel</a>
                                </form>
                            </div>
                        </div>        
                    </div>       
                </div>
		</div>
	</body>
</html>

