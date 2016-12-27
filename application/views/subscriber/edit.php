<?php
$this->load->helper('form');
 echo form_open('subscriber/edit/'.$subscribe_details->subscribe_id);?>
 
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
		<h3 class="box-title">Edit Subscribe User</h3>
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
			<?php $member_dropdown = get_members_dropdown($subscribe_details->member_id);
			echo $member_dropdown;?>
		</div>
		<div class="form-group">
		</div>
		
		<div class="form-group">
			<label>Select Subscription Details</label>
			<?php $subscription_dropdown = get_subscription_details_dropdown($subscribe_details->subscription_details_id);
			echo $subscription_dropdown;?>
		</div>
		
		<div class="form-group">
			<label>Subscription Type </label>
			<label><input type="radio" name="subscribe_type"  <?php if($subscribe_details->subscribe_type == 'free') { echo 'checked="checked"'; } ?> class="form-control" value="free">Free</label>
			<label><input type="radio" name="subscribe_type"  <?php if($subscribe_details->subscribe_type == 'paid') { echo 'checked="checked"'; } ?> class="form-control" value="paid">Paid</label>
			<label><input type="radio" name="subscribe_type"  <?php if($subscribe_details->subscribe_type == 'vip') { echo 'checked="checked"'; } ?> class="form-control" value="vip">VIP</label>
		</div>
		
		<div class="form-group">
			<label>Subscription Fees</label>
			<input type="text" class="form-control" name="subscribe_amount" placeholder="Subscription Fees" value="<?php echo $subscribe_details->subscribe_amount; ?>">
		</div>
		
		<div class="form-group">
			<label>Subscription From Date</label>
			<input type="text" name="subscribe_from_date" id="subscribe_from_date" class="form-control" value="<?php echo $subscribe_details->subscribe_from_date; ?>">
		</div>
		
		<div class="form-group">
			<label>Subscription To Date</label>
			<input type="text" name="subscribe_to_date" id="subscribe_to_date" class="form-control" value="<?php echo $subscribe_details->subscribe_to_date; ?>">
		</div>
		
		<div class="form-group">
			<label>Subscription Remind</label>
			<label><input type="radio" name="subscribe_remind" <?php if($subscribe_details->subscribe_remind == '1') { echo 'checked="checked"'; } ?>  class="form-control" value="1">Yes</label>
			<label><input type="radio" name="subscribe_remind" <?php if($subscribe_details->subscribe_remind == '0') { echo 'checked="checked"'; } ?> class="form-control" value="0">No</label>
		</div>
		
		<div class="form-group">
			<label>Subscription Remind before Days : </label>
			<input type="text" name="subscribe_remind_before" class="form-control" value="<?php echo $subscribe_details->subscribe_remind_before; ?>"> 
		</div>
		
		<div class="form-group">
			<label>Subscription Auto Renew </label>
			<label><input type="radio" name="auto_renew" <?php if($subscribe_details->auto_renew == '1') { echo 'checked="checked"'; } ?> class="form-control" value="1">Yes</label>
			<label><input type="radio" name="auto_renew" <?php if($subscribe_details->auto_renew == '0') { echo 'checked="checked"'; } ?> class="form-control" value="0">No</label>
		</div>
		
		
		
		<div class="form-group">
			<label>Notes </label>
			<textarea name="notes" rows="4" cols="100"><?php echo $subscribe_details->notes; ?></textarea>
		</div>
		
	</div><!-- /.box-body -->
	</div><!-- /.box -->
</div>

<div class="col-md-6">
	<div class="form-group">
			<input type="hidden" name="subscribe_id" value="<?php echo $subscribe_details->subscribe_id;?>">
			<input type="submit" name="save" value="Save">
		</div>
</div>
</form>
