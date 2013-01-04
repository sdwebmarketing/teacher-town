<?php

class Search_model extends CI_model {
	
	public function get_teacher($id = "")
	{
		if (!empty($id)) {
			$sql = $this->db->query('select * from users where id=' . $id);
			return $sql;
		}
	}
	
	public function build_search_query($lat, $lng, $radius = 10, $instrumentIds = "")
	{
		// alias column names
		$userLocationId = 'userLocationId';
		
		// select columns
		$this->db->select("
			locations.id as locationId,
			locations.address,
			locations.name AS locationName,
			locations.lat,
			locations.lng,
			users.id as userId,
			users.name,
			users.locationId as " . $userLocationId, FALSE);
		
		// selects range using haversine formula
		$distance_select = sprintf(
				"( 3959 * acos( cos( radians(%s) ) " .
				" * cos( radians( lat ) ) " .
				" * cos( radians( lng ) - radians(%s) ) " .
				" + sin( radians(%s) ) * sin( radians( lat ) ) " .
				") " .
				") " .
				"AS distance",
				$lat,
				$lng,
				$lat
		);
		
		// select instruments if param not empty
		if (!empty($instrumentIds) && $instrumentIds != 0) {
			$this->db->select("users.instrumentIds", FALSE);
		}
		
		// add distance field to select
		$this->db->select($distance_select, FALSE);
		
		// params
		$this->db->from('locations,users', FALSE);
		$this->db->having('distance <',$radius, FALSE);
		$this->db->having('locationId = users.locationId', FALSE);
		
		// select instruments if param not empty
		if (!empty($instrumentIds) && $instrumentIds != 0) {
			$this->db->having('users.instrumentIds =', $instrumentIds, FALSE);
		}
		
		// sort and limit
		$this->db->order_by('distance','asc', FALSE);
		$this->db->limit(20,0, FALSE);
		
		return $this->db->get();
		
	}
	
	public function get_teachers_by_location_r_xml() {
		$lat=$this->input->get('lat');
		$lng=$this->input->get('lng');
		$radius=$this->input->get('radius');
		$instrumentIds=$this->input->get('instruments');
		
		// Start XML file, create parent node
		$dom = new DOMDocument("1.0");
		$node = $dom->createElement("markers");
		$parnode = $dom->appendChild($node);
		
		// Run query and return results object
		$result = $this->build_search_query($lat, $lng, $radius, $instrumentIds);
		
		header("Content-type: text/xml");
		
		// Iterate through the rows, adding XML nodes for each
		foreach ($result->result_array() as $row) {
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
		
		//echo $this->db->last_query($result); for testing purposes
		echo $dom->saveXML();
	}
}