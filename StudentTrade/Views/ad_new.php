<?php
?>
<div class="col-xs-12" style="color: #464646;">
	<form method="post" action="ad.php?page=ad_add" class="form-horizontal" role="form">
		<fieldset>
			<legend>Personuppgifter</legend>

			<div class="form-group">
				<label for="name" class="col-lg-1 control-label">Namn *</label>
				<div class="col-lg-5">
					<input type="text" class="form-control" id="name" name="name" placeholder="Namn">
				</div>
			</div>

			<div class="form-group">
				<label for="email" class="col-lg-1 control-label">E-post *</label>
				<div class="col-lg-5">
					<input type="email" class="form-control" id="email" name="email" placeholder="E-post">
				</div>
			</div>

			<div class="form-group">
				<label for="city" class="col-lg-1 control-label">Stad *</label>
				<div class="col-lg-5">
					<select id="city" name="city" class="form-control">
						<?php
						foreach ($dbh->getCityIDs() as $value) {
							$selected = "";
							if (isset($_GET["city"])) {
								if ($_GET["city"] == $value["short_name"])
									$selected = "selected";
							}
							echo "<option value=\"". $value["id"] ."\" $selected>". $value["city_name"] ."</option>";
						}
						?>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label for="campus" class="col-lg-1 control-label">Campus</label>
				<div class="col-lg-5">
					<select id="campus" name="campus" class="form-control">
						<?php
						// foreach ($dbh->getCampuses() as $value) {
						// 	$selected = "";
						// 	if (isset($_GET["campus"])) {
						// 		if ($_GET["campus"] == $value["short_name"])
						// 			$selected = "selected";
						// 	}
						// 	echo "<option value=\"". $value["id"] ."\" $selected>". $value["campus_name"] ."</option>";
						// }
						?>
					</select>
				</div>
			</div>


			<legend>Annonsuppgifter</legend>

			<div class="form-group">
				<label for="info" class="col-lg-1 control-label">Beskrivning *</label>
				<div class="col-lg-5">
					<textarea id="info" name="info" class="form-control" style="width: 100%; height: 200px;"></textarea>
				</div>
			</div>

			<div class="form-group">
				<label for="city" class="col-lg-1 control-label">Typ av annons *</label>
				<div class="col-lg-5">
					<select id="adType" name="adType" class="form-control">
						<option value="0">Typ av annons</option>
						<?php
						foreach ($dbh->getAdTypes() as $value) {
							$selected = "";
							if (isset($_GET["type"])) {
								if ($_GET["type"] == $value["name"])
									$selected = "selected";
							}
							echo "<option value=\"". $value["id"] ."\" $selected>". $value["description"] ."</option>";
						}
						?>
					</select>
				</div>
			</div>

			<div class="form-group" id="adInput"></div>


			<button type="submit" class="btn btn-primary btn-sm">Lägg till annons</button>
			<button type="reset" class="btn btn-default btn-sm">Rensa alla fält</button>
		</fieldset>
	</form>
</div>