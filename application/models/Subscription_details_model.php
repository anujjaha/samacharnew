<?php
class Subscription_details_model extends CI_Model {
	public function __construct()
    {
		parent::__construct();
    }
    public $table = "subscription_details";
    
    public function insert_subcription_details($data=array()) {
		$data['created'] = date('Y-m-d H:i:s');
		$data['created_by'] = $this->session->userdata['user_id'];
		$this->db->insert($this->table,$data);
		return $this->db->insert_id();
	}
    public function get_subcription_details($param=null,$value=null,$company=true) {
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
	
	public function edit_subcription_details($id=null,$data=array()) {
		if($id) {
			$this->db->where('id',$id);
			$this->db->update($this->table,$data);
			return true;
		}
		return false;
	}

	public function getPriceById($id)
	{
		$this->db->select('subscription_amount')
			->from($this->table)
			->where('id', $id);

		$query = $this->db->get();

		if($query->row())
		{
			return $query->row();
		}

		return false;
	}
}
