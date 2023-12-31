setInterval(function () {
    // Hacer solicitud para data.php
    fetch("data.php")
        .then(response => response.text())
        .then(data => {
            document.getElementById("data").innerHTML = data;
        })
        .catch(error => console.error('Error:', error));

    // Hacer solicitud para latest_data.php
    fetch("latest_data.php")
        .then(response => response.text())
        .then(data => {
            document.getElementById("latestDataContainer").innerHTML = data;
        })
        .catch(error => console.error('Error:', error));

    // Hacer solicitud para notifications.php
    fetch("notifications.php")
        .then(response => response.text())
        .then(data => {
            document.getElementById("notificationsContainer").innerHTML = data;
        })
        .catch(error => console.error('Error:', error));
}, 1000);
