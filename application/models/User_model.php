<?php
class User_model extends CI_Model {
	public function __construct()
    {
                parent::__construct();
    }
    public $table_users = "users";
	
    public function login_user($username=null,$password=null) {
        if(!empty($username) && !empty($password)) {
            $query = "SELECT * FROM users u
                     WHERE u.username = '$username'
                     AND u.password = '$password' 
                     AND u.active = 1";
            $result = $this->db->query($query);
            return $result->row();
        }
        return false;
    }
	public function search_customers($param=null,$flag=null) {
		$sql = "SELECT * from customer 
						WHERE  
						username LIKE '%$param%' OR
						name LIKE '%$param%' OR
						companyname LIKE '%$param%' OR
						mobile LIKE '%$param%' OR
						officecontact LIKE '%$param%' OR
						emailid LIKE '%$param%' OR
						add1 LIKE '%$param%' OR
						add2 LIKE '%$param%' OR
						city LIKE '%$param%' 
						order by id";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
}
