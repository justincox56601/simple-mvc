<?php
include_once(ABS_PATH . '/' . 'src/views/head.view.php');
include_once(ABS_PATH . '/' . 'src/views/head.view.php');
?>
<div>
	<p><?= $page->get_title()?></p>
	<p><?= $page->get_content()?></p>
	<p><?= $page->get_author()?></p>
</div>
<?php
include_once(ABS_PATH . '/' . 'src/views/footer.view.php');