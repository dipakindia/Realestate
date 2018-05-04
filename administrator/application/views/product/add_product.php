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
        <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - Add Product</h4>
      </div>
      <div class="heading-elements">
        <div class="heading-btn-group"> <a href="#" class="btn btn-link btn-float has-text"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a> <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a> <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a> </div>
      </div>
    </div>
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="<?=site_url('Dashboard');?>"><i class="icon-home2 position-left"></i> Home</a></li>
        <li class="active">Add Product</li>
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
				 
        <form class="form-horizontal" action="" method="post" id="" enctype="multipart/form-data">
          <!-- <form action="" method="post" class="form-horizontal"> -->
          <div class="panel panel-flat">
          <div class="panel-heading">
            <h5 class="panel-title">Add Product</h5>
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
					<?= validation_errors() ?>
				</div>
			</div>
		<?php endif; ?>
		<?php if (isset($error)) : ?>
			<div class="col-md-12">
				<div class="alert alert-danger" role="alert">
					<?= $error ?>
				</div>
			</div>
		<?php endif; ?>
		<?php if (isset($success)) : ?>
			<div class="col-md-12">
				<div class="alert alert-success" role="alert">
					<?= $success ?>
				</div>
			</div>
		<?php endif; 
		//print_r($merchant_info->category_ids);
		
		?>
          <div class="form-group">
            <input type="hidden" value="<?php echo $merchant_info->id; ?>" name="user_id" >
			<input type="hidden" value="<?php echo $merchant_info->latitude; ?>" name="latitude" >
			<input type="hidden" value="<?php echo $merchant_info->longitude; ?>" name="longitude" >
            <div class="panel-body">
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="control-label">Product Name:</label>
                  <input type="text" class="form-control" placeholder="Enter Product Name" name="product_name" value="<?php echo isset($data->category_name)?$data->category_name:''; ?>" />
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="control-label">Select Category:</label>
                  <select name="category_name" class="form-control">
                    <option value="" >Select Category</option>
					<?php 
					foreach($parent_data as $val){
					$str = '';
					if($val->category_id == $data->parent_id){ $str = 'selected="selected"';}
					if(in_array($val->category_id,explode(",",$merchant_info->category_ids))){
					echo '<option value="'.$val->category_id.'" '.$str.'>'.ucfirst($val->category_name).'</option>';
					}
					}
					?>
                  </select>
                </div>
              </div>
			   <div class="col-lg-6">
                <div class="form-group">
                  <label class="control-label">Select Sub Category:</label>
                  <select name="sub_category_name" class="form-control">
                    <option value="" >Select Sub Category</option>
					<?php 
					foreach($parent_data as $val){
					$str = '';
					if($val->category_id == $data->parent_id){ $str = 'selected="selected"';}
					if(in_array($val->category_id,explode(",",$merchant_info->Subcategory_ids))){
					echo '<option value="'.$val->category_id.'" '.$str.'>'.ucfirst($val->category_name).'</option>';
					}
					}
					?>
                  </select>
                </div>
              </div>
			  <div class="col-lg-6">
                <div class="form-group">
                  <label class="control-label">Select Child Category:</label>
                  <select name="child_category_name" class="form-control">
                    <option value="" >Select Child Category</option>
					<?php 
					foreach($parent_data as $val){
					$str = '';
					if($val->category_id == $data->parent_id){ $str = 'selected="selected"';}
					if(in_array($val->parent_id,explode(",",$merchant_info->Subcategory_ids))){
					echo '<option value="'.$val->category_id.'" '.$str.'>'.ucfirst($val->category_name).'</option>';
					}
					}
					?>
                  </select>
                </div>
              </div>
			   <div class="col-lg-6">
                <div class="form-group">
                  <label class="control-label">Price:</label>
                  <input type="text" class="form-control" placeholder="Enter Price" name="price" value="" />
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="control-label">Discount Price:</label>
                  <input type="text" class="form-control" placeholder="Enter Discount Price" name="discount_price" value="" />
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
			  <div class="col-lg-6">
                <div class="form-group">
                  <label class="control-label">Select Images:</label>
                  <input type="file" name="product_image[]" value="" multiple="multiple" />
                </div>
              </div>
              <div class="col-lg-12">
                <div class="form-group">
                  <label class="control-label">Product Description:</label>
                  <textarea  maxlength="100" class="form-control" name="product_desc" placeholder="Enter your Product Description here" ></textarea>
                </div>
              </div>
			  <div class="col-lg-12">
              <div class="col-lg-3 pull-right"><br /><br /><br />
                <div class="text-right">
                  <input type="submit" name="submit_product" class="btn btn-primary" value="Submit" />
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
