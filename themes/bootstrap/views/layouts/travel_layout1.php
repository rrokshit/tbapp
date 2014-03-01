<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
		<script src="<?php echo Yii::app()->theme->baseurl; ?>/js/bootstrap-combine.js"></script>
        <link href="<?php echo Yii::app()->theme->baseurl; ?>/css/bootstrap-combine.css" rel="stylesheet">
        
        <title>Travel Bureau Management Application</title>
        <style>body{text-transform: uppercase}</style>
    </head>
    <body>
        <div id="loading">
            <img src="<?php echo Yii::app()->theme->baseurl; ?>/img/ajax-loader.gif">
        </div>
        <div id="responsive_part">
            <div class="logo">
                <a href="<?php echo Yii::app()->theme->baseurl; ?>/index.html"></a>
            </div>
            <ul class="nav responsive">
                <li>
                <btn class="btn btn-la1rge btn-i1nfo responsive_menu icon_item" data-toggle="collapse" data-target="#sidebar">
                    <i class="icon-reorder"></i>
                </btn>
                </li>
            </ul>
        </div> <!-- Responsive part -->

        <div id="sidebar" class="collapse">
            <div class="logo">
                <a href="<?php echo Yii::app()->request->baseurl; ?>/index.php/entries/create"></a>
            </div>
            <ul id="sidebar_menu" class="navbar nav nav-list sidebar_box">
                <li class="accordion-group">
                    <a class="dashboard" href="<?php echo Yii::app()->theme->baseurl; ?>/index.php/entries"><img src="<?php echo Yii::app()->theme->baseurl; ?>/img/menu_icons/dashboard.png">Dashboard</a>
                </li>
                <li class="accordion-group">
                    <a class="accordion-toggle widgets collapsed" data-toggle="collapse" data-parent="#sidebar_menu" href="#collapse1">
                        <img src="<?php echo Yii::app()->theme->baseurl; ?>/img/menu_icons/forms.png">Masters</a>
                    <ul id="collapse1" class="accordion-body collapse">
                        <li><a href="<?php echo Yii::app()->createUrl('BranchMaster/admin');?>">Branch Master</a></li>
                        <li><a href="<?php echo Yii::app()->createUrl('ApprovedShops/admin');?>">Approved Shops Master</a></li>
                        <li><a href="<?php echo Yii::app()->createUrl('AgencyMaster/admin');?>"> Agency Master</a></li>
                        <li><a href="<?php echo Yii::app()->createUrl('HotelMaster/admin');?>">Hotel Master</a></li>
                        <li><a href="<?php echo Yii::app()->createUrl('TrainMaster/admin');?>">Train Master</a></li>
                        <li><a href="<?php echo Yii::app()->createUrl('BusMaster/admin');?>">Bus Master</a></li>
                        <li><a href="<?php echo Yii::app()->createUrl('FlightMaster/admin');?>">Flight Master</a></li>
                        <li><a href="<?php echo Yii::app()->createUrl('VehicleMaster/admin');?>">Vehicle Master</a></li>
                        <li><a href="<?php echo Yii::app()->createUrl('ServiceMaster/admin');?>">Service Master</a></li>
                        <li><a href="<?php echo Yii::app()->createUrl('StaffMaster/admin');?>">Staff Master</a></li>
                        <li><a href="<?php echo Yii::app()->createUrl('DriverMaster/admin');?>">Driver Master</a></li>
                        <li><a href="<?php echo Yii::app()->createUrl('GuideMaster/admin');?>">Guide Master</a></li>
                    </ul>
                </li> 
				<li class="accordion-group" active>
                    <a class="accordion-toggle widgets collapsed" data-toggle="collapse" data-parent="#sidebar_menu" href="#collapse2">
                        <img src="<?php echo Yii::app()->theme->baseurl; ?>/img/menu_icons/widgets.png">Entries</a>
                    <ul id="collapse2" class="accordion-body collapse in">
                        <li><a href="<?php echo  Yii::app()->createUrl('entries/admin');?> ">Entries</a></li>
                        <li><a href="<?php echo  Yii::app()->createUrl('arrival/admin');?>" >Arrival</a></li>
                        <li><a href="<?php echo  Yii::app()->createUrl('sightseen/admin');?>">SightSeeing</a></li>
                        <li><a href="<?php echo  Yii::app()->createUrl('Departure/admin');?>">Departure</a></li>
					</ul>
                </li>
                <li class="accordion-group">
                    <a class="accordion-toggle widgets collapsed" data-toggle="collapse" data-parent="#sidebar_menu" href="#collapse4">
					<img src="<?php echo Yii::app()->theme->baseurl; ?>/img/menu_icons/tools.png">Update</a>
                    <ul id="collapse4" class="accordion-body collapse">
                        <li><a href="<?php echo Yii::app()->createUrl('VehicleUpdate/view');?>">Vehicle Update</a></li>
                        <li><a href="<?php echo Yii::app()->createUrl('HotelUpdate/view');?>">Hotel Update</a></li>
                        <li><a href="<?php echo Yii::app()->createUrl('HotelRoomUpdate/view');?>">REP Update</a></li>
                        <li><a href="<?php echo Yii::app()->createUrl('GuideUpdate/view');?>">Guide Update</a></li>
                        <li><a href="<?php echo Yii::app()->createUrl('StaffUpdate/view');?>">Staff Update</a></li>
                    </ul>
                </li>
                <li class="accordion-group">
                    <a class="accordion-toggle widgets collapsed" data-toggle="collapse" data-parent="#sidebar_menu" href="#collapse3">
                        <img src="<?php echo Yii::app()->theme->baseurl; ?>/img/menu_icons/statistics.png">Report</a>
                    <ul id="collapse3" class="accordion-body collapse">
                        <li><a href="<?php echo Yii::app()->createUrl('rptMovement/view');?>">Movement Chart</a></li>
                        <li><a href="<?php echo Yii::app()->createUrl('ClientVisit/view');?>">Client Visit</a></li>
                        <li><a href="<?php echo Yii::app()->createUrl('AgencySale/view');?>">Agency Sale</a></li>
                        <li><a href="<?php echo Yii::app()->createUrl('clientReport/view');?>">Client Report</a></li>
                    </ul>
                </li>
            </ul>
            <!-- End sidebar_box -->
            <div class="sidebar_box statistics visible-desktop">
                <div class="container" style="display:none">
                    <div class="title">
                        <i class="gicon-globe"></i> Estimated earnings
                    </div>
                    <div class="row-fluid fluid">
                        <div class="span6 pagination-centered">
                            <div class="row-fluid fluid">
                                <i class="icon-caret-up green medium span3"></i>
                                <span class="percent span3">7%</span>
                                <span class="bar1 span6">3,4,10,5,3,6,3</span>
                            </div>
                            <div class="row-fluid fluid">
                                <h2><strong>$11.37</strong></h2>
                            </div>
                            <div class="row-fluid fluid">
                                Today so far
                            </div>
                        </div>
                        <div class="span6 pagination-centered">
                            <div class="row-fluid fluid">
                                <i class="icon-caret-down red medium span3"></i>
                                <span class="percent span3">2%</span>
                                <span class="bar2 span6">1, 4, 6, 7,4, 2,4</span>
                            </div>
                            <div class="row-fluid fluid">
                                <h2><strong>$22.84</strong></h2>
                            </div>
                            <div class="row-fluid fluid">
                                Yesterday  <i class="icon-question-sign muted inline" rel="tooltip" data-placement="right" data-original-title="Your total earnings accrued yesterday. This amount is an estimate that is subject to change when your earnings are verified for accuracy at the end of every month."></i>
                            </div>
                        </div>
                    </div>
                    <!-- End .title -->
                    <div class="title row-fluid fluid">
                        <i class="gicon-refresh"></i>Real Time Stats
                    </div>
                    <div class="row-fluid fluid">
                        <div class="span6 pagination-centered">
                            <div class="row-fluid">
                                <div id="g1" class="gauge" style="display:none">
                                </div>
                            </div>
                        </div>
                        <div class="span6 pagination-centered">
                            <div class="row-fluid fluid">
                                <div id="g2" class="gauge" style="display:none">
                                </div>
                            </div>
                        </div>
                        <!-- End row-fluid -->
                        <div class="row-fluid fluid">
                            <div id="real-time-sidebar" style="width:100%;height:65px;">
                            </div>
                        </div>
                        <div class="row-fluid fluid pagination-centered">
                            Page views <i class="icon-question-sign muted inline" rel="tooltip" data-placement="right" data-original-title="This displays the total number of pages that are accessed."></i>
                        </div>
                    </div>
                    <!-- End .title -->
                </div>
            </div>
            <!-- End sidebar_box -->
        </div>
        <div id="main">
            <div class="container">
                <div class="container_top">
                    <div class="row-fluid ">
                        <div class="top_bar_stats to_hide_tablet">
                            <div class="stats"> <span class="title">Arrival:</span> <?php echo Arrival::model()->count("arrival_date ='" . date("Y-m-d") . "'"); ?> </div>
                            <div class="stats"> <span class="title">Departure:</span> <?php echo Departure::model()->count("dept_date ='" . date("Y-m-d") . "'"); ?>  </div>
                            <div class="stats"> <span class="title">Sightseen:</span> <?php echo SiteseenServices::model()->count("date ='" . date("Y-m-d") . "'"); ?> </div>
                        </div>
                        <div class="top_right">
                            <!--
                            <ul class="nav search">
                                <li>
                                    <form class="form-search">
                                        <div class="input-append">
                                            <input name="text" type="text" class=" search-query" placeholder="Search..">
                                        </div>
                                    </form>
                                </li>
                            </ul>
                            -->
                            <ul class="nav nav_menu">
                                <li class="dropdown"> <a class="dropdown-toggle administrator" id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="/page.html"> <span class="icon"><img src="<?php echo Yii::app()->theme->baseurl; ?>/img/menu_top/profile-avatar.png"></span><span class="title"><?php
                                            if (isset(Yii::app()->user->first_nam)) {
                                                echo Yii::app()->user->first_name;
                                            }
                                            ?></span></a>
                                    <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                        <li><a href="<?php echo $this->createUrl('//site/logout'); ?>"><i class=" icon-unlock"></i>Log Out</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <!-- End top-right -->
                        <div class="span4"> </div>
                    </div>
                </div>
                <!-- End container_top -->
                <div class="row-fluid">
				<?php echo $content ?>
					<textarea id="text" rows= class="" style="display:none"></textarea>
                </div>
            </div>
            <!-- End .span4 -->
        </div>
    </div> 
    <!-- End #container -->
    <div id="footer">
        <a href="http://www.travelbureauindia.com/"> <p> &copy; Copyright by Travel Bureau 2013.
            </p></a>
        <span class="company_logo"><a href="http://aspiringteam.com/"></a></span>
    </div> <!-- End #footer -->
</div>
</div>
<style>
    .radio input[type="radio"], .checkbox input[type="checkbox"]{
        margin-top:-2px;
    }
</style>
<script type='text/javascript'>
$.noConflict();
jQuery(window).load(function() {
	jQuery('#loading').fadeOut();
	
	$(".chosen-select").chosen({
		disable_search_threshold: 10
	});
});

$(document).ready(function() {
	$('body').css('display', 'none');
	$('body').fadeIn(500);

	$("#logo a, #sidebar_menu a:not(.accordion-toggle), a.ajx").click(function() {
		event.preventDefault();
		newLocation = this.href;
		$('body').fadeOut(500, newpage);
	});
 
});
function newpage() {
	window.location = newLocation;
}
function openConversation(obj, type){
	var id = parseInt($(obj).parents('tr').find('td:first').html()),
		image = $(obj).find('img');
	image.attr('src','/images/loading.gif');
	$("#ConversationHistoryEntryId").val(id);
	$.ajax({
		url:'<?php echo Yii::app()->createUrl('Conversation/GetConversation');?>',
		method:'post',
		data:{'id':id, 'type':type},
		success:function(data){
			image.attr('src','/images/conversation.png');
			data = JSON.parse(data);
			var content = "",
				length = Object.keys(data).length;
			$('#ConversationHistoryCount').val(length);
			for(var i=1; i<= length; i++){
				var key = Object.keys(data)[i-1];
				content+="<div id='conversation-"+data[key].id+"'>"+
							"<div class='form-row control-group row-fluid'>"+
								"<label class='control-label span3'>To</label>"+
								"<div class='controls span7'>"+
									"<input id='txtConvarsationTo"+data[key].id+"' class='row-fluid' type='text' value='"+data[key].to+"'>"+
								"</div>"+
							"</div>"+
							"<div class='form-row control-group row-fluid'>"+
								"<label class='control-label span3'>From</label>"+
								"<div class='controls span7'>"+
									"<input id='txtConvarsationFrom"+data[key].id+"' class='row-fluid' type='text' value='"+data[key].from+"'>"+
								"</div>"+
							"</div>"+
							"<div class='form-row control-group row-fluid'>"+
								"<label class='control-label span3'>Date</label>"+
								"<div class='controls span7'>"+
									"<input id='txtConvarsationDate"+data[key].id+"' class='row-fluid' type='text' value='"+data[key].date+"'>"+ 
								"</div>"+
							"</div>"+
							"<div class='form-row control-group row-fluid'>"+
								"<label class='control-label span3'>Subject</label>"+
								"<div class='controls span7'>"+
									"<input id='txtConvarsationSubject"+data[key].id+"' class='row-fluid' type='text' value='"+data[key].subject+"'>"+ 
								"</div>"+
							"</div>"+
							"<div class='form-row control-group row-fluid'>"+
								"<label class='control-label span3'>Message</label>"+
								"<div class='controls span7' >"+
								"<textarea style='width:100%;height:100px;resize:none;' id='txtConvarsationMessage"+data[key].id+"' >"+data[key].message+"</textarea>"+
								"</div>"+
							"</div>"+
						"</div><hr/>";
			}
			
			$('#conversation-modal #conversation-container').html(content);
			$('#conversation-modal').modal('show');			
			$("#Conversation-AddMore").show();
			$("#Conversation-Save").hide();
		},
		error:function(){
			alert("Error: Getting Conversation. Please Contact Administrator");
			image.attr('src','/images/conversation.png');
		},
	});
}


$("#Conversation-AddMore").live("click", function(){

	var content = "<div id='conversation-new'><input id='conversation-id-type' type='hidden' value='"+$('#hType').val()+"'/>"+
				"<h1>Add New Conversation </h1>"+
				"<div class='form-row control-group row-fluid'>"+
					"<label class='control-label span3'>To</label>"+
					"<div class='controls span7'>"+
						"<input id='txtConvarsationTo' name='Conversation[to]' class='row-fluid' type='text'>"+
					"</div>"+
				"</div>"+
				"<div class='form-row control-group row-fluid'>"+
					"<label class='control-label span3'>From</label>"+
					"<div class='controls span7'>"+
						"<input id='txtConvarsationFrom' name='Conversation[from]'  class='row-fluid' type='text' value=''>"+
					"</div>"+
				"</div>"+
				"<div class='form-row control-group row-fluid'>"+
					"<label class='control-label span3'>Date</label>"+
					"<div class='controls span7'>"+
						"<input id='txtConvarsationDate' name='Conversation[date]'  class='row-fluid' type='date'>"+ 
					"</div>"+
				"</div>"+
				"<div class='form-row control-group row-fluid'>"+
					"<label class='control-label span3'>Subject</label>"+
					"<div class='controls span7'>"+
						"<input id='txtConvarsationSubject' name='Conversation[subject]'  class='row-fluid' type='text'>"+ 
					"</div>"+
				"</div>"+
				"<div class='form-row control-group row-fluid'>"+
					"<label class='control-label span3'>Message</label>"+
					"<div class='controls span7' >"+
					"<textarea style='width:100%;height:100px;resize:none;' name='Conversation[message]'  id='txtConvarsationMessage' ></textarea>"+
					"</div>"+
				"</div>"+
			"</div><hr/>";
	$('#conversation-modal #conversation-container').prepend(content);
	$("#Conversation-AddMore").hide();
	$("#Conversation-Save").show();
        
        var entryId = $("#ConversationHistoryEntryId").val();
        
        $.post('<?php echo $this->createUrl('//entries/findHandlingEmail')?>',{entryId: entryId},function(handlingMail){
            $("#txtConvarsationFrom").val(handlingMail);
        });
        
});
$('#Conversation-Save').live('click', function(){
	var to = $('#conversation-new #txtConvarsationTo').val();
	var from = $('#conversation-new #txtConvarsationFrom').val();
	var date = $('#conversation-new #txtConvarsationDate').val();
	var subject = $('#conversation-new #txtConvarsationSubject').val();
	var message = $('#conversation-new #txtConvarsationMessage').val();
	var entry_id = $('#ConversationHistoryEntryId').val();
	var type = $("#conversation-new #conversation-id-type").val();
	
	if(to && from && date && subject && message && entry_id && type){		
		$("#Conversation-Save").hide();
		$.ajax({
			url:'<?php echo Yii::app()->createUrl('Conversation/AjaxCreate');?>',
			method:'post',
			data:{'to': to, 'from': from, 'date': date, 'subject': subject, 'message': message, 'id':  entry_id, 'type': type },
			success: function(data){
				$("#Conversation-AddMore").show();
				$("#Conversation-Save").hide();
				if(data == "Save Successfully"){
					alert("Conversation saved successfully.");
					$("#conversation-cancel").click();
				}
				else if(data == "Problem Saving"){
					alert("Error: Saving Conversation. Please Contact Administrator.");
				}
			},
			error: function(){
				alert("Error: Saving Conversation. Please Contact Administrator.");
			}
		});
	}
	else{
		alert("Please fill complete form for new conversation.");
	}
	
});

</script>
<!-- Button trigger modal -->
<button class="btn btn-primary btn-lg" id="comman-modal-btn" data-toggle="modal" data-target="#comman-modal" style="display:none;"></button>

<!-- Modal -->
<div class="modal fade" id="comman-modal" tabindex="-1" role="dialog" aria-labelledby="comman-modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">&nbsp;
      </div>
      <div class="modal-body">
        <div class="container-fluid">
		</div>
	  </div>
      <div class="modal-footer">
		 <div id="comman-progress" style="text-align: left;float: left;display:none;">
				<img src="/travel/themes/bootstrap/img/ajax-loader.gif" style="width: 22px;"/>
		 </div>
	    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<button class="btn btn-primary btn-lg" id="conversation-modal-btn" data-toggle="modal" data-target="#conversation-modal" style="display:none;"></button>

<!-- Modal 

hasDatepicker

-->
<div class="modal fade" id="conversation-modal" tabindex="-1" role="dialog" aria-labelledby="conversation-modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"><h2>Conversations History</h2></div>
      <div class="modal-body">
        <input id="ConversationHistoryCount" value="0" type='hidden'/>
        <input id="ConversationHistoryEntryId" name="ConversationHistoryEntryId" value="0" type='hidden'/>
		<div class="container-fluid" id="conversation-container">
			
		</div>
	  </div>
      <div class="modal-footer">
		 <button type="button" class="btn btn-primary" id='Conversation-AddMore' >Add More</button>
		 <button type="button" class="btn btn-primary" id='Conversation-Save'  style='display:none;'>Save</button>
		 <button type="button" id='conversation-cancel' class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

</div>
</body>
</html>