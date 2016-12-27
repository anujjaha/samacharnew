<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('company_model');
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
          if($this->session->userdata['login']) {
              $this->dashboard();
          }
        }
        
        public function logout() {
            $set_data = array('user_id'=>null,'login'=>"0",'role'=>null,'username'=>null,'mobile'=>null);
            $this->session->unset_userdata($array_items);
           // $this->session->sess_destroy(); 
            session_destroy();
            $this->session->set_userdata($set_data);
            redirect("user/login/",'refresh');
        }

	public function dashboard() {
		if(isset($this->session->userdata['company_id'])) {
				redirect("company/company_members",'refresh');
		}
       	$data = array();
		$data['heading'] = $data['title']="Dashboard - ".SAMACHAR;
		$data['companies'] = $this->company_model->get_company();
		$this->template->load('user', 'index', $data);
	}
	public function switch_company() {
       	$data = array();
		$data['heading'] = $data['title']="Dashboard - ".SAMACHAR;
		$data['companies'] = $this->company_model->get_company();
		$this->template->load('user', 'index', $data);
	}
	function login() {
            $this->load->helper(array('form'));
            $data=array();
            if($this->input->post()) {
                $username = $this->input->post('username');
                $password = md5($this->input->post('password'));
                $result = $this->user_model->login_user($username,$password);
                if($result) {
                    $set_data = array('login'=>true,'user_id'=>$result->id,'role'=>$result->role,
                                       'username'=>$result->nickname,'mobile'=>$result->mobile,
                                      );
                $this->session->set_userdata($set_data);
                redirect("user/dashboard/",'refresh');
                } else {
                    $this->session->set_flashdata('msg', 'Invalid Credentials');
                }
            } else {
               $this->session->sess_destroy(); 
            }
            $data['title'] = $data['heading']="Login";
            $this->load->view('login_view',$data);
	 }
         
         
}
