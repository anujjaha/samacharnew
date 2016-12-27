<?php
$this->load->helper('form');
 echo form_open('company/add');?>
<div class="col-md-6">
<!-- general form elements disabled -->
	<div class="box box-warning">
	<div class="box-header">
		<h3 class="box-title">Company Details</h3>
	</div><!-- /.box-header -->
	<div class="box-body">
		<!-- text input -->
		<div class="form-group">
			<label>Company Name</label>
			<input type="text" class="form-control" name="name" placeholder="Company Name" required="required">
		</div>
		<div class="form-group">
			<label>Owner Name</label>
			<input type="text" class="form-control" name="owner" placeholder="Owner Name" required="required">
		</div>
		<div class="form-group">
			<label>Mobile Number</label>
			<input type="text" class="form-control" name="mobile" placeholder="Mobile Number">
		</div>
		<div class="form-group">
			<label>Email Id</label>
			<input type="text" class="form-control" name="emailid" placeholder="Email Id">
		</div>
		
	</div><!-- /.box-body -->
	</div><!-- /.box -->
</div>

<div class="col-md-6">
<!-- general form elements disabled -->
	<div class="box box-warning">
	<div class="box-header">
		<h3 class="box-title">Address Details</h3>
	</div><!-- /.box-header -->
	<div class="box-body">
		<!-- text input -->
		<div class="form-group">
			<label>Address</label>
			<textarea name="address" class="form-control"  cols="60" rows="4"></textarea>
		</div>
		<div class="form-group">
			<label>City</label>
			<input type="text" class="form-control" name="city" placeholder="City">
		</div>
		<div class="form-group">
			<label>State</label>
			<input type="text" class="form-control" name="state" placeholder="State">
		</div>
		<div class="form-group">
			<label>Pincode</label>
			<input type="text" class="form-control" name="pincode" placeholder="Pincode">
		</div>
	</div><!-- /.box-body -->
	</div><!-- /.box -->
</div>
<div class="col-md-6">
	<div class="form-group">
			<input type="submit" name="save" value="Save">
		</div>
</div>
</form>
