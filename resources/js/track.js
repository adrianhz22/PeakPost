export default function initKmlPreview(inputId = 'track', mapInstance = null) {
    const input = document.getElementById(inputId);
    if (!input || typeof L === 'undefined' || !mapInstance) return;

    input.addEventListener('change', function (event) {
        const file = event.target.files[0];
        if (file && file.name.endsWith('.kml')) {
            const reader = new FileReader();
            reader.onload = function (e) {
                const kmlLayer = new L.KML(e.target.result);
                mapInstance.addLayer(kmlLayer);
                mapInstance.fitBounds(kmlLayer.getBounds());
            };
            reader.readAsText(file);
        }
    });
}
