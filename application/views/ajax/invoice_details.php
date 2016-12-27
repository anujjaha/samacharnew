<table class="table" border="2" width="80%">
	<tr>
		<td>Company Name : <?php echo $invoiceInfo->companyname;?></td>
		<td align="right">Contact Person Name : <?php echo $invoiceInfo->name;?></td>
	</tr>

	<tr>
		<td>Mobile : <?php echo $invoiceInfo->mobile;?></td>
		<td align="right">Office Contact Number : <?php echo $invoiceInfo->othercontact;?></td>
	</tr>

	<tr>
		<td>Email Id : <?php echo $invoiceInfo->emailid;?></td>
		<td align="right">Contact EmailId : <?php echo $invoiceInfo->emailid2;?></td>
	</tr>

	<tr>
		<td colspan="2">
			Address : <?php echo $invoiceInfo->add1 . " " . $invoiceInfo->add2 . " ".$invoiceInfo->add3;?>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			City : <?php echo $invoiceInfo->city . " || State: " . $invoiceInfo->state . " || Pincode : ".$invoiceInfo->pincode;?>
		</td>
	</tr>
</table>

<hr>

<table class="table" border="2" width="80%">
				<tbody id="invoiceItemContainer">
					<tr>
						<td>Sr</td>
						<td>Item/Details</td>
						<td>Qty</td>
						<td>Rate</td>
						<td>Sub Total</td>
					</tr>
					<?php
						$sr = 1;
						foreach($invoiceItems as $item)
						{
					?>
						<tr>
							<td width="12%"><?php echo $sr;?></td>
							<td width="22%"><?php echo $item['item_details'];?></td>
							<td width="22%"><?php echo $item['qty'];?></td>
							<td width="22%"><?php echo $item['rate'];?></td>
							<td align="right" width="22%"><?php echo $item['subtotal'];?></td>
						</tr>
					<?php
						$sr++;
						}
					?>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="4" align="right">
							Sub Total : 
						</td>	
						<td align="right">
							<?php echo $invoiceInfo->sub_total;?>
						</td>
					</tr>

					<tr>
						<td colspan="4" align="right">
							Tax : 
						</td>	
						<td align="right">
							<?php echo $invoiceInfo->tax;?>
						</td>
					</tr>

					<tr>
						<td colspan="4" align="right">
							Grand Total : 
						</td>	
						<td align="right">
							<?php echo $invoiceInfo->grand_total;?>
						</td>
					</tr>
				</tfoot>
			</table>