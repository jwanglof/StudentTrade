{% extends "layout.tpl" %}

{% block page_title %}Redigera {{ ad.title }}{% endblock %}

{% block add_scripts %}
	<script src="{{ header.dir }}Scripts/addNew.js" type="text/javascript"></script>
{% endblock %}

{% block content %}
<form method="post" enctype="multipart/form-data" class="form-horizontal" role="form" id="editAdForm">
	<input type="hidden" id="aid" name="aid" value="{{ ad.id }}" />
	<fieldset>
		<legend>Personuppgifter</legend>
		<div class="form-group">
			<label for="name" class="col-xs-1 control-label">Namn *</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" id="name" name="name" placeholder="Namn" disabled value="{{ userInfo['name'] }}">
			</div>
		</div>

		<div class="form-group">
			<label for="email" class="col-xs-1 control-label">E-post *</label>
			<div class="col-xs-5">
				<input type="email" class="form-control" id="email" name="email" placeholder="E-post" disabled value="{{ userInfo['email'] }}">
			</div>
		</div>

		<div class="form-group">
			<label for="phonenumber" class="col-xs-1 control-label">Telefonnummer</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" id="phonenumber" name="phonenumber" placeholder="Telefonnummer" value="{{ userInfo['phonenumber'] }}">
			</div>
		</div>

		<div class="form-group">
			<label for="city" class="col-xs-1 control-label"><img src="{{ header.dir }}Img/ajax-loader.gif" class="ajaxLoader ajaxCity" /> Stad *</label>
			<div class="col-xs-5">
				<select id="city" name="city" class="form-control">
					{% for city in header.cities %}
						{# IF THE CHOSEN CITY IS EQUAL TO THE LOOPED CITY IT WILL BE CHOSEN #}
						{% if ad.fk_ad_city == city.id %}
							<option value="{{ city.id }}" selected>{{ city.city_name }}</option>
						{% else %}
							<option value="{{ city.id }}">{{ city.city_name }}</option>
						{% endif %}
					{% endfor %}
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
		<div class="form-group">
			<label for="adType" class="col-xs-1 control-label">Typ av annons *</label>
			<div class="col-xs-5">
				<select id="adType" name="adType" class="form-control">
					{% for type in adTypes %}
						{% if ad["fk_ad_adType"] == type.id %}
							<option value="{{ type.id }}" selected>{{ type.name }}</option>
						{% else %}
							<option value="{{ type.id }}">{{ type.name }}</option>
						{% endif %}
					{% endfor %}
				</select>
			</div>
		</div>

		<div class="form-group">
			<label for="adCategory" class="col-xs-1 control-label"><img src="{{ header.dir }}Img/ajax-loader.gif" class="ajaxLoader ajaxCategory" /> Kategori *</label>
			<div class="col-xs-5">
				<select id="adCategory" name="adCategory" class="form-control">
					<option>Kategori</option>
					{% for category in adCategories %}
						{% if ad["fk_ad_adCategory"] == category.id %}
							<option value="{{ category.id }}" selected>{{ category.description }}</option>
						{% else %}
							<option value="{{ category.id }}">{{ category.description }}</option>
						{% endif %}
					{% endfor %}
				</select>
			</div>
		</div>

		<div class="form-group" id="adInput"></div>

		<div id="adExtraInfo">
			<div class="form-group">
				<label for="price" class="col-xs-1 control-label">Pris (SEK) *</label>
				<div class="col-xs-5">
					<input type="number" max="9999999" class="form-control" id="price" name="price" value="{{ ad['price'] }}" placeholder="Pris">
				</div>
			</div>
		</div>

		<div class="form-group">
			<label for="adTitle" class="col-xs-1 control-label">Rubrik *</label>
			<div class="col-xs-5">
				<input type="text" class="form-control" id="adTitle" name="adTitle" placeholder="Rubrik" value="{{ ad['title'] }}">
			</div>
		</div>

		<div class="form-group">
			<label for="adInfo" class="col-xs-1 control-label">Beskrivning *</label>
			<div class="col-xs-5">
				<textarea id="adInfo" name="adInfo" class="form-control">{{ ad['info'] }}</textarea>
			</div>
		</div>

		<div class="form-group" id="errorMsg">
			<label for="info" class="col-xs-1 control-label">Felmeddelande:</label>
			<div class="col-xs-5"></div>
		</div>

		<button type="submit" class="btn btn-primary btn-sm" id="editAdButton">Ändra annons</button>
	</fieldset>
</form>
{% endblock %}