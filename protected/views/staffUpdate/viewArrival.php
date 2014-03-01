<div class="box gradient">
    <div class="title">
        <h4> Staff Update For Arrival From <?php echo date("Y-m-d", strtotime($date)); ?><span class="botton_mergin3"></span></h4>
    </div>
    <div class="content top ">

        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'enableAjaxValidation' => true,
            'action' => $this->createUrl('//stuffUpdate/update/'),
            'htmlOptions' => array('style' => 'overflow:scroll'),
        ));

        $this->widget('zii.widgets.grid.CGridView', array
            (
            'dataProvider' => $dataProvider,
            'summaryText' => '',
            'emptyText' => 'There is no Arrival Information in your database',
            'columns' => array
                (
                'pnr_no',
                array(
                    'name' => 'pnr_no',
                    'header' => 'Agency Name',
                    'value' => 'AgencyMaster::model()->findByPk(Entries::model()->find("pnr_no=$data->pnr_no")->agency)->agency_name',
                ),
                array(
                    'name' => 'pnr_no',
                    'header' => 'Client Name',
                    'value' => 'Entries::model()->find("pnr_no=$data->pnr_no")->client_name',
                ),
                array(
                    'name' => 'pnr_no',
                    'header' => 'Hotel',
                    'value' => 'HotelMaster::model()->findByPk(Entries::model()->find("pnr_no=$data->pnr_no")->choose_hotel)->hotel_name',
                ),
                
                array(
                    'name' => 'hotel_room_no',
                    'header' => 'Room No.',
                    //'value' => 'CHtml::textField("Arrival[hotel_room_no][]",$data->hotel_room_no,array("style"=>"width:50px;"))',
                ),
                array(
                    'name' => 'pnr_no',
                    'header' => 'Departure Time',
                    'value' => 'FromDeparture::model()->getDepartureDate($data->pnr_no)',
                ),
                array(
                    'name' => 'arrival_time',
                    'header' => 'Arrival Time',
                    //'value' => 'FromDeparture::model()->getDepartureDate($data->pnr_no)',
                ),
                
                array(
                    'name' => 'stuff',
                    'type' => 'raw',
                    'header' => 'Staff Duty',
                    //'value' => 'StaffMaster::model()->findByPk($data->stuff)->staff_name',
                    'value' => 'CHtml::dropDownList("Arrival[stuff][]",$data->stuff, CHtml::listData(StaffMaster::model()->findAll(), "id", "staff_name"),array("empty"=>"Select Stuff"))                        
'
                ),
                
                array(
                    'name' => 'pnr_no',
                    'header' => 'Voucher Collected By',
                    'value' => 'FromDeparture::model()->find("pnr_no=$data->pnr_no")->voucherCollectedBy',
                ),
                array(
                    'name' => 'totalBag',
                    'header' => 'Bags',
                    //'type' => 'raw',
                    'header' => 'Bags',
                    //'value' => 'CHtml::textField("Arrival[totalBag][]",$data->totalBag,array("style"=>"width:100px;"))',
                    
                ),
                array(
                    'name' => 'porterage',
                    //'type' => 'raw',
                    'header' => 'Porterage',
                    //'value' => 'CHtml::textField("Arrival[porterage][]",$data->porterage,array("style"=>"width:100px;"))',
                    
                ),
                
                array(
                    'name' => 'remarks',
                    //'type' => 'raw',
                    'header' => 'Remarks',
                    //'value' => 'CHtml::textField("Arrival[remarks][]",$data->remarks,array("style"=>"width:100px;"))',
                    
                ),
                
                array(
                    'name' => 'driver_name',
                    'header' => 'Driver Name',
                    'value' => 'Arrival::model()->getDriverName($data->pnr_no,$data->outsite_drivername)',
                ),
                array(
                    'name' => 'mobile_no',
                    'header' => 'Mobile No.',
                    'value' => 'Arrival::model()->getDriverMobileNo($data->pnr_no,$data->outside_mobile_no)',
                ),
                
                
                array(
                    'name' => 'pnr_no',
                    'type' => 'raw',
                    'header' => '',
                    'value' => 'CHtml::textField("Arrival[id][]",$data->id,array("style"=>"width:50px;"))',
                    'htmlOptions' => array("style" => "display:none"),
                ),
            ),
            'itemsCssClass' => 'responsive table table-striped table-bordered',
                //'htmlOptions'=>array('class'=>'responsive table table-striped table-bordered'),
        ));

        echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save');

        $this->endWidget();
        ?>
    </div>
</div>
