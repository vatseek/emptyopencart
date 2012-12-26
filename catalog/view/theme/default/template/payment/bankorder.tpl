<h2><?php echo $text_instruction; ?></h2>
<div class="buttons">
    <div class="right">
        <a href="<?php echo $action_order; ?>" target="_blank" id="order_page" class="button"><?php echo $button_confirm; ?></a>
    </div>
</div>
<script type="text/javascript"><!--
$(document).ready(function(){
   $('#order_page').click(function(){
       goConfirm();
   });
});

function goConfirm() {
    $.ajax({
        type: 'get',
        url: 'index.php?route=payment/bankorder/confirm',
        success: function() {
            location = '<?php echo $action; ?>';
        }
    });
}
//--></script>
