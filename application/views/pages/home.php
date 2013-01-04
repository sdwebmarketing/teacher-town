<h1>Home</h1>

<?php 
$attributes = array('method' => 'get');
echo form_open('search-listings',$attributes); ?>
	<input type="text" id="addressInput" name="pc" />
	<select name="radius" id="radiusSelect">
		<option value="2">2 miles</option>
		<option value="5">5 miles</option>
		<option value="10">10 miles</option>
		<option value="25">25 miles</option>
		<option value="50">50 miles</option>
		<option value="100">100 miles</option>
	</select>
	<input type="submit" class="searchLocations looseDefaults" id="searchLocations" value="Search" />
	<input type="submit" class="useLocation looseDefaults" value="Use my location" />
</form>