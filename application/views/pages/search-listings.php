<section class="listingsArea">
	<?php $this->load->view('templates/search-ajax.php'); ?>
	<h1><?php echo lang("site_search_list_heading"); ?></h1>
	<p><a href="<?php echo site_url("search-listings"); ?>" class="current"><?php echo lang("site_list_view_txt"); ?></a> |
	<a href="<?php echo site_url("search-results-map"); ?>"><?php echo lang("site_map_view_txt"); ?></a></p>
	<div class="listings">
		<div class="hidden forAjax"></div>
	</div>
	<div>
		<select id="locationSelect" style="width:100%;visibility:hidden"></select>
	</div>
</section>
<section class="mapArea">
	<div id="map" style="width: 100%; height: 500px;"></div>
</section>