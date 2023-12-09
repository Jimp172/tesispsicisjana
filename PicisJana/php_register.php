<?php
// Definir variables e inicializar con valores vacíos
$email = $password = $confirm_password = "";
$email_err = $password_err = $confirm_password_err = "";
 
// Procesamiento de datos del formulario cuando se envía el formulario
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    // Validar correo electrónico
    if(empty(trim($_POST["email"])))
    {
        $email_err = "Please enter a email.";
    }
        else
    {
        // Preparar una declaración selecta
        $sql = "SELECT id FROM users WHERE email = ?";
        
        if($stmt = mysqli_prepare($conection_db, $sql))
        {
            // Vincular variables a la declaración preparada como parámetros
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            // Establecer parámetros
            $param_email = trim($_POST["email"]);
            
            // Intento de ejecutar la declaración preparada
            if(mysqli_stmt_execute($stmt))
            {
                /* guardar resultado */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    $email_err = "Este correo electrónico ya está en uso.";
                }
                    else
                {
                    $email = trim($_POST["email"]);
                }
            }
                else
            {
                echo "¡Ups! Algo salió mal. Por favor, inténtelo de nuevo más tarde.";
            }

            // Cerrar declaración
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validar contraseña
    if(empty(trim($_POST["password"])))
    {
        $password_err = "Porfavor ingrese una contraseña.";     
        }
            elseif
            (strlen(trim($_POST["password"])) < 6)
        {
        $password_err = "La contraseña debe tener al menos 6 caracteres.";
    }
        else
    {
        $password = trim($_POST["password"]);
    }
    
    // Validar confirmar contraseña
    if(empty(trim($_POST["confirm_password"])))
    {
        $confirm_password_err = "Por favor, confirme la contraseña.";     
    }
        else
    {
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password))
        {
            $confirm_password_err = "La contraseña no coincidió.";
        }
    }
    
    // Verifica los errores de entrada antes de insertar en la base de datos
    if(empty($email_err) && empty($password_err) && empty($confirm_password_err))
    {
        // Preparar una declaración de inserción
        $sql = "INSERT INTO users (email, password) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($conection_db, $sql)){
            // Vincular variables a la declaración preparada como parámetros
            mysqli_stmt_bind_param($stmt, "ss", $param_email, $param_password);
            
            // Establecer parámetros
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Crea un hash de contraseña
            
            // Intento de ejecutar la declaración preparada
            if(mysqli_stmt_execute($stmt))
            {
                // Redirigir a la página de inicio de sesión
                header("location: login.php");
            } 
                else
            {
                echo "Something went wrong. Please try again later.";
            }
            // Cerrar declaración
            mysqli_stmt_close($stmt);
        }
    }
    // Conexión cercana
    mysqli_close($conection_db);
}