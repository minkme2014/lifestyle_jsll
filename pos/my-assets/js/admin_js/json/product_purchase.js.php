<?php

$cache_file = "product".$_COOKIE['dbid'].".json";
    header('Content-Type: text/javascript; charset=utf8');
?>
var productList = <?php echo file_get_contents($cache_file); ?> ; 

APchange = function(event, ui){
	$(this).data("autocomplete").menu.activeMenu.children(":first-child").trigger("click");
}
    function purchase_productList(cName) {
		var qnttClass = 'ctnqntt'+cName;
		var priceClass = 'price_item'+cName;
		var stock_ctn = 'stock_ctn_'+cName;
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
                var supplier = $('.supplier_hidden_value').val(); 
                if(supplier.length==0)
            	{
                    alert("Select a supplier");
                    return false;
                }
                var supplier_name = $("#supplier_name").val();
				$.ajax
				   ({
						type: "POST",
						url: base_url+"Cinvoice/retrieve_product_data",
						data: dataString,
						cache: false,
						success: function(data)
						{
							var obj = jQuery.parseJSON(data);
                            
                          	var server_supplier=obj.supplier_id;
                                                        
                            if(supplier != server_supplier)
                            {
                            	alert("It's not " +supplier_name+"'s  product");
                                $('.'+qnttClass).val("");
			                    $('.'+priceClass).val("");
			                    $('.'+stock_ctn).val("");
			                    quantity_calculate(cName);
			                    return false;
                            }
                          
							$('.'+qnttClass).val(obj.cartoon_quantity);
                            $('.'+priceClass).val(obj.supplier_price);
                            $('.'+stock_ctn).val(obj.total_product);
                            quantity_calculate(cName);
                            
							//This Function Stay on purchase.js page
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
    function purchase_product_List(element,cName) {
	//	debugger;
	//alert("hi");
		var base_url = $('.baseUrl').val();
		var value = $(element).val();
		$.ajax
		   ({
				type: "POST",
				url: base_url+"Cpurchase/getProductInformation",
				data: {'search':value},
				//cache: false,
				dataType: 'json',
				async: false,
				success: function(data)
				{
					console.log(data);
					//debugger;
			    //	$(".ui-widget-content").html("");
					productList=data;
					var available_stk_qty = 'available_stk_qty_'+cName;
					var price = 'price_'+cName;
					var cgst = 'cgst_'+cName;
					var sgst = 'sgst_'+cName;
					var igst = 'igst_'+cName;
					var utgst = 'utgst_'+cName;
					var cgst_tax = 'cgst_tax_'+cName;
					var sgst_tax = 'sgst_tax_'+cName;
					var igst_tax = 'igst_tax_'+cName;
					var utgst_tax = 'utgst_tax_'+cName;
					var uom = 'uom_'+cName;
					var rack = 'rack_'+cName;
								
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
							var supplier = $('.supplier_hidden_value').val(); 
				   
							$.ajax
							   ({
									type: "POST",
									url: base_url+"Cpurchase/retrieve_product_purchase",
									data: dataString,
									cache: false,
									success: function(data)
									{
										var obj = jQuery.parseJSON(data);
										
									  //	var server_supplier=obj.supplier_id;
								 
										$('.'+available_stk_qty).val(obj.total_product);
										$('.'+price).val(obj.supplier_price);
										$('.'+cgst).val(obj.cgst);
										$('.'+sgst).val(obj.sgst);
										$('.'+igst).val(obj.igst);
										$('.'+utgst).val(obj.utgst);
										$('.'+uom).val(obj.uom);
										$('.'+rack).val(obj.rack);
										if(obj.cgst==0 || obj.cgst=="")
										{
											$('#'+cgst_tax).hide();
										}else{
											$('#'+cgst_tax).show();
										}
										if(obj.sgst==0 || obj.sgst=="")
										{
											$('#'+sgst_tax).hide();
										}else{
											$('#'+sgst_tax).show();
										}
										if(obj.igst==0 || obj.igst=="")
										{
											$('#'+igst_tax).hide();
										}else{
											$('#'+igst_tax).show();
										}
										if(obj.utgst==0 || obj.utgst=="")
										{
											$('#'+utgst_tax).hide();
										}else{
											$('#'+utgst_tax).show();
										}
										
										
										//This Function Stay on purchase.js page
									} 
								});
							
							$(this).unbind("change");
							return false;
						}
					});
				}
		   });
		$( ".productSelection" ).focus(function(){
			$(this).change(APchange);
		
		});
    }

    function purchase_product_List2(element,cName) {
		debugger;
		var base_url = $('.baseUrl').val();
		var value = $(element).val();
		$.ajax
		   ({
				type: "POST",
				url: base_url+"Cpurchase/getProductInformation",
				data: {'search':value},
				//cache: false,
				dataType: 'json',
				async: false,
				success: function(data)
				{
					console.log(data);
					//debugger;
			    //	$(".ui-widget-content").html("");
					productList=data;
					var available_stk_qty = 'available_stk_qty_'+cName;
					var price = 'price_'+cName;
					var cgst = 'cgst_'+cName;
					var sgst = 'sgst_'+cName;
					var igst = 'igst_'+cName;
					var utgst = 'utgst_'+cName;
					var cgst_tax = 'cgst_tax_'+cName;
					var sgst_tax = 'sgst_tax_'+cName;
					var igst_tax = 'igst_tax_'+cName;
					var utgst_tax = 'utgst_tax_'+cName;
					var uom = 'uom_'+cName;
					var rack = 'rack_'+cName;
								
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
							var supplier = $('.supplier_hidden_value').val();
							
							var supp_id=$("#supplier_sss").val();
							//alert(supplier_id);
						//	alert("id="+id);
							var rate=0;
							$.ajax
							   ({
									type: "POST",
									url: base_url+"Cpurchase/check_product_price",
									data: {
										   'supplier_id':supp_id,
										   'product_id':id
										},
									success: function(data)
									{
										rate=data;
										//alert(rate);
										$.ajax
										   ({
												type: "POST",
												url: base_url+"Cpurchase/retrieve_product_purchase",
												data: dataString,
												cache: false,
												success: function(data)
												{
													var obj = jQuery.parseJSON(data);
													
												  //	var server_supplier=obj.supplier_id;
											 
													$('.'+available_stk_qty).val(obj.total_product);
													if(rate!=0)
													{
														$('.'+price).val(rate);
													}else{
														$('.'+price).val(obj.supplier_price);
													}
													$('.'+cgst).val(obj.cgst);
													$('.'+sgst).val(obj.sgst);
													$('.'+igst).val(obj.igst);
													$('.'+utgst).val(obj.utgst);
													$('.'+uom).val(obj.uom);
													$('.'+rack).val(obj.rack);
													if(obj.cgst==0 || obj.cgst=="")
													{
														$('#'+cgst_tax).hide();
													}else{
														$('#'+cgst_tax).show();
													}
													if(obj.sgst==0 || obj.sgst=="")
													{
														$('#'+sgst_tax).hide();
													}else{
														$('#'+sgst_tax).show();
													}
													if(obj.igst==0 || obj.igst=="")
													{
														$('#'+igst_tax).hide();
													}else{
														$('#'+igst_tax).show();
													}
													if(obj.utgst==0 || obj.utgst=="")
													{
														$('#'+utgst_tax).hide();
													}else{
														$('#'+utgst_tax).show();
													}
													//This Function Stay on purchase.js page
												} 
											});
									}
							   });
							   
							
							$(this).unbind("change");
							return false;
						}
					});
				}
		   });
		$( ".productSelection" ).focus(function(){
			$(this).change(APchange);
		
		});
    }

    function purchase_product_List_edit(element,cName) {
		debugger;
		var base_url = $('.baseUrl').val();
		var value = $(element).val();
		$.ajax
		   ({
				type: "POST",
				url: base_url+"Cpurchase/getProductInformation",
				data: {'search':value},
				//cache: false,
				dataType: 'json',
				async: false,
				success: function(data)
				{
					console.log(data);
					//debugger;
			    //	$(".ui-widget-content").html("");
					productList=data;
					var available_stk_qty = 'available_stk_qty_'+cName;
					var price = 'price_'+cName;
					var cgst = 'cgst_'+cName;
					var sgst = 'sgst_'+cName;
					var igst = 'igst_'+cName;
					var utgst = 'utgst_'+cName;
					var cgst_tax = 'cgst_tax_'+cName;
					var sgst_tax = 'sgst_tax_'+cName;
					var igst_tax = 'igst_tax_'+cName;
					var utgst_tax = 'utgst_tax_'+cName;
					var uom = 'uom_'+cName;
								
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
							var supplier = $('.supplier_hidden_value').val();
							
							var supp_id=$("#suppluerHiddenId").val();
							//alert(supplier_id);
						//	alert("id="+id);
							var rate=0;
							$.ajax
							   ({
									type: "POST",
									url: base_url+"Cpurchase/check_product_price",
									data: {
										   'supplier_id':supp_id,
										   'product_id':id
										},
									success: function(data)
									{
										rate=data;
										//alert(rate);
										$.ajax
										   ({
												type: "POST",
												url: base_url+"Cpurchase/retrieve_product_purchase",
												data: dataString,
												cache: false,
												success: function(data)
												{
													var obj = jQuery.parseJSON(data);
													
												  //	var server_supplier=obj.supplier_id;
											 
													$('.'+available_stk_qty).val(obj.total_product);
													if(rate!=0)
													{
														$('.'+price).val(rate);
													}else{
														$('.'+price).val(obj.supplier_price);
													}
													$('.'+cgst).val(obj.cgst);
													$('.'+sgst).val(obj.sgst);
													$('.'+igst).val(obj.igst);
													$('.'+utgst).val(obj.utgst);
													$('.'+uom).val(obj.uom);
													if(obj.cgst==0 || obj.cgst=="")
													{
														$('#'+cgst_tax).hide();
													}
													if(obj.sgst==0 || obj.sgst=="")
													{
														$('#'+sgst_tax).hide();
													}
													if(obj.igst==0 || obj.igst=="")
													{
														$('#'+igst_tax).hide();
													}
													if(obj.utgst==0 || obj.utgst=="")
													{
														$('#'+utgst_tax).hide();
													}
													//This Function Stay on purchase.js page
												} 
											});
									}
							   });
							   
							
							$(this).unbind("change");
							return false;
						}
					});
				}
		   });
		$( ".productSelection" ).focus(function(){
			$(this).change(APchange);
		
		});
    }

