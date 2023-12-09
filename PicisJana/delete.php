<?php

// Inicializar la sesión
session_start();
 

// Verifique si el usuario ha iniciado sesión, si no, rediríjalo a la página de inicio de sesión
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<?php

// procesar la operación de eliminación después de la confirmación
if(isset($_POST['id']) && !empty($_POST['id']))
{
    
    // incluir la base de datos de conexión de configuración
    include_once 'config.php';

    // Preparar una declaración de eliminación
    $sql = "DELETE FROM incubators WHERE id =?";
    if($stmt = mysqli_prepare($conection_db,  $sql))
    {
        mysqli_stmt_bind_param($stmt, "i", $param_id);

        // establecer parámetros

        $param_id = trim($_POST['id']);

        
        // Intento de ejecutar la sentencia preparada
        if(mysqli_stmt_execute($stmt))
        {
            // Los registros se eliminan con éxito. Redirigir a la página de destino
            header("location:form.php");
            exit();
        }
        else
        {
            echo "Oops! Something went wrong. Please try again leter.";
        }
    }
    
    // cerrar declaración
    mysqli_stmt_close($stmt);

    // conexión cercana
    mysqli_close($conection_db);
}  
    else
{
      
        // Comprobar la existencia del parámetro id
        if(empty(trim($_GET['id'])))
        {
            // La URL no contiene el parámetro id. Redirigir a la página de error
            header("location:error.php");
            exit();
        }
   
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>Delete Record</h1>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger fade in">
                            <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
                            <p>Are you sure you want to delete this record?</p><br>
                            <p>
                                <input type="submit" value="Yes" class="btn btn-danger">
                                <a href="form.php" class="btn btn-default">No</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>


