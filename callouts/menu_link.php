<?php
  $classes = [
    'menu-link',
    implode($block['orientation'], ' '),
    $block['title_placement'],
    $block['title_direction']
  ];

  if($block['mobile_order']) {
    $classes[] = 'mo_'.$block['mobile_order'];
  }
?>
<a href="<?php echo $block['link']['url']; ?>" class="<?php echo implode($classes, ' '); ?>">
  <?php
    $dw = in_array('dw',$block['orientation']);
    $dt = in_array('dt',$block['orientation']);
    if($dw && $dt) {
      $size = 'dwdt';
    } else if ($dw) {
      $size = 'dw';
    } else if ($dt) {
      $size = 'dt';
    } else {
      $size = 'hp';
    }
    echo rma_img($block['image'],$size);
  ?>
  <div><?php echo $block['title']; ?></div>
</a>
