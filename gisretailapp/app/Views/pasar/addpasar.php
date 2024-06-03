<?= $this->include('/layout/head')?>
<?= $this->include('/layout/menu')?>
<?= $this->include('/layout/header_menu')?>
<div class="container-fluid">
<div class="card">
    <div class="card-body">
        <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
            <div class="mb-3 mb-sm-0">
                <h5 class="card-title fw-semibold mb-4">Tambah data Pasar</h5>
                </div>
                <div>
                <a href="/" target="_blank" class="btn btn-primary fs-2 fw-semibold lh-sm">Reset Form</a>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 row" id="form-pasar" class="validator-add-pasar">
                        <form id="form-pasar" class="validator-add-pasar">
                        <div class="col-lg-12 form-group mb-3">
                            <label class="form-label">Nama Pasar</label>
                            <input type="text" class="form-control py-2" id="namapasar" placeholder="Nama Pasar"
                                autocomplete="off" required>
                        </div>
                        <div class="col-lg-12 form-group mb-3">
                            <label class="form-label">Latitude</label>
                            <input type="text" class="form-control py-2"  id="lat" name="lat" placeholder="Latitude"
                                autocomplete="off" required>
                        </div>
                        <div class="col-lg-12 form-group mb-3">
                            <label class="form-label">Longitude</label>
                            <input type="text" class="form-control py-2"  id="long" name="long" placeholder="Longitude"
                                autocomplete="off" required>
                        </div>
                        <div class="col-lg-12 form-group mb-3">
                            <label class="form-label">Radius jarak pasar dengan toko swalayan</label>
                            <input type="text" class="form-control py-2"  id="rad" name="rad" placeholder="Radius"
                                autocomplete="off" pattern="[0-9]+" data-v-message="Inputkan angka" required>
                        </div>
                    </form>
                    <div class="col-lg-12 form-group mb-3">
                    <input type="submit" value="Simpan" id="btn-send" class="btn btn-primary w-100 mt-0">
                    </div>
                    </div>
                    <div class="col-lg-6">
                        <div id="map" style="height: 600px; z-index: 1;"></div>
                        <script>
                            var map = L.map('map').setView([-3.79891511014139, 114.74845545561246], 13);
                            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                            }).addTo(map);
                            var marker;
                            var marketcustom = L.ExtraMarkers.icon({
                                icon: 'fa-star',
                                // number: index + 1,
                                markerColor: 'green',
                                shape: 'circle',
                                prefix: 'fa-solid'
                            });
                            map.on('click', function(e) {
                                if (marker) {
                                    map.removeLayer(marker);
                                }
                                marker = L.marker(e.latlng, {icon : marketcustom}).addTo(map);
                                document.getElementById('lat').value = e.latlng.lat;
                                document.getElementById('long').value = e.latlng.lng; 
                            });
                        </script>
                    </div>
                </div>
            </div>
            </div>
        </div>  
    </div>
</div>
<?= $this->include('/layout/footer')?>
<?= $this->include('/pasar/script/saddpasar')?>


