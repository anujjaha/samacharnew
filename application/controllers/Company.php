<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends CI_Controller {
	
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
	public function index() {
       	$data = array();
		$data['heading'] = $data['title']="Dashboard - ".SAMACHAR;
		$data['companies'] = $this->company_model->get_company();
		$this->template->load('user', 'index', $data);
	}
	public function add() {
		$data = array();
		$data['heading'] = $data['title']="Create New Member - ".SAMACHAR;
		if($this->input->post()) {
			$comp_data = array();
			$comp_data['name'] = $this->input->post('name');
			$comp_data['owner'] = $this->input->post('owner');
			$comp_data['emailid'] = $this->input->post('emailid');
			$comp_data['mobile'] = $this->input->post('mobile');
			$comp_data['address'] = $this->input->post('address');
			$comp_data['city'] = $this->input->post('city');
			$comp_data['pincode'] = $this->input->post('pincode');
			$comp_data['state'] = $this->input->post('state');
			$comp_data['createdby'] = $this->session->userdata['user_id'];
			$status = $this->company_model->insert_company($comp_data);
			if($status) {
				redirect("company/index/",'refresh');
			}
		}
		$this->template->load('company', 'add', $data);
	}
	
	public function edit($id=null) {
		$data = array();
		$data['heading'] = $data['title']="Edit Company - ".SAMACHAR;
		$data['company'] = $this->company_model->get_company('id',$id);
		if($this->input->post()) 
		{
			$comp_data = array();
			
			if(isset($_FILES['image']))
			{
				$comp_data['logo'] = $this->uploadImage($_FILES['image']);
			}
			
			$comp_id = $this->input->post('id');
			$comp_data['name'] = $this->input->post('name');
			$comp_data['owner'] = $this->input->post('owner');
			$comp_data['emailid'] = $this->input->post('emailid');
			$comp_data['mobile'] = $this->input->post('mobile');
			$comp_data['address'] = $this->input->post('address');
			$comp_data['city'] = $this->input->post('city');
			$comp_data['pincode'] = $this->input->post('pincode');
			$comp_data['state'] = $this->input->post('state');

			$status = $this->company_model->edit_company($comp_id,$comp_data);

			if($status) 
			{
				redirect("company/index/",'refresh');
			}
		}
		if(! $id) {
				$this->index();
		}
		$this->template->load('company', 'edit', $data);
	}
	
	public function uploadImage()
	{
		$config = array(
			'upload_path'   => 'assets/companylogo',
			'allowed_types' => 'gif|jpg|png',
			'file_name'     => rand(111111, 999999)."_logo.jpg"
		);
			
		$this->load->library('upload', $config);

        if ( $this->upload->do_upload('image'))
        {
        	$picData = $this->upload->data();  
        	return $picData['file_name'];
        }
	}

	public function set_company($id) {
		if($id) {
			$data['companies'] = $this->company_model->get_company('id',$id);
			$this->session->userdata['company_id'] = $data['companies'][0]['id'];
			$this->session->userdata['company_name'] = $data['companies'][0]['name'];
			$this->session->userdata['company_owner'] = $data['companies'][0]['owner'];
			$this->session->userdata['company_mobile'] = $data['companies'][0]['mobile'];
			$this->session->userdata['company_emailid'] = $data['companies'][0]['emailid'];
			redirect("company/company_members/",'refresh');
		}
		$this->index();
	}
	
	
	public function company_members() {
		$company_id = $this->session->userdata['company_id'];
		$data['members'] = $this->member_model->get_member('company_id',$company_id);
		$data['heading'] = $data['title']="Members Management for ".$this->session->userdata['company_name'];
		$this->template->load('member', 'index', $data);
	}
}
