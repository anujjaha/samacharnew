<link href="<?php echo base_url('assets/css/datatables/dataTables.bootstrap.css');?>" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.fancybox.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/fancybox/jquery.fancybox.css?v=2.1.5" media="screen" />
<div class="row">
<div class="col-md-12">
	<a href="<?php echo base_url();?>subscriber/add">
		Add New Subscriber
	</a>
	</div>
</div>
<div class="box">
	<div class="box-body table-responsive">
		<table id="example1" class="example1 table table-bordered table-striped">
		<thead>
		<tr>
		<th>Sr</th>
		<th>Member Name</th>
		<th>Subscription Type</th>
		<th>Subscription Fees</th>
		<th>Subscription Term</th>
		<th>Subscription From</th>
		<th>Subscription To</th>
		<th>Subscription Status</th>
		<th>Edit</th>
		<th>Receipt</th>
		<th>Delete</th>
		</tr>
		</thead>
	<tbody>
		<?php
		$sr =1;	
		foreach($subscribers as $subscriber) { 
			
			//print_r($subscriber);die;
			
			$today_date = date('Y-m-d');
			$today_date=date('Y-m-d', strtotime($today_date));;
			//echo $paymentDate; // echos today! 
			$contractDateBegin = date('Y-m-d', strtotime($subscriber['subscribe_from_date']));
			$contractDateEnd = date('Y-m-d', strtotime($subscriber['subscribe_to_date']));
			$status ="Expire";
			if (($today_date > $contractDateBegin) && ($today_date < $contractDateEnd))
			{
			  $status ="Active";
			}
			?>
		<tr id="subscribe_row_<?php echo $subscriber['subscribe_id'];?>">
		<td><?php echo $sr;?></td>
		<td><?php echo $subscriber['companyname']."<br". $subscriber['name'];?></td>
		<td><?php echo $subscriber['subscription_type'];?></td>
		<td><?php echo $subscriber['subscribe_amount'];?></td>
		<td><?php echo $subscriber['subscription_term'];?></td>
		<td><?php echo $subscriber['subscribe_from_date'];?></td>
		<td><?php echo $subscriber['subscribe_to_date'];?></td>
		<td><?php echo  $status ;?></td>
		<td>
			<a href="<?php echo base_url();?>subscriber/edit/<?php echo $subscriber['subscribe_id'];?>">
				Edit
			</a>
		</td>
		<td>
			<a href="<?php echo base_url();?>subscriber/receipt/<?php echo $subscriber['subscribe_id'];?>">
				Receipt
			</a>
		</td>
		<td>
			<a href="javascript:void(0);" onclick="delete_subscription(<?php echo $subscriber['subscribe_id'];?>);">
				Delete
			</a>
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

function delete_subscription(id) {
	var status = confirm("Are you sure want to Delete Subscription ?");
	if(status) {
		jQuery("#subscribe_row_"+id).hide();
		$.ajax({
		 method: "POST",
		 url: "<?php echo site_url();?>/ajax/delete_subscriber/"+id, 
		 success: 
			function(data){
				return true;
			}
	  });
	return true;
	}
	return true;
}
</script>            
