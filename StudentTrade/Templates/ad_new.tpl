<div class="col-xs-12">
	<form method="post" action="front.php?page=ad_add" class="form-horizontal" role="form" id="addNewAd">
		<input type="hidden" id="mail" name="mail" value="adAddNew" />
		<fieldset>
			<legend>Personuppgifter</legend>

			<div class="form-group">
				<label for="name" class="col-xs-1 control-label">Namn *</label>
				<div class="col-xs-5">
					<input type="text" class="form-control" id="name" name="name" placeholder="Namn">
				</div>
			</div>

			<div class="form-group">
				<label for="email" class="col-xs-1 control-label">E-post *</label>
				<div class="col-xs-5">
					<input type="email" class="form-control" id="email" name="email" placeholder="E-post">
				</div>
			</div>

			<div class="form-group">
				<label for="phonenumber" class="col-xs-1 control-label">Telefonnummer</label>
				<div class="col-xs-5">
					<input type="text" class="form-control" id="phonenumber" name="phonenumber" placeholder="Telefonnummer">
				</div>
			</div>

			<div class="form-group">
				<label for="city" class="col-xs-1 control-label"><img src="StudentTrade/Img/ajax-loader.gif" class="ajaxLoader ajaxCity" /> Stad *</label>
				<div class="col-xs-5">
					<select id="city" name="city" class="form-control">
						<?php foreach ($this->cities as $city): ?>
							<?php echo $city; ?>
						<?php endforeach; ?>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label for="campus" class="col-xs-1 control-label">Campus</label>
				<div class="col-xs-5">
					<select id="campus" name="campus" class="form-control">
					</select>
				</div>
			</div>


			<legend>Annonsuppgifter</legend>

			<div id="adInfo">
				<div class="form-group">
					<label for="adType" class="col-xs-1 control-label">Typ av annons *</label>
					<div class="col-xs-5">
						<select id="adType" name="adType" class="form-control">
							<?php foreach ($this->adTypes as $type): ?>
								<?php echo $type; ?>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
			</div>

			<div class="form-group">
				<label for="adCategory" class="col-xs-1 control-label"><img src="StudentTrade/Img/ajax-loader.gif" class="ajaxLoader ajaxCategory" /> Kategori *</label>
				<div class="col-xs-5">
					<select id="adCategory" name="adCategory" class="form-control">
						<option value="">Kategori</option>
						<?php foreach ($this->adCategories as $category): ?>
							<?php echo $category; ?>
						<?php endforeach; ?>
					</select>
				</div>
			</div>

			<div id="adExtraInfo">
				<div class="form-group">
					<label for="price" class="col-xs-1 control-label">Pris (SEK) *</label>
					<div class="col-xs-5">
						<input type="number" max="9999999" class="form-control" id="price" name="price" value="0" placeholder="Pris">
					</div>
				</div>
			</div>

			<div class="form-group">
				<label for="title" class="col-xs-1 control-label">Rubrik *</label>
				<div class="col-xs-5">
					<input type="text" class="form-control" id="title" name="title" placeholder="Rubrik">
				</div>
			</div>

			<div class="form-group">
				<label for="info" class="col-xs-1 control-label">Beskrivning *</label>
				<div class="col-xs-5">
					<textarea id="info" name="info" class="form-control"></textarea>
				</div>
			</div>

			<div class="form-group" id="errorMsg">
				<label for="info" class="col-xs-1 control-label">Felmeddelande:</label>
				<div class="col-xs-5"></div>
			</div>

			<button type="submit" class="btn btn-primary btn-sm">Lägg upp annons</button>
			<button type="reset" class="btn btn-default btn-sm">Rensa alla fält</button>

			<img src="StudentTrade/Img/ajax-loader.gif" class="ajaxSubmit" />
		</fieldset>
	</form>
</div>