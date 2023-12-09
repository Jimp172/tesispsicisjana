<?php
// Inicializa la sesión
session_start();

// Comprueba si el usuario ya ha iniciado sesión, si es así, redirige a la página de bienvenida
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: welcome.php");
    exit;
}

// Include config file
require_once "config.php";
require_once "php_login.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Signin Simple</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Enlaza tu archivo CSS personalizado -->
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
<div class="container">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-md-6">
            <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="login-form">
                <div class="text-center">
                    <a href="index.html" aria-label="Space">
                        <img class="mb-3" src="assets/image/psicisjana.png" alt="Logo" width="60" height="60">
                    </a>
                </div>
                <div class="text-center mb-4">
                    <h1 class="h3 mb-0">Por favor, inicie sesión</h1><br>
                    <p>Iniciar sesión para administrar su cuenta.</p> <br>
                </div>

                <div class="form-group <?= (!empty($email_err)) ? 'has-error' : ''; ?>">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-user"></i>
                            </span>
                        </div>
                        <input type="email" class="form-control" name="email" placeholder="Email" aria-label="Email" data-msg="Please enter a valid email address." data-error-class="u-has-error" data-success-class="u-has-success" value="<?= $email; ?>">
                    </div>
                    <span class="help-block"><?= $email_err; ?></span>
                </div>

                <div class="form-group <?= (!empty($password_err)) ? 'has-error' : ''; ?>">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-lock"></i>
                            </span>
                        </div>
                        <input type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                    <span class="help-block"><?= $password_err; ?></span>
                </div>

                <div class="row mb-3">
                    <div class="col-6">
                        <!-- Checkbox -->
                        <div class="custom-control custom-checkbox d-flex align-items-center text-muted">
                            <input type="checkbox" class="custom-control-input" id="rememberMeCheckbox">
                            <label class="custom-control-label" for="rememberMeCheckbox">
                                Recuérdame
                            </label>
                        </div>
                        <!-- End Checkbox -->
                    </div>
                    <div class="col-6 text-right">
                        <a class="float-right" href="reset_password.php">¿Has olvidado tu contraseña?</a>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <button type="submit" class="btn btn-primary login-btn btn-block">Iniciar sesión</button>
                </div>

                <div class="text-center mb-3">
                    <p class="text-muted">¿No tiene una cuenta? <a href="register.php">Inscríbase</a></p>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>
