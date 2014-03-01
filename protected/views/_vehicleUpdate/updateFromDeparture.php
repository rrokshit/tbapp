<?php $this->layout="travel_layout_content";?>
<div class="box gradient">
    <div class="title">
        <h4><i class="icon-tasks"></i> <span>Departure Vehicle Add<span class="botton_mergin3"></span></h4>
    </div>
    <div class="content top ">
        <?php 
        if(isset($_GET['msg']))
            echo $_GET['msg'];
        ?>
        
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'vehicle-update-form',
            //'action'=>Yii::app()->request->baseUrl.'/index.php/arrival/create',
            'enableAjaxValidation' => false,
        ));
        ?>
        <?php echo $form->errorSummary($model); ?>
        
        <?php echo $form->hiddenField($model,'pnr_no',array('size'=>20,'maxlength'=>20,'value'=>$updateModel->pnr_no)); ?>
        
        <?php echo $form->hiddenField($model,'type',array('size'=>20,'maxlength'=>20,'value'=>$_GET['type'])); ?>
        <input type="hidden" value="<?php echo $_GET['id'];?>" name="VehicleUpdate[updateId]"/>
        
        <div class="form-row control-group row-fluid">
            <label class="control-label span3">Vehicle By TB</label>
            <div class="controls span7">
                <?php
                echo $form->dropDownList($model, 'vehicleByTb', array('Yes'=>'Yes','No'=>'No'), array('empty' => 'Vehicle From', 'class' => 'chosen-select'));?>
            </div>
        </div>
        
        <div id="vbty" style='display: none'>
            <div class="form-row control-group row-fluid" id="A_driver_name">
                <label class="control-label span3" for="Phone_no">Driver Name</label>
                <div class="controls span7">
                    <?php
                        echo $form->dropDownList($model, 'driverName', CHtml::listData(DriverMaster::model()->findAll(), 'id', 'driver_name'), array('empty' => 'Select Driver', 'class' => 'chosen-select'));
                    ?>

                </div>
            </div>
            <div class="form-row control-group row-fluid " id="A_mobile_no">
                <label class="control-label span3" for="mask-phone">Mobile No</label>
                <div class="controls span7">
                    <?php echo $form->textField($model, 'driverNumber', array('class' => 'row-fluid',)); ?>
                </div>
            </div>
            <div class="form-row control-group row-fluid" id="A_vehicle_category">
                <label class="control-label span3">Vehicle Category</label>
                <div class="controls span7">
                    <?php
                    $dropDownVal = CHtml::listData(VehicleCategory::model()->findAll("status='1'"), 'id', 'name');
                    echo $form->dropDownList($model, 'vehicleCategory', $dropDownVal, array('empty' => 'Select Any Category', 'class' => 'chosen-select'));
                    ?>
                </div>
            </div>
            <div class="form-row control-group row-fluid" id="A_vehicle_no">
                <label class="control-label span3" for="Phone_no">Vehicle No</label>
                <div class="controls span7">
                    <span id="show_vehicle_no"></span>
                    <?php echo $form->dropDownList($model, 'vehicleNumber', array(), array('empty' => 'Select Vehicle'));
                    ?>
                </div>
            </div>
        </div>
        
        
        <div id="vbtn" style='display: none'>
            <div class="form-row control-group row-fluid" id="A_outsite_drivername" >
                <label class="control-label span3" for="driver_name">Driver Name</label>
                <div class="controls span7">
                    <?php
                    echo $form->textField($model, 'outsideDriverName', array('class' => 'row-fluid'));
                    ?>
                </div>
            </div>

            <div class="form-row control-group row-fluid " id="A_outside_mobile_no" >
                <label class="control-label span3" for="mask-phone">Mobile No</label>
                <div class="controls span7">
                    <?php echo $form->textField($model, 'outsideDriverNumber', array('class' => 'row-fluid',)); ?>
                </div>
            </div>

            <div class="form-row control-group row-fluid" id="A_outsite_vehicle_category" >
                <label class="control-label span3" for="Phone_no">Vehicle Category</label>
                <div class="controls span7">
                    <?php echo $form->textField($model, 'outsideVehicleCategory', array('class' => 'row-fluid',)); ?>
                </div>
            </div>

            <div class="form-row control-group row-fluid" id="A_outside_vehicle_no" >
                <label class="control-label span3" for="Phone_no">Vehicle No</label>
                <div class="controls span7">
                    <?php echo $form->textField($model, 'outsideVehicleNumber', array('size' => 30, 'maxlength' => 30, 'class' => 'row-fluid')); ?>
                </div>
            </div>
        </div>




        

        <div class="form-actions row-fluid">
            <div class="span7 offset3">
                <button type="submit" class="btn btn-primary">Save And Add Again</button>
            </div>
        </div>
        <?php $this->endWidget(); ?>
    </div>
</div>

<script>
        
        //TB vehicle yes or not
        $("#VehicleUpdate_vehicleByTb").change(function(){
            if($(this).val()=='Yes'){
                $("#vbty").css("display","block");
                $("#vbtn").css("display","none");
            }
            else if($(this).val()=='No'){
                $("#vbtn").css("display","block");
                $("#vbty").css("display","none");
            }
            else{
                $("#vbtn").css("display","none");
                $("#vbty").css("display","none");
            }
        });

        
        
        $("#VehicleUpdate_vehicleCategory").change(function(){
            $.post('<?php echo $this->createUrl('//entries/getVehicleRegNum'); ?>',{val:$(this).val()},function(data){
                $("#VehicleUpdate_vehicleNumber").html(data);
            });
        });
        
        $("#VehicleUpdate_driverName").change(function(){
            $.post('<?php echo $this->createUrl('//entries/getDriverMobile'); ?>',{val:$(this).val()},function(data){
                if(data!='')
                    data = data;
                else
                    data = 'Not Set';
                $("#VehicleUpdate_driverNumber").val(data);
            }); 
        });
                               
                                   
    </script>