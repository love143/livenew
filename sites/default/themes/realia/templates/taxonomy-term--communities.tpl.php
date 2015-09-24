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
        <h5 class="sec-title">Priced From, &nbsp;<?php echo '$'.$price_range->min; ?>&nbsp;-&nbsp;<?php echo '$'.$price_range->max; ?></h5>
        <?php echo render($content['description']); ?>
        <div id="split-tabs">
          <label class="tabs" href="tab1">Floor Plans & Details</label>
          <label class="tabs" href="tab2">Community Features</label>
          <label class="tabs" href="tab4">Sales Office & Direction</label>
          <label class="tabs active" href="tab5">Available Properties</label>
          <label class="tabs" href="tab3">Explore the Neighbourhood</label>
        </div>
      </div>
      <div class="span8 nmrg">
        <div class="split-tabs" id="tab1"><h2>Floor Plans &  Details</h2><?php echo views_embed_view('floor_plans', 'communities_floor_plans', $term->tid); ?></div>
        <div class="split-tabs" id="tab2"><h2>Community Features</h2>
  <?php $floorFeatures = $content['field_community_features']['#items']; ?>
  <?php if (!empty($floorFeatures)): ?>
    <div class="span8 taxonomy-term-features">
      <?php foreach ($floorFeatures as $feature) { ?>
        <?php $img = (array) file_load($feature['item']['fid']); ?>
        <div class="span3 text-center">
          <img src="<?php print file_create_url($img['uri']); ?>" title="<?php print $img['title']; ?>" />
        </div>
      <?php } ?>
    </div>
  <?php endif; ?>
        </div>
        <div class="split-tabs" id="tab3"><h2>Explore the Neighbourhood</h2><?php echo views_embed_view('communities_map', 'community_map_block', $term->tid); ?></div>
        <div class="split-tabs" id="tab4">
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
        </div>
        <div class="split-tabs" id="tab5"><h2>Available Properties</h2><br><?php echo views_embed_view('related_nodes', 'block', $term->tid); ?></div>
      </div>
    </div>
  </div>
</article>
<?php
drupal_add_js(drupal_get_path('theme', 'realia') . '/js/jquery.touchswipe.min.js', array('type' => 'file', 'scope' => 'footer'));
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
    var gmp = setInterval(function() {
      console.log('try');
      if (gmaploadindi) {
        $('#split-tabs .tabs.active').trigger('click');
        clearInterval(gmp);
        console.log('done');
      }
    }, 1000);
  });
})(jQuery);
", "inline");
drupal_add_js(drupal_get_path('theme', 'realia') . '/js/jquery.touchswipe.min.js', array('type' => 'file', 'scope' => 'footer'));
?>
