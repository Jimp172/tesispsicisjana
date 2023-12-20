<?php
// Tu código de conexión a la base de datos y consulta SQL aquí
include('db_config.php');

$sql = "SELECT * FROM sensor_data ORDER BY timestamp DESC LIMIT 1";
$result = $conn->query($sql);

$latestData = array();
if ($result->num_rows > 0) {
    $latestData = $result->fetch_assoc();

    // Función para obtener la clase de color según las condiciones
    function getColorClass($value, $upperThreshold, $lowerThreshold) {
        if ($value > $upperThreshold) {
            return 'text-danger'; // Rojo
        } elseif ($value < $lowerThreshold) {
            return 'text-warning'; // Anaranjado
        } else {
            return ''; // Sin clase adicional
        }
    }

    // Obtener clases de color según las condiciones
    $phColorClass = getColorClass($latestData['ph_value'], 5, 5);
    $temperatureColorClass = getColorClass($latestData['temperature'], 25, 25);
    $voltageColorClass = getColorClass($latestData['voltage'], 1854.64, 1854.64);

    // Mostrar los últimos datos
    echo '<div class="row">';
    
    // Mostrar el valor de pH
    echo '<div class="col-lg-4">
            <div class="ibox ">
                <div class="ibox-title"> <span class="label label-success float-right">Mensual</span>
                    <h5>Valor pH</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins ' . $phColorClass . '">' . $latestData['ph_value'] . '</h1>
                    <div class="stat-percent font-bold ' . $phColorClass . '">98% <i class="fa fa-bolt"></i></div> <small></small> 
                </div>
            </div>
        </div>';
    
    // Mostrar el valor de temperatura
    echo '<div class="col-lg-4">
            <div class="ibox ">
                <div class="ibox-title"> <span class="label label-info float-right">Anual</span>
                    <h5>Valor Temperatura</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins ' . $temperatureColorClass . '">' . $latestData['temperature'] . '</h1>
                    <div class="stat-percent font-bold ' . $temperatureColorClass . '">20% <i class="fa fa-level-up"></i></div> <small></small> 
                </div>
            </div>
        </div>';
    
    // Mostrar el valor de voltaje
    echo '<div class="col-lg-4">
            <div class="ibox ">
                <div class="ibox-title"> <span class="label label-danger float-right">Low value</span>
                    <h5>Voltaje</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins ' . $voltageColorClass . '">' . $latestData['voltage'] . '</h1>
                    <div class="stat-percent font-bold ' . $voltageColorClass . '">38% <i class="fa fa-level-down"></i></div> <small></small> 
                </div>
            </div>
        </div>';

    echo '</div>'; // Cerrar la fila
} else {
    echo '<p>No hay datos disponibles</p>';
}
?>
