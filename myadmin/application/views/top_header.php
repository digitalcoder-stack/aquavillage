<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php $hp_name = get_settings('m_app_name');
    $hp_title = get_settings('m_app_title');
    $logged_user_id = $this->session->userdata('user_id');
    $logged_user_type = $this->session->userdata('user_type');

    ?>
    <meta name="description" content="<?php echo $hp_title; ?>" />
    <meta name="keywords" content="<?php echo $hp_title; ?>" />
    <meta name="author" content="<?php echo $hp_title; ?>">

    <!-- Title -->
    <title><?php echo (!empty($pagename)) ? $hp_title . " | " . $pagename : $hp_title; ?></title>

    <!-- font awsm -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Favicon -->
    <?php
    $img_title = get_settings('m_app_icon');
    if (!empty($img_title)) {
        if (file_exists('uploads/' . $img_title)) {
            $fav_img = base_url('uploads/') . $img_title;
        } else {

            $fav_img  = base_url('assets/img/blank.jpg');
        }
    } else {
        $fav_img  = base_url('assets/img/blank.jpg');
    }
    ?>
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $fav_img; ?>">

    <!-- theme css -->
    <?php
    echo link_tag('assets/css/animate.min.css');
    echo link_tag('assets/plugins/bootstrap/bootstrap.min.css');
    echo link_tag('assets/plugins/font-awesome/font-awesome.min.css');
    echo link_tag('assets/plugins/themify-icons/themify-icons.css');
    echo link_tag('assets/plugins/perfect-scrollbar/perfect-scrollbar.min.css');
    echo link_tag('assets/plugins/sweet-alerts/css/sweetalert.css');
    echo link_tag('assets/plugins/daterangepicker/css/daterangepicker.css');

    // Select2 CSS 
    echo link_tag('assets/plugins/select2/css/select2.min.css');
    echo link_tag('assets/plugins/jquery-toggle/css/toggles-full.css');
    echo link_tag('assets/css/seipkon.css');
    echo link_tag('assets/css/responsive.css');
    echo link_tag('assets/plugins/datatables/css/dataTables.bootstrap.min.css');
    echo link_tag('assets/plugins/datatables/css/buttons.bootstrap.min.css');
    echo link_tag('assets/plugins/datatables/css/responsive.bootstrap.min.css');
    echo link_tag('assets/plugins/bootstrap-select/css/bootstrap-select.min.css');
    echo link_tag('assets/plugins/summernote/css/summernote.css');
    ?>
    <style type="text/css">
        a.btn:hover {
            outline: 1px solid white;
        }

        a.btn:active {
            outline: 1px;
        }

        .btn {
            padding: 5px 8px;
            line-height: 20px;
            border-radius: 5px;
        }

        button.btn-action {
            padding: 3px 0px 3px 5px;
            text-align: center;
            font-size: 20px;
        }

        a.btn-action {
            padding: 3px 5px 3px 5px;
            text-align: center;
            font-size: 14px !important;
        }

        button.btn-action {
            font-size: 14px !important;
        }

        .menu-section li {
            box-shadow: inset 0 0 5px #d9d9d9;
            outline: 1px solid white;
        }

        .menu-section li.active {
            box-shadow: inset 0 0 3px #018080;
        }

        #sidebarCollapse {
            color: white !important;
            border: 2px solid white !important;
        }

        .table tr:hover {
            box-shadow: 0px 0px 5px grey;
        }

        .text-danger {
            color: red;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: #fe05e0;
            border-bottom-width: 2px;
            box-shadow: 0 0 2px #444af0;
        }

        .select2-container--open .select2-selection {
            border-color: #fe05e0;
            border-bottom-width: 2px;
            box-shadow: 0 0 2px #444af0;
        }

        label {
            margin-bottom: 1px;
        }

        .breadcromb-area {
            background: #ffffff;
            padding: 12px;
            border: 0;
            box-shadow: none;
            border-radius: 4px;
        }

        #content>.page-content {
            min-height: 100vh;
            padding: 12px 10px;
        }

        .page-box {
            margin-top: 10px;
            padding: 9px 6px;
        }

        ul.collapse.in {
            border-bottom: 3px dotted white;
        }

        .dt-buttons {
            margin-left: 2%;
        }

        .icon_input .input-icon {
            right: 7%;
            position: absolute;
            top: 49%;
        }

        .icon_input .icon-input {
            padding-right: 14% !important;
        }

        .btn-vsm {
            line-height: 15px;
        }
    </style>
</head>



<body>
    <!-- Wrapper Start -->
    <div class="wrapper">
        <!-- Main Header Start -->
        <header class="main-header">
            <nav class="navbar navbar-default">
                <div class="container-fluid ver-nav">
                    <div class="header-top-section">
                        <!-- Brand -->
                        <div class="pull-left">
                            <button type="button" id="sidebarCollapse" class=" navbar-btn">
                                <i class="fa fa-bars"></i>
                            </button>
                            <div class="header-top-search">
                                <h3 style="color: white"><?php echo $hp_name; ?></h3>
                            </div>
                        </div>

                        <!-- profile -->
                        <div class="header-top-right-section pull-right">
                            <ul class="nav nav-pills nav-top navbar-right">
                                <li class="dropdown">
                                    <a class="dropdown-toggle profile-toggle" href="index.html#" data-toggle="dropdown">
                                        <?php
                                        $user_img = base_url('assets/img/icons/default-user0.png');
                                        if (!empty($log_user_dtl[0]->m_admin_img)) {
                                            if (file_exists('uploads/' . $log_user_dtl[0]->m_admin_img)) {
                                                $user_img = base_url('uploads/') . $log_user_dtl[0]->m_admin_img;
                                            }
                                        }
                                        ?>
                                        <img src="<?php echo $user_img; ?>" class="profile-avator" alt="admin profile" style="border: 1px solid #f7e7e740; border-radius: 50%;" />
                                        <div class="profile-avatar-txt">
                                            <p><?php echo $log_user_dtl[0]->m_admin_name; ?></p>
                                            <i class="fa fa-angle-down"></i>
                                        </div>
                                    </a>
                                    <div class="profile-box dropdown-menu animated bounceIn">
                                        <ul>
                                            <li><a href="<?php echo site_url('Profile'); ?>"><i class="fa fa-user"></i>
                                                    view profile</a></li>
                                            <li><a href="<?php echo site_url('Logout'); ?>"><i class="fa fa-power-off"></i> sign out</a></li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- btm strip -->
                <style>
                    .ver-nav {
                        display: none !important;
                    }

                    #content {
                        width: 100%;
                    }

                    a.nav-top-btn {
                        padding: 7px 5px;
                        background: whitesmoke;
                        display: inline-block;
                        border-radius: 10px 10px 0 0;
                        font-weight: 500;
                        letter-spacing: 0.5px;
                        font-size: 13px;
                        margin: 0 1px;
                        color: gray;
                        position: relative;
                        top: 3px;
                    }

                    a.nav-top-btn.active {
                        background: white;
                        color: black;
                    }

                    a.nav-top-btn:hover {
                        color: black;
                    }

                    .navlink-container {
                        background-color: white;
                        margin-bottom: 5px;
                        border-radius: 0.5rem;
                        padding: 0.5rem 2rem 0rem 1rem;
                    }



                    .advance-table.table-overflow {
                        overflow-x: hidden;
                    }

                    .advance-table.table-overflow table {
                        max-width: 100% !important;
                    }

                    th,
                    td {
                        padding: 5px !important;
                    }

                    .subnavdiv {
                        display: none;
                    }

                    @media(max-width:1100px) {
                        .hori-nav {
                            display: none;
                        }

                        .ver-nav {
                            display: block !important;
                        }

                        /* #content {
                     width: calc(100% - 235px);
                  } */

                        .advance-table.table-overflow {
                            overflow-x: scroll;
                        }

                        .advance-table.table-overflow table {
                            max-width: none !important;
                        }
                    }

                    .new-nav-container {
                        background: white;
                        padding: 7px;
                        border-radius: 5px;
                        -webkit-border-radius: 5px;
                        -moz-border-radius: 5px;
                        -ms-border-radius: 5px;
                        -o-border-radius: 5px;
                        display: flex;
                        gap: 10px;
                        justify-content: flex-start;
                        align-items: center;
                    }

                    .new-nav-cat {
                        display: inline-flex;
                        align-items: stretch;
                        justify-content: flex-start;
                        gap: 5px;
                        height: 100%;
                    }

                    .new-nav-link {
                        display: flex;
                        flex-direction: column;
                        align-items: center;
                        justify-content: center;
                        width: 60px;
                        height: 60px;
                        border-radius: 5px;
                        background-color: #f6f6f6b5;
                        padding: 5px;
                    }

                    .new-nav-link:hover,
                    .new-nav-link.active {
                        background-color: #ffefb0;
                    }

                    .new-nav-link img {
                        aspect-ratio: 1/1;
                        object-fit: cover;
                        width: 50%;
                    }

                    .new-nav-link span {
                        font-size: 1rem;
                        line-height: 1.1rem;
                        display: block;
                        margin: 0;
                        margin-top: 5px;
                        text-align: center;
                        min-height: 2.2rem;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        letter-spacing: 0.1px;
                    }

                    .line {
                        height: 50px;
                        border: 1px dashed gray;
                        width: 1px;
                    }

                    .select2-container .select2-selection--single .select2-selection__rendered {
                        white-space: normal !important;
                    }

                    .select2-container--default .select2-selection--single {
                        overflow: hidden !important;
                    }
                </style>
                <section style="padding-top: 10px;padding-bottom:5px;background:#d1f0ff;" class="hori-nav">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-2 text-center">
                                <img src="<?php echo base_url('assets/img/main-logo.png'); ?>" alt="" style="height: 40px;">&nbsp;&nbsp;&nbsp;<span style="font-size: 2.1rem;font-weight: bold;position: relative;top: 2px;"><?php echo $hp_name; ?></span>
                            </div>
                            <div class="col-sm-9 text-center">
                                <a class="nav-top-btn <?php if ($this->uri->segment(1) == 'Welcome') {
                                                            echo 'active';
                                                        } ?>" href="<?php echo site_url('Welcome') ?>" id="dasboard"><i class="fa-solid fa-gauge"></i> Dashboard</a>
                                <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'WP')) { ?>
                                    <a class="nav-top-btn <?php if ($this->uri->segment(1) == 'Shop') {
                                                                echo 'active';
                                                            } ?> headnavbtn" data-id="Shop"><i class="fa-solid fa-umbrella-beach"></i> Water Park</a>
                                <?php }
                                if ($logged_user_type == 1 || has_perm($logged_user_id, 'VCH')) { ?>
                                    <a class="nav-top-btn <?php if ($this->uri->segment(1) == 'Vouchers') {
                                                                echo 'active';
                                                            } ?> headnavbtn" data-id="Vouchers"><i class="fa-solid fa-umbrella-beach"></i> Vouchers</a>

                                <?php }
                                if ($logged_user_type == 1 || has_perm($logged_user_id, 'INVT')) { ?>
                                    <a class="nav-top-btn <?php if ($this->uri->segment(1) == 'Inventory') {
                                                                echo 'active';
                                                            } ?> headnavbtn" data-id="Inventory"><i class="fas fa-boxes"></i> Inventory</a>
                                <?php }
                                if ($logged_user_type == 1 || has_perm($logged_user_id, 'INVT')) { ?>
                                    <a class="nav-top-btn <?php if ($this->uri->segment(1) == 'Reports') {
                                                                echo 'active';
                                                            } ?> headnavbtn" data-id="Reports"><i class="fas fa-boxes"></i> Reports</a>

                                <?php }
                                if ($logged_user_type == 1 || has_perm($logged_user_id, 'RES')) { ?>
                                    <a class="nav-top-btn <?php if ($this->uri->segment(1) == 'Restuarent') {
                                                                echo 'active';
                                                            } ?> headnavbtn" data-id="Restuarent"><i class="fas fa-utensils"></i> Restuarent</a>
                                <?php }
                                if ($logged_user_type == 1 || has_perm($logged_user_id, 'HR')) { ?>
                                    <a class="nav-top-btn <?php if ($this->uri->segment(1) == 'HrDept') {
                                                                echo 'active';
                                                            } ?> headnavbtn" data-id="HrDept"><i class="fa-solid fa-user"></i> Hr</a>
                                <?php }
                                if ($logged_user_type == 1 || has_perm($logged_user_id, 'MKT')) { ?>
                                    <a class="nav-top-btn <?php if ($this->uri->segment(1) == 'Marketing') {
                                                                echo 'active';
                                                            } ?> headnavbtn" data-id="Marketing"><i class="fas fa-mail-bulk"></i> Marketing</a>
                                <?php }
                                if ($logged_user_type == 1 || has_perm($logged_user_id, 'Setup')) { ?>
                                    <a class="nav-top-btn <?php if ($this->uri->segment(1) == 'Setup') {
                                                                echo 'active';
                                                            } ?> headnavbtn" data-id="Setup"><i class="fas fa-tools"></i> Setup</a>
                                <?php }
                                if ($logged_user_type == 1 || has_perm($logged_user_id, 'Mtr')) { ?>
                                    <a class="nav-top-btn <?php if ($this->uri->segment(1) == 'Master') {
                                                                echo 'active';
                                                            } ?> headnavbtn" data-id="Master"><i class="fa-solid fa-database"></i> Master</a>
                                <?php } ?>
                                <a class="nav-top-btn <?php if ($this->uri->segment(1) == 'Profile') {
                                                            echo 'active';
                                                        } ?> headnavbtn" data-id="Profile"><i class="fa-solid fa-gears"></i> Setting</a>
                            </div>
                            <div class="col-sm-1 text-right">
                                <a href="<?php echo site_url('Logout'); ?>" class="btn btn-danger">
                                    <i class="fa-solid fa-power-off"></i> Log out
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Shop Navigation-->

                    <div class="container-fluid subnavdiv" id="Shop">
                        <div class="new-nav-container">
                            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'WP', 'TC')) { ?>
                                <div class="new-nav-cat">
                                    <a href="<?php echo site_url('Shop') ?>" class="new-nav-link <?php if ($this->uri->segment(1) == 'Shop' && $this->uri->segment(2) == '') {
                                                                                                        echo 'active';
                                                                                                    } ?>">
                                        <img src="<?php echo base_url('assets/img/icons/ticket.png') ?>">
                                        <span>Ticket List</span>
                                    </a>
                                    <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'WP', 'TC', 'Add')) { ?>
                                        <a href="<?= site_url('Shop/add_ticket') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'add_ticket') {
                                                                                                                echo 'active';
                                                                                                            } ?>">
                                            <img src="<?php echo base_url('assets/img/icons/ticket.png') ?>">
                                            <span>Add Ticket</span>
                                        </a>
                                    <?php } ?>
                                </div>
                                <div class="line"></div>
                            <?php }
                            if ($logged_user_type == 1 || has_perm($logged_user_id, 'WP', 'LC')) { ?>
                                <div class="new-nav-cat">
                                    <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'WP', 'LC', 'Add')) { ?>
                                        <a href="<?php echo site_url('Shop/locker_list') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'locker_list' && $this->uri->segment(3) != '2') {
                                                                                                                        echo 'active';
                                                                                                                    } ?>">
                                            <img src="<?php echo base_url('assets/img/icons/locker.png') ?>">
                                            <span>Add Locker</span>
                                        </a>
                                    <?php } ?>
                                    <a href="<?php echo site_url('Shop/locker_list/2') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'locker_list' && $this->uri->segment(3) == '2') {
                                                                                                                    echo 'active';
                                                                                                                } ?>">
                                        <img src="<?php echo base_url('assets/img/icons/locker.png') ?>">
                                        <span>Locker List</span>
                                    </a>
                                </div>
                                <div class="line"></div>
                            <?php }
                            if ($logged_user_type == 1 || has_perm($logged_user_id, 'WP', 'CS')) { ?>
                                <div class="new-nav-cat">
                                    <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'WP', 'CS', 'Add')) { ?>
                                        <a href="<?php echo site_url('Shop/costume_list') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'costume_list' && $this->uri->segment(3) != '2') {
                                                                                                                        echo 'active';
                                                                                                                    } ?>">
                                            <img src="<?php echo base_url('assets/img/icons/costume.png') ?>">
                                            <span>Add Costume</span>
                                        </a>
                                    <?php } ?>
                                    <a href="<?php echo site_url('Shop/costume_list/2') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'costume_list' && $this->uri->segment(3) == '2') {
                                                                                                                    echo 'active';
                                                                                                                } ?>">
                                        <img src="<?php echo base_url('assets/img/icons/costume.png') ?>">
                                        <span>Costume List</span>
                                    </a>

                                </div>
                                <div class="line"></div>
                            <?php }
                            if ($logged_user_type == 1 || has_perm($logged_user_id, 'WP', 'SL')) { ?>
                                <div class="new-nav-cat">
                                    <a href="<?php echo site_url('Shop/sales_list') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'sales_list') {
                                                                                                                echo 'active';
                                                                                                            } ?>">
                                        <img src="<?php echo base_url('assets/img/icons/sales.png') ?>">
                                        <span>Sales List</span>
                                    </a>
                                    <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'WP', 'SL', 'Add')) { ?>
                                        <a href="<?php echo site_url('Shop/add_sales') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'add_sales') {
                                                                                                                    echo 'active';
                                                                                                                } ?>">
                                            <img src="<?php echo base_url('assets/img/icons/sales.png') ?>">
                                            <span>Add Sale</span>
                                        </a>
                                    <?php } ?>
                                </div>
                                <div class="line"></div>
                            <?php }
                            if ($logged_user_type == 1 || has_perm($logged_user_id, 'WP', 'PL')) { ?>
                                <div class="new-nav-cat">
                                    <a href="<?php echo site_url('Shop/plot_list') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'plot_list') {
                                                                                                                echo 'active';
                                                                                                            } ?>">
                                        <img src="<?php echo base_url('assets/img/icons/land.png') ?>">
                                        <span>Plot List</span>
                                    </a>
                                </div>
                                <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'WP', 'PL', 'Add')) { ?>
                                    <div class="new-nav-cat">
                                        <a href="<?php echo site_url('Shop/add_plot') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'add_plot') {
                                                                                                                    echo 'active';
                                                                                                                } ?>">
                                            <img src="<?php echo base_url('assets/img/icons/land.png') ?>">
                                            <span>Add Plot</span>
                                        </a>
                                    </div>

                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>


                    <!-- Vouchers Navigation-->

                    <div class="container-fluid subnavdiv" id="Vouchers">
                        <div class="new-nav-container">
                            <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'VCH', 'EXP')) { ?>
                                <div class="new-nav-cat">
                                    <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'VCH', 'Expcat')) { ?>
                                        <a href="<?php echo site_url('Vouchers/expense_cat_list') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'expense_cat_list') {
                                                                                                                                echo 'active';
                                                                                                                            } ?>">
                                            <img src="<?php echo base_url('assets/img/icons/categories.png') ?>">
                                            <span>Expense Category</span>
                                        </a>
                                    <?php } ?>

                                    <a href="<?php echo site_url('Vouchers/expense_list') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'expense_list') {
                                                                                                                        echo 'active';
                                                                                                                    } ?>">
                                        <img src="<?php echo base_url('assets/img/icons/expence.png') ?>">
                                        <span>Expense List</span>
                                    </a>
                                    <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'VCH', 'EXP', 'Add')) { ?>
                                        <a href="<?php echo site_url('Vouchers/add_expense') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'add_expense') {
                                                                                                                            echo 'active';
                                                                                                                        } ?>">
                                            <img src="<?php echo base_url('assets/img/icons/expence.png') ?>">
                                            <span>Add Expense</span>
                                        </a>
                                    <?php } ?>
                                </div>
                                <div class="line"></div>
                            <?php }
                            if ($logged_user_type == 1 || has_perm($logged_user_id, 'VCH', 'JNL')) { ?>
                                <div class="new-nav-cat">
                                    <a href="<?php echo site_url('Vouchers/journal_list') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'journal_list') {
                                                                                                                        echo 'active';
                                                                                                                    } ?>">
                                        <img src="<?php echo base_url('assets/img/icons/vourcher.png') ?>">
                                        <span>Vourcher</span>
                                    </a>
                                    <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'VCH', 'JNL', 'Add')) { ?>
                                        <a href="<?php echo site_url('Vouchers/add_journal') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'add_journal') {
                                                                                                                            echo 'active';
                                                                                                                        } ?>">
                                            <img src="<?php echo base_url('assets/img/icons/vourcher.png') ?>">
                                            <span>Add Vourcher</span>
                                        </a>
                                    <?php } ?>
                                </div>
                                <div class="line"></div>
                            <?php }
                            if ($logged_user_type == 1 || has_perm($logged_user_id, 'VCH', 'PMT')) { ?>
                                <div class="new-nav-cat">
                                    <a href="<?php echo site_url('Vouchers/payment_list') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'payment_list') {
                                                                                                                        echo 'active';
                                                                                                                    } ?>">
                                        <img src="<?php echo base_url('assets/img/icons/money.png') ?>">
                                        <span>Payment List</span>
                                    </a>
                                    <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'VCH', 'PMT', 'Add')) { ?>
                                        <a href="<?php echo site_url('Vouchers/add_payment') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'add_payment') {
                                                                                                                            echo 'active';
                                                                                                                        } ?>">
                                            <img src="<?php echo base_url('assets/img/icons/money.png') ?>">
                                            <span>Add Payment</span>
                                        </a>
                                    <?php } ?>
                                </div>
                                <div class="line"></div>
                            <?php }
                            if ($logged_user_type == 1 || has_perm($logged_user_id, 'VCH', 'RPT')) { ?>
                                <div class="new-nav-cat">
                                    <a href="<?php echo site_url('Vouchers/receipt_list') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'receipt_list') {
                                                                                                                        echo 'active';
                                                                                                                    } ?>">
                                        <img src="<?php echo base_url('assets/img/icons/receipt.png') ?>">
                                        <span>Receipt List</span>
                                    </a>
                                    <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'VCH', 'RPT', 'Add')) { ?>
                                        <a href="<?php echo site_url('Vouchers/add_receipt') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'add_receipt') {
                                                                                                                            echo 'active';
                                                                                                                        } ?>">
                                            <img src="<?php echo base_url('assets/img/icons/receipt.png') ?>">
                                            <span>Add Receipt</span>
                                        </a>
                                    <?php } ?>
                                </div>

                            <?php }
                            if ($logged_user_type == 1 || has_perm($logged_user_id, 'VCH', 'DCNT')) { ?>
                                <div class="new-nav-cat">
                                    <a href="<?php echo site_url('Vouchers/discount_list') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'discount_list') {
                                                                                                                        echo 'active';
                                                                                                                    } ?>">
                                        <img src="<?php echo base_url('assets/img/icons/money.png') ?>">
                                        <span>Discount List</span>
                                    </a>
                                    <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'VCH', 'DCNT', 'Add')) { ?>
                                        <a href="<?php echo site_url('Vouchers/add_discount') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'add_discount') {
                                                                                                                            echo 'active';
                                                                                                                        } ?>">
                                            <img src="<?php echo base_url('assets/img/icons/money.png') ?>">
                                            <span>Add Discount</span>
                                        </a>
                                    <?php } ?>
                                </div>
                                <div class="line"></div>
                            <?php } ?>
                        </div>
                    </div>


                    <!-- Inventory Navigation -->

                    <div class="container-fluid subnavdiv" id="Inventory">
                        <div class="new-nav-container">
                            <?php
                            if ($logged_user_type == 1 || has_perm($logged_user_id, 'INVT', 'REQMT')) { ?>
                                <div class="new-nav-cat">
                                    <a href="<?php echo site_url('Inventory/requirement_list') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'requirement_list') {
                                                                                                                            echo 'active';
                                                                                                                        } ?>">
                                        <img src="<?php echo base_url('assets/img/icons/requirement.png') ?>">
                                        <span>Requirements List</span>
                                    </a>
                                    <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'INVT', 'REQMT', 'Add')) { ?>
                                        <a href="<?php echo site_url('Inventory/add_requirement') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'add_requirement') {
                                                                                                                                echo 'active';
                                                                                                                            } ?>">
                                            <img src="<?php echo base_url('assets/img/icons/requirement.png') ?>">
                                            <span>Add Requirements</span>
                                        </a>
                                    <?php } ?>
                                </div>
                                <div class="line"></div>
                            <?php }
                            if ($logged_user_type == 1 || has_perm($logged_user_id, 'INVT', 'PORD')) { ?>
                                <div class="new-nav-cat">
                                    <a href="<?php echo site_url('Inventory/purchase_order') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'purchase_order') {
                                                                                                                            echo 'active';
                                                                                                                        } ?>">
                                        <img src="<?php echo base_url('assets/img/icons/pur_ord.png') ?>">
                                        <span>Purchase Order</span>
                                    </a>
                                    <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'INVT', 'PORD', 'Add')) { ?>
                                        <a href="<?php echo site_url('Inventory/add_purchase_order') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'add_purchase_order') {
                                                                                                                                    echo 'active';
                                                                                                                                } ?>">
                                            <img src="<?php echo base_url('assets/img/icons/pur_ord.png') ?>">
                                            <span>Add Order</span>
                                        </a>
                                    <?php } ?>
                                </div>
                                <div class="line"></div>
                            <?php
                            }
                            if ($logged_user_type == 1 || has_perm($logged_user_id, 'INVT', 'PINV')) { ?>
                                <div class="new-nav-cat">
                                    <a href="<?php echo site_url('Inventory/purchase_invoice') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'purchase_invoice') {
                                                                                                                            echo 'active';
                                                                                                                        } ?>">
                                        <img src="<?php echo base_url('assets/img/icons/pur_inv.png') ?>">
                                        <span>Purchase Invoice</span>
                                    </a>
                                    <!-- <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'INVT', 'PINV', 'Add')) { ?>
                                        <a href="<?php echo site_url('Inventory/add_purchase_invoice') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'add_purchase_invoice') {
                                                                                                                                    echo 'active';
                                                                                                                                } ?>">
                                            <img src="<?php echo base_url('assets/img/icons/pur_inv.png') ?>">
                                            <span>Add Invoice</span>
                                        </a>
                                    <?php } ?> -->
                                </div>

                            <?php }
                            if ($logged_user_type == 1 || has_perm($logged_user_id, 'INVT', 'PRTN')) { ?>
                                <div class="new-nav-cat">
                                    <a href="<?php echo site_url('Inventory/purchase_return') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'purchase_return') {
                                                                                                                            echo 'active';
                                                                                                                        } ?>">
                                        <img src="<?php echo base_url('assets/img/icons/pur_return.png') ?>">
                                        <span>Purchase Return</span>
                                    </a>

                                </div>
                                <div class="line"></div>
                            <?php }
                            if ($logged_user_type == 1 || has_perm($logged_user_id, 'INVT', 'STKJN')) { ?>
                                <div class="new-nav-cat">
                                    <a href="<?php echo site_url('Inventory/stockjournal_list') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'stockjournal_list') {
                                                                                                                            echo 'active';
                                                                                                                        } ?>">
                                        <img src="<?php echo base_url('assets/img/icons/stk.png') ?>">
                                        <span>Stock Journal</span>
                                    </a>
                                    <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'INVT', 'STKJN', 'Add')) { ?>
                                        <a href="<?php echo site_url('Inventory/add_stockjournal') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'add_stockjournal') {
                                                                                                                                echo 'active';
                                                                                                                            } ?>">
                                            <img src="<?php echo base_url('assets/img/icons/stk.png') ?>">
                                            <span>Add Stock</span>
                                        </a>
                                    <?php } ?>
                                </div>

                                <div class="line"></div>

                            <?php }
                            if ($logged_user_type == 1 || has_perm($logged_user_id, 'INVT', 'STKISS')) { ?>
                                <div class="new-nav-cat">
                                    <a href="<?php echo site_url('Inventory/storeissue_list') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'storeissue_list') {
                                                                                                                            echo 'active';
                                                                                                                        } ?>">
                                        <img src="<?php echo base_url('assets/img/icons/str_iss.png') ?>">
                                        <span>Store Issue</span>
                                    </a>
                                    <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'INVT', 'STKISS', 'Add')) { ?>
                                        <a href="<?php echo site_url('Inventory/add_storeissue') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'add_storeissue') {
                                                                                                                                echo 'active';
                                                                                                                            } ?>">
                                            <img src="<?php echo base_url('assets/img/icons/str_iss.png') ?>">
                                            <span>Add Store Issue</span>
                                        </a>
                                    <?php } ?>
                                </div>
                                <div class="line"></div>
                            <?php }
                            if ($logged_user_type == 1 || has_perm($logged_user_id, 'INVT', 'STKOT')) { ?>
                                <div class="new-nav-cat">
                                    <a href="<?php echo site_url('Inventory/storeout_list') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'storeout_list') {
                                                                                                                        echo 'active';
                                                                                                                    } ?>">
                                        <img src="<?php echo base_url('assets/img/icons/str_out.png') ?>">
                                        <span>Store Out</span>
                                    </a>
                                    <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'INVT', 'STKOT', 'Add')) { ?>
                                        <a href="<?php echo site_url('Inventory/add_storeout/1') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'add_storeout' && $this->uri->segment(3) == 1) {
                                                                                                                                echo 'active';
                                                                                                                            } ?>">
                                            <img src="<?php echo base_url('assets/img/icons/str_out.png') ?>">
                                            <span>Add Store Out</span>
                                        </a>
                                    <?php } ?>
                                </div>
                                <div class="line"></div>
                            <?php }
                            if ($logged_user_type == 1 || has_perm($logged_user_id, 'INVT', 'DV')) { ?>
                                <div class="new-nav-cat">
                                    <a href="<?php echo site_url('Inventory/damage_list') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'damage_list') {
                                                                                                                        echo 'active';
                                                                                                                    } ?>">
                                        <img src="<?php echo base_url('assets/img/icons/broken.png') ?>">
                                        <span>Damage List</span>
                                    </a>
                                    <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'INVT', 'DV', 'Add')) { ?>
                                        <a href="<?php echo site_url('Inventory/add_storeout/2') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'add_storeout' && $this->uri->segment(3) == 2) {
                                                                                                                                echo 'active';
                                                                                                                            } ?>">
                                            <img src="<?php echo base_url('assets/img/icons/broken.png') ?>">
                                            <span>Add Damage</span>
                                        </a>
                                    <?php } ?>
                                </div>
                            <?php } ?>

                        </div>
                    </div>


                    <!-- Restuarent Navigation -->

                    <div class="container-fluid subnavdiv" id="Restuarent">
                        <div class="new-nav-container">
                            <div class="new-nav-cat">
                                <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'RES', 'MG')) { ?>
                                    <a href="<?php echo site_url('Restuarent/menugroup_list') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'menugroup_list') {
                                                                                                                            echo 'active';
                                                                                                                        } ?>">
                                        <img src="<?php echo base_url('assets/img/icons/menu_group.png') ?>">
                                        <span>Menu Group</span>
                                    </a>
                                <?php }
                                if ($logged_user_type == 1 || has_perm($logged_user_id, 'RES', 'ME')) { ?>
                                    <a href="<?php echo site_url('Restuarent/menu_list') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'menu_list') {
                                                                                                                        echo 'active';
                                                                                                                    } ?>">
                                        <img src="<?php echo base_url('assets/img/icons/menu.png') ?>">
                                        <span>Menu</span>
                                    </a>
                                <?php  } ?>
                            </div>
                            <div class="line"></div>
                            <div class="new-nav-cat">
                                <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'RES', 'FCDE', 'Add')) { ?>
                                    <a href="<?php echo site_url('Restuarent/add_foodcourt') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'add_foodcourt') {
                                                                                                                            echo 'active';
                                                                                                                        } ?>">
                                        <img src="<?php echo base_url('assets/img/icons/food_court.png') ?>">
                                        <span>Add Food Entry</span>
                                    </a>
                                <?php }
                                if ($logged_user_type == 1 || has_perm($logged_user_id, 'RES', 'FCDE')) { ?>
                                    <a href="<?php echo site_url('Restuarent/foodcourt_list') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'foodcourt_list') {
                                                                                                                            echo 'active';
                                                                                                                        } ?>">
                                        <img src="<?php echo base_url('assets/img/icons/food_court.png') ?>">
                                        <span>FoodCourt Entries</span>
                                    </a>

                                <?php  } ?>
                            </div>
                            <div class="line"></div>
                            <div class="new-nav-cat">
                                <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'RES', 'RSTR', 'Add')) { ?>
                                    <a href="<?php echo site_url('Restuarent/add_resort_data') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'add_resort_data' && $this->uri->segment(3) == '1') {
                                                                                                                            echo 'active';
                                                                                                                        } ?>">
                                        <img src="<?php echo base_url('assets/img/icons/resort_entry.png') ?>">
                                        <span>Add Resort Entry</span>
                                    </a>
                                <?php }
                                if ($logged_user_type == 1 || has_perm($logged_user_id, 'RES', 'RSTR')) { ?>
                                    <a href="<?php echo site_url('Restuarent/resort_data_list/1') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'resort_data_list') {
                                                                                                                                echo 'active';
                                                                                                                            } ?>">
                                        <img src="<?php echo base_url('assets/img/icons/resort_entry.png') ?>">
                                        <span>Resort Entries</span>
                                    </a>

                                <?php  } ?>
                            </div>
                            <div class="line"></div>
                            <div class="new-nav-cat">
                                <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'RES', 'CMPR', 'Add')) { ?>
                                    <a href="<?php echo site_url('Restuarent/add_resort_data/2') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'add_resort_data' && $this->uri->segment(3) == '2') {
                                                                                                                                echo 'active';
                                                                                                                            } ?>">
                                        <img src="<?php echo base_url('assets/img/icons/camps.png') ?>">
                                        <span>Add Camp Entry</span>
                                    </a>
                                <?php }
                                if ($logged_user_type == 1 || has_perm($logged_user_id, 'RES', 'CMPR')) { ?>
                                    <a href="<?php echo site_url('Restuarent/camps_data_list') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'camps_data_list') {
                                                                                                                            echo 'active';
                                                                                                                        } ?>">
                                        <img src="<?php echo base_url('assets/img/icons/camps.png') ?>">
                                        <span>Camp Entries</span>
                                    </a>

                                <?php  } ?>
                            </div>
                        </div>
                    </div>


                    <!-- HrDept Navigation -->

                    <div class="container-fluid subnavdiv" id="HrDept">
                        <div class="new-nav-container">
                            <div class="new-nav-cat">
                                <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'HR', 'Dept')) { ?>
                                    <a href="<?php echo site_url('HrDept/department_list') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'department_list') {
                                                                                                                        echo 'active';
                                                                                                                    } ?>">
                                        <img src="<?php echo base_url('assets/img/icons/networking.png') ?>">
                                        <span>Department </span>
                                    </a>
                                <?php }
                                if ($logged_user_type == 1 || has_perm($logged_user_id, 'HR', 'Deg')) { ?>
                                    <a href="<?php echo site_url('HrDept/designation_list') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'designation_list') {
                                                                                                                        echo 'active';
                                                                                                                    } ?>">
                                        <img src="<?php echo base_url('assets/img/icons/team.png') ?>">
                                        <span>Designation</span>
                                    </a>
                                <?php }
                                if ($logged_user_type == 1 || has_perm($logged_user_id, 'HR', 'Hq')) { ?>
                                    <a href="<?php echo site_url('HrDept/hq_list') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'hq_list') {
                                                                                                                echo 'active';
                                                                                                            } ?>">
                                        <img src="<?php echo base_url('assets/img/icons/city.png') ?>">
                                        <span>HQ</span>
                                    </a>
                                <?php }
                                if ($logged_user_type == 1 || has_perm($logged_user_id, 'HR', 'nh')) { ?>
                                    <a href="<?php echo site_url('HrDept/nh_list') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'nh_list') {
                                                                                                                echo 'active';
                                                                                                            } ?>">
                                        <img src="<?php echo base_url('assets/img/icons/holiday.png') ?>">
                                        <span>NH</span>
                                    </a>
                                <?php  } ?>
                            </div>
                            <div class="line"></div>
                            <div class="new-nav-cat">
                                <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'HR', 'Emp')) { ?>
                                    <a href="<?php echo site_url('HrDept/employe_list') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'employe_list') {
                                                                                                                    echo 'active';
                                                                                                                } ?>">
                                        <img src="<?php echo base_url('assets/img/icons/employee.png') ?>">
                                        <span>Employees</span>
                                    </a>
                                <?php }
                                if ($logged_user_type == 1 || has_perm($logged_user_id, 'HR', 'ADV')) { ?>
                                    <a href="<?php echo site_url('HrDept/advance_list') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'advance_list') {
                                                                                                                    echo 'active';
                                                                                                                } ?>">
                                        <img src="<?php echo base_url('assets/img/icons/salary.png') ?>">
                                        <span>Advance</span>
                                    </a>
                                <?php }
                                if ($logged_user_type == 1 || has_perm($logged_user_id, 'HR', 'SYIT', 'Add')) { ?>
                                    <a href="<?php echo site_url('HrDept/add_monthly_salary') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'add_monthly_salary') {
                                                                                                                            echo 'active';
                                                                                                                        } ?>">
                                        <img src="<?php echo base_url('assets/img/icons/salary.png') ?>">
                                        <span>Add Salary</span>
                                    </a>
                                <?php }
                                if ($logged_user_type == 1 || has_perm($logged_user_id, 'HR', 'SYIT')) { ?>
                                    <a href="<?php echo site_url('HrDept/salary_history') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'salary_history') {
                                                                                                                        echo 'active';
                                                                                                                    } ?>">
                                        <img src="<?php echo base_url('assets/img/icons/salary.png') ?>">
                                        <span>Salary List</span>
                                    </a>
                                <?php }
                                if ($logged_user_type == 1 || has_perm($logged_user_id, 'HR', 'INMT')) { ?>
                                    <a href="<?php echo site_url('HrDept/incrmt_list') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'incrmt_list') {
                                                                                                                    echo 'active';
                                                                                                                } ?>">
                                        <img src="<?php echo base_url('assets/img/icons/salary_increament.png') ?>">
                                        <span>Increaments</span>
                                    </a>
                                <?php  } ?>
                            </div>
                        </div>
                    </div>


                    <!-- Marketing Navigation -->

                    <div class="container-fluid subnavdiv" id="Marketing">
                        <div class="new-nav-container">
                            <div class="new-nav-cat">
                                <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'MKT', 'LSR')) { ?>
                                    <a href="<?php echo site_url('Marketing/leadsource_list') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'leadsource_list') {
                                                                                                                            echo 'active';
                                                                                                                        } ?>">
                                        <img src="<?php echo base_url('assets/img/icons/source.png') ?>">
                                        <span>Lead Source</span>
                                    </a>
                                <?php }
                                if ($logged_user_type == 1 || has_perm($logged_user_id, 'MKT', 'LTY')) { ?>
                                    <a href="<?php echo site_url('Marketing/leadtype_list') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'leadtype_list') {
                                                                                                                        echo 'active';
                                                                                                                    } ?>">
                                        <img src="<?php echo base_url('assets/img/icons/classification.png') ?>">
                                        <span>Lead Type</span>
                                    </a>
                                <?php }
                                if ($logged_user_type == 1 || has_perm($logged_user_id, 'MKT', 'LST')) { ?>
                                    <a href="<?php echo site_url('Marketing/leadstatus_list') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'leadstatus_list') {
                                                                                                                            echo 'active';
                                                                                                                        } ?>">
                                        <img src="<?php echo base_url('assets/img/icons/check-list.png') ?>">
                                        <span>Lead Status</span>
                                    </a>
                                <?php } ?>
                            </div>
                            <div class="line"></div>
                            <div class="new-nav-cat">
                                <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'MKT', 'LCTL')) { ?>
                                    <a href="<?php echo site_url('Marketing/leadclient_list') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'leadclient_list') {
                                                                                                                            echo 'active';
                                                                                                                        } ?>">
                                        <img src="<?php echo base_url('assets/img/icons/clients.png') ?>">
                                        <span>Clients List</span>
                                    </a>
                                <?php }
                                if ($logged_user_type == 1 || has_perm($logged_user_id, 'MKT', 'lead')) { ?>
                                    <a href="<?php echo site_url('Marketing/lead_list') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'lead_list') {
                                                                                                                    echo 'active';
                                                                                                                } ?>">
                                        <img src="<?php echo base_url('assets/img/icons/lead-generation.png') ?>">
                                        <span>Enquiries</span>
                                    </a>
                                <?php  } ?>
                            </div>
                        </div>
                    </div>


                    <!-- Setup Navigation -->

                    <div class="container-fluid subnavdiv" id="Setup">
                        <div class="new-nav-container">
                            <div class="new-nav-cat">
                                <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'Setup', 'Acp')) { ?>
                                    <a href="<?php echo site_url('Setup/accparent_list') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'accparent_list') {
                                                                                                                        echo 'active';
                                                                                                                    } ?>">
                                        <img src="<?php echo base_url('assets/img/icons/costume-code.png') ?>">
                                        <span>AccParent</span>
                                    </a>
                                <?php }
                                if ($logged_user_type == 1 || has_perm($logged_user_id, 'Setup', 'Acg')) { ?>
                                    <a href="<?php echo site_url('Setup/accgroup_list') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'accgroup_list') {
                                                                                                                    echo 'active';
                                                                                                                } ?>">
                                        <img src="<?php echo base_url('assets/img/icons/costume-code.png') ?>">
                                        <span>AccGroup</span>
                                    </a>
                                <?php }
                                if ($logged_user_type == 1 || has_perm($logged_user_id, 'Setup', 'cmpy')) { ?>
                                    <a href="<?php echo site_url('Setup/company_list') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'company_list') {
                                                                                                                    echo 'active';
                                                                                                                } ?>">
                                        <img src="<?php echo base_url('assets/img/icons/costume-code.png') ?>">
                                        <span>Company</span>
                                    </a>
                                <?php }
                                if ($logged_user_type == 1 || has_perm($logged_user_id, 'Setup', 'Acc')) { ?>
                                    <a href="<?php echo site_url('Setup/account_list') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'account_list') {
                                                                                                                    echo 'active';
                                                                                                                } ?>">
                                        <img src="<?php echo base_url('assets/img/icons/accounting.png') ?>">
                                        <span>Accounts</span>
                                    </a>
                                <?php }
                                if ($logged_user_type == 1 || has_perm($logged_user_id, 'Setup', 'Cust')) { ?>
                                    <a href="<?php echo site_url('Setup/customer_list') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'customer_list') {
                                                                                                                    echo 'active';
                                                                                                                } ?>">
                                        <img src="<?php echo base_url('assets/img/icons/all-user.png') ?>">
                                        <span>Costomers</span>
                                    </a>
                                <?php }
                                if ($logged_user_type == 1 || has_perm($logged_user_id, 'Setup', 'Supp')) { ?>
                                    <a href="<?php echo site_url('Setup/supplier_list') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'supplier_list') {
                                                                                                                    echo 'active';
                                                                                                                } ?>">
                                        <img src="<?php echo base_url('assets/img/icons/supplier.png') ?>">
                                        <span>Supplier</span>
                                    </a>
                                <?php }
                                if ($logged_user_type == 1 || has_perm($logged_user_id, 'Setup', 'Ctr')) { ?>
                                    <a href="<?php echo site_url('Setup/contractor_list') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'contractor_list') {
                                                                                                                        echo 'active';
                                                                                                                    } ?>">
                                        <img src="<?php echo base_url('assets/img/icons/worker.png') ?>">
                                        <span>Contractor</span>
                                    </a>
                                <?php }
                                if ($logged_user_type == 1 || has_perm($logged_user_id, 'Setup', 'Users')) { ?>
                                    <a href="<?php echo site_url('Setup/users_list') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'users_list') {
                                                                                                                    echo 'active';
                                                                                                                } ?>">
                                        <img src="<?php echo base_url('assets/img/icons/programmer.png') ?>">
                                        <span>Users</span>
                                    </a>
                                <?php }
                                if ($logged_user_type == 1 || has_perm($logged_user_id, 'Setup', 'Gdwn')) { ?>
                                    <a href="<?php echo site_url('Setup/godown_list') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'godown_list') {
                                                                                                                    echo 'active';
                                                                                                                } ?>">
                                        <img src="<?php echo base_url('assets/img/icons/warehouse.png') ?>">
                                        <span>Godowns</span>
                                    </a>
                                <?php }
                                if ($logged_user_type == 1 || has_perm($logged_user_id, 'Setup', 'Ats')) { ?>
                                    <a href="<?php echo site_url('Setup/asset_list') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'asset_list') {
                                                                                                                    echo 'active';
                                                                                                                } ?>">
                                        <img src="<?php echo base_url('assets/img/icons/assets.png') ?>">
                                        <span>Asset</span>
                                    </a>
                                <?php }
                                if ($logged_user_type == 1 || has_perm($logged_user_id, 'Setup', 'Pgp')) { ?>
                                    <a href="<?php echo site_url('Setup/prodgroup_list') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'prodgroup_list') {
                                                                                                                        echo 'active';
                                                                                                                    } ?>">
                                        <img src="<?php echo base_url('assets/img/icons/costume-code.png') ?>">
                                        <span>ProdGroup</span>
                                    </a>
                                <?php }
                                if ($logged_user_type == 1 || has_perm($logged_user_id, 'Setup', 'Pct')) { ?>
                                    <a href="<?php echo site_url('Setup/prodcat_list') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'prodcat_list') {
                                                                                                                    echo 'active';
                                                                                                                } ?>">
                                        <img src="<?php echo base_url('assets/img/icons/categories.png') ?>">
                                        <span>ProdCategory</span>
                                    </a>
                                <?php }
                                if ($logged_user_type == 1 || has_perm($logged_user_id, 'Setup', 'Put')) { ?>
                                    <a href="<?php echo site_url('Setup/produnit_list') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'produnit_list') {
                                                                                                                    echo 'active';
                                                                                                                } ?>">
                                        <img src="<?php echo base_url('assets/img/icons/unit.png') ?>">
                                        <span>ProdUnit</span>
                                    </a>
                                <?php }
                                if ($logged_user_type == 1 || has_perm($logged_user_id, 'Setup', 'Psz')) { ?>
                                    <a href="<?php echo site_url('Setup/prodsize_list') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'prodsize_list') {
                                                                                                                    echo 'active';
                                                                                                                } ?>">
                                        <img src="<?php echo base_url('assets/img/icons/size.png') ?>">
                                        <span>ProdSize</span>
                                    </a>
                                <?php }
                                if ($logged_user_type == 1 || has_perm($logged_user_id, 'Setup', 'Prod')) { ?>
                                    <a href="<?php echo site_url('Setup/product_list') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'product_list') {
                                                                                                                    echo 'active';
                                                                                                                } ?>">
                                        <img src="<?php echo base_url('assets/img/icons/products.png') ?>">
                                        <span>Product</span>
                                    </a>
                                <?php }
                                if ($logged_user_type == 1 || has_perm($logged_user_id, 'Setup', 'BND')) { ?>
                                    <a href="<?php echo site_url('Setup/band_list') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'band_list') {
                                                                                                                echo 'active';
                                                                                                            } ?>">
                                        <img src="<?php echo base_url('assets/img/icons/ticket.png') ?>">
                                        <span>Bands</span>
                                    </a>
                                <?php }
                                if ($logged_user_type == 1 || has_perm($logged_user_id, 'Setup', 'bdcr')) { ?>
                                    <a href="<?php echo site_url('Setup/band_colour_list') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'band_colour_list') {
                                                                                                                        echo 'active';
                                                                                                                    } ?>">
                                        <img src="<?php echo base_url('assets/img/icons/rubber-bands.png') ?>">
                                        <span>Band Colour</span>
                                    </a>
                                <?php }
                                if ($logged_user_type == 1 || has_perm($logged_user_id, 'Setup', 'plan')) { ?>
                                    <a href="<?php echo site_url('Setup/plans_list') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'plans_list') {
                                                                                                                    echo 'active';
                                                                                                                } ?>">
                                        <img src="<?php echo base_url('assets/img/icons/business-plan.png') ?>">
                                        <span>Plans</span>
                                    </a>
                                <?php }
                                if ($logged_user_type == 1 || has_perm($logged_user_id, 'Setup', 'package')) { ?>
                                    <a href="<?php echo site_url('Setup/package_list') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'package_list') {
                                                                                                                    echo 'active';
                                                                                                                } ?>">
                                        <img src="<?php echo base_url('assets/img/icons/lunch-box.png') ?>">
                                        <span>Food Package</span>
                                    </a>

                                <?php  } ?>
                            </div>
                        </div>
                    </div>


                    <!-- Master Navigation -->

                    <div class="container-fluid subnavdiv" id="Master">
                        <div class="new-nav-container">
                            <div class="new-nav-cat">
                                <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'Mtr', 'Ste')) { ?>
                                    <a href="<?php echo site_url('Master/state_list') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'state_list') {
                                                                                                                    echo 'active';
                                                                                                                } ?>">
                                        <img src="<?php echo base_url('assets/img/icons/state.png') ?>">
                                        <span>State</span>
                                    </a>
                                <?php }
                                if ($logged_user_type == 1 || has_perm($logged_user_id, 'Mtr', 'City')) { ?>
                                    <a href="<?php echo site_url('Master/city_list') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'city_list') {
                                                                                                                    echo 'active';
                                                                                                                } ?>">
                                        <img src="<?php echo base_url('assets/img/icons/city.png') ?>">
                                        <span>City</span>
                                    </a>
                                <?php }
                                if ($logged_user_type == 1 || has_perm($logged_user_id, 'Mtr', 'Shd')) { ?>
                                    <a href="<?php echo site_url('Master/saleshead_list') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'saleshead_list') {
                                                                                                                        echo 'active';
                                                                                                                    } ?>">
                                        <img src="<?php echo base_url('assets/img/icons/add-user.png') ?>">
                                        <span>Sale Head</span>
                                    </a>
                                <?php }
                                if ($logged_user_type == 1 || has_perm($logged_user_id, 'Mtr', 'CACT')) { ?>
                                    <a href="<?php echo site_url('Master/cashAcc_list') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'cashAcc_list') {
                                                                                                                    echo 'active';
                                                                                                                } ?>">
                                        <img src="<?php echo base_url('assets/img/icons/cash.png') ?>">
                                        <span>Cash Account</span>
                                    </a>
                                <?php }
                                if ($logged_user_type == 1 || has_perm($logged_user_id, 'Mtr', 'Lkc')) { ?>
                                    <a href="<?php echo site_url('Master/lockercode_list') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'lockercode_list') {
                                                                                                                        echo 'active';
                                                                                                                    } ?>">
                                        <img src="<?php echo base_url('assets/img/icons/locker-code.png') ?>">
                                        <span>Locker Code</span>
                                    </a>

                                <?php }
                                if ($logged_user_type == 1 || has_perm($logged_user_id, 'Mtr', 'inst')) { ?>
                                    <a href="<?php echo site_url('Master/instraction_list') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'instraction_list') {
                                                                                                                        echo 'active';
                                                                                                                    } ?>">
                                        <img src="<?php echo base_url('assets/img/icons/file.png') ?>">
                                        <span>Instructions</span>
                                    </a>
                                <?php }
                                if ($logged_user_id == 1) { ?>
                                    <a href="<?php echo site_url('Master/perm_list') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'perm_list') {
                                                                                                                    echo 'active';
                                                                                                                } ?>">
                                        <img src="<?php echo base_url('assets/img/icons/costume-code.png') ?>">
                                        <span>Permission</span>
                                    </a>

                                <?php  } ?>
                            </div>
                        </div>
                    </div>

                    <!-- Report Navigation -->

                    <div class="container-fluid subnavdiv" id="Reports">
                        <div class="new-nav-container">
                            <div class="new-nav-cat">
                                <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'RPT', 'TCK')) { ?>
                                    <a href="<?php echo site_url('Reports/ticket_report') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'ticket_report') {
                                                                                                                        echo 'active';
                                                                                                                    } ?>">
                                        <img src="<?php echo base_url('assets/img/icons/tck_rpt.png') ?>">
                                        <span>Ticket Report</span>
                                    </a>
                                <?php  }
                                if ($logged_user_type == 1 || has_perm($logged_user_id, 'RPT', 'STK')) { ?>
                                    <a href="<?php echo site_url('Reports/stock_report') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'stock_report') {
                                                                                                                        echo 'active';
                                                                                                                    } ?>">
                                        <img src="<?php echo base_url('assets/img/icons/stock_report.png') ?>">
                                        <span>Stock Report</span>
                                    </a>
                                <?php  }
                                if ($logged_user_type == 1 || has_perm($logged_user_id, 'RPT', 'MNR')) { ?>
                                    <a href="<?php echo site_url('Reports/monthly_report') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'monthly_report') {
                                                                                                                        echo 'active';
                                                                                                                    } ?>">
                                        <img src="<?php echo base_url('assets/img/icons/stock_report.png') ?>">
                                        <span>Monthly Report</span>
                                    </a>
                                <?php  } ?>

                            </div>
                        </div>
                    </div>


                    <!-- Profile Navigation -->

                    <div class="container-fluid subnavdiv" id="Profile">
                        <div class="new-nav-container">
                            <div class="new-nav-cat">
                                <?php if ($logged_user_id == 1) { ?>
                                    <a href="<?php echo site_url('Profile?id=' . $logged_user_id) ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'Profile' && $this->uri->segment(2) == '') {
                                                                                                                                echo 'active';
                                                                                                                            } ?>">
                                        <img src="<?php echo $user_img; ?>">
                                        <span>Your Profile</span>
                                    </a>
                                <?php }
                                if ($logged_user_type == 1 || has_perm($logged_user_id, 'Set', 'Apst')) { ?>
                                    <a href="<?php echo site_url('Profile/application_settings') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'application_settings') {
                                                                                                                                echo 'active';
                                                                                                                            } ?>">
                                        <img src="<?php echo base_url('assets/img/icons/app-setting.png') ?>">
                                        <span>Application Setting</span>
                                    </a>
                                <?php }
                                if ($logged_user_type == 1 || has_perm($logged_user_id, 'Set', 'wdst')) { ?>
                                    <a href="<?php echo site_url('Profile/weekday_settings') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'weekday_settings') {
                                                                                                                            echo 'active';
                                                                                                                        } ?>">
                                        <img src="<?php echo base_url('assets/img/icons/setting2.png') ?>">
                                        <span>WeekDay Setting</span>
                                    </a>
                                <?php }
                                if ($logged_user_type == 1 || has_perm($logged_user_id, 'Set', 'west')) { ?>
                                    <a href="<?php echo site_url('Profile/weekend_settings') ?>" class="new-nav-link <?php if ($this->uri->segment(2) == 'weekend_settings') {
                                                                                                                            echo 'active';
                                                                                                                        } ?>">
                                        <img src="<?php echo base_url('assets/img/icons/setting2.png') ?>">
                                        <span>WeekEnd Setting</span>
                                    </a>
                                <?php  } ?>
                            </div>
                        </div>
                    </div>


                </section>
            </nav>
            <!-- Header Top End -->
        </header>
        <?php $this->view('sidebar_view');
        ?>

        <!-- Right Side Content Start -->

        <section id="content" class="seipkon-content-wrapper">
            <div aria-live="polite" aria-atomic="true" style="position: relative;">
                <div class="toast hide" id="toast_text-box" style="position: fixed;top: 0;right: 0;margin: 20px;background-color: #26ff26cf;color: black;border-radius: 10px 0px;z-index: 9999;">
                    <div class="toast-body" id="toast_text-text" style="padding: 10px;font-weight: bold;">
                        Permission update successfully.
                    </div>
                </div>
            </div>

            <script src="<?php echo base_url('assets/js/jquery-3.1.0.min.js') ?>"></script>

            <script>
                $(document).ready(function(e) {

                    $("#globelbranch").on("change", function() {

                        var branchid = $(this).val();

                        $.ajax({
                            type: "POST",
                            url: "<?php echo site_url('Welcome/Change_globel_branch'); ?>",
                            data: {
                                branchid: branchid
                            },

                            dataType: "JSON",
                            success: function(data) {
                                if (data.status == 'success') {
                                    location.reload();
                                } else {
                                    location.reload();
                                }
                            }
                        });

                    });


                });
            </script>