<?php
include('includes/script.php');
?>
<script>
    $('#myModal').on('shown.bs.modal', function() {
        $('#myInput').trigger('focus')
    })
</script>
<button type="button" data-toggle="modal" data-target="#myModal">Launch modal</button>