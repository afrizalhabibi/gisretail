<script type="text/javascript">
$(document).ready(function() {
    let validator = $('form.validator-add-pasar').jbvalidator({
        errorMessage: true,
        successClass: false,
        language: "https://emretulek.github.io/jbvalidator/dist/lang/en.json",
    });
    
    $(document).on('click','#btn-send',function(e){
        if (validator.checkAll()) {
            e.preventDefault();
        } else {
            $('#btn-send').html('<div class="spinner-border spinner-border-sm text-white me-2" role="status"></div> Mengirim');
            var nama_pasar = $('#namapasar').val();
            var lat = $('#lat').val();
            var long = $('#long').val();
            var rad = $('#rad').val();
            $.ajax({
                url:'/doaddpasar',
                method:'post',
                data:
                {
                    add_nama:nama_pasar,
                    add_lat:lat,
                    add_long:long,
                    add_rad:rad,
                },
                success:function(response) {
                    $('#btn-send').html('Simpan');
                    window.location = '/pasar';
                },
                error:function (request, error) {
                    $('#btn-send').html('gagal');
                }
            });
        }
    });
});
</script>