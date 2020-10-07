<?= message_box('success'); ?>
<?= message_box('error');
$created = can_action('151', 'created');
$edited = can_action('151', 'edited');
$deleted = can_action('151', 'deleted');
if (!empty($created) || !empty($edited)){
?>
<div class="nav-tabs-custom">
    <!-- Tabs within a box -->
    <ul class="nav nav-tabs">
        <li class="<?= $active == 1 ? 'active' : ''; ?>"><a href="#manage"
                                                            data-toggle="tab"><?= lang('supplier') . ' ' . lang('list') ?></a>
        </li>
        <li class="<?= $active == 2 ? 'active' : ''; ?>"><a href="#create"
                                                            data-toggle="tab"><?= lang('new') . ' ' . lang('supplier') ?></a>
        </li>
    </ul>
    <div class="tab-content bg-white">
        <!-- ************** general *************-->
        <div class="tab-pane <?= $active == 1 ? 'active' : ''; ?>" id="manage">
            <?php } else { ?>
            <div class="panel panel-custom">
                <header class="panel-heading ">
                    <div class="panel-title"><strong><?= lang('supplier') . ' ' . lang('list') ?></strong></div>
                </header>
                <?php } ?>
                <div class="table-responsive">
                    <table class="table table-striped DataTables " id="DataTables">
                        <thead>
                        <tr>
                            <th ><?= lang('name') ?></th>
                            <th class="col-sm-1"><?= lang('mobile') ?></th>
                            <th class="col-sm-1"><?= lang('phone') ?></th>
                            <th class="col-sm-2"><?= lang('email') ?></th>
                            <th class="col-sm-2"><?= lang('address') ?></th>
                        
                            <?php $show_custom_fields = custom_form_table(19, null);
                            if (!empty($show_custom_fields)) {
                                foreach ($show_custom_fields as $c_label => $v_fields) {
                                    if (!empty($c_label)) {
                                        ?>
                                        <th><?= $c_label ?> </th>
                                    <?php }
                                }
                            }
                            ?>
                            <?php if (!empty($edited) || !empty($deleted)) { ?>
                                <th class="col-sm-1"><?= lang('action') ?></th>
                            <?php } ?>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <script type="text/javascript">
                            list = base_url + "admin/supplier/supplierList";
                        </script>
                    </table>

                </div>
            </div>
            <?php if (!empty($created) || !empty($edited)){ ?>
                <div class="tab-pane <?= $active == 2 ? 'active' : ''; ?>" id="create">
                    <form role="form" data-parsley-validate="" novalidate="" enctype="multipart/form-data" id="form"
                          action="<?php echo base_url(); ?>admin/supplier/saved_supplier/<?php
                          if (!empty($supplier_info)) {
                              echo $supplier_info->supplier_id;
                          }
                          ?>" method="post" class="form-horizontal  ">
                        <div class="form-group">
                            <label class="col-lg-3 control-label"><?= lang('name') ?> <span
                                        class="text-danger">*</span></label>
                            <div class="col-lg-5">
                                <input type="text" class="form-control" value="<?php
                                if (!empty($supplier_info)) {
                                    echo $supplier_info->name;
                                }
                                ?>" name="name" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label"><?= lang('mobile') ?> <span
                                        class="text-danger">*</span></label>
                            <div class="col-lg-5">
                                <input type="text" class="form-control" data-parsley-type="number"  value="<?php
                                if (!empty($supplier_info)) {
                                    echo $supplier_info->mobile;
                                }
                                ?>" name="mobile" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label"><?= lang('phone') ?></label>
                            <div class="col-lg-5">
                                <input type="text" class="form-control" data-parsley-type="number"  value="<?php
                                if (!empty($supplier_info)) {
                                    echo $supplier_info->phone;
                                }
                                ?>" name="phone">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label"><?= lang('email') ?> <span
                                        class="text-danger">*</span></label>
                            <div class="col-lg-5">
                                <input type="text" class="form-control" value="<?php
                                if (!empty($supplier_info)) {
                                    echo $supplier_info->email;
                                }
                                ?>" name="email" required="">
                            </div>
                        </div>
                        <!-- End discount Fields -->
                        <div class="form-group terms">
                            <label class="col-lg-3 control-label"><?= lang('address') ?> </label>
                            <div class="col-lg-5">
                        <textarea name="address" class="form-control"><?php
                            if (!empty($supplier_info)) {
                                echo $supplier_info->address;
                            }
                            ?></textarea>
                            </div>
                        </div>
                        <div class="form-group terms">
                            <label class="col-lg-3 control-label">State </label>
                            <div class="col-lg-5">
								<select class="form-control" name="state" id="state">
									<option value="0">Select</option>
									<?php $all_state = $this->db->get('state')->result();
									if (!empty($all_state)) {
										foreach ($all_state as $cats) { 
											echo '<option value="'.$cats->id.'" data-id ="'.$cats->name.'">'.$cats->name.'</option>';
										}
									}
									?>
								</select>
                            </div>
                        </div>
                        <div class="form-group terms">
                            <label class="col-lg-3 control-label">City </label>
                            <div class="col-lg-5">
    							<select name="city" id="city" class="form-control"></select>
    							<span class="city_error"></span>
                            </div>
                        </div>
                        <div class="form-group terms">
                            <label class="col-lg-3 control-label"> </label>
                            <div class="col-lg-5">
                                <a href="javascript:void(0)"
                                   class="btn btn-xs btn-success" data-toggle="modal" data-placement="top"
                                   data-target="#payment_term">Add Payment Term
                                   </a>
                            </div>
                        </div>
					<!-- payment term model -->
					<div id="payment_term" class="modal fade in" role="dialog" >
						<div class="modal-dialog modal-lg">

							<!-- Modal content-->
							<div class="modal-content" id="ajax_modal">
					 			<div class="panel-heading">                            
									<h4 class="panel-title">Payment Terms</h4>
									<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">x</span><span class="sr-only">Close</span></button>
								</div>
								<div class="modal-body wrap-modal wrap">      
								    <table width="100%" id="pay">
								        <thead>
								            <th>S.no</th>
								            <th>No. of Days</th>
								            <th>Discount(%)</th>
								            <th>Interest(%)</th>
								        </thead>
								        <tbody>
								            <td>1.</td>
								            <td><input type="text" name="days[]" id="days1"></td>
								            <td><input type="text" name="discount[]" id="discount1"></td>
								            <td><input type="text" name="interest[]" id="interest1"></td>
								        </tbody>
								    </table>  
                        			<button type="button" class='btn btn-success addmore' style='background-color:#4AAE20;'>+ Add Row</button>  
                        			<br>
                        			<center><button class='btn btn-success' style='background-color:#3B5999;' type="button" data-dismiss="modal">Submit</button></center>
								</div>

							</div>
						</div>
					</div>
					<!-- /payment term -->
                        <div class="form-group" id="border-none">
                            <label for="field-1" class="col-sm-3 control-label"><?= lang('permission') ?> <span
                                        class="required">*</span></label>
                            <div class="col-sm-9">
                                <div class="checkbox c-radio needsclick">
                                    <label class="needsclick">
                                        <input id="" <?php
                                        if (!empty($supplier_info->permission) && $supplier_info->permission == 'all') {
                                            echo 'checked';
                                        } elseif (empty($supplier_info)) {
                                            echo 'checked';
                                        }
                                        ?> type="radio" name="permission" value="everyone">
                                        <span class="fa fa-circle"></span><?= lang('everyone') ?>
                                        <i title="<?= lang('permission_for_all') ?>"
                                           class="fa fa-question-circle" data-toggle="tooltip"
                                           data-placement="top"></i>
                                    </label>
                                </div>
                                <div class="checkbox c-radio needsclick">
                                    <label class="needsclick">
                                        <input id="" <?php
                                        if (!empty($supplier_info->permission) && $supplier_info->permission != 'all') {
                                            echo 'checked';
                                        }
                                        ?> type="radio" name="permission" value="custom_permission"
                                        >
                                        <span class="fa fa-circle"></span><?= lang('custom_permission') ?> <i
                                                title="<?= lang('permission_for_customization') ?>"
                                                class="fa fa-question-circle" data-toggle="tooltip"
                                                data-placement="top"></i>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group <?php
                        if (!empty($supplier_info->permission) && $supplier_info->permission != 'all') {
                            echo 'show';
                        }
                        ?>" id="permission_user_1">
                            <label for="field-1"
                                   class="col-sm-3 control-label"><?= lang('select') . ' ' . lang('users') ?>
                                <span
                                        class="required">*</span></label>
                            <div class="col-sm-9">
                                <?php
                                if (!empty($permission_user)) {
                                    foreach ($permission_user as $key => $v_user) {

                                        if ($v_user->role_id == 1) {
                                            $role = '<strong class="badge btn-danger">' . lang('admin') . '</strong>';
                                        } else {
                                            $role = '<strong class="badge btn-primary">' . lang('staff') . '</strong>';
                                        }

                                        ?>
                                        <div class="checkbox c-checkbox needsclick">
                                            <label class="needsclick">
                                                <input type="checkbox"
                                                    <?php
                                                    if (!empty($supplier_info->permission) && $supplier_info->permission != 'all') {
                                                        $get_permission = json_decode($supplier_info->permission);
                                                        foreach ($get_permission as $user_id => $v_permission) {
                                                            if ($user_id == $v_user->user_id) {
                                                                echo 'checked';
                                                            }
                                                        }

                                                    }
                                                    ?>
                                                       value="<?= $v_user->user_id ?>"
                                                       name="assigned_to[]"
                                                       class="needsclick">
                                                <span
                                                        class="fa fa-check"></span><?= $v_user->username . ' ' . $role ?>
                                            </label>

                                        </div>
                                        <div class="action_1 p
                                                <?php

                                        if (!empty($supplier_info->permission) && $supplier_info->permission != 'all') {
                                            $get_permission = json_decode($supplier_info->permission);

                                            foreach ($get_permission as $user_id => $v_permission) {
                                                if ($user_id == $v_user->user_id) {
                                                    echo 'show';
                                                }
                                            }

                                        }
                                        ?>
                                                " id="action_1<?= $v_user->user_id ?>">
                                            <label class="checkbox-inline c-checkbox">
                                                <input id="<?= $v_user->user_id ?>" checked type="checkbox"
                                                       name="action_1<?= $v_user->user_id ?>[]"
                                                       disabled
                                                       value="view">
                                                <span
                                                        class="fa fa-check"></span><?= lang('can') . ' ' . lang('view') ?>
                                            </label>
                                            <label class="checkbox-inline c-checkbox">
                                                <input id="<?= $v_user->user_id ?>"
                                                    <?php

                                                    if (!empty($supplier_info->permission) && $supplier_info->permission != 'all') {
                                                        $get_permission = json_decode($supplier_info->permission);

                                                        foreach ($get_permission as $user_id => $v_permission) {
                                                            if ($user_id == $v_user->user_id) {
                                                                if (in_array('edit', $v_permission)) {
                                                                    echo 'checked';
                                                                };

                                                            }
                                                        }

                                                    }
                                                    ?>
                                                       type="checkbox"
                                                       value="edit" name="action_<?= $v_user->user_id ?>[]">
                                                <span
                                                        class="fa fa-check"></span><?= lang('can') . ' ' . lang('edit') ?>
                                            </label>
                                            <label class="checkbox-inline c-checkbox">
                                                <input id="<?= $v_user->user_id ?>"
                                                    <?php

                                                    if (!empty($supplier_info->permission) && $supplier_info->permission != 'all') {
                                                        $get_permission = json_decode($supplier_info->permission);
                                                        foreach ($get_permission as $user_id => $v_permission) {
                                                            if ($user_id == $v_user->user_id) {
                                                                if (in_array('delete', $v_permission)) {
                                                                    echo 'checked';
                                                                };
                                                            }
                                                        }

                                                    }
                                                    ?>
                                                       name="action_<?= $v_user->user_id ?>[]"
                                                       type="checkbox"
                                                       value="delete">
                                                <span
                                                        class="fa fa-check"></span><?= lang('can') . ' ' . lang('delete') ?>
                                            </label>
                                            <input id="<?= $v_user->user_id ?>" type="hidden"
                                                   name="action_<?= $v_user->user_id ?>[]" value="view">

                                        </div>


                                        <?php
                                    }
                                }
                                ?>


                            </div>
                        </div>
                         <?php
                    if (!empty($supplier_info)) {
                        $supplier_id = $supplier_info->supplier_id;
                    } else {
                        $supplier_id = null;
                    }
                    ?>
                    <?= custom_form_Fields(19, $supplier_id); ?>
                        <div class="btn-bottom-toolbar text-right">
                            <?php
                            if (!empty($supplier_info)) { ?>
                                <button type="submit"
                                        class="btn btn-sm btn-primary"><?= lang('updates') ?></button>
                                <button type="button" onclick="goBack()"
                                        class="btn btn-sm btn-danger"><?= lang('cancel') ?></button>
                            <?php } else {
                                ?>
                                <button type="submit"
                                        class="btn btn-sm btn-primary"><?= lang('create') ?></button>
                            <?php }
                            ?>
                        </div>
                    </form>
                </div>
            <?php } else { ?>
        </div>
        <?php } ?>

    </div>
</div>
<script>
    

    $('#state').change(function(){
		var city_list = $('#city');
		$.ajax({
            url  : '<?= base_url('admin/supplier/city_by_state/') ?>',
            type : 'post',
            dataType : 'JSON',
            data : {
                '<?= $this->security->get_csrf_token_name(); ?>' : '<?= $this->security->get_csrf_hash(); ?>',
                state_id : $(this).val()
            },
            success : function(data) 
            {
                if (data.status == true) {
                    city_list.html(data.message);
                } else if (data.status == false) {
					$('#city').val("");
                    city_list.html('');
                } else {
                    city_list.html('');
                }
            }, 
            error : function(data)
            {
                alert('failed');
            }
        });
		
    });
</script><script>

$(".delete").on('click', function() {
	$('.case:checkbox:checked').parents("tr").remove();
    $('.check_all').prop("checked", false); 
	check();

});
var i=2;
$(".addmore").on('click',function(){
	count=$('table#pay tr').length;
    var data="<tr><td><span id='snum"+i+"'>"+count+".</span></td>";
    data +="<td><input type='text' name='days[]' id='days"+i+"'></td>"+
           "<td><input type='text' name='discount[]' id='discount"+i+"'></td>"+
           "<td><input type='text' name='interest[]' id='interest"+i+"'></td></tr>";
	$('table').append(data);
	i++;
});

</script>