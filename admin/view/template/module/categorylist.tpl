<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if ($error_warning) :?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php endif; ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/module.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <div class="content">
      <form action="<?php echo $action; ?>" method="post" id="form">
        <table id="module">
          <?php $module_row = 0; ?>
          <tbody id="module-row<?php echo $module_row; ?>">
            <tr>
              <td class="left">
                  Доступность модуля:
              </td>
              <td class="left">
                <input type="hidden" name="categorylist_module[0][layout_id]" value="1">
                <input type="hidden" name="categorylist_module[0][position]" value="content_top">
                <input type="hidden" name="categorylist_module[0][status]" value="1">
                <input type="hidden" name="categorylist_module[0][sort_order]" value="10">
              </td>
            </tr>
          </tbody>
        </table>
      </form>
    </div>
  </div>
</div>