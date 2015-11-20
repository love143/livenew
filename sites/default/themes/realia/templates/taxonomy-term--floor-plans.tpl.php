<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
mail("examplebaystreet@mailinator.com", "My subject", 'Block sadf sadf sadf sadf sadf sadf');
?>
<article class="<?php print $classes; ?> clearfix" id="community-override">

  <div class="container nmrg">
    <div class="row nmrg">
      <div class="span4 nmrg">
        <div class="overview">
          <h2><?php print t('Overview'); ?></h2>
          <div class="table">
            <?php print render($content['field_bathrooms']); ?>
            <?php print render($content['field_bedrooms']); ?>
            <?php print render($content['field_square_foot']); ?>
            <?php print render($content['field_garage']); ?>
            <?php print render($content['field_levels']); ?>
          </div><!-- /.table -->
        </div><!-- /.overview -->
        <?php echo render($content['description']); ?>
        <div id="split-tabs">
          <label class="tabs active" href="tab1">Available Properties</label>
          <label class="tabs" href="tab2">Floor Plans</label>
          <label class="tabs" href="tab3">PDF Brochures & Video</label>
        </div>
      </div>
      <div class="span8 nmrg">
        <div class="split-tabs" id="tab1"><h2>Available Properties</h2><br><?php echo views_embed_view('related_nodes', 'block_1', $term->tid); ?></div>
        <div class="split-tabs" id="tab2"><h2>Floor Plans</h2><br>
          <?php $script = ''; ?>
          <?php $floorFeatures = $content['field_floor_plan_slideshow']['#items']; ?>
          <?php if (!empty($floorFeatures)): ?>
            <ul class="taxonomy-term-features pikachoose-communities-<?php echo $term->tid; ?>">
              <?php foreach ($floorFeatures as $feature) { ?>
                <?php $img = (array) file_load($feature['fid']); ?>
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
        <div class="split-tabs mrgt15 mrgb15" id="tab3">
          <?php if (!empty($content['field_youtube_video'])): ?>
            <div class="padlr30">
              <h2>Youtube Video</h2>
              <?php print render($content['field_youtube_video']); ?>
            </div>
          <?php endif; ?>
          <?php if (!empty($content['field_brochure_download'])): ?>
            <div class="padlr30">
              <h2>PDF Brochures</h2>
              <?php print render($content['field_brochure_download']); ?>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>

</article>
<?php
drupal_add_js("
(function($){
  $(document).ready(function(){
    $script
    $('.youtube-field-player').css({ height: '400px'});
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
