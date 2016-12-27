<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('invoice_model');
		$this->load->model('member_model');
	}

	public function index()
	{
		$data['invoices'] = $this->invoice_model->getAllInvoices();
		$this->template->load('invoice', 'index', $data);
	}   

	public function add() 
	{
		$data = array();
		$data['heading'] = $data['title']="Add Advertisement Details - ".SAMACHAR;
		if($this->input->post())
		{	
			$data = $this->input->post();

			$invoiceId = $this->invoice_model->create($this->session->userdata['company_id'], $data);
			
			redirect("invoice", "refresh");
		}

		$data['members'] = $this->member_model->get_member('company_id',$this->session->userdata['company_id']);
		$this->template->load('invoice', 'add', $data);
	}  
}
