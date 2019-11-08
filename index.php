<?php
  $content = get_fields();
  get_header();
?>
<main>
  <div>
    <div class="main-content">
      <div>
        <?php
          if ( have_posts() ) : while ( have_posts() ) : the_post();
            the_content();
          endwhile;
          endif;
        ?>
      </div>
      <div>
        <?php
        if( is_array($content['right_content']) ) {
          foreach($content['right_content'] as $block) {
            include 'callouts/'.$block['acf_fc_layout'].'.php';
          }
        }
        ?>
      </div>
    </div>
  </div>
</main>
<?php get_footer(); ?>
