<?php
  $classes = [
    'hp-blurb',
    implode($block['orientation'], ' ')
  ];
?>
<div class="<?php echo implode($classes, ' '); ?>">
  <?php echo $block['blurb']; ?>
</div>
