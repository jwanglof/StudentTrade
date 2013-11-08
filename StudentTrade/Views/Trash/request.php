<?php
if (isset($_GET)) {
	if ($_GET["request"] == "campus") {
?>
	<form action="front.php" method="post" class="form-horizontal" role="form" id="requestCampusForm">
		<input type="hidden" id="mail" name="mail" value="requestCampus" />
		<fieldset>
			<legend>Förfråga att lägga till campus</legend>
			<div class="form-group">
				<label for="campus_name" class="col-lg-1 control-label">Namn på campus *</label>
				<div class="col-lg-5">
					<input type="text" class="form-control" id="campus_name" name="campus_name" placeholder="Campusnamn" />
				</div>
			</div>
			<div class="form-group">
				<label for="city_name" class="col-lg-1 control-label">Ligger i stad *</label>
				<div class="col-lg-5">
					<input type="text" class="form-control" id="city_name" name="city_name" placeholder="Stadsnamn" />
				</div>
			</div>
			<button type="submit" class="btn btn-primary btn-sm">Skicka förfrågan</button>
			<button type="reset" class="btn btn-default btn-sm">Rensa alla fält</button>
		</fieldset>
	</form>
<?php
	}
}
?>