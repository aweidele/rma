<?php
  $content = get_fields();
  get_header();

  $project_list = get_posts([
    'post_type' => 'projects',
    'posts_per_page' => -1,
    'order_by' => 'menu_order'
  ]);

  foreach($project_list as $key => $proj) {
    if ($post->ID == $proj->ID) {
      $current = $key;
      break;
    }
  }

  $prev = $current - 1;
  if($prev < 0) {
    $prev = sizeof($project_list) - 1;
  }

  $next = $current + 1;
  if($next >= sizeof($project_list)) {
    $next = 0;
  }
?>
<main>
  <div>
    <nav>
      <a href="<?php echo get_permalink($project_list[$prev]->ID); ?>">< Previous Project</a>
      <a href="<?php echo get_permalink($project_list[$next]->ID); ?>">Next Project ></a>
    </nav>
  </div>
  <div>
    <div class="main-content">
      <div>
        <?php
          if ( have_posts() ) : while ( have_posts() ) : the_post();
        ?>
          <h2><?php the_title(); ?></h2>
        <?php
            the_content();
          endwhile;
          endif;
        ?>
      </div>
      <div>

        <div class="project-images">
        <?php
          foreach($content['images'] as $key => $image) {
            if($key == 0) {
              $size = 'main';
            } else {
              $size = 'main-half';
            }
        ?>
          <figure>
            <?php echo rma_img($image,$size); ?>
            <figcaption><?php echo $image['caption']; ?></figcaption>
          </figure>
        <?php } ?>
        </div>

      </div>
    </div>
  </div>
</main>
<?php get_footer(); ?>
