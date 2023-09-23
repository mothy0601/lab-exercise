<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_Page extends CI_Controller {

	public function index() {
		$this->load->view('menu_page');
	}
	public function search_control() {
		$search_item = $this->input->post('search');
		$search_result['search_result'] = $this->item_model->search($search_item);
		$this->load->view('components/display_items', $search_result);
	}
	public function add_item_control() {
		$item_code = $this->input->post('item_code');
		$item_name = $this->input->post('item_name');
		$item_qty = $this->input->post('item_qty');
		$item_price = $this->input->post('item_price');
		echo $this->item_model->add_item($item_code,$item_name,$item_qty,$item_price);
	}
	public function c_update_item_control() {
		$item_u_id = $this->input->post('item_u_id');
		$item_u_code = $this->input->post('item_u_code');
		$item_u_name = $this->input->post('item_u_name');
		$item_u_qty = $this->input->post('item_u_qty');
		$item_u_price = $this->input->post('item_u_price');
		echo $this->item_model->update_item($item_u_id,$item_u_code,$item_u_name,$item_u_qty,$item_u_price);
	}
	
	public function delete_item_control() {
		$delete_id = $this->input->post('delete_id');
		echo $this->item_model->delete_item($delete_id);
	}
	
	public function update_item_control() {
		$update_id = $this->input->post('update_id');
		$search_result['search_u_result'] = $this->item_model->search_update_item($update_id);
		$this->load->view('components/display_update', $search_result);
	}
	
}

