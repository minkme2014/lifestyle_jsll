<!-- Add User start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('add_role') ?></h1>
            <small><?php echo display('add_role') ?></small>
            <ol class="breadcrumb">
                <li><a href="index.html"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('web_settings') ?></a></li>
                <li class="active"><?php echo display('add_role') ?></li>
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

        <!-- New user -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('new_role') ?> </h4>
                        </div>
                    </div>
                    <?php echo form_open_multipart('User/insert_role', array('class' => 'form-vertical',)) ?>
                    <div class="panel-body">

                        <div class="form-group row">
                            <label for="role" class="col-sm-3  col-md-3 col-form-label"><?php echo display('new_role') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-9 col-md-6">
                                <input type="text" class="form-control" name="role" id="new_role" placeholder="<?php echo display('new_role') ?>" required />
                            </div>
                        </div>
                        
                                
            <div class="table-responsive">
                <table class="table table-striped" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>
                            <div class="form-group">
                                <label class="needsclick" data-toggle="tooltip" data-placement="top"
                                       title="select_all permission">
									   <input type="checkbox" id="select_all">
                                    <!--span class="fa fa-check"></span-->
                                    <strong>permission</strong>
                                </label>
                            </div>
                        </th>
                        <th>
                            <div class="form-group">
                                <label class="needsclick" data-toggle="tooltip" data-placement="top"
                                       title="view_help">
                                    <input id="select_all_view" type="checkbox">
                                    <!--span class="fa fa-check"></span-->
                                    <strong>view</strong>
                                </label>
                            </div>
                        </th>
                        <th>
                            <div class="form-group">
                                <label class="needsclick" data-toggle="tooltip" data-placement="top"
                                       title="select_all create">
                                    <input id="select_all_create" type="checkbox">
                                    <!--span class="fa fa-check"></span-->
                                    <strong>create</strong>
                                </label>
                            </div>
                        </th>
                        <th>
                            <div class="form-group">
                                <label class="needsclick" data-toggle="tooltip" data-placement="top"
                                       title="select_all edit">
                                    <input id="select_all_edit" type="checkbox">
                                    <!--span class="fa fa-check"></span-->
                                    <strong>edit</strong>
                                </label>
                            </div>
                        </th>
                        <th>
                            <div class="form-group">
                                <label class="needsclick" data-toggle="tooltip" data-placement="top"
                                       title="select_all delete">
                                    <input id="select_all_delete" type="checkbox">
                                    <!--span class="fa fa-check"></span-->
                                    <strong>delete</strong>
                                </label>
                            </div>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
						<?php
							$menu_info = $this->db->where('status !=', 0)->order_by('sort')->get('tbl_menu')->result();
							//print_r($menu_info);
							foreach ($menu_info as $items) {
								$menu['parents'][$items->parent][] = $items;
								      ?>
                        <script type="text/javascript">
                            $(document).ready(function () {
                                <?php if($items->label == 'dashboard'){?>
                                $('#<?= $items->menu_id?>').prop('checked', true);
                                $('.<?= $items->menu_id?>').prop('checked', true);
                                $('.<?= $items->menu_id?>').prop('disabled', true);
                                $('.view .<?= $items->menu_id?>').prop('disabled', false);
                                $(".<?= $items->menu_id?>").next().css('display', 'none');
                                $(".view .<?= $items->menu_id?>").next().css('display', 'block');
                                <?php }?>
                           
                                <?php
                                if ($items->label == 'performance_indicator' || $items->label == 'give_appraisal') {?>
                                $('.delete .<?= $items->menu_id?>').prop('disabled', true);
                                $(".delete .<?= $items->menu_id?>").next().css('display', 'none');
                                <?php }?>
                                $('#select_all').change(function () {
                                    var c = this.checked;
                                    $(':checkbox').prop('checked', c);
                                });

                                //select select_all_view
                                $("#select_all_view").change(function () {  //"select all" change
                                    $(".view > input").prop('checked', $(this).prop("checked")); //change all ".checkbox" checked status
                                    var values = $(".view > input").map(function () {
                                        if ($(".view > input").is(":checked")) {
                                            $("#" + this.value).prop('checked', true);
                                        } else {
                                            if ($('.' + this.value + ':checked').length == 0) {
                                                $("#" + this.value).prop('checked', false);
                                            }
                                        }
                                    }).get();
                                });
                                //select select_all_create
                                $("#select_all_create").change(function () {  //"select all" change
                                    $(".create > input").prop('checked', $(this).prop("checked")); //change all ".checkbox" checked status
                                    var values = $(".create > input").map(function () {
                                        if ($(".create > input").is(":checked")) {
                                            $("#" + this.value).prop('checked', true);
                                        } else {
                                            if ($('.' + this.value + ':checked').length == 0) {
                                                $("#" + this.value).prop('checked', false);
                                            }
                                        }
                                    }).get();
                                });

                                //select select_all_create
                                $("#select_all_edit").change(function () {  //"select all" change
                                    $(".edit > input").prop('checked', $(this).prop("checked")); //change all ".checkbox" checked status
                                    var values = $(".edit > input").map(function () {
                                        if ($(".edit > input").is(":checked")) {
                                            $("#" + this.value).prop('checked', true);
                                        } else {
                                            if ($('.' + this.value + ':checked').length == 0) {
                                                $("#" + this.value).prop('checked', false);
                                            }
                                        }
                                    }).get();
                                });
                                //select select_all_create
                                $("#select_all_delete").change(function () {  //"select all" change
                                    $(".delete > input").prop('checked', $(this).prop("checked")); //change all ".checkbox" checked status
                                    var values = $(".delete > input").map(function () {
                                        if ($(".delete > input").is(":checked")) {
                                            $("#" + this.value).prop('checked', true);
                                        } else {
                                            if ($('.' + this.value + ':checked').length == 0) {
                                                $("#" + this.value).prop('checked', false);
                                            }
                                        }
                                    }).get();
                                });
                                //select all view
                                $("#all_view_<?= $items->menu_id;?>").change(function () {  //"select all" change
                                    $(".view .<?= $items->menu_id;?>").prop('checked', $(this).prop("checked")); //change all ".checkbox" checked status
                                    var values = $('.view .<?= $items->menu_id;?>').map(function () {
                                        if ($(".view .<?= $items->menu_id;?>").is(":checked")) {
                                            $("#" + this.value).prop('checked', true);
                                        } else {
                                            if ($('.' + this.value + ':checked').length == 0) {
                                                $("#" + this.value).prop('checked', false);
                                            }
                                        }
                                    }).get();
                                });
                                //select all all_create
                                $("#all_create_<?= $items->menu_id;?>").change(function () {  //"select all" change
                                    $(".create .<?= $items->menu_id;?>").prop('checked', $(this).prop("checked")); //change all ".checkbox" checked status
                                    var values = $('.create .<?= $items->menu_id;?>').map(function () {
                                        if ($(".create .<?= $items->menu_id;?>").is(":checked")) {
                                            $("#" + this.value).prop('checked', true);
                                        } else {
                                            if ($('.' + this.value + ':checked').length == 0) {
                                                $("#" + this.value).prop('checked', false);
                                            }
                                        }
                                    }).get();
                                });
                                //select all all_edit
                                $("#all_edit_<?= $items->menu_id;?>").change(function () {  //"select all" change
                                    $(".edit .<?= $items->menu_id;?>").prop('checked', $(this).prop("checked")); //change all ".checkbox" checked status
                                    var values = $('.edit .<?= $items->menu_id;?>').map(function () {
                                        if ($(".edit .<?= $items->menu_id;?>").is(":checked")) {
                                            $("#" + this.value).prop('checked', true);
                                        } else {
                                            if ($('.' + this.value + ':checked').length == 0) {
                                                $("#" + this.value).prop('checked', false);
                                            }
                                        }
                                    }).get();
                                });
                                //select all all_edit
                                $("#all_delete_<?= $items->menu_id;?>").change(function () {  //"select all" change
                                    $(".delete .<?= $items->menu_id;?>").prop('checked', $(this).prop("checked")); //change all ".checkbox" checked status
                                    var values = $('.delete .<?= $items->menu_id;?>').map(function () {
                                        if ($(".delete .<?= $items->menu_id;?>").is(":checked")) {
                                            $("#" + this.value).prop('checked', true);
                                        } else {
                                            if ($('.' + this.value + ':checked').length == 0) {
                                                $("#" + this.value).prop('checked', false);
                                            }
                                        }
                                    }).get();
                                });


                                //select all checkboxes
                                $("#<?= $items->menu_id;?>").change(function () {  //"select all" change
                                    $(".<?= $items->menu_id;?>").prop('checked', $(this).prop("checked")); //change all ".checkbox" checked status
                                });
                                if ($("input#<?= $items->menu_id;?>").is(':checked')) {
                                    $('.c_<?= $items->menu_id;?>').show();
                                    $("#parent_<?= $items->menu_id;?>").addClass('minus');
                                    $("#parent_<?= $items->menu_id;?>").removeClass('plus');
                                }
                                $("#parent_<?= $items->menu_id;?>").click(function () {
                                    $("#parent_<?= $items->menu_id;?>").toggleClass('minus');
                                    $("#parent_<?= $items->menu_id;?>").toggleClass('plus');
                                    $('.c_<?= $items->menu_id;?>').slideToggle('fast');
                                });
                                //".checkbox" change
                                $('.<?= $items->menu_id;?>').change(function () {
                                    //check "select all" if all checkbox items are checked
                                    if ($('.<?= $items->menu_id;?>:checked').length) {
                                        $("#<?= $items->menu_id;?>").prop('checked', true);
                                    }
                                    if ($('.<?= $items->menu_id;?>:checked').length == 0) {
                                        $("#<?= $items->menu_id;?>").prop('checked', false); //change "select all" checked status to false
                                    }
                                });
                            });
                        </script>

                    <?php 
							}
							
							$CI =& get_instance();
							$all_menus = $CI->buildChild(0, $menu);
                    if (!empty($all_menus)) {
                        foreach ($all_menus as $parent => $v_parent) {
                            if (is_array($v_parent)) { // if this have child
                                if (!empty($v_parent)) {
                                    foreach ($v_parent as $parent_id => $v_child) { ?>
                                        <style type="text/css">
                                            .plus {
                                                background: url(<?= base_url()?>my-assets/image/icon_plus.png) no-repeat 4px 5px;
                                                background-size: 8px 8px;
                                            }

                                            .minus {
                                                background: url(<?= base_url()?>my-assets/image/icon_minus.png) no-repeat 4px 8px;
                                                background-size: 8px 2px;
                                            }

                                            .parent {
                                                width: 4%;
                                                margin-top: 6px;
                                                cursor: pointer;
                                            }

                                            .parent span {
                                                visibility: hidden;
                                            }

                                            .child {
                                                display: none
                                            }
                                        </style>
                                        <tr style="background: #e2e2e2;">
                                            <th>
                                                <div id="parent_<?= $parent_id; ?>" class="parent plus pull-left">
                                                    <span>X</span></div>
                                                <div class="form-group pull-left">
                                                    <label class="needsclick " data-toggle="tooltip"
                                                           data-placement="top"
                                                           title="select_all">
                                                        <input id="<?php if (!empty($parent_id)) {
                                                            echo $parent_id;
                                                        } ?>" type="checkbox" name="menu[]" value="<?= $parent_id; ?>">
                                                        <!--span class="fa fa-check"></span-->
                                                        <strong><?php echo $parent; ?></strong>
                                                    </label>
                                                </div>
                                            </th>
                                            <th>
                                                <div class="form-group ">
                                                    <label class="needsclick view" data-toggle="tooltip"
                                                           data-placement="top"
                                                           title="select_all">
                                                        <input id="all_view_<?php if (!empty($parent_id)) {
                                                            echo $parent_id;
                                                        } ?>" class="<?php if (!empty($parent_id)) {
                                                            echo $parent_id;
                                                        } ?>" type="checkbox" name="view_<?= $parent_id ?>"
                                                               value="<?= $parent_id ?>">
                                                        <!--span class="fa fa-check"></span-->
                                                    </label>
                                                </div>
                                            </th>
                                            <th>
                                                <div class="form-group ">
                                                    <label class="needsclick create" data-toggle="tooltip"
                                                           data-placement="top"
                                                           title="select_all">
                                                        <input id="all_create_<?php if (!empty($parent_id)) {
                                                            echo $parent_id;
                                                        } ?>" class="<?php if (!empty($parent_id)) {
                                                            echo $parent_id;
                                                        } ?>" type="checkbox" name="created_<?= $parent_id ?>"
                                                               value="<?= $parent_id ?>">
                                                        <!--span class="fa fa-check"></span-->
                                                    </label>
                                                </div>
                                            </th>
                                            <th>
                                                <div class="form-group">
                                                    <label class="needsclick edit" data-toggle="tooltip"
                                                           data-placement="top"
                                                           title="select_all">
                                                        <input id="all_edit_<?php if (!empty($parent_id)) {
                                                            echo $parent_id;
                                                        } ?>" class="<?php if (!empty($parent_id)) {
                                                            echo $parent_id;
                                                        } ?>" type="checkbox" name="edited_<?= $parent_id ?>"
                                                               value="<?= $parent_id ?>">
                                                        <!--span class="fa fa-check"></span-->
                                                    </label>
                                                </div>
                                            </th>
                                            <th>
                                                <div class="form-group">
                                                    <label class="needsclick delete" data-toggle="tooltip"
                                                           data-placement="top"
                                                           title="select_all">
                                                        <input id="all_delete_<?php if (!empty($parent_id)) {
                                                            echo $parent_id;
                                                        } ?>" class="<?php if (!empty($parent_id)) {
                                                            echo $parent_id;
                                                        } ?>" type="checkbox" name="deleted_<?= $parent_id ?>"
                                                               value="<?= $parent_id ?>">
                                                        <!--span class="fa fa-check"></span-->
                                                    </label>
                                                </div>
                                            </th>
                                        </tr>
                                        <?php
                                        if (!empty($v_child)) {
                                            foreach ($v_child as $child => $v_sub_child) {
                                                if (is_array($v_sub_child)) {
                                                    foreach ($v_sub_child as $sub_chld => $v_sub_chld) { ?>
                                                        <tr style="background: #eeeeee">
                                                            <td style="display: block;padding-left: 35px;">
                                                                <div id="parent_<?= $sub_chld; ?>"
                                                                     class="parent plus pull-left">
                                                                    <span>X</span></div>
                                                                <div class="form-group pull-left">
                                                                    <label class="needsclick " data-toggle="tooltip"
                                                                           data-placement="top"
                                                                           title="select_all">
                                                                        <input  class="<?= $parent_id; ?>"
                                                                           id="<?= $sub_chld; ?>" type="checkbox"
                                                                           name="menu[]" value="<?= $sub_chld; ?>">
                                                                        <!--span class="fa fa-check"></span-->
                                                                        <strong><?php echo $child; ?></strong>
                                                                    </label>
                                                                </div>
                                                            </td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <?php
                                                        foreach ($v_sub_chld as $sub_chld_name => $sub_chld_id) {
                                                            if (is_array($sub_chld_id)) {
                                                                foreach ($sub_chld_id as $sub_chld_1 => $v_sub_chld_1) { ?>
                                                                    <tr style="background: #e2e2e2">
                                                                        <td style="display: block;padding-left: 60px;">
                                                                            <div id="parent_<?= $sub_chld_1; ?>"
                                                                                 class="parent plus pull-left">
                                                                                <span>X</span></div>
                                                                            <div class="form-group pull-left">
                                                                                <label class="needsclick "
                                                                                       data-toggle="tooltip"
                                                                                       data-placement="top"
                                                                                       title="select_all">
                                                                                    <input
                                                                                        class="<?= $parent_id . ' ' . $sub_chld; ?>"
                                                                                        id="<?= $sub_chld_1; ?>"
                                                                                        type="checkbox" name="menu[]"
                                                                                        value="<?= $sub_chld_1; ?>">
                                                                                    <!--span class="fa fa-check"></span-->
                                                                                    <strong><?php echo $sub_chld_name; ?></strong>
                                                                                </label>
                                                                            </div>
                                                                        </td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                    </tr>
                                                                    <?php
                                                                    foreach ($v_sub_chld_1 as $sub_chld_name_1 => $v_sub_chld_2) {
                                                                        if (is_array($v_sub_chld_2)) {
                                                                            foreach ($v_sub_chld_2 as $sub_chld_name_2 => $v_sub_chld_3) {
                                                                                ?>
                                                                                <tr style="background: #eeeeee">
                                                                                    <td style="display: block;padding-left: 85px;">
                                                                                        <div
                                                                                            id="parent_<?= $sub_chld_name_2; ?>"
                                                                                            class="parent plus pull-left">
                                                                                            <span>X</span></div>
                                                                                        <div
                                                                                            class="form-group pull-left">
                                                                                            <label class="needsclick "
                                                                                                   data-toggle="tooltip"
                                                                                                   data-placement="top"
                                                                                                   title="select_all">
                                                                                                <input
                                                                                                    class="<?= $parent_id . ' ' . $sub_chld . ' ' . $sub_chld_1; ?>"
                                                                                                    id="<?= $sub_chld_name_2; ?>"
                                                                                                    type="checkbox"
                                                                                                    name="menu[]"
                                                                                                    value="<?= $sub_chld_name_2; ?>">
                                                                                        <!--span class="fa fa-check"></span-->
                                                                                                <strong><?php echo $sub_chld_name_1; ?></strong>
                                                                                            </label>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td></td>
                                                                                    <td></td>
                                                                                    <td></td>
                                                                                </tr>
                                                                                <?php
                                                                                foreach ($v_sub_chld_3 as $sub_chld_name_3 => $v_sub_chld_4) {
                                                                                    if (is_array($v_sub_chld_4)) {

                                                                                    } else {
                                                                                        ?>
                                                                                        <tr class="child c_<?= $sub_chld_name_2; ?>">
                                                                                            <td style="display: block;padding-left: 110px">
                                                                                                <div
                                                                                                    class="form-group">
                                                                                                    <label
                                                                                                        class="needsclick "
                                                                                                        data-toggle="tooltip"
                                                                                                        data-placement="top"
                                                                                                        title="select">
                                                                                                        <input id="<?= $v_sub_chld_4; ?>"
                                                                                                           class="<?= $parent_id . ' ' . $sub_chld . ' ' . $sub_chld_name_2 . ' ' . $sub_chld_1; ?>"
                                                                                                           type="checkbox"
                                                                                                           name="menu[]"
                                                                                                           value="<?= $v_sub_chld_4; ?>">
                                                                                                <!--span class="fa fa-check"></span-->
                                                                                                        <strong><?php echo $sub_chld_name_3; ?></strong>
                                                                                                    </label>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td>
                                                                                                <div
                                                                                                    class="form-group ">
                                                                                                    <label
                                                                                                        class="needsclick view"
                                                                                                        data-toggle="tooltip"
                                                                                                        data-placement="top"
                                                                                                        title="view_help">
                                                                                                        <input
                                                                                                            class="<?= $sub_chld . ' ' . $v_sub_chld_4 . ' ' . $sub_chld_name_2 . ' ' . $parent_id . ' ' . $sub_chld_1; ?>"
                                                                                                            type="checkbox"
                                                                                                            name="view_<?= $v_sub_chld_4; ?>"
                                                                                                            value="<?= $v_sub_chld_4; ?>">
                                                                                                <!--span class="fa fa-check"></span-->
                                                                                                    </label>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td>
                                                                                                <div
                                                                                                    class="form-group ">
                                                                                                    <label
                                                                                                        class="needsclick create"
                                                                                                        data-toggle="tooltip"
                                                                                                        data-placement="top"
                                                                                                        title="can create">
                                                                                                        <input class="<?= $sub_chld . ' ' . $v_sub_chld_4 . ' ' . $sub_chld_name_2 . ' ' . $parent_id . ' ' . $sub_chld_1; ?>"
                                                                                                            type="checkbox"
                                                                                                            name="created_<?= $v_sub_chld_4; ?>"
                                                                                                            value="<?= $v_sub_chld_4; ?>">
                                                                                                <!--span class="fa fa-check"></span-->
                                                                                                    </label>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td>
                                                                                                <div
                                                                                                    class="form-group">
                                                                                                    <label
                                                                                                        class="needsclick edit"
                                                                                                        data-toggle="tooltip"
                                                                                                        data-placement="top"
                                                                                                        title="can edit">
                                                                                                        <input 
                                                                                                            class="<?= $sub_chld . ' ' . $v_sub_chld_4 . ' ' . $sub_chld_name_2 . ' ' . $parent_id . ' ' . $sub_chld_1; ?>"
                                                                                                            type="checkbox"
                                                                                                            name="edited_<?= $v_sub_chld_4; ?>"
                                                                                                            value="<?= $v_sub_chld_4; ?>">
                                                                                                <!--span class="fa fa-check"></span-->
                                                                                                    </label>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td>
                                                                                                <div
                                                                                                    class="form-group">
                                                                                                    <label
                                                                                                        class="needsclick delete"
                                                                                                        data-toggle="tooltip"
                                                                                                        data-placement="top"
                                                                                                        title="can delete">
                                                                                                        <input class="<?= $sub_chld . ' ' . $v_sub_chld_4 . ' ' . $sub_chld_name_2 . ' ' . $parent_id . ' ' . $sub_chld_1; ?>"
                                                                                                           type="checkbox"
                                                                                                           name="deleted_<?= $v_sub_chld_4; ?>"
                                                                                                           value="<?= $v_sub_chld_4; ?>">
                                                                                                <!--span class="fa fa-check"></span-->
                                                                                                    </label>
                                                                                                </div>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <?php
                                                                                    }
                                                                                }
                                                                            }
                                                                        } else { ?>
                                                                            <tr class="child c_<?= $sub_chld_1; ?>">
                                                                                <td style="display: block;padding-left: 85px">
                                                                                    <div class="form-group ">
                                                                                        <label class="needsclick "
                                                                                               data-toggle="tooltip"
                                                                                               data-placement="top"
                                                                                               title="select">
                                                                                            <input   id="<?= $v_sub_chld_2; ?>"
                                                                                               class="<?= $parent_id . ' ' . $sub_chld . ' ' . $sub_chld_1; ?>"
                                                                                               type="checkbox"
                                                                                               name="menu[]"
                                                                                               value="<?= $v_sub_chld_2; ?>">
                                                                                        <!--span class="fa fa-check"></span-->
                                                                                            <strong><?php echo $sub_chld_name_1; ?></strong>
                                                                                        </label>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="form-group ">
                                                                                        <label class="needsclick view"
                                                                                               data-toggle="tooltip"
                                                                                               data-placement="top"
                                                                                               title="view_help">
                                                                                            <input 
                                                                                                class="<?= $sub_chld . ' ' . $parent_id . ' ' . $v_sub_chld_2 . ' ' . $sub_chld_1; ?>"
                                                                                                type="checkbox"
                                                                                                name="view_<?= $v_sub_chld_2; ?>"
                                                                                                value="<?= $v_sub_chld_2; ?>">
                                                                                        <!--span class="fa fa-check"></span-->
                                                                                        </label>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="form-group ">
                                                                                        <label class="needsclick create"
                                                                                               data-toggle="tooltip"
                                                                                               data-placement="top"
                                                                                               title="can create">
                                                                                            <input 
                                                                                                class="<?= $sub_chld . ' ' . $parent_id . ' ' . $v_sub_chld_2 . ' ' . $sub_chld_1; ?>"
                                                                                                type="checkbox"
                                                                                                name="created_<?= $v_sub_chld_2; ?>"
                                                                                                value="<?= $v_sub_chld_2; ?>">
                                                                                        <!--span class="fa fa-check"></span-->
                                                                                        </label>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="form-group">
                                                                                        <label class="needsclick edit"
                                                                                               data-toggle="tooltip"
                                                                                               data-placement="top"
                                                                                               title="can edit">
                                                                                            <input   class="<?= $sub_chld_1 . ' ' . $sub_chld . ' ' . $v_sub_chld_2 . ' ' . $parent_id; ?>"
                                                                                               type="checkbox"
                                                                                               name="edited_<?= $v_sub_chld_2; ?>"
                                                                                               value="<?= $v_sub_chld_2; ?>">
                                                                                        <!--span class="fa fa-check"></span-->
                                                                                        </label>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="form-group">
                                                                                        <label class="needsclick delete"
                                                                                               data-toggle="tooltip"
                                                                                               data-placement="top"
                                                                                               title="can delete">
                                                                                            <input 
                                                                                                class="<?= $sub_chld_1 . ' ' . $sub_chld . ' ' . $v_sub_chld_2 . ' ' . $parent_id; ?>"
                                                                                                type="checkbox"
                                                                                                name="deleted_<?= $v_sub_chld_2; ?>"
                                                                                                value="<?= $v_sub_chld_2; ?>">
                                                                                        <!--span class="fa fa-check"></span-->
                                                                                        </label>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <?php
                                                                        }
                                                                    }
                                                                }
                                                            } else { ?>
                                                                <tr class="child c_<?= $sub_chld; ?>">
                                                                    <td style="display: block;padding-left: 60px">
                                                                        <div class="form-group ">
                                                                            <label class="needsclick "
                                                                                   data-toggle="tooltip"
                                                                                   data-placement="top"
                                                                                   title="select">
                                                                                <input id="<?= $sub_chld_id; ?>"
                                                                                   class="<?= $parent_id . ' ' . $sub_chld; ?>"
                                                                                   type="checkbox"
                                                                                   name="menu[]"
                                                                                   value="<?= $sub_chld_id; ?>">
                                                                                <!--span class="fa fa-check"></span-->
                                                                                <strong><?php echo $sub_chld_name; ?></strong>
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group ">
                                                                            <label class="needsclick view"
                                                                                   data-toggle="tooltip"
                                                                                   data-placement="top"
                                                                                   title="view_help">
                                                                                <input class="<?= $sub_chld . ' ' . $sub_chld_id . ' ' . $parent_id; ?>"
                                                                                   type="checkbox"
                                                                                   name="view_<?= $sub_chld_id; ?>"
                                                                                   value="<?= $sub_chld_id; ?>">
                                                                                <!--span class="fa fa-check"></span-->
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group ">
                                                                            <label class="needsclick create"
                                                                                   data-toggle="tooltip"
                                                                                   data-placement="top"
                                                                                   title="can create">
                                                                                <input 
                                                                                    class="<?= $sub_chld . ' ' . $sub_chld_id . ' ' . $parent_id; ?>"
                                                                                    type="checkbox"
                                                                                    name="created_<?= $sub_chld_id; ?>"
                                                                                    value="<?= $sub_chld_id; ?>">
                                                                                <!--span class="fa fa-check"></span-->
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group">
                                                                            <label class="needsclick edit"
                                                                                   data-toggle="tooltip"
                                                                                   data-placement="top"
                                                                                   title="can edit">
                                                                                <input  
                                                                                    class="<?= $sub_chld . ' ' . $sub_chld_id . ' ' . $parent_id; ?>"
                                                                                    type="checkbox"
                                                                                    name="edited_<?= $sub_chld_id; ?>"
                                                                                    value="<?= $sub_chld_id; ?>">
                                                                                <!--span class="fa fa-check"></span-->
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group">
                                                                            <label class="needsclick delete"
                                                                                   data-toggle="tooltip"
                                                                                   data-placement="top"
                                                                                   title="can delete">
                                                                                <input
                                                                                    class="<?= $sub_chld . ' ' . $sub_chld_id . ' ' . $parent_id; ?>"
                                                                                    type="checkbox"
                                                                                    name="deleted_<?= $sub_chld_id; ?>"
                                                                                    value="<?= $sub_chld_id; ?>">
                                                                                <!--span class="fa fa-check"></span-->
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                            }
                                                        }
                                                    }
                                                } else { ?>
                                                    <tr class="child c_<?= $parent_id; ?>">
                                                        <td style="display: block;padding-left: 35px;">
                                                            <div class="form-group ">
                                                                <label class="needsclick " data-toggle="tooltip"
                                                                       data-placement="top"
                                                                       title="select">
                                                                    <input id="<?= $v_sub_child; ?>"
                                                                       class="<?= $parent_id; ?>"
                                                                       type="checkbox"
                                                                       name="menu[]" value="<?= $v_sub_child; ?>">
                                                                    <!--span class="fa fa-check"></span-->
                                                                    <strong><?php echo $child; ?></strong>
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group ">
                                                                <label class="needsclick view" data-toggle="tooltip"
                                                                       data-placement="top"
                                                                       title="view_help">
                                                                    <input  class="<?= $parent_id . ' ' . $v_sub_child; ?>"
                                                                       type="checkbox"
                                                                       name="view_<?= $v_sub_child; ?>"
                                                                       value="<?= $v_sub_child; ?>">
                                                                    <!--span class="fa fa-check"></span-->
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group ">
                                                                <label class="needsclick create" data-toggle="tooltip"
                                                                       data-placement="top"
                                                                       title="can create">
                                                                    <input   class="<?= $parent_id . ' ' . $v_sub_child; ?>"
                                                                       type="checkbox"
                                                                       name="created_<?= $v_sub_child; ?>"
                                                                       value="<?= $v_sub_child; ?>">
                                                                    <!--span class="fa fa-check"></span-->
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <label class="needsclick edit" data-toggle="tooltip"
                                                                       data-placement="top"
                                                                       title="can edit">
                                                                    <input
                                                                        class="<?= $parent_id . ' ' . $v_sub_child; ?>"
                                                                        type="checkbox"
                                                                        name="edited_<?= $v_sub_child; ?>"
                                                                        value="<?= $v_sub_child; ?>" >
                                                                    <!--span class="fa fa-check"></span-->
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <label class="needsclick delete" data-toggle="tooltip"
                                                                       data-placement="top"
                                                                       title="can delete">
                                                                    <input   class="<?= $parent_id . ' ' . $v_sub_child; ?>"
                                                                       type="checkbox"
                                                                       name="deleted_<?= $v_sub_child; ?>"
                                                                       value="<?= $v_sub_child; ?>">
                                                                    <!--span class="fa fa-check"></span-->
                                                                </label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php 
												}
                                            }
                                        } ?>

                                    <?php 
									}
                                }
                            } else { ?>
                                <tr>
                                    <td>
                                        <div class="form-group ">
                                            <label class="needsclick " data-toggle="tooltip" data-placement="top"
                                                   title="select">
                                                <input id="<?= $v_parent; ?>" type="checkbox" name="menu[]"
                                                       value="<?= $v_parent; ?>" >
                                                <!--span class="fa fa-check"></span-->
                                                <strong><?php echo $parent; ?></strong>
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group ">
                                            <label class="needsclick view" data-toggle="tooltip"
                                                   data-placement="top"
                                                   title="view_help">
                                                <input id="<?= $v_parent; ?>" 
                                                       class="<?= $v_parent; ?>" type="checkbox"
                                                       name="view_<?= $v_parent; ?>"
                                                       value="<?= $v_parent; ?>">
                                                <!--span class="fa fa-check"></span-->
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group ">
                                            <label class="needsclick create" data-toggle="tooltip"
                                                   data-placement="top"
                                                   title="can create">
                                                <input 
                                                    class="<?= $v_parent; ?>" type="checkbox"
                                                    name="created_<?= $v_parent; ?>"
                                                    value="<?= $v_parent; ?>">
                                                <!--span class="fa fa-check"></span-->
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label class="needsclick edit" data-toggle="tooltip"
                                                   data-placement="top"
                                                   title="can edit">
                                                <input  class="<?= $v_parent; ?>" type="checkbox"
                                                   name="edited_<?= $v_parent; ?>"
                                                   value="<?= $v_parent; ?>">
                                                <!--span class="fa fa-check"></span-->
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label class="needsclick delete" data-toggle="tooltip"
                                                   data-placement="top"
                                                   title="can delete">
                                                <input class="<?= $v_parent; ?>" type="checkbox"
                                                   name="deleted_<?= $v_parent; ?>"
                                                   value="<?= $v_parent; ?>">
                                                <!--span class="fa fa-check"></span-->
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                            <?php }
                        }
                    }
							?>
					</tbody>
				</table>
			</div>
				
					

                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-4 col-form-label"></label>
                            <div class="col-sm-6">
								<?php 
								if($this->session->userdata('user_type')!=1) 
								{
									if($created)
									{
										if($created!==0)
										{?>
											<input type="submit" id="add-customer" class="btn btn-primary btn-large" name="add-user" value="<?php echo display('save') ?>"  tabindex="6"/>

											<input type="submit" value="<?php echo display('save_and_add_another') ?>" name="add-user-another" class="btn btn-success" id="add-customer-another" tabindex="7">
										<?php }
									}	
								}else{?>
										<input type="submit" id="add-customer" class="btn btn-primary btn-large" name="add-user" value="<?php echo display('save') ?>"  tabindex="6"/>

										<input type="submit" value="<?php echo display('save_and_add_another') ?>" name="add-user-another" class="btn btn-success" id="add-customer-another" tabindex="7">
                            
								<?php }?>
                                </div>
                        </div>
						
                    </div>
                    <?php echo form_close() ?>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Edit user end -->



