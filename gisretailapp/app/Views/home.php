<?= $this->include('/layout/head')?>
<?= $this->include('/layout/menu')?>
<?= $this->include('/layout/header_menu')?>
<div class="container-fluid">
        <div class="card">
          <div class="card-body">
            <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                <div class="mb-3 mb-sm-0">
                    <h5 class="card-title fw-semibold mb-4">Titik Lokasi Retail</h5>
                    </div>
                    <div>
                    <div class="mb3">
                    <label class="form-switch"><input type="checkbox" id="distance"><i></i>Jarak Retail</label>
                        <label class="form-switch"><input type="checkbox" id="market"><i></i>Pasar Rakyat</label>
                    </div>
                </div>
            </div> 
            <div id="map" style="height: 450px; z-index: 1;"></div>
            
            <!-- <button id="toggleButton">Toggle Polylines and Distance Markers</button> -->
            <script>
                var map = L.map('map').setView([-3.79891511014139, 114.74845545561246], 13);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);

                var marketloc = [];
                var marketradius = [];
                $.ajax({
                    url: '/pasarmap',
                    dataType: 'json',
                    success: function(data) {
                        var marketsData = data.pasardata;

                        marketsData.forEach(function(marketData, index) {
                            var marketcustom = L.ExtraMarkers.icon({
                                icon: 'fa-star',
                                // number: index + 1,
                                markerColor: 'green',
                                shape: 'circle',
                                prefix: 'fa-solid'
                            });
                        var market = L.marker([marketData.lat, marketData.lng], {icon : marketcustom})
                        .bindPopup('<b>'+marketData.nama_pasar+'</b>');
                        var marketCircle = L.circle([marketData.lat, marketData.lng], {radius: marketData.radius});
                        
                        marketloc.push(market);
                        marketradius.push(marketCircle);

                        });
                    }
                });
                
                
                // Function to hide the marker and circle
                function hideMarker() {
                    marketloc.forEach(function(market) {
                        map.removeLayer(market);
                    });
                    marketradius.forEach(function(radius) {
                        map.removeLayer(radius);
                    });
                }

                // Function to show the marker and circle
                function showMarker() {
                    marketloc.forEach(function(market) {
                        market.addTo(map);
                    });
                    marketradius.forEach(function(radius) {
                        radius.addTo(map);
                    });
                }

                document.getElementById('market').addEventListener('change', function() {
                    if (this.checked) {
                        showMarker();
                    } else {
                        hideMarker();
                    }
                });

                // Create a MarkerClusterGroup
                // var markers = L.markerClusterGroup();
                var polylines = [];
                var distanceMarkers = [];
                
                // Calculate distance between two latlng points in meters
                function calculateDistance(latlng1, latlng2) {
                    return latlng1.distanceTo(latlng2);
                }
                // AJAX request to fetch marker data
                $.ajax({
                    url: '/retailmap',
                    dataType: 'json',
                    success: function(data) {
                        var markersData = data.retaildata; // Assuming 'retaildata' contains an array of marker data

                        // Iterate through each marker data
                        markersData.forEach(function(markerData, index) {
                            // Create marker
                            var customMarkerIcon;
                            if (markerData.id_pemegang === '2rc3egncf746') {
                                customMarkerIcon = L.ExtraMarkers.icon({
                                    icon: 'fa-store',
                                    // number: index + 1,
                                    markerColor: 'orange-dark',
                                    shape: 'circle',
                                    prefix: 'fa-solid'
                                });
                            } else if (markerData.id_pemegang === '2rc3egncf713') {
                                customMarkerIcon = L.ExtraMarkers.icon({
                                    icon: 'fa-store',
                                    // number: index + 1,
                                    markerColor: 'blue',
                                    shape: 'circle',
                                    prefix: 'fa-solid'
                                });
                            } else {
                                customMarkerIcon = L.ExtraMarkers.icon({
                                    icon: 'fa-store',
                                    // number: index + 1,
                                    markerColor: 'orange',
                                    shape: 'circle',
                                    prefix: 'fa-solid'
                                });
                            }
                            
                            var marker = L.marker([markerData.latitude, markerData.longitude], { icon: customMarkerIcon } ).addTo(map)
                            .bindPopup('<b>'+markerData.nama_retail+'</b></br>'+markerData.alamat);

                            // Add marker to MarkerClusterGroup
                            // markers.addLayer(marker);

                            // Add marker to the map
                            // map.addLayer(markers);

                            // Calculate distance between this marker and other markers
                            markersData.slice(index + 1).forEach(function(otherMarkerData) {
                                var markerLatLng = marker.getLatLng();
                                var otherMarkerLatLng = L.latLng(otherMarkerData.latitude, otherMarkerData.longitude);
                                var distance = calculateDistance(markerLatLng, otherMarkerLatLng);

                                // If distance is less than 300 meters, create a marker and polyline
                                if (distance < 300) {
                                    var midPoint = L.latLngBounds([markerLatLng, otherMarkerLatLng]).getCenter();

                                    // Create a custom marker icon with label showing the distance
                                    var customIcon = L.divIcon({
                                        className: 'custom-marker',
                                        html: '<div class="col-lg-12 marker-label" style="color: red; font-size: 0.65rem;"><b>' + Math.round(distance) + ' m</b></div>',
                                        iconSize: [30, 42], // Customize the icon size
                                        iconAnchor: [15, 42], // Customize the icon anchor
                                        popupAnchor: [0, -45] // Customize the popup anchor
                                    });

                                    // Create a marker with the custom icon at the midpoint between the two markers
                                    var distanceMarker = L.marker(midPoint, { icon: customIcon });

                                    // Draw a polyline between the two markers
                                    var polyline = L.polyline([markerLatLng, otherMarkerLatLng], { color: '#2A3547' });

                                     // Store references to the polylines and distance markers
                                     polylines.push(polyline);
                                     distanceMarkers.push(distanceMarker);
                                }
                            });
                        });
                    }
                });

                // Function to show polylines and distance markers
                function showPolylinesAndMarkers() {
                    polylines.forEach(function(polyline) {
                        polyline.addTo(map);
                    });
                    distanceMarkers.forEach(function(marker) {
                        marker.addTo(map);
                    });
                }

                // Function to hide polylines and distance markers
                function hidePolylinesAndMarkers() {
                    polylines.forEach(function(polyline) {
                        map.removeLayer(polyline);
                    });
                    distanceMarkers.forEach(function(marker) {
                        map.removeLayer(marker);
                    });
                }

                // Toggle button to show/hide polylines and distance markers
                // Checkbox to show/hide polylines and distance markers
                document.getElementById('distance').addEventListener('change', function() {
                    if (this.checked) {
                        showPolylinesAndMarkers();
                    } else {
                        hidePolylinesAndMarkers();
                    }
                });
            </script>
          </div>
        </div>
      </div>
<?= $this->include('/layout/footer')?>
