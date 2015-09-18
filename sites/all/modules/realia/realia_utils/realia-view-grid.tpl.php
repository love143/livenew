<div class="row">
    <div <?php print drupal_attributes($view_attributes); ?>>
      <?php foreach ($rows as $delta => $row): ?>
          <?php foreach ($row as $record): ?>
            <div <?php print drupal_attributes($record['attributes']); ?>>
              <?php print $record['record']; ?>
            </div>
          <?php endforeach; ?>
      <?php endforeach; ?>
    </div>
</div>
