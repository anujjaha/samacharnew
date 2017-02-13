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
		$this->db->select("*,advertisement.id as advertisement_id")
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
	
	public function getAdvertisementDetails($id)
	{
		$this->db->select('*')
			->from($this->table)
			->where('id', $id);

		$query = $this->db->get();

		if($query->row())
		{
			return $query->row();
		}

		return false;
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

	public function getLastPendingInvoiceByMemberId($member_id)
	{
		$sql = "SELECT advertisement.*,
				advertisement_details.advertisement_type, advertisement_details.advertisement_term,
				advertisement_details.advertisement_size,advertisement_details.advertisement_amount
				FROM advertisement 
				LEFT JOIN advertisement_details ON advertisement_details.id = advertisement.advertisement_details_id
				WHERE member_id = '".$member_id."' ANd is_invoice = 0 ORDER BY advertisement.id LIMIT 0, 1";
		$query = $this->db->query($sql);
		return $query->row();		
	}

	public function setInvoicedAdvertisementById($id = null)
	{
		if($id)
		{
			$sql = "UPDATE advertisement set is_invoice = 1 WHERE id = '" .$id. "'";

			return $this->db->query($sql);
		}

		return false;

	}
}
