<h2><?php echo $text_instruction; ?></h2>
<div class="buttons">
    <div class="right">
        <input type="button" value="<?php echo $button_confirm; ?>" id="button-confirm" class="button" />
    </div>
</div>
<script type="text/javascript"><!--
$('#button-confirm').bind('click', function() {
    $.ajax({
        type: 'get',
        url: 'index.php?route=payment/bankorder/confirm',
        success: function() {
            //location = '<?php echo $action; ?>';
        }
    });
});
//--></script>
