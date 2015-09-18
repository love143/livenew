<?php
$loc = $items[0]['#location'];
$arr = array();
if (!empty($loc['city'])) {
  $arr[] = $loc['city'];
}
if (!empty($loc['province'])) {
  $arr[] = $loc['province'];
}
if (!empty($loc['postal_code'])) {
  $arr[] = $loc['postal_code'];
}
?>
<div class="location">
  <div class="text-center">
    <a class="btn btn-success get-direction" target="_blank" href="http://maps.google.com?q=<?php echo $loc['latitude']; ?>+<?php echo $loc['longitude']; ?>">Get Directions</a>
  </div>
</div>
