<!-- =========================View==============Fix========== -->
<!-- ========================Header==============Fix========= -->
<?php $this->view('top_header') ?>
<!-- =======================/Header==============Fix========= -->
<!-- =========================View===============Fix========= -->
<!-- Right Side Content Start -->
<div class="page-content">
    <div class="container-fluid">
        <!-- ========================/View===============Fix========= -->
        <!-- ======================Page Title======================== -->
        <!-- Breadcromb Row Start -->
        <div class="row">
            <div class="col-md-12">
                <div class="breadcromb-area">
                    <div class="row">
                        <div class="col-md-8  col-sm-8">
                            <div class="seipkon-breadcromb-left">
                                <h3><?php echo $pagename; ?> for <?= $user_dtl->m_admin_name?></h3>
                            </div>
                        </div>
                        <div class="col-md-4">
                    <div class="seipkon-breadcromb-right">
                    <a href="<?php echo site_url('Setup/users_list') ?>" class="btn btn-info btn-vsm"><i class="fa fa-arrow-left" aria-hidden="true"></i>Back</a>
                    
                    <!-- <button onclick="history.back()" class="btn btn-info btn-vsm"><i class="fa fa-arrow-left" aria-hidden="true"></i>Back</button> -->
                    </div>
                </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="page-box">
                    <div class="advance-table">
                        <form action="" id="frm-userpermission" method="post">
                            <table id="custom_tbl" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sn.</th>
                                        <th>Module</th>
                                        <th>Sub Module</th>
                                        <th>List</th>
                                        <th>Add</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                        <th>Export</th>
                                        <th>Filter</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    if (!empty($all_value)) {
                                        $j = 0;
                                       
                                        foreach ($all_value as $i => $value) {
                                            if(!empty($edit_value && $j< count($edit_value))){
                                               
                                                if($edit_value[$j]->m_userperm_permId == $value->m_perm_id){
                                                    $userpermId = $edit_value[$j]->m_userperm_id;
                                                    
                                                    if($edit_value[$j]->m_userperm_list == 1){
                                                        $perm_list = 'checked';
                                                    }else {$perm_list = ''; }
                                                    if($edit_value[$j]->m_userperm_add == 1){
                                                        $perm_add = 'checked';
                                                    }else {$perm_add = ''; }
                                                    if($edit_value[$j]->m_userperm_edit == 1){
                                                        $perm_edit = 'checked';
                                                    }else {$perm_edit = ''; }
                                                    if($edit_value[$j]->m_userperm_delete == 1){
                                                        $perm_delete = 'checked';
                                                    }else {$perm_delete = ''; }
                                                    if($edit_value[$j]->m_userperm_export == 1){
                                                        $perm_export = 'checked';
                                                    }else {$perm_export = ''; }
                                                    if($edit_value[$j]->m_userperm_filter == 1){
                                                        $perm_filter = 'checked';
                                                    }else {$perm_filter = ''; }
                                                   
                                                    $j++ ;
                                                }else {
                                                    $perm_list = '';
                                                    $perm_add = '';
                                                    $perm_edit = '';
                                                    $perm_delete = '';
                                                    $perm_export = '';
                                                    $perm_filter = '';
                                                    $userpermId = '';
                                                }
                                            }else {
                                                $perm_list = '';
                                                $perm_add = '';
                                                $perm_edit = '';
                                                $perm_delete = '';
                                                $perm_export = '';
                                                $perm_filter = '';
                                                $userpermId = '';
                                            }
                                    ?>
                                            <tr>
                                                <td><?php echo $i + 1; ?></td>
                                                <td><?= $value->m_perm_module; ?></td>
                                                <td><?= $value->m_perm_name; ?></td>
                                                <td><input type="checkbox" class="checkedclick" <?= $perm_list?> data-permid="<?= $value->m_perm_id; ?>" data-module="<?= $value->m_perm_module_slug; ?>" data-submodule="<?= $value->m_perm_submodule_slug; ?>" data-userpermid="<?= $userpermId ?>" data-userid="<?= $userid?>" data-name="m_userperm_list" ></td>
                                                <td><input type="checkbox" class="checkedclick" <?= $perm_add?> data-permid="<?= $value->m_perm_id; ?>" data-module="<?= $value->m_perm_module_slug; ?>" data-submodule="<?= $value->m_perm_submodule_slug; ?>" data-userpermid="<?= $userpermId ?>" data-userid="<?= $userid?>" data-name="m_userperm_add" ></td>
                                                <td><input type="checkbox" class="checkedclick" <?= $perm_edit?> data-permid="<?= $value->m_perm_id; ?>" data-module="<?= $value->m_perm_module_slug; ?>" data-submodule="<?= $value->m_perm_submodule_slug; ?>" data-userpermid="<?= $userpermId ?>" data-userid="<?= $userid?>" data-name="m_userperm_edit" ></td>
                                                <td><input type="checkbox" class="checkedclick" <?= $perm_delete?> data-permid="<?= $value->m_perm_id; ?>" data-module="<?= $value->m_perm_module_slug; ?>" data-submodule="<?= $value->m_perm_submodule_slug; ?>" data-userpermid="<?= $userpermId ?>" data-userid="<?= $userid?>" data-name="m_userperm_delete" ></td>
                                                <td><input type="checkbox" class="checkedclick" <?= $perm_export?> data-permid="<?= $value->m_perm_id; ?>" data-module="<?= $value->m_perm_module_slug; ?>" data-submodule="<?= $value->m_perm_submodule_slug; ?>" data-userpermid="<?= $userpermId ?>" data-userid="<?= $userid?>" data-name="m_userperm_export" ></td>
                                                <td><input type="checkbox" class="checkedclick" <?= $perm_filter?> data-permid="<?= $value->m_perm_id; ?>" data-module="<?= $value->m_perm_module_slug; ?>" data-submodule="<?= $value->m_perm_submodule_slug; ?>" data-userpermid="<?= $userpermId ?>" data-userid="<?= $userid?>" data-name="m_userperm_filter" ></td>

                                            </tr>
                                    <?php }
                                    } ?>
                                </tbody>
                            </table>

                            <!-- <div class="row">
                                <div class="col-md-6"></div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-layout-submit">
                                                <button type="submit" id="btn-userpermission" class="btn btn-block btn-info">Submit</button>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-layout-submit">
                                                <a href="<?php echo base_url('Master/userperm_list?id=') . $userid; ?>" class="btn btn-block btn-danger">Reset </a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <!-- End Advance Form Row -->
        <!-- ====================/Page Content======================= -->
        <!-- =========================View=================Fix======= -->
        <!-- End Widget Row -->
    </div>
</div>
<!-- ========================/View=================Fix======= -->
<!-- ========================Footer================Fix======= -->
<?php $this->view('top_footer') ?>
<?php $this->view('js/js_master') ?>
<?php $this->view('js/custom_js'); ?>
<!-- ========================Script========================== -->