<?php
  $classes = [
    'hp-blurb',
    implode($block['orientation'], ' ')
  ];
  if($block['mobile_order']) {
    $classes[] = 'mo_'.$block['mobile_order'];
  }
?>
<div class="<?php echo implode($classes, ' '); ?>">
  <?php echo $block['blurb']; ?>
</div>
