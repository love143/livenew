<div class="view view-top-4">
  <div class="view-content">
    <div class="row">
      <div class="span9">
        <?php
        $conts = $view->result;
        $arr = array();
        foreach ($conts as $cont) {
          $tmp = $cont->_field_data['nid']['entity'];
          $arr[$tmp->field_display_order['und'][0]['value']][] = $tmp;
        }
        ksort($arr);
        foreach ($arr as $val) {
          foreach ($val as $tmp) {
            ?>
            <div class="item span2">
              <div class="views-field views-field-title">
                <span class="field-content"><?php echo $tmp->title; ?></span>
              </div>
              <div class="views-field views-field-field-image">
                <div class="field-content"><a href="<?php echo $tmp->field_web['und'][0]['url']; ?>"><img typeof="foaf:Image" src="<?php echo file_create_url($tmp->field_image['und'][0]['uri']); ?>" width="140" height="140" alt="" class="shareaholic-media-target-hover-state" /></a></div>
              </div>
            </div>
          <?php } ?>
        <?php } ?>
      </div>
    </div>
  </div>
</div>