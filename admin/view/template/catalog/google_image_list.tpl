<html>
<head><title>Conforming HTML 4.01 Strict Template</title>
    <style>
        * {margin:0; padding:0;}
        .searchbar { left:0px; right: 0px; height:30px; padding:10px; background-color: #999;}
        .searchbar-field { margin:0 auto; font-size:20px; border:1px solid #666; border-radius:6px;padding:3px 10px; width:90%;}
        .element {float:left; height:160px; border: 1px solid #666; margin:10px;
            background: -moz-linear-gradient(top, #333, #ccc);
            background: -webkit-linear-gradient(top, #333, #ccc);
        }
        .note { float: left; color: #fff;}
    </style>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript">
        function setImage(element) {
            var item = jQuery(element)
            jQuery('#image-find', jQuery(window.opener.document)).val(item.prop('href'));
            window.close();
        }

    </script>
</head>
<body>
    <div class="searchbar">
        <form action="" method="GET">
            <input type="text" value="<?php echo $search?>" class="searchbar-field" name="search">
            <input type="hidden" value="<?php echo $token; ?>" name="token">
            <input type="hidden" value="catalog/product/google" name="route">
        <form>
    </div>
    <div id="content">
        <?php foreach ($images as $image):?>
            <div class="element">
                <a href="<?php echo $image->url; ?>" onclick="setImage(this);return false;" class="image"><img src="<?php echo $image->tbUrl; ?>" height="135"></a>
                <span class="note"><?php echo $image->width . 'x' . $image->height ?></span>
            </div>
        <?php endforeach;?>
    </div>
</body>
</html>

<!--
    [width] => 620
    [height] => 411
    [imageId] => ANd9GcQ52HaBb2CMmslkpOiBqofdq71nr-XK8PHssIVdq8r-MDhBYLGUExHxWFk
    [tbWidth] => 136
    [tbHeight] => 90
    [unescapedUrl] => http://www.blogcdn.com/www.engadget.com/media/2012/10/dsc02627-1351550214.jpg
    [url] => http://www.blogcdn.com/www.engadget.com/media/2012/10/dsc02627-1351550214.jpg
    [visibleUrl] => www.engadget.com
    [title] => Google Nexus 10 hands-
    [titleNoFormatting] => Google Nexus 10 hands-
    [originalContextUrl] => http://www.engadget.com/2012/10/29/nexus-10-hands-on-video/
    [content] => Nexus 10 handson
    [contentNoFormatting] => Nexus 10 handson
    [tbUrl] => http://t2.gstatic.com/images?q=tbn:ANd9GcQ52HaBb2CMmslkpOiBqofdq71nr-XK8PHssIVdq8r-MDhBYLGUExHxWFk
--!>
