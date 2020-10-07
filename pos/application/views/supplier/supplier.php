<!-- Manage Supplier Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('manage_suppiler') ?></h1>
            <small><?php echo display('manage_your_supplier') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('supplier') ?></a></li>
                <li class="active"><?php echo display('manage_suppiler') ?></li>
            </ol>
        </div>
    </section>

    <section class="content">
        <!-- Alert Message -->
        <?php
        $message = $this->session->userdata('message');
        if (isset($message)) {
            ?>
            <div class="alert alert-info alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $message ?>                    
            </div>
            <?php
            $this->session->unset_userdata('message');
        }
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
        <!-- Manage Supplier -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
					
                      <div class="form-group row">
						<form action="<?php echo base_url().'Csupplier/import'; ?>" method="post" enctype="multipart/form-data">
							  <div class="col-sm-8 col-md-8">
									<div class="col-sm-6 col-md-6"><label><?php echo display('select_excel');?></label></div>
									<div class="col-sm-6 col-md-6"><input type="file" name="file" id="file" accept=".xls, .xlsx" /></p></div>
							   </div>
							  <div class="col-sm-2 col-md-2">
									<input type="submit" name="import" value="Upload Excel" class="btn btn-info" />
							  </div>
						</form>
					  </div>
                    </div>
                    <!--div class="panel-heading">
                        <div class="panel-title">
                            <h4><--?php echo display('manage_suppiler') ?></h4>
                        </div>
                    </div-->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="dataTableExample3" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th><?php echo display('sl') ?></th>
                                        <th><?php echo display('supplier_name') ?></th>
                                        <th><?php echo display('address') ?></th>
                                        <th><?php echo display('mobile') ?></th>
<!--                                        <th><?php echo display('debit') ?></th>
                                        <th><?php echo display('credit') ?></th>-->
                                        <th><?php echo display('balance') ?></th>
                                        <th><?php echo display('action') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($suppliers_list) {
                                        $sl = 0;
                                        $debit = $credit = $balance = 0;
                                        foreach ($suppliers_list as $single) {
                                            $sql = 'SELECT (SELECT SUM(amount) FROM supplier_ledger WHERE d_c = "d" AND supplier_id = "' . $single['supplier_id'] . '") dr, 
		(SELECT sum(amount) FROM supplier_ledger WHERE d_c = "c" AND supplier_id = "' . $single['supplier_id'] . '") cr';
                                            $result = $this->db->query($sql)->result();
                                            $sl++;
                                            ?>
                                            <!--{suppliers_list}-->
                                            <tr>
                                                <td><?php echo $sl; ?></td>
                                                <td>
                                                    <a href="<?php echo base_url() . 'Csupplier/supplier_ledger_info/' . $single['supplier_id']; ?>">
                                                        <?php echo $single['supplier_name']; ?>
                                                    </a>
                                                </td>
                                                <td><?php echo $single['address']; ?></td>
                                                <td><?php echo $single['mobile']; ?></td>
                                                <td>
                                                    <?php
//                                                    echo '<pre>';  print_r($result); 
                                                     $balance = $result[0]->dr - $result[0]->cr;
													 echo round($balance,2);
                                                    ?>
                                                </td>
        <!--                                                <td align="right">
                                                <?php
                                                if ($single['d_c'] == 'd') {
                                                    echo (($position == 0) ? "$currency " : " $currency");
                                                    echo number_format($single['amount'], 2, '.', ',');
                                                    $debit += $single['amount'];
//                                                         $d = 12;
                                                } else {
                                                    $debit += '0.00';
                                                }
                                                ?>
                                                </td>
                                                <td align="right">
                                                <?php
                                                if ($single['d_c'] == 'c') {
//                                                        echo (($position == 0) ? "$currency " : " $currency");
                                                    echo number_format($single['amount'], 2, '.', ',');
                                                    $credit += $single['amount'];
                                                } else {
                                                    $credit += '0.00';
                                                }
                                                ?>
                                                </td>-->
                                                <td>
                                        <center>
                                            <?php echo form_open() ?>
											<?php 
											if($this->session->userdata('user_type')!=1) 
											{
												if($edited)
												{
													if($edited!==0)
													{?>
														<a href="<?php echo base_url() . 'Csupplier/supplier_update_form/' . $single['supplier_id']; ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="<?php echo display('update') ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
													<?php }
												}	
											}else{?>
													 <a href="<?php echo base_url() . 'Csupplier/supplier_update_form/' . $single['supplier_id']; ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="<?php echo display('update') ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
														   
											<?php }?>
											<?php 
											if($this->session->userdata('user_type')!=1) 
											{
												if($deleted)
												{
													if($deleted!==0)
													{?>
														<a href="" class="deleteSupplier btn btn-danger btn-sm" name="<?php echo $single['supplier_id']; ?>" data-toggle="tooltip" data-placement="right" title="" data-original-title="<?php echo display('delete') ?> "><i class="fa fa-trash-o" aria-hidden="true"></i></a>
													<?php }
												}	
											}else{?>
													<a href="" class="deleteSupplier btn btn-danger btn-sm" name="<?php echo $single['supplier_id']; ?>" data-toggle="tooltip" data-placement="right" title="" data-original-title="<?php echo display('delete') ?> "><i class="fa fa-trash-o" aria-hidden="true"></i></a>
	   
											<?php }?>
                                            
                                            <?php echo form_close() ?>
                                        </center>
                                        </td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Manage Product End -->

<!-- Delete Product ajax code -->
<script type="text/javascript">
    //Delete Supplier 
    $(".deleteSupplier").click(function ()
    {
        var supplier_id = $(this).attr('name');
        var csrf_test_name = $("[name=csrf_test_name]").val();
        var x = confirm("<?php echo display('are_you_sure') ?> ?");
        if (x == true) {
            $.ajax
                    ({
                        type: "POST",
                        url: '<?php echo base_url('Csupplier/supplier_delete') ?>',
                        data: {supplier_id: supplier_id, csrf_test_name: csrf_test_name},
                        cache: false,
                        success: function (datas)
                        {

                        }
                    });
        }
    });
</script>