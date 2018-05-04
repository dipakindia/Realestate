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
<style>
.myFormdata {
    background: #fff none repeat scroll 0 0;
    height: 400px;
    margin: 0 auto;
    padding: 20px;
    width: 400px;
}
</style>
<!-- /theme JS files -->
<!-- Main content -->

<div class="content-wrapper">
  <!-- Page header -->
  <div class="page-header page-header-default">
    <div class="page-header-content">
      <div class="page-title">
        <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - Email Notifiaction</h4>
      </div>
      <div class="heading-elements">
        <div class="heading-btn-group"> <a href="#" class="btn btn-link btn-float has-text"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a> <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a> <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a> </div>
      </div>
    </div>
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="<?=site_url('Dashboard');?>"><i class="icon-home2 position-left"></i> Home</a></li>
        <li class="active">Email Notifiaction</li>
      </ul>
      </li>
      </ul>
    </div>
  </div>
  <!-- /page header -->
  <div class="content">
    <!-- Horizontal form options -->
    <div class="row">
      <div class="col-md-12">
        <!-- Basic layout-->
        <form class="form-horizontal" action="" method="post" id="AddLesson" enctype="multipart/form-data">
          <!-- <form action="" method="post" class="form-horizontal"> -->
          <div class="panel panel-flat">
          <div class="panel-heading">
            <h5 class="panel-title">Send Notification</h5>
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
          <?php endif; ?>
          <div class="form-group">
           
            <div class="panel-body">
              <div class="col-lg-3">
                <div class="form-group">
                  <label class="control-label">Select whom to send:</label>
                  <select name="select_users_type" id="select_users_type" class="form-control">
                    <option value="all" >All Users</option>
                    <option value="multiple_users" >Multiple Users</option>
                  </select>
                </div>
              </div>
              <div class="col-lg-3">
                <div class="form-group">
                  <label class="control-label">Email Type:</label>
                  <select name="email_type" id="email_type" class="form-control">
                    <option value="image" >Image</option>
                    <option value="text" >Text</option>
                    <option value="text_image" >Text and Image</option>
                  </select>
                </div>
              </div>
              <div class="col-lg-2 pull-right">
                <div class="form-group">
                  <label class="control-label">&nbsp;</label>
                  <br />
                  <input type="button" id="show_popup" name="show_popup" class="btn btn-primary" value="Submit" />
                </div>
              </div>
              <div id="form_page_model" class="modal myModal"> <span class="close">&times;</span>
			  <div class="myFormdata">
                <div class="col-lg-12">
                  <div class="form-group">
                    <label class="control-label">Subject:</label>
                    <input type="text" class="form-control" name="subject" />
                  </div>
                </div>
				<div class="col-lg-12">
                  <div class="form-group">
                    <label class="control-label">Mail Image:</label>
                    <input type="file" class="" name="image" />
                  </div>
                </div>
				<div class="col-lg-12">
                  <div class="form-group">
                    <label class="control-label">Subject:</label>
                    <textarea name="body_text" class="form-control" rows="6" ></textarea>
                  </div>
                </div>
				<div class="col-lg-12">
                  <div class="form-group">
                    <label class="control-label">&nbsp;</label><br />
                    <input type="submit" class="btn btn-primary" name="submit_email" style="padding:7px 30px;" value="Send" />
                  </div>
                </div>
				</div>
              </div>
              <div class="col-lg-12" id="multiple-users">
                <table class="table datatable-html">
                  <thead>
                    <tr>
                      <th><input type="checkbox" name="all" id="all" /></th>
                      <th>Sr No.</th>
                      <th>User&nbsp;Name</th>
                      <th>User&nbsp;Email</th>
                      <th>User&nbsp;Contact</th>
                      <th>User&nbsp;Location</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $a = 0; foreach($alldata as $data){ $a++; ?>
                    <tr id="row_<?=$data->id;?>">
                      <td><input type="checkbox" name="user_ids[]" class="check_user" value="<?=$data->id;?>" id="usr_<?=$data->id;?>" /></td>
                      <td><?=$a;?></td>
                      <td><?php if($data->profile_pic!=''){?>
                        <img style="border-radius:50%;" id="Modal_<?=$data->id;?>" class="user_img"  width="25" height="25" src="<?php echo BASE_URLD; ?>timthumb.php?src=<?php echo BASE_URLD.'uploads/profile_pic/'.$data->profile_pic;?>&w=25&h=25">
                        <?php }?>
                        &nbsp;
                        <?=ucfirst($data->first_name).' '.$data->last_name;?></td>
                      <td><?=$data->email_id;?></td>
                      <td><?=$data->mobile;?></td>
                      <td></td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </form>
        <!-- /basic layout -->
      </div>
    </div>
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
$('#show_popup').click(function(){
	$('#form_page_model').show();
	$('.close').click(function(){
		$(this).parent().hide();
	});
});
$('#all').click(function(){
  if($(this).is(':checked')){
    $('.check_user').prop('checked',true);
  }else{
    $('.check_user').prop('checked',false);
  }
});
$('#multiple-users').hide();
   $('#select_users_type').change(function(){
     if($(this).val()=='multiple_users'){
      //alert('sbddjk');
       $('#multiple-users').show();
     } else {
       $('#multiple-users').hide();
     }
   });
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
