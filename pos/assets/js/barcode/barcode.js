/**
 * show_product_barcode_detail function used to show barcode detail
 * @param {type} itemIdBar
 * @param {type} productName
 * @param {type} barcodeLable1
 * @param {type} barcodeLable2
 * @returns {undefined}3
 */
function show_product_barcode_detail(itemIdBar,price, productName, barcodeLable1, barcodeLable2)
{
    JsBarcode("#barcode1", itemIdBar);
    $(".form_bar").show();
    $("#single_barcode_print_div").hide();
    $("#barcode_print_div").hide();
    $("#barcode_print_btn").hide();
    $("#generate_barcode").modal("show");
    $("#barcode_product_id").val(itemIdBar);
    //$("#barcode_product_name").val(productName);
    $("#barcode_product_price").val(price);
    $("#barcode_lable_input_1").val(barcodeLable1);
    $("#barcode_lable_input_2").val(barcodeLable2);

    $('#single_barcode_img').attr('src', '');
  //  $("#single_barcode_product_name").html('');
    $("#single_barcode_product_price").html('');
    $("#single_barcode_left_label").html('');
    $("#single_barcode_right_label").html('');
    $('#double_barcode_img_1').attr('src', '');
  //  $("#double_barcode_product_name_1").html('');
    $("#double_barcode_product_price_1").html('');
    $("#double_barcode_left_label_1").html('');
    $("#double_barcode_right_label_1").html('');
    $('#double_barcode_img_2').attr('src', '');
   // $("#double_barcode_product_name_2").html('');
    $("#double_barcode_product_price_2").html('');
    $("#double_barcode_left_label_2").html('');
    $("#double_barcode_right_label_2").html('');
}

/**
 * confirm_product_barcode_detail function used to confirm barcode detail
 * @returns {undefined}.
 */
function confirm_product_barcode_detail()
{
    var rows = $("input:radio[name=barcode_print_count]:checked").val();
    if (rows === undefined || rows === "undefined")
    {
        alert("Select barcode print count in a row");
        return false;
    }
    var print_count = $("#barcode_print_count").val().trim();
    if (print_count === "" || print_count === "0" || print_count === 0)
    {
        alert("Enter valid print count");
        return false;
    }

    $(".form_bar").hide();

    if (rows === 1 || rows === "1")
    {
        var price= "MRP."+ $("#barcode_product_price").val()+" Inc.of all tax";
        $('#single_barcode_img').attr('src', $('#barcode1').attr('src'));
      //  $("#single_barcode_product_name").html($("#barcode_product_name").val().trim());
        $("#single_barcode_product_price").html(price.trim());
        $("#single_barcode_left_label").html($("#barcode_lable_input_1").val().trim());
        $("#single_barcode_right_label").html($("#barcode_lable_input_2").val().trim());
        $("#single_barcode_print_div").show();
        $("#barcode_print_btn").show();
        if (confirm("Are you sure want to print 1 barcode in a row ?"))
        {
            print_barcode("single_barcode_print_div", print_count);
        }
    }

    if (rows === 2 || rows === "2")
    {
        print_count = print_count / 2;
        var price= "MRP."+ $("#barcode_product_price").val()+" Inc.of all tax";
        $('#double_barcode_img_1').attr('src', $('#barcode1').attr('src'));
       // $("#double_barcode_product_name_1").html($("#barcode_product_name").val().trim());
        $("#double_barcode_product_price_1").html(price.trim());
        $("#double_barcode_left_label_1").html($("#barcode_lable_input_1").val().trim());
        $("#double_barcode_right_label_1").html($("#barcode_lable_input_2").val().trim());
        $('#double_barcode_img_2').attr('src', $('#barcode1').attr('src'));
       // $("#double_barcode_product_name_2").html($("#barcode_product_name").val().trim());
        $("#double_barcode_product_price_2").html(price.trim());
        $("#double_barcode_left_label_2").html($("#barcode_lable_input_1").val().trim());
        $("#double_barcode_right_label_2").html($("#barcode_lable_input_2").val().trim());
        $("#barcode_print_div").show();
        $("#barcode_print_btn").show();
        if (confirm("Are you sure want to print 2 barcode in a row ?"))
        {
            print_barcode("barcode_print_div", print_count);
        }
    }
}

/**
 * print_barcode function used to print barcode
 * @param {type} div_id
 * @param {type} print_count
 * @returns {undefined}
 */
function print_barcode(div_id, print_count)
{
    $("#generate_barcode").modal("hide");
    //update_barcode_labels();
    var printContents = document.getElementById(div_id).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    var i = 0;
    while (i < print_count)
    {
        window.print();
        i++;
    }
    document.body.innerHTML = originalContents;
}

/**
 * update_barcode_labels function used to update barcode label
 * @returns {undefined}
 */
function update_barcode_labels()
{
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: "SellerProductList",
        data: {event: "update_barcode_label", label_1: $("#barcode_lable_input_1").val(), label_2: $("#barcode_lable_input_2").val(), id: $("#barcode_product_id").val()},
        success: function (data) {//

        },
        error: function (xhr, ajaxOptions, thrownError) {//

        }
    });
}
