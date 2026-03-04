<?php $this->view('top_header');
$logged_user_id = $this->session->userdata('user_id') ; $logged_user_type = $this->session->userdata('user_type') ;
?>

<style>
    .row{
        margin-top: 5px;

    }
</style>
<div class="page-content">
    <div class="container-fluid">
        <div class="breadcromb-area">
            <div class="row">
                <div class="col-md-6  col-sm-6">
                    <div class="seipkon-breadcromb-left">
                        <h3><?php echo $pagename; ?></h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8" style="padding-right: 0;">
                <div class="page-box">
                    <div class="advance-table">
                        <table id="menu_tbl" class="my_master_datatable table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th>MenuGroup</th>
                                    <th>MenuCode</th>
                                    <th>Menu Item</th>
                                    <th>ProdUnit</th>
                                    <th>Sales Rate</th>
                                    <th>Available</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                if (!empty($all_value)) {
                                    foreach ($all_value as $value) {
                                        $edit_link = site_url('Restuarent/menu_list?id=') . $value->m_menu_id;
                                ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $value->m_menugroup_name; ?></td>
                                            <td><?php echo $value->m_menu_code; ?></td>
                                            <td><?php echo $value->m_menu_name; ?></td>
                                            <td><?php echo $value->m_prodgroup_name; ?></td>
                                            <td><?php echo $value->m_menu_rate; ?></td>
                                           
                                           <td><?php echo $value->m_menu_status == 1 ? 'Yes' : 'No'; ?></td>

                                            <td title="Action" style="white-space: nowrap;">
                                                <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'RES', 'ME', 'Edit')) { ?>
                                                    <a href="<?php echo $edit_link; ?>" class="btn btn-success btn-action" title="Edit" data-toggle="tooltip"><i class="fa fa-pencil"></i></a>
                                                <?php }
                                                if ($logged_user_type == 1 || has_perm($logged_user_id, 'RES', 'ME', 'Delete')) { ?>
                                                    <button class="btn btn-danger btn-action delete-menu" data-value="<?php echo $value->m_menu_id; ?>" title="Delete" data-toggle="tooltip"><i class="fa fa-trash"></i></button>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                <?php
                                        $i++;
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'RES', 'ME', 'Add')) { ?>
                <div class="col-md-4">
                    <div class="page-box">
                        <h3 style="margin-bottom: 10px;"><?php if (!empty($id)) {
                                                                echo 'Edit Value';
                                                            } else {
                                                                echo 'Add New';
                                                            } ?></h3>
                        <div class="form-example">
                            <div class="form-wrap top-label-exapmple form-layout-page">
                                <form method="post" action="#" id="frm-add-menu">

                                    <?php if (!empty($edit_value)) {
                                        $id = $edit_value->m_menu_id;
                                        $group = $edit_value->m_menu_group;
                                        $code = $edit_value->m_menu_code;
                                        $name = $edit_value->m_menu_name;
                                        $produnit = $edit_value->m_menu_produnit;
                                        $rate = $edit_value->m_menu_rate;
                                        // $stock = $edit_value->m_menu_stock;
                                        // $bomqty = $edit_value->m_menu_bomqty;
                                        $status = $edit_value->m_menu_status;
                                    } else {
                                        $id = '';
                                        $group = '';
                                        $code = '';
                                        $name = '';
                                        $produnit = '';
                                        $rate = '';
                                        // $stock = 1;
                                        // $bomqty = '';
                                        $status = 1;
                                    } ?>

                                    <div class="row">
                                        <div class="form-group">
                                        <div class="col-md-5">
                                                <label>Group Name<span class="text-danger">*</span></label>
                                        </div><div class="col-md-7">
                                                <select name="m_menu_group" id="m_menu_group" class="form-control select2" required>
                                                    <option value="">Select Group Name</option>
                                                    <?php
                                                    if (!empty($menugroup_dtl)) {
                                                        foreach ($menugroup_dtl as $pkey) {
                                                    ?>
                                                            <option value="<?php echo $pkey->m_menugroup_id; ?>" <?php if ($group == $pkey->m_menugroup_id) echo 'selected'; ?>><?php echo $pkey->m_menugroup_name; ?></option>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group">
                                        <div class="col-md-5">
                                                <label>Menu Code </label>
                                                </div><div class="col-md-7">
                                                <input type="text" name="m_menu_code" id="m_menu_code" class="form-control" placeholder="Enter Menu Code" value="<?= $code ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group">
                                        <div class="col-md-5">
                                                <label>Item Name<span class="text-danger">*</span></label>
                                                </div><div class="col-md-7">
                                                <input type="hidden" name="m_menu_id" id="m_menu_id" value="<?= $id ?>">
                                                <input type="text" name="m_menu_name" id="m_menu_name" class="form-control" placeholder="Enter menu name" required="" value="<?= $name ?>">
                                            </div>
                                        </div>
                                    </div>

                                    
                                    <div class="row">
                                        <div class="form-group">
                                        <div class="col-md-5">
                                                <label>ProdUnit<span class="text-danger">*</span></label>
                                                </div><div class="col-md-7">
                                                <select name="m_menu_produnit" id="m_menu_produnit" class="form-control select2" required>
                                                    <option value="">Select Unit</option>
                                                    <?php
                                                    if (!empty($produnit_dtl)) {
                                                        foreach ($produnit_dtl as $pkey) {
                                                    ?>
                                                            <option value="<?php echo $pkey->m_prodgroup_id; ?>" <?php if ($produnit == $pkey->m_prodgroup_id) echo 'selected'; ?>><?php echo $pkey->m_prodgroup_name; ?></option>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group">
                                        <div class="col-md-5">
                                                <label>Sales Rate </label>
                                                </div><div class="col-md-7">
                                                <input type="number" name="m_menu_rate" id="m_menu_rate" class="form-control" placeholder="Enter rate " value="<?= $rate ?>">
                                            </div>
                                        </div>
                                    </div>

                                    
                                    
                                    <!-- <div class="row">
                                        <div class="form-group">
                                        <div class="col-md-5">
                                                <label>Check Stock</label>
                                                </div><div class="col-md-7">
                                                <select name="m_menu_stock" id="m_menu_stock" class="form-control">
                                                    <option value="1" <?php if ($stock == 1) echo 'selected' ?>>Yes</option>
                                                    <option value="2" <?php if ($stock == 2) echo 'selected' ?>>No</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div> -->
                                    
                                    <!-- <div class="row">
                                        <div class="form-group">
                                        <div class="col-md-5">
                                                <label>BOM MASTER Qty </label>
                                                </div><div class="col-md-7">
                                                <input type="number" name="m_menu_bomqty" id="m_menu_bomqty" class="form-control" placeholder="Enter bomqty " value="<?= $bomqty ?>">
                                            </div>
                                        </div>
                                    </div> -->
                                    <div class="row">
                                        <div class="form-group">
                                        <div class="col-md-5">
                                                <label>Available</label>
                                                </div><div class="col-md-7">
                                                <select name="m_menu_status" id="m_menu_status" class="form-control" title="Select Status">
                                                    <option value="1" <?php if ($status == 1) echo 'selected' ?>>Yes</option>
                                                    <option value="0" <?php if ($status == 0) echo 'selected' ?>>No</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-layout-submit">
                                                <button type="submit" id="btn-add-menu" class="btn btn-block btn-info">Submit</button>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-layout-submit">
                                                <a href="<?php echo site_url('Restuarent/menu_list') ?>" class="btn btn-block btn-danger">Cancel </a>

                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
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
<?php $this->view('js/restuarent_js') ?>
<?php $this->view('js/custom_js'); ?>
<!-- ========================Script========================== -->