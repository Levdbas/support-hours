<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://basedonline.nl
 * @since      1.0.0
 *
 * @package    Support_Hours
 * @subpackage Support_Hours/admin/partials
 */
?>
<div class="wrap">
    <?php
      $user_ID = get_current_user_id();
      if ($user_ID == 1) {
    ?>
    <h2><?php echo esc_html(get_admin_page_title()); ?></h2>
    <form method="post" name="cleanup_options" action="options.php">
        <?php
          //Grab all options
          $options = get_option($this->plugin_name);

          // Cleanup
          $bought_hours = $options['bought_hours'];
          $used_hours = $options['used_hours'];
        ?>

        <?php
          settings_fields($this->plugin_name);
          do_settings_sections($this->plugin_name);
        ?>
        <fieldset>
            <p><?php echo __( 'Amount of bought support hours', 'support-hours'); ?></p>
            <legend class="screen-reader-text"><span><?php _e('Amount of bought support hours', $this->plugin_name); ?></span></legend>
            <input type="text" class="regular-text" id="<?php echo $this->plugin_name; ?>-bought_hours" name="<?php echo $this->plugin_name; ?>[bought_hours]" value="<?php if(!empty($bought_hours)) echo $bought_hours; ?>"/>
        </fieldset>

        <fieldset>
            <p><?php echo __( 'Amount of used support hours', 'support-hours'); ?></p>
            <legend class="screen-reader-text"><span><?php _e('Amount of used support hours', $this->plugin_name); ?></span></legend>
            <input type="text" class="regular-text" id="<?php echo $this->plugin_name; ?>-used_hours" name="<?php echo $this->plugin_name; ?>[used_hours]" value="<?php if(!empty($used_hours)) echo $used_hours; ?>"/>
        </fieldset>

        <?php submit_button(__( 'Save all changes', 'support-hours'), 'primary','submit', TRUE); ?>
    </form>
    <?php } else {?>
      <p>
        <?php echo __( 'not the main admin', 'support-hours'); ?>
      </p>
    <?php } ?>
</div>
