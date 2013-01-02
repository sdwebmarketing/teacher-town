<?php
	$teacher = $teacher->result_array();
	if (empty($teacher)) {
	echo "<h1>No results to display</h1>";
} else { foreach ($teacher as $row) { ?>
		<h1><?php echo $row['name']; ?></h1>
		<p><?php echo $row['bio']; ?></p> 
<?php }; }; ?>