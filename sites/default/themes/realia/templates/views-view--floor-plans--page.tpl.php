<div class="<?php print $classes; ?>">
  <?php print render($title_prefix); ?>
  <?php if ($title): ?>
    <?php print $title; ?>
  <?php endif; ?>
  <?php print render($title_suffix); ?>
  <?php if ($header): ?>
    <div class="view-header">
      <?php print $header; ?>
    </div>
  <?php endif; ?>

  <?php if ($exposed): ?>
    <div class="view-filters">
      <?php print $exposed; ?>
    </div>
  <?php endif; ?>

  <?php if ($attachment_before): ?>
    <div class="attachment attachment-before">
      <?php print $attachment_before; ?>
    </div>
  <?php endif; ?>
  <div class="row">
    <div class="communities-content span9">
      <?php
      $flrs = $view->result;
      foreach ($flrs as $flr) {
        $tmp = $flr->_field_data['tid']['entity'];
        $image = file_create_url($tmp->field_image['und'][0]['uri']);
        $url = drupal_lookup_path('alias', 'taxonomy/term/' . $tmp->tid);
        $area = taxonomy_term_load($tmp->field_square_foot['und'][0]['tid']);
        $lvl = taxonomy_term_load($tmp->field_levels['und'][0]['tid']);
        $gar = taxonomy_term_load($tmp->field_garage['und'][0]['tid']);
        ?>
        <div class="views-field">
          <div class="field-content">
            <div class="row">
              <div class="span3">
                <a href="<?php echo $url; ?>"><img typeof="foaf:Image" src="<?php echo $image; ?>" width="504" height="376" alt=""></a>
              </div>
              <div class="span5">
                <div class="row title-price">
                  <div class="title">
                    <a href="<?php echo $url; ?>"><?php echo $tmp->name; ?></a>
                  </div>
                </div>
                <div class="content"><?php echo $tmp->description; ?></div>
                <div class="spirit"><span>Area :&nbsp;</span><?php echo $area->name; ?></div>
                <div class="spirit"><span>level :&nbsp;</span><?php echo $lvl->name; ?></div>
                <div class="spirit"><span>Garage :&nbsp;</span><?php echo $gar->name; ?></div>
                <div class="spirit bathroom"><?php echo $tmp->field_bathrooms['und'][0]['value']; ?></div>
                <div class="spirit bedroom"><?php echo $tmp->field_bedrooms['und'][0]['value']; ?></div>
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