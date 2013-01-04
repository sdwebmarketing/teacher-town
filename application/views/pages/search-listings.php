<section class="listingsArea">
	<h1><?php echo lang("site_search_list_heading"); ?></h1>
	<p><a href="<?php echo site_url("search-listings"); ?>" class="current"><?php echo lang("site_list_view_txt"); ?></a> |
	<a href="<?php echo site_url("search-results-map"); ?>"><?php echo lang("site_map_view_txt"); ?></a></p>
	<div class="listings">
		<div class="hidden forAjax"></div>
		<?php foreach($teachers->result_array() as $teacher) { ?>
			<div class="teacherItem">
				<h2><a href="<?php echo site_url("teacher"); ?>/<?php echo $teacher['name']; ?>/<?php echo $teacher['id']; ?>"><?php echo $teacher['name']; ?></a></h2>
			</div>
		<?php }; ?>
	</div>

	<?php 
	$attributes = array('method' => 'get');
	echo form_open('search-listings',$attributes); ?>
		<input type="text" id="addressInput" name="pc" />
		<select id="radiusSelect">
			<option value="2">2 miles</option>
			<option value="5">5 miles</option>
			<option value="10">10 miles</option>
			<option value="25">25 miles</option>
			<option value="50">50 miles</option>
			<option value="100">100 miles</option>
		</select>
		<input type="button" class="searchLocations looseDefaults" id="searchLocations" value="Search" />
		<input type="submit" class="useLocation looseDefaults" value="Use my location" />
	</form>
	
	<div>
		<select id="locationSelect" style="width:100%;visibility:hidden"></select>
	</div>
</section>
<section class="mapArea">
	<div id="map" style="width: 100%; height: 500px;"></div>
</section>