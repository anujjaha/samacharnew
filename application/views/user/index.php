<link href="<?php echo base_url('assets/css/datatables/dataTables.bootstrap.css');?>" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.fancybox.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/fancybox/jquery.fancybox.css?v=2.1.5" media="screen" />
<div class="row">
<div class="col-md-12">
	<a href="<?php echo base_url();?>company/add">
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
		<th>Owner</th>
		<th>Mobile</th>
		<th>Email Id</th>
		<th>Status</th>
		<th>Total Members</th>
		<th>Edit</th>
		<th>View</th>
		</tr>
		</thead>
	<tbody>
		<?php
		$sr =1;	
		foreach($companies as $comp) { 
			?>
		<tr>
		<td><?php echo $sr;?></td>
		<td><?php echo $comp['name'];?></td>
		<td><?php echo $comp['owner'];?></td>
		<td><?php echo $comp['mobile'];?></td>
		<td><?php echo $comp['emailid'];?></td>
		<td><?php 
			if($comp['active'] ==1 ) { 
				echo '<span class="green">Active</span>'; 
			} else {
				echo '<span class="red">Inactive</span>'; 
			}	
			?></td>
		<td><?php echo $comp['total_members'];?></td>
		<td>
			<a href="<?php echo base_url();?>company/edit/<?php echo $comp['id'];?>">Edit</a>
		</td>
		<td>
			<a href="<?php echo base_url();?>company/set_company/<?php echo $comp['id'];?>">GO</a>
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
