<?php
/* @var $this EntriesController */
/* @var $model Entries */
/* @var $form CActiveForm */
?>
<?php
/* @var $this EntriesController */
/* @var $model Entries */
/* @var $form CActiveForm */
?>
<div class="span7">
    <div class="box gradient">

        <div>
            <div class="title">
                <h3> <i class="icon-book"></i><span>Entries<span class="botton_mergin3"></span>
                        <span class=botton_margin1><a href="<?php echo Yii::app()->request->baseurl ?>/index.php/entries/index"><button class="btn btn-success" rel="tooltip" data-placement="right">List</button></a></span></span>
                </h3>
            </div>
        </div>
        <div class="content">
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'entries-form',
                'enableAjaxValidation' => false,
                    ));
            if (isset($_GET['msg']))
                echo $_GET['msg'];
            ?>
            <div class="form-row control-group row-fluid">
                <label class="control-label span3" for="pnr_no">PNR NO</label>
                <div class="controls span7">
                    <?php echo $form->textField($model, 'pnr_no', array('size' => 20, 'readonly' => 'readonly', 'maxlength' => 20, 'class' => 'row-fluid', 'value' => Entries::model()->pnr_no())); ?>
                    <?php echo $form->error($model, 'pnr_no'); ?> 
                </div>
            </div>
            <div class="form-row control-group row-fluid">
                <label class="control-label span3" for="Name_Of_Staff">Entry By</label>
                <div class="controls span7">
                    <?php
                    if (isset($_GET['id']))
                        echo $form->dropDownList($model, 'staff_name', CHtml::listData(StaffMaster::model()->findAll(), 'id', 'staff_name'), array('empty' => 'Select Staff', 'class' => 'chosen-select', 'options' => array($_GET['id'] => array('selected' => true))));
                    else
                        echo $form->dropDownList($model, 'staff_name', CHtml::listData(StaffMaster::model()->findAll(), 'id', 'staff_name'), array('empty' => 'Select Staff', 'class' => 'chosen-select'));
                    ?>  
                </div>
            </div>
            <div class="form-row control-group row-fluid">
                <label class="control-label span3" for="Short_Code">Short Code</label>
                <div class="controls span7">
                    <?php echo $form->textField($model, 'short_code', array('size' => 3, 'maxlength' => 3, 'class' => 'row-fluid')); ?>
                    <?php echo $form->error($model, 'short_code'); ?> 
                </div>
            </div>

            <div class="form-row control-group row-fluid">
                <label class="control-label span3">Arrival Date</label>
                <div class="controls span7">
                    <div class="input-append date row-fluid">
						<?php
							$this->widget('zii.widgets.jui.CJuiDatePicker',array(
									'model'=>$model,
									'attribute'=>'arrival_date',
									'options'=>array(
										'dateFormat'=>'yy-mm-dd',
										'altFormat'=>'yy-mm-dd',
										'showButtonPanel' => true,
										'changeMonth'=>true,
										'changeYear'=>true,
										'yearRange'=>'1900:2099'
									),
									'htmlOptions'=>array(
										'value'=> $model->arrival_date,
										'class'=>'row-fluid', 
									),
							));
						?>
						<span class="add-on"><i class="icon-th"></i></span> 
					</div>
				</div>
            </div>
            <div class="form-row control-group row-fluid">
                <label class="control-label span3" for="default-select">Agency</label>
                <div class="controls span7">
                    <?php echo $form->dropDownList($model, 'agency', CHtml::listData(AgencyMaster::model()->findAll(), 'id', 'agency_name'), array('empty' => 'Select Agency', 'class' => 'chosen-select')); ?>

                </div>
            </div>

            <div class="form-row control-group row-fluid">
                <label class="control-label span3" for="default-select">City</label>
                <div class="controls span7">
                    <input type="text" id="agencyCity" value="" disabled="disabled" class="row-fluid">    
                </div>
            </div>

            <div class="form-row control-group row-fluid">
                <label class="control-label span3" for="Phone_no">Client Name</label>
                <div class="controls span7">
                    <?php echo $form->textField($model, 'client_name', array('class' => 'row-fluid')); ?>
                    <?php echo $form->error($model, 'client_name'); ?>
                </div>
            </div>
            <h3>Totel Indian </h3>
            <div class="form-row control-group row-fluid">
                <label class="control-label span3">No Of Adult</label>
                <div class="controls span7">
                    <?php
                    $lv = array();
                    for ($i = 0; $i <= 100; $i++) {
                        $lv[$i] = $i;
                    }
                    ?>

                    <?php echo $form->dropDownList($model, 'no_of_adult', $lv, array('class' => 'chosen-select')); ?>   

                </div>
            </div>
            <div class="form-row control-group row-fluid">
                <label class="control-label span3">No Of Child </label>
                <div class="controls span7">
                    <?php
                    $lv = array();
                    for ($i = 0; $i <= 50; $i++) {
                        $lv[$i] = $i;
                    }
                    ?>
                    <?php echo $form->dropDownList($model, 'indian_child', $lv, array('class' => 'chosen-select')); ?>  

                </div>
            </div>
            <h3>Totel Foreigner </h3>
            <div class="form-row control-group row-fluid">
                <label class="control-label span3">No Of Adult</label>
                <div class="controls span7">
                    <?php
                    $lv = array();
                    for ($i = 0; $i <= 100; $i++) {
                        $lv[$i] = $i;
                    }
                    ?>
                    <?php echo $form->dropDownList($model, 'foreigner_adult', $lv, array('class' => 'chosen-select')); ?>  

                </div>
            </div>
            <div class="form-row control-group row-fluid">
                <label class="control-label span3">No Of Child</label>
                <div class="controls span7">
                    <?php
                    $lv = array();
                    for ($i = 0; $i <= 20; $i++) {
                        $lv[$i] = $i;
                    }
                    ?>
                    <?php echo $form->dropDownList($model, 'foreigner_child', $lv, array('class' => 'chosen-select')); ?>  

                </div>
            </div>
            
            <div class="form-row control-group row-fluid">
                <label class="control-label span3">Total No. PAX</label>
                <div class="controls span7"><input type="text" readonly="readonly" id="totalNoPax" value="0"/></div>
            </div>
            
            <div class="form-row control-group row-fluid">
                <label class="control-label span3">Hotel Required </label>
                <div class="controls span7">
                    <label class="inline radio">
                        <?php
                        if ($model->hotel_required == 'yes')
                            $checkedac = 'checked';
                        else
                            $checkedac = '';
                        if (!isset($model->hotel_required))
                            $checkedac = 'checked';
                        ?>  		   
                        <?php echo $form->radioButton($model, 'hotel_required[]', array('size' => 10, 'maxlength' => 10, 'value' => 'Yes', 'checked' => $checkedac, 'class' => 'ss')); ?>
                        Yes</label>
                    <label class="inline radio">
                        <?php
                        //for nonA/C checked
                        if ($model->hotel_required == 'no')
                            $checkedac = 'checked';
                        else
                            $checkedac = '';
                        ?>  		   
                        <?php echo $form->radioButton($model, 'hotel_required[]', array('size' => 10, 'maxlength' => 10, 'value' => 'no', 'checked' => $checkedac, 'class' => 'hh')); ?>
                        No</label>	  

                </div>
            </div>
            <div id ="hide">  
                <div class="form-row control-group row-fluid">
                    <label class="control-label span3">Choose Hotel</label>
                    <div class="controls span7">
                        <?php echo $form->dropDownList($model, 'choose_hotel', CHtml::listData(HotelMaster::model()->findAll(), 'id', 'hotel_name'), array('empty' => 'Select Hotel', 'class' => 'chosen-select')); ?>

                    </div>
                </div>

                <div class="form-row control-group row-fluid">
                    <label class="control-label span3">Totel Room</label>
                    <div class="controls span7">
                        <?php
                        $lv = array();
                        for ($i = 1; $i <= 20; $i++) {
                            $lv[$i] = $i;
                        }
                        ?>
                        <?php echo $form->dropDownList($model, 'totel_room', $lv, array('empty' => 'Select Any', 'class' => 'chosen-select')); ?>  

                    </div>
                </div>
                <div class="form-row control-group row-fluid">
                    <label class="control-label span3" for="branch-name">Room Category</label>
                    <div class="controls span7">

                        <?php echo $form->dropDownList($model, 'room_category', array(), array('maxlength' => 255,)); ?>
                    </div>
                </div>
                <div class="form-row control-group row-fluid">
                    <label class="control-label span3" for="Short_Code">Room Type </label>
                    <div class="controls span7">
                        <?php echo $form->dropDownList($model, 'room_type', array(), array('maxlength' => 255,)); ?>
                    </div>
                </div>
            </div>



            <div class="form-row control-group row-fluid">
                <label class="control-label span3" for="Phone_no">Same Day</label>
                <div class="controls span7">
                    <?php echo $form->textField($model, 'same_day', array('class' => 'row-fluid', 'readonly' => 'readonly', 'value' => 'No')); ?>
                    <?php echo $form->error($model, 'same_day'); ?>
                </div>
            </div>



            <div class="form-row control-group row-fluid">
                <label class="control-label span3">Assistance On Arrival</label>
                <div class="controls span7">
                    <label class="inline radio">

                        <?php
                        if ($model->assistance_on_arrival == 'no')
                            $checkedac = 'checked';
                        else
                            $checkedac = '';
                        if (!isset($model->assistance_on_arrival))
                            $checkedac = 'checked';
                        ?>  		   
                        <?php echo $form->radioButton($model, 'assistance_on_arrival[]', array('size' => 10, 'maxlength' => 10, 'value' => 'no', 'checked' => $checkedac)); ?>
                        No</label>
                    <label class="inline radio">
                        <?php
                        //for nonA/C checked
                        if ($model->assistance_on_arrival == 'yes')
                            $checkedac = 'checked';
                        else
                            $checkedac = '';
                        ?>  		   
                        <?php echo $form->radioButton($model, 'assistance_on_arrival[]', array('size' => 10, 'maxlength' => 10, 'value' => 'yes', 'checked' => $checkedac)); ?>
                        Yes</label>	  

                </div>
            </div>
            <div class="form-row control-group row-fluid">
                <label class="control-label span3" for="Phone_no">Tour Reference No</label>
                <div class="controls span7">
                    <?php echo $form->textField($model, 'tour_reference_no', array('size' => 10, 'maxlength' => 10, 'class' => 'row-fluid')); ?>
                    <?php echo $form->error($model, 'tour_reference_no'); ?>                
                </div>
            </div>
            <div class="form-row control-group row-fluid">
                <label class="control-label span3" for="Phone_no">Exc Oder No</label>
                <div class="controls span7">
                    <?php echo $form->textField($model, 'oder_no', array('class' => 'row-fluid')); ?>
                    <?php echo $form->error($model, 'oder_no'); ?>    
                </div>
            </div>
            <div class="form-row control-group row-fluid">
                <label class="control-label span3">Exc Oder Date</label>
                <div class="controls span7">
                    <div class="input-append date row-fluid">
						<?php
							$this->widget('zii.widgets.jui.CJuiDatePicker',array(
									'model'=>$model,
									'attribute'=>'order_date',
									'options'=>array(
										'dateFormat'=>'yy-mm-dd',
										'altFormat'=>'yy-mm-dd',
										'showButtonPanel' => true,
										'changeMonth'=>true,
										'changeYear'=>true,
										'yearRange'=>'1900:2099'
									),
									'htmlOptions'=>array(
										'value'=> $model->order_date,
										'class'=>'row-fluid', 
									),
							));
						?>
						<span class="add-on"><i class="icon-th"></i></span> 
					</div>
				</div>
            </div>

            <div class="form-row control-group row-fluid">
                <label class="control-label span3">Vehicle By TB</label>
                <div class="controls span7">
                    <label class="inline radio">
                        <?php
                        //for nonA/C checked
                        if ($model->vehicle_required == 'yes')
                            $checkedac = 'checked';
                        else
                            $checkedac = '';

                        if (!isset($model->vehicle_required))
                            $checkedac = 'checked';
                        ?>  		   
                        <?php echo $form->radioButton($model, 'vehicle_required', array('value' => 'yes', 'checked' => $checkedac, 'class' => 'tbvy')); ?>
                        Yes</label>
                    <label class="inline radio">
                        <?php
                        //for A/C checked
                        if ($model->vehicle_required == 'yes')
                            $checkedac = 'checked';
                        else
                            $checkedac = '';
                        ?> 

                        <?php echo $form->radioButton($model, 'vehicle_required', array('value' => 'no', 'checked' => $checkedac, 'class' => 'tbvn')); ?>
                        No</label>	 
                </div>
            </div>

            <div class="form-row control-group row-fluid" id="driver_name">
                <label class="control-label span3" for="driver_name">Driver Name</label>
                <div class="controls span7">
                    <?php
                    if (isset($_GET['id']))
                        echo $form->dropDownList($model, 'driver_name', CHtml::listData(DriverMaster::model()->findAll(), 'id', 'driver_name'), array('empty' => 'Select Driver', 'class' => 'chosen-select', 'options' => array($_GET['id'] => array('selected' => true))));
                    else
                        echo $form->dropDownList($model, 'driver_name', CHtml::listData(DriverMaster::model()->findAll(), 'id', 'driver_name'), array('empty' => 'Select Driver', 'class' => 'chosen-select'));
                    ?>


                </div>
            </div>

            <div class="form-row control-group row-fluid" id="outsite_drivername" style="display: none">
                <label class="control-label span3" for="driver_name">Driver Name</label>
                <div class="controls span7">
                    <?php
                    echo $form->textField($model, 'outsite_drivername', array('class' => 'row-fluid'));
                    ?>


                </div>
            </div>


            <div class="form-row control-group row-fluid ">
                <label class="control-label span3" for="mask-phone">Mobile No</label>
                <div class="controls span7">
                    <?php echo $form->textField($model, 'mobile_no', array('class' => 'row-fluid',)); ?>
                    <?php echo $form->error($model, 'mobile_no'); ?>

                    <?php echo $form->textField($model, 'driver_mobile_no', array('class' => 'row-fluid', 'style' => 'display:none')); ?>

                </div>
            </div>

            <div class="form-row control-group row-fluid" id="vehicle_category">
                <label class="control-label span3">Vehicle Category</label>
                <div class="controls span7">
                    <?php
                    $dropDownVal = CHtml::listData(VehicleCategory::model()->findAll("status='1'"), 'id', 'name');
                    echo $form->dropDownList($model, 'vehicle_category', $dropDownVal, array('empty' => 'Select Any Category', 'class' => 'chosen-select'));
                    ?>

                </div>
            </div>

            <div class="form-row control-group row-fluid" id="outsite_vehicle_category" style="display: none">
                <label class="control-label span3" for="Phone_no">Vehicle Category</label>
                <div class="controls span7">
                    <?php echo $form->textField($model, 'outside_vehicle_category', array('class' => 'row-fluid',)); ?>
                </div>
            </div>

            <div class="form-row control-group row-fluid" id="vehicle_no">
                <label class="control-label span3" for="Phone_no">Vehicle No</label>
                <div class="controls span7">
                    <span id="show_vehicle_no"></span>
                    <?php 
                    //CHtml::listData(VehicleMaster::model()->findAll(), 'id', 'registration_number')
                    echo $form->dropDownList($model, 'vehicle_no', array(), array('empty' => 'Select Vehicle'));
                    ?>
                    <?php echo $form->error($model, 'vehicle_no'); ?>
                </div>
            </div>

            <div class="form-row control-group row-fluid" id="outsite_vehicle_no" style="display: none">
                <label class="control-label span3" for="Phone_no">Vehicle No</label>
                <div class="controls span7">
                    <?php echo $form->textField($model, 'outsite_vehicle_no', array('class' => 'row-fluid',)); ?>
                </div>
            </div>
            
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

    <!-- Start Arrival -->
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
            if (isset($_GET['msg1']))
                echo $_GET['msg1'];
            ?>

            <div class="form-row control-group row-fluid">
                <label class="control-label span3" for="pnr_no">PNR NO</label>
                <div class="controls span7">
                    <?php echo $form->dropDownList($model_arrival, 'pnr_no', CHtml::listData(Entries::model()->findAll(array('order'=>'id desc')), 'pnr_no', 'pnr_no'), array('class' => 'chosen-select',)); ?>
                    <?php echo $form->error($model_arrival, 'pnr_no'); ?> 
                </div>
            </div>

            <div class="form-row control-group row-fluid">
                <label class="control-label span3" for="Name_Of_Staff">Name Of Staff</label>
                <div class="controls span7">
                    <?php
                    if (isset($_GET['id']))
                        echo $form->dropDownList($model_arrival, 'stuff', CHtml::listData(StaffMaster::model()->findAll(), 'id', 'staff_name'), array('empty' => 'Select Staff', 'class' => 'chosen-select', 'options' => array($_GET['id'] => array('selected' => true))));
                    else
                        echo $form->dropDownList($model_arrival, 'stuff', CHtml::listData(StaffMaster::model()->findAll(), 'id', 'staff_name'), array('empty' => 'Select Staff', 'class' => 'chosen-select'));
                    ?>  
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
                    <?php echo $form->dropDownList($model_arrival, 'at', array()); ?> 
                </div>
            </div>
            <div class="form-row control-group row-fluid">
                <label class="control-label span3">Vehicle By TB</label>
                <div class="controls span7">
                    <label class="inline radio">
                        <?php
                        //for nonA/C checked
                        if ($model_arrival->vehicle_required == 'yes')
                            $checkedac = 'checked';
                        else
                            $checkedac = '';

                        if (!isset($model_arrival->vehicle_required))
                            $checkedac = 'checked';
                        ?>  		   
                        <?php echo $form->radioButton($model_arrival, 'vehicle_required[]', array('value' => 'yes', 'checked' => $checkedac, 'class' => 'A_tbvy')); ?>
                        Yes</label>

                    <label class="inline radio">
                        <?php
                        //for A/C checked
                        if ($model_arrival->vehicle_required == 'no')
                            $checkedac = 'checked';
                        else
                            $checkedac = '';
                        ?> 

                        <?php echo $form->radioButton($model_arrival, 'vehicle_required[]', array('value' => 'no', 'checked' => $checkedac, 'class' => 'A_tbvn')); ?>
                        No</label>


                </div>
            </div>
            <div class="form-row control-group row-fluid" id="A_driver_name">
                <label class="control-label span3" for="Phone_no">Driver Name</label>
                <div class="controls span7">
                    <?php
                    if (isset($_GET['id']))
                        echo $form->dropDownList($model_arrival, 'driver_name', CHtml::listData(DriverMaster::model()->findAll(), 'id', 'driver_name'), array('empty' => 'Select Driver', 'class' => 'chosen-select', 'options' => array($_GET['id'] => array('selected' => true))));
                    else
                        echo $form->dropDownList($model_arrival, 'driver_name', CHtml::listData(DriverMaster::model()->findAll(), 'id', 'driver_name'), array('empty' => 'Select Driver', 'class' => 'chosen-select'));
                    ?>

                </div>
            </div>

            <div class="form-row control-group row-fluid" id="A_outsite_drivername" style="display: none">
                <label class="control-label span3" for="driver_name">Driver Name</label>
                <div class="controls span7">
                    <?php
                    echo $form->textField($model_arrival, 'outsite_drivername', array('class' => 'row-fluid'));
                    ?>
                </div>
            </div>

            <div class="form-row control-group row-fluid " id="A_mobile_no">
                <label class="control-label span3" for="mask-phone">Mobile No</label>
                <div class="controls span7">
                    <?php echo $form->textField($model_arrival, 'mobile_no', array('class' => 'row-fluid',)); ?>
                    <?php echo $form->error($model, 'mobile_no'); ?>

                </div>
            </div>

            <div class="form-row control-group row-fluid " id="A_outside_mobile_no" style="display: none">
                <label class="control-label span3" for="mask-phone">Mobile No</label>
                <div class="controls span7">
                    <?php echo $form->textField($model_arrival, 'outside_mobile_no', array('class' => 'row-fluid',)); ?>
                    <?php echo $form->error($model, 'outside_mobile_no'); ?>

                </div>
            </div>

            <div class="form-row control-group row-fluid" id="A_vehicle_category">
                <label class="control-label span3">Vehicle Category</label>
                <div class="controls span7">
                    <?php
                    $dropDownVal = CHtml::listData(VehicleCategory::model()->findAll("status='1'"), 'id', 'name');
                    echo $form->dropDownList($model_arrival, 'vehicle_category', $dropDownVal, array('empty' => 'Select Any Category', 'class' => 'chosen-select'));
                    ?>
                </div>
            </div>

            <div class="form-row control-group row-fluid" id="A_outsite_vehicle_category" style="display: none">
                <label class="control-label span3" for="Phone_no">Vehicle Category</label>
                <div class="controls span7">
                    <?php echo $form->textField($model_arrival, 'outside_vehicle_category', array('class' => 'row-fluid',)); ?>
                </div>
            </div>

            <div class="form-row control-group row-fluid" id="A_vehicle_no">
                <label class="control-label span3" for="Phone_no">Vehicle No</label>
                <div class="controls span7">
                    <span id="show_vehicle_no"></span>
                    <?php echo $form->dropDownList($model_arrival, 'vehicle_no', array(), array('empty' => 'Select Vehicle'));
                    ?>
                    <?php echo $form->error($model_arrival, 'vehicle_no'); ?>
                </div>
            </div>

            <div class="form-row control-group row-fluid" id="A_outside_vehicle_no" style="display:none">
                <label class="control-label span3" for="Phone_no">Vehicle No</label>
                <div class="controls span7">
                    <?php echo $form->textField($model_arrival, 'outside_vehicle_no', array('size' => 30, 'maxlength' => 30, 'class' => 'row-fluid')); ?>
                    <?php echo $form->error($model_arrival, 'outside_vehicle_no'); ?>
                </div>
            </div>




            <div class="form-row control-group row-fluid">
                <label class="control-label span3" for="inputEmail">Status<span class="help-block"></span></label>
                <div class="controls span7">
                    <?php //echo $form->listBox($model_arrival, 'status', array('Yes' => 'Yes', 'No' => 'No'), array('class' => 'chosen-select', 'data-placeholder' => 'Status')); ?>
                    <?php echo $form->textField($model_arrival, 'status', array('size' => 30, 'maxlength' => 30, 'class' => 'row-fluid')); ?>
                    <?php echo $form->error($model_arrival, 'status'); ?>


                </div>
            </div>

            <div class="form-row control-group row-fluid ">
                <label class="control-label span3" for="mask-phone">Hotel Room Nos</label>
                <div class="controls span7">
                    <?php echo $form->textField($model_arrival, 'hotel_room_no', array('class' => 'row-fluid',)); ?>
                    <?php echo $form->error($model_arrival, 'hotel_room_no'); ?>

                </div>
            </div>
            
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
    <!-- END Arrival -->
</div>

<!-- START DEPARTURE -->
<div class="span5">
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
            if (isset($_GET['msg2']))
                echo $_GET['msg2'];
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
                    <?php echo $form->error($model, 'outside_driver_name'); ?>

                </div>
            </div>

            <div class="form-row control-group row-fluid" id="D_mobile_no">
                <label class="control-label span3" for="mask-phone">Mobile No</label>
                <div class="controls span7">
                    <?php echo $form->textField($model_departure, 'mobile_no', array('class' => 'row-fluid',)); ?>
                    <?php echo $form->error($model, 'mobile_no'); ?>

                </div>
            </div>

            <div class="form-row control-group row-fluid" id="D_outside_mobile_no" style="display:none">
                <label class="control-label span3" for="mask-phone">Mobile No</label>
                <div class="controls span7">
                    <?php echo $form->textField($model_departure, 'outside_mobile_no', array('class' => 'row-fluid',)); ?>
                    <?php echo $form->error($model, 'mobile_no'); ?>

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
                    <?php echo $form->error($model, 'outside_vehicle_category'); ?>

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
                    <?php echo $form->error($model_arrival, 'vehicle_no'); ?>
                </div>
            </div>



            <div class="form-row control-group row-fluid" id="D_outside_vehicle_no" style="display:none">
                <label class="control-label span3" for="mask-phone">Vehicle No</label>
                <div class="controls span7">
                    <?php echo $form->textField($model_departure, 'outside_vehicle_no', array('class' => 'row-fluid',)); ?>
                    <?php echo $form->error($model, 'outside_vehicle_no'); ?>

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

</div>
<!-- END DEPARTURE -->
<div class="span5">
    <div class="box gradient">
        <div class="title">
            <h4> <i class="icon-tasks"></i> <span>Sight Seing<span class="botton_mergin3"> </span>
                    <span class=botton_margin1><a href="<?php echo Yii::app()->request->baseurl ?>/index.php/sightseen/index"><button class="btn btn-success" rel="tooltip" data-placement="right">List</button></a></span>
            </h4>
        </div>
        <div class="content">
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'sightseen-form',
                //'action'=>Yii::app()->request->baseUrl.'/index.php/sightseen/create',
                'enableAjaxValidation' => false,
                    ));
            if (isset($_GET['msg3']))
                echo $_GET['msg3'];
            ?>

            <div class="form-row control-group row-fluid">
                <label class="control-label span3" for="pnr_no">PNR NO</label>
                <div class="controls span7">
                    <?php echo $form->dropDownList($model_sightseen, 'pnr_no', CHtml::listData(Entries::model()->findAll(array('order'=>'id desc')), 'pnr_no', 'pnr_no'), array('class' => 'chosen-select',)); ?>
                    <?php echo $form->error($model_sightseen, 'pnr_no'); ?> 
                </div>
            </div>

            <div class="form-row control-group row-fluid">
                <label class="control-label span3" for="inputEmail">Entrance By<span class="help-block"></span></label>
                <div class="controls span7">
                    <?php echo $form->listBox($model_sightseen, 'entrance', array('TB' => 'TB', 'DIR' => 'DIR', 'Escort'=>'Escort', 'Not Clear'=>'Not Clear', 'Indian TB' => 'Indian TB'), array('empty' => 'Select Entrance', 'class' => 'chosen-select',)); ?>
                    <?php echo $form->error($model_sightseen, 'entrance'); ?>             
                </div>
            </div>

            <div class="form-row control-group row-fluid">
                <label class="control-label span3" for="Name_Of_Staff">Book By</label>
                <div class="controls span7">
                    <?php
                    if (isset($_GET['id']))
                        echo $form->dropDownList($model_sightseen, 'bookBy', CHtml::listData(StaffMaster::model()->findAll(), 'id', 'staff_name'), array('empty' => 'Select Staff', 'class' => 'chosen-select', 'options' => array($_GET['id'] => array('selected' => true))));
                    else
                        echo $form->dropDownList($model_sightseen, 'bookBy', CHtml::listData(StaffMaster::model()->findAll(), 'id', 'staff_name'), array('empty' => 'Select Staff', 'class' => 'chosen-select'));
                    ?>  
                </div>
            </div>

            <div class="form-row control-group row-fluid">
                <label class="control-label span3" for="Name_Of_Staff">Rec By</label>
                <div class="controls span7">
                    <?php
                    if (isset($_GET['id']))
                        echo $form->dropDownList($model_sightseen, 'recBy', CHtml::listData(StaffMaster::model()->findAll(), 'id', 'staff_name'), array('empty' => 'Select Staff', 'class' => 'chosen-select', 'options' => array($_GET['id'] => array('selected' => true))));
                    else
                        echo $form->dropDownList($model_sightseen, 'recBy', CHtml::listData(StaffMaster::model()->findAll(), 'id', 'staff_name'), array('empty' => 'Select Staff', 'class' => 'chosen-select'));
                    ?>  
                </div>
            </div>

            <div class="form-row control-group row-fluid">
                <label class="control-label span3" for="Phone_no">Service Name</label>
                <div class="controls span7">
                    <?php
                    if (isset($_GET['id']))
                        echo $form->dropDownList($model_sightseen, 'service_name', CHtml::listData(ServiceMaster::model()->findAll(), 'id', 'service_name'), array('empty' => 'Select service', 'class' => 'chosen-select', 'multiple'=>'multiple', 'options' => array($_GET['id'] => array('selected' => true))));
                    else
                        echo $form->dropDownList($model_sightseen, 'service_name', CHtml::listData(ServiceMaster::model()->findAll(), 'id', 'service_name'), array('empty' => 'Select Service', 'class' => 'chosen-select', 'multiple'=>'multiple'));
                    ?>

                </div>
            </div>
            <div class="form-row control-group row-fluid">
                <label class="control-label span3">Service Date</label>
                <div class="controls span7">
                    <div class="input-append date row-fluid">
						<?php
							$this->widget('zii.widgets.jui.CJuiDatePicker',array(
									'model'=>$model,
									'attribute'=>'service_date',
									'options'=>array(
										'dateFormat'=>'yy-mm-dd',
										'altFormat'=>'yy-mm-dd',
										'showButtonPanel' => true,
										'changeMonth'=>true,
										'changeYear'=>true,
										'yearRange'=>'1900:2099'
									),
									'htmlOptions'=>array(
										'value'=> $model->service_date,
										'class'=>'row-fluid', 
									),
							));
						?>
						<span class="add-on"><i class="icon-th"></i></span> 
					</div>
                </div>
            </div>            
            <div class="form-row control-group row-fluid">
                <label class="control-label span3" for="inputEmail">Choose Shop <span class="help-block"></span></label>
                <div class="controls span7">
                    <?php
                    if (isset($_GET['id']))
                        echo $form->dropDownList($model_sightseen, 'choose_shop', CHtml::listData(ApprovedMaster::model()->findAll(), 'id', 'shops_name'), array('empty' => 'Select Shop', 'multiple'=>'multiple', 'class' => 'chosen-select', 'options' => array($_GET['id'] => array('selected' => true))));
                    else
                        echo $form->dropDownList($model_sightseen, 'choose_shop', CHtml::listData(ApprovedMaster::model()->findAll(), 'id', 'shops_name'), array('empty' => 'Select Shop', 'multiple'=>'multiple', 'class' => 'chosen-select'));
                    ?>   
                </div>
            </div>
            <div class="form-row control-group row-fluid">
                <label class="control-label span3">Vehicle By TB</label>
                <div class="controls span7">
                    <label class="inline radio">
                        <?php
//for nonA/C checked
                        if ($model_sightseen->vehicle_requrement == 'yes')
                            $checkedac = 'checked';
                        else
                            $checkedac = '';

                        if (!isset($model_sightseen->vehicle_requrement))
                            $checkedac = 'checked';
                        ?>  		   
                        <?php echo $form->radioButton($model_sightseen, 'vehicle_requrement[]', array('value' => 'yes', 'checked' => $checkedac, 'class' => 'S_tbvy')); ?>
                        Yes</label>

                    <label class="inline radio">	

                        <?php
//for A/C checked
                        if ($model_sightseen->vehicle_requrement == 'no')
                            $checkedac = 'checked';
                        else
                            $checkedac = '';
                        ?> 

                        <?php echo $form->radioButton($model_sightseen, 'vehicle_requrement[]', array('value' => 'no', 'checked' => $checkedac, 'class' => 'S_tbvn')); ?>
                        No</label>


                </div>
            </div>

            <div class="form-row control-group row-fluid" id="S_driver_name">
                <label class="control-label span3" for="Phone_no">Driver Name</label>
                <div class="controls span7">
                    <?php
                    if (isset($_GET['id']))
                        echo $form->dropDownList($model_sightseen, 'driver_name', CHtml::listData(DriverMaster::model()->findAll(), 'id', 'driver_name'), array('empty' => 'Select Driver', 'class' => 'chosen-select', 'options' => array($_GET['id'] => array('selected' => true))));
                    else
                        echo $form->dropDownList($model_sightseen, 'driver_name', CHtml::listData(DriverMaster::model()->findAll(), 'id', 'driver_name'), array('empty' => 'Select Driver', 'class' => 'chosen-select'));
                    ?>

                </div>
            </div>

            <div class="form-row control-group row-fluid" id="S_outside_driver_name" style="display:none">
                <label class="control-label span3" for="Phone_no">Driver Name</label>
                <div class="controls span7">
                    <?php echo $form->textField($model_sightseen, 'outside_driver_name', array('size' => 30, 'maxlength' => 30, 'class' => 'row-fluid')); ?>
                    <?php echo $form->error($model_sightseen, 'outside_driver_name'); ?>
                </div>
            </div>

            <div class="form-row control-group row-fluid " id="S_mobile_no">
                <label class="control-label span3" for="mask-phone">Mobile No</label>
                <div class="controls span7">
                    <?php echo $form->textField($model_sightseen, 'mobile_no', array('class' => 'row-fluid',)); ?>
                    <?php echo $form->error($model_sightseen, 'mobile_no'); ?>

                </div>
            </div>

            <div class="form-row control-group row-fluid " id="S_outside_mobile_no" style="display: none">
                <label class="control-label span3" for="mask-phone">Mobile No</label>
                <div class="controls span7">
                    <?php echo $form->textField($model_sightseen, 'outside_mobile_no', array('class' => 'row-fluid',)); ?>
                    <?php echo $form->error($model_sightseen, 'outside_mobile_no'); ?>

                </div>
            </div>

            <div class="form-row control-group row-fluid" id="S_choose_vehicle_category">
                <label class="control-label span3" for="inputEmail">Vehicle Category<span class="help-block"></span></label>
                <div class="controls span7">
                    <?php
                    $dropDownVal = CHtml::listData(VehicleCategory::model()->findAll("status='1'"), 'id', 'name');
                    echo $form->dropDownList($model_sightseen, 'choose_vehicle_category', $dropDownVal, array('empty' => 'Select Any Category', 'class' => 'chosen-select'));
                    ?>     
                </div>
            </div>

            <div class="form-row control-group row-fluid" id="S_outside_vehicle_category" style="display: none">
                <label class="control-label span3" for="Phone_no">Vehicle Category</label>
                <div class="controls span7">
                    <?php echo $form->textField($model_sightseen, 'outside_vehicle_category', array('size' => 30, 'maxlength' => 30, 'class' => 'row-fluid')); ?>
                    <?php echo $form->error($model_sightseen, 'outside_vehicle_category'); ?>
                </div>
            </div>

            <div class="form-row control-group row-fluid" id="S_vehicle_no">
                <label class="control-label span3" for="Phone_no">Vehicle No</label>
                <div class="controls span7">
                    <?php 
                    //CHtml::listData(VehicleMaster::model()->findAll(), 'id', 'registration_number')
                    echo $form->dropDownList($model_sightseen, 'vehicle_no', array(), array('empty' => 'Select Vehicle'));
                    ?>
                    <?php echo $form->error($model_sightseen, 'vehicle_no'); ?>
                </div>
            </div>

            <div class="form-row control-group row-fluid" id="S_outside_vehicle_no" style="display: none">
                <label class="control-label span3" for="Phone_no">Vehicle No</label>
                <div class="controls span7">
                    <?php echo $form->textField($model_sightseen, 'outside_vehicle_no', array('size' => 30, 'maxlength' => 30, 'class' => 'row-fluid')); ?>
                    <?php echo $form->error($model_sightseen, 'outside_vehicle_no'); ?>
                </div>
            </div>


            <div class="form-row control-group row-fluid">
                <label class="control-label span3">Number of Vehicle</label>
                <div class="controls span7">
                    <?php
                    $lv = array();
                    for ($i = 1; $i <= 20; $i++) {
                        $lv[$i] = $i;
                    }
                    ?>
                    <?php echo $form->dropDownList($model_sightseen, 'no_of_vehicle', $lv, array('class' => 'chosen-select')); ?>  

                </div>
            </div>



            <div class="form-row control-group row-fluid">
                <label class="control-label span3">Guide Required</label>
                <div class="controls span7">
                    <label class="inline radio">
                        <?php
//for nonA/C checked
                        if ($model_sightseen->guide_required == 'yes')
                            $checkedac = 'checked';
                        else
                            $checkedac = '';
                        
                        if (!isset($model_sightseen->guide_required))
                            $checkedac = 'checked';
                        ?>  		   
                        <?php echo $form->radioButton($model_sightseen, 'guide_required[]', array('value' => 'yes', 'checked' => $checkedac,'class'=>'S_guide_require_y')); ?>
                        Yes</label>
                    
                    <label class="inline radio">
                        <?php
//for A/C checked
                        if ($model_sightseen->guide_required == 'No')
                            $checkedac = 'checked';
                        else
                            $checkedac = '';
                        ?> 

                        <?php echo $form->radioButton($model_sightseen, 'guide_required[]', array('value' => 'no', 'checked' => $checkedac,'class'=>'S_guide_require_n')); ?>
                        No</label>
                    	 

                </div>
            </div>
            <div class="form-row control-group row-fluid" id="S_guide_name">
                <label class="control-label span3" for="Phone_no">Guide Name</label>
                <div class="controls span7">
                    <?php
                    if (isset($_GET['id']))
                        echo $form->dropDownList($model_sightseen, 'guide_name', CHtml::listData(GuideMaster::model()->findAll(), 'id', 'guide_name'), array('empty' => 'Select guide', 'class' => 'chosen-select', 'options' => array($_GET['id'] => array('selected' => true))));
                    else
                        echo $form->dropDownList($model_sightseen, 'guide_name', CHtml::listData(GuideMaster::model()->findAll(), 'id', 'guide_name'), array('empty' => 'Select Guide', 'class' => 'chosen-select'));
                    ?>

                </div>
            </div>   
            <div class="form-row control-group row-fluid" id="S_language">
                <label class="control-label span3" for="Phone_no">Language</label>
                <div class="controls span7">

                    <?php
                    if (isset($_GET['id']))
                        echo $form->dropDownList($model_sightseen, 'language', CHtml::listData(GuideMaster::model()->findAllBySql("select Distinct language from guide_master"), 'language', 'language'), array('empty' => 'Select language', 'options' => array($_GET['id'] => array('selected' => true))));
                    else
                        echo $form->dropDownList($model_sightseen, 'language', array(), array('empty' => 'Select language'));
                    ?>

                </div>
            </div>      

            <div class="form-row control-group row-fluid" id="S_reporting_place">
                <label class="control-label span3" for="Mobile_no">Reporting Place</label>
                <div class="controls span7">
                    <?php echo $form->textField($model_sightseen, 'reporting_place', array('size' => 40, 'maxlength' => 40, 'class' => 'row-fluid')); ?>
                    <?php echo $form->error($model_sightseen, 'reporting_place'); ?>             
                </div>
            </div>
            <div class="form-row control-group row-fluid" id="S_time">
                <label class="control-label span3" for="Mobile_no">Time </label>
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
                    echo $form->dropDownList($model_sightseen, 'time[]', $hh, array('empty' => 'HH','style'=>'width:66px'));
                    echo $form->dropDownList($model_sightseen, 'time[]', $mm, array('empty' => 'MM','style'=>'width:66px'));
                    ?>
                </div>
            </div>
            <div class="form-row control-group row-fluid">
                <label class="control-label span3" for="Mobile_no">Remark</label>
                <div class="controls span7">
                    <?php echo $form->textField($model_sightseen, 'remark', array('size' => 60, 'maxlength' => 70, 'class' => 'row-fluid')); ?>
                    <?php echo $form->error($model, 'remark'); ?>
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
    <!-- form -->
    <?php
//GuideMaster::model()->findAllBySql("select Distinct languate from guide_master")
    ?>

    <!-- script for entries -->
    <script>
        function totalPax(){
            var noa = $("#Entries_no_of_adult").val();
            var noc = $("#Entries_indian_child").val();
            var nof = $("#Entries_foreigner_child").val();
            var noi = $("#Entries_foreigner_adult").val();
            
            var total =  Number(noa) + Number(noc) + Number(nof) + Number(noi);
            $("#totalNoPax").val(total);
        }
        
        $("#Entries_indian_adult").change(function(){
            totalPax();
        });
        
        $("#Entries_indian_child").change(function(){
            totalPax();
        });
        
        $("#Entries_foreigner_child").change(function(){
            totalPax();
        });
        
        $("#Entries_foreigner_adult").change(function(){
            totalPax();
        });
        
        $("#Entries_agency").change(function(){
        
            $.post('<?php echo $this->createUrl('//entries/getCity'); ?>',{val:$(this).val()},function(data){
                if(data!='')
                    data=data;
                else
                    data = 'Not Set';
                $("#agencyCity").val(data);
            }); 
        });
    
        //TB vehicle yes or not
        $(".tbvy").click(function(){
            $("#outsite_drivername").css("display","none");
            $("#Entries_driver_mobile_no").css("display","none");
            $("#outsite_vehicle_no").css("display","none");
            $("#outsite_vehicle_category").css("display","none");

            $("#driver_name").css("display","block");
            $("#Entries_mobile_no").css("display","block");
            $("#vehicle_no").css("display","block");
            $("#vehicle_category").css("display","block");
        });

        $(".tbvn").click(function(){
            $("#driver_name").css("display","none");
            $("#Entries_mobile_no").css("display","none");
            $("#vehicle_no").css("display","none");
            $("#vehicle_category").css("display","none");

            $("#outsite_drivername").css("display","block");
            $("#Entries_driver_mobile_no").css("display","block");
            $("#outsite_vehicle_no").css("display","block");
            $("#outsite_vehicle_category").css("display","block");
        });

        $("#Entries_driver_name").change(function(){
            $.post('<?php echo $this->createUrl('//entries/getDriverMobile'); ?>',{val:$(this).val()},function(data){
                if(data!='')
                    data = data;
                else
                    data = 'Not Set';
                $("#Entries_mobile_no").val(data);
            }); 
        });
    
        $(".hh").click(function(){
            if($(".hh").is(':checked'))
                $('#hide').css("display","none");
            $('#Entries_same_day').val('Yes');
        });
                               
        $(".ss").click(function(){
            if($(".ss").is(':checked'))
                $('#hide').css("display","block");
            $('#Entries_same_day').val('No');
        });
        
        $("#Entries_vehicle_category").change(function(){
            $.post('<?php echo $this->createUrl('//entries/getVehicleRegNum'); ?>',{val:$(this).val()},function(data){
                $("#Entries_vehicle_no").html(data);
            });
        });
        
        $("#Entries_choose_hotel").change(function(){
            var val = $(this).val();
            $.post('<?php echo $this->createUrl('//entries/getRoomCategory'); ?>',{val:$(this).val()},function(data){
                $("#Entries_room_category").html(data);
            });
        });
        
        $("#Entries_room_category").change(function(){
            var val = $("#Entries_choose_hotel").val();
            var val2 = $(this).val();
            $.post('<?php echo $this->createUrl('//entries/getRoomType'); ?>',{val:val, val2: val2},function(data){
                
                $("#Entries_room_type").html(data);
            });
        });
    </script>
    <!-- script for entries -->

    <!-- script for arrival -->
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
                $("#A_to").css("display","block");
            }else if(val=='Bus'){
                $("#A_train_name").css("display","none");
                $("#A_bus_name").css("display","block");
                $("#A_flight_name").css("display","none");
                $("#A_train_flight_no").css("display","none");
                $("#A_surface_location").css("display","none");
                $("#A_from").css("display","block");
                $("#A_to").css("display","block");
            }else if(val=='Flight'){
                $("#A_train_name").css("display","none");
                $("#A_bus_name").css("display","none");
                $("#A_flight_name").css("display","block");
                $("#A_train_flight_no").css("display","block");
                $("#A_surface_location").css("display","none");
                $("#A_from").css("display","block");
                $("#A_to").css("display","block");
            }else{
                $("#A_train_name").css("display","none");
                $("#A_bus_name").css("display","none");
                $("#A_flight_name").css("display","none");
                $("#A_train_flight_no").css("display","none");
                $("#A_surface_location").css("display","block");
                $("#A_from").css("display","none");
                $("#A_to").css("display","none");
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
            
            $.post('<?php echo $this->createUrl('//entries/getTo'); ?>',{val:$(this).val(), type:arrival},function(data){
                $("#Arrival_at").html(data);
            });
        });
        
        
        
        
        $("#Arrival_train_flight_no").change(function(){
            
            var arrival = $("#Arrival_arrival").val();
            
            $.post('<?php echo $this->createUrl('//entries/getFrom'); ?>',{val:$(this).val(), type:arrival},function(data){
                $("#Arrival_from").html(data);
            });
            
            $.post('<?php echo $this->createUrl('//entries/getTo'); ?>',{val:$(this).val(), type:arrival},function(data){
                $("#Arrival_at").html(data);
            });
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
    <!-- script for arrival -->

    <!-- script for departure -->
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
    <!-- script for departure -->

    <!-- script for sightseen -->
    <script>
        //TB vehicle yes or not
        $(".S_tbvy").click(function(){
            $("#S_outside_driver_name").css("display","none");
            $("#S_outside_vehicle_no").css("display","none");
            $("#S_outside_mobile_no").css("display","none");
            $("#S_outside_vehicle_category").css("display","none");

            $("#S_driver_name").css("display","block");
            $("#S_mobile_no").css("display","block");
            $("#S_vehicle_no").css("display","block");
            $("#S_choose_vehicle_category").css("display","block");
        });

        $(".S_tbvn").click(function(){
            $("#S_driver_name").css("display","none");
            $("#S_mobile_no").css("display","none");
            $("#S_vehicle_no").css("display","none");
            $("#S_choose_vehicle_category").css("display","none");

            $("#S_outside_driver_name").css("display","block");
            $("#S_outside_mobile_no").css("display","block");
            $("#S_outside_vehicle_no").css("display","block");
            $("#S_outside_vehicle_category").css("display","block");
        });
        
        $("#Sightseen_choose_vehicle_category").change(function(){
            $.post('<?php echo $this->createUrl('//entries/getVehicleRegNum'); ?>',{val:$(this).val()},function(data){
                $("#Sightseen_vehicle_no").html(data);
            });
        });
        
        $("#Sightseen_driver_name").change(function(){
            $.post('<?php echo $this->createUrl('//entries/getDriverMobile'); ?>',{val:$(this).val()},function(data){
                if(data!='')
                    data = data;
                else
                    data = 'Not Set';
                $("#Sightseen_mobile_no").val(data);
            }); 
        });
        
        $(".S_guide_require_y").click(function(){
           $("#S_guide_name").css("display","block");
           $("#S_language").css("display","block");
           $("#S_reporting_place").css("display","block");
           $("#S_time").css("display","block");
        });
        
        $(".S_guide_require_n").click(function(){
           $("#S_guide_name").css("display","none");
           $("#S_language").css("display","none");
           $("#S_reporting_place").css("display","none");
           $("#S_time").css("display","none");
        });
        
        $("#Sightseen_guide_name").change(function(){
            $.post('<?php echo $this->createUrl('//entries/getGuideLanguage'); ?>',{val:$(this).val()},function(data){
                
                $("#Sightseen_language").html(data);
            });
        });
    </script>
    <!-- script for sightseen -->