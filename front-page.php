<?php
$content = get_fields();
?>
<?php get_header(); ?>
<main>
  <div>
    <div class="hp-grid">
      <?php
        foreach($content['blocks'] as $block) {
          include 'callouts/'.$block['acf_fc_layout'].'.php';
        }
      ?>
    </div>
  </div>
</main>
<?php get_footer(); ?>
