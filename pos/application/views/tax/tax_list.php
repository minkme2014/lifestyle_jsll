<!-- Customer js php -->
<script src="<?php echo base_url() ?>my-assets/js/admin_js/json/customer.js.php" ></script>

<!-- Manage Customer Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('manage_tax') ?></h1>
            <small><?php echo display('manage_your_tax') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><span><?php echo display('tax') ?></a></li>
                <li class="active"><?php echo display('manage_tax') ?></li>
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


        <!-- Manage Customer -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="dataTableExample2" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th><?php echo display('sl') ?></th>
                                        <th><?php echo display('tax_name') ?></th>
                                        <th><?php echo display('tax_per') ?></th>
                                        <th><?php echo display('date_time') ?></th>
                                        <th style="text-align:center !Important"><?php echo display('action') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($tax_list) {
                                        $sl = 0;
                                        foreach ($tax_list as $tl) {
                                            $sl++;
                                            ?>
                                            <tr>
                                                <td><?php echo $sl; ?></td>
                                                <td><?php echo $tl['tax_name']; ?></td>
                                                <td><?php echo $tl['tax_per']; ?>%</td>
                                                <td><?php echo $tl['created_at']; ?></td> 
                                                
                                            <?php if($this->session->userdata('user_type')==1){?>
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
														<a href="<?php echo base_url() . 'Ctax/tax_update_form/'.$tl['tax_id']; ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="<?php echo display('update') ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>

													<?php }
												}	
												if($deleted)
												{
													if($deleted!==0)
													{?>
														<a href="" class="deleteActivity btn btn-danger btn-sm" name="<?php echo $tl['tax_id']; ?>" data-toggle="tooltip" data-placement="right" title="" data-original-title="<?php echo display('delete') ?> "><i class="fa fa-trash-o" aria-hidden="true"></i></a>

													<?php }
												}	
											}else{?>
													<a href="<?php echo base_url() . 'Ctax/tax_update_form/'.$tl['tax_id']; ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="<?php echo display('update') ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
													<a href="" class="deleteActivity btn btn-danger btn-sm" name="<?php echo $tl['tax_id']; ?>" data-toggle="tooltip" data-placement="right" title="" data-original-title="<?php echo display('delete') ?> "><i class="fa fa-trash-o" aria-hidden="true"></i></a>
													
											<?php }?>
												
                                            <?php echo form_close() ?>
                                        </center>
                                        </td>
                                           <?php } ?>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                                </tbody>
                            </table>
                            <div class="text-right"><?php echo $links ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Manage Customer End -->

<!-- Delete Customer ajax code -->
<script type="text/javascript">
    //Delete Activity 
    $(".deleteActivity").click(function ()
    {
        var tax_id = $(this).attr('name');
        var x = confirm("<?php echo display('are_you_sure') ?>");
        if (x == true) {
            $.ajax
                    ({
                        type: "POST",
                        url: '<?php echo base_url('Ctax/tax_delete') ?>',
                        data: {tax_id: tax_id},
                        cache: false,
                        success: function (datas)
                        {
                        }
                    });
        }
    });
</script>