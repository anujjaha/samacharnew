<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('test_method'))
{
    function test_method($var = null)
    {
        echo "Test Method";
    }   
    
    function user_logged_in() {
        $ci =& get_instance();
        $class = $ci->router->fetch_class();
        $method = $ci->router->fetch_method();
        if($class == 'user' &&  $method == 'login' || $method == 'logout') {
            return true;
        } else { 
            if(! isset($ci->session->userdata['login'])) {
                redirect("user/login/",'refresh'); 
            }
        }
    }
    
    function user_authentication($department) {
        $ci =  & get_instance();
        $class = $ci->router->fetch_class();
        $method = $ci->router->fetch_method();
        if($class == 'user' &&  $method == 'login' || $method == 'logout') {
            return true;
        }
        if($class == 'ajax') { return true; }
        if($class != $department) {
            redirect("$department",'refresh'); 
        }
        return true;
    }
  
    
    function create_customer_dropdown($type,$flag=null) {
		if($type == "customer") {
			$sql = "SELECT id,name,companyname FROM customer WHERE ctype = 0 order by companyname";
			$ci=& get_instance();
			$ci->load->database(); 	
			$query = $ci->db->query($sql);
			$extra ="";
			if($flag) {
				$extra = 'onchange="customer_selected('."'customer'".',this.value)"';
			}
			$dropdown = "<select  class='form-control' name='customer' $extra><option value=0> Select Customer</option>";
			
			foreach($query->result() as $customer) {
					$cname = $customer->name;
					if($customer->companyname) {
						$cname = $customer->companyname;
					}
					$dropdown .= "<option value='".$customer->id."'>".$cname."</option>";
			}
			$dropdown .= '</select>';
			return $dropdown;
		}
		
		if($type == "dealer") {
			$sql = "SELECT id,name,companyname,dealercode FROM customer WHERE ctype=1 order by companyname";
		$ci=& get_instance();
		$ci->load->database(); 	
		$query = $ci->db->query($sql);
		$extra ="";
		if($flag) {
			$extra = 'onchange="customer_selected('."'dealer'".',this.value)"';
		}
		$dropdown = "<select  class='form-control' name='customer' $extra><option value=0> Select Dealer</option>";
		foreach($query->result() as $customer) {
				$dropdown .= "<option value='".$customer->id."'>".
				$customer->companyname
				."[".$customer->dealercode."]</option>";
		}
		$dropdown .= '</select>';
		return $dropdown;
		}
	}
	
	
    function get_all_customers($param=null,$value=null) {
		$sql = "SELECT * FROM customer order by companyname";
		if(!empty($param)) {
			$sql = "SELECT * FROM customer where $param = '".$value."' order by companyname";
		}
		$ci=& get_instance();
		$ci->load->database(); 	
		$query = $ci->db->query($sql);
		return $query->result();
	}
	
	function send_sms($user_id=null,$customer_id,$mobile,$sms_text=null,$prospect_id=0) {
		$ci=& get_instance();
		$ci->load->database(); 
		if(! $user_id) {
			$user_id = $ci->session->userdata['user_id'];
		}
		
		$msg = str_replace(" ","+",$sms_text);
		$url = "http://ip.infisms.com/smsserver/SMS10N.aspx?Userid=cyberabill&UserPassword=cyb123&PhoneNumber=$mobile&Text=$msg&GSM=CYBERA";
		
		$url = urlencode($url);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, urldecode($url));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
		$response = curl_exec($ch);
		curl_close($ch);
		
		$ci->load->model('sms_transaction_model','sms');
		$sms_data['user_id'] = $user_id;
		$sms_data['customer_id'] = $customer_id;
		$sms_data['prospect_id'] = $prospect_id;
		$sms_data['sms_text'] = $sms_text;
		$sms_data['mobile'] = $mobile;
		$sms_data['char_count'] = strlen($sms_text);
		$sms_data['status'] = $response;
		$ci->sms->insert_sms($sms_data);
	return true;
	}

function create_pdf($content = null, $size ='A5-L')
{
	if($content) 
	{
		$ci = & get_instance();
		$mpdf = new mPDF('', $size,8,'',4,4,10,2,4,4);
		//$mpdf->SetHeader('CYBERA Print ART');
		$mpdf->defaultheaderfontsize=8;
		//$mpdf->SetFooter('{PAGENO}');
		$mpdf->WriteHTML($content);
		$mpdf->shrink_tables_to_fit=0;
		$mpdf->list_indent_first_level = 0;  
		//$fname = "account_pdf_report/".rand(1111,9999)."_samachar.pdf";
		$fname = "account_pdf_report/samachar.pdf";
		$mpdf->Output($fname,'F');
		return base_url().$fname;
	}
}

function get_user_by_param($param=null,$value=null) {
	if($param && $value) {
		$ci = & get_instance();
		$ci->db->select('*')
			->from('user_meta')
			->where("$param","$value");
		$query = $ci->db->get();
		return $query->row();
	}
}

function get_restricted_department() {
	return array("prints","cuttings","master");
}

function get_papers_size() {
	$ci = & get_instance();
	$ci->load->model('job_model');
	$data['papers'] = $ci->job_model->get_paper_gsm();
	$data['size'] = $ci->job_model->get_paper_size();
	return $data;
}

function job_complete_sms($job_id=null) {
	if($job_id) {
		$ci = & get_instance();
		$sql = "SELECT if(CHAR_LENGTH(c.name) > 0,c.name,c.companyname) as customer_name,
				job.smscount,job.customer_id,c.mobile,
				job.total,job.due,
				(SELECT SUM(total) from job WHERE job.customer_id = c.id)  as 'total_amount' ,
				(SELECT SUM(due) from job WHERE job.customer_id = c.id)  as 'total_due' ,
				(select sum(amount) from user_transactions where user_transactions.customer_id=c.id) as 'total_credit'
				FROM job 
				LEFT JOIN customer c
				ON c.id = job.customer_id
				WHERE job.id = $job_id";
				
		$query = $ci->db->query($sql);
		$result = $query->row();
		$balance = $result->total_credit - $result->due;
		if( $balance < 0 ) {
			$sms_text = "Dear ".$result->customer_name." Your Job Num $job_id of rs. ".$result->total." completed and ready for delivery. Total due Rs. $balance Thank You.";
		} else {
				$sms_text = "Dear ".$result->customer_name." Your Job Num $job_id of rs. ".$result->total." completed and ready for delivery. Pay ".$result->due." due amt. to collect your job. Thank You.";
		}
		
		$data['smscount'] = $result->smscount  + 1;
		$ci->db->where('id',$job_id);
		$ci->db->update('job',$data);
		
		$customer_id = $result->customer_id;
		//$mobile = $result->mobile;
		$mobile = "9898618697";
		$user_id = $ci->session->userdata['user_id'];
		
		send_sms($user_id,$customer_id,$mobile,$sms_text);
		return true;
	}
	return true;
}

function get_master_statistics() {
	$ci = & get_instance();
	$ci->load->model('master_model');
	return $ci->master_model->get_master_statistics();
}

function get_department_revenue() {
	$ci = & get_instance();
	$sql = "SELECT 
			(select sum(jamount) from job_details 
			where jtype = 'Digital Print') as dprint,

			(select sum(jamount) from job_details 
			where jtype = 'Cutting' ) as 'dcutting' ,

			(select sum(jamount) from job_details 
			where jtype = 'Designing' ) as 'ddesigning',

			(select sum(jamount) from job_details 
			where jtype = 'Visiting Card' ) as 'dvisitingcard',
			
			(select sum(jamount) from job_details 
			where jtype = 'Offset Print' ) as 'doffsetprint',
			
			(select sum(jamount) from job_details 
			where jtype = 'Binding' ) as 'dbinding',

			(select sum(jamount) from job_details 
			where jtype = 'Lamination' ) as 'dlamination',

			(select sum(jamount) from job_details 
			where jtype = 'Packaging and Forwading' ) as 'dpackaging',

			(select sum(jamount) from job_details 
			where jtype = 'Transportation' ) as 'dtransportation',

			(select sum(jamount) from job_details 
			where jtype = 'B/W Print' ) as 'dbwprint'
			from job_details limit 1";
	$query = $ci->db->query($sql);
	return $query->row();
}

function send_mail($to,$from,$subject="Cybera Email System",$content=null) {
	$mail = new PHPMailer();
	$mail->Host     = "smtp.gmail.com"; // SMTP server
	$mail->SMTPAuth    = TRUE; // enable SMTP authentication
	$mail->SMTPSecure  = "tls"; //Secure conection
	$mail->Port        = 587; // set the SMTP port
	$mail->Username    = 'er.anujjaha@gmail.com'; // SMTP account username
	$mail->Password    = 'aj@anujjaha'; // SMTP account password
	$mail->SetFrom('cybera.printart@gmail.com', 'Cybera Print Art');
	$mail->AddAddress($to);
	$mail->isHTML( TRUE );
	$mail->Subject  = $subject;
	$mail->Body     = $content;
	if(!$mail->Send()) {
	  echo 'Message was not sent.';
	 // echo 'Mailer error: ' . $mail->ErrorInfo;
	} else {
	  return true;
	}
}
	function get_members_dropdown_invoice($member_id=null) 
	{
		$ci = & get_instance();
		$ci->db->select('id,companyname,name')
			->from('members')
			->where('company_id',$ci->session->userdata['company_id'])
			->where('active','1')
			->order_by('companyname');
		$query = $ci->db->get();
		$data = '<select onchange="loadInvoice()"  class="form-control" id="member_id" name="member_id"><option value="0">Select Member</option>';
		foreach($query->result_array() as $member) {
			$selected = "";
			if($member_id && $member_id == $member['id']) {
				$selected = 'selected="selected"';
			}
			$data .= '<option '.$selected.' value='.$member['id'].'>'.$member['companyname']." [".$member['name']."]".'</option>';
		}
		$data .= "</select>";
	return $data;
	}

	function get_members_dropdown($member_id=null) 
	{
		$ci = & get_instance();
		$ci->db->select('id,companyname,name')
			->from('members')
			->where('company_id',$ci->session->userdata['company_id'])
			->where('active','1')
			->order_by('companyname');
		$query = $ci->db->get();
		$data = '<select class="form-control" name="member_id">';
		foreach($query->result_array() as $member) {
			$selected = "";
			if($member_id && $member_id == $member['id']) {
				$selected = 'selected="selected"';
			}
			$data .= '<option '.$selected.' value='.$member['id'].'>'.$member['companyname']." [".$member['name']."]".'</option>';
		}
		$data .= "</select>";
	return $data;
	}
	
	function get_subscription_details_dropdown($details_id = null) {
		$ci = & get_instance();
		$ci->db->select('id,subscription_type,subscription_term,subscription_issues,subscription_amount')
			->from('subscription_details')
			->where('company_id',$ci->session->userdata['company_id'])
			->where('active','1')
			->order_by('subscription_type');
		$query = $ci->db->get();
		$data = '<select class="form-control" onchange="set_subscription_price()" name="subscription_details_id" id="subscription_details_id">';
		$data .= '<option value="0">Select Subscription Type</option>';
		foreach($query->result_array() as $subscription) {
			$selected = "";
			if($details_id && $details_id  == $subscription['id']) {
				$selected = 'selected="selected"';
			}
			
			$data .= '<option '.$selected.' value='.$subscription['id'].'>'.$subscription['subscription_type']." [".$subscription['subscription_term']."][Issues-".$subscription['subscription_issues'].']</option>';
		}
		$data .= "</select>";
	return $data;
	}
}

function pr($data, $die = true)
{
	echo "<pre>";
		print_r($data);
	echo "</pre>";

	if($die)
	{
		die("ForceStop");
	}
}




 // recursive fn, converts three digits per pass
function convertTri($num, $tri) 
{
$ones = array(
 "",
 " one",
 " two",
 " three",
 " four",
 " five",
 " six",
 " seven",
 " eight",
 " nine",
 " ten",
 " eleven",
 " twelve",
 " thirteen",
 " fourteen",
 " fifteen",
 " sixteen",
 " seventeen",
 " eighteen",
 " nineteen"
);
 
$tens = array(
 "",
 "",
 " twenty",
 " thirty",
 " forty",
 " fifty",
 " sixty",
 " seventy",
 " eighty",
 " ninety"
);
 
$triplets = array(
 "",
 " thousand",
 " million",
 " billion",
 " trillion",
 " quadrillion",
 " quintillion",
 " sextillion",
 " septillion",
 " octillion",
 " nonillion"
);
 
  
  // chunk the number, ...rxyy
  $r = (int) ($num / 1000);
  $x = ($num / 100) % 10;
  $y = $num % 100;
 
  // init the output string
  $str = "";
 
  // do hundreds
  if ($x > 0)
   $str = $ones[$x] . " hundred";
 
  // do ones and tens
  if ($y < 20)
   $str .= $ones[$y];
  else
   $str .= $tens[(int) ($y / 10)] . $ones[$y % 10];
 
  // add triplet modifier only if there
  // is some output to be modified...
  if ($str != "")
   $str .= $triplets[$tri];
 
  // continue recursing?
  if ($r > 0)
   return convertTri($r, $tri+1).$str;
  else
   return $str;
 }
 
function convertNumberToWord($num) 
{
	$num = (int) $num;
 	
 	if ($num < 0)
  		return "negative".convertTri(-$num, 0);
 
 	if ($num == 0)
  		return "zero";
 
 	return ucwords(convertTri($num, 0));
}
 
