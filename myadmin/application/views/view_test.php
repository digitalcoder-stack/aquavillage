<!-- ========================Header==============Fix========= -->
<?php $this->view('top_header') ?>
<!-- =======================/Header==============Fix========= -->

<!-- Right Side Content Start -->
<style>
    .card {
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
    }

    .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 0 solid rgba(0, 0, 0, .125);
        border-radius: .25rem;
    }

    .card-body {
        flex: 1 1 auto;
        min-height: 1px;
        padding: 1rem;
    }

    .txt_left {
        float: left;
    }

    .txt-right {
        float: right;
    }

    .txt-word {
        word-break: break-word;
    }

    .font-15 {
        font-size: 15px !important;
        padding: 10px;
    }

    .wt-42 {
        width: 42%;
    }

    .badge {
        background-color: #2d1b4f !important;
        cursor: pointer;
    }
</style>
<div class="page-content">
    <div class="container-fluid">
        <!-- ========================/View===============Fix========= -->
        <!-- ======================Page Title======================== -->
        <!-- Breadcromb Row Start -->
        <div class="row">
            <div class="col-md-12">
                <div class="breadcromb-area">
                    <div class="row">
                        <div class="col-md-4  col-sm-4">
                            <div class="seipkon-breadcromb-left">
                                <h3><?php echo $pagename; ?></h3>
                            </div>
                        </div>

                        <div class="col-md-8 col-sm-8 pull-right">
                            <div class="seipkon-breadcromb-right">

                                <a href="<?php echo base_url('Question?test=') . $edit_value[0]->m_test_id; ?>" class="btn btn-primary btn-action" title="Questions" data-toggle="tooltip"><i class="fa fa-pencil" aria-hidden="true"></i> Questions</a>
                                <a href="<?php echo site_url('Test/test_list') ?>" class="btn btn-info btn-vsm"><i class="fa fa-list-alt"></i> All Test List</a>
                                <a href="<?php echo base_url('Test/add_test?id=') . $edit_value[0]->m_test_id; ?>" class="btn btn-info btn-vsm" title="Edit"><i class="fa fa-edit"></i> Edit Details</a>

                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-6 col-sm-6">

                <div class="card font-15">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center">
                            <table class="table table-bordered">
                                <tr>
                                    <td> Test Title</td>
                                    <td><b><?php echo $edit_value[0]->m_test_title; ?></b></td>
                                </tr>
                                <tr>
                                    <td> Test Intro</td>
                                    <td><b class="txt-word"><?php echo $edit_value[0]->m_test_intro; ?></b></td>
                                </tr>
                                <tr>
                                    <td class="wt-42"> Heading1</td>
                                    <td><b><?php echo $edit_value[0]->m_test_heading1; ?></b></td>
                                </tr>

                                <tr>
                                    <td> Heading2</td>
                                    <td><b><?php echo $edit_value[0]->m_test_heading2; ?></b></td>
                                </tr>

                                <tr>
                                    <td class="wt-42">Status </td>
                                    <td><b><?php if ($edit_value[0]->m_test_status == 1) echo "Active";
                                            else {
                                                echo "InActive";
                                            } ?></b></td>
                                </tr>


                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <div class="card font-15">
                    <div class="card-body">

                        <table class="table table-bordered">

                            <tr>
                                <td>Unit:</td>
                                <td><b><?php echo $edit_value[0]->m_unit_title; ?></b></td>
                            </tr>
                            <tr>
                                <td>Topic:</td>
                                <td><b><?php echo $edit_value[0]->m_topic_title; ?></b></td>
                            </tr>
                            <tr>
                                <td>Sub Topic:</td>
                                <td><b><?php echo $edit_value[0]->m_sub_topic_title; ?></b></td>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-md-12 col-sm-12">

                <div class="card font-15">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center">
                            <table class="table table-bordered">

                                <tr>
                                    <td width="30%">Notes:</td>
                                    <td><b><?php echo $edit_value[0]->m_test_note; ?></b></td>
                                </tr>

                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
<!-- ===========/model Start for image====================== -->
<div class="modal fade" id="icon_modal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>
            <div class="modal-body">

                <img src="" alt="Image Not Set" class="cat-icon" width="100%" style="height: 300px;">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<!-- =================/model Ends Above for image============-->


<!-- ========================/View=================Fix======= -->
<!-- ========================Footer================Fix======= -->
<?php $this->view('top_footer'); ?>
<!-- =======================/Footer================Fix======= -->
<!-- ========================Script========================== -->
<?php $this->view('js/js_vendor') ?>
<!-- =======================/Script==========================