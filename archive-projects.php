<?php
  get_header();

  if(isset($_GET['layout'])) {
    $layout = $_GET['layout'];
  }

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
              <li>
                <?php if($layout == 'table') {
                  $href = explode('?',$_SERVER['REQUEST_URI']);
                ?>
                  <a href="<?php echo $href[0]; ?>">Project Grid</a>
                <?php } else { ?>
                  <a href="?layout=table">Full Project List</a>
                <?php } ?>
              </li>
          </ul>
        </nav>
      </div>
      <div>

        <?php if($layout != 'table') { ?>
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
      <?php } else { ?>
        <div class="article-list listing-table">
          <table id="projectTable">
            <thead>
              <th tabindex="0" aria-sort="ascending"><div>Project</div></th>
              <th tabindex="0"><div>Client</div></th>
              <th tabindex="0" data-sort-method='number'><div>Date</div></th>
            </thead>
            <tbody>
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
              <tr>
                <td>
                  <a href="<?php echo get_permalink(); ?>">
                    <h2><?php the_title(); ?></h2>
                    <div><?php echo get_field('location'); ?></div>
                  </a>
                </td>
                <td><?php echo get_field('client'); ?></td>
                <td><?php echo get_field('date'); ?></td>
              </tr>
            <?php
              endwhile;
              endif;
            ?>
            </tbody>
          </table>
        </div>
      <?php } ?>

      </div>
    </div>
  </div>
</main>
<?php get_footer(); ?>