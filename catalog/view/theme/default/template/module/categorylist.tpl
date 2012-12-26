<div class="box">
    <div class="categorylist">
      <ul>
        <?php foreach ($categories as $category): ?>
        <li>
          <a href="<?php echo $category['href']; ?>" class="categorylist-href">
              <div class="categorylist-block">
                  <span class="categorylist-title"><?php echo $category['name']; ?></span>
                  <img src="<?php echo $category['image']; ?>" alt="<?php echo $category['name']; ?>" class="categorylist-image">
              </div>
          </a>
         </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</div>
