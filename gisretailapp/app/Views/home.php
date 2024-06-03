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
            <div class="card">
            <div class="card-body p-4">
                <div class="row row-cards">
                    <div class="col-lg-4 col-sm-12 form-group mb-3">
                        <label class="form-label">Kecamatan</label>
                        <select class="form-select" placeholder="Pilih Kecamatan..." id="kecamatan">
                            <option label="Semua Kecamatan" value=""></option>
                            <?php foreach($kecamatan as $kec) :?>
                            <option label="<?php echo $kec['kecamatan']?>" value="<?php echo $kec['id_kec']?>">
                                <?php echo $kec['kecamatan']?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
            </div>
        </div> 
            <div id="map" style="height: 450px; z-index: 1;"></div>
            <script>
                // new TomSelect("#kecamatan",{
                //     sortField: {
                //         field: "text",
                //         direction: "asc"
                //     }
                // });
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
                // Arrays to store markers and polylines
                var retailMarkers = [];
                
                // Calculate distance between two latlng points in meters
                function calculateDistance(latlng1, latlng2) {
                    return latlng1.distanceTo(latlng2);
                }
                
                
                function showallretail() {
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
                                        markerColor: 'orange-dark',
                                        shape: 'circle',
                                        prefix: 'fa-solid'
                                    });
                                } else if (markerData.id_pemegang === '2rc3egncf713') {
                                    customMarkerIcon = L.ExtraMarkers.icon({
                                        icon: 'fa-store',
                                        markerColor: 'blue',
                                        shape: 'circle',
                                        prefix: 'fa-solid'
                                    });
                                } else {
                                    customMarkerIcon = L.ExtraMarkers.icon({
                                        icon: 'fa-store',
                                        markerColor: 'orange',
                                        shape: 'circle',
                                        prefix: 'fa-solid'
                                    });
                                }

                                if (markerData.status === 'Belum Berizin') {
                                    customMarkerIcon = L.ExtraMarkers.icon({
                                        icon: 'fa-store',
                                        markerColor: 'black',
                                        shape: 'circle',
                                        prefix: 'fa-solid'
                                    });
                                }

                                var marker = L.marker([markerData.latitude, markerData.longitude], { icon: customMarkerIcon })
                                    .addTo(map)
                                    .bindPopup('<b>' + markerData.nama_retail + '</b></br>' + markerData.alamat);

                                retailMarkers.push(marker); // Add marker to the array

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
                                            iconSize: [30, 42],
                                            iconAnchor: [15, 42],
                                            popupAnchor: [0, -45]
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
                }

                showallretail();

                // Function to fetch and display retail data based on Kecamatan
                function fetchRetailData(id_kec) {
                    $.ajax({
                        url: '/retaildatafilter',
                        type: 'POST',
                        data: { id_kec: id_kec },
                        dataType: 'json',
                        success: function(data) {
                            var markersData = data.retaildatakec;

                            // Clear existing markers
                            retailMarkers.forEach(function(marker) {
                                map.removeLayer(marker);
                            });
                            retailMarkers = []; // Reset the array

                            // Clear existing polylines and distance markers
                            polylines.forEach(function(polyline) {
                                map.removeLayer(polyline);
                            });
                            distanceMarkers.forEach(function(marker) {
                                map.removeLayer(marker);
                            });
                            polylines = [];
                            distanceMarkers = [];

                            // Iterate through each new marker data
                            markersData.forEach(function(markerData, index) {
                                var customMarkerIcon;
                                if (markerData.id_pemegang === '2rc3egncf746') {
                                    customMarkerIcon = L.ExtraMarkers.icon({
                                        icon: 'fa-store',
                                        markerColor: 'orange-dark',
                                        shape: 'circle',
                                        prefix: 'fa-solid'
                                    });
                                } else if (markerData.id_pemegang === '2rc3egncf713') {
                                    customMarkerIcon = L.ExtraMarkers.icon({
                                        icon: 'fa-store',
                                        markerColor: 'blue',
                                        shape: 'circle',
                                        prefix: 'fa-solid'
                                    });
                                } else {
                                    customMarkerIcon = L.ExtraMarkers.icon({
                                        icon: 'fa-store',
                                        markerColor: 'orange',
                                        shape: 'circle',
                                        prefix: 'fa-solid'
                                    });
                                }

                                if (markerData.status === 'Belum Berizin') {
                                    customMarkerIcon = L.ExtraMarkers.icon({
                                        icon: 'fa-store',
                                        markerColor: 'black',
                                        shape: 'circle',
                                        prefix: 'fa-solid'
                                    });
                                }

                                var marker = L.marker([markerData.latitude, markerData.longitude], { icon: customMarkerIcon })
                                    .addTo(map)
                                    .bindPopup('<b>' + markerData.nama_retail + '</b></br>' + markerData.alamat);

                                retailMarkers.push(marker); // Add marker to the array

                                markersData.slice(index + 1).forEach(function(otherMarkerData) {
                                    var markerLatLng = marker.getLatLng();
                                    var otherMarkerLatLng = L.latLng([otherMarkerData.latitude, otherMarkerData.longitude]);
                                    var distance = calculateDistance(markerLatLng, otherMarkerLatLng);

                                    if (distance < 300) {
                                        var midPoint = L.latLngBounds([markerLatLng, otherMarkerLatLng]).getCenter();
                                        var customIcon = L.divIcon({
                                            className: 'custom-marker',
                                            html: '<div class="col-lg-12 marker-label" style="color: red; font-size: 0.65rem;"><b>' + Math.round(distance) + ' m</b></div>',
                                            iconSize: [30, 42],
                                            iconAnchor: [15, 42],
                                            popupAnchor: [0, -45]
                                        });

                                        var distanceMarker = L.marker(midPoint, { icon: customIcon });
                                        var polyline = L.polyline([markerLatLng, otherMarkerLatLng], { color: '#2A3547' });

                                        polylines.push(polyline);
                                        distanceMarkers.push(distanceMarker);
                                    }
                                });
                            });
                        }
                    });
                }

                document.getElementById('kecamatan').addEventListener('change', function() {
                    if (!this.value) {
                        showallretail();
                    } else {
                        var id_kec = this.value;
                        fetchRetailData(id_kec);
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
