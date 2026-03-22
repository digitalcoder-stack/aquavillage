<?php $this->view('top_header'); 
  $logged_user_id = $this->session->userdata('user_id') ; $logged_user_type = $this->session->userdata('user_type') ;
?>
<div class="page-content">
    <div class="container-fluid">

        <style type="text/css">
            .d-flex {
                display: flex;
                align-items: center;
            }

            .jbfrm input[type=radio] {
                width: 27px;
                height: 17px;
                margin: 0px;
                background: none;
                box-shadow: none;
                transition: 0.5s;
            }

            .space-around {
                justify-content: space-around;
            }

            .space-around input[type=checkbox] {
                margin: 0px 0px 0px;
                transition: 0.5s;
                width: 20px;
                height: 18px;
            }

            .space-around input[type=checkbox]:focus {
                outline: none !important;
                transform: scale(1.2);
            }

            .jbfrm input[type=radio]:focus {
                outline: none !important;
                transform: scale(1.2);
            }
        </style>
        <div class="breadcromb-area">
            <div class="row">
                <div class="col-lg-2">
                    <div class="seipkon-breadcromb-left">
                        <h3><?php echo $pagename; ?></h3>
                    </div>
                </div>
                <div class="col-lg-8">
                <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'Setup', 'Cust', 'Filter')) { ?>
                    <form method="post" action="<?php echo site_url('Setup/customer_list') ?>">
                        <div class="row">
                            <div class="col-md-3">
                                <label class="form-check-label">From Date</label>
                                <input class="form-check-input date_form " type="date" placeholder="From Date" name="from_date" id="m_from_date" value="<?php echo $from_date; ?>">
                            </div>
                            <div class="col-md-3">
                                <label class="form-check-label">To Date</label>
                                <input class="form-check-input date_form " type="date" placeholder="To Date" name="to_date" id="m_from_date" value="<?php echo $to_date; ?>">
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <button class="btn btn-info" type="submit">Search</button>
                                    <a href="<?php echo site_url('Setup/customer_list') ?>"><button class="btn btn-primary" type="button">Reset</button></a>
                                    <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'Setup', 'Cust', 'Export')) { ?>
                                    <button class="btn btn-success" type="submit" name="Excel" value="2">Excel Export</button>
                                    <?php }?>
                                </div>
                            </div>

                        </div>
                    </form>
                    <?php }?>
                </div>
                <div class="col-lg-2 pull-right">
                    <div class="seipkon-breadcromb-right">
                    <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'Setup', 'Cust', 'Add')) { ?>
                        <a href="<?php echo site_url('Setup/add_customer') ?>" class="btn btn-info btn-vsm"><i class="fa fa-plus-circle"></i> Add New Customer</a>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-box">
            <!-- Loader -->
            <div id="customer_loader" style="display: none; text-align: center; padding: 30px 0;">
                <div class="spinner-border text-primary" style="width: 2.5rem; height: 2.5rem; border-width: 4px;" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>

            <div class="advance-table table-responsive">
                <table id="user_tbl" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Mobile No.</th>
                            <th>Email</th>
                            <!-- <th>Gender</th> -->
                            <th>Registration Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="customer_tbody">
                        <!-- AJAX content will be loaded here -->
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination Controls -->
            <div id="customer_pagination" style="display: flex; flex-wrap: wrap; gap: 4px; justify-content: center; align-items: center; margin-top: 15px;">
                <!-- Pagination buttons will be loaded here -->
            </div>
        </div>
    </div>
</div>
<script>
    const CUSTOMER_INIT = {
        from_date: "<?php echo isset($from_date) ? $from_date : ''; ?>",
        to_date: "<?php echo isset($to_date) ? $to_date : ''; ?>"
    };
</script>
<?php $this->view('top_footer');
$this->view('js/customer_js');
$this->view('js/custom_js'); ?>