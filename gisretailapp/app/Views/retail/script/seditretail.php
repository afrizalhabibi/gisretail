<script type="text/javascript">
$(document).ready(function() {
   new TomSelect("#kecamatan",{
        sortField: {
            field: "text",
            direction: "asc"
        }
    });
    let validator = $('form.validator-edit-retail').jbvalidator({
        errorMessage: true,
        successClass: false,
        language: "https://emretulek.github.io/jbvalidator/dist/lang/en.json",
    });
    
    $(document).on('click','#btn-editsend',function(e){
        if (validator.checkAll()) {
            e.preventDefault();
        } else {
            $('#btn-editsend').html('<div class="spinner-border spinner-border-sm text-white me-2" role="status"></div> Mengirim');
            var id_retail= $('#id_retail').val();
            var id_pemegang = $('#pemegang').val();
            var nama_retail = $('#namaretail').val();
            var status = $('input[name="status"]:checked').val();
            var kecamatan = $('#kecamatan').val();
            var alamat = $('#alamat').val();
            var lat = $('#lat').val();
            var long = $('#long').val();

            $.ajax({
                url:'/doeditretail',
                method:'post',
                data:
                    {
                        edit_id_retail:id_retail,
                        edit_pemegang:id_pemegang,
                        edit_nama:nama_retail,
                        edit_status:status,
                        edit_kec:kecamatan,
                        edit_alamat:alamat,
                        edit_lat:lat,
                        edit_long:long,
                    },
                success:function(response){
                    $('#btn-editsend').html('Simpan');
                    window.location = '/retail';
                },
                error:function (request, error) {
                    $('#btn-editsend').html('gagal');
                }
            }); 
        }
    });
});
</script>