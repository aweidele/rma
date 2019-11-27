<div class="interior-grid">
<?php
foreach($block['grid_items'] as $b) {
  if($b['acf_fc_layout'] == 'hp-image') {
    $classes = [
      'hp-image',
      implode($b['orientation'], ' ')
    ];
?>
<div class="<?php echo implode($classes, ' '); ?>">
  <?php
    $dw = in_array('dw',$b['orientation']);
    $dt = in_array('dt',$b['orientation']);
    if($dw && $dt) {
      $size = 'dwdt';
    } else if ($dw) {
      $size = 'dw';
    } else if ($dt) {
      $size = 'dt';
    } else {
      $size = 'hp';
    }
    echo rma_img($b['image'],$size);
  ?>
</div>
<?php
  } else if($b['acf_fc_layout'] == 'blurb') {
    $classes = [
      'hp-blurb',
      implode($b['orientation'], ' ')
    ];
?>
  <div class="<?php echo implode($classes, ' '); ?>">
    <?php echo $b['blurb']; ?>
  </div>
<?php
  }
}
?>
</div>
