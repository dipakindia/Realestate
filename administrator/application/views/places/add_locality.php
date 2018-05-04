<!-- Theme JS files -->
<?php 
/*echo '<pre>';
print_r($data);
exit;*/
?>
<script type="text/javascript" src="<?php echo BASE_URLD; ?>assets/js/plugins/uploaders/fileinput.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URLD; ?>assets/js/plugins/tables/datatables/datatables.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URLD; ?>assets/js/plugins/forms/selects/select2.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URLD; ?>assets/js/core/app.js"></script>
<script type="text/javascript" src="<?php echo BASE_URLD; ?>assets/js/pages/datatables_data_sources.js"></script>
<script type="text/javascript" src="<?php echo BASE_URLD; ?>assets/js/pages/uploader_bootstrap.js"></script>
<!-- /theme JS files -->
<!-- Main content -->

<div class="content-wrapper">
  <!-- Page header -->
  <div class="page-header page-header-default">
    <div class="page-header-content">
      <div class="page-title">
        <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - Add Locality</h4>
      </div>
      <div class="heading-elements">
        <div class="heading-btn-group"> <a href="#" class="btn btn-link btn-float has-text"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a> <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a> <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a> </div>
      </div>
    </div>
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="<?=site_url('Dashboard');?>"><i class="icon-home2 position-left"></i> Home</a></li>
        <li class="active"> Add Locality</li>
      </ul>
      </li>
      </ul>
    </div>
  </div>
  <!-- /page header -->
  <div class="content">
    <!-- Horizontal form options -->
    <div class="row">
      <div class="col-md-7">
        <!-- Basic layout-->
				 
        <form class="form-horizontal" action="" method="post" id="AddLesson" enctype="multipart/form-data">
          <!-- <form action="" method="post" class="form-horizontal"> -->
          <div class="panel panel-flat">
          <div class="panel-heading">
            <h5 class="panel-title">Add Place Locality</h5>
            <div class="heading-elements">
              <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
                <li><a data-action="reload"></a></li>
                <li><a data-action="close"></a></li>
              </ul>
            </div>
          </div>
		   <?php if (validation_errors()) : ?>
			<div class="col-md-12">
				<div class="alert alert-danger" role="alert">
					<?=validation_errors(); ?>
				</div>
			</div>
		<?php endif; ?>
		<?php if (isset($error)) : ?>
			<div class="col-md-12">
				<div class="alert alert-danger" role="alert">
					<?=$error;?>
				</div>
			</div>
		<?php endif; ?>
		<?php if (isset($success)) : ?>
			<div class="col-md-12">
				<div class="alert alert-success" role="alert">
					<?=$error;?>
				</div>
			</div>
		<?php endif; ?>
          <div class="form-group">
            <div class="panel-body">
              <div class="col-lg-7">
                <div class="form-group">
                  <label class="control-label">Locality Name:</label>
                  <input type="text" class="form-control" placeholder="Enter Locality Name" name="locality_name" value="" />
                </div>
              </div>
              <div class="col-lg-5">
                <div class="form-group">
                  <label class="control-label">Select City:</label>
                  <select name="city" class="form-control">
                    <option value="" >Select State</option>
					<?php 
					foreach($parent_data as $val){
					$str = '';
					echo '<option value="'.$val->id.'" '.$str.'>'.ucfirst($val->city_name).'</option>';
					}
					?>
                  </select>
                </div>
              </div>
              <!--<div class="col-lg-12">
                <div class="form-group">
                  <label class="control-label">Place Icon:</label>
                 <input type="file" class="file-input-custom" data-show-caption="true" name="place_image" data-show-upload="true" accept="image/*">
                </div>
				
              </div>-->
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
                  		<?php isset($data->place_image)?'<img  width="50px" height="50" src="'.BASE_URLD.'uploads/place_images/'.$data->place_image.'">':''; ?>
                </div>
              <div class="col-lg-3 pull-right"><br /><br /><br />
                <div class="text-right">
                 <input type="submit" name="submit_place" class="btn btn-primary" value="Submit" />
                </div>
              </div>
            </div>
          </div>
        </form>
        <!-- /basic layout -->
      </div>
    </div>
  </div>
  <!-- /vertical form options -->
  <!-- Content area -->
</div>
<!-- /content area -->
</div>
<script>
	function deleteData(rid){
			var conf = confirm("Are you Sure do you to deleted this records");
			if(conf == true){
				var action = 'delete';
				var tblname = 'tbl_category_records';
				var key = 'category_id';
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
				var tblname = 'tbl_category_records';
				var key = 'category_id';
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
