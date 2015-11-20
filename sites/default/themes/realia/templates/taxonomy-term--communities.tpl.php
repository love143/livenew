<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$price_range = db_query("SELECT MAX(p.field_price_value) as max, MIN(p.field_price_value) as min FROM node n
            JOIN field_data_field_community c ON n.nid = c.entity_id AND c.entity_type = 'node'
            JOIN field_data_field_price p ON n.nid = p.entity_id AND p.entity_type = 'node'
            WHERE c.field_community_tid = $term->tid")->fetchObject();
print($messages);
?>
<article class="<?php print $classes; ?> clearfix" id="community-override">
  <div class="container nmrg">
    <div class="row nmrg">
      <div class="span4 nmrg">
        <h5 class="sec-title">Priced From, &nbsp;<?php echo '$' . $price_range->min; ?>&nbsp;-&nbsp;<?php echo '$' . $price_range->max; ?></h5>
        <?php echo render($content['description']); ?>
        <div id="split-tabs">
          <label class="tabs active" href="tab1">Available Properties</label>
          <label class="tabs" href="tab2">Community Features</label>
          <label class="tabs" href="tab3">Sales Office & Direction</label>
          <label class="tabs" href="tab4">Floor Plans & Details</label>
        </div>
      </div>
      <div class="span8 nmrg">
        <div class="split-tabs" id="tab1"><h2>Available Properties</h2><br><?php echo views_embed_view('related_nodes', 'block', $term->tid); ?></div>
        <div class="split-tabs" id="tab2"><h2>Community Features</h2>
          <?php $script = ''; ?>
          <?php $floorFeatures = $content['field_community_features']['#items']; ?>
          <?php if (!empty($floorFeatures)): ?>
            <ul class="taxonomy-term-features pikachoose-communities-<?php echo $term->tid; ?>">
              <?php foreach ($floorFeatures as $feature) { ?>
                <?php $img = (array) file_load($feature['item']['fid']); ?>
                <li class="">
                  <img src="<?php print file_create_url($img['uri']); ?>" title="<?php if (isset($img['title'])) print $img['title']; ?>" />
                </li>
              <?php } ?>
            </ul>
            <?php
            $script = '$(".pikachoose-communities-' . $term->tid . '").slideShow({cls:"taxonomy-term-features",parent: "#tab2"});';
          endif;
          ?>
        </div>
        <div class="split-tabs" id="tab3">
          <h2>Sales Office & Direction</h2>
          <div class="span7">
            <?php $loc = $term->field_community_address['und'][0]; ?>
            <span>
              <?php if ($loc['street']): ?><?php echo $loc['street']; ?><?php endif; ?>, <?php if ($loc['city']): ?><?php echo $loc['city']; ?><?php endif; ?>,<br>
              <?php if ($loc['province_name']): ?><?php echo $loc['province_name']; ?><?php endif; ?>,<br>
              <?php if ($loc['country']): ?><?php echo strtoupper($loc['country']); ?><?php endif; ?> - <?php if ($loc['postal_code']): ?><?php echo $loc['postal_code']; ?><?php endif; ?>
            </span>
            <div class="">
              <a class="btn btn-success" target="_blank" href="http://maps.google.com?q=<?php echo $loc['latitude']; ?>+<?php echo $loc['longitude']; ?>">Get Direction</a>
            </div>
          </div><!-- /.table -->
          <h2>Explore the Neighbourhood</h2>
          <?php echo views_embed_view('communities_map', 'community_map_block', $term->tid); ?>
        </div>
        <div class="split-tabs" id="tab4"><h2>Floor Plans &  Details</h2><?php echo views_embed_view('floor_plans', 'communities_floor_plans', $term->tid); ?></div>
      </div>
    </div>
  </div>
</article>
<?php
drupal_add_js("
(function($){
  $(document).ready(function(){
    $script
    $('#split-tabs .tabs').click(function(){
      var e = $(this);
      $('.split-tabs').hide()
      $('#split-tabs .tabs').removeClass('active');
      e.addClass('active');
      $('#' + e.attr('href')).show();
    });
    var gmp = setInterval(function() {
      if (gmaploadindi) {
        $('#split-tabs .tabs.active').trigger('click');
        clearInterval(gmp);
      }
    }, 1000);
  });
})(jQuery);
", "inline");
