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
<?php
  $options = get_option($this->plugin_name);
  $bought_hours = $options['bought_hours'];
  $used_hours = $options['used_hours'];
  $user = $options['user'];
  $email = $options['email'];
?>
<div class="wrap">

    <?php
      $user_ID = get_current_user_id();
      if ($user_ID == $user || empty($user)) {
    ?>
    <h2><?php echo esc_html(get_admin_page_title()); ?></h2>
    <form method="post" name="cleanup_options" action="options.php">
        <?php
          settings_fields($this->plugin_name);
          do_settings_sections($this->plugin_name);
        ?>
        <fieldset>
          <p><?php echo __( 'Select support-hour manager', 'support-hours'); ?>.</p>
          <p><?php echo __( 'Warning! If you select the wrong user, you will not have access to this page until the plugin is disabled and enabled.', 'support-hours'); ?>.</p>
          <legend class="screen-reader-text"><span><?php _e('Select support-hour manager.Warning!  If you select the wrong user, you will not have access to this page until the plugin is disabled and enabled.', $this->plugin_name); ?></span></legend>
          <?php $args = array(
             'orderby'                 => 'display_name',
             'order'                   => 'ASC',
             'show'                    => 'display_name',
             'selected'                => $user,
             'name'                    => $this->plugin_name.'[user]', // string
             'id'                      => $this->plugin_name.'-user', // integer
             'class'                   => null, // string
          ); ?>
          <?php wp_dropdown_users( $args ); ?>
        </fieldset>
        <fieldset>
            <p><?php echo __( 'E-Mail adress support-hour manager', 'support-hours'); ?>:</p>
            <legend class="screen-reader-text"><span><?php _e('E-Mail adress support-hour manager', $this->plugin_name); ?>:</span></legend>
            <input type="text" class="regular-text" id="<?php echo $this->plugin_name; ?>-bought_hours" name="<?php echo $this->plugin_name; ?>[email]" value="<?php if(!empty($email)) echo $email; ?>"/>
        </fieldset>
        <fieldset>
            <p><?php echo __( 'Amount of bought support-hours', 'support-hours'); ?>:</p>
            <legend class="screen-reader-text"><span><?php _e('Amount of bought support-hours', $this->plugin_name); ?>:</span></legend>
            <input type="text" placeholder="00:00" class="regular-text time" id="<?php echo $this->plugin_name; ?>-bought_hours" name="<?php echo $this->plugin_name; ?>[bought_hours]" value="<?php if(!empty($bought_hours)) echo $bought_hours; ?>"/>
            <span class="emsg hidden"><?php echo __( 'Please enter a valid time', 'support-hours'); ?></span>
        </fieldset>

        <fieldset>
            <p><?php echo __( 'Amount of used support-hours', 'support-hours'); ?>:</p>
            <legend class="screen-reader-text"><span><?php _e('Amount of used support-hours', $this->plugin_name); ?>:</span></legend>
            <input type="text" placeholder="00:00" class="regular-text time" id="<?php echo $this->plugin_name; ?>-used_hours" name="<?php echo $this->plugin_name; ?>[used_hours]" value="<?php if(!empty($used_hours)) echo $used_hours; ?>"/>
            <span class="emsg hidden"><?php echo __( 'Please enter a valid time', 'support-hours'); ?></span>
        </fieldset>
        <?php submit_button(__( 'Save all changes', 'support-hours'), 'primary','submit', TRUE); ?>
    </form>
    <?php } else {?>
      <p>
        <?php echo __( 'You do not have access to this page because you are not the support-hour manager. Please disable and enable this plugin if you need access again.', 'support-hours'); ?>
      </p>
    <?php } ?>
</div>
