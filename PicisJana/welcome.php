<?php
// Inicializa la sesión
session_start();

// Verifica si el usuario ha iniciado sesión, si no, redirígelo a la página de inicio de sesión
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
include('db_config.php');
?>

<!DOCTYPE html>
	<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Admin Dashboard</title>
        <script src="script2.js"></script>
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
        <div class="ibox">
            <div class="ibox-title">
                <h5>Notificaciones</h5>
                <div  class="ibox-tools">
                    <a class="collapse-link"> <i class="fa fa-chevron-up"></i> </a>
                    <a class="close-link"> <i class="fa fa-times"></i> </a>
                </div>
            </div>
            <div id="notificationsContainer" class="ibox-content">
            <?php
            $sql = "SELECT * FROM sensor_data ORDER BY timestamp DESC LIMIT 3";
            $result = $conn->query($sql);

            // Verificar si la consulta se ejecutó correctamente
            if ($result === false) {
                echo "Error en la consulta: " . $conn->error;
            } else {
                while ($row = $result->fetch_assoc()) {
                    // Verificar si el valor de ph_value es mayor a 5.00
                    if ($row['ph_value'] > 4.94) {
                        // Aquí puedes agregar lógica para enviar una notificación
                        
                    }
                }
            }
            include('notifications.php');
            ?>
            </div>
        </div>
    </div>
	<div>
    <div id="latestDataContainer">
        <?php include('latest_data.php'); ?>
    </div>
</div>
    </div>
</div>

<div class="row">
	<div class="col-lg-8">
		<div class="ibox ">
			<div class="ibox-title">
            <div>
        <canvas id="myChart"></canvas>
    </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            
            const ctx = document.getElementById('myChart');

            // Obtén los datos desde PHP
            function updateChart() {
					// Obtén los datos desde PHP
					const xhr = new XMLHttpRequest();
					xhr.onreadystatechange = function () {
						if (this.readyState == 4 && this.status == 200) {
							const responseData = JSON.parse(this.responseText);

							new Chart(ctx, {
								type: 'bar',
								data: {
									labels: responseData.labels,
									datasets: [{
										label: 'pH Value',
										data: responseData.dataPoints,
										backgroundColor: 'rgba(120, 300, 100, 100)',
										borderColor: 'rgba(120, 300, 100, 100)',
										borderWidth: 3
									}]
								},
								options: {
                                    events: [],
									scales: {
										y: {
											beginAtZero: true,
											suggestedMin: 4.80,
											suggestedMax: 1.00
										}
									}
								}
							});
						}
					};
					xhr.open("GET", "chart_data.php", true);
					xhr.send();
				}
				updateChart();

				// Configura la actualización automática cada 5 minutos (ajusta según tus necesidades)
				setInterval(updateChart, 3000); // 30
        </script>
				</div>
			</div>
			<div class="ibox-content">
					<div class="row">
					<div class="col-lg-11">
						<div class="">
							<div class="flot-chart-content" id="flot-dashboard-chart"></div>
					<div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-10">
		<div class="row">
		<div class="col-lg-8">
    <div class="ibox">
        <div class="ibox-title">
            <h5>Detalles incubadora</h5>
            <div class="ibox-tools">
                <a class="collapse-link"> <i class="fa fa-chevron-up"></i> </a>
                <a class="close-link"> <i class="fa fa-times"></i> </a>
            </div>
        </div>
        <div id="data" class="ibox-content table-responsive">
            <table class="table table-hover no-margins">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Fecha</th>
                        <th>Valor Ph</th>
                        <th>Temperatura</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
					$sql = "SELECT * FROM sensor_data ORDER BY timestamp DESC LIMIT 10";
					$result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                    ?>
                        <tr>
                            <th scope="row"><?php echo $row['id'] ?></th>
                            <td><?php echo $row['timestamp'] ?></td>
                            <td><?php echo $row['ph_value'] ?></td>
                            <td><?php echo $row['temperature'] ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>




<!--<div class="col-lg-3">
        <div class="ibox">
            <div class="ibox-title">
                <h5>Notificaciones</h5>
                <div class="ibox-tools">
                    <a class="collapse-link"> <i class="fa fa-chevron-up"></i> </a>
                    <a class="close-link"> <i class="fa fa-times"></i> </a>
                </div>
            </div>
            <div class="ibox-content">
            <?php
/*            $sql = "SELECT * FROM sensor_data ORDER BY timestamp DESC LIMIT 10";
            $result = $conn->query($sql);

            // Verificar si la consulta se ejecutó correctamente
            if ($result === false) {
                echo "Error en la consulta: " . $conn->error;
            } else {
                while ($row = $result->fetch_assoc()) {
                    // Verificar si el valor de ph_value es mayor a 5.00
                    if ($row['ph_value'] > 4.94) {
                        // Aquí puedes agregar lógica para enviar una notificación
                        
                    }
                }
            }
            include('notifications.php');*/
            ?>
            </div>
        </div>
    </div> -->
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