<?php
include('db_config.php');

$sql = "SELECT * FROM sensor_data ORDER BY timestamp DESC LIMIT 15";
$result = $conn->query($sql);

$labels = array();
$dataPoints = array();

while ($row = $result->fetch_assoc()) {
    $labels[] = $row['timestamp'];
    $dataPoints[] = $row['ph_value'];
}

$chartData = array(
    'labels' => $labels,
    'dataPoints' => $dataPoints
);

echo json_encode($chartData);
?>


