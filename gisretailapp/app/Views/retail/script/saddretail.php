<script type="text/javascript">
$(document).ready(function() {
   new TomSelect("#kecamatan",{
        sortField: {
            field: "text",
            direction: "asc"
        }
    });
    let validator = $('form.validator-add-retail').jbvalidator({
        errorMessage: true,
        successClass: false,
        language: "https://emretulek.github.io/jbvalidator/dist/lang/en.json",
    });
    
    $(document).on('click','#btn-send',function(e){
        if (validator.checkAll()) {
            e.preventDefault();
        } else {
            $('#btn-send').html('<div class="spinner-border spinner-border-sm text-white me-2" role="status"></div> Mengirim');
            var id_pemegang = $('#pemegang').val();
            var nama_retail = $('#namaretail').val();
            var status = $('input[name="status"]:checked').val();
            var kecamatan = $('#kecamatan').val();
            var alamat = $('#alamat').val();
            var lat = $('#lat').val();
            var long = $('#long').val();
            $.ajax({
                url:'/doaddretail',
                method:'post',
                data:
                {
                    add_pemegang:id_pemegang,
                    add_nama:nama_retail,
                    add_status:status,
                    add_kec:kecamatan,
                    add_alamat:alamat,
                    add_lat:lat,
                    add_long:long,
                },
                success:function(response) {
                    $('#btn-send').html('Simpan');
                    window.location = '/retail';
                },
                error:function (request, error) {
                    $('#btn-send').html('gagal');
                }
            });
        }
    });
});
</script>