<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('company_model');
		$this->load->model('subscriber_model');
		$this->load->model('advertisement_model');
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
	public function delete_subscriber($id) {
		if($id) {
			$status = $this->subscriber_model->delete_subscriber($id);
			return true;
		}
		return false;
	}
	
	public function advertisement_cost_calculate() {
		if($this->input->post()) {
			$ids = $this->input->post('ids');
			$total = $this->advertisement_model->estimate_cost(implode(",",$ids));
			echo $total;
			die;
		}
		return false;
	}     
	
	public function getInvoiceDetails()
	{
		if($this->input->post())
		{
			$this->load->model('invoice_model');
			$invoiceId = $this->input->post('invoiceId');
			
			$invoiceData = $this->invoice_model->getFullInvoiceById($invoiceId);
			return $this->load->view('ajax/invoice_details', $invoiceData);
		}
	}

	public function getInvoicePDF()
	{
		if($this->input->post())
		{
			$this->load->model('invoice_model');
			$this->load->model('company_model');
			$this->load->model('member_model');

			$invoiceId 		= $this->input->post('invoiceId');
			$invoiceData 	= $this->invoice_model->getFullInvoiceById($invoiceId);

			$companyInfo = $this->company_model->get_company('id', $invoiceData['invoiceInfo']->company_id);
			$memberInfo  = $this->member_model->get_member('id', $invoiceData['invoiceInfo']->member_id);

			$memberInfo 	= $memberInfo[0];
			$companyInfo 	= $companyInfo[0];
			$image = '';
			if(isset($companyInfo['logo']) && strlen($companyInfo['logo']) > 1)
			{
				$img = $companyInfo['logo'];

				$image =  "<img width='200px' height='100px' src='" .site_url('assets/companylogo/'.$companyInfo['logo']). "'>";
			}

			$html = '';

			$html ='<table align="center" border="2" width="800px; border: 2px solid black;">
				<tr>
					<td style="width: 500px; font-size: 16px; border: 2px solid black;">
						<h3>'. $companyInfo['name'] .'</h3>
						<br>
						' .$companyInfo['address']. '<br>
						' .$companyInfo['city']. " ". $companyInfo['state'].  '<br>
						Phone : ' .$companyInfo['mobile'].  '<br>
						Email Id : ' .$companyInfo['emailid'].  '<br>
					</td>
					<td align="center" style="width: 300px; font-size: 16px; border: 2px solid black;">
						' .$image. '
					</td>
				</tr>
				<tr>
					<td> &nbsp; </td>
					<td> &nbsp; </td>
				</tr>
				<tr>
					<td style="width: 500px; font-size: 16px; border: 2px solid black;">
						<h4>' .$memberInfo['companyname'] . '( ' .$memberInfo['name']. ' )</h4>
						<br>
						'. $memberInfo['add1'] . ' ,
						'. $memberInfo['add2'] . '
						<br>
						'. $memberInfo['city'] . ' ,
						'. $memberInfo['state'] . ',
						'. $memberInfo['pincode'] . '.
						<br>
						Email Id : ' .$memberInfo['emailid']. ' <br>
					</td>
					<td style="width: 300px; font-size: 16px; border: 2px solid black;" align="center">
						<br>
						Invoice No : ' .$invoiceData['invoiceInfo']->id. '
						<br>
						Invoice Date : ' .date("m-d-Y", strtotime($invoiceData['invoiceInfo']->created_at)). '
					</td>
				</tr>
				<tr>
					<td> &nbsp; </td>
					<td> &nbsp; </td>
				</tr>
				<tr>
					<td colspan="2" style="border: 2px solid black;">
						<table style="width:800px; height: 500px; border: 2px solid black;">
							<tr>
								<td align="center" style="width: 500px; border: 2px solid black; font-size: 16px;">Description</td>
								<td align="center" style="width: 150px; border: 2px solid black; font-size: 16px;">Rate (in RS.)</td>
								<td align="center" style="width: 150px; border: 2px solid black; font-size: 16px;">Amount (in RS.)</td>
							</tr>';
						for($i = 0; $i < 7; $i++)
						{
							$title = $rate = $subtotal = '&nbsp;';
							if(isset($invoiceData['invoiceItems'][$i]))
							{
								$title 		= $invoiceData['invoiceItems'][$i]['item_details'];
								$rate  		= $invoiceData['invoiceItems'][$i]['rate'];
								$subtotal 	= $invoiceData['invoiceItems'][$i]['subtotal'];
							}
							
							$html .= '<tr>
								<td style="width: 500px; border: 2px solid black; font-size: 14px; padding: 5px;">' .$title. '</td>
								<td align="center" style="width: 150px; border: 2px solid black; font-size: 14px; padding: 10px;"> '.$rate .' </td>
								<td align="right" style="width: 150px; border: 2px solid black; font-size: 14px; padding: 10px;"> ' .$subtotal. ' </td>
							</tr>';
						}
						$html .= '<tr>
									<td align="right" colspan="2" style="width: 500px; border: 2px solid black; font-size: 14px; padding: 10px;">Sub Total
									</td>
									<td align="right" style="width: 150px; border: 2px solid black; font-size: 14px; padding: 10px;">
									'. $invoiceData['invoiceInfo']->sub_total .'
									</td>
								</tr>
								<tr>
									<td align="right" colspan="2" style="width: 500px; border: 2px solid black; font-size: 14px; padding: 10px;">Tax
									</td>
									<td align="right" style="width: 150px; border: 2px solid black; font-size: 14px; padding: 10px;">
									'. $invoiceData['invoiceInfo']->tax .'
									</td>
								</tr>
								<tr>
								<td align="right" colspan="2" style="width: 500px; border: 2px solid black; font-size: 14px; padding: 10px;">Total
								</td>
								<td align="right" style="width: 150px; border: 2px solid black; font-size: 14px; padding: 10px;">
								'.  $invoiceData['invoiceInfo']->grand_total .'
								</td>
								</tr>
							</table>
					</td>
				</tr>
				<tr>
					<td> &nbsp; </td>
					<td> &nbsp; </td>
				</tr>
				<tr>
					<td style="width: 500px; font-size: 18px; border: 2px solid black;">
						Bank Details : Central Bank of India 
						<br>
						Branch : Naranpura, Ahmedabad
						<br>
						A/C No. : 32 73 38 05 90
						<br>
						IFSC Code : CNBIN0281404

						<br><br>
						PAN NUMBER : ACPPP9223R
						<br>
						(Mr. Narendra Parmar)
					</td>
					<td style="width: 300px; font-size: 18px; border: 2px solid black;"></td>
				</tr>
				<tr>
					<td> &nbsp; </td>
					<td> &nbsp; </td>
				</tr>
				<tr>
					<td style="width: 500px; font-size: 16px; border: 2px solid black;">
						Payment requeseted by CROSSED ORDER or PAYEES A/C ONLY CHEQUE.
						<br>
						If payment is not made within 60 days, 24% p.a. interest will be charged.
						<br>
						Subject to Ahmedabad Jurdiction only.
						<br>
						<br>
						Checked by 
					</td>
					<td align="center" style="width: 300px; border: 2px solid black; font-size: 22px;">
						<strong>For, '. $companyInfo['name'] . '</strong>
						<br><br><br><br>
						Authorized Signatory
					</td>
				</tr>
			</table>';

			$link = create_pdf($html, 'A4');

			echo json_encode(array(
				'status' 	=> true,
				'url'		=> $link
			));
			
			die;
		}
	}
}
