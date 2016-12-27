<?php
$this->load->helper('form');
 echo form_open('company/edit');?>
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
			<input type="text" class="form-control" name="name" value="<?php echo $company[0]['name'];?>" placeholder="Company Name" required="required">
		</div>
		<div class="form-group">
			<label>Owner Name</label>
			<input type="text" class="form-control" name="owner" value="<?php echo $company[0]['owner'];?>" placeholder="Owner Name" required="required">
		</div>
		<div class="form-group">
			<label>Mobile Number</label>
			<input type="text" class="form-control" name="mobile" placeholder="Mobile Number" value="<?php echo $company[0]['mobile'];?>">
		</div>
		<div class="form-group">
			<label>Email Id</label>
			<input type="text" class="form-control" name="emailid" placeholder="Email Id" value="<?php echo $company[0]['emailid'];?>">
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
			<textarea name="address" class="form-control"  cols="60" rows="4"><?php echo $company[0]['address'];?></textarea>
		</div>
		<div class="form-group">
			<label>City</label>
			<input type="text" class="form-control" name="city" placeholder="City" value="<?php echo $company[0]['city'];?>">
		</div>
		<div class="form-group">
			<label>State</label>
			<input type="text" class="form-control" name="state" placeholder="State" value="<?php echo $company[0]['state'];?>">
		</div>
		<div class="form-group">
			<label>Pincode</label>
			<input type="text" class="form-control" name="pincode" placeholder="Pincode" value="<?php echo $company[0]['pincode'];?>">
		</div>
	</div><!-- /.box-body -->
	</div><!-- /.box -->
</div>
<div class="col-md-6">
	<div class="form-group">
			<input type="hidden" name="id" value="<?php echo $company[0]['id'];?>">
			<input type="submit" name="save" value="Update">
		</div>
</div>
</form>
