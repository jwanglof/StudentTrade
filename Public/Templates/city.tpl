{% extends "layout.tpl" %}

{% block page_title %}Senaste annonserna från {{ header.city.city_name }}{% endblock %}

{% block content %}
	<div class="col-xs-12 categoryHeading" style="background-color: {{ adCategory.color }}">
		{{ adCategory.description }}
	</div>
	<div class="col-xs-12 categoryHeading search">
		<div class="row">
			<form action="/index.php/city/{{ header.city.short_name }}/search" method="post">
				<div class="input-group">
					<input type="text" class="form-control" name="searchString" placeholder="Sök på annonstitel">
					<span class="input-group-btn">
						<button type="submit" class="btn btn-default">Sök!</button>
					</span>
				</div>
			</form>
		</div>
	</div>
	<div class="row" id="latestAd">
		{% for ad in ads %}
			<div class="latestAd">
				<a href="{{ header.base_url }}/ad/{{ ad.id }}">
					<div class="col-xs-1 categoryIcon icon {{ ad.category.name }}"></div>
					<div class="col-xs-4 newAdInfo">
						<h4>{{ ad.adTitleLimited|raw }}</h4>
					</div>
					<div class="col-xs-3 newAdInfo">
						<span class="adType {{ ad.adType.short_name }}">{{ ad.adType.name }}</span>
						<span class="where">{{ ad.campus.campus_name }}</span>
					</div>
					<div class="col-xs-2 newAdInfo date">{{ ad.dateCreated }}</div>
					<div class="col-xs-2 newAdInfo price">{{ ad.price }} SEK</div>
				</a>
			</div>
		{% endfor %}
		<div class="pagination">
			<ul class="pagination">
				{% autoescape false %}
					{{ paginationPrevPage }}
					{% for pageNo in paginationPages %}
						{{ pageNo }}
					{% endfor %}
					{{ paginationNextPage }}
				{% endautoescape %}
			</ul>
		</div>
	</div>
{% endblock %}