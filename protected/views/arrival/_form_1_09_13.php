<div class="box gradient">
    <div class="title">
        <h4><i class="icon-tasks"></i> <span>Arrival By<span class="botton_mergin3"></span> 
                <span class=botton_margin1><a href="<?php echo Yii::app()->request->baseurl ?>/index.php/Arrival/index"><button class="btn btn-success" rel="tooltip" data-placement="right">List</button></a></span>
        </h4>
    </div>
    <div class="content top ">
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'arrival-form',
            //'action'=>Yii::app()->request->baseUrl.'/index.php/arrival/create',
            'enableAjaxValidation' => false,
        ));
        if (isset($_GET['msg']))
            echo $_GET['msg'];
        ?>

        <div class="form-row control-group row-fluid">
            <label class="control-label span3" for="pnr_no">PNR NO</label>
            <div class="controls span7">
                <?php echo $form->dropDownList($model_arrival, 'pnr_no', CHtml::listData(Entries::model()->findAll(array('order' => 'id desc')), 'pnr_no', 'pnr_no'), array('class' => 'chosen-select',)); ?>
                <?php echo $form->error($model_arrival, 'pnr_no'); ?> 
            </div>
        </div>

       

        <div class="form-row control-group row-fluid">
            <label class="control-label span3">From Arrival</label>
            <div class="controls span7">
                <?php echo $form->dropDownList($model_arrival, 'arrival', array('Train' => 'Train', 'Bus' => 'Bus', 'Flight' => 'Flight', 'Surface' => 'Surface'), array('empty' => 'Select Any', 'class' => 'chosen-select')); ?>
            </div>
        </div>

        <div class="form-row control-group row-fluid" id="A_train_name" style="display:none">
            <label class="control-label span3">Train Name</label>
            <div class="controls span7">
                <?php echo $form->dropDownList($model_arrival, 'train_name', CHtml::listData(TrainMaster::model()->findAll(), 'id', 'train_flight_master'), array('empty' => 'Select Train', 'class' => 'chosen-select')); ?>
            </div>
        </div>

        <div class="form-row control-group row-fluid" id="A_bus_name" style="display:none">
            <label class="control-label span3">Bus Name</label>
            <div class="controls span7">
                <?php echo $form->dropDownList($model_arrival, 'bus_name', CHtml::listData(BusType::model()->findAll(), 'id', 'bus_type'), array('empty' => 'Select Bus', 'class' => 'chosen-select')); ?>
            </div>
        </div>

        <div class="form-row control-group row-fluid" id="A_flight_name" style="display:none">
            <label class="control-label span3">Flight Name</label>
            <div class="controls span7">
                <?php echo $form->dropDownList($model_arrival, 'flight_name', CHtml::listData(FlightMaster::model()->findAll(), 'id', 'flight'), array('empty' => 'Select Flight', 'class' => 'chosen-select')); ?>
            </div>
        </div>


        <div class="form-row control-group row-fluid" id="A_train_flight_no" style="display:none">
            <label class="control-label span3" for="Phone_no">Train/Flight No</label>
            <div class="controls span7">
                <?php echo $form->dropDownList($model_arrival, 'train_flight_no', array(), array('class' => 'row-fluid')); ?>
                <?php echo $form->error($model_arrival, 'train_flight_no'); ?>                 
            </div>
        </div>
        <div class="form-row control-group row-fluid" id="A_surface_location" style="display:none">
            <label class="control-label span3" for="Phone_no">Location</label>
            <div class="controls span7">
                <?php echo $form->textField($model_arrival, 'surface_location', array('size' => 20, 'maxlength' => 20, 'class' => 'row-fluid')); ?>
                <?php echo $form->error($model_arrival, 'surface_location'); ?>
            </div>
        </div>
        <div class="form-row control-group row-fluid" id="A_from" style="display:none">
            <label class="control-label span3">From</label>
            <div class="controls span7">
                <?php echo $form->dropDownList($model_arrival, 'from', array()); ?> 

            </div>
        </div>
        <div class="form-row control-group row-fluid" id="A_to" style="display:none">
            <label class="control-label span3">To</label>
            <div class="controls span7">
                <?php echo $form->dropDownList($model_arrival, 'at', array('1'=>'Agra')); ?> 
            </div>
        </div>
        
        
        <!-- start add more section -->
        <div class="form-row" id="yes" style="display: none">
            <label class="control-label span">Vehicle By TB</label>
            <div class="controls span">
                <?php  echo $form->textField($model_vallocate, 'vehicleByTb[]', array('class' => 'row-fluid','style'=>'width:200px','value'=>'Yes','readonly'=>'readonly')); ?> 
            </div>
            
            <label class="control-label span">Category</label>
            <div class="controls span">
                <?php
                $dropDownVal = CHtml::listData(VehicleCategory::model()->findAll("status='1'"), 'id', 'name');
                echo $form->dropDownList($model_vallocate, 'vehicleCategory[]', $dropDownVal, array('empty' => 'Select Any Category', 'style'=>'width:200px'));
                
                ?>
            </div>
            
            <label class="control-label span">Total Vehicle</label>
            <div class="controls span">
                <?php echo $form->textField($model_vallocate, 'totalVehicle[]', array('class' => 'row-fluid','style'=>'width:200px'));?>
            </div>
        </div>
        <div class="form-row" id="no" style="display: none">
            <label class="control-label span">Vehicle By TB</label>
            <div class="controls span">
                <?php  echo $form->textField($model_vallocate, 'vehicleByTb[]', array('class' => 'row-fluid','style'=>'width:200px','value'=>'No','readonly'=>'readonly')); ?>
            </div>
            
            <label class="control-label span">Category</label>
            <div class="controls span">
                <?php echo $form->textField($model_vallocate, 'vehicleCategory[]', array('class' => 'row-fluid othervc','style'=>'width:200px')); ?>
            </div>
            
            <label class="control-label span">Total Vehicle</label>
            <div class="controls span">
                <?php echo $form->textField($model_vallocate, 'totalVehicle[]', array('class' => 'row-fluid','style'=>'width:200px'));?>
            </div>
        </div>
        
        <div id="addVehAppend"></div>
        
        
        
        
        <div class="form-row control-group row-fluid">
            <label class="control-label span3" for="inputEmail">Vehicle By TB <span class="help-block"></span></label>
            <div class="controls span7">
                <select id="vehType" style="width:100px"><option value="Yes">Yes</option><option value="No">No</option></select>
                <button class="addMoreV">Add Vehicle</button>
            </div>
        </div>
        
        <script>
            $(".addMoreV").click(function(event){
               event.preventDefault();
               var vehDoc = '';
               var vehType = $("#vehType").val();
               if(vehType=='Yes')
                   vehDoc = $("#yes").html();
               else
                   vehDoc = $("#no").html();
               $("#addVehAppend").append(vehDoc);
               
            });
        </script>
        <!-- end add more section -->
        

        <div class="form-row control-group row-fluid" id="outsite_vehicle_no">
            <label class="control-label span3" for="Phone_no">Remarks</label>
            <div class="controls span7">
                <?php echo $form->textField($model_arrival, 'remarks', array('class' => 'row-fluid',)); ?>
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
        $("#Arrival_arrival").change(function(){
            var val = $(this).val();
            if(val=='Train'){
                $("#A_train_name").css("display","block");
                $("#A_bus_name").css("display","none");
                $("#A_flight_name").css("display","none");
                $("#A_train_flight_no").css("display","block");
                $("#A_surface_location").css("display","none");
                $("#A_from").css("display","block");
                //$("#A_to").css("display","block");
            }else if(val=='Bus'){
                $("#A_train_name").css("display","none");
                $("#A_bus_name").css("display","block");
                $("#A_flight_name").css("display","none");
                $("#A_train_flight_no").css("display","none");
                $("#A_surface_location").css("display","none");
                $("#A_from").css("display","block");
                //$("#A_to").css("display","block");
            }else if(val=='Flight'){
                $("#A_train_name").css("display","none");
                $("#A_bus_name").css("display","none");
                $("#A_flight_name").css("display","block");
                $("#A_train_flight_no").css("display","block");
                $("#A_surface_location").css("display","none");
                $("#A_from").css("display","block");
                //$("#A_to").css("display","block");
            }else{
                $("#A_train_name").css("display","none");
                $("#A_bus_name").css("display","none");
                $("#A_flight_name").css("display","none");
                $("#A_train_flight_no").css("display","none");
                $("#A_surface_location").css("display","block");
                $("#A_from").css("display","none");
                //$("#A_to").css("display","none");
            }
        });
        
        $("#Arrival_train_name").change(function(){
            $.post('<?php echo $this->createUrl('//entries/getTrainFlightNumber'); ?>',{val:$(this).val(), type:'Train'},function(data){
                $("#Arrival_train_flight_no").html(data);
            });
        });
        
        $("#Arrival_flight_name").change(function(){
            $.post('<?php echo $this->createUrl('//entries/getTrainFlightNumber'); ?>',{val:$(this).val(), type:'Flight'},function(data){
                $("#Arrival_train_flight_no").html(data);
            });
        });
        
        $("#Arrival_bus_name").change(function(){
            var arrival = $("#Arrival_arrival").val();
            
            $.post('<?php echo $this->createUrl('//entries/getFrom'); ?>',{val:$(this).val(), type:arrival},function(data){
                $("#Arrival_from").html(data);
            });
            
            /*$.post('<?php //echo $this->createUrl('//entries/getTo'); ?>',{val:$(this).val(), type:arrival},function(data){
                $("#Arrival_at").html(data);
            });*/
        });
        
        
        
        
        $("#Arrival_train_flight_no").change(function(){
            
            var arrival = $("#Arrival_arrival").val();
            
            $.post('<?php echo $this->createUrl('//entries/getFrom'); ?>',{val:$(this).val(), type:arrival},function(data){
                $("#Arrival_from").html(data);
            });
            
            /*$.post('<?php echo $this->createUrl('//entries/getTo'); ?>',{val:$(this).val(), type:arrival},function(data){
                $("#Arrival_at").html(data);
            });*/
        });
        
        
        //TB vehicle yes or not
        $(".A_tbvy").click(function(){
            $("#A_outsite_drivername").css("display","none");
            $("#A_outside_vehicle_no").css("display","none");
            $("#A_outside_mobile_no").css("display","none");
            $("#A_outsite_vehicle_category").css("display","none");

            $("#A_driver_name").css("display","block");
            $("#A_vehicle_no").css("display","block");
            $("#A_mobile_no").css("display","block");
            $("#A_vehicle_category").css("display","block");
        });

        $(".A_tbvn").click(function(){
            $("#A_driver_name").css("display","none");
            $("#A_vehicle_no").css("display","none");
            $("#A_mobile_no").css("display","none");
            $("#A_vehicle_category").css("display","none");

            $("#A_outsite_drivername").css("display","block");
            $("#A_outside_vehicle_no").css("display","block");
            $("#A_outside_mobile_no").css("display","block");
            $("#A_outsite_vehicle_category").css("display","block");
        });
        
        $("#Arrival_vehicle_category").change(function(){
            $.post('<?php echo $this->createUrl('//entries/getVehicleRegNum'); ?>',{val:$(this).val()},function(data){
                $("#Arrival_vehicle_no").html(data);
            });
        });
        
        $("#Arrival_driver_name").change(function(){
            $.post('<?php echo $this->createUrl('//entries/getDriverMobile'); ?>',{val:$(this).val()},function(data){
                if(data!='')
                    data = data;
                else
                    data = 'Not Set';
                $("#Arrival_mobile_no").val(data);
            }); 
        });
                               
                                   
    </script>