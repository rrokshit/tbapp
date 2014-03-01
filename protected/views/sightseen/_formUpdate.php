<?php $chkSightSeen = Sightseen::model()->find("pnr_no='" . $pnrDetails->pnr_no . "'"); ?>
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
                <?php echo $form->textField($model_sightseen, 'pnr_no', array('value' => $pnrDetails->pnr_no, 'readonly' => 'readonly')); ?>
                <?php echo $form->error($model_sightseen, 'pnr_no'); ?> 
            </div>
        </div>

        <?php echo $form->textField($model_sightseen, 'arrival_id', array('value' => $pnrDetails->id, 'readonly' => 'readonly', 'style' => "display:none")); ?>


        <div class="form-row control-group row-fluid">
            <label class="control-label span3" for="pnr_no">Arr. Date</label>
            <div class="controls span7">
                <input type="text" name="arrdate" value="<?php echo date("Y-m-d", strtotime($pnrDetails->arrival_date)); ?>" disabled="disabled"/>

            </div>
        </div>


        <div class="form-row control-group row-fluid">
            <label class="control-label span3" for="pnr_no">Agency</label>
            <div class="controls span7">
                <input type="text" name="arrdate" value="<?php echo AgencyMaster::model()->findByPk(Entries::model()->find("pnr_no='" . $pnrDetails->pnr_no . "'")->agency)->agency_name; ?>" disabled="disabled" class="row-fluid"/>

            </div>
        </div>

        <div class="form-row control-group row-fluid">
            <label class="control-label span3">Service Date</label>
            <div class="controls span7">
				<?php $arrDate = date("Y-m-d", strtotime($model_serviceUpdate->find("sightSeenId='".$model_sightseen->id."'")->serviceDate));?>
                 <div class="input-append date row-fluid">
					<?php
						$this->widget('zii.widgets.jui.CJuiDatePicker',array(
								'model'=>$model_serviceUpdate,
								'attribute'=>'serviceDate',
								'options'=>array(
									'dateFormat'=>'yy-mm-dd',
									'altFormat'=>'yy-mm-dd',
									'showButtonPanel' => true,
									'changeMonth'=>true,
									'changeYear'=>true,
									'yearRange'=>'1900:2099'
								),
								'htmlOptions'=>array(
									'value'=> $arrDate,
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
                $shopList = explode(',', $model_sightseen->choose_shop);
                $sel = array();
                foreach ($shopList as $shop) {
                    $sel[$shop] = array('selected' => true);
                }

                echo $form->dropDownList($model_sightseen, 'choose_shop', CHtml::listData(ApprovedMaster::model()->findAll(), 'id', 'shops_name'), array('empty' => 'Select Shop', 'multiple' => 'multiple', 'class' => 'chosen-select', 'options' => $sel));
                ?>   
            </div>
        </div>

        <div class="form-row control-group row-fluid">
            <label class="control-label span3" for="Phone_no">Service Name</label>
            <div class="controls span7">
                <?php
                $shopList = explode(',', $model_serviceUpdate->find("sightSeenId=$model_sightseen->id")->serviceName);
                $sel = array();
                foreach ($shopList as $shop) {
                    $sel[$shop] = array('selected' => true);
                }
                echo $form->dropDownList($model_serviceUpdate, 'serviceName', CHtml::listData(ServiceMaster::model()->findAll(), 'id', 'service_name'), array('class' => 'chosen-select', 'options' => $sel));
                ?>
            </div>
        </div>

        <div class="form-row control-group row-fluid">
            <label class="control-label span3" for="inputEmail">Entrance By<span class="help-block"></span></label>
            <div class="controls span7">
                <?php 
                $sel = array();
                $sel[$model_serviceUpdate->find("sightSeenId=$model_sightseen->id")->entranceBy] = array('selected' => true);
                echo $form->listBox($model_serviceUpdate, 'entranceBy', array('TB' => 'TB', 'DIR' => 'DIR', 'Escort' => 'Escort', 'Not Clear' => 'Not Clear', 'Indian TB' => 'Indian TB'), array('class' => 'chosen-select','options' => $sel)); ?>
                          
            </div>
        </div>

        <!-- start guide details -->

        <div class="form-row control-group row-fluid">
            <label class="control-label span3" for="Phone_no">No. Of Guide</label>
            <div class="controls span7">
                <?php
                echo $form->textField($model_sightseen, 'noOfGuide', array('class' => 'row-fluid',));
                ?>
            </div>
        </div>

        <span id="guideDetailsDoc" style="display: none">
            <table class="row-fluid">
                <tr>
                    <td>
                        <div class="form-row control-group row-fluid" id="S_language">
                            <div class="controls span7">
                                <?php echo $form->dropDownList($model_sightSeenGuideDetails, 'language[]', CHtml::listData(LanguageMaster::model()->findAll("status='1'"), 'id', 'name'), array('empty' => 'Select Language')); ?>

                            </div>
                        </div> 

                    </td>
                    <td>
                        <div class="form-row control-group row-fluid" id="S_guide_name">
                            <div class="controls span7">
                                <?php
                                echo $form->dropDownList($model_sightSeenGuideDetails, 'guide[]', CHtml::listData(GuideMaster::model()->findAll(), 'id', 'guide_name'), array('empty' => 'Select Guide'));
                                ?>

                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="form-row control-group row-fluid" id="S_guide_name">
                            <div class="controls span7">
                                <?php
                                echo $form->dropDownList($model_sightSeenGuideDetails, 'halfOrFull[]', array('Half Day' => 'Half Day', 'Full Day' => 'Full Day'));
                                ?>

                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="form-row control-group row-fluid" id="S_outside_driver_name">
                            <div class="controls span7">
                                <?php //echo $form->textField($model_sightSeenGuideDetails, 'outStation[]', array('size' => 10, 'maxlength' => 30, 'class' => 'row-fluid', 'value' => 'No')); ?>
                                <?php echo CHtml::dropDownList("SightSeenGuideDetails[outStation][]", '', array('No' => 'Outstation No', 'Yes' => 'Outstation Yes')); ?>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </span>

        
        <span id="guideDetailsAppend">
            <?php
            if($model_sightseen->noOfGuide>0){
                $guideDetails = $model_sightSeenGuideDetails->findAll("sightSeenId=$model_sightseen->id");
                foreach($guideDetails as $guides){
                    ?>
                    <table class="row-fluid">
                    <tr>
                        <td>
                            <div class="form-row control-group row-fluid" id="S_language">
                                <div class="controls span7">
                                    <?php 
                                    $sel = array();
                                    $sel[$guides->language] = array('selected' => true);
                                    echo $form->dropDownList($model_sightSeenGuideDetails, 'language[]', CHtml::listData(LanguageMaster::model()->findAll("status='1'"), 'id', 'name'), array('empty' => 'Select Language','options'=>$sel)); ?>

                                </div>
                            </div> 

                        </td>
                        <td>
                            <div class="form-row control-group row-fluid" id="S_guide_name">
                                <div class="controls span7">
                                    <?php
                                    $sel = array();
                                    $sel[$guides->guide] = array('selected' => true);
                                    echo $form->dropDownList($model_sightSeenGuideDetails, 'guide[]', CHtml::listData(GuideMaster::model()->findAll(), 'id', 'guide_name'), array('empty' => 'Select Guide','options'=>$sel));
                                    ?>

                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-row control-group row-fluid" id="S_guide_name">
                                <div class="controls span7">
                                    <?php
                                    $sel = array();
                                    $sel[$guides->halfOrFull] = array('selected' => true);
                                    echo $form->dropDownList($model_sightSeenGuideDetails, 'halfOrFull[]', array('Half Day' => 'Half Day', 'Full Day' => 'Full Day'),array('options'=>$sel));
                                    ?>

                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-row control-group row-fluid" id="S_outside_driver_name">
                                <div class="controls span7">
                                    <?php 
                                    //$sel = array();
                                    //$sel[$guides->outStation] = array('selected' => true);
                                    //echo $form->textField($model_sightSeenGuideDetails, 'outStation[]', array('size' => 10, 'maxlength' => 30, 'class' => 'row-fluid', 'value' => 'No'),array('options'=>$sel)); ?>
                                    <?php echo CHtml::dropDownList("SightSeenGuideDetails[outStation][]", $guides->outStation, array('No' => 'Outstation No', 'Yes' => 'Outstation Yes')); ?>
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

        <!-- end guide details -->

        <?php if ($model_sightseen->no_of_vehicle != '' and $model_sightseen->no_of_vehicle <= 0) { ?>
            <div class="form-row control-group row-fluid">
                <label class="control-label span3" for="pnr_no">Driver Name</label>
                <div class="controls span7">
                    <input type="text" name="otherDriverName" value="<?php echo ArrivalVehicle::model()->getDriverName($pnrDetails->id, 'Arrival'); ?>"/>

                </div>
            </div>
            <div class="form-row control-group row-fluid">
                <label class="control-label span3" for="pnr_no">Driver Mobile No.</label>
                <div class="controls span7">
                    <input type="text" name="otherDriverMobile" value="<?php echo ArrivalVehicle::model()->getDriverMobile($pnrDetails->id, 'Arrival'); ?>" />

                </div>
            </div>
        <?php } ?>





        <!-- statr vehicle details -->
        <div class="form-row control-group row-fluid">
            <label class="control-label span3">Number of Vehicle</label>
            <div class="controls span7">
                
                
                <?php echo $form->textField($model_sightseen, 'no_of_vehicle'); ?>  

            </div>
        </div>

        <span id="arrivalVehicle" style="display: none">
            <table>
                <tr>
                    <td>
                        <div class="form-row control-group row-fluid">
                            <div class="controls span7">
                                <?php
                                $dropDownVal = CHtml::listData(VehicleCategory::model()->findAll("status='1'"), 'id', 'name');
                                echo $form->dropDownList($model_arrivalVehicle, 'vehicleCategory[]', $dropDownVal, array('empty' => 'Select Vehicle Category'));
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
                                echo $form->textField($model_arrivalVehicle, 'noOfVehicle[]', array('value' => 1));
                                ?> 
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </span>

        <span id="arrivalVehicleDoc">
            <?php
            //if arrival was booked vehicle 
            if($model_sightseen->no_of_vehicle > 0){
                $getArrivalVehicle = ArrivalVehicle::model()->findAll("type='Sightseen' and particularPk='".$model_sightseen->id."' group by vehicleCategory, acOrNot");
                foreach($getArrivalVehicle as $arrVD){
                    ?>
                    <table>
                        <tr>
                            <td>
                                <div class="form-row control-group row-fluid">
                                    <div class="controls span7">
                                        <?php
                                        $dropDownVal = CHtml::listData(VehicleCategory::model()->findAll("status='1'"), 'id', 'name');
                                        echo $form->dropDownList($model_arrivalVehicle, 'vehicleCategory[]', $dropDownVal, array('empty' => 'Select Vehicle Category','options'=>array($arrVD->vehicleCategory=>array('selected'=>'true'))));
                                        ?> 
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="form-row control-group row-fluid">
                                    <div class="controls span7">
                                        <?php
                                        echo $form->dropDownList($model_arrivalVehicle, 'acOrNot[]', array('AC' => 'AC', 'Non AC' => 'Non AC'),array('options'=>array($arrVD->acOrNot=>array('selected'=>'true'))));
                                        ?> 
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="form-row control-group row-fluid">
                                    <div class="controls span7">
                                        <?php
                                        echo $form->textField($model_arrivalVehicle, 'noOfVehicle[]', array('value' => sizeof(ArrivalVehicle::model()->findAll("type='Sightseen' and particularPk='".$model_sightseen->id."' and vehicleCategory=$arrVD->vehicleCategory"))));
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
        <!-- end vehicle details -->

        <?php
        //if (count($chkSightSeen) < 1) {
            ?>
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
                    $getTime = ArrivalVehicle::model()->find("type='Sightseen' and particularPk=$model_sightseen->id")->particularTime;
                    $getTime = explode(':', $getTime);
                    echo $form->dropDownList($model_serviceUpdate, 'serviceTime[]', $hh, array('empty' => 'HH', 'style' => 'width:66px','options'=>array($getTime[0]=>array('selected'=>'true'))));
                    echo $form->dropDownList($model_serviceUpdate, 'serviceTime[]', $mm, array('empty' => 'MM', 'style' => 'width:66px','options'=>array($getTime[1]=>array('selected'=>'true'))));
                    ?>
                </div>
            </div>
        <?php //} ?>
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
                <button type="reset" class="btn btn-secondary">Cancel</button>
            </div>
        </div>
        <?php $this->endWidget(); ?>
    </div>
</div>


<script>
    $("#Sightseen_no_of_vehicle").keyup(function() {
        var val = $(this).val();
        var arrivalVehicle = $("#arrivalVehicle").html();
        $("#arrivalVehicleDoc").html('');
        for (var i = 0; i < val; i++) {
            $("#arrivalVehicleDoc").append(arrivalVehicle);
        }
    });

    $("#Sightseen_noOfGuide").keyup(function() {
        var value = $(this).val();
        var guideDoc = $("#guideDetailsDoc").html();
        $("#guideDetailsAppend").html('');
        for (var x = 0; x < value; x++) {
            //$("#guideDetailsHeader").css("display","block");
            $("#guideDetailsAppend").append(guideDoc);
        }
    });

    //TB vehicle yes or not
    $(".S_tbvy").click(function() {
        $("#S_outside_driver_name").css("display", "none");
        $("#S_outside_vehicle_no").css("display", "none");
        $("#S_outside_mobile_no").css("display", "none");
        $("#S_outside_vehicle_category").css("display", "none");

        $("#S_driver_name").css("display", "block");
        $("#S_mobile_no").css("display", "block");
        $("#S_vehicle_no").css("display", "block");
        $("#S_choose_vehicle_category").css("display", "block");
    });

    $(".S_tbvn").click(function() {
        $("#S_driver_name").css("display", "none");
        $("#S_mobile_no").css("display", "none");
        $("#S_vehicle_no").css("display", "none");
        $("#S_choose_vehicle_category").css("display", "none");

        $("#S_outside_driver_name").css("display", "block");
        $("#S_outside_mobile_no").css("display", "block");
        $("#S_outside_vehicle_no").css("display", "block");
        $("#S_outside_vehicle_category").css("display", "block");
    });

    $("#Sightseen_choose_vehicle_category").change(function() {
        $.post('<?php echo $this->createUrl('//entries/getVehicleRegNum'); ?>', {val: $(this).val()}, function(data) {
            $("#Sightseen_vehicle_no").html(data);
        });
    });

    $("#Sightseen_driver_name").change(function() {
        $.post('<?php echo $this->createUrl('//entries/getDriverMobile'); ?>', {val: $(this).val()}, function(data) {
            if (data != '')
                data = data;
            else
                data = 'Not Set';
            $("#Sightseen_mobile_no").val(data);
        });
    });

    $(".S_guide_require_y").click(function() {
        $("#S_guide_name").css("display", "block");
        $("#S_language").css("display", "block");
        $("#S_reporting_place").css("display", "block");
        $("#S_time").css("display", "block");
    });

    $(".S_guide_require_n").click(function() {
        $("#S_guide_name").css("display", "none");
        $("#S_language").css("display", "none");
        $("#S_reporting_place").css("display", "none");
        $("#S_time").css("display", "none");
    });

    $("#Sightseen_guide_name").change(function() {
        $.post('<?php echo $this->createUrl('//entries/getGuideLanguage'); ?>', {val: $(this).val()}, function(data) {

            $("#Sightseen_language").html(data);
        });
    });
</script>
