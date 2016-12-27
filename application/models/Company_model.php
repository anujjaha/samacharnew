<?php
class Company_model extends CI_Model {
	public function __construct()
    {
		parent::__construct();
    }
    public $table = "companies";
    
    public function insert_company($data=array()) {
		$data['created'] = date('Y-m-d H:i:s');
		$this->db->insert($this->table,$data);
		return $this->db->insert_id();
	}
    public function get_company($param=null,$value=null) {
		$this->db->select("*,(select count(id)  from members where company_id=$this->table.id) as total_members ")
				->from($this->table);
		if($param && $value) {
			$this->db->where($this->table.".".$param,$value);
		}
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function edit_company($id=null,$data=array()) {
		if($id) {
			$this->db->where('id',$id);
			$this->db->update($this->table,$data);
		}
		return false;
	}
}
