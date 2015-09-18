<?php if ($page): ?>

  <article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

    <?php hide($content['field_type']); ?>
    <?php hide($content['comments']); ?>
    <?php hide($content['links']); ?>
    <?php hide($content['field_tags']); ?>
    <?php hide($content['field_general_amenities']); ?>

    <div class="pull-left overview">
      <div class="row">
        <div class="span3">
          <h2><?php print t('Overview'); ?></h2>
          <div class="table location">
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
            <?php $location = $content['locations']['#locations']; ?>
            <?php $loc = $location[0]; ?>
            <?php if ($loc['street']): ?>
              <div class="field-item">
                <label>Street :</label><span><?php echo $loc['street']; ?></span>
              </div>
            <?php endif; ?>
            <?php if ($loc['city']): ?>
              <div class="field-item">
                <label>City :</label><span><?php echo $loc['city']; ?></span>
              </div>
            <?php endif; ?>
            <?php if ($loc['province_name']): ?>
              <div class="field-item">
                <label>State :</label><span><?php echo $loc['province_name']; ?></span>
              </div>
            <?php endif; ?>
            <?php if ($loc['postal_code']): ?>
              <div class="field-item">
                <label>Zip :</label><span><?php echo $loc['postal_code']; ?></span>
              </div>
            <?php endif; ?>
            <?php print render($content['field_available_floor_plans']); ?>
            <div class="text-center">
              <a class="btn btn-success get-direction" target="_blank" href="http://maps.google.com?q=<?php echo $loc['latitude']; ?>+<?php echo $loc['longitude']; ?>">Get Direction</a>
            </div>
          </div><!-- /.table -->
        </div><!-- /.span2 -->
      </div><!-- /.row -->
    </div><!-- /.overview -->
    <div class="text-center"><?php print render($content['field_image']); ?></div>
    <?php print render($content['body']); ?>

    <h2><?php print t('General amenities'); ?></h2>
    <?php print render($content['field_general_amenities']); ?>
    <?php if (!empty($content['field_tags']) || !empty($content['links'])): ?>

      <footer>
        <?php // print render($content['field_tags']);  ?>
        <?php // print render($content['links']);  ?>
      </footer>

    <?php endif; ?>

    <?php print render($content['comments']); ?>

  </article> <!-- /.node -->

<?php elseif ($teaser): ?>
  <?php print render($content); ?>
<?php endif; ?>
