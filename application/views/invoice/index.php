<link href="<?php echo base_url('assets/css/datatables/dataTables.bootstrap.css');?>" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.fancybox.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/fancybox/jquery.fancybox.css?v=2.1.5" media="screen" />
<div class="row">
<div class="col-md-12">
	<a href="<?php echo base_url();?>invoice/add">
		Create New Invoice
	</a>
	</div>
</div>
<div class="box">
	<div class="box-body table-responsive">
		<table id="example1" class="example1 table table-bordered table-striped">
		<thead>
		<tr>
		<th>Sr</th>
		<th>Invoice Identity</th>
		<th>Company Name</th>
		<th>Name</th>
		<th>Mobile</th>
		<th>Email Id</th>
		<th>Invoice Cost</th>
		<th>Action</th>
		</tr>
		</thead>
	<tbody>
		<?php
		$sr =1;	
		foreach($invoices as $invoice) 
		{ 
		?>
		<tr>
		<td><?php echo $sr;?></td>
		<td><?php echo $invoice['invoice_title'];?></td>
		<td><?php echo $invoice['companyname'];?></td>
		<td><?php echo $invoice['name'];?></td>
		<td><?php echo $invoice['mobile'];?></td>
		<td><?php echo $invoice['emailid'];?></td>
		<td><?php echo $invoice['grand_total'];?></td>
		<td>
			<a href="#invoiceDetails" onclick="getInvoiceDetails(<?php echo $invoice['id'];?>)" class="fancybox"> <i class="fa fa-eye fa-2x" aria-hidden="true"></i></a>
			||||||
			<a href="javascript:void(0);" onclick="getInvoicePdf(<?php echo $invoice['id'];?>)"> <i class="fa fa-print fa-2x" aria-hidden="true"></i></a>
		</td>
		</tr>
		<?php $sr++; } ?>
	</tfoot>
	</table>
	</div><!-- /.box-body -->
	</div><!-- /.box -->
	</div>

<script src="<?php echo base_url('assets/js/plugins/datatables/jquery.dataTables.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/plugins/datatables/dataTables.bootstrap.js')?>" type="text/javascript"></script>

<div id="invoiceDetails"></div>
<script type="text/javascript">
            $(function() {
                $('#example1').dataTable({
                    "bPaginate": true,
                    "bLengthChange": true,
                    "iDisplayLength": 50,
                    "bFilter": true,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": true,
                    "bDestroy": true,
                });
            });
    
    $(document).ready(function() {
      $('.fancybox').fancybox({
        'width':900,
        'height':600,
        'autoSize' : false,
    });
});

function getInvoiceDetails(invoiceId)
{
	jQuery.ajax(
	{
		url: 		"<?php echo site_url();?>ajax/getInvoiceDetails",
		type: 		'POST',
		dataType: 	'HTML',
		data: {
			'invoiceId': invoiceId
		},
		success: function(data)
		{
			jQuery("#invoiceDetails").html(data);
		},
		error: function(data)
		{

		},
		complete: function(data)
		{
			console.log("Ajax Completed");
		}
	});
}

function getInvoicePdf(invoiceId)
{
	jQuery.ajax(
	{
		url: 		"<?php echo site_url();?>ajax/getInvoicePDF",
		type: 		'POST',
		dataType: 	'JSON',
		data: {
			'invoiceId': invoiceId
		},
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
