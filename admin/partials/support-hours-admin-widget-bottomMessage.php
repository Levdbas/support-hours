<p>
  <?php if($percentage == 100) {?>
    <?php _e( 'Support hours used.', $this->plugin_name); ?><br />
  <?php } elseif($percentage >= 80) {?>
    <?php _e( 'Support hours almost used.', $this->plugin_name); ?><br />
  <?php } else {?>
    <?php _e( 'Need more support hours?', $this->plugin_name); ?><br />
  <?php } ?>
  <?php _e( 'Contact me via', $this->plugin_name); ?>
  <a href="mailto:<?php echo $email;?>"><?php echo $email;?></a>
</p>
