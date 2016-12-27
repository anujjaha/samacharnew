<link href="<?php echo base_url('assets/css/datatables/dataTables.bootstrap.css');?>" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.fancybox.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/fancybox/jquery.fancybox.css?v=2.1.5" media="screen" />
<div class="row">
<div class="col-md-12">
	<a href="<?php echo base_url();?>advertisement_details/add">
		Add New Advertisement Rate
	</a>
	</div>
</div>
<div class="box">
	<div class="box-body table-responsive">
		<table id="example1" class="example1 table table-bordered table-striped">
		<thead>
		<tr>
		<th>Sr</th>
		<th>Advertisement Name</th>
		<th>Advertisement Amount</th>
		<th>Advertisement Term</th>
		<th>Advertisement Size</th>
		<th>Edit</th>
		</tr>
		</thead>
	<tbody>
		<?php
		$sr =1;	
		foreach($advertisements as $advertise) { 
			?>
		<tr>
		<td><?php echo $sr;?></td>
		<td><?php echo $advertise['advertisement_type'];?></td>
		<td><?php echo $advertise['advertisement_amount'];?></td>
		<td><?php echo $advertise['advertisement_term'];?></td>
		<td><?php echo $advertise['advertisement_size'];?></td>
		<td>
			<a href="<?php echo base_url();?>advertisement_details/edit/<?php echo $advertise['id'];?>">Edit</a>
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
