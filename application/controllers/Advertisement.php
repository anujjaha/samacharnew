<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Advertisement extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('company_model');
		$this->load->model('subscriber_model');
		$this->load->model('advertisement_model');
		$this->load->model('member_model');
		$this->load->model('advertisement_details_model');
		$this->load->model('advertisement_model');
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
		$data['heading'] = $data['title']="Advertiser Details - ".SAMACHAR;
		$data['advertisers'] = $this->advertisement_model->get_advertisement_details('','',true);
		
		$this->template->load('advertiser', 'index', $data);
	}     
	
	public function add() 
	{
		$data = array();
		$data['heading'] = $data['title']="Add Advertisement Details - ".SAMACHAR;
		if($this->input->post()) {
			$advertise_data = array( 'member_id'=>$this->input->post('customer_id'),
									 'company_id'=> $this->session->userdata['company_id'],	
									 'contact_person'=>$this->input->post('contact_person'),	
									 'contact_number'=>$this->input->post('contact_number'),	
									 'advertisement_details_id'=>$this->input->post('advertisements_id'),	
									 'cost'=>$this->input->post('cost'),	
									 'notes'=>$this->input->post('notes'),	
									 'advance'=>$this->input->post('advance'),	
									 'duration'=>$this->input->post('duration'),	
									 'duration_from'=> date('Y-m-d',strtotime($this->input->post('duration_from'))),	
									 'duration_to'=> date('Y-m-d',strtotime($this->input->post('duration_to'))),	
									 'pay_type'=>$this->input->post('pay_type'),
									 'bank_name'=>$this->input->post('bank_name'),
									 'cheque_no'=>$this->input->post('cheque_no'),
									 'date'=> date('Y-m-d',strtotime($this->input->post('date'))),	
									);
			
			$advertisement_id = $this->advertisement_model->insert_advertiser_details($advertise_data);
			$save_months  = $this->input->post('active_months');
			foreach($save_months as $month) {
				$smonth = date('m-Y',strtotime($month));
				$this->advertisement_model->insert_advertiser_months(array('advertisement_id'=>$advertisement_id,'month'=>$smonth));
			}
			redirect("advertisement","refresh");
		}
		$data['members'] = $this->member_model->get_member('company_id',$this->session->userdata['company_id']);
		$data['advertisement_details'] = $this->advertisement_details_model->get_advertisement_details('','',true);
		$this->template->load('advertiser', 'add', $data);
	}
}
