<!-- Product js php -->
<style>
    #table_wrapper
    {
       border-collapse:collapse;
        display:none;
    }
    #table_wrapper, #table_wrapper td
    {
       
        border:2pt solid black !important;
    }
    
</style>
<script type="text/javascript">
    $(document).ready(function () {
$("#export-to-excel").click(function(e) {
	e.preventDefault();
var htmls = "";
            var uri = 'data:application/vnd.ms-excel;base64,';
            var template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'; 
            var base64 = function(s) {
                return window.btoa(unescape(encodeURIComponent(s)))
            };

            var format = function(s, c) {
                return s.replace(/{(\w+)}/g, function(m, p) {
                    return c[p];
                })
            };

            htmls = $('#table_wrapper').html();

            var ctx = {
                worksheet : 'Worksheet',
                table : htmls
            }


            var link = document.createElement("a");
            link.download = 'Stock Report' + Math.floor((Math.random() * 9999999) + 1000000) + '.xls';
            link.href = uri + base64(format(template, ctx));
            link.click();
	//getting data from our table
	
/*	var a = document.createElement('a');
	a.href = 'data:application/vnd.ms-excel,' + encodeURIComponent($('#table_wrapper').html()) ;
	a.download = 'Stock Report' + Math.floor((Math.random() * 9999999) + 1000000) + '.xls';
	a.click();
	return false;*/
});
});
</script>
<script src="<?php echo base_url() ?>my-assets/js/admin_js/json/product.js.php" ></script>

<!-- Stock report start -->
<script type="text/javascript">
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        document.body.style.marginTop = "0px";
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>

<!-- Stock List Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('stock_report') ?></h1>
            <small><?php echo display('all_stock_report') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('stock') ?></a></li>
                <li class="active"><?php echo display('stock_report') ?></li>
            </ol>
        </div>
    </section>
    <section class="content">
        <!-- Manage Product report -->

        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-body"> 

                        <?php echo form_open_multipart('Creport', array('class' => 'form-inline', 'id' => 'stock_report')) ?>

                        <?php
                        date_default_timezone_set("Asia/Dhaka");
                        $today = date('Y-m-d');
                        ?>
                        <label class="select"><?php echo display('search_by_product') ?>:</label>
                        <input type="text" name="product_name" onclick="producstList();" class="form-control productSelection" placeholder='<?php echo display('product_name') ?>' id="product_name">
                        <input type="hidden" class="autocomplete_hidden_value" name="product_id" id="SchoolHiddenId"/>
                        <label class="select"><?php echo display('date') ?></label>
                        <input type="text" name="stock_date" value="<?php echo $today; ?>" class="datepicker form-control productSelection " required />
			
						<label for="category_id"><?php echo display('category') ?></label>
							<select class="form-control " id="category_id" name="category_id"  tabindex='3'>
							<option value="">Select Category</option>
							<?php
								if ($category_list) {
							?>
							{category_list}
								<option value="{category_id}">{category_name}</option>
							{/category_list}
							<?php
								}
							?>
							</select>
						<button type="submit" class="btn btn-primary"><?php echo display('search') ?></button>
                        <a  class="btn btn-warning" href="#" onclick="printDiv('printableArea')"><?php echo display('print') ?></a>
                        <a class="btn btn-warning" id="export-to-excel" href="#"><?php echo display('export_to_excel') ?></a>
                        <?php echo form_close() ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('stock_report') ?></h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div id="printableArea" style="margin-left:2px;">
                            <div class="text-center">

                                {company_info}
                                <h3> {company_name} </h3>
                                <h4 >{address} </h4>
                                {/company_info}
                                <h4> <?php echo display('stock_date') ?> : {date} </h4>
                                <h4> <?php echo display('print_date') ?>: <?php echo date("d/m/Y h:i:s"); ?> </h4>
                            </div>
							<?php
								$error_message = $this->session->userdata('error_message');
								if (isset($error_message)) {
									?>
									<div class="alert alert-danger alert-dismissable">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
										<?php echo $error_message ?>                    
									</div>
									<?php
									$this->session->unset_userdata('error_message');
								}
							?>

                            <div  class="table-responsive" style="margin-top: 10px;">
                                <table  class="table table-bordered table-striped table-hover">
                                    <thead>
                                        
                                        <tr>
                                            <th class="text-center"><?php echo display('sl') ?></th>
                                            <th class="text-center"><?php echo display('product_name') ?></th>
                                            <th class="text-center"><?php echo display('manufacturer_name') ?></th>
                                            <th class="text-center"><?php echo display('uom') ?></th>
                                            <th class="text-center">Rack</th>
                                            <th class="text-center"><?php echo display('quantity_per_cartoon') ?></th>
                                            <th class="text-center"><?php echo display('in_ctn') ?></th>
                                            <th class="text-center"><?php echo display('out_ctn') ?></th>
                                            <th class="text-center"><?php echo display('stock') ?></th>
                                            <th class="text-center"><?php echo display('supplier_price') ?></th>
                                            <th class="text-center"><?php echo display('sell_price') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($stok_report) {
                                            ?>
                                            {stok_report}
                                            <tr>
                                                <td>{sl}</td>
                                                <td align="center">
                                                    <!--<a href="<?php echo base_url() . 'Cproduct/product_details/{product_id}'; ?>">-->
                                                        {product_name}
                                                    <!--</a>-->
                                                </td>
                                                <td align="center">{product_model}</td>
                                                <td align="center">{uom_name}</td>
                                                <td align="center">{rack}</td>
                                                <td align="center">{cartoon_quantity}</td>
                                                <td align="center">{totalPrhcsCtn}</td>
                                                <td align="center">{totalSalesCtn}</td>
                                                <td align="center">{stok_quantity_cartoon}</td>
                                                <!--td style="text-align: right;"><?php echo (($position == 0) ? "$currency {supplier_price}" : "{supplier_price} $currency") ?></td>
                                                <td style="text-align: right;"><?php echo (($position == 0) ? "$currency {price}" : "{price} $currency") ?></td-->
                                                <td style="text-align: right;"><?php echo (($position == 0) ? "{supplier_price}" : "{supplier_price}") ?></td>
                                                <td style="text-align: right;"><?php echo (($position == 0) ? "{price}" : "{price}") ?></td>

                                            </tr>
                                            {/stok_report}
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="5" align="right"><b><?php echo display('grand_total') ?>:</b></td>
                                            <td align="center"><b>{sub_total_in}</b></td>
                                            <td align="center"><b>{sub_total_out}</b></td>
                                            <td align="center"><b>{sub_total_stock}</td>
                                            <td colspan="2"></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="text-center">
                            <?php
                            if (isset($link)) {
                                echo $link;
                            }
                            ?>
                        </div>
                        <div id="table_wrapper"class="table-responsive" style="margin-top: 10px;">
                                <table  class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center"><?php echo display('sl') ?></th>
                                            <th class="text-center"><?php echo display('product_name') ?></th>
                                            <th class="text-center"><?php echo display('manufacturer_name') ?></th>
                                            <th class="text-center"><?php echo display('uom') ?></th>
                                            <th class="text-center"><?php echo display('quantity_per_cartoon') ?></th>
                                            <th class="text-center"><?php echo display('in_ctn') ?></th>
                                            <th class="text-center"><?php echo display('out_ctn') ?></th>
                                            <th class="text-center"><?php echo display('stock') ?></th>
                                            <th class="text-center"><?php echo display('supplier_price') ?></th>
                                            <th class="text-center"><?php echo display('sell_price') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($stok_report1) {
                                            ?>
                                            {stok_report1}
                                            <tr>
                                                <td>{sl}</td>
                                                <td align="center">
                                                    <!--<a href="<?php echo base_url() . 'Cproduct/product_details/{product_id}'; ?>">-->
                                                        {product_name}
                                                    <!--</a>-->
                                                </td>
                                                <td align="center">{product_model}</td>
                                                <td align="center">{uom_name}</td>
                                                <td align="center">{cartoon_quantity}</td>
                                                <td align="center">{totalPrhcsCtn}</td>
                                                <td align="center">{totalSalesCtn}</td>
                                                <td align="center">{stok_quantity_cartoon}</td>
                                                <td style="text-align: right;"><?php echo (($position == 0) ? "{supplier_price}" : "{supplier_price}") ?></td>
                                                <td style="text-align: right;"><?php echo (($position == 0) ? "{price}" : "{price}") ?></td>

                                            </tr>
                                            {/stok_report1}
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="4" align="right"><b><?php echo display('grand_total') ?>:</b></td>
                                            <td align="center"><b>{sub_total_in1}</b></td>
                                            <td align="center"><b>{sub_total_out1}</b></td>
                                            <td align="center"><b>{sub_total_stock1}</td>
                                            <td colspan="2"></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Stock List End -->