<!--=========================View==============Fix========== -->
<!-- ========================Header==============Fix========= -->
<?php $this->view('top_header') ?>
<!-- =======================/Header==============Fix========= -->
<!-- =========================View===============Fix========= -->
<div class="page-content">
    <div class="container-fluid">
        <!-- ========================/View===============Fix========= -->
        <!-- ======================Page Title======================== -->
       
        <style type="text/css">
            .d-flex {
            display: flex;
            align-items: center;
            }
            .jbfrm input[type=radio]{
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
            .space-around input[type=checkbox]{
            margin: 0px 0px 0px;
            transition: 0.5s;
            width: 20px;
            height: 18px;
            }
            .space-around input[type=checkbox]:focus { outline: none!important; transform: scale(1.2); } 
            .jbfrm input[type=radio]:focus { outline: none!important; transform: scale(1.2); } 
        </style>
 <!-- Breadcromb Row Start -->
<!----------------------------row start------------------------> 
        <div class="row">
            <div class="col-md-12">
                <div class="breadcromb-area">
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="seipkon-breadcromb-left">
                                <h3><?php echo $pagename;?></h3>
                            </div>
                        </div>

                    <div class="col-md-6 col-sm-6 pull-right">
                    <div class="seipkon-breadcromb-right">
                          <!-- <a href="<?php echo site_url('Users/unverified_mechanics_dtl') ?>" class="btn btn-info btn-vsm"><i class="fa fa-list-alt"></i> Un Verified Mechanics List</a> -->
                          <a href="<?php echo site_url('Users/add_vendor_dlt') ?>" class="btn btn-info btn-vsm"><i class="fa fa-plus-circle"></i> Add New Vendor</a>
                    </div>
                    </div>
                 
                    </div>
                </div>
            </div>
        </div><br>
<!----------------------------row end above-------------------->        

<!----------------------------row start for filter------------->
        <!-- <div class="row">
            <div class="col-md-12">
                <div class="breadcromb-area">
              
                <div class="row">
                   <form method="get" action="<?php  // echo site_url('Users/vendor_dtl_list') ?>">
                   <div class="col-lg-3 col-md-3">
                      <div class="form-group">
                          <label>Date(M-D-Y):</label>
                          <input class="form-control date_form " type="date" placeholder="From Date" name="from_date" id="m_from_date" value="<?php echo $fromdate;?>">
                      </div>
                    </div>

                    <div class="col-lg-3 col-md-3">
                    <div class="form-group">
                        <label>To Date(M-D-Y):</label>
                        <input class="form-control date_form" type="date" placeholder="To Date" name="to_date" id="to_date" value="<?php echo $todate;  ?>">
                    </div>
                    </div>
                   
                      <div class="col-md-3 col-md-3">
                      <div class="form-group">
                        <label>State</label>
                        <select id="state"  class="form-control select2 " name="state">
                        <option value="">Select State</option>
                        <?php
                        //  if(!empty($state_dtl)){
                        //    foreach ($state_dtl as $state_value) {
                        //     if($state == $state_value->m_state_id){
                        //       $option1 ="selected";
                        //     }else{ $option1 ="";}
                           ?>
                            <option value="<?php // echo $state_value->m_state_id; ?>"<?php // echo $option1;?>><?php // echo $state_value->m_state_name;?>
                            </option>
                            <?php
                        //   }
                        //  }
                         ?>
                        </select>
                      </div> 
                      </div>


                    <div class="col-md-3 col-md-3">
                      <div class="form-group">
                        <label>City</label>
                        <select id="city"  class="form-control select2" name="city">
                        <option value="">Select City</option>
                        <?php
                        //  if(!empty($city_dtl)){
                        //    foreach ($city_dtl as $city_value) {

                        //      if($city == $city_value->m_city_id){
                        //       $option1 ="selected";
                        //     }else{ $option1 ="";}
                           
                           ?>
                            <option value="<?php  // echo $city_value->m_city_id;?>" <?php //  echo $option1;?>><?php  //echo $city_value->m_city_name;?>
                            </option>
                            <?php
                        //   }
                        //  }
                         ?>
                         </select>
                       </div> 
                   </div>
                  
                  
                </div>
               
                <div class="row">

              
                    <div class="col-md-2">
                  <div class="form-group">
                    <button style="margin-top: 25px; width: 100%;" class="btn btn-info btn-lg btn-block" type="submit">Search</button>
                  </div>
                  </div>
                  <div class="col-md-2">
                  <div class="form-group">
                    <a href="<?php // echo site_url('Users/vendor_dtl_list') ?>"><button style="margin-top: 25px; width: 100%;" class="btn btn-primary btn-lg btn-block" type="button">Reset</button></a>
                  </div> 
                  </div> 

                    

                  </div>


            </form>

                </div>
            </div>
        </div> -->
<!----------------------------row end above for filter--------->
        <!-- =====================Page Content======================= -->
        <!-- View Counselor Area Start -->
        <div class="row">
            <div class="col-md-12">
                <div class="page-box">
                    <div style="overflow-x: scroll;">
                        <div class="advance-table">
                            <table id="custom_tbl" class="my_custom_datatable table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Mobile No.</th>
                                        <th>Registration Date</th>
                                        <th>City</th>
                                        <th>Area</th>
                                        <th>Action</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i=1;
                                    if(!empty($mech_value)){
                                      foreach($mech_value as $value){
                                         $original_date =$value->m_vendor_added_on;
                                          $new_date = date("d-m-Y h:ia", strtotime($original_date));
                                      ?>
                                        <tr>
                                          <td><?php echo $i;?></td>
                                          <td><?php echo $value->m_vendor_name;?></td>
                                          <td><?php echo $value->m_vendor_mobile;?></td>
                                          <td><?php echo $new_date;?></td>
                                          <td><?php echo $value->m_city_name;?></td>
                                          <td><?php echo $value->m_vendor_area;?></td>
                                         
                                          <td class="wd-30">

                                            <a href="<?php echo base_url('Users/view_vendor_dtl?id=').$value->m_vendor_id; ?>" class="btn btn-info btn-action" title="View" data-toggle="tooltip"><i class="fa fa-eye" aria-hidden="true"></i></a> 
                                              <a href="<?php echo base_url('Users/add_vendor_dlt?id=').$value->m_vendor_id; ?>" class="btn btn-info btn-action" title="Edit" data-toggle="tooltip"><i class="fa fa-edit"></i></a> 
                                              
                                              <button class="btn btn-danger btn-action delete-vendor-data" data-value="<?php echo $value->m_vendor_id; ?>" title="Delete" data-toggle="tooltip"><i class="fa fa-trash"></i></button>
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
            </div>
       
        </div>
        <!-- View Counselor Area End -->
        <!-- ====================/Page Content======================= -->
        <!-- =========================View=================Fix======= -->
    </div>
</div>
<!-- ========================/View=================Fix======= -->
<!-- ========================Footer================Fix======= -->
<?php $this->view('top_footer'); $this->view('js/js_vendor');
  $this->view('js/custom_js');?>
<!-- =======================/Footer================Fix=======