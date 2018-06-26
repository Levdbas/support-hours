<div class="progress-bar position <?php echo $current_color;?>" data-percent="<?php echo $percentage; ?>">
  <div class="background">
    <div class="rotate"></div>
  </div>
  <div class="left"></div>
  <div class="right"></div>
  <div class="innerCicle">
    <span class="textHolder">
      <span class="text <?php echo $size; ?>">
        <?php echo $used_hours; ?> / <?php if(!empty($bought_hours)) echo $bought_hours; ?>
        <br class="smallbr" />
        <?php if($size == "small"){
          echo "<br class='bigbr' />";
        } ?>
        <?php _e( 'hours', $this->plugin_name); ?>
        <?php if($size == "big"){
          echo "<br class='bigbr' />";
        } ?>
        <?php _e( 'used', $this->plugin_name); ?>
      </span>
    </span>
  </div>
</div>
