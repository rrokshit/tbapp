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
        if (isset($_GET['msg']))
            echo $_GET['msg'];
        ?>

        <div class="form-row control-group row-fluid">
            <label class="control-label span3" for="pnr_no">PNR NO</label>
            <div class="controls span7">
                <?php echo $form->dropDownList($model_sightseen, 'pnr_no', CHtml::listData(Entries::model()->findAll(array('order' => 'id desc')), 'pnr_no', 'pnr_no'), array('class' => 'chosen-select',)); ?>
                <?php echo $form->error($model_sightseen, 'pnr_no'); ?> 
            </div>
        </div>

        <div class="form-row control-group row-fluid">
            <label class="control-label span3" for="inputEmail">Entrance By<span class="help-block"></span></label>
            <div class="controls span7">
                <?php echo $form->listBox($model_sightseen, 'entrance', array('TB' => 'TB', 'DIR' => 'DIR', 'Escort' => 'Escort', 'Not Clear' => 'Not Clear', 'Indian TB' => 'Indian TB'), array('empty' => 'Select Entrance', 'class' => 'chosen-select',)); ?>
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
                    echo $form->dropDownList($model_sightseen, 'service_name', CHtml::listData(ServiceMaster::model()->findAll(), 'id', 'service_name'), array('empty' => 'Select service', 'class' => 'chosen-select', 'multiple' => 'multiple', 'options' => array($_GET['id'] => array('selected' => true))));
                else
                    echo $form->dropDownList($model_sightseen, 'service_name', CHtml::listData(ServiceMaster::model()->findAll(), 'id', 'service_name'), array('empty' => 'Select Service', 'class' => 'chosen-select', 'multiple' => 'multiple'));
                ?>

            </div>
        </div>
        <div class="form-row control-group row-fluid">
            <label class="control-label span3">Service Date</label>
            <div class="controls span7">
                <div class="input-append date row-fluid" id="datepicker4" data-date="<?php echo date("Y-m-d"); ?>" data-date-format="dd-mm-yyyy">
                    <?php echo $form->textField($model_sightseen, 'service_date', array('class' => 'row-fluid', 'value' => date("Y-m-d"))); ?>
                    <?php echo $form->error($model_sightseen, 'service_date'); ?>
                    <span class="add-on"><i class="icon-th"></i></span>
                </div>
				
            </div>
        </div>            
        <div class="form-row control-group row-fluid">
            <label class="control-label span3" for="inputEmail">Choose Shop <span class="help-block"></span></label>
            <div class="controls span7">
                <?php
                if (isset($_GET['id']))
                    echo $form->dropDownList($model_sightseen, 'choose_shop', CHtml::listData(ApprovedMaster::model()->findAll(), 'id', 'shops_name'), array('empty' => 'Select Shop', 'multiple' => 'multiple', 'class' => 'chosen-select', 'options' => array($_GET['id'] => array('selected' => true))));
                else
                    echo $form->dropDownList($model_sightseen, 'choose_shop', CHtml::listData(ApprovedMaster::model()->findAll(), 'id', 'shops_name'), array('empty' => 'Select Shop', 'multiple' => 'multiple', 'class' => 'chosen-select'));
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
                    <?php echo $form->radioButton($model_sightseen, 'guide_required[]', array('value' => 'yes', 'checked' => $checkedac, 'class' => 'S_guide_require_y')); ?>
                    Yes</label>

                <label class="inline radio">
                    <?php
//for A/C checked
                    if ($model_sightseen->guide_required == 'No')
                        $checkedac = 'checked';
                    else
                        $checkedac = '';
                    ?> 

                    <?php echo $form->radioButton($model_sightseen, 'guide_required[]', array('value' => 'no', 'checked' => $checkedac, 'class' => 'S_guide_require_n')); ?>
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
                    echo $form->dropDownList($model_sightseen, 'language', CHtml::listData(GuideMaster::model()->findAllBySql("select Distinct language from guide_master"), 'id', 'language'), array('empty' => 'Select language', 'options' => array($_GET['id'] => array('selected' => true))));
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
                $hh = array();
                $mm = array();
                for ($i = 0; $i <= 23; $i++) {
                    $i = str_pad($i, 2, '0', STR_PAD_LEFT);
                    $hh[$i] = $i;
                }
                for ($i = 1; $i <= 60; $i++) {
                    $i = str_pad($i, 2, '0', STR_PAD_LEFT);
                    $mm[$i] = $i;
                }
                echo $form->dropDownList($model_sightseen, 'time[]', $hh, array('empty' => 'HH', 'style' => 'width:66px'));
                echo $form->dropDownList($model_sightseen, 'time[]', $mm, array('empty' => 'MM', 'style' => 'width:66px'));
                ?>
            </div>
        </div>
        <div class="form-row control-group row-fluid">
            <label class="control-label span3" for="Mobile_no">Remark</label>
            <div class="controls span7">
                <?php echo $form->textField($model_sightseen, 'remark', array('size' => 60, 'maxlength' => 70, 'class' => 'row-fluid')); ?>
                <?php echo $form->error($model_sightseen, 'remark'); ?>
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