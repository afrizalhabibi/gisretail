<script type="text/javascript">
$(document).ready(function() {
    let validator = $('form.validator-edit-pasar').jbvalidator({
        errorMessage: true,
        successClass: false,
        language: "https://emretulek.github.io/jbvalidator/dist/lang/en.json",
    });
    
    $(document).on('click','#btn-editsend',function(e){
        if (validator.checkAll()) {
            e.preventDefault();
        } else {
            $('#btn-editsend').html('<div class="spinner-border spinner-border-sm text-white me-2" role="status"></div> Mengirim');
            var id_pasar= $('#id_pasar').val();
            var nama_pasar = $('#namapasar').val();
            var lat = $('#lat').val();
            var long = $('#long').val();
            var rad = $('#rad').val();

            $.ajax({
                url:'/doeditpasar',
                method:'post',
                data:
                    {
                        edit_id_pasar:id_pasar,
                        edit_namapasar:nama_pasar,
                        edit_lat:lat,
                        edit_long:long,
                        edit_rad:rad,
                    },
                success:function(response){
                    $('#btn-editsend').html('Simpan');
                    window.location = '/pasar';
                },
                error:function (request, error) {
                    $('#btn-editsend').html('gagal');
                }
            }); 
        }
    });
});
</script>