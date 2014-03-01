
    <div class="box gradient">
        <div class="title">
            <h4> <i class="icon-tasks"></i> <span>Departure By<span class="botton_mergin3"></span> 
                    <span class=botton_margin1><a href="<?php echo Yii::app()->request->baseurl ?>/index.php/FromDeparture/index"><button class="btn btn-success" rel="tooltip" data-placement="right">List</button></a></span>
            </h4>

        </div>
        <div class="content top ">
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'from-departure-form',
                //'action'=>Yii::app()->request->baseUrl.'/index.php/fromDeparture/create',
                'enableAjaxValidation' => false,
                    ));
            if (isset($_GET['msg']))
                echo $_GET['msg'];
            ?>
            <div class="form-row control-group row-fluid">
                <label class="control-label span3" for="pnr_no">PNR NO</label>
                <div class="controls span7">
                    <?php echo $form->dropDownList($model_departure, 'pnr_no', CHtml::listData(Entries::model()->findAll(array('order'=>'id desc')), 'pnr_no', 'pnr_no'), array('class' => 'chosen-select',)); ?>

                    <?php //echo $form->error($model_departure, 'pnr_no'); ?> 
                </div>
            </div>

            <div class="form-row control-group row-fluid">
                <label class="control-label span3" for="Name_Of_Staff">Name Of Staff</label>
                <div class="controls span7">
                    <?php
                    if (isset($_GET['id']))
                        echo $form->dropDownList($model_departure, 'stuff', CHtml::listData(StaffMaster::model()->findAll(), 'id', 'staff_name'), array('empty' => 'Select Staff', 'class' => 'chosen-select', 'options' => array($_GET['id'] => array('selected' => true))));
                    else
                        echo $form->dropDownList($model_departure, 'stuff', CHtml::listData(StaffMaster::model()->findAll(), 'id', 'staff_name'), array('empty' => 'Select Staff', 'class' => 'chosen-select',));
                    ?>  
                </div>
            </div>

            <div class="form-row control-group row-fluid">
                <label class="control-label span3">To Departure</label>
                <div class="controls span7">

                    <?php echo $form->dropDownList($model_departure, 'to_departure', array('Train' => 'Train', 'Bus' => 'Bus', 'Flight' => 'Flight', 'Surface' => 'Surface'), array('empty' => 'Select Any', 'class' => 'chosen-select')); ?> 
                </div>
            </div>

            <div class="form-row control-group row-fluid" id="D_train_name" style="display: none">
                <label class="control-label span3">Train Name</label>
                <div class="controls span7">
                    <?php echo $form->dropDownList($model_departure, 'train_name', CHtml::listData(TrainMaster::model()->findAll(), 'id', 'train_flight_master'), array('empty' => 'Select Train', 'class' => 'chosen-select')); ?>
                </div>
            </div>

            <div class="form-row control-group row-fluid" id="D_bus_name" style="display: none">
                <label class="control-label span3">Bus Name</label>
                <div class="controls span7">
                    <?php echo $form->dropDownList($model_departure, 'bus_name', CHtml::listData(BusType::model()->findAll(), 'id', 'bus_type'), array('empty' => 'Select Bus', 'class' => 'chosen-select')); ?>
                </div>
            </div>

            <div class="form-row control-group row-fluid" id="D_flight_name" style="display: none">
                <label class="control-label span3">Flight Name</label>
                <div class="controls span7">
                    <?php echo $form->dropDownList($model_departure, 'flight_name', CHtml::listData(FlightMaster::model()->findAll(), 'id', 'flight'), array('empty' => 'Select Flight', 'class' => 'chosen-select')); ?>
                </div>
            </div>


            <div class="form-row control-group row-fluid" id="D_train_flight_no" style="display: none">
                <label class="control-label span3" for="Phone_no">Train/Flight No</label>
                <div class="controls span7">
                    <?php echo $form->dropDownList($model_departure, 'train_flight_no', array(), array('class' => 'row-fluid')); ?>
                    <?php echo $form->error($model_departure, 'train_flight_no'); ?>                 
                </div>
            </div>

            <div class="form-row control-group row-fluid" id="D_surface_location" style="display: none">
                <label class="control-label span3" for="Phone_no">Location</label>
                <div class="controls span7">
                    <?php echo $form->textField($model_departure, 'surface_location', array('size' => 20, 'maxlength' => 20, 'class' => 'row-fluid')); ?>
                    <?php echo $form->error($model_departure, 'surface_location'); ?>
                </div>
            </div>
            <div class="form-row control-group row-fluid" id="D_to" style="display: none">
                <label class="control-label span3">To</label>
                <div class="controls span7">
                    <?php echo $form->dropDownList($model_departure, 'to', array(), array('empty' => 'Select Any',)); ?> 

                </div>
            </div>
            <div class="form-row control-group row-fluid" id="D_at" style="display: none">
                <label class="control-label span3">At</label>
                <div class="controls span7">
                    <?php echo $form->dropDownList($model_departure, 'at', array(), array('empty' => 'Select Any',)); ?> 
                </div>
            </div>
            <div class="form-row control-group row-fluid">
                <label class="control-label span3">Vehicle By TB</label>
                <div class="controls span7">
                    <label class="inline radio">
                        <?php
//for nonA/C checked
                        if ($model_departure->vehicle_required == 'yes')
                            $checkedac = 'checked';
                        else
                            $checkedac = '';
                        if (!isset($model_departure->vehicle_required))
                            $checkedac = 'checked';
                        ?>  		   
                        <?php echo $form->radioButton($model_departure, 'vehicle_required[]', array('value' => 'yes', 'checked' => $checkedac, 'class' => 'D_tbvy')); ?>
                        Yes</label>
                    <label class="inline radio">

                        <?php
//for A/C checked
                        if ($model_departure->vehicle_required == 'no')
                            $checkedac = 'checked';
                        else
                            $checkedac = '';
                        ?> 

                        <?php echo $form->radioButton($model_departure, 'vehicle_required[]', array('value' => 'no', 'checked' => $checkedac, 'class' => 'D_tbvn')); ?>
                        No</label>


                </div>
            </div>
            <div class="form-row control-group row-fluid" id="D_driver_name">
                <label class="control-label span3" for="Phone_no">Driver Name</label>
                <div class="controls span7">
                    <?php
                    if (isset($_GET['id']))
                        echo $form->dropDownList($model_departure, 'driver_name', CHtml::listData(DriverMaster::model()->findAll(), 'id', 'driver_name'), array('empty' => 'Select Driver', 'class' => 'chosen-select', 'options' => array($_GET['id'] => array('selected' => true))));
                    else
                        echo $form->dropDownList($model_departure, 'driver_name', CHtml::listData(DriverMaster::model()->findAll(), 'id', 'driver_name'), array('empty' => 'Select Driver', 'class' => 'chosen-select'));
                    ?>

                </div>
            </div>

            <div class="form-row control-group row-fluid" id="D_outside_driver_name" style="display:none">
                <label class="control-label span3" for="mask-phone">Driver Name</label>
                <div class="controls span7">
                    <?php echo $form->textField($model_departure, 'outside_driver_name', array('class' => 'row-fluid',)); ?>
                    <?php echo $form->error($model_departure, 'outside_driver_name'); ?>

                </div>
            </div>

            <div class="form-row control-group row-fluid" id="D_mobile_no">
                <label class="control-label span3" for="mask-phone">Mobile No</label>
                <div class="controls span7">
                    <?php echo $form->textField($model_departure, 'mobile_no', array('class' => 'row-fluid',)); ?>
                    <?php echo $form->error($model_departure, 'mobile_no'); ?>

                </div>
            </div>

            <div class="form-row control-group row-fluid" id="D_outside_mobile_no" style="display:none">
                <label class="control-label span3" for="mask-phone">Mobile No</label>
                <div class="controls span7">
                    <?php echo $form->textField($model_departure, 'outside_mobile_no', array('class' => 'row-fluid',)); ?>
                    <?php echo $form->error($model_departure, 'mobile_no'); ?>

                </div>
            </div>

            <div class="form-row control-group row-fluid" id="D_choose_vehicle_category">
                <label class="control-label span3" for="inputEmail">Vehicle Category<span class="help-block"></span></label>
                <div class="controls span7">
                    <?php
                    $dropDownVal = CHtml::listData(VehicleCategory::model()->findAll("status='1'"), 'id', 'name');
                    echo $form->dropDownList($model_departure, 'choose_vehicle_category', $dropDownVal, array('empty' => 'Select Any Category', 'class' => 'chosen-select'));
                    ?>


                </div>
            </div>

            <div class="form-row control-group row-fluid" id="D_outside_vehicle_category" style="display:none">
                <label class="control-label span3" for="mask-phone">Vehicle Category</label>
                <div class="controls span7">
                    <?php echo $form->textField($model_departure, 'outside_vehicle_category', array('class' => 'row-fluid',)); ?>
                    <?php echo $form->error($model_departure, 'outside_vehicle_category'); ?>

                </div>
            </div>

            <div class="form-row control-group row-fluid" id="D_vehicle_no">
                <label class="control-label span3" for="Phone_no">Vehicle No</label>
                <div class="controls span7">
                    <span id="show_vehicle_no"></span>
                    <?php
                    //CHtml::listData(VehicleMaster::model()->findAll(), 'id', 'registration_number')
                    echo $form->dropDownList($model_departure, 'vehicle_no', array(), array('empty' => 'Select Vehicle'));
                    ?>
                    <?php echo $form->error($model_departure, 'vehicle_no'); ?>
                </div>
            </div>



            <div class="form-row control-group row-fluid" id="D_outside_vehicle_no" style="display:none">
                <label class="control-label span3" for="mask-phone">Vehicle No</label>
                <div class="controls span7">
                    <?php echo $form->textField($model_departure, 'outside_vehicle_no', array('class' => 'row-fluid',)); ?>
                    <?php echo $form->error($model_departure, 'outside_vehicle_no'); ?>

                </div>
            </div>

            <div class="form-row control-group row-fluid">
                <label class="control-label span3" for="Mobile_no">Deperture Date</label>
                <div class="controls span7">
                    <?php echo $form->textField($model_departure, 'dep_date', array('size' => 10, 'maxlength' => 50,'value'=>date("Y-m-d"))); ?>
                    <a href="javascript:NewCal('FromDeparture_dep_date','ddmmmyyyy')"><img src="<?php echo Yii::app()->theme->baseurl; ?>/img/calender.png"></a>
                </div>
            </div>

            <div class="form-row control-group row-fluid">
                <label class="control-label span3" for="Mobile_no">Deperture Time</label>
                <div class="controls span7">
                    <?php
                    $hh=array();
                    $mm=array();
                    for($i=0;$i<=23;$i++){
                        $i=str_pad($i,2,'0',STR_PAD_LEFT);
                        $hh[$i]=$i;
                    }
                    for($i=1;$i<=60;$i++){
                        $i=str_pad($i,2,'0',STR_PAD_LEFT);
                        $mm[$i]=$i;
                    }
                    echo $form->dropDownList($model_departure, 'dep_time[]', $hh, array('empty' => 'HH','style'=>'width:66px'));
                    echo $form->dropDownList($model_departure, 'dep_time[]', $mm, array('empty' => 'MM','style'=>'width:66px'));
                    ?>
                    
                    
                </div>
            </div>
            
            <div class="form-row control-group row-fluid" id="outsite_vehicle_no">
                <label class="control-label span3" for="Phone_no">Remarks</label>
                <div class="controls span7">
                    <?php echo $form->textField($model_departure, 'remarks', array('class' => 'row-fluid',)); ?>
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
        $("#FromDeparture_to_departure").change(function(){
            var val = $(this).val();
            if(val=='Train'){
                $("#D_train_name").css("display","block");
                $("#D_bus_name").css("display","none");
                $("#D_flight_name").css("display","none");
                $("#D_train_flight_no").css("display","block");
                $("#D_surface_location").css("display","none");
                $("#D_to").css("display","block");
                $("#D_at").css("display","block");
            }else if(val=='Bus'){
                $("#D_train_name").css("display","none");
                $("#D_bus_name").css("display","block");
                $("#D_flight_name").css("display","none");
                $("#D_train_flight_no").css("display","none");
                $("#D_surface_location").css("display","none");
                $("#D_to").css("display","block");
                $("#D_at").css("display","block");
            }else if(val=='Flight'){
                $("#D_train_name").css("display","none");
                $("#D_bus_name").css("display","none");
                $("#D_flight_name").css("display","block");
                $("#D_train_flight_no").css("display","block");
                $("#D_surface_location").css("display","none");
                $("#D_to").css("display","block");
                $("#D_at").css("display","block");
            }else{
                $("#D_train_name").css("display","none");
                $("#D_bus_name").css("display","none");
                $("#D_flight_name").css("display","none");
                $("#D_train_flight_no").css("display","none");
                $("#D_surface_location").css("display","block");
                $("#D_to").css("display","none");
                $("#D_at").css("display","none");
            }
        });
        
        $("#FromDeparture_train_name").change(function(){
            $.post('<?php echo $this->createUrl('//entries/getTrainFlightNumber'); ?>',{val:$(this).val(), type:'Train'},function(data){
                $("#FromDeparture_train_flight_no").html(data);
            });
        });
        
        $("#FromDeparture_flight_name").change(function(){
            $.post('<?php echo $this->createUrl('//entries/getTrainFlightNumber'); ?>',{val:$(this).val(), type:'Flight'},function(data){
                $("#FromDeparture_train_flight_no").html(data);
            });
        });
        
        $("#FromDeparture_bus_name").change(function(){
            
            var departure = $("#FromDeparture_to_departure").val();
            
            $.post('<?php echo $this->createUrl('//entries/getFrom'); ?>',{val:$(this).val(), type:departure},function(data){
                $("#FromDeparture_at").html(data);
            });
            
            $.post('<?php echo $this->createUrl('//entries/getTo'); ?>',{val:$(this).val(), type:departure},function(data){
                $("#FromDeparture_to").html(data);
            });
        });
        
        
        
        
        
        $("#FromDeparture_train_flight_no").change(function(){
            
            var departure = $("#FromDeparture_to_departure").val();
            
            $.post('<?php echo $this->createUrl('//entries/getFrom'); ?>',{val:$(this).val(), type:departure},function(data){
                $("#FromDeparture_at").html(data);
            });
            
            $.post('<?php echo $this->createUrl('//entries/getTo'); ?>',{val:$(this).val(), type:departure},function(data){
                $("#FromDeparture_to").html(data);
            });
        });
        
        
        //TB vehicle yes or not
        $(".D_tbvy").click(function(){
            $("#D_outside_driver_name").css("display","none");
            $("#D_outside_vehicle_no").css("display","none");
            $("#D_outside_mobile_no").css("display","none");
            $("#D_outside_vehicle_category").css("display","none");

            $("#D_driver_name").css("display","block");
            $("#D_mobile_no").css("display","block");
            $("#D_vehicle_no").css("display","block");
            $("#D_choose_vehicle_category").css("display","block");
        });

        $(".D_tbvn").click(function(){
            $("#D_driver_name").css("display","none");
            $("#D_mobile_no").css("display","none");
            $("#D_vehicle_no").css("display","none");
            $("#D_choose_vehicle_category").css("display","none");

            $("#D_outside_driver_name").css("display","block");
            $("#D_outside_mobile_no").css("display","block");
            $("#D_outside_vehicle_no").css("display","block");
            $("#D_outside_vehicle_category").css("display","block");
        });
        
        $("#FromDeparture_choose_vehicle_category").change(function(){
            $.post('<?php echo $this->createUrl('//entries/getVehicleRegNum'); ?>',{val:$(this).val()},function(data){
                $("#FromDeparture_vehicle_no").html(data);
            });
        });
        
        $("#FromDeparture_driver_name").change(function(){
            $.post('<?php echo $this->createUrl('//entries/getDriverMobile'); ?>',{val:$(this).val()},function(data){
                if(data!='')
                    data = data;
                else
                    data = 'Not Set';
                $("#FromDeparture_mobile_no").val(data);
            }); 
        });
                               
                                   
    </script>