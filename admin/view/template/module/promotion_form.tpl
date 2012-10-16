<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/product.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <div class="content">
      <div id="tabs" class="htabs">
          <a href="#tab-general"><?php echo $tab_general; ?></a>
          <a href="#tab-data"><?php echo $tab_data; ?></a>
      </div>
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <div id="tab-general">
          <div id="languages" class="htabs">
            <?php foreach ($languages as $language) { ?>
            <a href="#language<?php echo $language['language_id']; ?>"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a>
            <?php } ?>
          </div>
          <?php foreach ($languages as $language) { ?>
          <div id="language<?php echo $language['language_id']; ?>">
            <table class="form">
              <tr>
                <td><span class="required">*</span> <?php echo $entry_name; ?></td>
                <td>
                    <input type="text" name="promotion_description[<?php echo $language['language_id']; ?>][name]" size="100" value="<?php echo isset($promotion_description[$language['language_id']]) ? $promotion_description[$language['language_id']]['name'] : ''; ?>" />
                  <?php if (isset($error_name[$language['language_id']])) { ?>
                  <span class="error"><?php echo $error_name[$language['language_id']]; ?></span>
                  <?php } ?>
                </td>
              </tr>
              <tr>
                <td><?php echo $entry_image; ?></td>
                <td><input type="hidden" name="promotion_description[<?php echo $language['language_id']; ?>][image]" value="<?php echo $promotion_description[$language['language_id']]['image']; ?>" id="image<?php echo $language['language_id']?>" />
                  <img src="<?php echo $promotion_description[$language['language_id']]['image_url']; ?>" alt="" id="preview<?php echo $language['language_id']?>" class="image" onclick="image_upload('image<?php echo $language['language_id']?>', 'preview<?php echo $language['language_id']?>');" />
                  <br />
                  <a onclick="image_upload('image<?php echo $language['language_id']?>', 'preview<?php echo $language['language_id']?>');"><?php echo $text_browse; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;
                  <a onclick="$('#thumb<?php echo $language['language_id']?>').attr('src', '<?php echo $no_image; ?>'); $('#image<?php echo $language['language_id']?>').attr('value', '');"><?php echo $text_clear; ?></a></div>
                </td>
              </tr>
              <tr>
                <td><?php echo $entry_meta_description; ?></td>
                <td><textarea name="promotion_description[<?php echo $language['language_id']; ?>][meta_description]" cols="40" rows="5"><?php echo isset($promotion_description[$language['language_id']]) ? $promotion_description[$language['language_id']]['meta_description'] : ''; ?></textarea></td>
              </tr>
              <tr>
                <td><?php echo $entry_description; ?></td>
                <td><textarea name="promotion_description[<?php echo $language['language_id']; ?>][description]" id="description<?php echo $language['language_id']; ?>"><?php echo isset($promotion_description[$language['language_id']]) ? $promotion_description[$language['language_id']]['description'] : ''; ?></textarea></td>
              </tr>
            </table>
          </div>
          <?php } ?>
        </div>
        <div id="tab-data">
          <table class="form">
            <tr>
              <td><span class="required">*</span> <?php echo $column_title; ?></td>
              <td>
                  <input type="hidden" name="promotion_id" value="<?php echo $promotion['promotion_id']; ?>" />
                  <input type="text" name="title" value="<?php echo $promotion['title']; ?>" />
              </td>
            </tr>
            <tr>
              <td><?php echo $column_status; ?></td>
              <td>
                  <select name="status">
                      <option value="1" <?php echo $promotion['status'] ? 'selected="selected"' : ''; ?>><?php echo $entity_active ?></option>
                      <option value="0" <?php echo !$promotion['status'] ? 'selected="selected"' : ''; ?>><?php echo $entity_inactive ?></option>
                  </select>
              </td>
            </tr>
            <tr>
              <td><?php echo $column_image; ?></td>
              <td>
                  <input type="text" name="picture" value="<?php echo $promotion['picture']; ?>" />
              </td>
            </tr>
            <tr>
              <td><?php echo $column_order; ?></td>
                <td>
                  <input type="text" name="order" value="<?php echo $promotion['order']; ?>" />
                </td>
            </tr>
            <tr>
              <td><?php echo $column_position; ?></td>
              <td>
                <input type="text" name="position" value="<?php echo $promotion['position']; ?>" />
              </td>
            </tr>
          </table>
        </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript" src="view/javascript/ckeditor/ckeditor.js"></script> 

<script type="text/javascript"><!--
<?php foreach ($languages as $language) { ?>
CKEDITOR.replace('description<?php echo $language['language_id']; ?>', {
	filebrowserBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserImageBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserFlashBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserImageUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserFlashUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>'
});
<?php } ?>
//--></script>

<script type="text/javascript"><!--
function image_upload(field, thumb) {
    console.log(field, thumb);
	$('#dialog').remove();
	$('#content').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe src="index.php?route=common/filemanager&token=<?php echo $token; ?>&field=' + encodeURIComponent(field) + '" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');
	
	$('#dialog').dialog({
		title: '<?php echo $text_image_manager; ?>',
		close: function (event, ui) {
			if ($('#' + field).attr('value')) {
				$.ajax({
					url: 'index.php?route=common/filemanager/image&token=<?php echo $token; ?>&image=' + encodeURIComponent($('#' + field).attr('value')),
					dataType: 'text',
					success: function(text) {
						$('#' + thumb).replaceWith('<img src="' + text + '" alt="" id="' + thumb + '" />');
					}
				});
			}
		},	
		bgiframe: false,
		width: 800,
		height: 400,
		resizable: false,
		modal: false
	});
};
//--></script> 

<script type="text/javascript" src="view/javascript/jquery/ui/jquery-ui-timepicker-addon.js"></script> 
<script type="text/javascript"><!--
$('.date').datepicker({dateFormat: 'yy-mm-dd'});
$('.datetime').datetimepicker({
	dateFormat: 'yy-mm-dd',
	timeFormat: 'h:m'
});
$('.time').timepicker({timeFormat: 'h:m'});
//--></script> 
<script type="text/javascript"><!--
$('#tabs a').tabs(); 
$('#languages a').tabs(); 
$('#vtab-option a').tabs();
//--></script> 
<?php echo $footer; ?>