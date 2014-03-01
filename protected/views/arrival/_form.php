<div class="<?php echo $this->message_type; ?>"><?php echo $this->message_content; ?></div>
<div class="row-fluid">
    <div class="box gradient">
        <div class="title">
            <h3> 
                <i class="icon-book"></i>
                <span>Arrival By
                    <span class="botton_mergin3"></span>
                    <span class="botton_margin1">
                        <a href="<?php echo Yii::app()->createUrl("Arrival/admin", array("entry" => $this->entry_id)); ?>"  class="btn btn-success">Arrivals</a>
                    </span>
                </span>
            </h3>
        </div>

        <div class="content top ">
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'arrival-form',
                //'action'=>Yii::app()->request->baseUrl.'/index.php/arrival/create',
                'enableAjaxValidation' => false,
            ));
            ?>

            <div class="form-row control-group row-fluid">
                <label class="control-label span3" for="pnr_no">PNR NO</label>
                <div class="controls span7">
                    <input type="text" readonly="readonly" class="row-fluid" name ="Entries[pnr_no]" 
                           value="<?php echo Entries::model()->findByPK($this->entry_id)->pnr_no; ?>"/>
                </div>
            </div>

            <div class="form-row control-group row-fluid">
                <label class="control-label span3">Arrival Date</label>
                <div class="controls span7">
                    <div class="input-append date row-fluid">
                        <?php
                        $date = '';
                        if (Yii::app()->controller->action->id == 'create') {
                            $date = Entries::model()->findByPK($this->entry_id)->arrival_date;
                        } else {
                            $date = $model->arrival_date;
                        }
                        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'model' => $model,
                            'attribute' => 'arrival_date',
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
                <label class="control-label span3" for="pnr_no">Agency</label>
                <div class="controls span7">
                    <input type="text" class="row-fluid" readonly="readonly" 
                           value="<?php echo Entries::model()->findByPK($this->entry_id)->agencyIdFk->name; ?>"/>
                </div>
            </div>


            <div class="form-row control-group row-fluid">
                <label class="control-label span3">From Arrival</label>
                <div class="controls span7">
                    <?php
                    echo $form->dropDownList($model, 'arrival_by', array('Train' => 'Train', 'Bus' => 'Bus', 'Flight' => 'Flight', 'Surface' => 'Surface'), array('empty' => 'Select Any'));
                    ?>
                </div>
            </div>


            <div id="arrivalByTrain" class="row-fluid" <?php echo ($model->arrival_by == "Train") ? "style='display:block;'" : "style='display:none;'"; ?>>
                <div class="form-row control-group row-fluid" id="A_train_name">
                    <label class="control-label span3">Train Name</label>
                    <div class="controls span7">
<?php
echo CHtml::activeDropDownList($model, 'train_id_fk', CHtml::listData(TrainMaster::model()->findAll(), 'id', 'name'), array(
    'ajax' => array(
        'type' => 'POST',
        'url' => CController::createUrl('Arrival/TrainNumberArrivalTime'),
        'data' => array('val' => 'js:$(this).val()'),
        'success' => 'function(data){
																			var arr = data.split(",");
																			$("#txtTrainNumber").val(arr[0]);
																			$("#txtTrainArrivalTime").val(arr[1]);
																		}'
    ),
    'id' => 'slTrain',
    'class' => 'other-select',
    'data-field' => 'train',
    'empty' => 'Select Train',
    'options' => array(
        $model->train_id_fk => array(
            'selected' => 'true',
        )
    )
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
                    <label class="control-label span3" for="Phone_no">Arrival Time</label>
                    <div class="controls span7">
                        <input type="text" name="Arrival[train_arrival_time]" readonly="readonly" id="txtTrainArrivalTime"
                               value="<?php if ($model->train_id_fk != 0) echo TrainMaster::model()->findByPK($model->train_id_fk)->arrival_time; ?>" />
                    </div>
                </div>


            </div>

            <div id="arrivalByBus" class="row-fluid" <?php echo ($model->arrival_by == "Bus") ? "style='display:block;'" : "style='display:none;'"; ?>>
                <div class="form-row control-group row-fluid" id="A_train_name">
                    <label class="control-label span3">Bus Name</label>
                    <div class="controls span7">
<?php
echo CHtml::activeDropDownList($model, 'bus_id_fk', CHtml::listData(BusMaster::model()->findAll(), 'id', 'name'), array(
    'ajax' => array(
        'type' => 'POST',
        'url' => CController::createUrl('Arrival/BusNumberArrivalTime'),
        'data' => array('val' => 'js:$(this).val()'),
        'success' => 'function(data){
																			$("#txtBusArrivalTime").val(data);
																		}'
    ),
    'id' => 'slBus',
    'class' => 'other-select',
    'data-field' => 'bus',
    'empty' => 'Select Bus',
    'options' => array(
        $model->bus_id_fk => array(
            'selected' => 'true',
        )
    )
        )
);
?>									
                    </div>
                </div>

                <div class="form-row control-group row-fluid">
                    <label class="control-label span3" for="Phone_no">Arrival Time</label>
                    <div class="controls span7">
                        <input type="text" readonly="readonly" name="Arrival[bus_arrival_time]" id="txtBusArrivalTime"
                               value="<?php if ($model->bus_id_fk != 0) echo BusMaster::model()->findByPK($model->bus_id_fk)->arrival_time; ?>" />
                    </div>
                </div>
            </div>

            <div id="arrivalByFlight" class="row-fluid" <?php echo ($model->arrival_by == "Flight") ? "style='display:block;'" : "style='display:none;'"; ?>>
                <div class="form-row control-group row-fluid" id="A_train_name">
                    <label class="control-label span3">Flight Name</label>
                    <div class="controls span7">
<?php
echo CHtml::activeDropDownList($model, 'flight_id_fk', CHtml::listData(FlightMaster::model()->findAll(), 'id', 'name'), array(
    'ajax' => array(
        'type' => 'POST',
        'url' => CController::createUrl('Arrival/FlightNumberArrivalTime'),
        'data' => array('val' => 'js:$(this).val()'),
        'success' => 'function(data){
																			$("#txtFlightArrivalTime").val(data);
																		}'
    ),
    'id' => 'slFlight',
    'class' => 'other-select',
    'data-field' => 'flight',
    'empty' => 'Select Flight',
    'options' => array(
        $model->flight_id_fk => array(
            'selected' => 'true',
        )
    )
        )
);
?>									
                    </div>
                </div>

                <div class="form-row control-group row-fluid">
                    <label class="control-label span3" for="Phone_no">Arrival Time</label>
                    <div class="controls span7">
                        <input type="text" readonly="readonly" name="Arrival[flight_arrival_time]" id="txtFlightArrivalTime"
                               value="<?php if ($model->flight_id_fk != 0) echo FlightMaster::model()->findByPK($model->flight_id_fk)->arrival_time; ?>"/>
                    </div>
                </div>
            </div>


            <div id="arrivalBySurface" <?php echo ($model->arrival_by == "Surface") ? "style='display:block;'" : "style='display:none;'"; ?>>
                <div class="form-row control-group row-fluid" id="A_surface_location" >
                    <label class="control-label span3" for="Phone_no">Location</label>
                    <div class="controls span7">
<?php echo $form->textField($model, 'surface_location', array('size' => 20, 'maxlength' => 20,
    'class' => 'row-fluid', 'value' => $model->surface_location));
?>
                    </div>
                </div>
                <div class="form-row control-group row-fluid" id="A_from" >
                    <label class="control-label span3">From</label>
                    <div class="controls span7">
<?php
echo $form->dropDownList($model, 'from', CHtml::listData(Places::model()->findAll(), 'id', 'name'), array('empty' => 'Select City',
    'options' => array(
        $model->from => array('selected' => 'true'),
)));
?>


                    </div>
                </div>

                <div class="form-row control-group row-fluid" id="A_arrival_time" >
                    <label class="control-label span3" for="Phone_no">Arrival Time</label>
                    <div class="controls span7">
                        <?php
                        echo CHtml::activeDropDownList($model, 'arrival_time', $this->getTime(), array(
                            'options' => array(
                                $model->arrival_time => array(
                                    'selected' => 'true',
                                )
                            ),
                            'empty' => '',
                            'style' => 'width:75px;',
                            'name' => 'Arrival[surface_arrival_time]',
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
                        <?php echo $form->dropDownList($model, 'vehicle_required', array('Yes' => 'Yes', 'No' => 'No'), array('empty' => 'Select Yes/No'), array('name' => 'vechileByTb', 'id' => 'Arrival_vehicle_required'));
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
                    <label class="control-label span3">Arrival From</label>
                    <div class="controls span7">
            <?php echo $form->textField($model, 'transferFrm', array('class' => 'row-fluid',)); ?>
                    </div>
                </div>

                <div class="form-row control-group row-fluid">
                    <label class="control-label span3">Total Vehicle</label>
                    <div class="controls span7">
            <?php
            echo $form->textField($model, 'total_vehicle', array('class' => 'row-fluid', 'value' => $model->total_vehicle,
                'id' => "Arrival_total_vehicle"));
            ?>
                    </div>
                </div>

                <span id="arrivalVehicle" style="display: none">
                    <table>
                        <tr>
                            <td>
                                <div class="form-row control-group row-fluid">
                                    <div class="controls span7">
<?php
echo $form->dropDownList($model_arrivalVehicle, 'category_id_fk[]', CHtml::listData(VehicleCategory::model()->findAll(), 'id', 'category'), array('empty' => 'Select Category'));
?> 
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="form-row control-group row-fluid">
                                    <div class="controls span7">
<?php
echo $form->dropDownList($model_arrivalVehicle, 'acOrNot[]', array('AC' => 'AC', 'Non AC' => 'Non AC'));
?> 
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="form-row control-group row-fluid">
                                    <div class="controls span7">
                                        <?php
                                        echo $form->textField($model_arrivalVehicle, 'noOfVehicle[]', array('value' => 0));
                                        ?> 
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </span>
                <span id="arrivalVehicleDoc">
                                        <?php
                                        if (Yii::app()->controller->action->id == 'update' && $model->total_vehicle > 0) {

                                            $UniquCategoryData = Yii::app()->db->createCommand("SELECT DISTINCT(category_id_fk) 
						FROM arrivalvehicle WHERE arrival_id_fk=" . $_GET['id'] . ";")->queryAll();
                                            foreach ($UniquCategoryData as $d) {
                                                $countVehicle = count(ArrivalVehicle::model()->findAll("arrival_id_fk = " . $_GET['id'] . " AND category_id_fk=" . $d['category_id_fk']));
                                                $acOrNot = Yii::app()->db->createCommand("SELECT acOrNot FROM arrivalvehicle WHERE arrival_id_fk = " . $_GET['id'] . " AND category_id_fk=" . $d['category_id_fk'] . " LIMIT 1")->queryAll();
                                                $acOrNot = $acOrNot[0]['acOrNot'];
                                                ?>
                            <table>
                                <tr>
                                    <td>
                                        <div class="form-row control-group row-fluid">
                                            <div class="controls span7">
        <?php
        echo $form->dropDownList($model_arrivalVehicle, 'category_id_fk[]', CHtml::listData(VehicleCategory::model()->findAll(), 'id', 'category'), array('empty' => 'Select Category',
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
                            echo $form->dropDownList($model_arrivalVehicle, 'acOrNot[]', array('AC' => 'AC', 'Non AC' => 'Non AC'), array('options' => array($acOrNot => array('selected' => 'true'))));
                            ?> 
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-row control-group row-fluid">
                                            <div class="controls span7">
                                                <?php
                                                echo $form->textField($model_arrivalVehicle, 'noOfVehicle[]', array('value' => $countVehicle));
                                                ?> 
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
        <?php
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
                                        <?php echo $form->textField($model, 'clientDriverName', array('class' => 'row-fluid',)); ?>

                    </div>
                </div>
                <div class="form-row control-group row-fluid">
                    <label class="control-label span3">Mobile No.</label>
                    <div class="controls span7">
                    <?php echo $form->textField($model, 'clientDriverMobile', array('class' => 'row-fluid',)); ?>
                    </div>
                </div>
            </span>
            <!-- end if vehicle no -->



            <div class="form-row control-group row-fluid" id="outsite_vehicle_no">
                <label class="control-label span3" for="Phone_no">Remarks</label>
                <div class="controls span7">
<?php echo $form->textField($model, 'remarks', array('class' => 'row-fluid',)); ?>
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
</div>
<script>
    $("#Arrival_total_vehicle").keyup(function() {
        var val = $(this).val();
        var arrivalVehicle = $("#arrivalVehicle").html();
        $("#arrivalVehicleDoc").html('');
        for (var i = 0; i < val; i++) {
            $("#arrivalVehicleDoc").append(arrivalVehicle);
        }
    });
    
    $("#Arrival_arrival_by").change(function(){
        var arrivalBy = $(this).val();
        if(arrivalBy==='Surface'){
            $("#Arrival_vehicle_required").val('No');
            $("#ifVehicleNo").css("display", "block");
            $("#ifVehicleYes").css("display", "none");
        }else{
            $("#Arrival_vehicle_required").val('');
            $("#ifVehicleNo").css("display", "none");
            $("#ifVehicleYes").css("display", "none");
        }
    });

    $("#Arrival_vehicle_required").change(function() {
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


    $("#Arrival_arrival_by").change(function() {
        var val = $(this).val();
        $("#arrivalByBus").hide();
        $("#arrivalByTrain").hide();
        $("#arrivalByFlight").hide();
        $("#arrivalBySurface").hide();
        if (val == 'Train') {
            $("#arrivalByTrain").show();
        }
        else if (val == 'Bus') {
            $("#arrivalByBus").show();
        }
        else if (val == 'Flight') {
            $("#arrivalByFlight").show();
        }
        else if (val == 'Surface') {
            $("#arrivalBySurface").show();
        }
    });


</script>