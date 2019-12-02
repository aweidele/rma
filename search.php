<?php
  $content = get_fields();
  get_header();
?>
<main>
  <div>
    <div class="search-results">
      <h2>Search Results</h2>
      <?php
        if ( have_posts() ) : while ( have_posts() ) : the_post();
      ?>
        <article>
          <h3><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h3>
          <p><?php the_excerpt(); ?></p>
          <div class="type"><?php echo ucfirst( get_post_type() ); ?>
        </article>
      <?php
        endwhile;
        endif;
      ?>
    </div>
  </div>
</main>
<?php get_footer();
