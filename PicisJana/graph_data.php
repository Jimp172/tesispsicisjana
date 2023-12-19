<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu Página de Bienvenida</title>
    <!-- Agrega aquí tus enlaces a las bibliotecas y estilos necesarios -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Grafico de pH</h5>
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
                                <canvas id="flot-dashboard-chart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Llamada a la función para inicializar los gráficos con los datos actuales
        updateCharts();

        // Función para inicializar y actualizar los gráficos
        function updateCharts() {
            // Obtiene los datos desde graph_data.php
            fetch('graph_data.php')
                .then(response => response.json())
                .then(graphData => {
                    const timestamps = graphData.map(entry => entry.timestamp);
                    const phValues = graphData.map(entry => entry.ph_value);

                    // Obtiene el contexto del lienzo del gráfico
                    const ctx = document.getElementById('flot-dashboard-chart').getContext('2d');

                    // Inicializa el gráfico de línea
                    new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: timestamps,
                            datasets: [{
                                label: 'Valor de pH',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                data: phValues,
                                fill: false
                            }]
                        },
                        options: {
                            scales: {
                                x: {
                                    type: 'linear',
                                    position: 'bottom'
                                }
                            }
                        }
                    });
                })
                .catch(error => console.error('Error al obtener datos:', error));
        }
    </script>
</body>

</html>
