<div class="<?php print $classes; ?>">
  <?php print render($title_prefix); ?>
  <?php if ($title): ?>
    <?php print $title; ?>
  <?php endif; ?>
  <?php print render($title_suffix); ?>

  <?php if ($exposed): ?>
    <div class="view-filters">
      <?php print $exposed; ?>
    </div>
  <?php endif; ?>

  <?php if ($header): ?>
    <div class="view-header">
      <?php print $header; ?>
    </div>
  <?php endif; ?>

  <?php if ($attachment_before): ?>
    <div class="attachment attachment-before">
      <?php print $attachment_before; ?>
    </div>
  <?php endif; ?>
  <div class="row">
    <div class="communities-content span12">
      <?php
      global $base_url;
      $comms = $view->result;
      foreach ($comms as $comm) {
        $tmp = $comm->_field_data['tid']['entity'];
        $image = !empty($tmp->field_image['und'][0]['uri']) ? file_create_url($tmp->field_image['und'][0]['uri']) : false;
        $sp5 = $image ? 'span8' : 'span12';
        $url = drupal_get_path_alias($base_url . '/taxonomy/term/' . $tmp->tid);
        //$url = str_replace('communities/', '', $url);
        drupal_set_message($url);
        $address = $tmp->field_community_address['und'][0];
        $agent = node_load($tmp->field_agent['und'][0]['nid']);
        //$agent = str_replace('communities/', '', $agent);
        $price_range = taxonomy_term_load($tmp->field_price_range['und'][0]['tid']);
        ?>
        <div class="views-field">
          <div class="field-content">
            <div class="row">
              <?php if (!empty($image)): ?>
                <div class="span3">
                  <a href="<?php echo $url; ?>"><img typeof="foaf:Image" src="<?php echo $image; ?>" width="504" height="376" alt=""></a>
                </div>
              <?php endif; ?>
              <div class="<?php print $sp5; ?>">
                <div>
                  <div class="row title-price">
                    <div class="title">
                      <?php dpm($comm); ?>
                      <a href="<?php echo $url; ?>"><?php echo $tmp->name; ?></a>
                    </div>
                  </div>
                  <div class="comm-list location">
                    <?php echo $address['city'] . ' ' . $address['province'] . ', ' . $address['postal_code']; ?>
                  </div>
                </div>
                <div class="content truncate-dynamic"><?php echo $tmp->description; ?></div>
                <?php if (!empty($agent)): ?>
                  <div class="spirit">
                    <span>Agent :&nbsp;</span>
                    <a href="<?php echo drupal_get_path_alias("node/$agent->nid"); ?>"><?php echo $agent->title; ?></a>
                  </div>
                <?php endif; ?>
                <div class="spirit">
                  <span>Price Range&nbsp;</span><?php echo str_replace(array('the ', 'Pricing '), '', $price_range->name); ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
  <?php if ($pager): ?>
    <?php print $pager; ?>
  <?php endif; ?>

  <?php if ($attachment_after): ?>
    <div class="attachment attachment-after">
      <?php print $attachment_after; ?>
    </div>
  <?php endif; ?>

  <?php if ($more): ?>
    <?php print $more; ?>
  <?php endif; ?>

  <?php if ($footer): ?>
    <div class="view-footer">
      <?php print $footer; ?>
    </div>
  <?php endif; ?>

  <?php if ($feed_icon): ?>
    <div class="feed-icon">
      <?php print $feed_icon; ?>
    </div>
  <?php endif; ?>

</div><?php /* class view */ ?>
