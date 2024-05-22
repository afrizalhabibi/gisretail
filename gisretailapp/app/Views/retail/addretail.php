<?= $this->include('/layout/head')?>
<?= $this->include('/layout/menu')?>
<?= $this->include('/layout/header_menu')?>
<div class="container-fluid">
<div class="card">
    <div class="card-body">
        <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
            <div class="mb-3 mb-sm-0">
                <h5 class="card-title fw-semibold mb-4">Tambah data Retail</h5>
                </div>
                <div>
                <a href="/" target="_blank" class="btn btn-primary fs-2 fw-semibold lh-sm">Reset Form</a>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 row">
                        <form role="form" id="form-retail" class="validator-add-retail" method="POST" accept-charset="utf-8">
                        <div class="col-lg-12 form-group mb-3">
                            <label class="form-label">Pemegang</label>
                            <select class="form-select" id="pemegang" required>
                                <option value>Pilih Pemegang</option>
                                <?php foreach($pemegang as $pmg) :?>
                                <option label="<?php echo $pmg['nama']?>" value="<?php echo $pmg['id_pemegang']?>">
                                    <?php echo $pmg['nama']?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="col-lg-12 form-group mb-3">
                            <label class="form-label">Nama Retail</label>
                            <input type="text" class="form-control py-2" id="namaretail" placeholder="Nama Retail"
                                autocomplete="off" required>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <div class="form-label">Status</div>
                            <div>
                                <label class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" value="Berizin"
                                        name="status" required>
                                    <span class="form-check-label">Berizin</span>
                                </label>
                                <label class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" value="Belum Berizin"
                                        name="status">
                                    <span class="form-check-label">Belum Berizin</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-12 form-group mb-3">
                            <label class="form-label">Kecamatan</label>
                            <select placeholder="Pilih Kecamatan..." id="kecamatan">
                                <?php foreach($kecamatan as $kec) :?>
                                <option label="<?php echo $kec['kecamatan']?>" value="<?php echo $kec['id_kec']?>">
                                    <?php echo $kec['kecamatan']?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="col-lg-12 form-group mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea class="form-control" id="alamat" placeholder="Alamat"
                                autocomplete="off" required></textarea>
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
                    </form>
                    <button type="submit" id="btn-send" class="btn btn-primary">Simpan</button> 
                    </div>
                    <div class="col-lg-6">
                        <div id="map" style="height: 600px; z-index: 1;"></div>
                        <script>
                            var map = L.map('map').setView([-3.79891511014139, 114.74845545561246], 13);
                            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                            }).addTo(map);
                            var marker;
                            map.on('click', function(e) {
                                if (marker) {
                                    map.removeLayer(marker);
                                }
                                marker = L.marker(e.latlng).addTo(map);
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
<?= $this->include('/retail/script/saddretail')?>


