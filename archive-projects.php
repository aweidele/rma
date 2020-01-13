<?php
  session_start();
  $_SESSION['current_ind'] = null;
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
            <li><a href="<?php echo get_post_type_archive_link('projects'); ?>" class="active">All</a></li>
            <?php foreach($terms as $term) { ?>
              <li><a href="<?php echo get_term_link($term->term_id); ?>"><?php echo $term->name; ?></a></li>
            <?php } ?>
              <li>
                <?php if($layout != 'table') { ?>
                  <a href="<?php echo get_post_type_archive_link('projects'); ?>?layout=table">Full Project List</a>
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
              if ( have_posts() ) : while ( have_posts() ) : the_post();
              $sector = get_the_terms($post->ID,'industry');
              $sectorNames = [];
              foreach($sector as $s) {
                $sectorNames[] = $s->name;
              }
              $prev_firm = get_field('prev_firm');
            ?>
              <tr>
                <td>
                  <a href="<?php echo get_permalink(); ?>">
                    <h2><?php the_title(); ?><?php if($prev_firm) { echo "<span> *</span>"; } ?></h2>
                    <div><?php echo get_field('location'); ?></div>
                  </a>
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
