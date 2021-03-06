<?php
Class System extends CI_Model {

	/* Returns current position in queue algorithm.
	 */
	function getCurrentPosition() {
		$this->db->select('CURRENT_POSITION');
		$this->db->where('SYSTEM_ID', 1);
		$query = $this->db->get('SYSTEM')->row_array();
		$currentPosition = $query['CURRENT_POSITION'];
		
		return $currentPosition;
	}
	/* Increment current position.
	 */
	function incrementCurrentPosition() {

		$currentPosition = $this->getCurrentPosition();
		$currentPosition ++;
		// If it's above 9, revert back to 0.
		if ($currentPosition > 9) {
			$currentPosition = 0;
		}
		
		$data = array(
			'CURRENT_POSITION' => $currentPosition
			);
		$this->db->where('SYSTEM_ID', 1);
		$insert = $this->db->update('SYSTEM', $data);
		return $currentPosition;
	}
}
?>