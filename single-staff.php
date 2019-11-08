<?php
  $content = get_fields();
  get_header();
?>
<main>
  <div>
    <div class="main-content">
      <div>
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
          <h2><?php the_title(); ?></h2>
          <div class="staff-title"><?php echo $content['title']; ?></div>
        <?php
          the_content();
          endwhile;
          endif;
        ?>
      </div>
      <div>
        <?php echo rma_img($content['portrait'],'portrait'); ?>
      </div>
    </div>
  </div>
</main>
<?php get_footer(); ?>
