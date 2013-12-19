{% extends "layout.tpl" %}

{% block page_title %}Lägg in bilder{% endblock %}

{% block add_scripts %}
	<script src="{{ header.dir }}Scripts/forms.js" type="text/javascript"></script>
	<script src="{{ header.dir }}Scripts/addNew.js" type="text/javascript"></script>
{% endblock %}

{% block content %}
<form method="post" enctype="multipart/form-data" class="form-horizontal" role="form" id="addNewAd">
	<input type="hidden" id="mail" name="mail" value="adAddNew" />
	<div id="pictureInputs">
		<div class="form-group">
			<div id="addMorePictures" class="col-xs-8">
				Du kan maximalt ha 5st bilder.
				<br />
				Tryck för att lägga till fler bilder.
			</div>
		</div>

		<div class="form-group">
			<label for="picture" class="col-xs-1 control-label">Bild #1</label>
			<div class="col-xs-3">
				<input type="file" name="picture_1" id="picture_1" />
			</div>
		</div>
	</div>

	<div class="form-group">
		<div class="col-xs-3">
			<button id="uploadImagesButton">Ladda upp bild</button>
		</div>
	</div>

	<div class="uploadProgress2"></div>

	<div class="form-group" id="errorMsg">
		<label for="info" class="col-xs-1 control-label">Felmeddelande:</label>
		<div class="col-xs-5"></div>
	</div>
	
	<button type="submit" class="btn btn-primary btn-sm">Lägg upp annons</button>
	<img src="{{ header.dir }}Img/ajax-loader.gif" class="ajaxSubmit" />
</form>
{% endblock %}