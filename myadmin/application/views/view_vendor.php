<!-- ========================Header==============Fix========= --> 
<?php $this->view('top_header') ?>
<!-- =======================/Header==============Fix========= -->

<!-- Right Side Content Start -->
<style>
.card {
    box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
}

.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid rgba(0,0,0,.125);
    border-radius: .25rem;
}

.card-body {
    flex: 1 1 auto;
    min-height: 1px;
    padding: 1rem;
}
.txt_left{
   float: left;
}
.txt-right{
   float: right;
}
.txt-word{
  word-break: break-word;
}
.font-15{
   font-size: 15px !important;
   padding: 10px;
}
.wt-42{
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
                                <h3><?php echo $pagename;?></h3>
                            </div>
                        </div>

                         <div class="col-md-8 col-sm-8 pull-right">
                    <div class="seipkon-breadcromb-right">

                      <!-- <a href="<?php // echo site_url('Users/unverified_mechanics_dtl') ?>" class="btn btn-info btn-vsm"><i class="fa fa-list-alt"></i> Un Verified Mechanics List</a> -->
                      <a href="<?php echo site_url('Users/vendor_list') ?>" class="btn btn-info btn-vsm"><i class="fa fa-list-alt"></i> All Vendors List</a>
                      <a href="<?php echo base_url('Users/add_vendor_dlt?id=').$edit_value[0]->m_vendor_id; ?>" class="btn btn-info btn-vsm" title="Edit"><i class="fa fa-edit"></i> Edit Details</a>

                      <!-- <a  class="btn btn-primary btn-warning veryfy-kyc-data" data-value="<?php // echo $edit_value[0]->m_vendor_id ?>" title="Verify Mechanic" >Verify KYC</a> -->
                    </div>
                    </div>
                             
                        
                    </div>
                </div>
            </div>
        </div>
        <br>
        <!------------------for img---------------------------->
        <?php
              
          if(!empty($edit_value[0]->m_vendor_pic)){
              $vendor_img = base_url('uploads/Category').$edit_value[0]->m_vendor_pic;
          }
          else{
               $vendor_img = base_url('uploads/Category/defaultimg.jpg');
          }

        ?>
        <!------------------for img End Above------------------>
        <div class="row">
            <div class="col-md-4 col-sm-4">
               <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="<?php echo $vendor_img;?>" alt="Profile Photo" class="rounded-circle" width="150">
                      <h4><?php echo  $edit_value[0]->m_vendor_name ;?></h4>
<!-------------------------------------------------------->

                  </div>
                </div>
              </div>
              <div class="card font-15">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center">
                    <table class="table table-bordered">
                        <tr>
                           <td><i class="fa fa-phone-square"></i> Cont. No.</td>
                           <td><b><?php echo $edit_value[0]->m_vendor_mobile;?></b></td>
                        </tr>
                        <tr>
                           <td><i class="fa fa-envelope"></i> Email ID</td>
                           <td><b class="txt-word"><?php echo $edit_value[0]->m_vendor_email;?></b></td>
                        </tr>
                        <tr>
                           <td class="wt-42"><i class="fa fa-heart-o"></i> City</td>
                           <td><b><?php echo $edit_value[0]->m_city_name;?></b></td>
                        </tr>
                        <tr>
                           <td class="wt-42"><i class="fa fa-clock-o"></i> Status </td>
                           <td><b><?php if($edit_value[0]->m_vendor_status==1)echo "Active";
                                              else{echo "InActive";} ?></b></td>
                        </tr>

                      
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-8 col-sm-8">
               <div class="card font-15">
                  <div class="card-body">
                     <h4>Profile Details</h4>
                     <br>
                     <table class="table table-bordered">
                      <?php 
                           $original_date =$edit_value[0]->m_vendor_added_on;
                            $new_date = date("d-m-Y h:ia", strtotime($original_date));

                            $original_dob =$edit_value[0]->m_vendor_dob;
                            $new_dob = date("d-m-Y", strtotime($original_dob));
                      ?>
                        <tr>
                           <td>Joined On:</td>
                           <td><b><?php echo $new_date;?></b></td>
                        </tr>
                        <tr>
                           <td>Date Of Birth:</td>
                           <td><b><?php echo $new_dob;?></b></td>
                        </tr>
                        <tr>
                           <td>Gender:</td>
                           <td><b><?php echo $edit_value[0]->m_vendor_gender;?></b></td>
                        </tr>

                        <tr>
                           <td>Area:</td>
                           <td><b><?php echo $edit_value[0]->m_vendor_area;?></b></td>
                        </tr>
                        <tr>
                           <td>Address:</td>
                           <td><b><?php echo $edit_value[0]->m_vendor_address;?></b></td>
                        </tr>
                  
                     </table>
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
            
          <img src="" alt="Image Not Set" class="cat-icon"  width="100%" style="height: 300px;">
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