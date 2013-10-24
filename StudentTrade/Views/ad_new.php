<?php
$dbh = new DbSelect();

$cities = $dbh->getCityIDs();
$adCategories = $dbh->getAdCategories();
$adTypes = $dbh->getAdTypes();
$adSubCategories = $dbh->getAdSubCategories();

$dbh = null;
?>
<div class="col-xs-12 addMargin">
	<form method="post" action="front.php?page=ad_add" class="form-horizontal" role="form">
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
				<label for="phonenumber" class="col-lg-1 control-label">Telefonnummer</label>
				<div class="col-lg-5">
					<input type="text" class="form-control" id="phonenumber" name="phonenumber" placeholder="Telefonnummer">
				</div>
			</div>

			<div class="form-group">
				<label for="city" class="col-lg-1 control-label">Stad *</label>
				<div class="col-lg-5">
					<select id="city" name="city" class="form-control">
						<?php
						foreach ($cities as $value) {
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
					</select>
				</div>
			</div>


			<legend>Annonsuppgifter</legend>

			<div id="adInfo">
				<div class="form-group">
					<label for="adType" class="col-lg-1 control-label">Typ av annons *</label>
					<div class="col-lg-5">
						<select id="adType" name="adType" class="form-control">
							<?php
							foreach ($adTypes as $value) {
								echo "<option value=\"". $value["id"] ."\">". $value["name"] ."</option>";
							}
							?>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label for="title" class="col-lg-1 control-label">Rubrik *</label>
					<div class="col-lg-5">
						<input type="text" class="form-control" id="title" name="title" placeholder="Rubrik">
					</div>
				</div>

				<div class="form-group">
					<label for="info" class="col-lg-1 control-label">Beskrivning *</label>
					<div class="col-lg-5">
						<textarea id="info" name="info" class="form-control" style="width: 100%; height: 200px;"></textarea>
					</div>
				</div>
			</div>

			<div id="adExtraInfo">
				<div class="form-group">
					<label for="price" class="col-lg-1 control-label">Pris (SEK) *</label>
					<div class="col-lg-5">
						<input type="number" class="form-control" id="price" name="price" value="0" placeholder="Pris">
					</div>
				</div>
			</div>

			<div class="form-group">
				<label for="adCategory" class="col-lg-1 control-label">Kategori *</label>
				<div class="col-lg-5">
					<select id="adCategory" name="adCategory" class="form-control">
						<option value="0">Kategori</option>
						<?php
						foreach ($adCategories as $value) {
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

			<div id="adInput">
			<?php
			foreach ($adSubCategories as $key => $value) {
			?>
				<div class="form-group <?php echo $value['fk_adTypeInfo_adCategory']; ?>">
					<label for="<?php echo $value['short_name']; ?>" class="col-lg-1 control-label"><?php echo $value['name']; ?></label>
					<div class="col-lg-5">
						<input type="text" class="form-control" id="<?php echo $value['short_name']; ?>" name="<?php echo $value['short_name']; ?>" placeholder="<?php echo $value['name']; ?>">
					</div>
				</div>
			<?php
			}
			?>
			</div>

			<button type="submit" class="btn btn-primary btn-sm">Lägg upp annons</button>
			<button type="reset" class="btn btn-default btn-sm">Rensa alla fält</button>
		</fieldset>
	</form>
</div>