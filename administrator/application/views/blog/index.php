
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
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - Blogs</h4>
          </div>
          <div class="heading-elements">
            <div class="heading-btn-group"> <a href="#" class="btn btn-link btn-float has-text"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a> <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a> <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a> </div>
          </div>
        </div>
        <div class="breadcrumb-line">
          <ul class="breadcrumb">
            <li><a href="<?=site_url('Dashboard');?>"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="active">Blogs</li>
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
					<h5 class="panel-title">Blogs</h5>
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
							<th>Sr No.</th>
							<th>Blog&nbsp;Title</th>
							<th>Blog&nbsp;Image</th>
							<th>Date</th>
							<th>Status</th>
							<th pclass="text-center">Actions</th>
						</tr>
					</thead>
					<tbody>
					<?php $a = 0; foreach($alldata as $data){ $a++; ?>
						<tr id="row_<?=$data->blog_id;?>">
							<td><?=$a;?></td>
							<td><?=$data->blog_title;?></td>
						   <td> <?php if($data->blog_photo!=''){?>
	
							<img id="Modal_<?=$data->blog_id;?>" class="user_img"  width="40" height="40" src="<?php echo BASE_URLD; ?>timthumb.php?src=<?php echo BASE_URLD.'uploads/blog_photo/'.$data->blog_photo;?>&w=40&h=40">
	
							 <div id="myModal_<?=$data->blog_id;?>" class="modal myModal"> <span class="close">&times;</span> <img class="modal-content" src="<?php echo BASE_URLD.'uploads/blog_photo/'.$data->blog_photo;?>" id="img01"> </div>
	
						   <?php }?></td>					              
							<td class="td-exp" style="width: 110px;"><?=$data->added_date;?></td>
							<td id="upbtn_<?=$data->blog_id;?>"><?php if($data->status == '1'){ echo '<span title="Click to Inactive" class="label label-success" onclick="updateData('.$data->blog_id.',0)">Active</span>'; }else{ echo '<span title="Click to Active" class="label label-default"  onclick="updateData('.$data->blog_id.',1)">Inactive</span>'; }?></td>
							<td class="text-center">
								<ul class="icons-list">
									<li><a href="javascript:void(0)" onClick="deleteData(<?=$data->blog_id;?>)"><i class="icon-trash-alt"></i></a></li>
								</ul>
							</td>
						
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
				var tblname = 'tbl_blog_records';
				var key = 'blog_id';
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
				var tblname = 'tbl_blog_records';
				var key = 'blog_id';
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