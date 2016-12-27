<?php
$this->load->helper('form');
 echo form_open('advertisement_details/add');?>
<div class="col-md-12">
<!-- general form elements disabled -->
	<div class="box box-warning">
	<div class="box-header">
		<h3 class="box-title">Advertisement Details</h3>
	</div><!-- /.box-header -->
	<div class="box-body">
		<!-- text input -->
		<div class="form-group">
			<label>Advertisement Name ( Type ) :</label>
			<input type="text" class="form-control" name="advertisement_type" placeholder="Advertisement Name (Type)" required="required">
		</div>
		<div class="form-group">
			<label>Advertisement Term</label>
			<input type="text" class="form-control" name="advertisement_term" placeholder="Advertisement Term" required="required">
		</div>
		<div class="form-group">
			<label>Advertisement Amount</label>
			<input type="text" class="form-control" name="advertisement_amount" placeholder="Advertisement Amount" required="required">
		</div>
		<div class="form-group">
			<label>Advertisement Size</label>
			<input type="text" class="form-control" name="advertisement_size" placeholder="Advertisement Size" required="required">
		</div>
		
	</div><!-- /.box-body -->
	</div><!-- /.box -->
</div>

<div class="col-md-12">
	<div class="form-group">
			<input type="hidden" class="form-control" name="company_id" value="<?php echo $this->session->userdata['company_id'];?>">
			<input type="submit" name="save" value="Save">
		</div>
</div>
</form>
