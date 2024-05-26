<?= $this->include('/layout/head')?>
<?= $this->include('/layout/menu')?>
<?= $this->include('/layout/header_menu')?>
<div class="container-fluid">
<div class="card w-100">
    <div class="card-body">
    <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
        <div class="mb-3 mb-sm-0">
            <h5 class="card-title fw-semibold mb-4">Data Pasar</h5>
            </div>
            <div>
            <a href="/addpasar" class="btn btn-primary fs-2 fw-semibold lh-sm">Tambah Data</a>
        </div>
    </div>
    <div class="table-responsive mt-4">
        <table id="table-pasar" class="table text-nowrap mb-0 align-middle" style="width:100%">
            <thead class="text-dark fs-2">
                <tr>
                    <th>No</th>
                    <th>ID</th>
                    <th>Nama Pasar</th>
                    <th>Latitude</th>
                    <th>Longitude</th>
                    <th>Radius</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="fs-2">
    
            </tbody>
        </table>
    </div>
    </div>
</div>
</div>
<?= $this->include('/layout/footer')?>
<!--delete-->
<div class="modal fade" id="modal-delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Apakah anda yakin menghapus data?</p>
      <input type="hidden" id="id_pasar">
      </div>
      <div class="modal-footer">
        <button type="button" id="btndelete-send" class="btn btn-danger">Hapus</button>
      </div>
    </div>
  </div>
</div>
<!--end delete-->
<script>
    $(document).ready(function() {
       table_pasar = $('#table-pasar').DataTable({
            processing: true,
            serverSide: true,
            // columnDefs: [
            // { targets: 0, orderable: false},
            // ]
            order: [],
            ajax: {
                url : '/ajax-pasar',
            }, 
            columns: [
                {data: 'no', orderable: false},
                {data: 'id_pasar', visible: false},
                {data: 'nama_pasar'},
                {data: 'lat'},
                {data: 'lng'},
                {data: 'radius'},
                {data: 'action', orderable: false},
            ]
        });

        $(document).on('click','#btnedit',function(e){
            var id = $(this).attr('data-id');
            window.location.href = '/detailpasar/' +id;
        });

        $(document).on('click','#btndelete',function(e){
            var id = $(this).attr('data-id');
            $('#modal-delete').modal('show');
            $('#id_pasar').val(id);
        });
        $(document).on('click','#btndelete-send',function(e){
            var id = $('#id_pasar').val();
            $.ajax({
                url:'/dodeletepasar',
                method:'post',
                data: {
                    delete_id_pasar:id,
                },
                success:function(response) {
                    window.location = '/pasar';
                },

            })
        });
    });
</script>
