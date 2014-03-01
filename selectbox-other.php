<?php
        
        
	$branchData = preg_replace("/[\r\n]*/","",
					str_replace('"', "'", CHtml::activeDropDownList(HotelMaster::model(),'branch_id_fk',
						CHtml::listData(BranchMaster::model()->findAll(), 'id', 'branch_name'),
						array(
							'id'=>'slBranch',
							'empty'=>'Select Branch',
							'name'=>'form_branch_id_fk'
						)
					))
				);
	$busTypeData = preg_replace("/[\r\n]*/","",
					str_replace('"', "'", CHtml::activeDropDownList(BusType::model(),'id',
						CHtml::listData(BusType::model()->findAll(), 'id', 'bus_type'),
						array(
							'id'=>'slType',
							'empty'=>'Select Bus Type',
							'name'=>'form_bus_type_id_fk'
						)
					))
				);
	$vehicleCategoryData = preg_replace("/[\r\n]*/","",
					str_replace('"', "'", CHtml::activeDropDownList(VehicleCategory::model(),'id',
						CHtml::listData(VehicleCategory::model()->findAll(), 'id', 'category'),
						array(
							'id'=>'slCategory',
							'empty'=>'Select category',
							'name'=>'form_category_id_fk'
						)
					))
				);
        $shopData = preg_replace("/[\r\n]*/","",
					str_replace('"', "'", CHtml::activeDropDownList(AgencyMaster::model(),'shops',
						CHtml::listData(ApprovedShops::model()->findAll(), 'id', 'shops_name'),
						array(
							'id'=>'slShop',
                                                        'multiple'=>'multiple',
							'name'=>'form_shop[]'
						)
					))
				);
?>
<script type='text/javascript'>
function hasValue(array, value){
	for(var i = 0; i < array.length; i++) {
		if(array[i] === "Other") {
			return true;
		}
	}
	return false;
}
$(".other-select").each(function(){
	if($(this).find("option[value='Other']").val() === undefined){
		$(this).append("<option value='Other'>Other</option>");
	}
	$(this).live("change", function(event){
		var value = $(event.target).val();
		if($.isArray(value) && hasValue(value, "Other")){
			openForm($(event.target).attr("data-field"), event.target);
		}
		else if(!$.isArray(value) && value === "Other"){
			openForm($(event.target).attr("data-field"), event.target);
		}
	});
});
var obj ={
	
	"vehicle":{
		"labels":[
			"",
			"Select Branch",
			"Select Vehicle Category",
			"Short Code",
			"Registeration Number",
			""
		],
		"fields":[
			"<input type='hidden' name='form_type' value='vehicle'><input type='hidden' id='success-ctrl' value=''>",
			"<?php echo $branchData; ?>",
			"<?php echo $vehicleCategoryData; ?>",
			"<input type='text' name='form_short_code'>",
			"<input type='text' name='form_registration_number'>",
			"<input type='submit' onclick='submitClick(this);' value='Submit' class='btn btn-primary' name='form_btnSubmit'/>&nbsp;&nbsp;<input type='reset' class='btn btn-secondary' value='Cancel' name='form_btnCancel' />"
		]
	},
	"service":{
		"labels":[
			"",
			"Select Branch",
			"Short Code",
			"Service Name",
			""
		],
		"fields":[
			"<input type='hidden' name='form_type' value='service'><input type='hidden' id='success-ctrl' value=''>",
			"<?php echo $branchData; ?>",
			"<input type='text' name='form_short_code'>",
			"<input type='text' name='form_name'>",
			"<input type='submit'  onclick='submitClick(this);' value='Submit' class='btn btn-primary' name='form_btnSubmit'/>&nbsp;&nbsp;<input type='reset' class='btn btn-secondary' value='Cancel' name='form_btnCancel' />"
		]
	},
	"hotel":{
		"labels":[
			"",
			"Select Branch",
			"Short Code",
			"Hotel Name",
			""
		],
		"fields":[
			"<input type='hidden' name='form_type' value='hotel'><input type='hidden' id='success-ctrl' value=''>",
			"<?php echo $branchData; ?>",
			"<input type='text' name='form_short_code'>",
			"<input type='text' name='form_name'>",
			"<input type='submit'  onclick='submitClick(this);' value='Submit' class='btn btn-primary' name='form_btnSubmit'/>&nbsp;&nbsp;<input type='reset' class='btn btn-secondary' value='Cancel' name='form_btnCancel' />"
		]
	},
	"flight":{
		"labels":[
			"",
			"Select Branch",
			"Short Code",
			"Flight Name",
			""
		],
		"fields":[
			"<input type='hidden' name='form_type' value='hotel'><input type='hidden' id='success-ctrl' value=''>",
			"<?php echo $branchData; ?>",
			"<input type='text' name='form_short_code'>",
			"<input type='text' name='form_name'>",
			"<input type='submit' onclick='submitClick(this);' value='Submit' class='btn btn-primary' name='form_btnSubmit'/>&nbsp;&nbsp;<input type='reset' class='btn btn-secondary' value='Cancel' name='form_btnCancel' />"
		]
	},
	"train":{
		"labels":[
			"",
			"Select Branch",
			"Short Code",
			"Train Name",
			""
		],
		"fields":[
			"<input type='hidden' name='form_type' value='train'><input type='hidden' id='success-ctrl' value=''>",
			"<?php echo $branchData; ?>",
			"<input type='text' name='form_short_code'>",
			"<input type='text' name='form_name'>",
			"<input type='submit' onclick='submitClick(this);' value='Submit' class='btn btn-primary' name='form_btnSubmit'/>&nbsp;&nbsp;<input type='reset' class='btn btn-secondary' value='Cancel' name='form_btnCancel' />"
		]
	},
	"bus":{
		"labels":[
			"",
			"Select Branch",
			"Select Bus Type",
			"Short Code",
			"Bus Name",
			""
		],
		"fields":[
			"<input type='hidden' name='form_type' value='bus'><input type='hidden' id='success-ctrl' value=''>",
			"<?php echo $branchData; ?>",
			"<?php echo $busTypeData; ?>",
			"<input type='text' name='form_short_code'>",
			"<input type='text' name='form_name'>",
			"<input type='submit' onclick='submitClick(this);' value='Submit' class='btn btn-primary' name='form_btnSubmit'/>&nbsp;&nbsp;<input type='reset' class='btn btn-secondary' value='Cancel' name='form_btnCancel' />"
		]
	},
        "agency":{
		"labels":[
			"",
			"Agency Name",
			"Short Code",
			"City",
                        "State",
                        "Country",
                        "Phone",
                        "Email",
                        "PAN No",
                        "Shop",
			""
		],
		"fields":[
			"<input type='hidden' name='form_type' value='agency'><input type='hidden' id='success-ctrl' value=''>",
			"<input type='text' name='form_name'>",
			"<input type='text' name='form_short_code'>",
                        "<input type='text' name='form_city'>",
                        "<input type='text' name='form_state'>",
                        "<input type='text' name='form_country'>",
                        "<input type='text' name='form_phone'>",
                        "<input type='text' name='form_email'>",
                        "<input type='text' name='form_pan'>",
			"<?php echo $shopData; ?>",
			"<input type='submit' onclick='submitClick(this);' value='Submit' class='btn btn-primary' name='form_btnSubmit'/>&nbsp;&nbsp;<input type='reset' class='btn btn-secondary' value='Cancel' name='form_btnCancel' />"
		]
	},
	
};

function openForm(data, element){
	var length = obj[data].fields.length, content="";
	for(var i=0; i<length; i++) {
		content += "<div class='row-fluid'><div class='span4'>"+obj[data].labels[i]+"</div><div class='span8'>"+obj[data].fields[i]+"</div></div>";
	}
	content+="<div class='row-fluid'>&nbsp;</div";
	$("#comman-modal").find(".modal-body").html(content);
	$("#comman-modal").modal('show');
	$("#comman-modal").find(".modal-body").find('#success-ctrl').val('#'+element.id);
	return false;
	
}

function submitClick(obj){
		var submit_button = $(obj);
		submit_button.hide();
		var ajaxRqCount =1 ;
		$('#comman-progress').css('display','inline');
		var modal = $("#comman-modal"),
			type = modal.find("[name='form_type']").val(),
			data={},
			url="", 
			successCtrl = modal.find("#success-ctrl").val(),
			otherOption = successCtrl+" option[value='Other']",
			optionText = "";
	switch(type){
                        case 'agency': 
				data.name = modal.find("input[name='form_name']").val();
				data.short_code = modal.find("input[name='form_short_code']").val();
                                data.email_id = modal.find("input[name='form_email']").val();
                                data.pan = modal.find("input[name='form_pan']").val();
                                data.country = modal.find("input[name='form_country']").val();
                                data.state = modal.find("input[name='form_state']").val();
                                data.city = modal.find("input[name='form_city']").val();
                                data.phone = modal.find("input[name='form_phone']").val();
                                
				data.shops = modal.find("select[name='form_shop[]']").val();
				
				url = '<?php echo Yii::app()->createUrl("AgencyMaster/ajaxCreateMini");?>';
				optionText = data.name;
				break;
			case 'vehicle': 
				data.registration_number = modal.find("input[name='form_registration_number']").val();
				data.short_code = modal.find("input[name='form_short_code']").val();
				data.branch_id_fk = modal.find("select[name='form_branch_id_fk']").val();
				data.category_id_fk = modal.find("select[name='form_category_id_fk']").val();
				url = '<?php echo Yii::app()->createUrl("VehicleMaster/ajaxCreateMini");?>';
				optionText = data.registration_number;
				break;
			case 'service': 
				data.name = modal.find("input[name='form_name']").val();
				data.short_code = modal.find("input[name='form_short_code']").val();
				data.branch_id_fk = modal.find("select[name='form_branch_id_fk']").val();
				url = '<?php echo Yii::app()->createUrl("ServiceMaster/ajaxCreateMini");?>';
				optionText = data.name;
				break;
			case 'hotel': 
				data.name = modal.find("input[name='form_name']").val();
				data.short_code = modal.find("input[name='form_short_code']").val();
				data.branch_id_fk = modal.find("select[name='form_branch_id_fk']").val();
				url = '<?php echo Yii::app()->createUrl("HotelMaster/ajaxCreateMini");?>';
				optionText = data.name;
				break;
			case 'flight': 
				data.name = modal.find("input[name='form_name']").val();
				data.short_code = modal.find("input[name='form_short_code']").val();
				data.branch_id_fk = modal.find("select[name='form_branch_id_fk']").val();
				url = '<?php echo Yii::app()->createUrl("FlightMaster/ajaxCreateMini");?>';
				optionText = data.name;
				break;
			case 'train': 
				data.name = modal.find("input[name='form_name']").val();
				data.short_code = modal.find("input[name='form_short_code']").val();
				data.branch_id_fk = modal.find("select[name='form_branch_id_fk']").val();
				url = '<?php echo Yii::app()->createUrl("TrainMaster/ajaxCreateMini");?>';
				optionText = data.name;
				break;
			case 'bus': 
				data.name = modal.find("input[name='form_name']").val();
				data.short_code = modal.find("input[name='form_short_code']").val();
				data.branch_id_fk = modal.find("select[name='form_branch_id_fk']").val();
				data.bus_type_id_fk = modal.find("select[name='form_bus_type_id_fk']").val();
				url = '<?php echo Yii::app()->createUrl("BusMaster/ajaxCreateMini");?>';
				optionText = data.name;
				break;
			default:
				break;
		}
		$.ajax({
			data:data,
			url:url,
			method:'post',
			success:function(data){
				$('#comman-progress').hide();
				submit_button.show();
				
				if(data=="0"){
					alert("Error while processing you request. Please contact admin.");
				}
				else if(data=="Already"){
					alert(type+" already exists with this name. try using different name.");
				}
				else{
					$(otherOption).remove();
					if($(successCtrl).find("option[value='Other']").val() === undefined){
						$(successCtrl).append("<option value='"+data+"'>"+optionText+"</option><option>Other</option>").val(optionText);
						$(successCtrl+' option').each(function(){
							if ($(this).text() == optionText) {
								$(this).attr('selected', 'selected');
							}
						});
						if($(successCtrl).hasClass('chosen-select')){
							$(successCtrl).trigger("chosen:updated"); 
						}										
					}
					modal.modal('hide');
				}
			},
			error:function(){
				$('#comman-progress').hide();
				submit_button.show();
				alert("Error while processing you request. Please contact admin.");
			}
		});

}
	
	

</script>
