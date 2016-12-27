<?php
class Subscriber_model extends CI_Model {
	public function __construct()
    {
		parent::__construct();
    }
    public $table = "subscribers";
    
    public function insert_details($data=array()) {
		$data['created'] = date('Y-m-d H:i:s');
		$data['created_by'] = $this->session->userdata['user_id'];
		$this->db->insert($this->table,$data);
		return $this->db->insert_id();
	}
    public function get_details($param=null,$value=null,$company=true) {
		$this->db->select("*")
				->from($this->table);
		if($param && $value) {
			$this->db->where($this->table.".".$param,$value);
		}
		if($company) {
			$this->db->where($this->table.".".'company_id',$this->session->userdata['company_id']);
		}
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function get_details_edit($id=null) {
		$data = array();
		if($id) {
			$this->db->select('*,subscribers.id as subscribe_id')
					->from($this->table)
					->join('members','members.id=subscribers.member_id','left')
					->join('companies','companies.id=subscribers.company_id','left')
					->join('subscription_details','subscription_details.id=subscribers.subscription_details_id','left')
					->where('subscribers.id',$id);
			$query = $this->db->get();
			return $query->row();
		}
		return $data;
	}
	
	public function edit_details($id=null,$data=array()) {
		if($id) {
			$this->db->where('id',$id);
			$this->db->update($this->table,$data);
			return true;
		}
		return false;
	}
	
	public function get_all_subscribers($param=null,$value=null) {
		$this->db->select('*,subscribers.id as subscribe_id')
				->from($this->table)
				->join('members','members.id = subscribers.member_id','left')
				->join('subscription_details','subscription_details.id = subscribers.subscription_details_id','left');
		
		if($param && $value) {
				$this->db->where($param,$value);
		}		
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function update_details($subscribe_id,$subscriber_data) {
		$this->db->where('id',$subscribe_id);
		$this->db->update($this->table,$subscriber_data);
		return true;
	}
	
	public function delete_subscriber($id) {
		$this->db->where('id',$id);
		$this->db->delete($this->table);
		return true;
	}
}
