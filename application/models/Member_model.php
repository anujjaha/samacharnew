<?php
class Member_model extends CI_Model {
	public function __construct()
    {
		parent::__construct();
    }
    public $table = "members";
    
    public function insert_member($data=array()) {
		$data['created'] = date('Y-m-d H:i:s');
		$this->db->insert($this->table,$data);
		return $this->db->insert_id();
	}
    public function get_member($param=null,$value=null) {
		$this->db->select("*")
				->from($this->table);
		if($param && $value) {
			$this->db->where($this->table.".".$param,$value);
		}
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function edit_member($id=null,$data=array()) {
		if($id) {
			$this->db->where('id',$id);
			$this->db->update($this->table,$data);
			return true;
		}
		return false;
	}
}
