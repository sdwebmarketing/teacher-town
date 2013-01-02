<?php
class Locations_model extends CI_model {
	
	function get_nearest_teachers() 
	{
		// Get parameters
		$center_lat = $_GET["lat"];
		$center_lng = $_GET["lng"];
		$radius = $_GET["radius"];
		
		// Start XML file, create parent node
		$dom = new DOMDocument("1.0");
		$node = $dom->createElement("markers");
		$parnode = $dom->appendChild($node);
		
		// Format sql
		$query = sprintf("SELECT address, name, lat, lng, ( 3959 * acos( cos( radians('%s') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('%s') ) + sin( radians('%s') ) * sin( radians( lat ) ) ) ) AS distance FROM locations HAVING distance < '%s' ORDER BY distance LIMIT 0 , 20",
		mysql_real_escape_string($center_lat),
		mysql_real_escape_string($center_lng),
		mysql_real_escape_string($center_lat),
		mysql_real_escape_string($radius));
		
		$sql = $this->db->query($query);
		
		if (!$sql) {
			die("Invalid query: " . mysql_error());
		}
		
		header("Content-type: text/xml");
		
		// Iterate through the rows, adding XML nodes for each
		while ($row = @mysql_fetch_assoc($sql)){
			$node = $dom->createElement("marker");
			$newnode = $parnode->appendChild($node);
			$newnode->setAttribute("name", $row['name']);
			$newnode->setAttribute("address", $row['address']);
			$newnode->setAttribute("lat", $row['lat']);
			$newnode->setAttribute("lng", $row['lng']);
			$newnode->setAttribute("distance", $row['distance']);
		}
		
		return $dom->saveXML();
	}
	
}