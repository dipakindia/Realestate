<!-- Theme JS files -->
	<script type="text/javascript" src="<?php echo BASE_URLD; ?>assets/js/plugins/loaders/pace.min.js"></script>
	<script type="text/javascript" src="<?php echo BASE_URLD; ?>assets/js/core/libraries/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo BASE_URLD; ?>assets/js/core/libraries/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo BASE_URLD; ?>assets/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script type="text/javascript" src="<?php echo BASE_URLD; ?>assets/js/plugins/notifications/jgrowl.min.js"></script>
	<script type="text/javascript" src="<?php echo BASE_URLD; ?>assets/js/plugins/ui/moment/moment.min.js"></script>
	<script type="text/javascript" src="<?php echo BASE_URLD; ?>assets/js/plugins/pickers/daterangepicker.js"></script>
	<script type="text/javascript" src="<?php echo BASE_URLD; ?>assets/js/plugins/pickers/anytime.min.js"></script>
	<script type="text/javascript" src="<?php echo BASE_URLD; ?>assets/js/core/app.js"></script>

	<script type="text/javascript" src="<?php echo BASE_URLD; ?>assets/js/plugins/pickers/pickadate/picker.js"></script>
	<script type="text/javascript" src="<?php echo BASE_URLD; ?>assets/js/plugins/pickers/pickadate/picker.date.js"></script>
	<script type="text/javascript" src="<?php echo BASE_URLD; ?>assets/js/plugins/pickers/pickadate/picker.time.js"></script>
	<script type="text/javascript" src="<?php echo BASE_URLD; ?>assets/js/plugins/pickers/pickadate/legacy.js"></script>

	<script type="text/javascript" src="<?php echo BASE_URLD; ?>assets/js/pages/picker_date.js"></script>
	<!-- /theme JS files -->
<!-- Main content -->
<?php 
//echo print_r($offer_info);
//exit;
$info = getofferSponsered($this->uri->segment(3));

/*echo '<pre>';
print_r($info);
echo '</pre>';
exit;*/
?>
<div class="content-wrapper">
  <!-- Page header -->
  <div class="page-header page-header-default">
    <div class="page-header-content">
      <div class="page-title">
        <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - Offer Info</h4>
      </div>
      <div class="heading-elements">
        <div class="heading-btn-group"> <a href="#" class="btn btn-link btn-float has-text"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a> <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a> <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a> </div>
      </div>
    </div>
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="<?=site_url('Dashboard');?>"><i class="icon-home2 position-left"></i> Home</a></li>
        <li class="active">Offer Info</li>
		<li><?php echo ucfirst($info->title);?></li>
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
        <h5 class="panel-title">Offer Information</h5>
        <div class="heading-elements">
          <ul class="icons-list">
            <li><a data-action="collapse"></a></li>
            <li><a data-action="reload"></a></li>
            <li><a data-action="close"></a></li>
          </ul>
        </div>
      </div>
<table width="95%" border="0" class="merchant-data-info" cellpadding="5" cellspacing="5">
  <tr>
    <td><strong>Offter Title: </strong></td>
<td><?php echo $info->title;?></td>
  </tr>
  <tr>
    <td><strong>Start date:</strong></td>
<td><?php echo $info->start_date; ?></td>
  </tr>
  <tr>
    <td><strong>End Date:</strong></td>
<td><?php echo $info->end_date; ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
<td><a href="javascript:void()" class="label label-success" onclick="openPopUp()" ><?php if($info->start_date == '' && $info->end_date == ''){ echo "Make"; }else{ echo "Update"; };?> Recomonded</a></td>
  </tr>


</table>
      <br /><br />
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
function getLocalityData(rid){
alert(rid);
	var action = 'delete';
	var tblname = 'tbl_locality';
	var key = 'city_id';
	$.ajax({
	type: "POST",
	url: "<?php echo site_url("Dashboard/get_data"); ?>",
	data: 'action='+action+'&value='+rid+'&table_name='+tblname+'&key='+key, 
	cache: false,
	success: function(html) {
	var response = '['+html+']';
	var obj = jQuery.parseJSON(response);
	var otnData = '';
	$.each(obj, function(key,value) {
	  otnData = otnData+'<option value="'+value.id+'">'+value.name+'</option>';
	});
	$('#loc_id').html(otnData);
	}
	});
	return true;
}
function openPopUp(){
	$(".black_overlay").show();
				$(".merchant-data-info-box").show();
}
function closePopUp(){
	$(".black_overlay").hide();
				$(".merchant-data-info-box").hide();
}
$(document).ready(function(){
			$('a[data-action="close"]').click(function(){
				$(".black_overlay").hide();
				$(".merchant-data-info-box").hide();
			})
			$('a[data-action="merchant-form"]').click(function(){
				alert("dfhcghjk");
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
				

	</script>
	<div class="black_overlay"></div>
<div class="merchant-data-info-box">
  <div class="merchant-info-form">
    <div class="row">
      <div class="col-md-12">
        <!-- Basic layout-->
        <form class="form-horizontal" action="<?php echo site_url("Dashboard/add_offer_sponsered"); ?>" method="post" id="AddLesson" enctype="multipart/form-data">
          <!-- <form action="" method="post" class="form-horizontal"> -->
		  <input type="hidden" name="offer_id" value="<?php echo $this->uri->segment(3); ?>"/>
          <div class="panel panel-flat">
          <div class="panel-heading">
            <h5 class="panel-title">Add Snonsered Information:</h5>
            <div class="heading-elements">
              <ul class="icons-list">
               <!-- <li><a data-action="reload"></a></li>-->
                <li><a data-action="close" onclick="closePopUp()"></a></li>
              </ul>
            </div>
          </div>
		   
          <div class="form-group">
            <div class="panel-body">
			  <div class="col-lg-5">
                <div class="form-group">
                  <label class="control-label">Start Date:</label>
                  <input type="text" class="form-control daterange-single" placeholder="Enter Start Date: DD-MM-YYYY" id="datepicker" name="start_date" value="<?php echo $info->latitude;?>" />
                </div>
              </div>
			  <div class="col-lg-5">
                <div class="form-group">
                  <label class="control-label">End Date:</label>
                  <input type="text" class="form-control daterange-single" placeholder="Enter End Date: DD-MM-YYYY" name="end_date" value="<?php echo $info->longitude;?>" />
                </div>
              </div>
              <div class="col-lg-2 pull-right"><label class="control-label">&nbsp;</label>
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
<script>
function updateData(rid,data){
	var action = 'update';
	var tblname = 'tbl_offer_sponsered_records';
	var key = 'id';
	var update_field = '{"is_merchant":"'+data+'"}';
	$.ajax({
		type: "POST",
		url: "<?php echo site_url("Dashboard/update_page"); ?>",
		data: 'action='+action+'&value='+rid+'&table_name='+tblname+'&key='+key+'&update_field='+update_field, 
		cache: false,
		success: function(html) {
		//$('#result_data').html(html)
		$('#upbtn_'+rid).html('<span class="label label-success" >Verified</span>');
		}
	});
	return true;
}	
</script>
<style>
.merchant-data-info td {
    padding: 5px;
}
.profile-pic img {
    border: 1px solid #ddd;
    border-radius: 50%;
    box-shadow: 0 0 5px #000;
    margin: 50px;
}
td[valign="middle"] label {
    margin: 0;
}
table.merchant-data-info {
    margin-left: 25px;
}
.merchant-data-info td:first-child {
    background: #ddd none repeat scroll 0 0;
    border: 1px solid #ddd;
    width: 20%;
}
.merchant-data-info td:nth-child(2) {
    background: #fff none repeat scroll 0 0;
    border: 1px solid #ddd;
    width: 80%;
}
.merchant-data-info-box {
    left: 20%;
    position: fixed;
    top: 10%;
    width: 60%;
    z-index: 99;display:none;
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