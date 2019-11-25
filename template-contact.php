<?php
  /* Template Name: Contact Page */
  $content = get_fields();
  get_header();

  $phone_replace = [
    ' ','-','(',')','.'
  ];

  $options = get_fields('option');
?>
<main>
  <div>
    <div class="main-content">
      <div>
        <?php
          if ( have_posts() ) : while ( have_posts() ) : the_post();
            echo "<h2>",the_title(),"</h2>";
            the_content();
          endwhile;
          endif;
        ?>
        <ul class="contact-info">
          <?php if($options['address']) { ?>
          <li class="address"><a href="https://www.google.com/maps/place/<?php echo str_replace([' ',"\r\n"],'+',$options['address']); ?>" target="_blank">
            <?php echo nl2br($options['address']); ?>
          </a></li>
          <?php } ?>
          <?php if($options['phone']) { ?>
          <li>
            <a href="tel:<?php echo str_replace($phone_replace, '', $options['phone']); ?>">
              <?php echo $options['phone']; ?></a> t
          </li>
          <?php } ?>
          <?php if($options['fax']) { ?>
          <li>
            <a href="tel:<?php echo str_replace($phone_replace, '', $options['fax']); ?>">
              <?php echo $options['fax']; ?></a> f
          </li>
          <?php } ?>
          <?php if($options['email']) { ?>
          <li><a href="mailto:<?php echo $options['email']; ?>"><?php echo $options['email']; ?></a></li>
          <?php } ?>
        </ul>
      </div>
      <div>
        <iframe src="https://www.google.com/maps/d/embed?mid=1LIPP_TQtZLWzcCjLvOP6abjqYrXQgCYE" width="640" height="480"></iframe>
      </div>
    </div>
  </div>
</main>
<?php get_footer(); ?>
