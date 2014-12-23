<h2><?= ucwords($this->name) ?> Details : <strong><?= !empty($user['u_firstname']) ? $user['u_firstname'] : ""; ?> <?= !empty($user['u_lastname']) ? $user['u_lastname'] : ""; ?></strong></h2>
<br/>
<div id="vasibletable" >
	<input type='hidden' id="productId" value="<?= isset($user['u_id']) ? $user['u_id'] : ''  ?>"/>		
	
    <ul class="nav">
		<li class="nav-one"><a id="a_info" href="#info" class="current">User Info</a></li>
		<li class="nav-two"><a id="a_option" href="#address">User Address</a></li>
		<li class="nav-three"><a id="a_discount" href="#order">Order History</a></li>
    </ul>
    <div class="list-wrap">
		<ul id="info">
			<li>
				<table class="edit">
					<tr>	
						<td style="width: 140px;" id='edit_title'>Member Name</td>
						<td><?= !empty($user['u_firstname']) ? $user['u_firstname'] : ""; ?> <?= !empty($user['u_lastname']) ? $user['u_lastname'] : ""; ?></td>		
					</tr>
					<tr>
						<td style="width: 140px;" id='edit_title'>Member Email</td>
						<td><?= !empty($user['u_email']) ? $user['u_email'] : ""; ?></td>		
					</tr>
					<tr>
						<td style="width: 140px;" id='edit_title'>Gender</td>
						<td><?= match($user['u_gender'],$this->config->item('gender'))  ?></td>		
					</tr>
					<tr>
						<td style="width: 140px;" id='edit_title'>Member Status</td>
						<td><?= match($user['u_status'],$this->status_list )  ?></td>		
					</tr>
					<tr>
						<td style="width: 140px;" id='edit_title'>Member Since</td>
						<td><?= date_convert($user['created'],'full')  ?></td>		
					</tr>
				</table>
			</li>
		</ul>
		 <input type='hidden' id="currentID" value=""/>
		 <ul id="address" class="hide">
			<li>
				<div id="options-form" title="Add new options">
				  <p class="validateTips">Member billing, shipping and others address(es)</p>
				 
				</div>
				
				<table class="edit">
					<tr>
						<td style="width: 18%;"  id='edit_title'>Default Billing Address</td>
						<td>
							<?php if(!empty($user['address'][1])) { 
								if(!empty($user['address'][1]['a_state'])){
									$dba_state = match($user['address'][1]['a_state'], $this->config->item('state')).", ";
								}	
							?>
							<address>
				                    <strong><?= $user['address'][1]['a_firstname'] ?> <?= $user['address'][1]['a_lastname'] ?></strong><br>
									<?= $user['address'][1]['a_add1'] ?><br>
									<?php echo !empty( $user['address'][1]['a_add2'] ) ?  $user['address'][1]['a_add2'] ." <br/>" : ""?>
									<?= $user['address'][1]['a_city'] ?>,  <?= $dba_state ?> <?= $user['address'][1]['a_postcode'] ?><br>
									<?= match($user['address'][1]['a_country'],$this->config->item('country')) ?><br>
									T: <?= $user['address'][1]['a_mobile'] ?><br>
								
							</address>
							
							<?php } else { ?>
							<p>
								No default billing address set
							</p>
							<?php } ?>
						</td>		
					</tr>
					<tr id="shipping">	
						<td style="width: 140px;"  id='edit_title'>Default Shipping Address</td>
						<td>
							<?php if(!empty($user['address'][2])) { 
								if(!empty($user['address'][2]['a_state'])){
									$dsa_state = match($user['address'][2]['a_state'], $this->config->item('state')).", ";
								}	
							?>
							<address>
				                    <strong><?= $user['address'][2]['a_firstname'] ?> <?= $user['address'][2]['a_lastname'] ?></strong><br>
									<?= $user['address'][2]['a_add1'] ?><br>
									<?php echo !empty( $user['address'][2]['a_add2'] ) ?  $user['address'][2]['a_add2'] ." <br/>" : ""?>
									<?= $user['address'][2]['a_city'] ?>,  <?= $dsa_state ?> <?= $user['address'][2]['a_postcode'] ?><br>
									<?= match($user['address'][2]['a_country'],$this->config->item('country')) ?><br>
									T: <?= $user['address'][2]['a_mobile'] ?><br>
								
							</address>
							
							<?php } else { ?>
							<p>
								No default shipping address set
							</p>
							<?php } ?>	
						</td>		
					</tr>
					<tr id="other" >	
						<td style="width: 140px;"  id='edit_title'>Others</td>
						<td>
							<?php if(isset($user['address'][0]) && (count($user['address'][0]) > 0) ) { 
				        		foreach($user['address'][0] as $k => $add) {
				        			$oa_state = "";	
				        			if(!empty($add['a_state'])){
										$oa_state = match($add['a_state'], $this->config->item('state')).", ";
									}	
				        	?>
				        	  
					                <address>
					                    <strong><?= $add['a_firstname'] ?> <?= $add['a_lastname'] ?></strong><br>
										<?= $add['a_add1'] ?><br>
										<?php echo !empty( $add['a_add2'] ) ?  $add['a_add2'] ." <br/>" : ""?>
										<?= $add['a_city'] ?>,  <?= $oa_state ?> <?= $add['a_postcode'] ?><br>
										<?= match($add['a_country'],$this->config->item('country')) ?><br>
										T: <?= $add['a_mobile'] ?><br><br><br>
										
									
				        	<?php } } else { ?>
					        	
					                <p>No additional address entries in member address book.</p>
					          
				        	<?php } ?>
				
						</td>		
					</tr>
				</table>
			</li>
		 </ul>
		 
		 <ul id="order" class="hide">
			<li>
				<div id="options-form" >
				  <p class="validateTips">Member transaction history</p>
				 
				</div>
				<table class="bordered">
					<tbody>
						<tr> 
							<th style="width: 15%;">Invoice Number </th>
							<th style="width: 30%;">Order Item </th>
							
							<th style="width: 10%;">Status </th>
							<th style="width: 15%;">Date Checkout</th>	
							<th style="width: 10%;">Shipping Info</th>	
							<th style="text-align:center;width: 10%;">Total Quantity </th>		
							<th style="width: 10%;">Total Price</th>
						</tr>
						
				<?php 
				//$add =  $this->users_model->getAddressById($val['c_shipping_address']);
				
				
				if(!empty($user['checkout'])){
					foreach ($user['checkout'] as $row => $cart){
						
				?>	
				
					
				    	<tr>
				    	
							<td><strong><font color="green"><?= $cart['c_code'];?></font></strong></td>
							<td>
								<ul>
								<?php 
								$qty = 0;
								foreach($cart['order'] as $order_index => $order) { ?>	
									<li> - <?=$order['product_info']['name']?><?= isset($order['product_info']['options']) ?  " (" .$order['product_info']['options']['opt_name'].")"  : "" ?>
								
							
								<?php 
									$qty += $order['quantity'];
								} ?>
								</ul>
								<button type="button" onclick="return moreItemsDetails(<?= $cart['c_id'];?>)" id="morebutton"><span><span>More Info </span></span></button>  
	
							</td>	
							<td><?= match($cart['c_status'],$this->order_status)?></td>	
							<td><?= date_convert($cart['updated'],'full');?></td>	
							<td><button type="button" onclick="return addressToggle(<?= $cart['c_id'];?>)" id="moreaddressbutton"><span><span>More Address</span></span></button>  </td>
							<td style="text-align:center;"><?= $qty ?></td>			
							<td>RM <?= $cart['c_total_price'];?></td>																
						</tr>
						<tr id="moreinfolist<?= $cart['c_id'];?>" style="display:none;">
							<td colspan="7">
								
								<table class="bordered">
									<tr >
							            <th>&nbsp;</th>
							            <th><span class="nobr">Product Name</span></th>
							      
										<th><span class="nobr">Unit Price</span></th>
							            <th  style="text-align:center;">Qty</th>
							             <th  style="text-align:center;">Subweight</th>
							            <th  style="text-align:right;">Subtotal</th>
							        </tr>
									<?php 
									$sub_weight =0;
									$sub_total  =0;
									foreach($cart['order'] as $order_index => $order) { 
										$sub_weight += $order['sub_weight'];
										$sub_total += $order['sub_total'];
								?>
									<tr >
									    <td >
									    	
									    	<a href="<?= $this->config->item('domain')."/" ?>product/details/<?= $order['prod_id'] ?>" title="<?= $order['product_info']['name'] ?>" class="product-image">
									    		<img src="<?= $this->config->item('domain').$order['product_info']['photo'] ?>" width="75" height="75" alt="<?= $order['product_info']['name'] ?>">
									    	</a>
									    </td>
									    <td>
									        <h2 class="product-name">
												<a href="<?= $this->config->item('domain')."/" ?>products/details/<?= $order['prod_id'] ?>">
													<?= $order['product_info']['name'] ?>
													<?= isset($order['product_info']['options']) ?  " - " .$order['product_info']['options']['opt_name']  : "" ?>
													
												</a>
											</h2>
										</td>
										
									    <td class="a-right">
											<span class="cart-price">
												<span class="price"><?= $order['product_info']['price'] ?></span>                
									        </span>
										</td>
										<td style="text-align:center;">
											<span><?= isset($order['quantity']) ? $order['quantity'] : '';?></span>
									    </td>
									    <td style="text-align:center;">
											<span style="text-align:right;">
												<span ><?= weightConverter($order['sub_weight'])  ?></span>                
									        </span>
										</td>
									    <td  style="text-align:right;">
											<span>
									       		RM <span style="text-align:right;"><?= number_format($order['sub_total'],2) ?></span>                            
									        </span>
									    </td>
									    
									</tr>
							<?php 	} ?>
									<tr style="background: #E5E8E1;">
										<?php 
									
										if(!empty($cart['order'])){ 
											
											 ?>
											<td colspan='3' style="background: #E5E8E1;"><strong>Sub Total (RM)</strong></td>
											<td style="text-align:center;background: #E5E8E1;">
												<span>
										       		<span class="price"><strong><?= $qty ?></strong></span>
										       	</span>
										    </td>
											<td  style="text-align:center;background: #E5E8E1;"><span>
										       		<span class="price"><strong><?= weightConverter($sub_weight) ?></strong></span>
										       	 </span>
										    </td>
											<td style="text-align:right;background: #E5E8E1;"><span>
										       		<span class="price"><strong> <?= number_format($sub_total,2) ?></strong></span>
										       	 </span>
										    </td>
										    
										<?php }else{ ?>
											<td colspan='6'><strong>There are no item in your cart.</strong></td>
										<?php } ?>
									</tr>
									<tr style="background: #E5E8E1;">
										<td colspan='5'><strong>Shipping Fees(RM)</strong></td>
										<td style="text-align:right;"><?php
											
											$add =  $this->users_model->getAddressById($cart['c_shipping_address']);

											$shipping_rate = $this->shippingrate_model->calculateShippingRate($add['a_country'],$add['a_state'],$sub_weight,$sub_total);
											echo '<span class="price" style="text-align:right;"><strong>' .number_format($shipping_rate,2) . '</strong></span>';
											?>
										</td>
									</tr>
									<?php 

									if(!empty($user['voucher'])) { ?>
									<tr style="background-color: #E5E8E1;">
										<td colspan='5'><strong>Voucher (<?= $user['voucher']['vl_code']?>)</strong></td>
										<td style="text-align:right;">
											<span class="price" style="text-align:right;"><strong>- <?=number_format($user['voucher']['value'],2)?></strong></span>
											
										</td>
									</tr>
									<?php } ?>
									<tr style="background: #E5E8E1;">
										<td colspan='5' style='background: #E5E8E1;'><strong>Total Price(RM)</strong></td>
										<td style="text-align:right;background: #E5E8E1;"><?php
											$sub_total = $sub_total + $shipping_rate - $user['voucher']['value'];
											echo '<span class="price" style="text-align:right;"><strong>' .number_format($sub_total,2) . '</strong></span>';
											?>
										</td>
									</tr>
								
								</table>
							</td>
						</tr>
						<tr id="moreaddresslist<?= $cart['c_id'];?>" style="display:none;">
							<td colspan='7'>
								<span><p>Billing and Shipping address</p></span>
								<table class="edit">
									<tr>
										<td style="width: 18%;"  id='edit_title'> Billing Address</td>
										<td>
											<?php if(!empty($user['address'][1])) { 
												if(!empty($user['address'][1]['a_state'])){
													$user['address'][1]['a_state'] = match($user['address'][1]['a_state'], $this->config->item('state')).", ";
												}
											?>
											<address>
								                    <strong><?= $user['address'][1]['a_firstname'] ?> <?= $user['address'][1]['a_lastname'] ?></strong><br>
													<?= $user['address'][1]['a_add1'] ?><br>
													<?php echo !empty( $user['address'][1]['a_add2'] ) ?  $user['address'][1]['a_add2'] ." <br/>" : ""?>
													<?= $user['address'][1]['a_city'] ?>,  <?= $user['address'][1]['a_state']?> <?= $user['address'][1]['a_postcode'] ?><br>
													<?= match($user['address'][1]['a_country'],$this->config->item('country')) ?><br>
													T: <?= $user['address'][1]['a_mobile'] ?><br>
												
											</address>
											
											<?php } else { ?>
											<p>
												No billing address set
											</p>
											<?php } ?>
										</td>		
									</tr>
									<tr id="shipping">	
										<td style="width: 140px;"  id='edit_title'> Shipping Address</td>
										<td>
											<?php if(!empty($user['address'][2])) { 
												if(!empty($user['address'][2]['a_state'])){
													$user['address'][2]['a_state'] = match($user['address'][2]['a_state'], $this->config->item('state')).", ";
												}
											?>
											<address>
								                    <strong><?= $user['address'][2]['a_firstname'] ?> <?= $user['address'][2]['a_lastname'] ?></strong><br>
													<?= $user['address'][2]['a_add1'] ?><br>
													<?php echo !empty( $user['address'][2]['a_add2'] ) ?  $user['address'][2]['a_add2'] ." <br/>" : ""?>
													<?= $user['address'][2]['a_city'] ?>,  <?=$user['address'][2]['a_state']?> <?= $user['address'][2]['a_postcode'] ?><br>
													<?= match($user['address'][2]['a_country'],$this->config->item('country')) ?><br>
													T: <?= $user['address'][2]['a_mobile'] ?><br>
												
											</address>
											
											<?php } else { ?>
											<p>
												No shipping address set
											</p>
											<?php } ?>	
										</td>		
									</tr>
									
								</table>
								<BR/>
								<span><p>Shipping Method and Status</p></span>
								<table class="edit">
									<tr>
										<td style="width: 18%;"  id='edit_title'> Shipping Method</td>
										<td>
											<?php 
											 
											if(!empty($user['checkout'][0]['c_shipping_method'])) { 
												echo  match($user['checkout'][0]['c_shipping_method'],  $this->shipping_method);
											} else { 
												echo " Awaiting process by admin ";
											 } ?>
										</td>		
									</tr>
									<tr>	
										<td style="width: 140px;"  id='edit_title'> Shipping Tracking Code</td>
										<td>
											<?php 
											if(!empty($user['checkout'][0]['c_tracking_code'])) { 
												echo $user['checkout'][0]['c_tracking_code'];
											} else { 
												echo "N/A";
											 }
											?>
											
											
											
										</td>		
									</tr>
									
								</table>
							</td>
							
						</tr>
						<tr id="moreinfolist<?= $cart['c_id'];?>" style="display:none;">
							<td colspan="7">
								<div>Order Item(s) details<br/><br/><br/><br/><br/></div>
								<table class="bordered">
									<tr >
							            <th>&nbsp;</th>
							            <th><span class="nobr">Product Name</span></th>
							      
										<th><span class="nobr">Unit Price</span></th>
							            <th  style="text-align:center;">Qty</th>
							             <th  style="text-align:center;">Subweight</th>
							            <th  style="text-align:right;">Subtotal</th>
							        </tr>
									<?php 
									$sub_weight =0;
									$sub_total  =0;
									foreach($cart['order'] as $order_index => $order) { 
										$sub_weight += $order['sub_weight'];
										$sub_total += $order['sub_total'];
								?>
									<tr >
									    <td >
									    	
									    	<a href="<?= $this->config->item('domain')."/".$this->name ?>/details/<?= $order['product_info']['prod_id'] ?>" title="Inspired Dress Sandals 2" class="product-image">
									    		<img src="<?= $this->config->item('domain').$order['product_info']['photo'] ?>" width="75" height="75" alt="<?= $order['product_info']['name'] ?>">
									    	</a>
									    </td>
									    <td>
									        <h2 class="product-name">
												<a href="<?= $this->config->item('domain')."/".$this->name ?>/details/<?= $order['prod_id'] ?>">
													<?= $order['product_info']['name'] ?>
													<?= isset($order['product_info']['options']) ?  " - " .$order['product_info']['options']['opt_name']  : "" ?>
													
												</a>
											</h2>
										</td>
										
									    <td class="a-right">
											<span class="cart-price">
												<span class="price"><?= $order['product_info']['price'] ?></span>                
									        </span>
										</td>
										<td style="text-align:center;">
											<span><?= isset($order['quantity']) ? $order['quantity'] : '';?></span>
									    </td>
									    <td style="text-align:center;">
											<span style="text-align:right;">
												<span ><?= weightConverter($order['sub_weight'])  ?></span>                
									        </span>
										</td>
									    <td  style="text-align:right;">
											<span>
									       		RM <span style="text-align:right;"><?= number_format($order['sub_total'],2) ?></span>                            
									        </span>
									    </td>
									    
									</tr>
							<?php 	} ?>
									
								
								
								</table>
							</td>
						</tr>
				<?php } ?>		
				</tbody>	
				</table>
			<?php 	}else{ ?>
				<table class="bordered"><tr><td colspan="7" ><div align='center'>No result found</div><td></tr></table>
	     	<?php  } ?>		
			</li>
		 </ul>
		 
		 
		 
    </div> <!-- END List Wrap -->
 
 </div> <!-- END Organic Tabs (Example One) -->

  <script>
        $(function() {
        	
        	$("#vasibletable").organicTabs();
        	
        	
        });
        
        function moreItemsDetails(orderid){
        	$("#moreaddresslist"+orderid).hide();
        	$( "#moreaddressbutton" ).html( "<span><span>More Adderess</span></span>" );
        	$("#moreinfolist"+orderid).toggle( function() {
        		if($( "#morebutton" ).html() == "<span><span>Less Info </span></span>" ){
        			 $( "#morebutton" ).html( "<span><span>More Info </span></span>" );
        		}else{
        			 $( "#morebutton" ).html( "<span><span>Less Info </span></span>" );
        		}
			      
			  });
        	return false;	
        }
        
        function addressToggle(orderid){
        	$("#moreinfolist"+orderid).hide();
        	$( "#morebutton" ).html( "<span><span>More Info</span></span>" );
        	$("#moreaddresslist"+orderid).toggle( function() {
        		if($( "#moreaddressbutton" ).html() == "<span><span>Less Adderess</span></span>" ){
        			 $( "#moreaddressbutton" ).html( "<span><span>More Adderess</span></span>" );
        		}else{
        			 $( "#moreaddressbutton" ).html( "<span><span>Less Adderess</span></span>" );
        		}
			      
			  });
        	return false;	
        	
        }
        
  </script>
  
<div align='center'>
<button  onclick="location.href='<?=$this->config->item('admin_url')?>/<?= $this->name ?>/';"><span><span><?= $this->config->item("icon_back") ?> Back</span></span></button>
</div>
<br/>