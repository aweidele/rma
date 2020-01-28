<?php
  $classes = [
    'hp-image',
    implode($block['orientation'], ' ')
  ];
  if($block['mobile_order']) {
    $classes[] = 'mo_'.$block['mobile_order'];
  }
?>
<div class="<?php echo implode($classes, ' '); ?>">
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
</div>
