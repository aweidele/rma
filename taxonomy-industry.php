<?php
  get_header();

  $thisterm = get_queried_object();
  $thistermID = $thisterm->term_id;

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
              <li><a href="<?php echo get_post_type_archive_link('projects'); ?>">All</a></li>
            <?php foreach($terms as $term) { ?>
              <li><a href="<?php echo get_term_link($term->term_id); ?>"<?php if($term->term_id == $thistermID) { echo ' class="active"'; } ?>><?php echo $term->name; ?></a></li>
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
              $title = [get_the_title()];
              if ($content['client']) {
                $title[] = $content['client'];
              }
              if ($content['location']) {
                $title[] = $content['location'];
              }

          ?>
            <article>
              <a href="<?php echo get_permalink(); ?>">
                <h2>
                  <?php echo implode($title,'<br>'); ?>
                </h2>
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
