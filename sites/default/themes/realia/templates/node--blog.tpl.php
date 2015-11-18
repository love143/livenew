<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if ($page) {
  print render($content);
} else if ($teaser) {
  $crt = format_date($created, 'custom', t('j,M,y', array(), array('context' => 'php date format')));
  $day = explode(',', $crt);
  $usr = user_load($uid);
  ?>
  <div class="blog-item-<?php echo $node->nid; ?>">
    <div class="blog-image">
      <?php print render($content['field_image']); ?>
    </div>
    <div class="blog-details">
      <!--    $comment_count-->
      <div class="date-formater-left">
        <span class="day"><?php echo $day[0]; ?></span>
        <span class="month-year"><?php echo $day[1] . ', ' . $day[2]; ?></span>
      </div>
      <div class="title-right">
        <h2><a href="<?php echo url('node/' . $node->nid); ?>"><?php
            $strExp = (strlen($title) > 150) ? '...' : '';
            echo substr($title, 0, 150) . $strExp;
            ?></a></h2>
        <ul class="subStr">
          <li>
            By <span rel="author"><a href="<?php echo url('user/' . $user->uid); ?>"><?php echo $user->name; ?></a></span>
          </li>
          <li class="nmrg"><i class="fa fa-circle"></i></li>
          <li>
            <i class="fa fa-comments-o"></i><i><?php echo $comment_count; ?></i>
          </li>
          <li class="nmrg"><i class="fa fa-circle"></i></li>
          <li>
            <a href="<?php echo url('node/' . $node->nid); ?>"><i class="fa fa-chevron-circle-right"></i>Read More</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <?php
}
/*<header>
              <h2><a href="/content/palm-tree-cove-ii-yorks-best-kept-secret">Palm Tree Cove II, York's Best Kept Secret!</a></h2>
        <span property="dc:title" content="Palm Tree Cove II, York's Best Kept Secret!" class="rdf-meta element-hidden"></span><span property="sioc:num_replies" content="0" datatype="xsd:integer" class="rdf-meta element-hidden"></span>
          <span class="submitted">
                <span property="dc:date dc:created" content="2015-07-10T20:19:15+02:00" datatype="xsd:dateTime" rel="sioc:has_creator">Submitted by <span class="username" xml:lang="" about="/users/admin" typeof="sioc:UserAccount" property="foaf:name" datatype="">Admin</span> on Fri, 07/10/2015 - 20:19</span>      </span>
      </header> */