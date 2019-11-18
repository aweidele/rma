<?php
  $content = get_fields();
  get_header();
?>
<main>
  <div>
    <nav>
      <a href="#">< Previous Project</a>
      <a href="#">Next Project ></a>
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
