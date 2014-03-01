<div class="<?php echo $this->message_type; ?>"><?php echo $this->message_content; ?></div>
<div class="box gradient">
    <div class="title">
        <h3> 
            <i class="icon-book"></i>
            <span>Entries
                <span class="botton_mergin3"></span>
                <span class="botton_margin1">
                    <a href="<?php echo Yii::app()->createUrl("entries/admin"); ?>" class="btn btn-success">Entries</a>
                </span>
            </span>
        </h3>
    </div>

    <div class="content top">
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'entries-form',
            'enableAjaxValidation' => false,
            'htmlOptions' => array('autocomplete' => 'off',)
        ));
        ?>
        <div class="form-row control-group row-fluid">
            <label class="control-label span3" for="pnr_no">PNR NO</label>
            <div class="controls span7">
                <?php
                echo $form->textField($model, 'pnr_no', array('size' => 20, 'readonly' => 'readonly',
                    'maxlength' => 20, 'class' => 'row-fluid', 'value' => Entries::model()->pnr_no()));
                ?>
            </div>
        </div>
        <div class="form-row control-group row-fluid">
            <label class="control-label span3">Arrival Date</label>
            <div class="controls span7">
                <div class="input-append date row-fluid">
                    <?php
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
                            'value' => $model->arrival_date,
                            'class' => 'row-fluid',
                        ),
                    ));
                    ?>
                    <span class="add-on"><i class="icon-th"></i></span> 
                </div>
            </div>
        </div>
        <?php
        if (Yii::app()->user->userType == 1) {
            ?>
            <div class="form-row control-group row-fluid">
                <label class="control-label span3" for="inputEmail">Select Branch <span class="help-block"></span></label>
                <div class="controls span7">

                    <?php
                    $branch_id = 0;
                    if (StaffMaster::model()->findByPK($model->staff_id_fk))
                        $branch_id = StaffMaster::model()->findByPK($model->staff_id_fk)->branch_id_fk;

                    echo CHtml::activeDropDownList($model, 'branch_id_fk', CHtml::listData(BranchMaster::model()->findAll(), 'id', 'branch_name'), array(
                        'ajax' => array(
                            'type' => 'POST',
                            'url' => CController::createUrl('Entries/BranchStaff'),
                            'update' => '#slStaff',
                            'data' => array('branch_id' => 'js:$(this).val()')
                        ),
                        'empty' => 'Select Branch',
                        'id' => 'slBranches',
                        'name' => 'Entries[branch_id_fk]',
                        'options' => array(
                            $branch_id => array('selected' => true)
                        )
                            )
                    );
                    ?>
                </div>
            </div>

            <div class="form-row control-group row-fluid">
                <label class="control-label span3" for="Name_Of_Staff">Entry By</label>
                <div class="controls span7">
                    <?php
                    if ($this->getAction()->getId() == 'create') {
                        echo CHtml::dropDownList('Entries[staff_id_fk]', '', array(), array(
                            'id' => 'slStaff',
                            'empty' => 'Select Staff',
                        ));
                    } else {
                        echo CHtml::dropDownList('Entries[staff_id_fk]', '', CHtml::listData(StaffMaster::model()->findAll(), 'id', 'name'), array(
                            'id' => 'slStaff',
                            'empty' => 'Select Staff',
                            'options' => array(
                                $model->staff_id_fk => array('selected' => true)
                            )
                        ));
                    }
                    ?>

                </div>
            </div>
            <?php
        }
        ?>
        <div class="form-row control-group row-fluid">
            <label class="control-label span3" for="default-select">Agency</label>
            <div class="controls span7">
                <?php
                echo CHtml::activeDropDownList($model, 'agency_id_fk', CHtml::listData(AgencyMaster::model()->findAll(), 'id', 'name'), array(
                    'ajax' => array(
                        'type' => 'POST',
                        'url' => CController::createUrl('Entries/GetCity'),
                        'data' => array('val' => 'js:$(this).val()'),
                        'success' => 'function(data){
																		$("#agencyCity").val(data);
																	}'
                    ),
                    'id' => 'slAgency',
                    'class'=>'other-select',
                    'data-field'=>'agency',
                    'name' => 'Entries[agency_id_fk]',
                    'empty' => 'Select Agency',
                    'options' => array(
                        $this->agency_id = array('selected' => true)
                    )
                        )
                );
                ?>	
            </div>
        </div>
        <div class="form-row control-group row-fluid">
            <label class="control-label span3" for="default-select">City</label>
            <div class="controls span7">
                <input type="text" id="agencyCity" readonly="readonly" class="row-fluid"
                       value = "<?php echo $agency_city; ?>" >	

            </div>
        </div>
        <div class="form-row control-group row-fluid">
            <label class="control-label span3" for="Phone_no">Client Name</label>
            <div class="controls span7">
<?php echo $form->textField($model, 'client_name', array('class' => 'row-fluid')); ?>
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
<?php echo $form->dropDownList($model, 'foreigner_adult', $lv, array()); ?>  
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
<?php echo $form->dropDownList($model, 'foreigner_child', $lv, array()); ?>  

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

<?php echo $form->dropDownList($model, 'indian_adult', $lv, array()); ?>   
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
<?php echo $form->dropDownList($model, 'indian_child', $lv, array()); ?>  

            </div>
        </div>
        <div class="form-row control-group row-fluid">
            <label class="control-label span3">Total No. PAX</label>
            <div class="controls span7"><input type="text" readonly="readonly" id="totalNoPax" value="<?php echo $model->foreigner_adult + $model->foreigner_child + $model->indian_adult + $model->indian_child; ?>"/></div>
        </div>
        <div class="form-row control-group row-fluid">
            <label class="control-label span3">Hotel Required</label>
            <div class="controls span7">
                <?php echo $form->dropDownList($model, 'hotel_required', array('Yes' => 'Yes', 'No' => 'No'), array('empty' => 'Select Yes/No'));
                ?>
            </div>
        </div>
        <?php
        $hodel_required = $model->hotel_required;
        $hotelInfoDisplay = "display:none";
        if ($hodel_required == "Yes") {
            $hotelInfoDisplay = "display:block";
        }
        ?>
        <div id ="hide" style="<?php echo $hotelInfoDisplay; ?>">  
            <div class="form-row control-group row-fluid">
                <label class="control-label span3">Choose Hotel</label>
                <div class="controls span7">
                    <?php
                    echo CHtml::activeDropDownList($model, 'hotel_id_fk', CHtml::listData(HotelMaster::model()->findAll(), 'id', 'name'), array(
                        'ajax' => array(
                            'type' => 'POST',
                            'url' => CController::createUrl('Entries/GetRoomCategory'),
                            'update' => '#slHotelRoomCategory',
                            'data' => array('val' => 'js:$(this).val()')
                        ),
                        'id' => 'slHotels',
                        'name' => 'Entries[hotel_id_fk]',
                        'empty' => 'Select Hotel',
                        'class' => 'other-select',
                        'data-field' => 'hotel'
                            )
                    );
                    ?>							
                </div>
            </div>

            <div class="form-row control-group row-fluid">
                <label class="control-label span3">Total Room</label>
                <div class="controls span7">
                    <?php
                    $lv = array();
                    for ($i = 1; $i <= 20; $i++)
                        $lv[$i] = $i;

                    echo $form->dropDownList($model, 'totel_room', $lv, array('empty' => 'Select Any',));
                    ?>  

                </div>
            </div>
            <div class="form-row control-group row-fluid">
                <label class="control-label span3" for="branch-name">Room Category</label>
                <div class="controls span7">
                    <?php
                    if ($model->hotel_required == "Yes" && $model->room_category != "") {
                        echo $form->dropDownList($model, 'room_category', CHtml::listData(HotelTariff::model()->findAll("hotel_id_fk=" . $model->hotel_id_fk), 'room_category', 'room_category'), array(
                            'maxlength' => 255,
                            'id' => 'slHotelRoomCategory',
                            'options' => array(
                                $model->room_category => array("selected" => true)
                            )
                        ));
                    } else {
                        echo $form->dropDownList($model, 'room_category', array(), array(
                            'maxlength' => 255,
                            'id' => 'slHotelRoomCategory',
                        ));
                    }
                    ?>
                </div>
            </div>
            <div class="form-row control-group row-fluid">
                <label class="control-label span3" for="Short_Code">Single</label>
                <div class="controls span7">
<?php echo $form->textField($model, 'single', array('maxlength' => 3, 'value' => $model->single)); ?>
                </div>
            </div>
            <div class="form-row control-group row-fluid">
                <label class="control-label span3" for="Short_Code">Double</label>
                <div class="controls span7">
<?php echo $form->textField($model, 'double', array('maxlength' => 3, 'value' => $model->double)); ?>
                </div>
            </div>
            <div class="form-row control-group row-fluid">
                <label class="control-label span3" for="Short_Code">Triple</label>
                <div class="controls span7">
<?php echo $form->textField($model, 'triple', array('maxlength' => 3, 'value' => $model->triple)); ?>
                </div>
            </div>
        </div>
        <div class="form-row control-group row-fluid">
            <label class="control-label span3" for="Phone_no">Same Day</label>
            <div class="controls span7">
<?php echo $form->textField($model, 'same_day', array('class' => 'row-fluid', 'readonly' => 'readonly', 'value' => 'No')); ?>
            </div>
        </div>
        <div class="form-row control-group row-fluid">
            <label class="control-label span3">Asst. On Arrival</label>
            <div class="controls span7">
<?php echo $form->dropDownList($model, 'assistance_on_arrival', array('Yes' => 'Yes', 'No' => 'No'), array()); ?>

            </div>
        </div>
        <div class="form-row control-group row-fluid">
            <label class="control-label span3">Asst. On Departure</label>
            <div class="controls span7">
<?php echo $form->dropDownList($model, 'asstDep', array('Yes' => 'Yes', 'No' => 'No'), array()); ?>
            </div>
        </div>        
        <div class="form-row control-group row-fluid">
            <label class="control-label span3">Hotel Provider (TB)</label>
            <div class="controls span7">
<?php echo $form->dropDownList($model, 'htlProvider', array('Yes' => 'Yes', 'No' => 'No'), array('empty' => 'Select Yes/No',)); ?>

            </div>
        </div>

        <div class="form-row control-group row-fluid">
            <label class="control-label span3">Bill Required</label>
            <div class="controls span7">
<?php echo $form->dropDownList($model, 'billReq', array('Yes' => 'Yes', 'No' => 'No'), array()); ?>

            </div>
        </div>

        <div class="form-row control-group row-fluid">
            <label class="control-label span3" for="Phone_no">Tour Reference No</label>
            <div class="controls span7">
<?php echo $form->textField($model, 'tour_reference_no', array('size' => 10, 'maxlength' => 10, 'class' => 'row-fluid')); ?>
            </div>
        </div>
        <div class="form-row control-group row-fluid">
            <label class="control-label span3" for="Phone_no">Exc Oder No</label>
            <div class="controls span7">
<?php echo $form->textField($model, 'order_no', array('class' => 'row-fluid')); ?>
            </div>
        </div>
        <div class="form-row control-group row-fluid">
            <label class="control-label span3">Exc Oder Date</label>
            <div class="controls span7">
                <div class="input-append date row-fluid">
                    <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model' => $model,
                        'attribute' => 'order_date',
                        'options' => array(
                            'dateFormat' => 'yy-mm-dd',
                            'altFormat' => 'yy-mm-dd',
                            'showButtonPanel' => true,
                            'changeMonth' => true,
                            'changeYear' => true,
                            'yearRange' => '1900:2099'
                        ),
                        'htmlOptions' => array(
                            'value' => $model->order_date,
                            'class' => 'row-fluid',
                        ),
                    ));
                    ?>
                    <span class="add-on"><i class="icon-th"></i></span> 
                </div>
            </div>
        </div>
        
        <div class="form-row control-group row-fluid">
            <label class="control-label span3" for="Phone_no">Handling Agent Mail</label>
            <div class="controls span7">
            <?php echo $form->textField($model, 'handling_agent_email', array('class' => 'row-fluid',)); ?>
            </div>
        </div>
        
        <div class="form-row control-group row-fluid">
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
<script>
    function totalPax() {
        var noa = $("#Entries_indian_adult").val();
        var noc = $("#Entries_indian_child").val();
        var nof = $("#Entries_foreigner_child").val();
        var noi = $("#Entries_foreigner_adult").val();

        var total = parseInt(noa) + parseInt(noc) + parseInt(nof) + parseInt(noi);
        $("#totalNoPax").val(total);
    }

    $("#Entries_indian_adult, #Entries_indian_child, #Entries_foreigner_child, #Entries_foreigner_adult").change(function() {
        totalPax();
    });

    $("#Entries_agency").change(function() {

        $.post('<?php echo $this->createUrl('//entries/getCity'); ?>', {val: $(this).val()}, function(data) {
            if (data != '')
                data = data;
            else
                data = 'Not Set';
            $("#agencyCity").val(data);
        });
    });

    //TB vehicle yes or not
    $(".tbvy").click(function() {
        $("#outsite_drivername").css("display", "none");
        $("#Entries_driver_mobile_no").css("display", "none");
        $("#outsite_vehicle_no").css("display", "none");
        $("#outsite_vehicle_category").css("display", "none");

        $("#driver_name").css("display", "block");
        $("#Entries_mobile_no").css("display", "block");
        $("#vehicle_no").css("display", "block");
        $("#vehicle_category").css("display", "block");
    });

    $(".tbvn").click(function() {
        $("#driver_name").css("display", "none");
        $("#Entries_mobile_no").css("display", "none");
        $("#vehicle_no").css("display", "none");
        $("#vehicle_category").css("display", "none");

        $("#outsite_drivername").css("display", "block");
        $("#Entries_driver_mobile_no").css("display", "block");
        $("#outsite_vehicle_no").css("display", "block");
        $("#outsite_vehicle_category").css("display", "block");
    });

    $("#Entries_driver_name").change(function() {
        $.post('<?php echo $this->createUrl('//entries/getDriverMobile'); ?>', {val: $(this).val()}, function(data) {
            if (data != '')
                data = data;
            else
                data = 'Not Set';
            $("#Entries_mobile_no").val(data);
        });
    });

    $("#Entries_hotel_required").change(function() {
        if ($(this).val() == 'Yes') {
            $('#hide').css("display", "block");
            $("#Entries_same_day").val("No");
        } else {
            $('#hide').css("display", "none");
            $("#Entries_same_day").val("Yes");
        }
    });



</script>