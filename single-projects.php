<?php
  $content = get_fields();
  session_start();
  get_header();

  $np_args = [
    'post_type' => 'projects',
    'posts_per_page' => -1,
    'order_by' => 'menu_order'
  ];

  if( isset($_SESSION['current_ind']) && $_SESSION['current_ind'] != '' ) {
    $np_args['tax_query'] = [
      [
        'taxonomy' => 'industry',
        'field'    => 'slug',
        'terms'    => $_SESSION['current_ind'],
      ]
    ];
  }

  $project_list = get_posts($np_args);

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
          $sector = get_the_terms($post->ID,'industry');
        ?>
          <h2>
            <?php the_title(); ?>
            <small><?php echo $content['location']; ?></small>
          </h2>
        <?php the_content(); ?>
          <div class="see-also">
            <h3>See also</h3>
            <ul>
            <?php
              if(sizeof($sector)) {
                foreach($sector as $s) {
            ?>
              <li><a href="<?php echo get_term_link($s->term_id); ?>"><?php echo $s->name; ?></a></li>
            <?php
                }
              }
            ?>
              <li><a href="<?php echo get_post_type_archive_link('projects'); ?>?layout=table">Full Project List</a></li>
            </ul>
          </div>
        <?php
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
            <?php if($key == 0) { ?>
            <figcaption><?php echo $image['caption']; ?></figcaption>
            <?php } ?>
          </figure>
        <?php } ?>
        </div>

      </div>
    </div>
  </div>
</main>
<?php get_footer(); ?>
