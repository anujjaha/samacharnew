<?php
$this->load->helper('form');
 echo form_open('advertisement/add',array('type'=>'multipart/data'));
 
 $duration = array(1=>'1 Month',3=>'3 Month',6=>'6 Month',12=>'12 Month');
?>

<script>
$(function() {
   $( ".select-date" ).datepicker();
 });

var advertisement_types = <?php echo json_encode($advertisement_details);?>;	
function calculate_add_cost() {
	var add_ids = $("#advertisements_id").val();
		$.ajax({
		 type: "POST",
		 url: "<?php echo site_url();?>/ajax/advertisement_cost_calculate/", 
		 data : { 'ids':add_ids},
		 success: 
			function(data){
				$("#cost").val(data);
				return true;
			}
	  });
	return true;
	
}
var addCount = 1;
function add_row() 
{
	$("#multiple_row").append('<div class="clearfix"></div><br><div id="row_'+addCount+'" class="form-group"><label></label><div class="col-md-9"><input type="text" class="form-control select-date" style="width:400px;"  name="active_months[]"> </div><div class="col-md-3"><span onclick="delete_row('+addCount+');">Delete</span></div></div>');
 $( ".select-date" ).datepicker();
}

function abc() {
	//alert('asf');
}

function delete_row(id) {
	$("#row_"+id).remove();
}
</script>
<div class="col-md-12">
<!-- general form elements disabled -->
	<div class="box box-warning">
	<div class="box-header">
		<h3 class="box-title">Advertisement Details</h3>
	</div><!-- /.box-header -->
	<div class="box-body">
		<!-- text input -->
		<div class="form-group">
			<label> Select Customer :</label>
				<select name="customer_id" class="form-control" >
					<?php
						foreach($members as $member) {
					?>
					<option value="<?php echo $member['id'];?>"><?php echo $member['companyname'];?></option>
					<?php } ?>
				</select>
		</div>
		<div class="form-group">
			<label>Contact Person</label>
			<input type="text" class="form-control" name="contact_person" placeholder="Contact Person">
		</div>
		
		<div class="form-group">
			<label>Contact Number</label>
			<input type="text" class="form-control" name="contact_number" placeholder="Contact Number">
		</div>
		
		<div class="form-group">
			<label>Advertisement Details</label>
			<select name="advertisements_id" id="advertisements_id" onchange="calculate_add_cost()" multiple="multiple"> 
				<?php
				foreach($advertisement_details as $add_details) {
					?>
					<option value="<?php echo $add_details['id'];?>">
					<span onclick="abc()"><?php echo $add_details['advertisement_type'];?></span>
					</option>
				<?php } ?>
			</select>
		</div>
		<div class="form-group">
			<label>Advertisement Amount</label>
			<input type="text" class="form-control" name="cost" id="cost" placeholder="Advertisement Cost" required="required">
		</div>
		
		<div class="form-group">
			<label>Advance</label>
			<input type="text" class="form-control" name="advance" placeholder="Advance" value="0" required="required">
		</div>
		
		<div class="form-group">
			<label>Advertisement Duration</label>
				<select name="duration" class="form-control" >
					<?php
						foreach($duration as $key => $add_duration) {
					?>
					<option value="<?php echo $key;?>"><?php echo $add_duration;?></option>
					<?php } ?>
				</select>
		</div>
		<div class="form-group">
			<label>Duration From</label>
			<input type="text" class="form-control select-date" name="duration_from" placeholder="From">
		</div>
		
		<div class="form-group">
			<label>Duration To</label>
			<input type="text" class="form-control select-date" name="duration_to" placeholder="To">
		</div>
		<div class="form-group">
			<label>Advertisement Amount</label>
			<select name="pay_type">
				<option>Cash</option>
				<option>Cheque</option>
			</select>
		</div>
		
		<div class="form-group">
			<label>Bank Name</label>
			<input type="text" class="form-control" name="bank_name" placeholder="Bank Name">
		</div>
		
		<div class="form-group">
			<label>Cheque No.</label>
			<input type="text" class="form-control" name="cheque_no" placeholder="Cheque Number">
		</div>
		
		<div class="form-group">
			<label>Date</label>
			<input type="text" class="form-control" name="date" placeholder="Cheque Date">
		</div>
		
		<div class="form-group">
			<label>Notes</label>
			<textarea rows="4" name="notes" cols="100"></textarea>
		</div>
		
		<?php /*
		<div class="form-group">
			<label>Attach Design</label>
			<input type="file" class="form-control" name="attachment">
		</div>
		*/?>
		
		<div class="form-group">
			<div class="col-md-9">	
				<input type="text" style="width:400px;" class="form-control select-date" name="active_months[]">
			</div>
			<div class="col-md-3">	
				<span style="font-size:16px;cursor:pointer;" onclick="add_row();">
					Add
				</span>
			</div>
		</div>

		<div class="form-group">
			<div  id="multiple_row"></div>
		</div>
		
<div class="clearfix"></div>
	</div><!-- /.box-body -->
	</div><!-- /.box -->
</div>



<div class="clearfix"></div>

<div class="box box-success">
	<div class="box-body text-center">
		<div class="form-group">
			<input type="hidden" class="form-control" name="company_id" value="<?php echo $this->session->userdata['company_id'];?>">
			<input type="submit" name="save" value="Save" class="btn btn-primary"> 
			<input type="reset" name="rest" value="Reset" class="btn btn-primary">
			<a class="btn btn-primary" href="<?php echo $_SERVER['HTTP_REFERER'];?>">
				Cancel
			</a>
		</div>
	</div>
</div>


</form>
