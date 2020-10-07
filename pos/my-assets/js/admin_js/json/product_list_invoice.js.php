<?php
    header('Content-Type: text/javascript; charset=utf8');
?>

var productList="";

APchange = function(event, ui){
	$(this).data("autocomplete").menu.activeMenu.children(":first-child").trigger("click");
}
    function invoice_productList(element,cName) {
	//	debugger;
		var base_url = $('.baseUrl').val();
		var value = $(element).val();
		$.ajax
		   ({
				type: "POST",
				url: base_url+"Cinvoice/getProductInformation",
				data: {'search':value},
				//cache: false,
				dataType: 'json',
				async: false,
				success: function(data)
				{
			    //	$(".ui-widget-content").html("");
					productList=data;
					var qnttClass = 'ctnqntt_'+cName;
					var total_quantity = 'total_qntt_'+cName;
					var priceClass = 'price_item'+cName;
					var total_tax_price = 'total_tax_'+cName;
					var available_quantity = 'available_quantity_'+cName;
					var uom = 'uom_'+cName;
					var cgst = 'cgst_'+cName;
					var sgst = 'sgst_'+cName;
					var igst = 'igst_'+cName;
					var utgst = 'utgst_'+cName;
					var type = 'type_'+cName;
					var cgst_tax = 'cgst_tax_'+cName;
					var sgst_tax = 'sgst_tax_'+cName;
					var igst_tax = 'igst_tax_'+cName;
					var utgst_tax = 'utgst_tax_'+cName;
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
										$('.'+cgst).val(obj.cgst);
										$('.'+sgst).val(obj.sgst);
										$('.'+igst).val(obj.igst);
										$('.'+utgst).val(obj.utgst);
										$('.'+type).val(obj.type);
										
										//This Function Stay on others.js page
										quantity_calculate(cName);
										
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
    function invoice_productList2(element,cName) {
		//debugger;
		var base_url = $('.baseUrl').val();
		var value = $(element).val();
		$.ajax
		   ({
				type: "POST",
				url: base_url+"Cinvoice/getProductInformation",
				data: {'search':value},
				async: false,
				dataType: 'json',
				success: function(data)
				{
			//	$(".ui-widget-content").html("");
				console.log(data);
					productList=data;
					var qnttClass = 'ctnqntt_'+cName;
					var total_quantity = 'total_qntt_'+cName;
					var priceClass = 'price_item'+cName;
					var total_tax_price = 'total_tax_'+cName;
					var available_quantity = 'available_quantity_'+cName;
					var uom = 'uom_'+cName;
					var cgst = 'cgst_'+cName;
					var sgst = 'sgst_'+cName;
					var igst = 'igst_'+cName;
					var utgst = 'utgst_'+cName;
					var type = 'type_'+cName;
					var cgst_tax = 'cgst_tax_'+cName;
					var sgst_tax = 'sgst_tax_'+cName;
					var igst_tax = 'igst_tax_'+cName;
					var utgst_tax = 'utgst_tax_'+cName;
					$( ".productSelection" ).autocomplete(
					{
						source: productList,
						delay:300,
						focus: function(event, ui) {
							$(this).parent().find(".autocomplete_hidden_value").val(ui.item.value);
							$(this).val(ui.item.label);
							
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
													$('.'+cgst).val(obj.cgst);
													$('.'+sgst).val(obj.sgst);
													$('.'+igst).val(obj.igst);
													$('.'+utgst).val(obj.utgst);
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
				}
		   });
		
		$( ".productSelection" ).focus(function(){
			$(this).change(APchange);
		
		});
    }
	
	function getCategoryWiseSale()
	{
		var base_url = $('.baseUrl').val();
		$.ajax({
			type: 'GET',
			url: base_url+"Cinvoice/getTotalSaleCategoryWise",
			dataType: 'json',
			success: function (data) {
				//debugger;
				console.log(data);
				
				$('#cat_sale_model').modal('show');
				
					var li="<tr><th>SL No.</th><th>Category Name</th><th>Total Amount</th></tr>";
						var i=1;
					Object.keys(data).forEach(function (key) {
						var total=parseFloat(data[key]['total']);
						li=li+"<tr><td>"+i+"</td><td>"+data[key]['category_name']+" </td><td>"+parseFloat(total).toFixed(2)+"</td></tr>";
						i++;
					});
				
					$("#cat_sale_list").empty().append(li);
				/* if (data.status === "success")
				{
					$('#cat_sale_model').modal('show');
					var li="";
					Object.keys(data).forEach(function (key) {
						if(key!=="status")
						{
						li=li+"<li>"+key+": "+data[key]+"</li>";
						 }
					});
					$("#cat_sale_list").html(li);
				} else
				{
					alert("Something went wrong !");
				} */
			},
			error: function (jqXHR, textStatus, errorThrown) {
				alert("Something went wrong !");
				console.log("getProduct error :" + textStatus);
			}

		});
	}

/* function getProduct()
{
				var base_url = $('.baseUrl').val();
    $.ajax({
        type: 'POST',
        url: base_url+"Cinvoice/getProductInformation",
       // data:{event:"product_list_for_invoice"},
        dataType: 'json',
        success: function (data, textStatus, jqXHR) {
       // alert(data);
        //    console.log(data);
            json=data;
            $.each(json, function(key,value) {
               addProductsInList(value);
            });
            
       //    console.log(productList);
        },
        error: function (jqXHR, textStatus, errorThrown) {
             console.log("getProduct error :"+textStatus);
        }
        
    });
} */

/* function addProductsInList(value){   
        productList+="<li id=\"product_id_" + value.product_id + "\" class=\"product_item\"><a class=\"cursor_pointer na\">"+value.product_name+"-("+value.product_model+")-("+value.code+")</a></li>";
    }
 */
/* 
function invoice_productList(element,countNum)
{
   var value = $(element).val();
//   alert(value);
   console.log("value : "+value);
    if(value.trim()===""){
        $(".pp-ul_"+countNum).hide();
        return;
    }
    if(isNaN(value))//check contains in list
    {       
       
 //   alert(productList);
 debugger;
//    $(".pp-ul_"+countNum).html(productList)
    $(".pp-ul_"+countNum).html("<ul class=\"filterData\">"+productList+"</ul>");
    $(".pp-ul_"+countNum).show();    
    $(".filterData > li").each(function() {  
        if ($(this).text().toLowerCase().search(value.toLowerCase()) > -1) {            
            $(this).show();
        }
        else {
            $(this).hide();
        }
    });
    }
    else//check exact item code
    {
  //  alert(productList);
    $(".pp-ul_"+countNum).html("<ul class=\"filterData\">"+productList+"</ul>");
    $(".pp-ul_"+countNum).show();    
    $(".filterData > li").each(function() {  
        var li_text=$(this).text(); 
        console.log(li_text);
        var item_code=li_text.substring(li_text.lastIndexOf("(")+1,li_text.lastIndexOf(")"));
        console.log(item_code);
        if (item_code.toLowerCase()===value.toLowerCase()) {            
            $(this).show();
        }
        else {
            $(this).hide();
        }
    }); 
    }
    
}
 */

/* 
$(document).on("click",".product_item",function(){
    // console.log(this); 
     var id = $(this).attr("id");
     id = id.split("product_id_")[1];
     var name=$(this).children().html();
     $("#product_name").val(name);
     console.log("id "+id);
     console.log("name "+name);
   //   console.log($(this).parent().parent().html());
    //console.log( $(this).parent().parent().attr("class")); 
     var listDivId =$(this).parent().parent().attr("class");
     console.log(listDivId);
     listDivId = listDivId.split("ul_")[1];
   //  console.log(listDivId);
     //productItemDetailById(id,listDivId,0);

     $(".productlistdiv").hide(); 
 });
 
  */
  