{% extends "layout.tpl" %}

{% block page_title %}Senaste annonserna från {{ header.city.city_name }}{% endblock %}

{% block content %}
	<div class="col-xs-12 categoryHeading" style="background-color: {{ adCategory.color }}">
		{{ adCategory.description }}
	</div>
	<div class="col-xs-12 categoryHeading search">
		<div class="row">
			<form action="front.php" method="get">
				<input type="hidden" name="city" value="{{ header.city.short_name }}" />
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
				<a href="#">
				<div class="col-xs-1 categoryIcon icon {{ ad.category.name }}"></div>
					<div class="col-xs-4 newAdInfo">
						<h4>{{ ad.adTitleLimited }}</h4>
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
		<?php foreach ($this->ads as $ad): ?>
			<div class="latestAd">
				<a href="<?php echo $ad["url"]; ?>">
					<div class="col-xs-1 categoryIcon icon <?php $this->eprint($ad["categoryName"]); ?>"></div>
					<div class="col-xs-4 newAdInfo">
						<h4><?php echo $this->eprint($ad["adTitleLimited"]); ?></h4>
					</div>
					<div class="col-xs-3 newAdInfo">
						<span class="adType <?php echo $this->eprint($ad["adType"]["short_name"]); ?>"><?php echo $this->eprint($ad["adType"]["name"]); ?></span>
						<span class="where"><?php echo $this->eprint($ad["campus"]["campus_name"]); ?></span>
					</div>
					<div class="col-xs-2 newAdInfo date"><?php echo $this->eprint($ad["dateCreated"]); ?></div>
					<div class="col-xs-2 newAdInfo price"><?php echo $this->eprint($ad["price"]); ?> SEK</div>
				</a>
			</div>
		<?php endforeach; ?>
		<div class="pagination">
			<ul class="pagination">
				<?php echo $this->paginationPrevPage; ?>
				<?php foreach ($this->paginationPages as $pageNo): ?>
					<?php echo $pageNo; ?>
				<?php endforeach; ?>
				<?php echo $this->paginationNextPage; ?>
			</ul>
		</div>
	</div>
{% endblock %}