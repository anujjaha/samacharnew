<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('user_model');
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
	public function add() {
		$data = array();
		$data['heading'] = $data['title']="Add Members - ".$this->session->userdata['company_name'];
		if($this->input->post()) {
			$member_data = array();
			$member_data['company_id'] = $this->input->post('company_id');
			$member_data['companyname'] = strtoupper($this->input->post('companyname'));
			$member_data['name'] = $this->input->post('name');
			$member_data['mobile'] = $this->input->post('mobile');
			$member_data['officecontact'] = $this->input->post('officecontact');
			$member_data['othercontact'] = $this->input->post('othercontact');
			$member_data['fax'] = $this->input->post('fax');
			$member_data['add1'] = $this->input->post('add1');
			$member_data['add2'] = $this->input->post('add2');
			$member_data['add3'] = $this->input->post('add3');
			$member_data['city'] = strtoupper($this->input->post('city'));
			$member_data['state'] = $this->input->post('state');
			$member_data['pincode'] = $this->input->post('pincode');
			$member_data['emailid'] = $this->input->post('emailid');
			$member_data['emailid2'] = $this->input->post('emailid2');
			$member_data['website'] = $this->input->post('website');
			$member_data['createdby'] = $this->session->userdata['user_id'];
			$status = $this->member_model->insert_member($member_data);
			if($status) {
				redirect("company/company_members/",'refresh');
			}
		}
		$this->template->load('member', 'add', $data);
	}
	public function edit($id=null) {
		$data = array();
		$data['heading'] = $data['title']="Edit Member - ".$this->session->userdata['company_name'];
		$data['member_info'] = $this->member_model->get_member('id',$id);
		if($this->input->post()) {
			$member_data = array();
			$id = $this->input->post('id');
			$member_data['company_id'] = $this->input->post('company_id');
			$member_data['companyname'] = strtoupper($this->input->post('companyname'));
			$member_data['name'] = $this->input->post('name');
			$member_data['mobile'] = $this->input->post('mobile');
			$member_data['officecontact'] = $this->input->post('officecontact');
			$member_data['othercontact'] = $this->input->post('othercontact');
			$member_data['fax'] = $this->input->post('fax');
			$member_data['add1'] = $this->input->post('add1');
			$member_data['add2'] = $this->input->post('add2');
			$member_data['add3'] = $this->input->post('add3');
			$member_data['city'] = strtoupper($this->input->post('city'));
			$member_data['state'] = $this->input->post('state');
			$member_data['pincode'] = $this->input->post('pincode');
			$member_data['emailid'] = $this->input->post('emailid');
			$member_data['emailid2'] = $this->input->post('emailid2');
			$member_data['website'] = $this->input->post('website');
			$member_data['createdby'] = $this->session->userdata['user_id'];
			$status = $this->member_model->edit_member($id,$member_data);
			if($status) {
				redirect("company/company_members/",'refresh');
			}
		}
		if(! $id) {
				redirect("company/company_members/",'refresh');
			}
		$this->template->load('member', 'edit', $data);
	}
}
