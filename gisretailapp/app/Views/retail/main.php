<?= $this->include('/layout/head')?>
<?= $this->include('/layout/menu')?>
<?= $this->include('/layout/header_menu')?>
<div class="container-fluid">
<div class="card">
    <div class="card-body">
    <h5 class="card-title fw-semibold mb-4">Data Retail</h5>
    <table id="table-retail" class="display" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>ID Pemegang</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Status</th>
                <th>Kecamatan</th>
                <th>Latitude</th>
                <th>Longitude</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
    </div>
</div>
</div>
<?= $this->include('/layout/footer')?>
<script>
    $(document).ready(function() {
        $('#table-retail').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/ajax-showretail'
        });
    });
</script>
