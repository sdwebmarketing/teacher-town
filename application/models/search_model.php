<?php

class Search_model extends CI_model {
	
	public function get_teacher($id = "")
	{
		if (!empty($id)) {
			$sql = $this->db->query('select * from users where id=' . $id);
			return $sql;
		}
	}
	
	public function get_teachers() 
	{	
		$sql = $this->db->query('select * from users where userTypeId = 1 order by name');
		return $sql;
	}
	
	public function get_teachers_by_location_r_xml() {
		$center_lat=$this->input->get('lat');
		$center_lng=$this->input->get('lng');
		$radius=$this->input->get('radius');
		if(empty($radius)) {
			$radius=10;
		}
			
		// Start XML file, create parent node
		$dom = new DOMDocument("1.0");
		$node = $dom->createElement("markers");
		$parnode = $dom->appendChild($node);
			
		// Search the rows in the markers table
		$query = sprintf("SELECT locations.id as locationId, locations.address, locations.name AS locationName, locations.lat, locations.lng, users.id as userId, users.name, users.locationId, ( 3959 * acos( cos( radians('%s') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('%s') ) + sin( radians('%s') ) * sin( radians( lat ) ) ) ) AS distance FROM locations, users HAVING distance < '%s' AND locations.id = users.locationId ORDER BY distance LIMIT 0 , 20",
			mysql_real_escape_string($center_lat),
			mysql_real_escape_string($center_lng),
			mysql_real_escape_string($center_lat),
			mysql_real_escape_string($radius));
			$sql = $this->db->query($query);
			
		$result = mysql_query($query);
		if (!$result) {
			die("Invalid query: " . mysql_error());
		}
		
		header("Content-type: text/xml");
		
		// Iterate through the rows, adding XML nodes for each
		while ($row = @mysql_fetch_assoc($result)){
			$node = $dom->createElement("marker");
			$newnode = $parnode->appendChild($node);
			$newnode->setAttribute("name", $row['name']);
			$newnode->setAttribute("userId", $row['userId']);
			$newnode->setAttribute("locationName", $row['locationName']);
			$newnode->setAttribute("address", $row['address']);
			$newnode->setAttribute("lat", $row['lat']);
			$newnode->setAttribute("lng", $row['lng']);
			$newnode->setAttribute("distance", $row['distance']);
		}
		
		echo $dom->saveXML();
		
	}
}