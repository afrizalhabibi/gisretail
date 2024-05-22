<?= $this->include('/layout/head')?>
<?= $this->include('/layout/menu')?>
<?= $this->include('/layout/header_menu')?>
<div class="container-fluid">
<div class="card">
    <div class="card-body">
        <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
            <div class="mb-3 mb-sm-0">
                <h5 class="card-title fw-semibold mb-4">Update data Retail</h5>
                </div>
                <div>
                <a href="/" target="_blank" class="btn btn-primary fs-2 fw-semibold lh-sm">Reset Form</a>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 row">
                        <form role="form" id="form-editretail" class="validator-edit-retail" method="POST" accept-charset="utf-8">
                        <input type="hidden" class="form-control py-2" id="id_retail" value="<?php echo $retail['id_retail']?>">
                        <div class="col-lg-12 form-group mb-3">
                            <label class="form-label">Pemegang</label>
                            <select class="form-select" id="pemegang" required>
                                <option value>Pilih Pemegang</option>
                                <?php foreach($pemegang as $pmg) :?>
                                <option label="<?php echo $pmg['nama']?>" value="<?php echo $pmg['id_pemegang']?>" <?php if ($pmg['id_pemegang'] == $retail['id_pemegang']) echo "selected"; ?>>
                                    <?php echo $pmg['nama']?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="col-lg-12 form-group mb-3">
                            <label class="form-label">Nama Retail</label>
                            <input type="text" class="form-control py-2" id="namaretail" placeholder="Nama Retail"
                                autocomplete="off" value="<?php echo $retail['nama_retail']?>" required>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <div class="form-label">Status</div>
                            <div>
                                <label class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" value="Berizin"
                                        name="status" required <?php if ($retail['status'] == 'Berizin') echo "checked"; ?>>
                                    <span class="form-check-label">Berizin</span>
                                </label>
                                <label class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" value="Belum Berizin"
                                        name="status" <?php if ($retail['status'] == 'Belum Berizin') echo "checked"; ?>>
                                    <span class="form-check-label">Belum Berizin</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-12 form-group mb-3">
                            <label class="form-label">Kecamatan</label>
                            <select placeholder="Pilih Kecamatan..." id="kecamatan">
                                <?php foreach($kecamatan as $kec) :?>
                                <option label="<?php echo $kec['kecamatan']?>" value="<?php echo $kec['id_kec']?>" <?php if ($retail['id_kec'] == $kec['id_kec']) echo "selected"; ?>>
                                    <?php echo $kec['kecamatan']?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="col-lg-12 form-group mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea class="form-control" id="alamat" placeholder="Alamat"
                                autocomplete="off" required><?php echo $retail['alamat']?></textarea>
                        </div>
                        <div class="col-lg-12 form-group mb-3">
                            <label class="form-label">Latitude</label>
                            <input type="text" class="form-control py-2"  id="lat" name="lat" placeholder="Latitude"
                                autocomplete="off" required value="<?php echo $retail['latitude']?>">
                        </div>
                        <div class="col-lg-12 form-group mb-3">
                            <label class="form-label">Longitude</label>
                            <input type="text" class="form-control py-2"  id="long" name="long" placeholder="Longitude"
                                autocomplete="off" required value="<?php echo $retail['longitude']?>">
                        </div>
                    </form>
                    <button type="submit" id="btn-editsend" class="btn btn-primary">Update</button> 
                    </div>
                    <div class="col-lg-6">
                        <div id="map" style="height: 600px; z-index: 1;"></div>
                        <script>
                            var map = L.map('map').setView([<?php echo $retail['latitude']?>, <?php echo $retail['longitude']?>], 13);
                            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                            }).addTo(map);
                            
                            var marker;
                            var currentmarker = L.marker([<?php echo $retail['latitude']?>, <?php echo $retail['longitude']?>]).addTo(map);
                            map.on('click', function(e) {
                                map.removeLayer(currentmarker);
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
<?= $this->include('/retail/script/seditretail')?>


