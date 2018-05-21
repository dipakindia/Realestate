<!-- Theme JS files -->
<script type="text/javascript" src="<?php echo BASE_URLD; ?>assets/js/plugins/tables/datatables/datatables.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URLD; ?>assets/js/plugins/forms/selects/select2.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URLD; ?>assets/js/core/app.js"></script>
<script type="text/javascript" src="<?php echo BASE_URLD; ?>assets/js/pages/datatables_data_sources.js"></script>
<!-- /theme JS files -->
<!-- Main content -->

<div class="content-wrapper">
  <!-- Page header -->
  <div class="page-header page-header-default">
    <div class="page-header-content">
      <div class="page-title">
        <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - <?php echo ucfirst(str_replace("_"," ",$this->uri->segment(2)));?></h4>
      </div>
      <div class="heading-elements">
        <div class="heading-btn-group"> <a href="#" class="btn btn-link btn-float has-text"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a> <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a> <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a> </div>
      </div>
    </div>
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="<?=site_url('Dashboard');?>"><i class="icon-home2 position-left"></i> Home</a></li>
        <li class="active"><?php echo ucfirst(str_replace("_"," ",$this->uri->segment(2)));?></li>
      </ul>
      </li>
      </ul>
    </div>
  </div>
  <!-- /page header -->
  <!-- Content area -->
  <div class="content">
    <!-- HTML sourced data -->
    <div class="panel panel-flat">
      <div class="panel-heading">
        <h5 class="panel-title"><?php echo ucfirst(str_replace("_"," ",$this->uri->segment(2)));?></h5>
        <div class="heading-elements">
          <ul class="icons-list">
            <li><a data-action="collapse"></a></li>
            <li><a data-action="reload"></a></li>
            <li><a data-action="close"></a></li>
          </ul>
        </div>
      </div>
      <!-- <div class="panel-body">
					Basic example of a datatable with <code>HTML (DOM)</code> sourced data. The foundation for DataTables is progressive enhancement, so it is very adept at reading table information directly from the <code>DOM</code>. This example shows how easy it is to add searching, ordering and paging to your HTML table by simply running DataTables with basic configuration on it.
				</div> -->
      <table class="table datatable-html">
        <thead>
          <tr>
            <th>S No.</th>
            <th>User&nbsp;Name</th>
            <th>User&nbsp;Email</th>
            <th>User&nbsp;Contact</th>
            <th>Date</th>
            <th>Status</th>
            <th pclass="text-center">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php $a = 0; foreach($alldata as $data){ $a++; ?>
          <tr id="row_<?=$data->id;?>">
            <td><?=sprintf('%08d',$data->id);?></td>
            <td><?php if($data->profile_pic){ $img = $data->profile_pic; }else{$img = 'dummy.jpg';}
			?>
              <img id="Modal_<?=$data->id;?>" class="user_img"  style="border-radius:50%;" width="40" height="40" src="<?php echo BASE_URLD.'uploads/profile_pic/'.$img;?>">
              <div id="myModal_<?=$data->id;?>" class="modal myModal"> <span class="close">&times;</span> <img class="modal-content" src="<?php echo BASE_URLD.'uploads/profile_pic/'.$img;?>" id="img01"> </div>
         
              <?=ucfirst($data->first_name).' '.ucfirst($data->last_name);?></td>
            <td><?=$data->email_id;?></td>
            <td><?=$data->mobile;?></td>
            <?php /*?><td class="td-exp" style="width: 110px;"><?=$data->date_diff;?></td><?php */?>
            <td><?php echo $data->date;?></td>
            <td id="upbtn_<?=$data->id;?>"><?php if($data->status == '1'){ echo '<span title="Click to Inactive" class="label label-success" onclick="updateData('.$data->id.',0)">Active</span>'; }else{ echo '<span title="Click to Active" class="label label-default"  onclick="updateData('.$data->id.',1)">Inactive</span>'; }?></td>
            <td class="text-center"><ul class="icons-list">
                <li><a href="<?php echo site_url().'/dashboard/user_information/'.$data->id;?>" title="View Detail"><i class="icon-arrow-right16"></i></a><a href="javascript:void(0)" onClick="deleteData(<?=$data->id;?>)"><i class="icon-trash-alt"></i></a></li>
              </ul></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
    <!-- /HTML sourced data -->
  </div>
  <!-- /content area -->
</div>
<script>
	function deleteData(rid){
			var conf = confirm("Are you Sure do you to deleted this records");
			if(conf == true){
				var action = 'delete';
				var tblname = 'tbl_user_records';
				var key = 'id';
				$.ajax({
			type: "POST",
			url: "<?php echo site_url("Dashboard/delete_page"); ?>",
			data: 'action='+action+'&value='+rid+'&table_name='+tblname+'&key='+key, 
			cache: false,
			success: function(html) {
					//$('#result_data').html(html);
					//alert("Hii");
					$('#row_'+rid).remove();
			}
			});
				return true;
				}else{
				return false;	
					}
			}

$(document).ready(function(){
			$('a[data-action="close"]').click(function(){
				$(".black_overlay").hide();
			})
			$('span[data-action="merchant-form"]').click(function(){
				$(".black_overlay").show();
				$(".merchant-data-info-box").show();
			})
			$('.user_img').click(function(){
				var Dt = $(this).attr('id');
				//alert('#my'+Dt);
				$('#my'+Dt).show();
				});
				$('.close').click(function(){
					$(this).parent().hide();
				});

			})
				function updateData(rid,data){
			var conf = confirm("Are you Sure do you want to change the status");
			if(conf == true){
				var action = 'update';
				var tblname = 'tbl_user_records';
				var key = 'id';
				//[{"status":"'+data+'"}]
				//alert(data);
				var update_field = '{"status":"'+data+'"}';
				$.ajax({
			type: "POST",
			url: "<?php echo site_url("Dashboard/update_page"); ?>",
			data: 'action='+action+'&value='+rid+'&table_name='+tblname+'&key='+key+'&update_field='+update_field, 
			cache: false,
			success: function(html) {
					//$('#result_data').html(html);
					//alert(html)
					if(data == '1'){
					$('#upbtn_'+rid).html('<span title="Click to Inactive" class="label label-success" onclick="updateData('+rid+','+data+')">Active</span>');
					}else{
					$('#upbtn_'+rid).html('<span title="Click to Active" class="label label-default" onclick="updateData('+rid+','+data+')">Inactive</span>');
					}
			}
			});
				return true;
				}else{
				return false;	
					}
			}	

	</script>
	<div class="black_overlay"></div>
<div class="merchant-data-info-box">
  <div class="merchant-info-form">
    <div class="row">
      <div class="col-md-12">
        <!-- Basic layout-->
        <form class="form-horizontal" action="" method="post" id="AddLesson" enctype="multipart/form-data">
          <!-- <form action="" method="post" class="form-horizontal"> -->
          <div class="panel panel-flat">
          <div class="panel-heading">
            <h5 class="panel-title">Upgrade To Merchant Information:</h5>
            <div class="heading-elements">
              <ul class="icons-list">
               <!-- <li><a data-action="reload"></a></li>-->
                <li><a data-action="close"></a></li>
              </ul>
            </div>
          </div>
		   
          <div class="form-group">
            <div class="panel-body">
              <div class="col-lg-7">
                <div class="form-group">
                  <label class="control-label">Business Name:</label>
                  <input type="text" class="form-control" placeholder="Enter Business Name" name="business_name" value="" />
                </div>
              </div>
              <div class="col-lg-5">
                <div class="form-group">
                  <label class="control-label">Select City Id:</label>
                  <select name="state" class="form-control">
                    <option value="" >Select State</option>
					<?php 
					/*foreach($parent_data as $val){
					$str = '';
					echo '<option value="'.$val->state_id.'" '.$str.'>'.ucfirst($val->state_name).'</option>';
					}*/
					?>
                  </select>
                </div>
              </div>
              <div class="col-lg-12">
                <div class="form-group">
                  <label class="control-label">Select Category Id:</label>
                 <input type="file" class="file-input-custom" data-show-caption="true" name="place_image" data-show-upload="true" accept="image/*">
                </div>
				
              </div>
			  <div class="col-lg-6">
                <div class="form-group">
                  <label class="control-label">Latitude:</label>
                  <input type="text" class="form-control" placeholder="Enter Latitude" name="latitude" value="" />
                </div>
              </div>
			  <div class="col-lg-6">
                <div class="form-group">
                  <label class="control-label">Longitude:</label>
                  <input type="text" class="form-control" placeholder="Enter Longitude" name="longitude" value="" />
                </div>
              </div>
			  <div class="col-lg-6">
                <div class="form-group">
                  <label class="control-label">Select Status:</label>
                  <select name="status" class="form-control">
                    <option value="" >Select Status</option>
					<option value="1" >Active</option>
					<option value="0" >Inactive</option>
                  </select>
                </div>
              </div>
			  <div class="col-lg-12">
			  <label class="control-label">&nbsp;</label><br />
                  		<?php //isset($data->place_image)?'<img  width="50px" height="50" src="'.BASE_URLD.'uploads/place_images/'.$data->place_image.'">':''; ?>
                </div>
              <div class="col-lg-3 pull-right"><br /><br /><br />
                <div class="text-right">
                 <input type="submit" name="submit_place" class="btn btn-primary" value="Submit" />
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
    <!---->
  </div>
</div>
<style>
.merchant-data-info-box {
    left: 20%;
    position: fixed;
    top: 10%;
    width: 60%;
    z-index: 2147483647;display:none;
}
.black_overlay {
    background: #000 none repeat scroll 0 0;
    display: block;
    height: 100%;
    left: 0;
    opacity: 0.8;
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 99;
	display:none;
}
</style>