<?php
  $phone_replace = [
    ' ','-','(',')','.'
  ];
?>
    <footer>
      <div>
        <div>
          <ul>
            <li class="company-name"><a href="<?php echo get_home_url(); ?>"><?php
              if(get_field('company_name', 'option')) {
                the_field('company_name', 'option');
              } else {
                echo get_bloginfo('name');
              }
            ?></a></li>
            <?php
              if(get_field('address', 'option')) {
                $address = get_field('address', 'option');
            ?>
            <li>
              <a href="https://www.google.com/maps/place/<?php echo str_replace([' ',"\r\n"],'+',$address); ?>" target="_blank">
                <?php echo $address; ?>
              </a>
            </li>
            <?php } ?>
            <?php
              if(get_field('phone', 'option')) {
                $phone = get_field('phone', 'option');
            ?>
            <li>
              <a href="tel:<?php echo str_replace($phone_replace, '', $phone); ?>">
                <?php echo $phone; ?>
              </a>
            </li>
            <?php } ?>
            <?php
              if(get_field('fax', 'option')) {
                $fax = get_field('fax', 'option');
            ?>
            <li>
              <a href="tel:<?php echo str_replace($phone_replace, '', $fax); ?>">
                <?php echo $fax; ?>
              </a>
            </li>
            <?php } ?>
            <?php if(get_field('email', 'option')) { ?>
            <li><a href="mailto:<?php the_field('email', 'option'); ?>"><?php the_field('email', 'option'); ?></a></li>
            <?php } ?>
          </ul>
          <div>
            Copyright &copy; <?php echo date('Y'); ?>
          </div>
        </div>
      </div>
    </footer>
  </div>
<?php wp_footer(); ?>
</body>
</html>
