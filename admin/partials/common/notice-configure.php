<?php
$message = __('Support Hours is not configured.', $this->plugin_name);

sh_the_notice($message, 'notice-success');
?>
<p>
  <a class="button button-primary" href="<?php echo admin_url('admin.php?page=support-hours-settings'); ?>">
    <?php _e('Configure plugin!', $this->plugin_name); ?>
  </a>
</p>