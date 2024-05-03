<?= $this->include('/layout/head')?>
<?= $this->include('/layout/menu')?>
<?= $this->include('/layout/header_menu')?>
<div class="container-fluid">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Titik Lokasi Retail</h5>
            <div id="map" style="height: 600px; z-index: 1;"></div>
            <script>
                var map = L.map('map').setView([-3.79891511014139, 114.74845545561246], 13);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);
                
                <?php foreach ($retaildata as $retail): ?>
                    L.marker([<?= $retail['latitude'] ?>, <?= $retail['longitude'] ?>]).addTo(map)
                        .bindPopup("<div class='card-body' style='padding:0;'><h5 class='card-title'><?= $retail['nama_retail']?></h5><p class='card-text'><?= $retail['alamat']?></p></div>");
                <?php endforeach; ?>
            </script>
          </div>
        </div>
      </div>
<?= $this->include('/layout/footer')?>
