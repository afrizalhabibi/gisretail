<?= $this->include('/layout/head')?>
<?= $this->include('/layout/menu')?>
<?= $this->include('/layout/header_menu')?>
<div class="container-fluid">
<div class="card w-100">
    <div class="card-body">
    <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
        <div class="mb-3 mb-sm-0">
            <h5 class="card-title fw-semibold mb-4">Data Retail</h5>
            </div>
            <div>
            <a href="/addretail" class="btn btn-primary fs-2 fw-semibold lh-sm">Tambah Data</a>
        </div>
    </div>
    <div class="card">
        <div class="card-body p-4">

            <div class="row row-cards">
                <div class="col-lg-3 mb-3 mb-sm-0">
                    <label class="form-label">Pemegang Izin</label>
                    <select class="form-select" placeholder="Pilih Pemegang..." id="fPemegang">
                        <option label="Semua Data" value=""></option>
                        <?php foreach($pemegang as $pmg) :?>
                        <option label="<?php echo $pmg->nama?>" value="<?php echo $pmg->id_pemegang?>">
                            <?php echo $pmg->nama?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="col-lg-3 mb-3 mb-sm-0">
                    <label class="form-label">Status</label>
                    <select class="form-select" placeholder="Pilih Status..." id="fStatus">
                        <option label="Semua Data" value=""></option>
                        <?php foreach($retaildata as $retail) :?>
                        <option label="<?php echo $retail->status?>" value="<?php echo $retail->status?>">
                            <?php echo $retail->status?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="col-lg-3 mb-3 mb-sm-0">
                    <label class="form-label">Kecamatan</label>
                    <select class="form-select" placeholder="Pilih Kecamatan..." id="fKecamatan">
                    <option label="Semua Data" value=""></option>
                    <?php foreach($kecamatan as $kcm) :?>
                        <option label="<?php echo $kcm->kecamatan?>" value="<?php echo $kcm->id_kec?>">
                            <?php echo $kcm->kecamatan?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="col-lg-3 mb-3 mb-sm-0 p-4">
                    <div class="row">
                        <div class="col">
                        <button type="button" class="btn btn-primary w-100 m-1" id="btnfilter">Filter</button>
                        </div>
                        <div class="col">
                        <button type="button" class="btn btn-light w-100 m-1" id="btnreset">Reset</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="table-responsive mt-4">
        <table id="table-retail" class="table text-nowrap mb-0 align-middle" style="width:100%">
            <thead class="text-dark fs-2">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Pemegang Izin</th>
                    <th>Status</th>
                    <th>Kecamatan</th>
                    <th>Latitude</th>
                    <th>Longitude</th>
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
      <input type="hidden" id="id_retail">
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
       table_retail = $('#table-retail').DataTable({
            processing: true,
            serverSide: true,
            // columnDefs: [
            // { targets: 0, orderable: false},
            // ]
            order: [],
            ajax: {
                url : '/ajax-showretail',
                data: function(d) {
                    d.izin = $('#fPemegang').val();
                    d.status = $('#fStatus').val();
                    d.kecamatan = $('#fKecamatan').val();
                }
            }, 
            columns: [
                {data: 'no', orderable: false},
                {data: 'nama_retail'},
                {data: 'alamat',visible:false},
                {data: 'nama'},
                {data: 'status', 
                    render: function(data, type, row, meta) {
                        if (row.status == 'Berizin') {
                            badgeclass = ' text-success ';
                        } else {
                            badgeclass = ' text-danger ';
                        }
                        return '<p class="'+badgeclass+'">'+row.status+'</p>'
                        // return '<span class="badge'+badgeclass+'rounded-3">'+row.status+'</span>'
                    }
                },
                {data: 'kecamatan'},
                {data: 'latitude'},
                {data: 'longitude'},
                {data: 'action', orderable: false},
            ]
        });

        $('#btnfilter').click(function(event) {
        table_retail.ajax.reload();
        });

        $('#btnreset').click(function(event) {
            $('#fPemegang').val("");
            $('#fStatus').val("");
            $('#fKecamatan').val("");
            table_retail.ajax.reload();
        });

        $(document).on('click','#btnedit',function(e){
            var id = $(this).attr('data-id');
            window.location.href = '/detailretail/' +id;
        });

        $(document).on('click','#btndelete',function(e){
            var id = $(this).attr('data-id');

            
            $('#modal-delete').modal('show');
            $('#id_retail').val(id);
        });
        $(document).on('click','#btndelete-send',function(e){
            var id = $('#id_retail').val();
            $.ajax({
                url:'/dodeleteretail',
                method:'post',
                data: {
                    delete_id_retail:id,
                },
                success:function(response) {
                    window.location = '/retail';
                },

            })
        });
    });
</script>
