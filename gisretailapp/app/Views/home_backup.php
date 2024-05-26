<?= $this->include('/layout/head')?>
<?= $this->include('/layout/menu')?>
<?= $this->include('/layout/header_menu')?>
<div class="container-fluid">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Titik Lokasi Retail</h5>
            <div id="map" style="height: 450px; z-index: 1;"></div>
            <script>
                var map = L.map('map').setView([-3.79891511014139, 114.74845545561246], 13);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);

                var market = L.marker([-3.803082642100828, 114.76865359992058]).addTo(map);
                market.bindPopup("<b>Pasar 'Tapandang Berseri' Pelaihari</b>");

                // var markers = L.markerClusterGroup();

                <?php foreach ($retaildata as $retail): ?>
                  var marker = L.marker([<?= $retail->latitude ?>, <?= $retail->longitude ?>]);
                               marker.bindPopup("<b><?= $retail->nama_retail ?></b><br><?= $retail->alamat ?>");
                  map.addLayer(marker);

                      // markers.addLayer(marker);
                  <?php endforeach; ?>

                  // map.addLayer(markers);


                // Calculate distance between two latlng points in meters
                function calculateDistance(latlng1, latlng2) {
                    return latlng1.distanceTo(latlng2);
                }

                // Iterate through each marker in the MarkerClusterGroup
                markers.eachLayer(function(marker) {
                    // Get the current marker's position
                    var markerLatLng = marker.getLatLng();
                    
                    // Iterate through each marker in the MarkerClusterGroup again to compare distances
                    markers.eachLayer(function(otherMarker) {
                        if (otherMarker !== marker) { // Ensure we're not comparing the same marker
                            // Get the other marker's position
                            var otherMarkerLatLng = otherMarker.getLatLng();
                            
                            // Calculate distance between the current marker and the other marker
                            var distance = calculateDistance(markerLatLng, otherMarkerLatLng);
                            
                            // Create a custom marker icon with label showing the distance
                            var customIcon = L.divIcon({
                              className: 'custom-marker',
                              html: '<div class="marker-label" style="color: red;"><b>' + Math.round(distance) + ' m</b></div>',
                              iconSize: [30, 42], // Customize the icon size
                              iconAnchor: [15, 42], // Customize the icon anchor
                              popupAnchor: [0, -45] // Customize the popup anchor
                            });
                            
                            // Create a marker with the custom icon at the midpoint between the two markers
                            var midPoint = L.latLngBounds([markerLatLng, otherMarkerLatLng]).getCenter();
                            if (distance < 300) {
                              var distanceMarker = L.marker(midPoint, { icon: customIcon }).addTo(map);
                              // Draw a polyline between the two markers
                              var polyline = L.polyline([markerLatLng, otherMarkerLatLng], { color: '#E94646' }).addTo(map);
                            }
                        }
                    });
                });
            </script>
          </div>
        </div>
      </div>
<?= $this->include('/layout/footer')?>
