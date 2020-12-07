<?php

namespace Support_Hours;
?>
<div class="sh-gauge" role="heading" aria-level="2" data-percent="<?php echo percentage($workFields, $used_minutes, $bought_minutes); ?>">
  <a href="<?php echo admin_url('admin.php?page=support-hours'); ?>" class="sh-gauge__wrapper sh-gauge__wrapper--average">
    <!-- Wrapper exists for the ::before plugin icon. Cannot create pseudo-elements on svgs. -->
    <div class="sh-gauge__svg-wrapper">
      <svg viewBox="0 0 120 120" class="sh-gauge__svg">
        <circle class="sh-gauge__base" r="56" cx="60" cy="60"></circle>
        <circle class="sh-gauge__arc" stroke="#d2d3d4" transform="rotate(-90 60 60)" r="56" cx="60" cy="60"></circle>
        <line class="sh-gauge__overlay" x1="60" y1="60" x2="60" y2="60"></line>
      </svg>
    </div>
    <div class="sh-gauge__percentage">
      <span class="sh-gauge__text <?php echo font_size($used_minutes, $bought_minutes); ?>">
        <?php echo widget_output($workFields, $used_minutes, $bought_minutes); ?>
        <br class="smallbr" />
        <?php _e('hours', $this->plugin_name); ?>
        <br class='bigbr' />
        <?php _e('used', $this->plugin_name); ?>
      </span>
    </div>
  </a>
</div>