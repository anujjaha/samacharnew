<link href="<?php echo base_url('assets/css/datatables/dataTables.bootstrap.css');?>" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.fancybox.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/fancybox/jquery.fancybox.css?v=2.1.5" media="screen" />
<div class="row">
<div class="col-md-12">
	<a href="<?php echo base_url();?>advertisement/add">
		Add New Advertisement 
	</a>
	</div>
</div>
<div class="box">
	<div class="box-body table-responsive">
		<table id="example1" class="example1 table table-bordered table-striped">
		<thead>
		<tr>
		<th>Sr</th>
		<th>Company Name</th>
		<th>Contact Person</th>
		<th>Amount</th>
		<th>From</th>
		<th>To</th>
		<th>Status</th>
		</tr>
		</thead>
	<tbody>
		<?php
		$sr =1;	
		foreach($advertisers as $advertise) { 
			?>
		<tr>
		<td><?php echo $sr;?></td>
		<td><?php echo $advertise['companyname'] ?  $advertise['companyname'] : $advertise['name'];?></td>
		<td><?php echo $advertise['contact_person']."<br>".$advertise['contact_number'];?></td>
		<td><?php echo $advertise['cost'];?></td>
		<td><?php echo date('d-m-Y',strtotime($advertise['duration_from']));?></td>
		<td><?php echo date('d-m-Y',strtotime($advertise['duration_to']));?></td>
		<td><?php
				$today_date = date('Y-m-d');
				$curr_time=date('Y-m-d', strtotime($today_date));;
				
				$contractDateBegin = date('Y-m-d', strtotime($advertise['duration_from']));
					$contractDateEnd = date('Y-m-d', strtotime($advertise['duration_to']));
					$status =" <span class='red'>Expire</span>";
					if (($today_date >= $contractDateBegin) && ($today_date <= $contractDateEnd))
					{
					  $status =" <span class='green'>Active</span>";
					}
				echo $status;
				?>
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
</script>            
