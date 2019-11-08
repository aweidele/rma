<div class="staff-list">
  <?php
  $staff = get_posts(['post_type'=>'staff', 'posts_per_page'=>-1]);
  foreach($staff as $s) {
    $id = $s->ID;
    $fields = get_fields($id);
  ?>
  <article>
    <a href="<?php echo get_permalink($id); ?>">
      <h2><?php echo $s->post_title; ?></h2>
      <?php echo rma_img($fields['listing_image'],'grid'); ?>
    </a>
  </article>
  <?php } ?>
</div>
<?php include_once('dialog.php'); ?>
