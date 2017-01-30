<?php
$this->load->helper('form');
 echo form_open('subscriber/add');?>
 
<script>
	$(document).ready(function () {
	
		$('#subscribe_to_date').datepicker({ 
			dateFormat: 'd-m-Y' 
			});

		$('#subscribe_from_date').datepicker({ 
			dateFormat: 'd-m-Y' 
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
			<input type="text" class="form-control" name="subscribe_amount" id="subscribe_amount"   placeholder="Subscription Fees">
		</div>
		
		<div class="form-group">
			<label>Subscription From Date</label>
			<input type="text" name="subscribe_from_date" id="subscribe_from_date" class="form-control" value="<?php echo date('d-m-Y');?>">
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
<script type="text/javascript">
function set_subscription_price()
{
	var sbtype = jQuery("#subscription_details_id").val();

	if(sbtype == 0)
	{
		return;
	}

	jQuery.ajax(
	{
		url: "<?php echo site_url();?>/ajax/getSubscriptionChargeById/"+sbtype,
		type: 'POST',
		dataType: 'JSON',
		data: {
			'id': sbtype
		},
		success: function(data)
		{
			jQuery("#subscribe_amount").val(data.details.subscription_amount);
		},
		error: function(data)
		{

		}
	});
}

</script>