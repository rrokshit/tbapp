<?php
Yii::app()->clientScript->registerScript(
        'validateAdvertisementForm', '
	function updatedatepicker(){
		jQuery(".tb_app_date_field").removeClass("hasDatepicker").datepicker(
			{"dateFormat":"dd-mm-yy","altFormat":"dd-mm-yy",
			"showButtonPanel":true,"changeMonth":true,
			"changeYear":true,"yearRange":"1900:2099"}
		);
	}
   ', CClientScript::POS_HEAD
);
?>
<div class="<?php echo $this->message_type; ?>"><?php echo $this->message_content; ?></div>
<div class="row-fluid">
    <div id="progressStatus"></div>
    <div class="box gradient">
        <div class="title">
            <h3> 
                <i class="icon-book"></i>
                <span>REP Update
                    <span class="botton_mergin3"></span>
                    <span class="botton_margin1">
                    </span>
                </span>
            </h3>
        </div>

        <div class="content top ">
            <div id="progress" style="display:none;text-align:center">
                <img src="<?php echo Yii::app()->theme->baseurl; ?>/img/ajax-loader.gif"/>
            </div>
<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'hotel-room-update-form',
    'enableAjaxValidation' => false,
        ));
?>

            <div class="form-row control-group row-fluid">
                <label class="control-label span3">Start Date</label>
                <div class="controls span7">
                    <div class="input-append date row-fluid">
<?php
if ($_POST['HotelRoomUpdate']['start_date'] && $_POST['HotelRoomUpdate']['end_date']) {
    $startDate = date("d-m-Y", strtotime($this->start_date));
    $endDate = date("d-m-Y", strtotime($this->end_date));
} else {
    $startDate = date("d-m-Y");
    $endDate = date("d-m-Y");
}
$this->widget('zii.widgets.jui.CJuiDatePicker', array(
    'name' => 'HotelRoomUpdate[start_date]',
    'value' => $startDate,
    'options' => array(
        'dateFormat' => 'dd-mm-yy',
        'altFormat' => 'dd-mm-yy',
        'showButtonPanel' => true,
        'changeMonth' => true,
        'changeYear' => true,
        'yearRange' => '1900:2099'
    ),
    'htmlOptions' => array(
        'class' => 'row-fluid',
    ),
));
?>
                        <span class="add-on"><i class="icon-th"></i></span> 
                    </div>


                </div>
                <div class="form-row control-group row-fluid">
                    <label class="control-label span3" >End Date</label>
                    <div class="controls span7">
                        <div class="input-append date row-fluid">
<?php
$this->widget('zii.widgets.jui.CJuiDatePicker', array(
    'name' => 'HotelRoomUpdate[end_date]',
    'value' => $endDate,
    'options' => array(
        'dateFormat' => 'dd-mm-yy',
        'altFormat' => 'dd-mm-yy',
        'showButtonPanel' => true,
        'changeMonth' => true,
        'changeYear' => true,
        'yearRange' => '1900:2099'
    ),
    'htmlOptions' => array(
        'class' => 'row-fluid',
    ),
));
?>
                            <span class="add-on"><i class="icon-th"></i></span> 
                        </div>


                    </div>
                </div>
            </div>
            <div class="form-actions row-fluid">
                <div class="span7 offset3">
                    <button type="submit" class="btn btn-primary">Find</button>
                    <input type="reset" class="btn btn-secondary" value="Cancel"/>
                </div>
            </div>

<?php
$this->endWidget();
?>
            <?php
            if (isset($this->start_date) && isset($this->end_date)) {
                ?>
                <ul class="nav nav-pills" id="tabs">
                    <li class="active"><a onclick="openTabs('arrival');" id="arrival-nav" >Arrival Room Update</a></li>
                    <li><a onclick="openTabs('siteseen');"  id="siteseen-nav">Sightseeing Time Update</a></li>
                    <li><a onclick="openTabs('departure');"  id="departure-nav">Departure Time Update</a></li>
                </ul>

                <div style="margin:5px 0;">Data will be refresh in <span id="counter"></span> sec.</div>

                <div class="tab-content" id="tab-content">
                    <div class="tab-pane" id="arrival">

    <?php
    $Arrival = Arrival::model()->findAll("arrival_date BETWEEN '" . $this->start_date . "' and '" . $this->end_date . "'");
    $data = array();
    foreach ($Arrival as $a)
        array_push($data, $a->entry_id_fk);


    $Entries = new Entries;
    $criteria = new CDbCriteria;
    $criteria->addInCondition('id', $data);
    $entriesData = new CActiveDataProvider($Entries, array(
        'criteria' => $criteria,
        'pagination' => false
    ));

    $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'arrival-vehicle-grid',
        'dataProvider' => $entriesData,
        'filter' => $Entries,
        'columns' => array
            (
            array(
                'header' => 'PNR',
                'value' => '$data->pnr_no'
            ),
            array(
                'header' => 'Agency',
                'value' => 'AgencyMaster::model()->findByPK(
																	$data->agency_id_fk
																)->name'
            ),
            array(
                'header' => 'Hotel',
                'value' => '$data->getHotelName($data->hotel_id_fk)'
            ),
            array(
                'header' => 'Client Name',
                'value' => '$data->client_name
															'
            ),
            array(
                'header' => 'Status',
                'value' => 'Arrival::model()->findByAttributes(array("entry_id_fk"=>$data->id))->hotel_status'
            ),
            array(
                'header' => 'Conf. By',
                'value' => 'Arrival::model()->findByAttributes(array("entry_id_fk"=>$data->id))->confirmed_by'
            ),
            array(
                'header' => 'Room No.',
                'type' => 'raw',
                'value' => '$data->getRoomNo($data->id)'
            ),
            array(
                'header' => 'Check In Time',
                'type' => 'raw',
                'value' => '$data->getCheckInTime($data->id)'
            ),
            array(
                'header' => 'Arrival Date',
                'value' => 'date("d-m-Y",strtotime(Arrival::model()->findByAttributes(array("entry_id_fk"=>$data->id))->arrival_date))'
            ),
            array(
                'header' => 'Arrived',
                'type' => 'raw',
                'value' => '$data->getArrived($data->id)'
            ),
            array(
                'header' => 'Total Bags',
                'type' => 'raw',
                'value' => '$data->getTotalBags($data->id)'
            ),
            array(
                'header' => 'Porterage',
                'type' => 'raw',
                'value' => '$data->getPorterage($data->id)'
            ),
            array(
                'header' => 'Asst. Required',
                'type' => 'raw',
                'value' => '$data->assistance_on_arrival'
            ),
            array(
                'header' => 'Staff Duty',
                'value' => '$data->getDepartureStaffDuty($data->id)'
            ),
            array(
                'header' => 'Driver Name(Mobile)',
                'type' => 'raw',
                'value' => '$data->getArrivalDriverInfo($data->id)'
            ),
            array(
                'header' => 'PAX',
                'type' => 'raw',
                'value' => '$data->getPAX($data->id)'
            ),
            array(
                'header' => 'Single',
                'type' => 'raw',
                'value' => '$data->single'
            ),
            array(
                'header' => 'Double',
                'type' => 'raw',
                'value' => '$data->double'
            ),
            array(
                'header' => 'Triple',
                'type' => 'raw',
                'value' => '$data->triple'
            ),
            array(
                'header' => 'Other',
                'type' => 'raw',
                'value' => '$data->getHotelRoomUpdateRemarks($data->id)'
            ),
        ),
        'itemsCssClass' => 'responsive table table-striped table-bordered overflow',
    ));
    ?>

                    </div>
                    <div class="tab-pane" id="siteseen">
                        <?php
                        $Arrival = Arrival::model()->findAll("arrival_date BETWEEN '" . $this->start_date . "' and '" . $this->end_date . "'");
                        $data = array();
                        foreach ($Arrival as $a)
                            array_push($data, $a->entry_id_fk);


                        $Entries = new Entries;
                        $criteria = new CDbCriteria;
                        $criteria->addInCondition('id', $data);
                        $entriesData = new CActiveDataProvider($Entries, array(
                            'criteria' => $criteria,
                            'pagination' => false
                        ));
                        $controller = $this;
                        $this->widget('zii.widgets.grid.CGridView', array(
                            'id' => 'siteseen-vehicle-grid',
                            'dataProvider' => $entriesData,
                            'filter' => $Entries,
                            'columns' => array
                                (
                                array(
                                    'header' => 'PNR',
                                    'value' => '$data->pnr_no'
                                ),
                                array(
                                    'header' => 'Agency',
                                    'value' => 'AgencyMaster::model()->findByPK(
																	$data->agency_id_fk
																)->name'
                                ),
                                array(
                                    'header' => 'Hotel',
                                    'value' => '$data->getHotelName($data->hotel_id_fk)'
                                ),
                                array(
                                    'header' => 'Client Name',
                                    'value' => '$data->client_name
															'
                                ),
                                array(
                                    'header' => 'Status',
                                    'value' => 'Arrival::model()->findByAttributes(array("entry_id_fk"=>$data->id))->hotel_status'
                                ),
                                array(
                                    'header' => 'Book By',
                                    'value' => '$data->getNonEditableBookBy($data->id)'
                                ),
                                array(
                                    'header' => 'Conf. By',
                                    'value' => 'Arrival::model()->findByAttributes(array("entry_id_fk"=>$data->id))->confirmed_by'
                                ),
                                array(
                                    'header' => 'Room No.',
                                    'value' => 'Arrival::model()->findByAttributes(array("entry_id_fk"=>$data->id))->room_no'
                                ),
                                array(
                                    'header' => 'Check In Time',
                                    'type' => 'raw',
                                    'value' => '$data->getCheckInTime($data->id)'
                                ),
                                array(
                                    'header' => 'Arrival Date',
                                    'value' => 'date("d-m-Y",strtotime(Arrival::model()->findByAttributes(array("entry_id_fk"=>$data->id))->arrival_date))'
                                ),
                                array(
                                    'header' => 'Asst. Req.',
                                    'value' => 'Entries::model()->findByPK($data->id)->assistance_on_arrival'
                                ),
                                array(
                                    'header' => 'Driver Name(Mobile)',
                                    'type' => 'raw',
                                    'value' => '$data->getSiteseenDriverInfo($data->id)'
                                ),
                                array(
                                    'header' => 'Total Bags',
                                    'type' => 'raw',
                                    'value' => 'Arrival::model()->findByAttributes(array("entry_id_fk"=>$data->id))->total_bag'
                                ),
                                array(
                                    'header' => 'Entance By',
                                    'type' => 'raw',
                                    'value' => '$data->getServiceEntanceBy($data->id)'
                                ),
                                array(
                                    'header' => 'Services',
                                    'type' => 'raw',
                                    'value' => '$data->getServiceNames($data->id)'
                                ),
                                array(
                                    'header' => 'Service Date',
                                    'type' => 'raw',
                                    'value' => '$data->getServiceDate($data->id)'
                                ),
                                array(
                                    'header' => 'Service Time',
                                    'type' => 'raw',
                                    'value' => '$data->getServiceTime($data->id)'
                                ),
                            ),
                            'itemsCssClass' => 'responsive table table-striped table-bordered overflow',
                        ));
                        ?>
                    </div>
                    <div class="tab-pane" id="departure">
                        <?php
                        $Arrival = Arrival::model()->findAll("arrival_date BETWEEN '" . $this->start_date . "' and '" . $this->end_date . "'");
                        $data = array();
                        foreach ($Arrival as $a)
                            array_push($data, $a->entry_id_fk);


                        $Entries = new Entries;
                        $criteria = new CDbCriteria;
                        $criteria->addInCondition('id', $data);
                        $entriesData = new CActiveDataProvider($Entries, array(
                            'criteria' => $criteria,
                            'pagination' => false
                        ));

                        $this->widget('zii.widgets.grid.CGridView', array(
                            'id' => 'departure-vehicle-grid',
                            'dataProvider' => $entriesData,
                            'filter' => $Entries,
                            'columns' => array
                                (
                                array(
                                    'header' => 'PNR',
                                    'value' => '$data->pnr_no'
                                ),
                                array(
                                    'header' => 'Agency',
                                    'value' => 'AgencyMaster::model()->findByPK(
																	$data->agency_id_fk
																)->name'
                                ),
                                array(
                                    'header' => 'Hotel',
                                    'value' => '$data->getHotelName($data->hotel_id_fk)'
                                ),
                                array(
                                    'header' => 'Client Name',
                                    'value' => '$data->client_name
															'
                                ),
                                array(
                                    'header' => 'Status',
                                    'value' => 'Arrival::model()->findByAttributes(array("entry_id_fk"=>$data->id))->hotel_status'
                                ),
                                array(
                                    'header' => 'Conf. By',
                                    'value' => 'Arrival::model()->findByAttributes(array("entry_id_fk"=>$data->id))->confirmed_by'
                                ),
                                array(
                                    'header' => 'Room No.',
                                    'value' => 'Arrival::model()->findByAttributes(array("entry_id_fk"=>$data->id))->room_no'
                                ),
                                array(
                                    'header' => 'Arrive Time',
                                    'value' => 'Arrival::model()->findByAttributes(array("entry_id_fk"=>$data->id))->arrival_time'
                                ),
                                array(
                                    'header' => 'Staff Duty',
                                    'value' => '$data->getNonEditableArrivalStaffDuty($data->id)'
                                ),
                                array(
                                    'header' => 'Driver Name(Mobile)',
                                    'type' => 'raw',
                                    'value' => '$data->getDepartureDriverInfo($data->id)'
                                ),
                                array(
                                    'header' => 'PAX',
                                    'type' => 'raw',
                                    'value' => '$data->getPAX($data->id)'
                                ),
                                array(
                                    'header' => 'Single',
                                    'type' => 'raw',
                                    'value' => '$data->single'
                                ),
                                array(
                                    'header' => 'Double',
                                    'type' => 'raw',
                                    'value' => '$data->double'
                                ),
                                array(
                                    'header' => 'Triple',
                                    'type' => 'raw',
                                    'value' => '$data->triple'
                                ),
                                array(
                                    'header' => 'Total Bags',
                                    'type' => 'raw',
                                    'value' => 'Arrival::model()->findByAttributes(array("entry_id_fk"=>$data->id))->total_bag'
                                ),
                                array(
                                    'header' => 'Asst. Required',
                                    'type' => 'raw',
                                    'value' => '$data->asstDep'
                                ),
                                array(
                                    'header' => 'Check Out Time',
                                    'type' => 'raw',
                                    'value' => '$data->getCheckOutTime($data->id)'
                                ),
                                array(
                                    'header' => 'Voucher Collected By',
                                    'type' => 'raw',
                                    'value' => '$data->getVoucherCollected($data->id)'
                                ),
                            ),
                            'itemsCssClass' => 'responsive table table-striped table-bordered overflow',
                        ));
                        ?>
                    </div>
                        <?php
                    }
                    ?>

            </div>
        </div>
    </div>
    <style>
        #tabs a{
            cursor:pointer;
        }
    </style>
    <script>
        $("#tab-content>div").hide();
        $("#tab-content>div:nth-child(1)").show();
        function openTabs(id) {
            var to_show = "#tab-content>div#" + id,
                    nav_show = "#tabs li>a#" + id + "-nav";
            $("#tab-content>div").hide();
            $(to_show).show();
            $("#tabs li").removeClass("active");
            $(nav_show).parent().addClass("active");
        }
        function AjaxCall(object, controller, method, data, event) {
            var key = event || window.event;
            if (key.keyCode == 13) {
                event.preventDefault();
                $("#progress").show();
                var object = {
                    "key": data[0],
                    "value": data[1],
                    "id": data[2],
                };
                $.ajax({
                    type: 'POST',
                    url: 'index.php?r=' + controller + '/' + method,
                    data: object,
                    success: function(data, textStatus, jqXHR) {
                        data = data.replace('Hotel_status', 'Hotel Status')
                                .replace('Confirmed_by', 'Confirmed By')
                                .replace('Indian_adult', 'Indian Adult')
                                .replace('Indian_child', 'Indian Child')
                                .replace('Foreigner_adult', 'Foreigner Adult')
                                .replace('Foreigner_child', 'Foreigner Child')
                                .replace('Total_bag', 'Total Bags')
                                .replace('Hotel_update_room_remark', 'Remark')
                                .replace('Room_no', 'Room No.')
                                .replace('Voucher_collected_by', 'Voucher Collected By')
                                .replace('Hotel_update_remark', 'Other');

                        alert(data);
                        $("#progress").hide();
                    }
                });


            }
        }

        function AjaxSelectCall(object, controller, method, data, event) {
            event.preventDefault();
            $("#progress").show();
            var object = {
                "key": data[0],
                "value": data[1],
                "id": data[2],
            };
            $.ajax({
                type: 'POST',
                url: 'index.php?r=' + controller + '/' + method,
                data: object,
                success: function(data, textStatus, jqXHR) {
                    data = data.replace('Hotel_status', 'Hotel Status')
                            .replace('Confirmed_by', 'Confirmed By')
                            .replace('Indian_adult', 'Indian Adult')
                            .replace('Indian_child', 'Indian Child')
                            .replace('Foreigner_adult', 'Foreigner Adult')
                            .replace('Foreigner_child', 'Foreigner Child')
                            .replace('Total_bag', 'Total Bags')
                            .replace('Hotel_update_room_remark', 'Remark')
                            .replace('Checked_in_time', 'Check In Time')
                            .replace('Check_out_time', 'Check Out Time')
                            .replace('Entrance_by', 'Entrance By')
                            .replace('Service_id_fk', 'Service Name')
                            .replace('Hotel_update_remark', 'Other');

                    $("#progressStatus").html("<div class='alert alert-success'>" + data + "</div>");
                    $("#progress").hide();
                }
            });

        }

        function AjaxMultiSelectCall(object, controller, method, data, event) {
            event.preventDefault();
            $("#progress").show();
            var selectbox = data[1], multiSelect = [];
            for (var i = 0; i < selectbox.options.length; i++) {
                if (selectbox.options[i].selected == true) {
                    multiSelect.push(selectbox.options[i].value);
                }
            }

            var object = {
                "key": data[0],
                "value": multiSelect.join(","),
                "id": data[2],
            };
            $.ajax({
                type: 'POST',
                url: 'index.php?r=' + controller + '/' + method,
                data: object,
                success: function(data, textStatus, jqXHR) {
                    data = data.replace('Hotel_status', 'Hotel Status')
                            .replace('Confirmed_by', 'Confirmed By')
                            .replace('Indian_adult', 'Indian Adult')
                            .replace('Indian_child', 'Indian Child')
                            .replace('Foreigner_adult', 'Foreigner Adult')
                            .replace('Foreigner_child', 'Foreigner Child')
                            .replace('Total_bag', 'Total Bags')
                            .replace('Hotel_update_room_remark', 'Remark')
                            .replace('Checked_in_time', 'Check In Time')
                            .replace('Check_out_time', 'Check Out Time')
                            .replace('Entrance_by', 'Entrance By')
                            .replace('Service_id_fk', 'Service Name')
                            .replace('Hotel_update_remark', 'Other');

                    $("#progressStatus").html("<div class='alert alert-success'>" + data + "</div>");
                    $("#progress").hide();
                }
            });

        }


    </script>

    <style>
        #tabs a{
            cursor:pointer;
        }
    </style>
    <script>
        $("#tab-content>div").hide();
        $("#tab-content>div:nth-child(1)").show();
        function openTabs(id) {
            var to_show = "#tab-content>div#" + id,
                    nav_show = "#tabs li>a#" + id + "-nav";
            $("#tab-content>div").hide();
            $(to_show).show();
            $("#tabs li").removeClass("active");
            $(nav_show).parent().addClass("active");
        }
    </script>

    <script>
        var counter = 120;
        function updateGrids() {
            var url = '<?php echo Yii::app()->createUrl("HotelRoomUpdate/view", array("start_date" => $this->start_date, "end_date" => $this->end_date)); ?>';
            $.fn.yiiGridView.update('arrival-vehicle-grid', {url: url});
            $.fn.yiiGridView.update('siteseen-vehicle-grid', {url: url});
            $.fn.yiiGridView.update('departure-vehicle-grid', {url: url});
        }
        var updateGinterval = setInterval(updateGrids, 120000);
        var updatecounter = setInterval(function() {
            if (counter == 0) {
                counter = 120;
            }
            else {
                counter--;
            }
            $("#counter").text(counter);
        }
        , 1000);
        
        //$(".chosen-select").trigger("liszt:updated");
    </script>
    <style>.chosen-container{width:150px!important;}</style>

    