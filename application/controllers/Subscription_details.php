<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subscription_details extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('subscription_details_model');
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
		$data['subscriptions'] = $this->subscription_details_model->get_subcription_details();
		$this->template->load('subscriptions', 'index', $data);
	}
	
	public function add() {
		$data = array();
		$data['heading'] = $data['title']="Add Subscription - ".$this->session->userdata['company_name'];
		if($this->input->post()) {
			$subscription_data = array();
			$subscription_data['company_id'] = $this->session->userdata['company_id'];
			$subscription_data['subscription_type'] = $this->input->post('subscription_type');
			$subscription_data['subscription_term'] = $this->input->post('subscription_term');
			$subscription_data['subscription_amount'] = $this->input->post('subscription_amount');
			$subscription_data['subscription_issues'] = $this->input->post('subscription_issues');
			
			$status = $this->subscription_details_model->insert_subcription_details($subscription_data);
			if($status) {
				redirect("subscription_details/index/",'refresh');
			}
		}
		$this->template->load('subscriptions', 'add', $data);
	}  
	      
	public function edit($id=null) {
		
		$data = array();
		$data['heading'] = $data['title']="Edit Subscription - ".$this->session->userdata['company_name'];
		$data['subscription_details'] = $this->subscription_details_model->get_subcription_details('id',$id);
		if($this->input->post()) {
			$subscription_data = array();
			$subscription_id = $this->input->post('id');
			$subscription_data['company_id'] = $this->session->userdata['company_id'];
			$subscription_data['subscription_type'] = $this->input->post('subscription_type');
			$subscription_data['subscription_term'] = $this->input->post('subscription_term');
			$subscription_data['subscription_amount'] = $this->input->post('subscription_amount');
			$subscription_data['subscription_issues'] = $this->input->post('subscription_issues');
			
			$status = $this->subscription_details_model->edit_subcription_details($subscription_id,$subscription_data);
			if($status) {
				redirect("subscription_details/index/",'refresh');
			}
		}
		if(!$id) {
			redirect("subscription_details/index/",'refresh');
		}
		$this->template->load('subscriptions', 'edit', $data);
	}        
         
}
