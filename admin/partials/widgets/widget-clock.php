<div class="progress-bar position <?php echo $current_color;?>" data-percent="<?php echo percentage($used_minutes, $bought_minutes); ?>">
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
        <?php _e( 'hours', $this->plugin_name); ?>
        <br class='bigbr' />
        <?php _e( 'used', $this->plugin_name);?>
      </span>
    </span>
  </div>
</div>
