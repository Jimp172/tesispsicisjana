<!-- Contenido de notifications.php sin etiquetas html, head o body -->
<ul class="todo-list m-t small-list">
    <?php
    $sql = "SELECT * FROM sensor_data ORDER BY timestamp DESC LIMIT 10";
    $result = $conn->query($sql);

    // Verificar si la consulta se ejecutó correctamente
    if ($result === false) {
        echo "Error en la consulta: " . $conn->error;
    } else {
        while ($row = $result->fetch_assoc()) {
            // Verificar si el valor de ph_value es mayor a 5.00
            if ($row['ph_value'] > 4.94) {
                // Aquí puedes agregar lógica para enviar una notificación
                echo '<li><a href="#" class="check-link"><i class="fa fa-square-o"></i></a>';
                echo '<span class="m-l-xs">Valor de pH en Incubadora1 es mayor a 4.94: ' . $row['ph_value'] . '</span></li>';
            }
        }
    }
    ?>
</ul>
