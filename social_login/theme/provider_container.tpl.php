<?php

/**
 * @file
 * Container in which the social network icons are displayed.
 */

?>
<div class="social_login" style="margin:20px 0 10px 0">
 <?php echo (!empty($label) ? '<label>' . filter_xss($label) . '</label>' : ''); ?>
 <div id="<?php echo filter_xss($containerid); ?>"></div>
</div>
