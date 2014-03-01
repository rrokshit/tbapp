<div class="<?php echo $this->message_type; ?>"><?php echo $this->message_content; ?></div>
<div class="box gradient">
    <div class="title">
        <h3> 
            <i class="icon-book"></i>
            <span>Departure By
                <span class="botton_mergin3"></span>
                <span class="botton_margin1">
                    <a href="<?php echo Yii::app()->createUrl("Departure/admin", array("arrival", $this->arrival_id)); ?>"  class="btn btn-success">Departure</a>
                </span>
            </span>
        </h3>
    </div>
    <div class="content top ">
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'departure-form',
            'enableAjaxValidation' => false,
        ));
        ?>
        <div class="form-row control-group row-fluid">
            <label class="control-label span3" for="pnr_no">PNR NO</label>
            <div class="controls span7">
                <input type="text" readonly="readonly" value="<?php echo $this->PNR; ?>" class="row-fluid">
            </div>
        </div>

        <div class="form-row control-group row-fluid">
            <label class="control-label span3" for="pnr_no">Arrival Date</label>
            <div class="controls span7">
                <input type="text" name="arrdate" value="<?php echo date("Y-m-d", strtotime($this->arrival_date)); ?>" readonly="readonly" 
                       class="row-fluid"/>

            </div>
        </div>

        <div class="form-row control-group row-fluid">
            <label class="control-label span3" for="pnr_no">Agency</label>
            <div class="controls span7">
                <input type="text" name="agency" 
                       value="<?php echo Entries::model()->findByPK($this->entry)->agencyIdFk->name; ?>" 
                       readonly="readonly" class="row-fluid"/>

            </div>
        </div>

        <div class="form-row control-group row-fluid">
            <label class="control-label span3">Departure Date</label>
            <div class="controls span7">
                <div class="input-append date row-fluid">
                    <?php
                    $date = ($model->dept_date == '0000-00-00') ? Arrival::model()->findByPK($_GET['arrival'])->arrival_date : $model->dept_date;
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model' => $model,
                        'attribute' => 'dept_date',
                        'options' => array(
                            'dateFormat' => 'yy-mm-dd',
                            'altFormat' => 'yy-mm-dd',
                            'showButtonPanel' => true,
                            'changeMonth' => true,
                            'changeYear' => true,
                            'yearRange' => '1900:2099'
                        ),
                        'htmlOptions' => array(
                            'value' => $date,
                            'class' => 'row-fluid',
                        ),
                    ));
                    ?>
                    <span class="add-on"><i class="icon-th"></i></span> 
                </div>
            </div>
        </div>

        <div class="form-row control-group row-fluid">
            <label class="control-label span3">Departure By</label>
            <div class="controls span7">

                <?php
                if (Yii::app()->controller->action->id == 'update') {

                    echo $form->dropDownList($model, 'to_departure', array('Train' => 'Train', 'Bus' => 'Bus', 'Flight' => 'Flight', 'Surface' => 'Surface'), array('empty' => 'Select To Departure', 'id' => 'Departure_to_departure',
                        'options' => array(
                            $model->to_departure => array('selected' => 'true'),
                    )));
                } else {
                    echo $form->dropDownList($model, 'to_departure', array('Train' => 'Train', 'Bus' => 'Bus', 'Flight' => 'Flight', 'Surface' => 'Surface'), array('empty' => 'Select To Departure', 'id' => 'Departure_to_departure'));
                }
                ?>

            </div>
        </div>
        
        <div class="form-row control-group row-fluid">
            <label class="control-label span3">To Departure</label>
            <div class="controls span7">
            <?php echo $form->textField($model, 'departure_to', array('class' => 'row-fluid', 'value' => $model->departure_to)); ?>
            </div>
        </div>
        
        <div id="departureByTrain" class="row-fluid" <?php echo ( $model->to_departure == 'Train') ? 'style="display:block;"' : 'style="display:none;"'; ?>>
            <div class="form-row control-group row-fluid" id="A_train_name">
                <label class="control-label span3">Train Name</label>
                <div class="controls span7">
<?php
echo CHtml::activeDropDownList($model, 'train_id_fk', CHtml::listData(TrainMaster::model()->findAll(), 'id', 'name'), array(
    'ajax' => array(
        'type' => 'POST',
        'url' => CController::createUrl('Departure/TrainNumberArrivalTime'),
        'data' => array('val' => 'js:$(this).val()'),
        'success' => 'function(data){
																		var arr = data.split(",");
																		$("#txtTrainNumber").val(arr[0]);
																		$("#txtTrainDepartureTime").val(arr[1]);
																	}'
    ),
    'id' => 'slTrain',
    'empty' => 'Select Train',
    'options' => array(
        $model->train_id_fk => array('selected', 'true')
    ),
    'class' => 'other-select',
    'data-field' => 'train',
        )
);
?>									
                </div>
            </div>

            <div class="form-row control-group row-fluid">
                <label class="control-label span3" for="Phone_no">Train No</label>
                <div class="controls span7">
                    <input type="text" readonly="readonly" id="txtTrainNumber"
                           value="<?php if ($model->train_id_fk != 0) echo TrainMaster::model()->findByPK($model->train_id_fk)->number; ?>"
                           />
                </div>
            </div>

            <div class="form-row control-group row-fluid">
                <label class="control-label span3" for="Phone_no">Departure Time</label>
                <div class="controls span7">
                    <input type="text" name="Departure[train_dept_time]" readonly="readonly" id="txtTrainDepartureTime"
                           value="<?php if ($model->train_id_fk != 0) echo TrainMaster::model()->findByPK($model->train_id_fk)->arrival_time; ?>" />
                </div>
            </div>


        </div>
        <div id="departureByBus" class="row-fluid" <?php echo ( $model->to_departure == 'Bus') ? 'style="display:block;"' : 'style="display:none;"'; ?>>
            <div class="form-row control-group row-fluid" id="A_train_name">
                <label class="control-label span3">Bus Name</label>
                <div class="controls span7">
<?php
echo CHtml::activeDropDownList($model, 'bus_id_fk', CHtml::listData(BusMaster::model()->findAll(), 'id', 'name'), array(
    'ajax' => array(
        'type' => 'POST',
        'url' => CController::createUrl('Departure/BusNumberArrivalTime'),
        'data' => array('val' => 'js:$(this).val()'),
        'success' => 'function(data){
																		$("#txtBusDepartureTime").val(data);
																	}'
    ),
    'id' => 'slBus',
    'empty' => 'Select Bus',
    'options' => array(
        $model->bus_id_fk => array('selected', 'true')
    ),
    'class' => 'other-select',
    'data-field' => 'bus',
        )
);
?>									
                </div>
            </div>

            <div class="form-row control-group row-fluid">
                <label class="control-label span3" for="Phone_no">Departure Time</label>
                <div class="controls span7">
                    <input type="text" readonly="readonly" name="Departure[bus_dept_time]" id="txtBusDepartureTime"
                           value="<?php if ($model->bus_id_fk != 0) echo BusMaster::model()->findByPK($model->bus_id_fk)->arrival_time; ?>" 
                           />
                </div>
            </div>
        </div>
        <div id="departureByFlight" class="row-fluid" <?php echo ( $model->to_departure == 'Flight') ? 'style="display:block;"' : 'style="display:none;"'; ?>>
            <div class="form-row control-group row-fluid" id="A_train_name">
                <label class="control-label span3">Flight Name</label>
                <div class="controls span7">
<?php
echo CHtml::activeDropDownList($model, 'flight_id_fk', CHtml::listData(FlightMaster::model()->findAll(), 'id', 'name'), array(
    'ajax' => array(
        'type' => 'POST',
        'url' => CController::createUrl('Departure/FlightNumberArrivalTime'),
        'data' => array('val' => 'js:$(this).val()'),
        'success' => 'function(data){
																		$("#txtFlightDepartureTime").val(data);
																	}'
    ),
    'id' => 'slFlight',
    'empty' => 'Select Flight',
    'options' => array(
        $model->flight_id_fk => array('selected', 'true'),
    ),
    'class' => 'other-select',
    'data-field' => 'flight',
        )
);
?>									
                </div>
            </div>

            <div class="form-row control-group row-fluid">
                <label class="control-label span3" for="Phone_no">Departure Time</label>
                <div class="controls span7">
                    <input type="text" readonly="readonly" name="Departure[flight_dept_time]" id="txtFlightDepartureTime"
                           value="<?php if ($model->flight_id_fk != 0) echo FlightMaster::model()->findByPK($model->flight_id_fk)->arrival_time; ?>" 
                           />
                </div>
            </div>
        </div>
        <div id="departureBySurface" class="row-fluid" <?php echo ( $model->to_departure == 'Surface') ? 'style="display:block;"' : 'style="display:none;"'; ?>>
            <div class="form-row control-group row-fluid" id="A_surface_location" >
                <label class="control-label span3" for="Phone_no">Location</label>
                <div class="controls span7">
<?php echo $form->textField($model, 'surface_location', array('size' => 20, 'maxlength' => 20, 'class' => 'row-fluid', 'value' => $model->surface_location));
?>
                </div>
            </div>
            <div class="form-row control-group row-fluid" id="A_from" >
                <label class="control-label span3">To</label>
                <div class="controls span7">
<?php
echo $form->dropDownList($model, 'to', CHtml::listData(Places::model()->findAll(), 'id', 'name'), array('empty' => 'Select City',
    'options' => array(
        $model->to => array('selected' => 'true'),
)));
?>


                </div>
            </div>

            <div class="form-row control-group row-fluid" id="A_arrival_time" >
                <label class="control-label span3" for="Phone_no">Departure Time</label>
                <div class="controls span7">
<?php
echo CHtml::activeDropDownList($model, 'dept_time', $this->getTime(), array(
    'options' => array(
        $model->dept_time => array(
            'selected' => 'true',
        )
    ),
    'empty' => '',
    'style' => 'width:75px;',
    'name' => 'Departure[surface_dept_time]',
    'class' => 'row-fluid'
        )
);
?>
                </div>
            </div>
        </div>

        <div class="form-row control-group row-fluid">
            <label class="control-label span3">Vehicle By TB</label>
            <div class="controls span7">
                    <?php
                    echo $form->dropDownList($model, 'vehicle_required', array('Yes' => 'Yes', 'No' => 'No'), array('empty' => 'Select Yes/No', 'id' => 'Departure_vehicle_required'));
                    ?> 
            </div>
        </div>

                    <?php
                    $vehicleYes = '';
                    $vehicleNo = '';
                    if (Yii::app()->controller->action->id == 'update') {
                        if ($model->vehicle_required == 'Yes') {
                            $vehicleYes = 'style="display:block"';
                            $vehicleNo = 'style="display:none"';
                        } else if ($model->vehicle_required == 'No') {
                            $vehicleYes = 'style="display:none"';
                            $vehicleNo = 'style="display:block"';
                        }
                    }
                    ?>

        <!-- start if vehicle yes -->
        <span id="ifVehicleYes" <?php echo $vehicleYes; ?> style="display:none;">
            <div class="form-row control-group row-fluid">
                <label class="control-label span3">Transfer To</label>
                <div class="controls span7">
        <?php echo $form->textField($model, 'transferFrm', array('class' => 'row-fluid', 'value' => $model->transferFrm)); ?>
                </div>
            </div>

        <?php
        $Arrival = Arrival::model()->findByPK($this->arrival_id);
        $ArrivalUniquCategoryData = Yii::app()->db->createCommand("SELECT DISTINCT(category_id_fk) 
				FROM arrivalvehicle WHERE arrival_id_fk=" . $this->arrival_id . ";")->queryAll();
        $counter = 0;
        if (Yii::app()->controller->action->id == 'create') {
            ?>
                <div class="form-row control-group row-fluid">
                    <label class="control-label span3">Total Vehicle</label>
                    <div class="controls span7">
    <?php
    echo $form->textField($model, 'total_vehicle', array('class' => 'row-fluid', 'value' => count($ArrivalUniquCategoryData),
        'id' => 'Departure_total_vehicle'));
    ?>
                    </div>
                </div>
    <?php
} else {
    ?>
                <div class="form-row control-group row-fluid">
                    <label class="control-label span3">Total Vehicle</label>
                    <div class="controls span7">
                <?php
                echo $form->textField($model, 'total_vehicle', array('class' => 'row-fluid', 'value' => $model->total_vehicle,
                    'id' => 'Departure_total_vehicle'));
                ?>
                    </div>
                </div>
                        <?php
                    }
                    ?>
            <span id="DepartureVehicle" style="display: none">
                <table>
                    <tr>
                        <td>
                            <div class="form-row control-group row-fluid">
                                <div class="controls span7">
            <?php
            $dropDownVal = CHtml::listData(VehicleCategory::model()->findAll(), 'id', 'category');
            echo $form->dropDownList($model_departureVehicle, 'category_id_fk[]', $dropDownVal, array('empty' => 'Select Vehicle Category'));
            ?> 
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-row control-group row-fluid">
                                <div class="controls span7">
            <?php
            echo $form->dropDownList($model_departureVehicle, 'acOrNot[]', array('AC' => 'AC', 'Non AC' => 'Non AC'));
            ?> 
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-row control-group row-fluid">
                                <div class="controls span7">
                                    <?php
                                    echo $form->textField($model_departureVehicle, 'noOfVehicle[]', array('value' => 0));
                                    ?> 
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </span>

            <span id="DepartureVehicleDoc">
                                    <?php
                                    if (Yii::app()->controller->action->id == 'update' && $model->total_vehicle > 0) {
                                        $UniquCategoryData = Yii::app()->db->createCommand("SELECT DISTINCT(category_id_fk) 
						FROM departurevehicle WHERE dept_id_fk=" . $_GET['id'] . ";")->queryAll();
                                        foreach ($UniquCategoryData as $d) {
                                            $countVehicle = count(Departurevehicle::model()->findAll("dept_id_fk = " . $_GET['id'] . " AND category_id_fk=" . $d['category_id_fk']));
                                            $acOrNot = Yii::app()->db->createCommand("SELECT acOrNot FROM departurevehicle WHERE dept_id_fk = " . $_GET['id'] . " AND category_id_fk=" . $d['category_id_fk'] . " LIMIT 1")->queryAll();
                                            $acOrNot = $acOrNot[0]['acOrNot'];
                                            ?>
                        <table>
                            <tr>
                                <td>
                                    <div class="form-row control-group row-fluid">
                                        <div class="controls span7">
        <?php
        echo $form->dropDownList($model_departureVehicle, 'category_id_fk[]', CHtml::listData(VehicleCategory::model()->findAll(), 'id', 'category'), array('empty' => 'Select Category',
            'options' => array(
                $d['category_id_fk'] => array('selected' => 'true')
            ))
        );
        ?> 
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-row control-group row-fluid">
                                        <div class="controls span7">
                        <?php
                        echo $form->dropDownList($model_departureVehicle, 'acOrNot[]', array('AC' => 'AC', 'Non AC' => 'Non AC'), array('options' => array($acOrNot => array('selected' => 'true'))));
                        ?> 
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-row control-group row-fluid">
                                        <div class="controls span7">
                                            <?php
                                            echo $form->textField($model_departureVehicle, 'noOfVehicle[]', array('value' => $countVehicle));
                                            ?> 
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
        <?php
    }
} else {
    if ($Arrival->total_vehicle > 0) {
        foreach ($ArrivalUniquCategoryData as $d) {
            $countVehicle = count(ArrivalVehicle::model()->findAll("arrival_id_fk = " . $this->arrival_id . " AND category_id_fk=" . $d['category_id_fk']));
            $acOrNot = Yii::app()->db->createCommand("SELECT acOrNot FROM arrivalvehicle WHERE arrival_id_fk = " . $this->arrival_id . " AND category_id_fk=" . $d['category_id_fk'] . " LIMIT 1")->queryAll();
            $acOrNot = $acOrNot[0]['acOrNot'];
            ?>
                            <table>
                                <tr>
                                    <td>
                                        <div class="form-row control-group row-fluid">
                                            <div class="controls span7">
            <?php
            echo $form->dropDownList($model_departureVehicle, 'category_id_fk[]', CHtml::listData(VehicleCategory::model()->findAll(), 'id', 'category'), array('empty' => 'Select Category',
                'options' => array(
                    $d['category_id_fk'] => array('selected' => 'true')
                ))
            );
            ?> 
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-row control-group row-fluid">
                                            <div class="controls span7">
                            <?php
                            echo $form->dropDownList($model_departureVehicle, 'acOrNot[]', array('AC' => 'AC', 'Non AC' => 'Non AC'), array('options' => array($acOrNot => array('selected' => 'true'))));
                            ?> 
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-row control-group row-fluid">
                                            <div class="controls span7">
            <?php
            echo $form->textField($model_departureVehicle, 'noOfVehicle[]', array('value' => $countVehicle));
            ?> 
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>

                                                <?php
                                            }
                                        }
                                    }
                                    ?>
            </span>


        </span>

        <!-- end if vehicle yes -->

        <!-- start if vehicle no -->
        <span id="ifVehicleNo" <?php echo $vehicleNo; ?>  style="display:none;">
            <div class="form-row control-group row-fluid">
                <label class="control-label span3">Driver Name</label>
                <div class="controls span7">
<?php
if (Yii::app()->controller->action->id == 'create') {
    ?>
                                        <?php echo $form->textField($model, 'clientDriverName', array('class' => 'row-fluid', 'value' => Arrival::model()->findByPK($_GET['arrival'])->clientDriverName)); ?>
                                        <?php
                                    } else {
                                        ?>
                                        <?php echo $form->textField($model, 'clientDriverName', array('class' => 'row-fluid', 'value' => $model->clientDriverName)); ?>
    <?php
}
?>	
                </div>
            </div>
            <div class="form-row control-group row-fluid">
                <label class="control-label span3">Mobile No.</label>
                <div class="controls span7">
                <?php
                if (Yii::app()->controller->action->id == 'create') {
                    ?>
    <?php echo $form->textField($model, 'clientDriverMobile', array('class' => 'row-fluid', 'value' => Arrival::model()->findByPK($_GET['arrival'])->clientDriverMobile)); ?>

    <?php
} else {
    ?>
    <?php echo $form->textField($model, 'clientDriverMobile', array('class' => 'row-fluid', 'value' => $model->clientDriverMobile)); ?>
    <?php
}
?>
                </div>
            </div>
        </span>
        <!-- end if vehicle no -->



        <div class="form-row control-group row-fluid" id="outsite_vehicle_no">
            <label class="control-label span3" for="Phone_no">Remarks</label>
            <div class="controls span7">
                    <?php echo $form->textField($model, 'remarks', array('class' => 'row-fluid', 'value' => $model->remarks)); ?>
            </div>
        </div>


        <div class="form-actions row-fluid">
            <div class="span7 offset3">
                <button type="submit" class="btn btn-primary">Save changes</button>
                <input type="reset" class="btn btn-secondary" value="Cancel"/>
            </div>
        </div>
                    <?php $this->endWidget(); ?>
    </div>

</div>	


<script>
    $("#Departure_total_vehicle").keyup(function() {
        var val = $(this).val();
        var arrivalVehicle = $("#DepartureVehicle").html();
        $("#DepartureVehicleDoc").html('');
        for (var i = 0; i < val; i++) {
            $("#DepartureVehicleDoc").append(arrivalVehicle);
        }
    });
    $("#Departure_vehicle_required").change(function() {
        if ($(this).val() == 'Yes') {
            $("#ifVehicleYes").css("display", "block");
            $("#ifVehicleNo").css("display", "none");
        } else if ($(this).val() == 'No') {
            $("#ifVehicleNo").css("display", "block");
            $("#ifVehicleYes").css("display", "none");
        } else {
            $("#ifVehicleNo").css("display", "none");
            $("#ifVehicleYes").css("display", "none");
        }
    });

    $("#Departure_to_departure").change(function() {
        var val = $(this).val();
        $("#departureByBus").hide();
        $("#departureByTrain").hide();
        $("#departureByFlight").hide();
        $("#departureBySurface").hide();
        if (val == 'Train') {
            $("#departureByTrain").show();
        }
        else if (val == 'Bus') {
            $("#departureByBus").show();
        }
        else if (val == 'Flight') {
            $("#departureByFlight").show();
        }
        else if (val == 'Surface') {
            $("#departureBySurface").show();
        }
    });


</script>