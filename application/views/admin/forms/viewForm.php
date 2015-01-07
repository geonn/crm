<script>
	var queryString  = "<?= $this->config->item('admin_url') ?>/<?= $this->name ?>/";
	$(function() { 
		var dateToday = todayDate();
		$( "#datepicker" ).val(dateToday);
		
 		$( "#customer" ).on('blur',function(){
 			if($( "#customer" ).val() ==  ""){
			      		$(".required").val("");
			      		$("input[name=c_id]").val("");
			      		$("textarea[name=mail_address]").html("");
			      		$("textarea[name=home_address]").html("");
			      		return false;
			    }
			      		
 		});
 		
 		$.getJSON( queryString+"getCustomerList", function( data ) {
 			console.log(data);
			$( "#customer" ).autocomplete({
		     	source: data,
			    focus: function( event, ui ) { 
			        $( "#customer" ).val( ui.item.label );
			        return false;
			      },
			      select: function( event, ui ) {
			      	$.get("<?= $this->config->item('admin_url') ?>/customer/getCustomerById?c_id="+ui.item.value, function(data) {
			      		var obj = jQuery.parseJSON(data);
			      		$("input[name=c_id]").val(obj.id);
			      		$("input[name=name]").val(obj.name);
			      		$("input[name=serial]").val(obj.serial);
			      		$("input[name=ic]").val(obj.ic);
			      		$("input[name=email]").val(obj.email);
			      		$("input[name=contact_home]").val(obj.contact_home);
			      		$("input[name=contact_mobile]").val(obj.contact_mobile);
			      		$("input[name=contact_office]").val(obj.contact_office);
			      		$("input[name=age]").val(obj.age);
			      		$("textarea[name=mail_address]").html(obj.mail_address);
			      		$("textarea[name=home_address]").html(obj.home_address);
			      	});
			        $( "#customer" ).val( ui.item.label );
			        $( "#customer" ).attr("data-value",ui.item.value);
			        return false;
			      }
			});
		});
	});
	
	function submitForm(){
		var formdata = $('form').serialize();
		resetOutline(); 
		$.post(queryString+"submitAnswer/", formdata, function(datas) {  
			console.log(datas);
				var obj = $.parseJSON(datas);
				
				if(obj.status == "error"){ 
					$(".error_message").show();
					$.each(obj.error_code, function(idx, objs) {    
						$("."+objs.question).css('outline','1px solid #ff0000');
					});
					
					$(".error_message").html("Please check the form below :");
				}else{
					//success and redirection
					noty({"text":"Form submitted successfully","layout":"center","type":"success","animateOpen":{"height":"toggle"},"animateClose":{"height":"toggle"},"speed":500,"timeout":2000,"closeButton":false,"closeOnSelfClick":true,"closeOnSelfOver":false,"modal":false});
					setTimeout(function() {location.href=queryString},2000);	 		 
				}
		});
		
		return false;
	}
	
	function resetOutline(){
		$(".error_message").hide();
		$(".required").css('outline','');
	}
	  
</script>
<div class="container_header">
	<div class="header_title"><a class="separator" href="<?= $this->config->item('admin_url') ?>">Home</a> 
		<a class="separator" href="<?= $this->config->item('admin_url').'/'.$this->name ?>"><?= ucwords($this->name) ?></a> <?= $result['data']['name'] ?></div>
	<div style="clear:both"></div>
</div>
<?= $template['partials']['message']; ?>
<div id="submenu">
	<ul>
        <li><a href="<?php echo $this->config->item('admin_url').'/'?><?= $this->name ?>/">Back</a></li>
    </ul>
</div>
<div id="the_list" style="background-color:<?= match($result['data']['background'],$this->config->item('template_background')) ?>;">
   	<?= $template['partials']['content']; ?>
    <div style="width:100%;text-align:center;padding-top:10px;">
        <button class="gold_button" onclick="location.href='<?=$this->config->item('admin_url')?>/<?= $this->name ?>/';">Back</button>
      
            <button type="submit"  value="Submit" onClick="return submitForm();">Submit</button>  
 
    </div>
</div>
