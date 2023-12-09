<?php
// Inicializa la sesión
session_start();
 
// Verifique si el usuario ha iniciado sesión, si no, rediríjalo a la página de inicio de sesión
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
		<!-- end style css php -->
	<body>
		<div id="wrapper">
            <!-- nav -->
            <?php include_once 'sidebar/nav_dashboard.php';?>
			<!-- end nav -->
			<div id="page-wrapper" class="gray-bg dashbard-1">
                <!-- navbar -->
                <?php include_once 'sidebar/navbar.php';?>
                <!-- end navbar -->
				<div class="wrapper wrapper-content">
					<div class="row">
						<div class="col-lg-3">
							<div class="ibox ">
								<div class="ibox-title"> <span class="label label-success float-right">Mensual</span>
									<h5>Alevinos Año</h5> </div>
								<div class="ibox-content">
									<h1 class="no-margins">40 886,200</h1>
									<div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div> <small></small> </div>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="ibox ">
								<div class="ibox-title"> <span class="label label-info float-right">Annual</span>
									<h5>Alevinos mes</h5> </div>
								<div class="ibox-content">
									<h1 class="no-margins">275,800</h1>
									<div class="stat-percent font-bold text-info">20% <i class="fa fa-level-up"></i></div> <small></small> </div>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="ibox ">
								<div class="ibox-title"> <span class="label label-primary float-right">Today</span>
									<h5>Alevinos hoy</h5> </div>
								<div class="ibox-content">
									<h1 class="no-margins">106,120</h1>
									<div class="stat-percent font-bold text-navy">44% <i class="fa fa-level-up"></i></div> <small></small> </div>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="ibox ">
								<div class="ibox-title"> <span class="label label-danger float-right">Low value</span>
									<h5>Parametros</h5> </div>
								<div class="ibox-content">
									<h1 class="no-margins">80,600</h1>
									<div class="stat-percent font-bold text-danger">38% <i class="fa fa-level-down"></i></div> <small></small> </div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="ibox ">
								<div class="ibox-title">
									<h5>Reporte Semanal</h5>
									<div class="float-right">
										<div class="btn-group">
											<button type="button" class="btn btn-xs btn-white active">Hoy</button>
											<button type="button" class="btn btn-xs btn-white">Mensual</button>
											<button type="button" class="btn btn-xs btn-white">Anual</button>
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
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-8">
							<div class="row">
								<div class="col-lg-6">
									<div class="ibox ">
										<div class="ibox-title">
											<h5>Detalles incubadora</h5>
											<div class="ibox-tools">
												<a class="collapse-link"> <i class="fa fa-chevron-up"></i> </a>
												<a class="close-link"> <i class="fa fa-times"></i> </a>
											</div>
										</div>
										<div class="ibox-content table-responsive">
											<table class="table table-hover no-margins">
												<thead>
													<tr>
														<th>Estado</th>
														<th>Fecha</th>
														<th>Usuario</th>
														<th>Valor</th>
													</tr>
												</thead>
											</table>
										</div>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="ibox ">
										<div class="ibox-title">
											<h5>Notificaciones</h5>
											<div class="ibox-tools">
												<a class="collapse-link"> <i class="fa fa-chevron-up"></i> </a>
												<a class="close-link"> <i class="fa fa-times"></i> </a>
											</div>
										</div>
										<div class="ibox-content">
											<ul class="todo-list m-t small-list">
												<li> <a href="#" class="check-link"><i class="fa fa-check-square"></i> </a> <span class="m-l-xs todo-completed">Revisar Temperatura en Incubadora1: La Temperatura es de 17 C, fuera del rango</span> </li>
												<li> <a href="#" class="check-link"><i class="fa fa-square-o"></i> </a> <span class="m-l-xs">Revisar PH en Incubadora1: El PH es de 9, fuera del rango</span> </li>
												<li> <a href="#" class="check-link"><i class="fa fa-square-o"></i> </a> <span class="m-l-xs">Revisar Temperatura en Incubadora2: La Temperatura es de 9,7 C, fuera del rango</span> <small class="label label-primary"><i class="fa fa-clock-o"></i> 1 mins</small> </li>
												<li> <a href="#" class="check-link"><i class="fa fa-square-o"></i> </a> <span class="m-l-xs">Revisar Temperatura en Incubadora1: La Temperatura es de 17 C, fuera del rango</span> </li>
												<li> <a href="#" class="check-link"><i class="fa fa-check-square"></i> </a> <span class="m-l-xs todo-completed">Revisar PH en Incubadora1: El PH es de 9, fuera del rango</span> </li>
											</ul>
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
		</div>
        <!-- <script> js php import</script> -->
        <?php include_once 'script/js.php';?>
		<!-- <script> import</script> -->
	</body>
</html>