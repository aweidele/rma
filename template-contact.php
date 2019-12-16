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
          <li class="address"><?php echo nl2br($options['address']); ?></li>
          <?php } ?>
          <?php if($options['phone']) { ?>
          <li><?php echo $options['phone']; ?> t</li>
          <?php } ?>
          <?php if($options['fax']) { ?>
          <li><?php echo $options['fax']; ?> f</li>
          <?php } ?>
          <?php if($options['email']) { ?>
          <li><a href="mailto:<?php echo $options['email']; ?>"><?php echo $options['email']; ?></a></li>
          <?php } ?>
        </ul>
      </div>
      <div>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.343734820301!2d-73.99655208449668!3d40.7544639429534!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c259ad78db4755%3A0x86c828979ef6d76a!2s347%20W%2036th%20St%2C%20New%20York%2C%20NY%2010018!5e0!3m2!1sen!2sus!4v1576458528079!5m2!1sen!2sus" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
      </div>
    </div>
  </div>
</main>
<?php get_footer(); ?>
