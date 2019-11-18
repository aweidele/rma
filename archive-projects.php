<?php
  get_header();

  $terms = get_terms( array(
    'taxonomy' => 'industry',
    'hide_empty' => false,
  ) );
?>
<main>
  <div>
    <div class="main-content">
      <div>
        <h2>Selected Projects</h2>
        <nav class="tax-list">
          <ul>
            <?php foreach($terms as $term) { ?>
              <li><a href="<?php echo get_term_link($term->term_id); ?>"><?php echo $term->name; ?></a></li>
            <?php } ?>
              <li><a href="#">Full Project List</a></li>
          </ul>
        </nav>
      </div>
      <div>

        <div class="article-list listing-grid">
          <?php
            if ( have_posts() ) : while ( have_posts() ) : the_post();
              $id = $post->ID;
              $content = get_fields($id);
              $image = $content['images'][0];
          ?>
            <article>
              <a href="<?php echo get_permalink(); ?>">
                <h2><?php the_title(); ?></h2>
                <figure><?php echo rma_img($image,'grid'); ?></figure>
              </a>
            </article>
          <?php
            endwhile;
            endif;
          ?>
        </div>

      </div>
    </div>
  </div>
</main>
<?php get_footer(); ?>
