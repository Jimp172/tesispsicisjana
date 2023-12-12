<?php
// Tu código de conexión a la base de datos y consulta SQL aquí
include('db_config.php');

$sql = "SELECT * FROM sensor_data ORDER BY timestamp DESC LIMIT 10";
$result = $conn->query($sql);

$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = array(
        'id' => $row['id'],
        'timestamp' => $row['timestamp'],
        'ph_value' => $row['ph_value'],
        'temperature' => $row['temperature']
    );
}

?>

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
            <?php foreach ($data as $row) : ?>
                <tr>
                    <th scope="row"><?php echo $row['id'] ?></th>
                    <td><?php echo $row['timestamp'] ?></td>
                    <td><?php echo $row['ph_value'] ?></td>
                    <td><?php echo $row['temperature'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
