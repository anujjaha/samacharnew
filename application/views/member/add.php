<?php
$this->load->helper('form');
 echo form_open('member/add');?>
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
			<input type="text" class="form-control" name="companyname" placeholder="Company Name" required="required">
		</div>
		<div class="form-group">
			<label>Owner Name</label>
			<input type="text" class="form-control" name="name" placeholder="Owner Name" required="required">
		</div>
		<div class="form-group">
			<label>Mobile Number</label>
			<input type="text" class="form-control" name="mobile" placeholder="Mobile Number">
		</div>
		<div class="form-group">
			<label>Office Contact Number</label>
			<input type="text" class="form-control" name="officecontact" placeholder="Office Contact Number">
		</div>
		<div class="form-group">
			<label>Other Contact Number</label>
			<input type="text" class="form-control" name="othercontact" placeholder="Mobile Number">
		</div>
		<div class="form-group">
			<label>Email Id</label>
			<input type="text" class="form-control" name="emailid" placeholder="Email Id">
		</div>
		<div class="form-group">
			<label>Other Email Id</label>
			<input type="text" class="form-control" name="emailid2" placeholder="Other Email Id">
		</div>
		<div class="form-group">
			<label>Website</label>
			<input type="text" class="form-control" name="website" placeholder="Website">
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
			<label>Address Line One</label>
			<input type="text" class="form-control" name="add1" placeholder="Address Line One">
		</div>
		<div class="form-group">
			<label>Address Line Two</label>
			<input type="text" class="form-control" name="add2" placeholder="Address Line Two">
		</div>
		<div class="form-group">
			<label>Address Line Three</label>
			<input type="text" class="form-control" name="add3" placeholder="Address Line Three">
		</div>
		<div class="form-group">
			<label>City</label>
			<input type="text" class="form-control" name="city" placeholder="City">
		</div>
		<div class="form-group">
			<label>Pincode</label>
			<input type="text" class="form-control" name="pincode" placeholder="Pincode">
		</div>
		<div class="form-group">
			<label>State</label>
			<input type="text" class="form-control" name="state" placeholder="State">
		</div>
		<div class="form-group">
			<label>Fax</label>
			<input type="text" class="form-control" name="fax" placeholder="Fax">
			<br><br><br><br><br>
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
