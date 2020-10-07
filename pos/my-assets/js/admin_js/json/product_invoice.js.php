<?php
$cache_file = "product".$_COOKIE['dbid'].".json";
    header('Content-Type: text/javascript; charset=utf8');
?>
var productList = <?php echo file_get_contents($cache_file); ?> ; 

APchange = function(event, ui){
	$(this).data("autocomplete").menu.activeMenu.children(":first-child").trigger("click");
}
    function invoice_productList(cName) {
		var qnttClass = 'ctnqntt_'+cName;
		var total_quantity = 'total_qntt_'+cName;
		var priceClass = 'price_item'+cName;
		var total_tax_price = 'total_tax_'+cName;
		var available_quantity = 'available_quantity_'+cName;
		var uom = 'uom_'+cName;
		var cgst = 'cgst_'+cName;
		var sgst = 'sgst_'+cName;
		var igst = 'igst_'+cName;
		var type = 'type_'+cName;
        $( ".productSelection" ).autocomplete(
		{
            source: productList,
			delay:300,
			focus: function(event, ui) {
				$(this).parent().find(".autocomplete_hidden_value").val(ui.item.value);
				$(this).val(ui.item.label);
				return false;
			},
			select: function(event, ui) {
				$(this).parent().find(".autocomplete_hidden_value").val(ui.item.value);
				$(this).val(ui.item.label);
				
				var id=ui.item.value;
				var dataString = 'product_id='+ id;
				var base_url = $('.baseUrl').val();

				
				$.ajax
				   ({
						type: "POST",
						url: base_url+"Cinvoice/retrieve_product_data",
						data: dataString,
						cache: false,
						success: function(data)
						{
						    //alert(data);
							var obj = jQuery.parseJSON(data);
							
    						var quantity=0;
    						if(obj.type==="Goods")
    						{
    						    quantity=obj.total_product;
    						}
    						
							$('.'+qnttClass).val(obj.cartoon_quantity);
							$('.'+total_quantity).val(obj.cartoon_quantity);
							$('.'+priceClass).val(obj.price);
							$('.'+total_tax_price).val(obj.tax);
							$('.'+available_quantity).val(quantity);
							$('.'+uom).val(obj.uom);
							$('.'+cgst).val(obj.cgst);
							$('.'+sgst).val(obj.sgst);
							$('.'+igst).val(obj.igst);
							$('.'+type).val(obj.type);
							
							//This Function Stay on others.js page
							quantity_calculate(cName);
							
						} 
					});
				
				$(this).unbind("change");
				return false;
			}
		});
		$( ".productSelection" ).focus(function(){
			$(this).change(APchange);
		
		});
    }

function invoice_productList2(cName) {
		var qnttClass = 'ctnqntt_'+cName;
		var total_quantity = 'total_qntt_'+cName;
		var priceClass = 'price_item'+cName;
		var total_tax_price = 'total_tax_'+cName;
		var available_quantity = 'available_quantity_'+cName;
		var uom = 'uom_'+cName;
		var cgst = 'cgst_'+cName;
		var sgst = 'sgst_'+cName;
		var igst = 'igst_'+cName;
		var type = 'type_'+cName;
        $( ".productSelection" ).autocomplete(
		{
            source: productList,
			delay:300,
			focus: function(event, ui) {
				$(this).parent().find(".autocomplete_hidden_value").val(ui.item.value);
				$(this).val(ui.item.label);
				return false;
			},
			select: function(event, ui) {
				$(this).parent().find(".autocomplete_hidden_value").val(ui.item.value);
				$(this).val(ui.item.label);
				
				var id=ui.item.value;
				var dataString = 'product_id='+ id;
				var base_url = $('.baseUrl').val();
				
				var customer_id=$("#customer_id").val();
			//	alert("cust="+customer_id);
			//	alert("id="+id);
				var price=0;
				$.ajax
				   ({
						type: "POST",
						url: base_url+"Cinvoice/check_product_price",
						data: {
							   'customer_id':customer_id,
							   'product_id':id
							},
						success: function(data)
						{
						    price=data;
							
				$.ajax
				   ({
						type: "POST",
						url: base_url+"Cinvoice/retrieve_product_data",
						data: dataString,
						cache: false,
						success: function(data)
						{
						//    alert(price);
							var obj = jQuery.parseJSON(data);
							
    						var quantity=0;
    						if(obj.type==="Goods")
    						{
    						    quantity=obj.total_product;
    						}
    						
							$('.'+qnttClass).val(obj.cartoon_quantity);
							$('.'+total_quantity).val(obj.cartoon_quantity);
							if(price!=0)
							{
								$('.'+priceClass).val(price);
							}else{
								$('.'+priceClass).val(obj.price);
							}
						
							$('.'+total_tax_price).val(obj.tax);
							$('.'+available_quantity).val(quantity);
							$('.'+uom).val(obj.uom);
							$('.'+cgst).val(obj.cgst);
							$('.'+sgst).val(obj.sgst);
							$('.'+igst).val(obj.igst);
							$('.'+type).val(obj.type);
							
							//This Function Stay on others.js page
							quantity_calculate(cName);
							
						} 
					});
						} 
					});
				
				
				$(this).unbind("change");
				return false;
			}
		});
		$( ".productSelection" ).focus(function(){
			$(this).change(APchange);
		
		});
    }


