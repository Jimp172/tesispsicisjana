
<?php
    // Inicializa la sesión
    session_start();
    
    // Verifica si el usuario ha iniciado sesión, si no, rediríjalo a la página de inicio de sesión
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: login.php");
        exit;
    }
?>

<?php
    // Verifique la existencia del parámetro id antes de continuar con el procesamiento
    if(isset($_GET["id"]) && !empty(trim($_GET["id"])))
    {
        // Incluir archivo de configuración
        require_once "config.php";
        
        // Preparar una declaración selecta
        $sql = "SELECT * FROM incubators WHERE id = ?";
    
        if($stmt = mysqli_prepare($conection_db, $sql))
        {
            // Vincular variables a la declaración preparada como parámetros
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Establecer parámetros
            $param_id = trim($_GET["id"]);
            
            // Intento de ejecutar la declaración preparada
            if(mysqli_stmt_execute($stmt))
            {
                $result = mysqli_stmt_get_result($stmt);
        
                if(mysqli_num_rows($result) == 1)
                {
                    /* Obtiene la fila de resultados como una matriz asociativa. Dado que el conjunto de resultados contiene solo una fila, no necesitamos usar while loop */
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
                    // La URL no contiene un parámetro de identificación válido. Redirigir a la página de error
                    header("location: error.php");
                    exit();
                }
            }
            else
            {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Cerrar declaración
        mysqli_stmt_close($stmt);
        
        // Cerrar conexión_db
        mysqli_close($conection_db);
    }
    else
    {
        print_r($sql);
        exit();
        // La URL no contiene el parámetro de identificación. Redirigir a la página de error
        header("location: error.php");
        exit();
    }
?>



<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Admin Dashboard</title>
<script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    
    <!-- Flot -->
    <script src="js/plugins/flot/jquery.flot.js"></script>
    <script src="js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="js/plugins/flot/jquery.flot.pie.js"></script>
    <script src="js/plugins/flot/jquery.flot.time.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

    <!-- Flot demo data -->
    <script src="js/demo/flot-demo.js"></script>

</body>

</html>

<!-- style css php -->
<?php include_once 'css_style/style.php';?>
<!-- add style css -->
<!-- end style css php -->
	<body>
		<div id="wrapper">
            <!-- nav -->
            <?php include_once 'sidebar/nav_form.php';?>
			<!-- end nav -->
			<div id="page-wrapper" class="gray-bg dashbard-1">
                <!-- navbar -->
                <?php include_once 'sidebar/navbar.php';?>
                <!-- end navbar -->
				<div class="wrapper wrapper-content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="page-header">
                                    <h1>View Record</h1>
                                    <hr>
                                </div>
                                <div class="form-group">
                                    <label>Nombre :<span class="font-weight-bold text text-success"> <?= $row["name"]; ?></span></label>
                                </div>
                                <div class="form-group">
                                    <label>Estado : <span class="font-weight-bold"> <?= $row["estado"]; ?></span></label>
                                </div>
                                <div class="form-group">
                                    <label>Descripcion : <span class="font-weight-bold"> <?= $row["descripcion"]; ?></span></label>
                                </div>
                                <div class="form-group">
                                    <label>Tipo Alimento : <span class="font-weight-bold"> <?= $row["tipo_alimento"]; ?></span></label>
                                </div>
                                <div class="form-group">
                                    <label>Fecha de inicio : <span class="font-weight-bold"> <?= $row["fecha_inicio"]; ?></span></label>
                                </div>
                                <div class="form-group">
                                    <label>Total de siembra (millares) : <span class="font-weight-bold text-info"> <?= $row["total_siembra"]; ?></span></label>
                                </div>
                                <div class="row">
						<div class="col-lg-12">
							<div class="ibox ">
								<div class="ibox-title">
									<h5>Reporte Semanal</h5>
									<div class="float-right">
										<div class="btn-group">
											<button type="button" class="btn btn-xs btn-white active">Today</button>
											<button type="button" class="btn btn-xs btn-white">Monthly</button>
											<button type="button" class="btn btn-xs btn-white">Annual</button>
										</div>
									</div>
								</div>
								<div class="ibox-content">
									<div class="row">
										<div class="col-lg-9">
											<div class="flot-chart">
												<div class="flot-chart-content" id="flot-dashboard-chart"></div>
											</div>
										</div>
										<div class="col-lg-3">
											<ul class="stat-list">
												<li>
													<h2 class="no-margins">2,346</h2> <small>Total orders in period</small>
													<div class="stat-percent">48% <i class="fa fa-level-up text-navy"></i></div>
													<div class="progress progress-mini">
														<div style="width: 48%;" class="progress-bar"></div>
													</div>
												</li>
												<li>
													<h2 class="no-margins ">4,422</h2> <small>Orders in last month</small>
													<div class="stat-percent">60% <i class="fa fa-level-down text-navy"></i></div>
													<div class="progress progress-mini">
														<div style="width: 60%;" class="progress-bar"></div>
													</div>
												</li>
												<li>
													<h2 class="no-margins ">9,180</h2> <small>Monthly income from orders</small>
													<div class="stat-percent">22% <i class="fa fa-bolt text-navy"></i></div>
													<div class="progress progress-mini">
														<div style="width: 22%;" class="progress-bar"></div>
													</div>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
                    
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
            <?php include_once 'script/js.php';?>
		</div>
	</body>
</html>

