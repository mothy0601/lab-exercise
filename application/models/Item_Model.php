<?php
	class Item_Model extends CI_Model{
		public function __construct(){
			$this->load->database();
		}

		public function Search($search){
			$query = $this->db->query("SELECT * FROM tbl_item WHERE `item_code` like '%$search%' OR `item_name` like '%$search%'");

			if($query->result_array()){
				return $query->result_array();
			} else {
				return false;
			}
		}
		public function add_item($item_code,$item_name,$item_qty,$item_price){
			$data = array(
				'item_code' => $item_code,
				'item_name' => $item_name,
				'item_quantity' => $item_qty,
				'item_price' => $item_price
			);
			if ($this->db->insert('tbl_item', $data)) {
				return 'success';
			} else {
				return 'Please Contact Administrator, System Error';
			}
		}
		public function delete_item($delete_id){
			$data = array('item_id	' => $delete_id);
			// return $this->db->delete('training_seminar_record', $data);
			if ($this->db->delete('tbl_item', $data)) {
				return 'success';
			} else {
				return 'Please Contact Administrator, System Error';
			}
		}
		public function search_update_item($search_id){
			$query = $this->db->query("SELECT * FROM tbl_item WHERE `item_id` = '$search_id'");

			if($query->result()){
				return $query->result();
			} else {
				return false;
			}
		}
		public function update_item($item_id,$item_code,$item_name,$item_qty,$item_price){
			$data = array(
				'item_code' => $item_code,
				'item_name' => $item_name,
				'item_quantity' => $item_qty,
				'item_price' => $item_price
			);
			$this->db->where('item_id', $item_id);
			if ($this->db->update('tbl_item', $data)) {
				return 'success';
			} else {
				return 'Please Contact Administrator, System Error';
			}
		}		
	}