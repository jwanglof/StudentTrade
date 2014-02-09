{% extends "layout.tpl" %}

{% block page_title %}{{ ad.title }}{% endblock %}

{% block content %}
<div id="fb-root"></div>
<script type="text/javascript">(function(d, s, id) {var js, fjs = d.getElementsByTagName(s)[0];if (d.getElementById(id)) return;js = d.createElement(s); js.id = id;js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";fjs.parentNode.insertBefore(js, fjs);}(document, 'script', 'facebook-jssdk'));</script>
<script type="text/javascript">!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
<div class="col-xs-3">

	{# 
		Check if the ad contains any images or not.
		If it doesn't it will just choose the default icon
	#}
	{% if pictures|length > 0 %}
		<div class="uploadedImages">
			{% for picture in pictures %}
				<img src="{{ header.dir }}Upload/{{ picture.filename }}" />
			{% endfor %}
		</div>
		<div class="adImage">
			<img data-toggle="modal" data-target="#showImageModal" src="{{ header.dir }}Upload/{{ pictures[0].filename }}" width="100%" id="imageShown" />
		</div>
	{% else %}
		<p  class="categoryIcon bigIcon icon {{ adCategory.name }}"></p>
	{% endif %}

	<p style="width: 100%; height: 30px; font-size: 1.35em; text-align: center;" class="adType {{ adType.short_name }}">{{ adType.name }}</p>
	<p>
		Pris:
		<br />
		<span class="adShowInfo">{{ ad.price }} SEK</span>
	</p>
	<p>
		Kategori:
		<br />
		<span class="adShowInfo">{{ adCategory.description }}</span>
	</p>
	<p>
		Upplagd:
		<br />
		<span class="adShowInfo">
			{{ ad.date_created|date("Y-m-d") }}
			<br />
			{{ ad.date_created|date("H:i") }}
		</span>
	</p>
	<p>
		{{ adType.name }} av:
		<br />
		<span class="adShowInfo">
			{{ userInfo.name|raw }}
			<br />
			{{ userInfo.phonenumber }}
		</span>
	</p>
	<p>
	{% for info in adInfo %}
		{% for subCat in adSubCategory %}
			{% if info.fk_adInfo_adSubCategory == subCat.id %}
				{{ subCat.name }}:
				<br />
				<span class="adShowInfo">{{ info.sub_category_value|raw }}</span>
				<br />
			{% endif %}
		{% endfor %}
	{% endfor %}
	</p>
</div>
<div class="col-xs-9">
	<h1>{{ ad.title }}</h1>
	{% autoescape false %}
		{{ ad.info }}
	{% endautoescape %}

	<hr />

	<div data-toggle="modal" data-target="#adReplyModal" id="adAnswer">Svara på annonsen</div>

	<div class="row">
		<div class="col-xs-3" data-toggle="modal" data-target="#adReportModal" id="adReport">Anmäl annons</div>
		<div class="col-xs-3" data-toggle="modal" data-target="#adEditModal" id="adEdit">Redigera annons</div>
		<div class="col-xs-3" data-toggle="modal" data-target="#adDeleteModal" id="adDelete">Ta bort annonsen</div>
	</div>
	
	<div class="row" style="margin-top: 30px;">
		<div class="col-xs-7">
			<h4>Få större spridning på sociala medier</h4>
		</div>
		<div class="col-xs-5"><hr /></div>
	</div>

	<div class="row">
		<div class="col-xs-6">
			Välj att dela med dig av din annons på sociala medier. Någon i din vänskapskrets kanske är intresserad!
		</div>
		<div class="col-xs-6">
			<div class="col-xs-6">
				<div class="fb-share-button" data-href="{{ header.current_url }}" data-type="button_count"></div>
			</div>
			<div class="col-xs-6">
				<a href="https://twitter.com/share" class="twitter-share-button" data-url="{{ header.current_url }}" data-via="StudentTrade" data-lang="sv" data-hashtags="annonssäljesköpstudenttrade">Tweeta</a>
			</div>
		</div>
	</div>
</div>

<div class="fade modal" id="showImageModal" tabindex="-1" role="dialog" aria-labelledby="showImageModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body" style="text-align: center;"></div>
		</div>
	</div>
</div>

<div class="fade modal" id="adDeleteModal" tabindex="-1" role="dialog" aria-labelledby="adDeleteModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<h2>Ange annonskod för att ta bort annonsen</h2>
			</div>

			<div class="modal-body">
				<form class="form-horizontal well" data-target="#adDeleteModal" method="post" id="adDeleteForm">
					<input type="hidden" id="update" name="update" value="adActive" />
					<input type="hidden" id="aid" name="aid" value="{{ ad.id }}" />
					<input type="hidden" id="city" name="city" value="{{ header.city.short_name }}" />
					<fieldset>
						<div class="form-group">
							<label for="removeCode" class="col-lg-1 control-label">Ange annonskod</label>
							<div class="col-lg-5">
								<input type="text" class="form-control" id="removeCode" name="removeCode" placeholder="Annonskod" />
							</div>
						</div>
					</fieldset>
				</form>

				<div class="modal-body-error"></div>
			</div>

			<div class="modal-footer">
				<button type="submit" class="btn btn-primary" id="forgotCode">Glömt koden? Tryck här!</button>
				<img src="{{ header.dir }}Img/ajax-loader.gif" class="ajaxLoader" /> <button type="submit" form="adDeleteForm" class="btn btn-primary">Ta bort annons</button>
			</div>
		</div>
	</div>
</div>

<div class="fade modal" id="adReplyModal" tabindex="-1" role="dialog" aria-labelledby="adReplyModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<h2>Svara på annons</h2>
			</div>

			<div class="modal-body">
				<form method="post" class="form-horizontal" role="form" id="adReplyForm">
					<input type="hidden" id="mail" name="mail" value="adReply" />
					<input type="hidden" id="aid" name="aid" value="{{ ad.id }}" />
					<input type="hidden" id="city" name="city" value="{{ header.city.short_name }}" />

					<fieldset>
						<div class="form-group">
							<label for="name" class="col-lg-1 control-label">Ditt namn *</label>
							<div class="col-lg-5">
								<input type="text" class="form-control" id="name" name="name" placeholder="Namn">
							</div>
						</div>

						<div class="form-group">
							<label for="from_email" class="col-lg-1 control-label">Din e-post *</label>
							<div class="col-lg-5">
								<input type="email" class="form-control" name="from_email" id="from_email" placeholder="Din e-post" />
							</div>
						</div>

						<div class="form-group">
							<label for="message" class="col-lg-1 control-label">Ditt meddelande *</label>
							<div class="col-lg-5">
								<textarea class="form-control" name="message" id="message" rows="5"></textarea>
							</div>
						</div>
					</fieldset>
				</form>

				<div class="modal-body-error"></div>
			</div>

			<div class="modal-footer">
				<img src="{{ header.dir }}Img/ajax-loader.gif" class="ajaxLoader" /> <button type="submit" form="adReplyForm" class="btn btn-primary">Skicka meddelandet</button>
			</div>
		</div>
	</div>
</div>

<div class="fade modal" id="adReportModal" tabindex="-1" role="dialog" aria-labelledby="adReportModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<h2>Anmäl annons</h2>
			</div>

			<div class="modal-body">
				<form method="post" class="form-horizontal" role="form" id="adReportForm">
					<input type="hidden" id="mail" name="mail" value="adReport" />
					<input type="hidden" id="aid" name="aid" value="{{ ad.id }}" />

					<fieldset>
						<div class="form-group">
							<label for="message" class="col-lg-1 control-label">Varför anmäler du denna annons? *</label>
							<div class="col-lg-5">
								<textarea class="form-control" name="message" id="message" rows="5"></textarea>
							</div>
						</div>
					</fieldset>
				</form>

				<div class="modal-body-error"></div>
			</div>

			<div class="modal-footer">
				<img src="{{ header.dir }}Img/ajax-loader.gif" class="ajaxLoader" /> <button type="submit" form="adReportForm" class="btn btn-primary">Skicka anmälan</button>
			</div>
		</div>
	</div>
</div>

<div class="fade modal" id="adEditModal" tabindex="-1" role="dialog" aria-labelledby="adEditModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<h2>Ange annonskod för att redigera din annons</h2>
			</div>

			<div class="modal-body">
				<form method="post" class="form-horizontal well" id="adEditForm" data-target="#adEditModal">
					<input type="hidden" id="aid" name="aid" value="{{ ad.id }}" />

					<fieldset>
						<div class="form-group">
							<label for="adCodez" class="col-lg-1 control-label">Ange annonskod</label>
							<div class="col-lg-5">
								<input type="text" class="form-control" name="adCodez" id="adCodez" placeholder="Annonskod" />
							</div>
						</div>
					</fieldset>
				</form>

				<div class="modal-body-error"></div>
			</div>

			<div class="modal-footer">
				<img src="{{ header.dir }}Img/ajax-loader.gif" class="ajaxLoader" /> <button type="submit" form="adEditForm" class="btn btn-primary">Redigera</button>
			</div>
		</div>
	</div>
</div>
{% endblock %}