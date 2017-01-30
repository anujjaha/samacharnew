<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subscriber extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('subscriber_model');
		$this->load->model('company_model');
		$this->load->model('member_model');
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
	 public function index() 
	 {
	 	$data = array();
		$data['heading'] = $data['title']="Subscriber List - ".$this->session->userdata['company_name'];
		$data['subscribers'] = $this->subscriber_model->get_all_subscribers();
		$this->template->load('subscriber', 'index', $data);
	 }
	 
	public function add() {
		$data = array();
		$data['heading'] = $data['title']="Subscribe Member - ".$this->session->userdata['company_name'];
		if($this->input->post()) {
			$subscriber_data = array();
			$subscriber_data['company_id'] = $this->input->post('company_id');
			$subscriber_data['member_id'] = $this->input->post('member_id');
			$subscriber_data['subscription_details_id'] = $this->input->post('subscription_details_id');
			$subscriber_data['subscribe_type'] = $this->input->post('subscribe_type');
			$subscriber_data['subscribe_amount'] = $this->input->post('subscribe_amount');
			$subscriber_data['subscribe_from_date'] = date('Y-m-d',strtotime($this->input->post('subscribe_from_date')));
			$subscriber_data['subscribe_to_date'] = date('Y-m-d-',strtotime($this->input->post('subscribe_to_date')));
			$subscriber_data['subscribe_remind'] = $this->input->post('subscribe_remind');
			$subscriber_data['subscribe_remind_before'] = $this->input->post('subscribe_remind_before');
			$subscriber_data['auto_renew'] = $this->input->post('auto_renew');
			$subscriber_data['notes'] = $this->input->post('notes');
			$status = $this->subscriber_model->insert_details($subscriber_data);
			if($status) {
				redirect("subscriber/receipt/".$status,'refresh');
			}
		}
		$this->template->load('subscriber', 'add', $data);
	}

	public function receipt($subscriberId)
	{
		if($subscriberId)
		{
			$subscriberInfo = $this->subscriber_model->getSubscriber($subscriberId);	
			$memberInfo     = $this->member_model->get_member('id', $subscriberInfo->member_id);
			$companyInfo    = $this->company_model->get_company('id', $subscriberInfo->company_id);

			$data = array(
				'subscribe' 	=> $subscriberInfo,
				'member'		=> $memberInfo[0],
				'company'		=> $companyInfo[0]
			);

			$this->template->load('subscriber', 'receipt', $data);		
		}
		else
		{
			redirect("subscriber/index", "refresh");	
		}
	}

	public function edit($id=null) {
		$data = array();
		$data['heading'] = $data['title']="Edit Subscribe Member - ".$this->session->userdata['company_name'];
		$data['subscribe_details'] = $this->subscriber_model->get_details_edit($id);
		if($this->input->post()) {
			$subscriber_data = array();
			$subscribe_id = $this->input->post('subscribe_id');
			$subscriber_data['member_id'] = $this->input->post('member_id');
			$subscriber_data['subscription_details_id'] = $this->input->post('subscription_details_id');
			$subscriber_data['subscribe_type'] = $this->input->post('subscribe_type');
			$subscriber_data['subscribe_amount'] = $this->input->post('subscribe_amount');
			$subscriber_data['subscribe_from_date'] = date('Y-m-d',strtotime($this->input->post('subscribe_from_date')));
			$subscriber_data['subscribe_to_date'] = date('Y-m-d-',strtotime($this->input->post('subscribe_to_date')));
			$subscriber_data['subscribe_remind'] = $this->input->post('subscribe_remind');
			$subscriber_data['subscribe_remind_before'] = $this->input->post('subscribe_remind_before');
			$subscriber_data['auto_renew'] = $this->input->post('auto_renew');
			$subscriber_data['notes'] = $this->input->post('notes');
			
			$status = $this->subscriber_model->update_details($subscribe_id,$subscriber_data);
			if($status) {
				redirect("subscriber/index/",'refresh');
			}
		}
		if(! $id) {
				redirect("subscriber/index/",'refresh');
			}
		$this->template->load('subscriber', 'edit', $data);
	}
}
