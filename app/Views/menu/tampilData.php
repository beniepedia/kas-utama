<?= $menu ?>



<script>
    $(document).on('click', '.edit-menu', function() {
        let id = $(this).attr('id-menu');
        ajxPost('<?= base_url(service('uri')->getSegment(1) . '/modal_edit'); ?>', {
            id: id
        }).done((respon) => {
            $(".modal_edit").html(respon).show();
            $("#form-edit").modal('show');
        })
    })
</script>