<?php echo $this->header; ?>

<div class="content">		
	<div class="row">
		<div class="col-xs-8">
			<?php echo $this->showPage; ?>
		</div>
		<div class="col-xs-4 rightColumn">
			<?php include_once("../Templates/right_column.php"); ?>
		</div>
	</div>
</div>

<?php echo $this->footer; ?>