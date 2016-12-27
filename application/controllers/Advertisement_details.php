<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Advertisement_details extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('advertisement_details_model');
	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index() {
		$data = array();
		$data['heading'] = $data['title']="Dashboard - ".SAMACHAR;
		$data['advertisements'] = $this->advertisement_details_model->get_advertisement_details();
		$this->template->load('advertisement', 'index', $data);
	}
	
	public function add() {
		$data = array();
		$data['heading'] = $data['title']="Add Subscription - ".$this->session->userdata['company_name'];
		if($this->input->post()) {
			$advertisement_data = array();
			$advertisement_data['company_id'] = $this->session->userdata['company_id'];
			$advertisement_data['advertisement_type'] = $this->input->post('advertisement_type');
			$advertisement_data['advertisement_term'] = $this->input->post('advertisement_term');
			$advertisement_data['advertisement_amount'] = $this->input->post('advertisement_amount');
			$advertisement_data['advertisement_size'] = $this->input->post('advertisement_size');
			$status = $this->advertisement_details_model->insert_advertisement_details($advertisement_data);
			if($status) {
				redirect("advertisement/index/",'refresh');
			}
		}
		$this->template->load('advertisement', 'add', $data);
	}  
	      
	public function edit($id=null) {
		
		$data = array();
		$data['heading'] = $data['title']="Edit Advertisement - ".$this->session->userdata['company_name'];
		$data['advertisement_details'] = $this->advertisement_details_model->get_advertisement_details('id',$id);
		if($this->input->post()) {
			$advertisement_data = array();
			$advertisement_id = $this->input->post('id');
			$advertisement_data['company_id'] = $this->session->userdata['company_id'];
			$advertisement_data['advertisement_type'] = $this->input->post('advertisement_type');
			$advertisement_data['advertisement_term'] = $this->input->post('advertisement_term');
			$advertisement_data['advertisement_amount'] = $this->input->post('advertisement_amount');
			$advertisement_data['advertisement_size'] = $this->input->post('advertisement_size');
			$status = $this->advertisement_details_model->edit_advertisement_details($advertisement_id,$advertisement_data);
			if($status) {
				redirect("advertisement_details/index/",'refresh');
			}
		}
		if(!$id) {
			redirect("advertisement_details/index/",'refresh');
		}
		$this->template->load('advertisement', 'edit', $data);
	}        
         
}
