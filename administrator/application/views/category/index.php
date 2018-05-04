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
        <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - Categories</h4>
      </div>
      <div class="heading-elements">
        <div class="heading-btn-group"> <a href="#" class="btn btn-link btn-float has-text"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a> <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a> <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a> </div>
      </div>
    </div>
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="<?=site_url('Dashboard');?>"><i class="icon-home2 position-left"></i> Home</a></li>
        <li class="active">Category</li>
      </ul>
      </li>
      </ul>
    </div>
  </div>
  <!-- /page header -->
  <div class="content">
  <!-- Content area -->
  <!-- HTML sourced data -->
  <div class="panel panel-flat">
    <div class="panel-heading">
      <h5 class="panel-title">Category Records</h5>
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
          <th>S.No.</th>
          <th>Category&nbsp;Name</th>
          <th>Parent&nbsp;Name</th>
          <!--<th>Category&nbsp;Description</th>-->
          <th>Category&nbsp;Icon</th>
          <th>Date</th>
          <th>Status</th>
		  <th>Sort</th>
          <th pclass="text-center">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php $a = 0; foreach($alldata as $data1){ $a++; ?>
        <tr id="row_<?=$data1->category_id;?>">
          <td><?=$a;?></td>
          <td><?=$data1->category_name;?></td>
          <td><?php if($data1->parent_id == 0){ echo 'Parent Category'; }else{ echo ucfirst(getCategoryName($data1->parent_id)); } ?></td>
          <?php /*?><td><?=$data1->category_description;?></td><?php */?>
          <td><?php if($data1->category_image!=''){?>
            <img id="Modal_<?=$data1->category_id;?>" class="user_img"  width="40" height="40" src="<?php echo BASE_URLD.'uploads/category_images/'.$data1->category_image;?>">
            <div id="myModal_<?=$data1->category_id;?>" class="modal myModal"> <span class="close">&times;</span> <img class="modal-content" src="<?php echo BASE_URLD.'uploads/category_images/'.$data1->category_image;?>" id="img01"> </div>
            <?php }?></td>
          <td class="td-exp" style="width: 110px;"><?=$data1->added_date;?></td>
          <td id="upbtn_<?=$data1->category_id;?>"><?php if($data1->status == '1'){ echo '<span title="Click to Inactive" class="label label-success" onclick="updateData('.$data1->category_id.',0)">Active</span>'; }else{ echo '<span title="Click to Active" class="label label-default"  onclick="updateData('.$data1->category_id.',1)">Inactive</span>'; }?></td>
		   <td align="center">
		   
		   <select name="sort_by" onchange="sortBy('<?php echo $data1->category_id; ?>', this.value)">
		   <option value="">none</option>
		   <option <?php if($data1->sort_by == '1'){ echo 'selected="selected"'; } ?> value="1">1</option>
		   <option <?php if($data1->sort_by == '2'){ echo 'selected="selected"'; } ?> value="2">2</option>
		   <option <?php if($data1->sort_by == '3'){ echo 'selected="selected"'; } ?> value="3">3</option>
		   <option value="4" <?php if($data1->sort_by == '4'){ echo 'selected="selected"'; } ?> >4</option>
		   <option value="5" <?php if($data1->sort_by == '5'){ echo 'selected="selected"'; } ?>>5</option>
		   <option value="6" <?php if($data1->sort_by == '6'){ echo 'selected="selected"'; } ?>>6</option>
		   <option value="7" <?php if($data1->sort_by == '7'){ echo 'selected="selected"'; } ?>>7</option>
		   <option value="8" <?php if($data1->sort_by == '8'){ echo 'selected="selected"'; } ?>>8</option>
		   <option value="9" <?php if($data1->sort_by == '9'){ echo 'selected="selected"'; } ?>>9</option>
		   </select></td>
          <td class="text-center"><ul class="icons-list">
              <li><a href="<?php echo site_url("Dashboard/edit_category").'/'.$data1->category_id;?>" ><i class="icon-pencil7"></i></a>&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" onClick="deleteData(<?=$data1->category_id;?>)"><i class="icon-trash-alt"></i></a></li>
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
function sortBy(rid,data){
	var conf = confirm("Are you Sure do you want to change the status");
	if(conf == true){
		var action = 'update';
		var tblname = 'tbl_category_records';
		var key = 'category_id';
		//[{"status":"'+data+'"}]
		//alert(data);
		var update_field = '{"sort_by":"'+data+'"}';
		$.ajax({
			type: "POST",
			url: "<?php echo site_url("Dashboard/update_page"); ?>",
			data: 'action='+action+'&value='+rid+'&table_name='+tblname+'&key='+key+'&update_field='+update_field, 
			cache: false,
			success: function(html) {
				alert("Successfully Added!");
			}
		});
		return true;
	}else{
		return false;	
	}
}	
	</script>
