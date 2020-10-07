    // Add input field for new Invoice 
    var count = 2;
    var limits = 500;
   /* function addPurchaseInputField(divName){
         //var param = "$(this).attr(name)";
          if (count == limits)  {
               alert("You have reached the limit of adding " + count + " inputs");
          }
          else {
               var newdiv = document.createElement('tr');
               var tabin="product_name_"+count;
               newdiv.innerHTML ="<td><select name='product_id[]' onkeypress='purchase_productList(" + count + ");' required class='form-control product_id_" + count + "' placeholder='Type product name' id='product_name_" + count + "' ></select></td><td><input type='text' id='' class='form-control text-right stock_ctn_" + count + "' placeholder='Stock' readonly/></td><td class='text-right'><input type='text' name='cartoon[]' onkeyup='quantity_calculate(" + count + ");' onchange='quantity_calculate(" + count + ");' required  id='qty_item_" + count + "' class='form-control text-right' placeholder='0.00' value='' min='0'/></td><td class='text-right'><input type='text' name='cartoon_item[]' value='' readonly='readonly' id='ctnqntt_" + count + "' class='form-control ctnqntt" + count + " text-right' placeholder='Item/Cartoon'/></td><td class='text-right'><input type='text' name='product_quantity[]' readonly='readonly' id='total_qntt_" + count + "' class='form-control text-right' placeholder='0.00' /></td><td><input type='text' name='product_rate[]' onkeyup='quantity_calculate(" + count + ");' onchange='quantity_calculate(" + count + ");' id='price_item_" + count + "' class='form-control price_item" + count + " text-right' placeholder='0.00' value='' min='0'/></td><td class='text-right'><input class='form-control total_price text-right' type='text' name='total_price[]' id='total_price_" + count + "' value='0.00' tabindex='-1' readonly='readonly' /></td><td><button style='text-align: right;' class='btn btn-danger red' type='button' value='Delete' onclick='deleteRow(this)' >Delete</button></td>";
               document.getElementById(divName).appendChild(newdiv);
               document.getElementById(tabin).focus();
               count++;
          }
     }*/
     function addPurchaseInputField2(e) {
        var t = $("tbody#addPurchaseItem tr:first-child").html();
        count == limits ? alert("You have reached the limit of adding " + count + " inputs") : $("tbody#addPurchaseItem").append("<tr>" + t + "</tr>")
    }

     function addPurchaseInputField(divName){
         //var param = "$(this).attr(name)";
          if (count == limits)  {
               alert("You have reached the limit of adding " + count + " inputs");
          }
          else {
             // alert(count);
               var newdiv = document.createElement('tr');
               var tabin="prd_name"+count;
               newdiv.innerHTML ="<td>"+
               "<input type='text' name='product_name' onkeyup='purchase_product_List(this," + count + ");' class='form-control productSelection' placeholder='Product Name' required='' id='"+tabin+"' >"+

               "<input type='hidden' class='autocomplete_hidden_value product_id_" + count + "' name='product_id[]' id='SchoolHiddenId'/>"+
               "</td><td>"+
               "<input type='text' class='form-control text-right available_stk_qty_" + count + "' name='available_stk_qty[]' placeholder='Available stock'  readonly='readonly'  />"+
               "</td><td class='text-right'>"+
               "<input type='text' name='qty[]'  required class='form-control text-right qty_" + count + "' onkeyup='cal_price(this," + count + ");' onblur='cal_price(this," + count + ");' placeholder='0.00' value='' min='0' />"+
			   "<input type='text' name='com_qty[]'  id='com_qty' class='form-control text-right com_qty_" + count + "'  onkeyup='upd_stk(this," + count + ");' onblur='upd_stk(this," + count + ");' placeholder='Comp Qty' value='' min='0' />"+
			   "</td><td>"+
               "<input type='text' class='form-control text-right uom_" + count + "' name='uom[]' placeholder='UOM'  readonly='readonly' />"+
               "</td><td class='text-right'>"+
               "<input type='text' name='updated_stock_qty[]' readonly='readonly' class='form-control text-right updated_stock_qty_" + count + "' placeholder='0.00' />"+
               "</td><td class='text-right'>"+
               "<input type='text' name='price[]' class='form-control price_" + count + " text-right' placeholder='0.00' value='' min='0' />"+
               "</td><td>"+
               "<input class='form-control discount_" + count + " text-right' type='text' name='discount[]' onkeyup='cal_total(this," + count + ");' onblur='cal_total(this," + count + ");' placeholder='0.00' />"+
               "</td><td class='text-center' width='20%'>"+
               "<label class='switch'>"+
											  "<input type='checkbox' id='tax' class='tax_" + count + "' name='tax' onchange='cal_total_t(this," + count + ")' checked >"+
											  "<span class='slider round'></span>"+
											"</label><br>"+
											"<div id='cgst_tax_" + count + "'>"+
											  "CGST-<input type='text' class='cgst_" + count + "' name='cgst[]' style='width:10%;border:none;'>"+
											"</div><div id='sgst_tax_" + count + "'>"+
											  "SGST-<input type='text' class='sgst_" + count + "' name='sgst[]' style='width:10%;border:none;' >"+
											"</div><div id='igst_tax_" + count + "'>"+
 											  "IGST-<input type='text' class='igst_" + count + "' name='igst[]' style='width:10%;border:none;' >"+
											"<div id='utgst_tax_" + count + "'>"+
											  "UTGST-<input type='text' class='utgst_" + count + "' name='utgst[]' style='width:10%;border:none;' >"+
              
               "</div></td><td class='text-right'>"+
               "<input id='total_" + count + "' class='total form-control text-right' text-right' type='text' name='total[]' value='0.00' readonly='readonly' />"+
               "</td><td>"+
               "<button style='text-align: right;' class='btn btn-danger red' type='button' value='Delete' onclick='deleteRow(this)' >Delete</button>"+
               "</td>";
               document.getElementById(divName).appendChild(newdiv);
               document.getElementById(tabin).focus();
                count++;
          //    alert(count);
          }
     }

    //Calcucate Invoice Add Items
    
    function quantity_calculate(item)
    {
        var qnty =$("#qty_item_"+item).val();
        //stockLimit(item,qnty);
        var cnt =$(".ctnqntt"+item).val();
        var rate =$("#price_item_"+item).val();
        
        var total_qnty  = qnty * cnt;
        $("#total_qntt_"+item).val(total_qnty);
        var total_amnt = total_qnty * rate;
        $("#total_price_"+item).val(total_amnt);
        //alert(qnty);
        calculateSum();
    }


    function calculateSum() {
        var e = 0;
        $(".total").each(function() {
            isNaN(this.value) || 0 == this.value.length || (e += parseFloat(this.value))
        }), 
        $("#grandTotal").val(e.toFixed(2))
    }

    function deleteRow(e) {
        var t = $("#purchaseTable > tbody > tr").length;
        if (1 == t) alert("There only one row you can't delete.");
        else {
            var a = e.parentNode.parentNode;
            a.parentNode.removeChild(a)
        }
        calculateSum()
    }
        
    $("body").on("keyup change", ".qty_calculate", function() {
        var cartoon = $(this).val();
        var item = $(this).parent().next().children().val();

        // set quantity
        $(this).parent().next().next().children().val(cartoon * item);

        var rate = $(this).parent().next().next().next().children().val();
        //set total
        $(this).parent().next().next().next().next().children().val(rate * cartoon * item);
        calculateSum();
    });