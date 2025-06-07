<script>
    document.addEventListener("DOMContentLoaded", function () {
        const map = L.map('map').setView([37.95, -1.09], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        const trackUrl = "{{ asset($post->track) }}";

        omnivore.kml(trackUrl)
            .on('ready', function () {
                map.fitBounds(this.getBounds());
            })
            .addTo(map)
            .on('error', function (e) {
                console.error('Error cargando el KML: ', e);
            });
    });
</script>
