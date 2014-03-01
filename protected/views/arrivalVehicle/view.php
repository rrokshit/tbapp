
<div class="box gradient">
    <div class="title">
        <h4>Vehicle Update - Display Data From <?php echo date("Y-m-d", strtotime($sdate)); ?> To <?php echo date("Y-m-d", strtotime($edate)); ?><span class="botton_mergin3"></span></h4>
    </div>
    <div class="content top ">



        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'enableAjaxValidation' => true,
            'action' => $this->createUrl('update'),
            'htmlOptions' => array(
                'style' => 'overflow:scroll',
            )
        ));

        $this->widget('zii.widgets.grid.CGridView', array(
            'dataProvider' => $dataProvider,
            'enablePagination' => false,
            'emptyText' => 'There is no Branch Information in your database',
            'columns' => array(
                'type',
                'pnr_no',
                array(
                    'name' => 'pnr_no',
                    'header' => 'Agency Name',
                    'value' => 'AgencyMaster::model()->findByPk(Entries::model()->find("pnr_no=$data->pnr_no")->agency)->agency_name',
                ),
                array(
                    'name' => 'pnr_no',
                    'header' => 'Hotel',
                    'value' => 'HotelMaster::model()->findByPk(Entries::model()->find("pnr_no=$data->pnr_no")->choose_hotel)->hotel_name',
                ),
                array(
                    'name' => 'pnr_no',
                    'header' => 'Service',
                    'value' => 'ArrivalVehicle::model()->showServices($data->pnr_no,$data->type)',
                ),
                array(
                    'name' => 'pnr_no',
                    'header' => 'Client',
                    'value' => 'Entries::model()->find("pnr_no=$data->pnr_no")->client_name',
                ),
                array(
                    'name' => 'particularTime',
                    'header' => 'Time',
                    'value' => 'ArrivalVehicle::model()->showServicesTime($data->pnr_no,$data->type,$data->particularTime)',
                // 'value' => 'For Departure',
                ),
                array(
                    'name' => 'vehicleCategory',
                    'value' => 'VehicleCategory::model()->findByPk($data->vehicleCategory)->name',
                ),
                'acOrNot',
                'noOfVehicle',
                array(
                    'name' => 'vehicleNumber',
                    'type' => 'raw',
                    //'value'=>'CHtml::dropDownList("ArrivalVehicle[vehicleNumber][]",$data->vehicleNumber, CHtml::listData(VehicleMaster::model()->findAll(), id, registration_number),array("empty"=>"Select Veh. No.","style"=>"width:150px;"))',
                    'value' => 'ArrivalVehicle::model()->getVehicleNumberField($data->vehicleNumber,$data->id,$data->otherVehicleNumber)',
                ),
                array(
                    'name' => 'driverName',
                    'type' => 'raw',
                    //'value' => 'CHtml::dropDownList("ArrivalVehicle[driverName][]",$data->driverName, CHtml::listData(DriverMaster::model()->findAll(), id, driver_name),array("empty"=>"Select Driver","style"=>"width:150px;","class"=>"driverName","for"=>"driverMobile_$data->id"))',
                    'value' => 'ArrivalVehicle::model()->getDriverNameField($data->driverName,$data->id,$data->otherDriverName)',
                ),
                array(
                    'name' => 'driverMobile',
                    'header' => 'Mobile',
                    'type' => 'raw',
                    'value' => 'ArrivalVehicle::model()->getDriverMobileField($data->driverMobile,$data->otherDriverMobileNumber)',
                ),
                array(
                    'name' => 'pnr_no',
                    'header' => 'PAX',
                    'value' => 'Arrival::model()->find("pnr_no=$data->pnr_no")->pax',
                ),
                array(
                    'name' => 'id',
                    'header' => '',
                    'type' => 'raw',
                    'value' => 'CHtml::textField("ArrivalVehicle[id][]",$data->id,array("style"=>"display:none;"))',
                ),
            ),
            'itemsCssClass' => 'responsive table table-striped table-bordered',
        ));
        echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save');

        $this->endWidget();
        ?>


    </div>
</div>

<script>
    $(".driverName").change(function() {
        var value = $(this).val();
        var fors = $(this).attr('for');
        
        if($(this).val()=='Other'){
            $("#dn_"+fors).css("display","block");
            $("#driverMobile_" + fors).val('');
        }else{
            $("#dn_"+fors).css("display","none");
            $.post('<?php echo $this->createUrl('//entries/getDriverMobile'); ?>', {val: $(this).val()}, function(data) {
                $("#driverMobile_" + fors).val(data);
            });
        }
        
        
    });
    
    $(".vn").change(function(){
        var fors = $(this).attr('for');
        if($(this).val()=='Other'){
            $("#vn_"+fors).css("display","block");
        }else{
            $("#vn_"+fors).css("display","none");
        }
    });

</script>


