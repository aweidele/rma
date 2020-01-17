<?php
  session_start();
  get_header();

  if(isset($_GET['layout'])) {
    $layout = $_GET['layout'];
  }

  $thisterm = get_queried_object();
  $thistermID = $thisterm->term_id;

  $_SESSION['current_ind'] = $thisterm->slug;

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
              <li><a href="<?php echo get_term_link($term->term_id); ?><?php
                if( $layout == 'table' ) {
                  echo '?layout=table';
                }
              ?>"<?php if($term->term_id == $thistermID) { echo ' class="active"'; } ?>><?php echo $term->name; ?></a></li>
            <?php } ?>
              <li><a href="<?php echo get_term_link($thistermID); ?>?layout=table">Full Project List</a></li>
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
      <?php } else { ?>
        <div class="article-list listing-table">
          <table id="projectTable">
            <thead>
              <th tabindex="0" aria-sort="ascending"><div>Project</div></th>
              <th tabindex="0"><div>Client</div></th>
              <th tabindex="0" data-sort-method='number'><div>Date</div></th>
              <th tabindex="0"><div>Sector</div></th>
            </thead>
            <tbody>
            <?php
            $k = 0;
              if ( have_posts() ) : while ( have_posts() ) : the_post();
              $k++;
              $sector = get_the_terms($post->ID,'industry');
              $sectorNames = [];
              foreach($sector as $s) {
                $sectorNames[] = $s->name;
              }
              $prev_firm = get_field('prev_firm');
              $sig = get_field('appear_in_grid');
            ?>
              <tr>
                <td>
                  <?php if($sig) { ?>
                  <a href="<?php echo get_permalink(); ?>">
                  <?php } ?>
                    <h2><?php the_title(); ?><?php if($prev_firm) { echo "<span> *</span>"; } ?></h2>
                    <div><?php echo get_field('location'); ?></div>
                  <?php if($sig) { ?>
                  </a>
                  <?php } ?>
                </td>
                <td><?php echo get_field('client'); ?></td>
                <td><?php echo get_field('date'); ?></td>
                <td><?php echo implode(', ',$sectorNames); ?></td>
              </tr>
            <?php
              endwhile;
              endif;
            ?>
            </tbody>
          </table>
          <p class="disclaimer">*Richard McElhiney completed at previous firm. </p>
        </div>
      <?php } ?>

      </div>
    </div>
  </div>
</main>
<?php get_footer(); ?>
