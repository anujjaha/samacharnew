<?php
class Invoice_model extends CI_Model 
{
	public $table 		= 'invoice';
	public $table_items = 'invoice_items';

	public function __construct()
    {
		//parent::__construct();
    }
    
    public function create($companyId, $data)
    {
    	$invoiceData = array(
    		'company_id'	=> $companyId,
    		'invoice_title' => $data['invoice_name'],
    		'member_id' 	=> $data['member_id'],
    		'sub_total' 	=> $data['sub_total'],
    		'tax' 			=> $data['tax'],
			'grand_total' 	=> $data['grand_total'],
			'notes' 		=> $data['notes'],
            'created_at'    => date('Y-m-d H:i:s')
		);

    	$this->db->insert($this->table, $invoiceData);
    	$invoiceId = $this->db->insert_id();
		
		$invoiceItems = array();

    	foreach ($data['item'] as $key => $value) 
    	{
    		$invoiceItems[] = array(
    			'member_id'		=> $data['member_id'],
    			'invoice_id'	=> $invoiceId,
    			'item_details' 	=> $value,
    			'qty'			=> $data['qty'][$key],
    			'rate'			=> $data['rate'][$key],
    			'subtotal'		=> $data['subtotal'][$key],
                'created_at'    => date('Y-m-d H:i:s')
    		);
    	}

    	$this->db->insert_batch($this->table_items, $invoiceItems);

    	return $invoiceId;
    }

    public function getAllInvoices($param = null, $value = null)
    {
    	$this->db->select("*, invoice.id as id, invoice.created_at as created_at")
				->from($this->table);

		if($param && $value) {
			$this->db->where($this->table.".".$param, $value);
		}

		$this->db->join('members', 'members.id = invoice.member_id', 'left');

		$this->db->order_by('invoice.id', 'desc');
		
		$query = $this->db->get();

		return $query->result_array();
    }

    public function getFullInvoiceById($invoiceId = null)
    {
    	if($invoiceId)
    	{
    		$this->db->select("*, invoice.id as id, invoice.created_at as created_at")
				->from($this->table)
				->where('invoice.id', $invoiceId)
				->join('members', 'members.id = invoice.member_id', 'left')
				->join('invoice_items', 'invoice_items.invoice_id = invoice.id', 'left');

			$query = $this->db->get();

			$invoiceInfo = $query->row();
			$invoiceItems = $this->getInvoiceItemsByInvoiceId($invoiceId);

			return array(
				'invoiceInfo' 	=> $invoiceInfo,
				'invoiceItems' 	=> $invoiceItems
			);
    	}
    }

    public function getInvoiceItemsByInvoiceId($invoiceId = null)
    {
    	if($invoiceId)
    	{
    		$this->db->select("*")
				->from($this->table_items)
				->where('invoice_id', $invoiceId);
				
			$query = $this->db->get();

			return $query->result_array();
    	}

    	return array();
    }
}
