<?php if ($page): ?>
<?php dpm($node); ?>

  <article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>
    <div id="community-override">

      <?php hide($content['field_type']); ?>
      <?php hide($content['comments']); ?>
      <?php hide($content['links']); ?>
      <?php hide($content['field_tags']); ?>
      <?php hide($content['field_general_amenities']); ?>
      <div class="container nmrg">
        <div class="row nmrg">
          <div class="span4 nmrg aprtment-nodes">
            <h2><?php print t('Description'); ?></h2>
            <?php print render($content['field_image']); ?>
            <?php print render($content['body']); ?>
            <div id="split-tabs">
              <label class="tabs active" href="tab1">Overview</label>
              <label class="tabs" href="tab2">General Amenities</label>
              <!--              <label class="tabs" href="tab3">Neighbourhood Info</label>-->
              <label class="tabs" href="tab4">Assigned Agents</label>
              <label class="tabs" href="tab5">Request Information</label>
            </div>
          </div>
          <div class="span8 nmrg">
            <div class="split-tabs" id="tab1">
              <h2><?php print t('Overview'); ?></h2>
              <div class="location">
                <?php print render($content['field_price']); ?>
                <?php print render($content['field_contract_type']); ?>
                <?php print render($content['field_type']); ?>
                <?php // print render($content['field_location']); ?>
                <?php print render($content['field_bathrooms']); ?>
                <?php print render($content['field_bedrooms']); ?>
                <?php print render($content['field_area']); ?>
                <?php print render($content['field_community']); ?>
                <?php print render($content['field_mls_']); ?>
                <?php print render($content['field_floor_plans']); ?>
                 <?php print render($content['field_elevation']); ?>
                 <?php print render($content['field_master_suite']); ?>
                  <?php print render($content['field_basement']); ?>
                  <?php if($node->field_basement['und'][0]['tid'] == 258):?>
                  <div class="field">
                    <div class="field-label">Basement:</div>
                    <div class="field-items">
                      <div class="field-item">
                        Yes                      </div>
                    </div>
                  </div>
                  <?php endif; ?>
                  <?php dpm($content); ?>
                <?php $location = $content['locations']['#locations']; ?>
                <?php $loc = $location[0]; ?>
                <?php if ($loc['street']): ?>
                  <div class="field">
                    <div class="field-label">Street:</div>
                    <div class="field-items">
                      <div class="field-item">
                        <?php echo $loc['street']; ?>
                      </div>
                    </div>
                  </div>
                <?php endif; ?>
                <?php if ($loc['city']): ?>
                  <div class="field">
                    <div class="field-label">City:</div>
                    <div class="field-items">
                      <div class="field-item">
                        <?php echo $loc['city']; ?>
                      </div>
                    </div>
                  </div>
                <?php endif; ?>
                <?php if ($loc['province_name']): ?>
                  <div class="field">
                    <div class="field-label">State:</div>
                    <div class="field-items">
                      <div class="field-item">
                        <?php echo $loc['province_name']; ?>
                      </div>
                    </div>
                  </div>
                <?php endif; ?>
                <?php if ($loc['postal_code']): ?>
                  <div class="field">
                    <div class="field-label">Zip:</div>
                    <div class="field-items">
                      <div class="field-item">
                        <?php echo $loc['postal_code']; ?>
                      </div>
                    </div>
                  </div>
                <?php endif; ?>
                <div class="text-center">
                  <a class="btn btn-success get-direction" target="_blank" href="http://maps.google.com?q=<?php echo $loc['latitude']; ?>+<?php echo $loc['longitude']; ?>">Get Direction</a>
                </div>
              </div>
            </div>
            <div class="split-tabs" id="tab2">
              <h2><?php print t('General amenities'); ?></h2>
              <?php print render($content['field_general_amenities']); ?>
            </div>
            <!--            <div class="split-tabs" id="tab3">
                          <h2><?php print t('Neighbourhood Info'); ?></h2>
            <?php
//            $mapSec = module_invoke('views', 'block_view', '911c8ce7b08fc35dd333f0345e3b2ced');
//            print render($mapSec['content']);
            ?>
                        </div>-->
            <div class="split-tabs" id="tab4">
              <h2><?php print t('Assigned Agents'); ?></h2>
              <?php
              $agent = module_invoke('views', 'block_view', 'agent-assigned_agents');
              print render($agent['content']);
              ?>
            </div>
            <div class="split-tabs" id="tab5">
              <h2><?php print t('Request Information'); ?></h2>
              <?php
              $webform = module_invoke('webform', 'block_view', 'client-block-196');
              print render($webform['content']);
              ?>
            </div>
          </div>
        </div>
      </div>
  </article> <!-- /.node -->

<?php elseif ($teaser): ?>
  <?php print render($content); ?>
<?php endif; ?>

<?php
drupal_add_js("
(function($){
  $(document).ready(function(){
    $('#split-tabs .tabs').click(function(){
      var e = $(this);
      $('.split-tabs').hide()
      $('#split-tabs .tabs').removeClass('active');
      e.addClass('active');
      $('#' + e.attr('href')).show();
    });
    $('#split-tabs .tabs.active').trigger('click');
  });
})(jQuery);
", "inline");
