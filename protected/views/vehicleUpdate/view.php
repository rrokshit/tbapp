
<div class="<?php echo $this->message_type; ?>"><?php echo $this->message_content; ?></div>
<div class="row-fluid">
    <div id="progressStatus"></div>
    <div class="box gradient">
        <div class="title">
            <h3> 
                <i class="icon-book"></i>
                <span>Vehicle Update
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
                'id' => 'vehicle-update- form',
                //'action'=>Yii::app()->request->baseUrl.'/index.php/arrival/create',
                'enableAjaxValidation' => false,
            ));
            ?>

            <div class="form-row control-group row-fluid">
                <label class="control-label span3">Start Date</label>
                <div class="controls span7">
                    <div class="input-append date row-fluid">
                        <?php
                        if ($_POST['VehicleUpdate']['start_date'] && $_POST['VehicleUpdate']['end_date']) {
                            $startDate = date("d-m-Y", strtotime($this->start_date));
                            $endDate = date("d-m-Y", strtotime($this->end_date));
                        } else {
                            $startDate = date("d-m-Y");
                            $endDate = date("d-m-Y");
                        }

                        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'name' => 'VehicleUpdate[start_date]',
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
            </div>
            <div class="form-row control-group row-fluid">
                <label class="control-label span3" >End Date</label>
                <div class="controls span7">
                    <div class="input-append date row-fluid">
                        <?php
                        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'name' => 'VehicleUpdate[end_date]',
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
                    <li class="active"><a onclick="openTabs('arrival');" id="arrival-nav" >Arrival Vehicles</a></li>
                    <li><a onclick="openTabs('siteseen');"  id="siteseen-nav">Sightseen Vehicles</a></li>
                    <li><a onclick="openTabs('departure');"  id="departure-nav">Departure Vehicles</a></li>
                </ul>
                <div style="margin:5px 0;">Data will be refresh in <span id="counter"></span> sec.</div>
                <div class="tab-content" id="tab-content">
                    <div class="tab-pane" id="arrival">

                        <?php
                        $Arrival = Arrival::model()->findAll("arrival_date BETWEEN '" . $this->start_date . "' AND '" . $this->end_date . "'");
                        $data = array();
                        foreach ($Arrival as $a)
                            array_push($data, $a->id);

                        $ArrivalVehicle = new ArrivalVehicle;
                        $criteria = new CDbCriteria;
                        $criteria->addInCondition('arrival_id_fk', $data);
                        $arrivalVehicles = new CActiveDataProvider($ArrivalVehicle, array(
                            'criteria' => $criteria,
                            'pagination' => false
                        ));

                        $this->widget('zii.widgets.grid.CGridView', array(
                            'id' => 'arrival-vehicle-grid',
                            'dataProvider' => $arrivalVehicles,
                            'filter' => $ArrivalVehicle,
                            'columns' => array
                                (
                                array(
                                    'header' => 'PNR',
                                    'value' => 'Entries::model()->findByPK(
															Arrival::model()->findByPK(
																$data->arrival_id_fk
															)->entry_id_fk
														)->pnr_no'
                                ),
                                array(
                                    'header' => 'Agency',
                                    'value' => 'AgencyMaster::model()->findByPK(
																Entries::model()->findByPK(
																	Arrival::model()->findByPK(
																		$data->arrival_id_fk
																	)->entry_id_fk
																)->agency_id_fk
															)->name'
                                ),
                                array(
                                    'header' => 'Hotel',
                                    'value' => 'Entries::model()->getHotelName(
																	Entries::model()->findByPK(
																		Arrival::model()->findByPK(
																			$data->arrival_id_fk
																		)->entry_id_fk
																	)->hotel_id_fk
																)'
                                ),
                                array(
                                    'header' => 'Client Name',
                                    'value' => 'Entries::model()->findByPK(
																	Arrival::model()->findByPK(
																		$data->arrival_id_fk
																	)->entry_id_fk
															)->client_name
														'
                                ),
                                array(
                                    'header' => 'PAX',
                                    'value' => '$data->getPAX(Arrival::model()->findByPK(
																$data->arrival_id_fk
															)->entry_id_fk)'
                                ),
                                array(
                                    'header' => 'Arrival Services',
                                    'value' => 'Arrival::model()->findByPK(
																	$data->arrival_id_fk
																)->arrival_service'
                                ),
                                array(
                                    'header' => 'Time',
                                    'value' => 'Arrival::model()->findByPK(
																		$data->arrival_id_fk
																	)->arrival_time
														'
                                ),
                                array(
                                    'header' => 'Total Vehicle',
                                    'value' => '1'
                                ),
                                array(
                                    'header' => 'Vehicle Category',
                                    'value' => 'VehicleCategory::model()->findByPK($data->category_id_fk)->category'
                                ),
                                array(
                                    'header' => 'Ac or Not',
                                    'value' => '$data->acOrNot'
                                ),
                                array(
                                    'header' => 'Vehicle Number',
                                    'type' => 'raw',
                                    'value' => '$data->getVehicles($data->id)'
                                ),
                                array(
                                    'header' => 'Driver Name',
                                    'type' => 'raw',
                                    'value' => '$data->getDrivers($data->id)'
                                ),
                                array(
                                    'header' => 'Driver Mobile',
                                    'type' => 'raw',
                                    'value' => '$data->getDriverMobile($data->driver_id_fk, $data->id)'
                                ),
                            ),
                            'itemsCssClass' => 'responsive table table-striped table-bordered',
                        ));
                        ?>
                    </div>
                    <div class="tab-pane" id="siteseen">

                        <?php
                        $SiteseenServices = SiteseenServices::model()->findAll("date >='" . $this->start_date . "' AND date <='" . $this->end_date . "'");
                        foreach ($SiteseenServices as $s)
                            array_push($data, $s->id);

                        $SiteseenServiceVehicles = new SiteseenServiceVehicles;
                        $criteria = new CDbCriteria;
                        $criteria->addInCondition('siteseen_service_id_fk', $data);
                        $siteseenServicesVehicles = new CActiveDataProvider($SiteseenServiceVehicles, array(
                            'criteria' => $criteria,
                            'pagination' => false
                        ));


                        $this->widget('zii.widgets.grid.CGridView', array(
                            'id' => 'siteseen-vehicle-grid',
                            'dataProvider' => $siteseenServicesVehicles,
                            'filter' => $SiteseenServiceVehicles,
                            'columns' => array
                                (
                                array(
                                    'header' => 'PNR',
                                    'value' => 'Entries::model()->findByPK(
																Arrival::model()->findByPK(
																	Sightseen::model()->findByPK(
																		SiteseenServices::model()->findByPK(
																			$data->siteseen_service_id_fk
																		)->siteseen_id_fk
																	)->arrival_id_fk
																)->entry_id_fk
															)->pnr_no'
                                ),
                                array(
                                    'header' => 'Agency',
                                    'value' => 'AgencyMaster::model()->findByPK(
																Entries::model()->findByPK(
																	Arrival::model()->findByPK(
																		Sightseen::model()->findByPK(
																			SiteseenServices::model()->findByPK(
																				$data->siteseen_service_id_fk
																			)->siteseen_id_fk
																		)->arrival_id_fk
																	)->entry_id_fk
																)->agency_id_fk
															)->name'
                                ),
                                array(
                                    'header' => 'Hotel',
                                    'value' => 'Entries::model()->getHotelName(
																Entries::model()->findByPK(
																	Arrival::model()->findByPK(
																		Sightseen::model()->findByPK(
																			SiteseenServices::model()->findByPK(
																				$data->siteseen_service_id_fk
																			)->siteseen_id_fk
																		)->arrival_id_fk
																	)->entry_id_fk
																)->hotel_id_fk
															)'
                                ),
                                array(
                                    'header' => 'Services',
                                    'value' => '$data->getServicesNames($data->siteseen_service_id_fk)'
                                ),
                                array(
                                    'header' => 'Client Name',
                                    'value' => 'Entries::model()->findByPK(
																Arrival::model()->findByPK(
																	Sightseen::model()->findByPK(
																		SiteseenServices::model()->findByPK(
																			$data->siteseen_service_id_fk
																		)->siteseen_id_fk
																	)->arrival_id_fk
																)->entry_id_fk
															)->client_name'
                                ),
                                array(
                                    'header' => 'PAX',
                                    'value' => '$data->getPAX(Arrival::model()->findByPK(
																	Sightseen::model()->findByPK(
																		SiteseenServices::model()->findByPK(
																			$data->siteseen_service_id_fk
																		)->siteseen_id_fk
																	)->arrival_id_fk
																)->entry_id_fk)'
                                ),
                                array(
                                    'header' => 'Time',
                                    'value' => 'SiteseenServices::model()->findByPK(
																$data->siteseen_service_id_fk
															)->time'
                                ),
                                array(
                                    'header' => 'Total Vehicle',
                                    'value' => '1'
                                ),
                                array(
                                    'header' => 'Vehicle Category',
                                    'value' => 'VehicleCategory::model()->findByPK($data->category_id_fk)->category'
                                ),
                                array(
                                    'header' => 'Ac or Not',
                                    'value' => '$data->acOrNot'
                                ),
                                array(
                                    'header' => 'Vehicle Number',
                                    'type' => 'raw',
                                    'value' => '$data->getVehicles($data->id, $data->vehicle_id_fk)'
                                ),
                                array(
                                    'header' => 'Driver Name',
                                    'type' => 'raw',
                                    'value' => '$data->getDrivers($data->id, $data->driver_id_fk)'
                                ),
                                array(
                                    'header' => 'Driver Mobile',
                                    'type' => 'raw',
                                    'value' => '$data->getDriverMobile($data->driver_id_fk, $data->id)'
                                ),
                            ),
                            'itemsCssClass' => 'responsive table table-striped table-bordered',
                        ));
                        ?>
                    </div>
                    <div class="tab-pane" id="departure">

                        <?php
                        $Departure = Departure::model()->findAll("dept_date >='" . $this->start_date . "' AND dept_date <='" . $this->end_date . "'");
                        $data = array();
                        foreach ($Departure as $a)
                            array_push($data, $a->id);

                        $DepartureVehicle = new Departurevehicle;
                        $criteria = new CDbCriteria;
                        $criteria->addInCondition('dept_id_fk', $data);
                        $departureVehicles = new CActiveDataProvider($DepartureVehicle, array(
                            'criteria' => $criteria,
                            'pagination' => false
                        ));

                        $this->widget('zii.widgets.grid.CGridView', array(
                            'id' => 'departure-vehicle-grid',
                            'dataProvider' => $departureVehicles,
                            'filter' => $DepartureVehicle,
                            'columns' => array
                                (
                                array(
                                    'header' => 'PNR',
                                    'value' => 'Entries::model()->findByPK(
															Arrival::model()->findByPK(
																Departure::model()->findByPK(
																	$data->dept_id_fk
																)->arrival_id_fk
															)->entry_id_fk
														)->pnr_no'
                                ),
                                array(
                                    'header' => 'Agency',
                                    'value' => 'AgencyMaster::model()->findByPK(
																Entries::model()->findByPK(
																	Arrival::model()->findByPK(
																		Departure::model()->findByPK(
																			$data->dept_id_fk
																		)->arrival_id_fk
																	)->entry_id_fk
																)->agency_id_fk
															)->name'
                                ),
                                array(
                                    'header' => 'Hotel',
                                    'value' => 'Entries::model()->getHotelName(
																Entries::model()->findByPK(
																	Arrival::model()->findByPK(
																		Departure::model()->findByPK(
																			$data->dept_id_fk
																		)->arrival_id_fk
																	)->entry_id_fk
																)->hotel_id_fk
															)'
                                ),
                                array(
                                    'header' => 'Client Name',
                                    'value' => 'Entries::model()->findByPK(
																Arrival::model()->findByPK(
																	Departure::model()->findByPK(
																		$data->dept_id_fk
																	)->arrival_id_fk
																)->entry_id_fk
															)->client_name'
                                ),
                                array(
                                    'header' => 'PAX',
                                    'value' => '$data->getPAX(Arrival::model()->findByPK(
																	Departure::model()->findByPK(
																		$data->dept_id_fk
																	)->arrival_id_fk
																)->entry_id_fk)'
                                ),
                                array(
                                    'header' => 'Arrival Services',
                                    'value' => 'Departure::model()->findByPK(
																	$data->dept_id_fk
																)->departure_service'
                                ),
                                array(
                                    'header' => 'Time',
                                    'value' => 'Departure::model()->findByPK(
															$data->dept_id_fk
														)->dept_time'
                                ),
                                array(
                                    'header' => 'Total Vehicle',
                                    'value' => '1'
                                ),
                                //Departurevehicle::model()->count("dept_id_fk=".$data->dept_id_fk)
                                array(
                                    'header' => 'Vehicle Category',
                                    'value' => 'VehicleCategory::model()->findByPK($data->category_id_fk)->category'
                                ),
                                array(
                                    'header' => 'Ac or Not',
                                    'value' => '$data->acOrNot'
                                ),
                                array(
                                    'header' => 'Vehicle Number',
                                    'type' => 'raw',
                                    'value' => '$data->getVehicles($data->id, $data->vehicle_id_fk)'
                                ),
                                array(
                                    'header' => 'Driver Name',
                                    'type' => 'raw',
                                    'value' => '$data->getDrivers($data->id, $data->driver_id_fk)'
                                ),
                                array(
                                    'header' => 'Driver Mobile',
                                    'type' => 'raw',
                                    'value' => '$data->getDriverMobile($data->driver_id_fk, $data->id)'
                                ),
                            ),
                            'itemsCssClass' => 'responsive table table-striped table-bordered',
                        ));
                        ?>
                    </div>
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
</script>
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
                if (object.key == "driver_id_fk") {
                    var result = data.split("%");
                    $(event.target).parent().next().find("input").val(result[1]);
                    data = result[0];
                }
                data = data.replace('Vehicle_id_fk', 'Vehicle')
                        .replace('Driver_id_fk', 'Driver');

                $("#progressStatus").html("<div class='alert alert-success'>" + data + "</div>");
                $("#progress").hide();
            }
        });

    }


</script>

<script>
    var counter = 120;
    function updateGrids() {
        var url = '<?php echo Yii::app()->createUrl("VehicleUpdate/view", array("start_date" => $this->start_date, "end_date" => $this->end_date)); ?>';
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
</script>

