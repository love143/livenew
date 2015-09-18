<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<article class="<?php print $classes; ?> clearfix">
  <div class="pull-left overview">
    <div class="row">
      <div class="span3">
        <h2><?php print t('Overview'); ?></h2>
        <div class="table">
          <?php print render($content['field_bathrooms']); ?>
          <?php print render($content['field_bedrooms']); ?>
          <?php print render($content['field_square_foot']); ?>
          <?php print render($content['field_garage']); ?>
          <?php print render($content['field_levels']); ?>
        </div><!-- /.table -->
      </div><!-- /.span2 -->
    </div><!-- /.row -->
  </div><!-- /.overview -->
  <div class="text-center">
    <?php print render($content['field_image']); ?>
  </div>
  <?php print render($content['description']); ?>
  <?php if (!empty($content['field_youtube_video'])): ?>
    <div>
      <h2>Youtube Video</h2>
      <?php print render($content['field_youtube_video']); ?>
    </div>
  <?php endif; ?>
  <?php if (!empty($content['field_brochure_download'])): ?>
    <div><h2>PDF Brochures</h2>
      <?php print render($content['field_brochure_download']); ?>
    </div>
  <?php endif; ?>
  <?php $floorFeatures = $content['field_floor_plan_slideshow']['#items']; ?>
  <?php if (!empty($floorFeatures)): ?>
    <h2>Floor Plan Slideshow</h2>
    <div class="span8 taxonomy-term-features">
      <?php foreach ($floorFeatures as $feature) { ?>
        <?php $img = (array) file_load($feature['fid']); ?>
        <div class="span2 text-center">
          <img src="<?php print file_create_url($img['uri']); ?>" title="<?php print $img['title']; ?>" />
        </div>
      <?php } ?>
    </div>
  <?php endif; ?>
</article>
<?php
drupal_add_js(drupal_get_path('theme', 'realia') . '/js/jquery.touchswipe.min.js', array('type' => 'file', 'scope' => 'footer'));
?>