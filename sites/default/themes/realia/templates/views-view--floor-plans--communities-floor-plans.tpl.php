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
    <div class="communities-content">
      <?php
      $flrs = $view->result;
      $arg = arg();
      $comm = (isset($arg[2]) && is_numeric($arg[2]) && $arg[0] == 'taxonomy' && $arg[1] == 'term') ? taxonomy_term_load($arg[2]) : null;
      foreach ($flrs as $flr) {
        $tmp = $flr->_field_data['tid']['entity'];
        $image = file_create_url($tmp->field_image['und'][0]['uri']);
        $url = drupal_lookup_path('alias', 'taxonomy/term/' . $tmp->tid);
        $url = "/" . $url;
        $area = taxonomy_term_load($tmp->field_square_foot['und'][0]['tid']);
        $lvl = taxonomy_term_load($tmp->field_levels['und'][0]['tid']);
        $gar = taxonomy_term_load($tmp->field_garage['und'][0]['tid']);
        ?>
        <div class="views-field">
          <div class="field-content">
            <div class="row">
              <div class="span2">
                <a href="<?php echo $url; ?>"><img typeof="foaf:Image" src="<?php echo $image; ?>" width="504" height="376" alt=""></a>
              </div>
              <div class="span5">
                <h2 class="title nmrg">
                  <a href="<?php echo $url; ?>"><?php echo $tmp->name; ?></a>
                </h2>
                <div class="content truncate-dynamic"><?php echo $tmp->description; ?></div>
                <div class="spirit"><span>Area :&nbsp;</span><?php echo $area->name; ?></div>
                <div class="spirit"><span>level :&nbsp;</span><?php echo $lvl->name; ?></div>
                <div class="spirit"><span>Garage :&nbsp;</span><?php echo $gar->name; ?></div>
                <div class="spirit bathroom"><?php echo $tmp->field_bathrooms['und'][0]['value']; ?></div>
                <div class="spirit bedroom"><?php echo $tmp->field_bedrooms['und'][0]['value']; ?></div>
                <?php if (!empty($comm) && $comm->vocabulary_machine_name == 'communities'): ?>
                  <?php $floorFeatures = $tmp->field_floor_plan_slideshow['und']; ?>
                  <?php if (!empty($floorFeatures)): ?>
                    <h4>Floor Plan Slideshow</h4>
                    <ul class="taxonomy-term-features pikachoose-floor-plans-<?php echo $tmp->tid; ?>">
                      <?php foreach ($floorFeatures as $feature) { ?>
                        <?php $img = (array) file_load($feature['fid']); ?>
                        <li class="span2 text-center">
                          <img src="<?php print file_create_url($img['uri']); ?>" title="<?php print $img['title']; ?>" />
                        </li>
                      <?php } ?>
                    </ul>
                    <?php
                  endif;
                  $script = '(function($){ $(document).ready(function(){ demo1 = $(".pikachoose-floor-plans-' . $tmp->tid . '").slippry({transition: "fade", speed: 1000, pause: 3000, auto: 1, pager: 0, preload: "visible", captions: 0, adaptiveHeight: 1 });
  }); })(jQuery);';
                  $path = drupal_get_path('module', 'pikachoose_slider');
                  drupal_add_js($path . '/js/slippry.min.js');
                  drupal_add_css($path . '/css/slippry.css');
                  drupal_add_js($script, array('type' => 'inline'));
                endif;
                ?>
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
