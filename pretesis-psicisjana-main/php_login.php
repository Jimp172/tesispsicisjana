<?php
// Definir variables e inicializar con valores vacíos
$email = $password          = "";
$email_err = $password_err  = "";
// Procesamiento de datos del formulario cuando se envía el formulario
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    // Comprobar si el correo electrónico está vacío
    if(empty(trim($_POST["email"])))
    {
        $email_err = "Please enter email.";
    }
        else
    {
        $email = trim($_POST["email"]);
    }
    // Comprobar si la contraseña está vacía
    if(empty(trim($_POST["password"])))
    {
        $password_err = "Please enter your password.";
    }
        else
    {
        $password = trim($_POST["password"]);
    }
    // Validar credenciales
    if(empty($email_err) && empty($password_err))
    {
        // Preparar una declaración selecta
        $sql = "SELECT id, email, password FROM users WHERE email = ?";
        if($stmt = mysqli_prepare($conection_db, $sql))
        {
            // Vincular variables a la declaración preparada como parámetros
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            // Establecer parámetros
            $param_email = $email;
            // Intento de ejecutar la declaración preparada
            if(mysqli_stmt_execute($stmt))
            {
                // Guardar resultado
                mysqli_stmt_store_result($stmt);
                // Verifique si existe el correo electrónico, si es así, verifique la contraseña
                if(mysqli_stmt_num_rows($stmt) == 1)
                {                    
                    // Vincular variables de resultado
                    mysqli_stmt_bind_result($stmt, $id, $email, $hashed_password);
                    if(mysqli_stmt_fetch($stmt))
                    {
                        if(password_verify($password, $hashed_password)){
                            // La contraseña es correcta, así que inicie una nueva sesión
                            session_start();
                            // Almacenar datos en variables de sesión
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["email"] = $email;                            
                            
                            // Redirigir a la usuario a la página de bienvenida
                            header("location: welcome.php");
                        }
                        else
                        {
                            // Mostrar un mensaje de error si la contraseña no es válida
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                }
                else
                {
                    // Mostrar un mensaje de error si el correo electrónico no existe
                    $email_err = "No account found with that email.";
                }
            }
            else
            {
                echo "Oops! Something went wrong. Please try again later.";
            }
            // Cerrar declaración
            mysqli_stmt_close($stmt);
        }
    }
    // Conexión cerrada
    mysqli_close($conection_db);
}