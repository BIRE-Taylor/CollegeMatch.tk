<div class="head">
	<div class="headtitle">College Match</div>
	<div id="centeredmenu">
		<?php if(!(strstr($_SERVER[REQUEST_URI],"login.php") || strstr($_SERVER[REQUEST_URI],"register.php"))) { ?>
		<ul>
			<li><a href="#">Find College</a>
				<ul>
					<li><a href="./?body=search">College Search</a></li>
				</ul>
			</li>
			<li><a href="#">Profile</a>
				<ul>
					<li><a href="./?body=profile">Access profile</a></li>
				</ul>
			</li>
		</ul>
		<?php }?>
	</div>
</div>
