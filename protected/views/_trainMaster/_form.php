<?php
/* @var $this TrainMasterController */
/* @var $model TrainMaster */
/* @var $form CActiveForm */
?>

    <div class="box gradient">


        <div class="title">
            <h3>
                <i class="icon-book"></i><span>Train Master<span class="botton_mergin3"></span>
                    <span class=botton_margin1><a href="<?php echo Yii::app()->createUrl("TrainMaster/admin"); ?>" class="btn btn-success">List</a></span></span>
            </h3>
        </div>
        <div class="content">
            <!-- Train Master Start -->

            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'train-master-form',
                'enableAjaxValidation' => false,
            ));
            if (isset($_GET['msg']))
                echo $_GET['msg'];
            ?>

            <div class="form-row control-group row-fluid">
                <label class="control-label span3" for="Traine_Flight_Name">Train Name</label>
                <div class="controls span7">
                    <?php
                    $dropDownData = CHtml::listData(TrainMaster::model()->findAll(), 'id', 'train_flight_master');
                    $dropDownData ['Other'] = 'Other';
                    echo $form->dropDownList($model, 'train_flight_master', $dropDownData, array('empty' => 'Select Train Name', 'class' => 'chosen-select'));
                    ?>
                    <?php echo $form->error($model, 'train_flight_master'); ?>
                </div>
            </div>

            <div class="form-row control-group row-fluid" id="otherTrain" style="display: none">
                <label class="control-label span3" for="Traine_Flight_Name">Type Name</label>
                <div class="controls span7">
                    <input type="text" name="TrainMaster[trainOther]" class="row-fluid">
                </div>
            </div>

            <div class="form-row control-group row-fluid">
                <label class="control-label span3" for="Short_Code">Short Code</label>
                <div class="controls span7">
                    <?php echo $form->textField($model, 'short_code', array('size' => 30, 'maxlength' => 30, 'class' => 'row-fluid')); ?>
                    <?php echo $form->error($model, 'short_code'); ?>
                 <!-- <input type="text" id="disabled-input" class="row-fluid" disabled="disabled" value="Default value">-->
                </div>
            </div>
            <div class="form-row control-group row-fluid">
                <label class="control-label span3" for="Phone_no">Train Number</label>
                <div class="controls span7">
                    <?php
                    $dropDownData = CHtml::listData(TrainFlightNumber::model()->findAll("type='Train'"), 'trainFlightNumber', 'trainFlightNumber');
                    $dropDownData ['Other'] = 'Other';
                    echo $form->dropDownList($modelNumber, 'trainFlightNumber', $dropDownData, array('empty' => 'Select Number', 'class' => 'chosen-select'));
                    ?>
                    <?php echo $form->error($modelNumber, 'trainFlightNumber'); ?>
                </div>
            </div>

            <div class="form-row control-group row-fluid" id="otherNumber" style="display: none">
                <label class="control-label span3" for="Traine_Flight_Name">Other Number</label>
                <div class="controls span7">
                    <input type="text" name="TrainFlightNumber[otherNumber]" class="row-fluid">
                </div>
            </div>

            <div class="form-row control-group row-fluid">
                <label class="control-label span3" for="default-select">From</label>
                <div class="controls span7">
                    <?php
                    $dropDownData = CHtml::listData(FromMaster::model()->findAll("type='Train'"), 'name', 'name');
                    $dropDownData ['Other'] = 'Other';
                    echo $form->dropDownList($modelNumber, 'from', $dropDownData, array('empty' => 'Select From', 'class' => 'chosen-select'));
                    ?>
                </div>
            </div>

            <div class="form-row control-group row-fluid" id="otherFrom" style="display: none">
                <label class="control-label span3" for="Traine_Flight_Name">Type From</label>
                <div class="controls span7">
                    <input type="text" name="TrainFlightNumber[fromOther]" class="row-fluid">
                </div>
            </div>

            <div class="form-row control-group row-fluid">
                <label class="control-label span3">To</label>
                <div class="controls span7">
                    <?php
                    $dropDownData = CHtml::listData(ToMaster::model()->findAll("type='Train'"), 'name', 'name');
                    $dropDownData ['Other'] = 'Other';
                    echo $form->dropDownList($modelNumber, 'to', $dropDownData, array('empty' => 'Select To', 'class' => 'chosen-select'));
                    ?>
                </div>
            </div>

            <div class="form-row control-group row-fluid" id="otherTo" style="display: none">
                <label class="control-label span3" for="Traine_Flight_Name">Type To</label>
                <div class="controls span7">
                    <input type="text" name="TrainFlightNumber[toOther]" class="row-fluid">
                </div>
            </div>

            <div class="form-row control-group row-fluid">
                <label class="control-label span3" for="Arrival_time">Arrival Time</label>
                <div class="controls span7">
                    HH <select name="TrainFlightNumber[ahh]" style="width: 65px;">
                        <?php
                        for ($i = 0; $i <= 23; $i++) {
                            ?>
                            <option><?php echo str_pad($i, 2, '0', STR_PAD_LEFT); ?></option>
                            <?php
                        }
                        ?>
                    </select>

                    MM <select name="TrainFlightNumber[amm]" style="width: 65px;">
                        <?php
                        for ($i = 0; $i <= 60; $i++) {
                            ?>
                            <option><?php echo str_pad($i, 2, '0', STR_PAD_LEFT); ?></option>
                            <?php
                        }
                        ?>
                    </select>

                </div>
            </div>
            <div class="form-row control-group row-fluid">
                <label class="control-label span3" for="Dept_Time">Departure Time</label>
                <div class="controls span7">
                    HH <select name="TrainFlightNumber[dhh]" style="width: 65px;">
                        <?php
                        for ($i = 0; $i <= 23; $i++) {
                            ?>
                            <option><?php echo str_pad($i, 2, '0', STR_PAD_LEFT); ?></option>
                            <?php
                        }
                        ?>
                    </select>

                    MM <select name="TrainFlightNumber[dmm]" style="width: 65px;">
                        <?php
                        for ($i = 0; $i <= 60; $i++) {
                            ?>
                            <option><?php echo str_pad($i, 2, '0', STR_PAD_LEFT); ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
            </div>


            <div class="form-row control-group row-fluid">
                <label class="control-label span3" for="inputEmail">Choose Branch <span class="help-block"></span></label>
                <div class="controls span7">
                    <?php echo $form->dropDownList($modelNumber, 'choose_branch', CHtml::listData(BranchMaster::model()->findAll(), 'id', 'branch_name'), array('multiple' => 'multiple', 'class' => 'chosen-select')); ?>
                </div>
            </div>
            <div class="form-actions row-fluid">
                <div class="span7 offset3">
                   <?php echo CHtml::submitButton($model->isNewRecord ? 'Submit' : 'Save Changes', array('class' => 'btn btn-primary')); ?>
                    <button type="reset" class="btn btn-secondary">Cancel</button>
                </div>
            </div>
            <?php $this->endWidget(); ?>
        </div>   
    </div>
    
    <?php //echo $this->renderPartial("//flightMaster/_form",array('model_flight'=>$model_flight,'modelFrom'=>$modelFrom,'modelTo'=>$modelTo,'modelNumber'=>$modelNumber));?>



<script>
//Train other option show or hide    
    $("#TrainMaster_train_flight_master").change(function() {
        var val = $(this).val();
        if (val == 'Other') {
            $("#otherTrain").css('display', 'block');
        } else {
            $("#otherTrain").css('display', 'none');
        }
    });

//Train Number Other option show or hide
    $("#TrainFlightNumber_trainFlightNumber").change(function() {
        var val = $(this).val();
        if (val == 'Other') {
            $("#otherNumber").css('display', 'block');
        } else {
            $("#otherNumber").css('display', 'none');
        }
    });

//From other option show or hide    
    $("#TrainFlightNumber_from").change(function() {
        var val = $(this).val();
        if (val == 'Other') {
            $("#otherFrom").css('display', 'block');
        } else {
            $("#otherFrom").css('display', 'none');
        }
    });

//From other option show or hide    
    $("#TrainFlightNumber_to").change(function() {
        var val = $(this).val();
        if (val == 'Other') {
            $("#otherTo").css('display', 'block');
        } else {
            $("#otherTo").css('display', 'none');
        }
    });
</script>
