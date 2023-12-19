<?php
include('db_config.php');

// Verificar si la conexión a la base de datos se ha establecido correctamente
if ($conn === false) {
    echo "Error en la conexión a la base de datos";
} else {
    $sql = "SELECT * FROM sensor_data ORDER BY timestamp DESC LIMIT 5";
    $result = $conn->query($sql);

    // Verificar si la consulta se ejecutó correctamente
    if ($result === false) {
        echo "Error en la consulta: " . $conn->error;
    } else {
        while ($row = $result->fetch_assoc()) {
            // Verificar si el valor de ph_value es menor a 6.55
            if ($row['ph_value'] < 6.55) {
                // Imprimir la notificación directamente
                echo '<li><a href="#" class="check-link"><i class="fa fa-square-o"></i></a>';
                echo '<span class="m-l-xs">Valor de pH en Incubadora1 es menor a 6.55: ' . $row['ph_value'] . '</span></li>';
            }
        }
    }
}
?>
