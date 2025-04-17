<div id="map" style="height: 500px;"></div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var map = L.map('map').setView([0, 0], 2);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        var clients = @json($clients);

        clients.forEach(function (client) {
            if (client.latitude && client.longitude) {
                L.marker([client.latitude, client.longitude]).addTo(map)
                    .bindPopup(client.name);
            }
        });
    });
</script> 