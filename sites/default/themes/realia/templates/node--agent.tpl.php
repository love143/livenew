<?php if ($teaser): ?>
  <div class="agent-teaser">
    <div class="agent-image">
      <?php print render($content['field_photo']); ?>
    </div>
    <div class="agent-info">
      <div class="field title"><a href="<?php print url('node/' . $nid, array('absolute' => TRUE)); ?>"><?php print render($title); ?></a></div>
      <?php print render($content['field_phone']); ?>
      <?php print render($content['field_email']); ?>
    </div>
    <br class="clear-fix"/>
  </div>
<?php endif; ?>
<?php if ($page): ?>
  <div class="agent content">
    <div class="agent-photo pull-left"> <?php print render($content['field_photo']); ?></div>
    <div class="agent-content pull-right">
      <h2><?php print $title; ?></h2>
      <?php print render($content['field_job_title']); ?>
      <?php print render($content['field_employee_type']); ?>
      <?php print render($content['field_phone']); ?>
      <?php print render($content['field_email']); ?>
      <?php print render($content['field_communities']); ?>
      <?php print render($content['field_office']); ?>
      <?php print render($content['body']); ?>
    </div>
  </div>
<?php endif; ?>
