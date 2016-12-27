<link href="<?php echo base_url('assets/css/datatables/dataTables.bootstrap.css');?>" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.fancybox.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/fancybox/jquery.fancybox.css?v=2.1.5" media="screen" />
<div class="row">
<div class="col-md-12">
	<a href="<?php echo base_url();?>member/add">
		Add New Member
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
		<th>Name</th>
		<th>Mobile</th>
		<th>Email Id</th>
		<th>Address</th>
		<th>City</th>
		<th>Pincode	</th>
		<th>State</th>
		<th>Status</th>
		<th>Edit</th>
		<th>View</th>
		</tr>
		</thead>
	<tbody>
		<?php
		$sr =1;	
		foreach($members as $member) { 
			?>
		<tr>
		<td><?php echo $sr;?></td>
		<td><?php echo $member['companyname'];?></td>
		<td><?php echo $member['name'];?></td>
		<td><?php echo $member['mobile'];?></td>
		<td><?php echo $member['emailid'];?></td>
		<td><?php echo $member['add1']."<br>".$member['add2'];?></td>
		<td><?php echo $member['city'];?></td>
		<td><?php echo $member['pincode'];?></td>
		<td><?php echo $member['state'];?></td>
		<td><?php 
			if($member['active'] ==1 ) { 
				echo '<span class="green">Active</span>'; 
			} else {
				echo '<span class="red">Inactive</span>'; 
			}	
			?></td>
		<td>
			<a href="<?php echo base_url();?>member/edit/<?php echo $member['id'];?>">Edit</a>
		</td>
		<td>
			<a href="#">View</a>
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
