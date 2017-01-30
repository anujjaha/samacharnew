<?php
$this->load->helper('form');
 echo form_open('invoice/add', array('onsubmit' => 'return checkValidation();'));?>
<div class="col-md-12">
<!-- general form elements disabled -->
	<div class="box box-warning">
	<div class="box-header">
		<h3 class="box-title">Create New Invoice</h3>
	</div><!-- /.box-header -->
	<div class="box-body">
		<div class="form-group">
			<label>Select Member</label>
			<?php echo get_members_dropdown();?>
		</div>
		
		<div class="form-group">
			<label>Invoice Identification :</label>
			<input type="text" name="invoice_name" class="form-control" value="<?php echo date('d - M');?> - Invoice">
		</div>

		<div class="form-group">
			<table class="table" border="2" width="80%">
				<tbody id="invoiceItemContainer">
					<tr>
						<td>Item/Details</td>
						<td>Month</td>
						<td>Rate</td>
						<td>Sub Total</td>
						<td>Action</td>
					</tr>

					<tr>
						<td width="22%"><input required="required"  type="text" name="item[]" class="form-control"></td>
						<td width="22%"><input required="required" type="number" value="1" name="qty[]" class="itemQty form-control"></td>
						<td width="22%"><input required="required" type="number" value="1" name="rate[]" class="itemRate form-control"></td>
						<td width="22%"><input  type="text" name="subtotal[]" class="itemSubTotal form-control"></td>
						<td width="12%"><span class="btn btn-primary addMoreItems"><i class="fa fa-plus 2x" aria-hidden="true"></i></span></td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="3" align="right">
							Sub Total : 
						</td>	
						<td>
							<input type="text" name="sub_total" id="sub_total" class="calcSubTotal form-control">
						</td>
					</tr>

					<tr>
						<td colspan="3" align="right">
							Tax : 
						</td>	
						<td>
							<input required="required" type="text" name="tax" id="tax" value="0" class="calcTax form-control">
						</td>
					</tr>

					<tr>
						<td colspan="3" align="right">
							Grand Total : 
						</td>	
						<td>
							<input required="required" type="text" name="grand_total" id="grand_total" value="0" class="calcGrandTotal form-control">
						</td>
					</tr>
				</tfoot>
			</table>
		</div>
		
		<div class="form-group">
			<textarea name="notes" class="form-control">Invoice Created</textarea>
		</div>

		<div class="form-group">
			<input required="required" type="text" name="captcha" id="captcha">
			<input type="submit" name="save" class="btn btn-success" value="Save">
		</div>
	</div><!-- /.box-body -->
	</div><!-- /.box -->
</div>
</form>

<script type="text/javascript">

function addMoreItems()
{
	var html = '<tr><td width="22%"><input required="required"  type="text" name="item[]" class="form-control"></td><td width="22%"><input required="required" type="number" value="1" name="qty[]" class="itemQty form-control"></td><td width="22%"><input required="required" type="number" value="1" name="rate[]" class="itemRate form-control"></td><td width="22%"><input type="text" name="subtotal[]" class="itemSubTotal form-control"></td><td width="10%"><span class="btn btn-primary removeItem"><i class="fa fa-minus 2x" aria-hidden="true"></i></span></td></tr>';
	
	jQuery("#invoiceItemContainer").append(html);
}

	jQuery(document).on('click', ".removeItem", function()
	{
		jQuery(this).parents('tr').remove();
	});

	jQuery(document).ready(function()
	{
		jQuery(".addMoreItems").on('click', function()
		{
			addMoreItems();
		});

		jQuery(".calcSubTotal").on('click', function()
		{
			calculateSubTotal();
		});

		jQuery(".calcTax ").on('click', function()
		{
			calculateTax();
		});

		jQuery(".calcGrandTotal ").on('click', function()
		{
			calculateGrandTotal();
		});
	});

	jQuery(document).on('focus', '.itemSubTotal', function()
	{
		var rate 	= jQuery(this).parents('tr').find('.itemRate').val(),
			qty 	= jQuery(this).parents('tr').find('.itemQty').val(),
			total 	= rate * qty;

		if(total < 0)
		{
			jQuery(this).val(0);
		}
		else
		{
			jQuery(this).val(total);
		}	
	});

function reCalculateItemSubtotal()
{
	var itemListSubTotal = jQuery('.itemSubTotal');

	jQuery.each(itemListSubTotal, function(index, element)
	{
		var rate 	= jQuery(this).parents('tr').find('.itemRate').val(),
			qty 	= jQuery(this).parents('tr').find('.itemQty').val(),
			total 	= rate * qty;

		console.log(element);
		jQuery(this).val(total);
	})
}

function calculateSubTotal()
{
	var subItems = jQuery(".itemSubTotal"),
		subTotal = 0;

	jQuery.each(subItems, function(index, element)
	{
		if(typeof element != "undefined" && element != null)
		{
			subTotal = parseFloat(subTotal) + parseFloat(jQuery(element).val());	
		}
	});

	jQuery("#sub_total").val(subTotal);
}

function calculateTax()
{
	var total 	= jQuery("#sub_total").val(),
		tax  	= ( total * 15 / 100 ).toFixed(2);

	jQuery("#tax").val(tax);
}

function calculateGrandTotal()
{
	var subTotal 	= jQuery("#sub_total").val(),
		tax 		= jQuery("#tax").val(),
		total 		= (parseFloat(subTotal) + parseFloat(tax)).toFixed(2);

	jQuery("#grand_total").val(total);
}

function checkValidation()
{
	reCalculateItemSubtotal();
	calculateSubTotal();
	calculateTax();
	calculateGrandTotal();

	if(jQuery("#sub_total").val().length < 0)
	{
		jQuery("#sub_total").focus();
		return false;
	}

	if(jQuery("#grand_total").val().length < 0)
	{
		jQuery("#grand_total").focus();
		return false;
	}

	setTimeout(function()
	{
		return true;
	}, 10);
}	
</script>