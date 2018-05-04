
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
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - Contents</h4>
          </div>
          <div class="heading-elements">
            <div class="heading-btn-group"> <a href="#" class="btn btn-link btn-float has-text"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a> <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a> <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a> </div>
          </div>
        </div>
        <div class="breadcrumb-line">
          <ul class="breadcrumb">
            <li><a href="<?=site_url('Dashboard');?>"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="active">Contents</li>
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
					<h5 class="panel-title">Contents</h5>
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
							<th>Page&nbsp;Title</th>
							<th>Page&nbsp;Slug</th>
							<th>Date</th>
							<th>Status</th>
							<th pclass="text-center">Actions</th>
						</tr>
					</thead>
					<tbody>
					<?php $a = 0; foreach($alldata as $data){ $a++; ?>
						<tr id="row_<?=$data->content_id;?>">
							<td><?=$a;?></td>
							<td><?=$data->content_title;?></td>		
							<td><?=$data->action;?></td>					              
							<td class="td-exp" style="width: 110px;"><?=$data->added_date;?></td>
							<td id="upbtn_<?=$data->content_id;?>"><?php if($data->status == '1'){ echo '<span title="Click to Inactive" class="label label-success" onclick="updateData('.$data->content_id.',0)">Active</span>'; }else{ echo '<span title="Click to Active" class="label label-default"  onclick="updateData('.$data->content_id.',1)">Inactive</span>'; }?></td>
							<td class="text-center">
								<ul class="icons-list">
									<li><a href="<?php echo site_url("Dashboard/edit_content").'/'.$data->content_id;?>" ><i class="icon-pencil7"></i></a>&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" onClick="deleteData(<?=$data->content_id;?>)"><i class="icon-trash-alt"></i></a></li>
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
				var tblname = 'tbl_content_records';
				var key = 'content_id';
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
				var tblname = 'tbl_content_records';
				var key = 'content_id';
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