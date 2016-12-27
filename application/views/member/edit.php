<?php
$member_info = $member_info[0];
$this->load->helper('form');
 echo form_open('member/edit');?>
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
			<input type="text" class="form-control" name="companyname" value="<?php echo $member_info['companyname'];?>" placeholder="Company Name" required="required">
		</div>
		<div class="form-group">
			<label>Owner Name</label>
			<input type="text" class="form-control" name="name" value="<?php echo $member_info['name'];?>" placeholder="Owner Name" required="required">
		</div>
		<div class="form-group">
			<label>Mobile Number</label>
			<input type="text" class="form-control" name="mobile"  value="<?php echo $member_info['mobile'];?>" placeholder="Mobile Number">
		</div>
		<div class="form-group">
			<label>Office Contact Number</label>
			<input type="text" class="form-control" name="officecontact"  value="<?php echo $member_info['officecontact'];?>" placeholder="Office Contact Number">
		</div>
		<div class="form-group">
			<label>Other Contact Number</label>
			<input type="text" class="form-control" name="othercontact" value="<?php echo $member_info['othercontact'];?>" placeholder="Mobile Number">
		</div>
		<div class="form-group">
			<label>Email Id</label>
			<input type="text" class="form-control" name="emailid"  value="<?php echo $member_info['emailid'];?>" placeholder="Email Id">
		</div>
		<div class="form-group">
			<label>Other Email Id</label>
			<input type="text" class="form-control" name="emailid2" value="<?php echo $member_info['emailid2'];?>" placeholder="Email Id">
		</div>
		<div class="form-group">
			<label>Website</label>
			<input type="text" class="form-control" name="website" value="<?php echo $member_info['website'];?>" placeholder="Website">
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
			<input type="text" class="form-control" value="<?php echo $member_info['add1'];?>" name="add1" placeholder="Address Line One">
		</div>
		<div class="form-group">
			<label>Address Line Two</label>
			<input type="text" class="form-control" value="<?php echo $member_info['add2'];?>" name="add2" placeholder="Address Line Two">
		</div>
		<div class="form-group">
			<label>Address Line Three</label>
			<input type="text" class="form-control" name="add3"  value="<?php echo $member_info['add3'];?>"  placeholder="Address Line Three">
		</div>
		<div class="form-group">
			<label>City</label>
			<input type="text" class="form-control" value="<?php echo $member_info['city'];?>" name="city" placeholder="City">
		</div>
		<div class="form-group">
			<label>Pincode</label>
			<input type="text" class="form-control" value="<?php echo $member_info->pincode;?>" name="pincode" placeholder="Pincode">
		</div>
		<div class="form-group">
			<label>State</label>
			<input type="text" class="form-control" value="<?php echo $member_info['state'];?>" name="state" placeholder="State">
		</div>
		<div class="form-group">
			<label>Fax</label>
			<input type="text" class="form-control" value="<?php echo $member_info['fax'];?>" name="fax" placeholder="Fax">
			<br><br><br><br><br>
		</div>
		
	</div><!-- /.box-body -->
	</div><!-- /.box -->
</div>
<div class="col-md-6">
	<div class="form-group">
			<input type="hidden" class="form-control" name="company_id" value="<?php echo $member_info['company_id'];?>">
			<input type="hidden" class="form-control" name="id" value="<?php echo $member_info['id'];?>">
			<input type="submit" name="save" value="Update">
		</div>
</div>
</form>
