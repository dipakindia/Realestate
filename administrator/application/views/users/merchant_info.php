<!-- Theme JS files -->
<script type="text/javascript" src="<?php echo BASE_URLD; ?>assets/js/core/libraries/jasny_bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URLD; ?>assets/js/plugins/forms/editable/editable.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URLD; ?>assets/js/plugins/extensions/mockjax.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URLD; ?>assets/js/plugins/forms/editable/address.js"></script>
<script type="text/javascript" src="<?php echo BASE_URLD; ?>assets/js/plugins/ui/moment/moment.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URLD; ?>assets/js/plugins/forms/styling/switchery.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URLD; ?>assets/js/plugins/forms/styling/uniform.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URLD; ?>assets/js/plugins/forms/selects/select2.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URLD; ?>assets/js/plugins/forms/inputs/autosize.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URLD; ?>assets/js/plugins/forms/inputs/typeahead/typeahead.bundle.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URLD; ?>assets/js/plugins/forms/tags/tagsinput.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URLD; ?>assets/js/plugins/forms/inputs/touchspin.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URLD; ?>assets/js/plugins/forms/inputs/formatter.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URLD; ?>assets/js/core/app.js"></script>
<script type="text/javascript" src="<?php echo BASE_URLD; ?>assets/js/pages/form_editable.js"></script>
<!-- /theme JS files -->
<!-- Main content -->
<?php 



$info = $data['user_info'];



/*echo '<pre>';

print_r($dt);

echo '</pre>';

echo $tbl_filters;

exit;*/

?>

<div class="content-wrapper">
  <!-- Page header -->
  <div class="page-header page-header-default">
    <div class="page-header-content">
      <div class="page-title">
        <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - Merchant Info</h4>
      </div>
      <div class="heading-elements">
        <div class="heading-btn-group"> <a href="#" class="btn btn-link btn-float has-text"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a> <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a> <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a> </div>
      </div>
    </div>
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="<?=site_url('Dashboard');?>"><i class="icon-home2 position-left"></i> Home</a></li>
        <li class="active">Merchant Info</li>
        <li><?php echo ucfirst($info->first_name).' '.$info->last_name;?></li>
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
        <h5 class="panel-title">Merchant Information</h5>
        <div class="heading-elements">
          <ul class="icons-list">
            <li><a data-action="collapse"></a></li>
            <li><a data-action="reload"></a></li>
            <li><a data-action="close"></a></li>
          </ul>
        </div>
      </div>
      <form action="<?php echo site_url('Dashboard/submit_merchant_info')?>" method="post" enctype="multipart/form-data" >
        <input type="hidden" name="user_id" value="<?php echo $info->id; ?>" />
        <table width="95%" border="0" class="merchant-data-info" cellpadding="5" cellspacing="5">
          <tr>
            <td colspan="3" style="background:url('<?php echo BASE_URLD.'uploads/cover_pic/'.$info->cover_pic;?>'); background-size:100%; height:200px;"><div class="profile-pic">
                <?php if($info->profile_pic!=''){ $img = $info->profile_pic; }else{$img = 'dummy.jpg';} ?>
                <img src="<?php echo BASE_URLD.'uploads/profile_pic/'.$img;?>" width="100" height="100" align="" /></div></td>
          </tr>
          <tr>
            <td><strong>Name: </strong></td>
            <td id="first_name"><a href="#" id="text-field" data-type="text" data-inputclass="form-control" data-pk="1" data-title="Name"><?php echo ucfirst($info->first_name);?></a></td>
          </tr>
          <tr>
            <td><strong>Email:</strong></td>
            <td><?php echo $info->email_id; ?></td>
          </tr>
          <tr>
            <td><strong>Phone:</strong></td>
            <td><?php echo $info->mobile; ?></td>
          </tr>
          <tr>
            <td><strong>Address:</strong></td>
            <td id="address"><a href="#" id="textarea" data-type="textarea" data-pk="1" data-inputclass="form-control" data-placeholder="Your Address here..." data-title="Enter Address"><?php echo $info->address; ?></a></td>
          </tr>
          <tr>
            <td><strong>Phone Verified:</strong></td>
            <td valign="middle"><?php if($info->phone_verified=='1'){echo '<label class="label label-success">Yes<label>'; }else{echo '<label class="label label-danger">No	<label>';}?></td>
          </tr>
          <tr>
            <td><strong>Email Verified:</strong></td>
            <td valign="middle"><?php if($info->phone_verified=='1'){echo '<label class="label label-success">Yes<label>'; }else{echo '<label class="label label-danger">No<label>';}?></td>
          </tr>
          <tr>
            <td><strong>Date of Birth:</strong></td>
            <td id="date_of_birth"><a href="#" id="input-formatter" data-type="text" data-inputclass="form-control" data-pk="1" data-title="Date of Birth"><?php echo date("d/m/Y",strtotime($info->date_of_birth)); ?></a> </td>
          </tr>
          <tr>
            <td><strong>Change Cover Image:</strong></td>
            <td><input type="file" name="cover_pic" />
            </td>
          </tr>
          <tr>
            <td><strong>Change Profile Image:</strong></td>
            <td><input type="file" name="profile_pic" />
            </td>
          </tr>
          <?php if($info->is_merchant!=0){?>
          <tr>
            <td><strong>Business Name:</strong></td>
            <td id="business_name"><a href="#" id="type-time" data-type="text" data-inputclass="form-control" data-pk="1" data-title="Business Name"><?php echo $info->business_name; ?></a></td>
          </tr>
          <tr>
            <td><strong>Office Address:</strong></td>
            <td id="office_address"><a href="#" id="textarea-elastic" data-type="textarea" data-pk="1" data-inputclass="form-control" data-placeholder="Your Address here..." data-title="Enter Office Address"><?php echo $info->office_address; ?></a></td>
          </tr>
          <tr>
            <td><strong>Per year sale:</strong></td>
            <td id="peryear_sale"><a href="#" id="input-touchspin-basic" data-type="text" data-inputclass="form-control" data-pk="1" data-title="Per year sale"><?php echo $info->peryear_sale; ?></a></td>
          </tr>
		  <tr>
            <td><strong>Offer Limit:</strong></td>
            <td id="offer_limit"><a href="#" id="input-offer_limit" data-type="text" data-inputclass="form-control" data-pk="1" data-title="Add Offer Limit"><?php echo $info->offer_limit; ?></a></td>
          </tr>
          <tr>
            <td><strong>Office email:</strong></td>
            <td id="office_email"><a href="#" id="type-email-office" data-type="email" data-inputclass="form-control" data-pk="1" data-title="Office Email"><?php echo $info->office_email; ?></a></td>
          </tr>
          <tr>
            <td><strong>Office phone:</strong></td>
            <td id="office_phone"><a href="#" id="type-tel-office" data-type="tel" data-inputclass="form-control" data-pk="1" data-title="Office Phone"><?php echo $info->office_phone; ?></a></td>
          </tr>
          <tr>
            <td><strong>City with Locality:</strong></td>
            <td><?php echo getCityWithLocalityName($info->Locality_ids); ?>(<?php echo $info->latitude; ?>, <?php echo $info->longitude; ?>) <span class="label label-default" data-action="merchant-form" title="Add Filter">+</span></td>
          </tr>
          <tr>
            <td><strong>Category with Sub Category:</strong></td>
            <td id="category_ids">
			<?php /*?><select name="category[]" id="ctData">
			<option value = "">Select Category</option>
			 <?php
			   $ctArray = explode(',',$info->category_ids);
			   //print_r($ctArray);
			   foreach($data['category_list'] as $val){
			   $sel = '';
				if($val->category_id == $info->category_ids){ $sel = 'selected="selected"';}
			   echo '<option value ="'.(int)$val->category_id.'" '.$sel.' >'.$val->category_name.'</option>'; 
			   }
			   ?>
			</select><?php */?>
			<input type="text" id="myInputCat" onKeyUp="myFunctionCat()" placeholder="Search for names..">
			   <ul id="myULCat">
			   <?php
			   $ctArray = explode(',',$info->category_ids);
			   //print_r($ctArray);
			   foreach($data['category_list'] as $val){
			   $sel = $textData = '';
			    if($val->parent_id == 0){ $classC ='parent'; }else{ $classC = 'sub-cat'; $textData = getCategoryName($val->parent_id).'>> '; }
				if(in_array($val->category_id,$ctArray)){ $sel = 'checked="checked"';}else{ $sel = ''; }
			   echo '<li class="'.$classC.'"><input type="checkbox" name="category[]" '.$sel.' value ="'.(int)$val->category_id.'" > <a>'.$textData.' '.$val->category_name.'</a></li>'; 
			   }
			   ?></ul>
			<br />
			<hr />
			<!--<a href="#" id="styled-checklist-cat" data-type="checklist" data-pk="1" data-value="<?php echo $info->category_ids; ?>" data-title="Select Category and Sub Category"></a>
               <span class="label label-default" title="Add Filter">+</span>-->
			   <input type="text" id="myInput" onKeyUp="myFunction()" placeholder="Search for names..">
			   <ul id="myUL">
			   <?php
			   /*$ctArray = explode(',',$info->category_ids);
			   //print_r($ctArray);
			   foreach($data['category_list'] as $val){
			   $sel = $textData = '';
			    if($val->parent_id == 0){ $classC ='parent'; }else{ $classC = 'sub-cat'; $textData = getCategoryName($val->parent_id).'>> '; }
				if(in_array($val->category_id,$ctArray)){ $sel = 'checked="checked"';}else{ $sel = ''; }
			   echo '<li class="'.$classC.'"><input type="checkbox" name="sub_category[]" '.$sel.' value ="'.(int)$val->category_id.'" > <a>'.$textData.' '.$val->category_name.'</a></li>'; 
			   }*/
			   ?></ul>
			   <strong>Selected Categories : <?php echo getCategoryName($info->category_ids);?></strong>
			   <ul>
			   <?php
			   $ctArray = explode(',',$info->Subcategory_ids);
			   //print_r($ctArray);
			   foreach($data['sub_category_list'] as $val){
			   $sel = $textData = '';
			    if($val->parent_id == 0){ $classC ='parent'; }else{ $classC = 'sub-cat';  }
				$textData = getCategoryName($val->parent_id).'>> ';
				if(in_array($val->category_id,$ctArray)){ 
				
			   echo '<li class="'.$classC.'"><a>'.$textData.' '.$val->category_name.'</a></li>'; 
			   }
			   }
			   ?></ul>
			   </td>
          </tr>
          <tr>
            <td><strong>Filters:</strong></td>
            <td id="Filter_ids" ><a href="#" id="styled-checklist" data-type="checklist" data-pk="1" data-value="<?php echo $info->Filter_ids; ?>" data-title="Select Filters"></a>
              <!--<span class="label label-default" title="Add Filter">+</span>--></td>
          </tr>
          <tr>
            <td><strong>Verified Merchant:</strong></td>
            <td valign="middle"><?php if($info->verify_merchant=='1'){echo '<label class="label label-success">Yes<label>'; }else{echo '<label class="label label-danger">No<label>';}?></td>
          </tr>
          <tr>
            <td></td>
            <td id="upbtn_<?=$info->id;?>"><?php if($info->is_merchant=='1'){?>
              <span class="label label-success" >Verified</span>
              <?php }else{?>
              <span title="Click to Verify" class="label label-success" onclick="updateData('<?=$info->id;?>','1')">Verify</span>
              <?php } ?>
			  &nbsp;&nbsp;<span title="Click to Verify" class="label label-success" id="add_rec_list" data-val="1" >Add to Recommonded List</span>
			  &nbsp;&nbsp;<a title="Add Product" href="<?php echo site_url('Dashboard/add_product/'.$info->id); ?>" target="_blank" class="label label-success">Add Product</a>
			  </td>
          </tr>
          <?php } ?>
          <tr>
            <td></td>
            <td><input type="submit" name="submit_merchant" value="Save Merchant Info" /></td>
          </tr>
        </table>
      </form>
      <?php 

$catStr = $str = '';

foreach($data['tbl_filters'] as $val){

$str.= "{value:".(int)$val->id.", text: '".$val->Name."'},"; 

}

?>
      <div id="filter_data" class="hide">[<?php echo rtrim($str,','); ?>]</div>
      <?php 

foreach($data['category_list'] as $val){

$catStr.= "{value:".(int)$val->category_id.", text: '".$val->category_name."'},"; 

}

?>
      <div id="cat_data" class="hide">[<?php echo rtrim($catStr,','); ?>]</div>
      <br />
      <br />
    </div>
    <!-- /HTML sourced data -->
  </div>
  <!-- /content area -->
  <!-- Content area -->
  <div class="content" style="display:none;">
    <!-- Editable inputs -->
    <div class="panel panel-flat">
      <div class="panel-heading">
        <h5 class="panel-title">Editable inputs</h5>
        <div class="heading-elements">
          <form class="heading-form" action="#">
            <div class="form-group">
              <label class="checkbox-inline checkbox-switchery checkbox-right switchery-xs">
              <input type="checkbox" class="switchery" checked="checked">
              Enable editable: </label>
            </div>
          </form>
        </div>
      </div>
      <div class="panel-body"> X-editable - library, that allows you to create editable elements on your page. It can be used with any engine (bootstrap, jquery-ui, jquery only) and includes both popup and inline modes. By default, x-editable supports 13 input types, such as checkboxes, text fields, textareas, selects, dates etc. Also this library supports <code>Select2</code> and <code>Typeahead</code> integrations by default and some other examples with custom components built in. </div>
      <div class="table-responsive">
        <table class="table table-lg">
          <tr>
            <th colspan="3" class="active">Basic examples</th>
          </tr>
          <tr>
            <td style="width: 20%;">Simple text field</td>
            <td><a href="#" id="text-field" data-type="text" data-inputclass="form-control" data-pk="1" data-title="Simple text field">Simple text field</a></td>
            <td>Basic example with <code>data-type="text"</code> text input</td>
          </tr>
          <tr>
            <td>Text field with help block</td>
            <td><a href="#" id="text-field-help" data-type="text" data-inputclass="form-control" data-pk="1" data-title="Help block">With help block</a></td>
            <td>Display helper text below the input field</td>
          </tr>
          <tr>
            <td>Empty text field</td>
            <td><a href="#" id="empty-field" data-type="text" data-inputclass="form-control" data-pk="1" data-title="Empty text field"></a></td>
            <td>Open popover with empty value text field</td>
          </tr>
          <tr>
            <td>Required text field</td>
            <td><a href="#" id="empty-field-validate" data-type="text" data-inputclass="form-control" data-pk="1" data-title="Required text field"></a></td>
            <td>Example of empty <span class="text-semibold">required</span> text field</td>
          </tr>
          <tr>
            <td>Input group with addon</td>
            <td><a href="#" id="input-group-addon" data-type="text" data-inputclass="form-control" data-pk="1" data-title="Input group addon">Eugene</a></td>
            <td>Basic input group example with text or icon addon</td>
          </tr>
          <tr>
            <td>Input group with button</td>
            <td><a href="#" id="input-group-button" data-type="text" data-inputclass="form-control" data-pk="1" data-title="Input group button">Eugene</a></td>
            <td>Display input group with button addon</td>
          </tr>
          <tr>
            <td>Input group with dropdown</td>
            <td><a href="#" id="input-group-dropdown" data-type="text" data-inputclass="form-control" data-pk="1" data-title="Input group button">Eugene</a></td>
            <td>Display input group with button dropdown. Supports all possible button and dropdown variations</td>
          </tr>
          <tr>
            <td>Default textarea</td>
            <td><a href="#" id="textarea" data-type="textarea" data-pk="1" data-inputclass="form-control" data-placeholder="Your comments here..." data-title="Enter comments">Awesome user!</a></td>
            <td>Display basic textarea with <code>data-type="textarea"</code></td>
          </tr>
          <tr>
            <td>Elastic textarea</td>
            <td><a href="#" id="textarea-elastic" data-type="textarea" data-pk="1" data-inputclass="form-control" data-placeholder="Your comments here..." data-title="Enter comments">Awesome user!</a></td>
            <td>Elastic textarea integration example</td>
          </tr>
          <tr>
            <td>Button color options</td>
            <td><a href="#" id="button-variation" data-type="text" data-inputclass="form-control" data-pk="1" data-title="Button variation">Eugene</a></td>
            <td>Choose different button colors and sizes</td>
          </tr>
          <tr>
            <td>Autotext option</td>
            <td>Group: <a href="#" id="editable-autotext" data-type="select" data-pk="1" data-inputclass="form-control" data-value="3" data-source="/groups" data-title="Select status"></a></td>
            <td>Originally element is empty, but text is rendered when editable applied</td>
          </tr>
          <tr>
            <td>Icon options</td>
            <td><a href="#" id="icon-variation" data-type="text" data-inputclass="form-control" data-pk="1" data-title="Icon variation">Eugene</a></td>
            <td>Change default icons for buttons</td>
          </tr>
          <tr>
            <td>Several fields</td>
            <td><a href="#" id="multiple-fields" data-type="address" data-pk="1" data-inputclass="form-control" data-title="Please, fill address"></a></td>
            <td>Multiple fields example with <code>data-type="address"</code></td>
          </tr>
          <tr class="border-double">
            <th colspan="3" class="active">Checkers and switchers</th>
          </tr>
          <tr>
            <td>Unstyled single checkbox</td>
            <td><a href="#" id="single-unstyled-checkbox" data-type="checklist" data-pk="1" data-title="Simple unstyled checkbox"></a></td>
            <td>Display editable popup with single unstyled checkbox</td>
          </tr>
          <tr>
            <td>Unstyled checklist</td>
            <td><a href="#" id="unstyled-checklist" data-type="checklist" data-pk="1" data-value="2,3" data-title="Select fruits"></a></td>
            <td>Display editable popup with list of checkboxes</td>
          </tr>
          <tr>
            <td>Styled single checkbox</td>
            <td><a href="#" id="single-styled-checkbox" data-type="checklist" data-inputclass="form-control" data-pk="1" data-title="Simple unstyled checkbox"></a></td>
            <td>Display editable popup with single checkbox, styled with <code>Uniform</code> plugin</td>
          </tr>
          <tr>
            <td>Styled checklist</td>
            <td><a href="#" id="styled-checklist" data-type="checklist" data-pk="1" data-value="2,3" data-title="Select fruits"></a></td>
            <td>Display popup with list of styled checkboxes</td>
          </tr>
          <tr>
            <td>Checklist as unordered list</td>
            <td><a href="#" id="checkbox-unordered-list" data-type="checklist" data-pk="1" data-title="Select fruits">[edit]</a>
              <div id="list"></div></td>
            <td>Displaying checked checkboxes as unordered list</td>
          </tr>
          <tr>
            <td>Single Switchery toggle</td>
            <td><a href="#" id="switchery-checkbox" data-type="checklist" data-pk="1" data-title="Select fruits"></a></td>
            <td>Display single Switchery toggle instead of checkbox</td>
          </tr>
          <tr>
            <td>Multiple Switchery toggle</td>
            <td><a href="#" id="switchery-checklist" data-type="checklist" data-pk="1" data-value="2,3" data-title="Select fruits"></a></td>
            <td>Display multiple Switchery toggles as a checklist</td>
          </tr>
          <tr class="border-double">
            <th colspan="3" class="active">Basic selects</th>
          </tr>
          <tr>
            <td>Basic select</td>
            <td><a href="#" id="select-default" data-type="select" data-inputclass="form-control" data-pk="1" data-value="" data-title="Select default"></a></td>
            <td>Basic unstyled select box, initialized with <code>data-type="select"</code>. Options can be defined via javascript <code>$().editable({...})</code> or via <code>data-*</code> html attributes.</td>
          </tr>
          <tr>
            <td>Select with remote source</td>
            <td><a href="#" id="select-default-remote" data-type="select" data-inputclass="form-control" data-pk="1" data-value="5" data-title="Select group">Admin</a></td>
            <td>Display popup with select box, that loads data from remote source</td>
          </tr>
          <tr>
            <td>Select with loading error</td>
            <td><a href="#" id="select-default-error" data-type="select" data-inputclass="form-control" data-pk="1" data-value="0" data-title="Select status">Active</a></td>
            <td>Display error message while loading select options</td>
          </tr>
          <tr>
            <td>Dependent select lists</td>
            <td><ul class="list list-unstyled">
                <li>Default list: <a href="#" id="default-list" data-type="select" data-inputclass="form-control" data-pk="1" data-title="Select status"></a></li>
                <li>Dependent list: <a href="#" id="dependent-list" data-type="select" data-inputclass="form-control" data-pk="1" data-title="Select status"></a></li>
              </ul></td>
            <td>Dependent selects - can't select 2nd select if 1st is empty</td>
          </tr>
          <tr>
            <td>Date field</td>
            <td><a href="#" id="date" data-type="combodate" data-pk="1" data-value="1984-05-15" data-format="YYYY-MM-DD" data-viewformat="DD/MM/YYYY" data-template="D - MMM - YYYY" data-title="Select Date of birth"></a></td>
            <td>Date select boxes in <code>YYYY-MM-DD</code> format</td>
          </tr>
          <tr>
            <td>Datetime field</td>
            <td><a href="#" id="datetime" data-type="combodate" data-pk="1" data-template="D MMM YYYY  HH:mm" data-format="YYYY-MM-DD HH:mm" data-viewformat="MMM D, YYYY, HH:mm" data-title="Setup event date and time"></a></td>
            <td>Date and time select boxes in <code>YYYY-MM-DD HH:mm</code> format</td>
          </tr>
          <tr class="border-double">
            <th colspan="3" class="active">Select2 selects</th>
          </tr>
          <tr>
            <td>Single Select2 select</td>
            <td><a href="#" id="select2-single" data-type="select2" data-pk="1" data-value="BS" data-title="Select country"></a></td>
            <td>Example usage of a single Select2 select box</td>
          </tr>
          <tr>
            <td>Multiple Select2 selects</td>
            <td><a href="#" id="select2-multiple" data-type="select2" data-pk="1" data-title="Enter tags"></a></td>
            <td>Example usage of multiple Select2 select box. This example doesn't have selected tags by default and displays a placeholder instead</td>
          </tr>
          <tr>
            <td>Select2 remote source</td>
            <td><a href="#" id="select2-single-remote" data-type="select2" data-pk="1" data-value="BS" data-title="Select country"></a></td>
            <td>Loading remote source into Select2 select</td>
          </tr>
          <tr class="border-double">
            <th colspan="3" class="active">Advanced usage</th>
          </tr>
          <tr>
            <td>Disabled clear option</td>
            <td><a href="#" id="disabled-clear" data-type="text" data-inputclass="form-control" data-pk="1" data-title="Simple text field">Disabled clearing</a></td>
            <td>Clear input field functionality can be enabled or disabled via <code>clear: true/false</code> option</td>
          </tr>
          <tr>
            <td>Typeahead implementation</td>
            <td><a href="#" id="editable-typeahead" data-type="text" data-inputclass="form-control" data-pk="1" data-title="Start typing State.."></a></td>
            <td>Example of implemented Twitter Typeahead suggestion engine</td>
          </tr>
          <tr>
            <td>Render server response</td>
            <td><a href="#" id="editable-render-response" data-type="text" data-inputclass="form-control" data-pk="1" data-title="Render server response into element">Awesome</a></td>
            <td>Render server response into element</td>
          </tr>
          <tr>
            <td>Process JSON response</td>
            <td><a href="#" id="editable-json-response" data-type="text" data-inputclass="form-control" data-pk="1" data-title="Process JSON response">Awesome</a></td>
            <td>Process JSON response. Try to submit empty field</td>
          </tr>
          <tr>
            <td>Date picker</td>
            <td><a href="#" id="datepicker" data-type="date" data-viewformat="dd.mm.yyyy" data-pk="1" data-title="When you want vacation to start?">25.02.2013</a></td>
            <td>Example with integrated Bootstrap Datepicker plugin</td>
          </tr>
          <tr>
            <td>PUT method submit</td>
            <td><a href="#" id="editable-put-submit" data-type="text" data-inputclass="form-control" data-pk="1" data-title="Submit via PUT method">Awesome</a></td>
            <td>Submit editable form via PUT method</td>
          </tr>
          <tr class="border-double">
            <th colspan="3" class="active">Additional components</th>
          </tr>
          <tr>
            <td>Input mask</td>
            <td><a href="#" id="input-mask" data-type="text" data-inputclass="form-control" data-pk="1" data-title="Input mask"></a></td>
            <td>Display editable popup with input mask attached to the text field</td>
          </tr>
          <tr>
            <td>Input formatter</td>
            <td><a href="#" id="input-formatter" data-type="text" data-inputclass="form-control" data-pk="1" data-title="Input formatter"></a></td>
            <td>Display editable popup with specified text field format</td>
          </tr>
          <tr>
            <td>Basic Touchspin implementation</td>
            <td><a href="#" id="input-touchspin-basic" data-type="text" data-inputclass="form-control" data-pk="1" data-value="5.00" data-title="Touchspin implementation"></a></td>
            <td>Basic example with integrated Touchspin spinner</td>
          </tr>
          <tr>
            <td>Advanced Touchspin implementation</td>
            <td><a href="#" id="input-touchspin-advanced" data-type="text" data-inputclass="form-control" data-pk="1" data-value="5.00" data-title="Touchspin implementation"></a></td>
            <td>More complex example of a Touchspin spinner integrated to the editable field</td>
          </tr>
          <tr>
            <td>Tagsinput with text</td>
            <td><a href="#" id="input-tags-text" data-type="text" data-value="Amsterdam,Washington,Sydney" data-pk="1" data-title="Empty text field"></a></td>
            <td>Tagsinput plugin example. Display values as text</td>
          </tr>
          <tr>
            <td>Tagsinput with labels</td>
            <td><a href="#" id="input-tags-labels" class="no-border-bottom" data-type="text" data-value="Amsterdam,Washington,Sydney" data-pk="1" data-title="Empty text field"></a></td>
            <td>Tagsinput plugin example. Display values as labels</td>
          </tr>
          <tr class="border-double">
            <th colspan="3" class="active">HTML5 input types</th>
          </tr>
          <tr>
            <td>Password input type</td>
            <td><a href="#" id="type-password" data-type="password" data-inputclass="form-control" data-pk="1" data-title="Password">Password</a></td>
            <td>A single-line text field whose value is obscured. Use the maxlength attribute to specify the maximum length of the value that can be entered</td>
          </tr>
          <tr>
            <td>Email input type</td>
            <td><a href="#" id="type-email" data-type="email" data-inputclass="form-control" data-pk="1" data-title="Email">Email</a></td>
            <td>A field for editing an e-mail address. The input value is validated to contain either the empty string or a single valid e-mail address before submitting</td>
          </tr>
          <tr>
            <td>URL input type</td>
            <td><a href="#" id="type-url" data-type="url" data-inputclass="form-control" data-pk="1" data-title="URL">URL</a></td>
            <td>A field for editing a URL. Line-breaks and leading or trailing whitespace are automatically removed from the input value</td>
          </tr>
          <tr>
            <td>Tel input type</td>
            <td><a href="#" id="type-tel" data-type="tel" data-inputclass="form-control" data-pk="1" data-title="Tel">Phone #</a></td>
            <td>A control for entering a telephone number; line-breaks are automatically removed from the input value, but no other syntax is enforced</td>
          </tr>
          <tr>
            <td>Number input type</td>
            <td><a href="#" id="type-number" data-type="number" data-inputclass="form-control" data-pk="1" data-title="Number">Number</a></td>
            <td>A control for entering a floating point number</td>
          </tr>
          <tr>
            <td>Range input type</td>
            <td><a href="#" id="type-range" data-type="range" data-inputclass="form-control" data-pk="1" data-title="Range">Range</a></td>
            <td>A control for entering a number whose exact value is not important</td>
          </tr>
          <tr>
            <td>Time input type</td>
            <td><a href="#" id="type-time" data-type="time" data-inputclass="form-control" data-pk="1" data-title="Time">Time</a></td>
            <td>A control for entering a time value with no time zone.</td>
          </tr>
        </table>
      </div>
    </div>
    <!-- /editable inputs -->
  </div>
  <!-- /content area -->
</div>
<script>
$(document).ready(function(){
	$('table tr td a').click(function(){
		$('.merchant-submit').click(function(){
		 var type = $(this).parents().parents().children('div.editable-input').children().attr('class');
		 
		 //alert(type);
		 if(type == 'checkbox'){
			var checkboxes = '';
			$(this).parents().parents().find('.editable-input div').each(function(){
			if($(this).find('input[type="checkbox"]').is(':checked')){
				var checkbox = $(this).find('input[type="checkbox"]').val();
				checkboxes+= checkbox+', ';
			}
			});
			var name = $(this).parents('td').attr('id');
			var action = 'update';
			var tblname = 'tbl_user_records';
			var key = 'id';
			var update_field = '{"'+name+'":"'+checkboxes+'"}';
			$.ajax({
				type: "POST",
				url: "<?php echo site_url("Dashboard/update_page"); ?>",
				data: 'action='+action+'&value=<?php echo $info->id;?>&table_name='+tblname+'&key='+key+'&update_field='+update_field, 
				cache: false,
				success: function(html) {
					//$('#result_data').html(html)
					//$('#upbtn_'+rid).html('<span class="label label-success" >Verified</span>');
				}
			});
			
			}else{
		
		
			var textValue = $(this).parents().parents().find('.form-control').val();
			var name = $(this).parents('td').attr('id');
			var action = 'update';
			var tblname = 'tbl_user_records';
			var key = 'id';
			var update_field = '{"'+name+'":"'+textValue+'"}';
			$.ajax({
				type: "POST",
				url: "<?php echo site_url("Dashboard/update_page"); ?>",
				data: 'action='+action+'&value=<?php echo $info->id;?>&table_name='+tblname+'&key='+key+'&update_field='+update_field, 
				cache: false,
				success: function(html) {
					//$('#result_data').html(html)
					//$('#upbtn_'+rid).html('<span class="label label-success" >Verified</span>');
				}
			});
			
			}
			
			return true;
		});
	});
})
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

$(document).ready(function(){

$('#add_rec_list').click(function(){
	var key = $(this).attr('data-val');
	$.ajax({
		type: "POST",
		url: "<?php echo site_url("Dashboard/add_to_recomonded_list"); ?>",
		data: 'value=<?php echo $info->id; ?>&key='+key, 
		cache: false,
		success: function(html) {
			if(key!=1){
				$('#add_rec_list').text('Add to Recommonded List');
				$('#add_rec_list').attr('data-val','1');
			}else{
				$('#add_rec_list').text('Remove to Recommonded List');
				$('#add_rec_list').attr('data-val','0');
			}
		}
	});
});
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

				



	</script>
<div class="black_overlay"></div>
<div class="merchant-data-info-box">
  <div class="merchant-info-form">
    <div class="row">
      <div class="col-md-12">
        <!-- Basic layout-->
        <form class="form-horizontal" action="<?php echo site_url("Dashboard/update_user_city"); ?>" method="post" id="AddLesson" enctype="multipart/form-data">
          <!-- <form action="" method="post" class="form-horizontal"> -->
          <input type="hidden" name="user_id" value="<?php echo $info->id; ?>"/>
          <div class="panel panel-flat">
          <div class="panel-heading">
            <h5 class="panel-title">Add Place Information:</h5>
            <div class="heading-elements">
              <ul class="icons-list">
                <!-- <li><a data-action="reload"></a></li>-->
                <li><a data-action="close"></a></li>
              </ul>
            </div>
          </div>
          <div class="form-group">
            <div class="panel-body">
              <div class="col-lg-5">
                <div class="form-group">
                  <label class="control-label">Select City Id:</label>
                  <select name="state" class="form-control" onchange="getLocalityData(this.value)">
                    <option value="" >Select State</option>
                    <?php 

					foreach($data['place_list'] as $val){

					$str = '';

					echo '<option value="'.$val->id.'" '.$str.'>'.ucfirst($val->city_name).'</option>';

					}

					?>
                  </select>
                </div>
              </div>
              <div class="col-lg-5">
                <div class="form-group">
                  <label class="control-label">Select Place Id:</label>
                  <select name="locality_name" class="form-control" id="loc_id">
                    <option value="" >Select State</option>
                  </select>
                </div>
              </div>
              <div class="col-lg-5">
                <div class="form-group">
                  <label class="control-label">Latitude:</label>
                  <input type="text" class="form-control" placeholder="Enter Latitude" name="latitude" value="<?php echo $info->latitude;?>" />
                </div
              ></div>
              <div class="col-lg-5">
                <div class="form-group">
                  <label class="control-label">Longitude:</label>
                  <input type="text" class="form-control" placeholder="Enter Longitude" name="longitude" value="<?php echo $info->longitude;?>" />
                </div>
              </div>
              <div class="col-lg-2 pull-right">
                <label class="control-label">&nbsp;</label>
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

			var conf = confirm("Are you Sure do you want to change the status");

			if(conf == true){

				var action = 'update';

				var tblname = 'tbl_user_records';

				var key = 'id';

				//[{"status":"'+data+'"}]

				//alert(data);

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

				}else{

				return false;	

					}

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
#category_ids > ul {
    border: 1px solid #ddd;
    height: 129px;
    list-style: outside none none;
    overflow-y: scroll;
    padding: 10px;
    width: 100%;
}
</style>
<script>
$(document).ready(function(){

$('#myULCat li input[type="checkbox"]').click(function(){
	var selCat = '';
	$('#myULCat li input[type="checkbox"]').each(function(){
		if($(this).is(':checked')){
		selCat = selCat+$(this).val()+', ';
		}
	});
	var sub_cat_id = '<?php echo $info->Subcategory_ids;?>';
	$.ajax({
		type: "POST",
		url: "<?php echo site_url("Dashboard/get_sub_category"); ?>",
		data: 'cat_id='+selCat+'&sub_cat_id='+sub_cat_id, 
		cache: false,
		success: function(html) {
			$('#myUL').html(html);
		}
	});
});
})
function myFunction() {
    // Declare variables
    var input, filter, ul, li, a, i;
    input = document.getElementById('myInput');
    filter = input.value.toUpperCase();
    ul = document.getElementById("myUL");
    li = ul.getElementsByTagName('li');

    // Loop through all list items, and hide those who don't match the search query
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}
function myFunctionCat() {
    // Declare variables
    var input, filter, ul, li, a, i;
    input = document.getElementById('myInputCat');
    filter = input.value.toUpperCase();
    ul = document.getElementById("myULCat");
    li = ul.getElementsByTagName('li');

    // Loop through all list items, and hide those who don't match the search query
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}
</script>