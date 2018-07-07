<?php
	if(isset($_SESSION["alert"])) {	?>
		<div class="uk-alert-warning">
			<?php echo $_SESSION["alert"]; ?>
		</div>
		<?php
		unset($_SESSION["alert"]);
		 }
		?>