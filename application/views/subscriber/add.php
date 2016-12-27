<?php
$this->load->helper('form');
 echo form_open('subscriber/add');?>
 
<script>
	$(document).ready(function () {
	
		$('#subscribe_to_date').datepicker({ 
			dateFormat: 'yy' 
			});

		$('#subscribe_from_date').datepicker({ 
			dateFormat: 'yy'
			 });
	
		});
</script> 
 
<div class="col-md-12">
<!-- general form elements disabled -->
	<div class="box box-warning">
	<div class="box-header">
		<h3 class="box-title">Subscribe User</h3>
	</div><!-- /.box-header -->
	<div class="box-body">
		<!-- text input -->
		<div class="form-group">
			<label>Company Name</label>
			
			<input type="text" class="form-control" name="company_name" value="<?php echo $this->session->userdata['company_name'];?>" disabled="disabled">
			<input type="hidden" class="form-control" name="company_id" value="<?php echo $this->session->userdata['user_id'];?>">
		</div>
		
		<div class="form-group">
			<label>Select Member</label>
			<?php $member_dropdown = get_members_dropdown();
			echo $member_dropdown;?>
		</div>
		<div class="form-group">
		</div>
		
		<div class="form-group">
			<label>Select Subscription Details</label>
			<?php $subscription_dropdown = get_subscription_details_dropdown();
			echo $subscription_dropdown;?>
		</div>
		
		<div class="form-group">
			<label>Subscription Type </label>
			<label><input type="radio" name="subscribe_type"  checked="checked"  class="form-control" value="free">Free</label>
			<label><input type="radio" name="subscribe_type" class="form-control" value="paid">Paid</label>
			<label><input type="radio" name="subscribe_type" class="form-control" value="vip">VIP</label>
		</div>
		
		<div class="form-group">
			<label>Subscription Fees</label>
			<input type="text" class="form-control" name="subscribe_amount" placeholder="Subscription Fees">
		</div>
		
		<div class="form-group">
			<label>Subscription From Date</label>
			<input type="text" name="subscribe_from_date" id="subscribe_from_date" class="form-control" >
		</div>
		
		<div class="form-group">
			<label>Subscription To Date</label>
			<input type="text" name="subscribe_to_date" id="subscribe_to_date" class="form-control" >
		</div>
		
		<div class="form-group">
			<label>Subscription Remind</label>
			<label><input type="radio" name="subscribe_remind" class="form-control" value="1">Yes</label>
			<label><input type="radio" name="subscribe_remind" checked="checked" class="form-control" value="1">No</label>
		</div>
		
		<div class="form-group">
			<label>Subscription Remind before Days : </label>
			<input type="text" name="subscribe_remind_before" class="form-control"> 
		</div>
		
		<div class="form-group">
			<label>Subscription Auto Renew </label>
			<label><input type="radio" name="auto_renew" class="form-control" value="1">Yes</label>
			<label><input type="radio" name="auto_renew" checked="checked" class="form-control" value="1">No</label>
		</div>
		
		
		
		<div class="form-group">
			<label>Notes </label>
			<textarea name="notes" rows="4" cols="100"></textarea>
		</div>
		
	</div><!-- /.box-body -->
	</div><!-- /.box -->
</div>

<div class="col-md-6">
	<div class="form-group">
			<input type="hidden" class="form-control" name="company_id" value="<?php echo $this->session->userdata['company_id'];?>">
			<input type="submit" name="save" value="Save">
		</div>
</div>
</form>
