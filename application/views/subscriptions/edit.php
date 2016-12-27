<?php
$subscription = $subscription_details[0];
$this->load->helper('form');
 echo form_open('subscription_details/edit');?>
<div class="col-md-12">
<!-- general form elements disabled -->
	<div class="box box-warning">
	<div class="box-header">
		<h3 class="box-title">Subscription Details</h3>
	</div><!-- /.box-header -->
	<div class="box-body">
		<!-- text input -->
		<div class="form-group">
			<label>Subscription Name ( Type ) :</label>
			<input type="text" class="form-control" name="subscription_type" value="<?php echo $subscription['subscription_type'];?>" placeholder="Subscription Name (Type)" required="required">
		</div>
		<div class="form-group">
			<label>Subscription Term</label>
			<input type="text" class="form-control" name="subscription_term"  value="<?php echo $subscription['subscription_term'];?>"  placeholder="Subscription Term" required="required">
		</div>
		<div class="form-group">
			<label>Subscription Amount</label>
			<input type="text" class="form-control" name="subscription_amount"  value="<?php echo $subscription['subscription_amount'];?>"  placeholder="Subscription Amount" required="required">
		</div>
		
	</div><!-- /.box-body -->
	</div><!-- /.box -->
</div>

<div class="col-md-12">
	<div class="form-group">
			<input type="hidden" class="form-control" name="company_id" value="<?php echo $this->session->userdata['company_id'];?>">
			<input type="hidden" class="form-control" name="id" value="<?php echo $subscription['id'];?>">
			<input type="submit" name="save" value="Save">
		</div>
</div>
</form>
