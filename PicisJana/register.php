<?php
    // Include config file
    require_once 'config.php';
    // Include register file
    include 'php_register.php';
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Registro-PicisJana</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="assets/styles.css">

</head>
<body>
<div class="container">
    <div class="row justify-content-center align-items-center min-vh-100">
        
    <div class="text-center">
        <a href="index.html" aria-label="Space">
            <img class="mb-3" src="assets/image/psicisjana.png" alt="Logo" height="400">
        </a>
    </div>
    
    <div class="login-form">
            <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                
                <div class="text-center mb-4">
                    <h1 class="h3 mb-0">Registrar cuenta</h1><br>
                    <p>Complete el formulario para comenzar</p><br>
                </div>
            
                <div class="js-form-message mb-3">
                    <div class="js-focus-state input-group form" <?= (!empty($email_err)) ? 'has-error' : ''; ?>">
                    <div class="input-group-prepend form__prepend">
                        <span class="input-group-text form__text">
                        <i class="fa fa-user form__text-inner"></i>
                        </span>
                    </div>
                    <input type="email" class="form-control form__input" name="email"value="<?= $email; ?>" placeholder="Correo" aria-label="Email" data-msg="Please enter a valid email address." data-error-class="u-has-error" data-success-class="u-has-success">
                    </div>
                    <span class="help-block"><?= $email_err; ?></span>
                </div>
                <div class="form-group" <?= (!empty($password_err)) ? 'has-error' : ''; ?>">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-lock"></i>
                            </span>                    
                        </div>
                        <input type="password" class="form-control" name="password" placeholder="Contraseña" value="<?= $password; ?>">				
                    </div>
                    <span class="help-block"><?= $password_err; ?></span>
                </div> 
                <div class="form-group" <?= (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-key"></i>
                            </span>                    
                        </div>
                        <input type="password" class="form-control" name="confirm_password" placeholder="Confirmar contraseña" value="<?= $confirm_password; ?>">			
                    </div>
                    <span class="help-block"><?= $confirm_password_err; ?></span>
                </div>          
            
                <div class="form-group mb-3">
                    <button type="submit" class="btn btn-primary login-btn btn-block">Crear cuenta</button>
                </div>
                
                <div class="text-center mb-3">
                    <p type="submit" class="text-muted">¿Tienes una cuenta? <a href="login.php">Iniciar sesión</a></p>
                </div>
                    
                <p class="small text-center text-muted mb-0"></p>
            </form>
        </div>
    </div>
</div>

</body>
</html>