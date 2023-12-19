<?php
// Tu código de conexión a la base de datos y consulta SQL aquí
include('db_config.php');

$sql = "SELECT * FROM sensor_data ORDER BY timestamp DESC LIMIT 1";
$result = $conn->query($sql);

$latestData = array();
if ($result->num_rows > 0) {
    $latestData = $result->fetch_assoc();
}
?>

<div id="latestDataContainer">
    <h1>Latest Data</h1>
    <p>ID: <?php echo $latestData['id']; ?></p>
    <p>Timestamp: <?php echo $latestData['timestamp']; ?></p>
    <p>Ph Value: <?php echo $latestData['ph_value']; ?></p>
    <p>Temperature: <?php echo $latestData['temperature']; ?></p>
</div>
