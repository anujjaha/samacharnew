<?php
class Advertisement_model extends CI_Model {
	public function __construct()
    {
		parent::__construct();
    }
    public $table = "advertisement";
    public $table_month = "advertisement_months";
    
    public function insert_advertiser_details($data=array()) {
		$data['created'] = date('Y-m-d H:i:s');
		$this->db->insert($this->table,$data);
		return $this->db->insert_id();
	}
    public function insert_advertiser_months($data=array()) {
		$data['created'] = date('Y-m-d H:i:s');
		$this->db->insert($this->table_month,$data);
		return $this->db->insert_id();
	}
    public function get_advertisement_details($param=null,$value=null,$company=true) {
		$this->db->select("*")
				->join("members","advertisement.member_id = members.id","left")
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
	
	public function edit_advertisement_details($id=null,$data=array()) {
		if($id) {
			$this->db->where('id',$id);
			$this->db->update($this->table,$data);
			return true;
		}
		return false;
	}
	
	public function estimate_cost($ids) {
		$sql = "SElECT sum(advertisement_amount) as total FROM advertisement_details where id IN (".$ids.")";
		$query = $this->db->query($sql);
		return $query->row()->total;
	}
}
