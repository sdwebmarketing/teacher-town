<h1>Home</h1>

<?php 
$attributes = array('method' => 'get');
echo form_open('search-listings',$attributes); ?>

<input type="text" name="pc" />
<input type="submit" value="Submit" />

</form>