<?php
include_once(ABS_PATH . '/' . 'src/views/head.view.php');
include_once(ABS_PATH . '/' . 'src/views/head.view.php');
?>
<div>
	<h1>Welcome to this test MVC site</h1>
	<p>This demo is to help show how to use the MVC pattern to build a website.</p>
	<p>Up until now, you have had to create a new page for every page you wanted to display on your website.  Even though many times those pages looked exactly the same except for the content on them.  At first, we abstracted out the views and made them reusable.  That was a big step.  But now that we have learned a little bit more about object oriented programming, we can take it to another level.</p>
	<p>There are 4 pages I have built for this demo site.  /hippo, /jaguar, /dog, /cat.  The first thing you will notice is that ther are no PHP files for those specifi pages.  Instead, the custom RouterService, reads the url you are trying to go to, and selects the best controller to fill that request.  From there, the controller, selects the view needed, asks its service to get the data for the page, and then displays that information on the screen.  You will also notice, that the address is not longer  /mypage.php but rather /mypage.</p>
	<p>The benefit of this setup, is that I no longer need to make a new page for each piece of content I want to make.  All I need to do, is make an entry in the the database, and my website will know how to locate it and display it.</p>
	<p>Start with the index.php file and follow through the code to get a sense of what each file is doing, and how it plays in the larger scheme of things.</p>
</div>
<?php
include_once(ABS_PATH . '/' . 'src/views/footer.view.php');