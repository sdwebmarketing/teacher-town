<?php $attributes = array('method' => 'get','class' => 'ajaxForm');
$radiusOptions = array(
		'2'  => '2 miles',
		'5'  => '5 miles',
		'10' => '10 miles',
		'25' => '25 miles',
		'50' => '50 miles',
		'100' => '100 miles',
);

echo form_open('search-listings',$attributes); ?>
	<input type="text" id="addressInput" name="address" />
	<?php echo form_dropdown('radius', $radiusOptions, '5', 'id="radiusSelect"'); ?>
	<input type="button" class="searchLocations looseDefaults" id="searchLocations" value="Search" />
	<input type="hidden" id="lat" name="lat" />
	<?php echo form_error('lat'); ?>
	<input type="hidden" id="lng" name="lng" />
	<?php echo form_error('lng'); ?>
	<input type="submit" class="useLocation looseDefaults" value="Use my location" />
<?php echo form_close(); ?>