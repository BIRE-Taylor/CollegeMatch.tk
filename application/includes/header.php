<div id="clickScreen" class="hidden">

</div>
<div class="search hidden" >
	<input type="text" name="search" oninput="preformSearch($(this));" style="margin-top: 5px;">
</div>
<div id="userInfo" class="hidden">
	<?php include(APP_DIR.'includes/userInfo.php'); ?>
</div>
<nav> <!-- Static -->
	<?php include(APP_DIR.'includes/navBar.php'); ?>
</nav>
<nav class="showhide">
	&#x25BC;
</nav>
<nav class="showhide-cover">
	
</nav>
<nav id="fixed-nav"> <!-- Fixed -->
	<?php include(APP_DIR.'includes/navBar.php'); ?>
</nav>
