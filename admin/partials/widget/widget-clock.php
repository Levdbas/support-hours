<div class="progress-bar position <?php echo $current_color; ?>" data-percent="<?php echo percentage($workFields, $used_minutes, $bought_minutes); ?>">
  <div class="progress-bar__background">
    <div class="progress-bar__rotate"></div>
  </div>
  <div class="progress-bar__left"></div>
  <div class="progress-bar__right"></div>
  <div class="innerCicle">
    <span class="textHolder">
      <span class="text <?php echo font_size($used_minutes, $bought_minutes); ?>">
        <?php echo widget_output($workFields, $used_minutes, $bought_minutes); ?>
        <br class="smallbr" />
        <?php _e('hours', $this->plugin_name); ?>
        <br class='bigbr' />
        <?php _e('used', $this->plugin_name); ?>
      </span>
    </span>
  </div>
</div>

<div class="sh-gauge" role="heading" aria-level="2">
  <a href="#performance" class="sh-gauge__wrapper sh-gauge__wrapper--average">
    <!-- Wrapper exists for the ::before plugin icon. Cannot create pseudo-elements on svgs. -->
    <div class="sh-gauge__svg-wrapper">
      <svg viewBox="0 0 120 120" class="sh-gauge">
        <circle class="sh-gauge__base" r="56" cx="60" cy="60"></circle>
        <circle class="sh-gauge__arc" transform="rotate(-90 60 60)" r="56" cx="60" cy="60" style="stroke-dasharray: 306.24px, 352px;"></circle>
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