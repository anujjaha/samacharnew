<style>
td {
	font-size: 18px;
}
</style>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.fancybox.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/fancybox/jquery.fancybox.css?v=2.1.5" media="screen" />
<div class="row">
	<div class="col-md-12">
		Subscription Receipt
	</div>
</div>
<div class="box">
	<div class="box-body table-responsive">
		<div class="text-center">
			<span class="btn btn-success btn-lg download">
				Download
			</span>
		</div>
		<table class="table" border="2" width="100%">
			<tr>
				<td width="70%">
					<table width="100%">  
					<tr>
						<td>
							<strong> Received with Thanks From 
						</td>
					</tr>
					<tr>
						<td><strong>Name:</strong> <?php echo $member['companyname'];?> (<?php echo $member['name'];?>)</td>
					</tr>
					<tr>
						<td>
							<strong>Address:</strong> <?php echo $member['add1'].$member['add2'];?>
							<br>
							<?php echo $member['city']. ', ' .$member['state']. ' '.$member['pincode'];?>
						</td>
					</tr>
					<tr>
						<td>
							Total Paid: <?php echo $subscribe->subscribe_amount;?>
						</td>
					</tr>
					<tr>
						<td>
							Payment : Cash
						</td>
					</tr>
					<tr>
						<td>
							Subscription Details : <br>
							<table width="100%" border="2">
								<tr>
									<td>From</td>
									<td>TO</td>
									<td>Year</td>
									<td>Issue</td>
								</tr>
								<tr>
									<td><?php echo date('m-d-Y', strtotime($subscribe->subscribe_from_date)) ;?></td>
									<td><?php echo date('m-d-Y', strtotime($subscribe->subscribe_to_date));?></td>
									<td>2017</td>
									<td>12</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td>
							Subject To Ahmedabad Jurdiction - Subject to Realization of Cheque
						</td>
					</tr>
					<tr>
						<td>
							<hr>
						</td>
					</tr>
					<tr>
						<td>
							<?php echo $company['address'];?>
							<br>
							<?php echo $company['city']. " ".$company['state']. " ". $company['pincode'];?>
							<br>
							Mobile : <?php echo $company['mobile'];?>
							<br>
							Email Id : <?php echo $company['emailid'];?>
						</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>	
					<tr>
						<td>Signature: ______________________________</td>
					</tr>
					</table>
				</td>

				<td width="30%">
					<?php
						if(isset($company['logo']) && file_exists('assets/companylogo/'. $company['logo']))
						{
					?>
						<img src="<?php echo site_url('assets/companylogo/'. $company['logo']);?>"
					<?php
						}
						else
						{
					?>
						<h1> <?php echo $company['name'];?>
					<?php
						}
					?>
					<br>
					<center><h4>SUBSCRIPTION</h4></center>
					<hr>
					<center><h4>
						RECEIPT NUMBER
						<br>
						S : <?php echo $subscribe->id;?>
					</h4></center>
					<hr>
					<center><h4>
						Date
						<br>
						 <?php echo date('m-d-Y', strtotime($subscribe->created));?>
					</h4></center>
					<hr>
					<center><h4>
						Amount
						<br>
						 <?php echo $subscribe->subscribe_amount;?>
					</h4></center>
					<hr>
					<center><h4>
						<?php echo $company['owner'];?>
						<br>
						<?php echo $company['name'];?>
					</h4></center>
					
				</td>
			</tr>
		</table>
	</div>
</div>

<input type="hidden" name="receipt_id" id="receipt_id" value="<?php echo $subscribe->id;?>">
<script type="text/javascript">
	
	jQuery(document).ready(function()
	{
		jQuery(".download").on('click', function()
		{
			downloadReceipt();
		})
	})

function downloadReceipt()
{
	var id = jQuery("#receipt_id").val();

	jQuery.ajax(
	{
		method: 	"POST",
	 	url: 		"<?php echo site_url();?>/ajax/download_receipt/"+id, 
	 	dataType: 	'JSON',
	 	success: function(data)
	 	{
	 		if(data.status == true)
	 		{
	 			window.open(data.url, '_blank');
	 		}
	 	},
	 	error: function(data)
	 	{
	 		alert("Unable to Generate PDF");
	 	},
	 	complete: function(data)
	 	{
	 		console.log("Ajax Completed");
	 	}
  	});
}
</script>
        
