<?php 

$formAttributes = array('method' => 'get','class' => 'redirectForm');

// setup radius select
$radiusOptions = array(
	'2'  => '2 miles',
	'5'  => '5 miles',
	'10' => '10 miles',
	'25' => '25 miles',
	'50' => '50 miles',
	'100' => '100 miles',
);

// load and setup instrument select
$instruments = $this->users_model->get_instruments();
$instrumentsArr['0'] = "Any";
foreach ($instruments->result_array() as $instrument) {
	$instrumentsArr[$instrument["id"]] = $instrument["name"];
}

echo form_open('search-listings',$formAttributes); ?>
	<input type="text" id="addressInput" name="address" />
	<?php echo form_dropdown('radius', $radiusOptions, '5', 'id="radiusSelect"'); 
	echo form_dropdown('instruments', $instrumentsArr, '', 'id="instrumentSelect"'); ?>
	<input type="submit" class="searchLocations looseDefaults" id="searchLocations" value="Search" />
	<input type="hidden" id="lat" name="lat" />
	<?php echo form_error('lat'); ?>
	<input type="hidden" id="lng" name="lng" />
	<?php echo form_error('lng'); ?>
	<input type="button" class="useLocation looseDefaults" value="Use my location" />
<?php echo form_close(); ?>