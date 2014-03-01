<div class="box gradient">
    <div class="title">
        <h4><i class="icon-tasks"></i> <span>Hotel Room Update For Departure From <?php echo date("Y-m-d", strtotime($sdate)); ?> To <?php echo date("Y-m-d", strtotime($edate)); ?><span class="botton_mergin3"></span></h4>
    </div>
    <div class="content top ">

        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'enableAjaxValidation' => true,
            'action' => $this->createUrl('//hotelRoomUpdate/update/'),
            'htmlOptions'=>array('style'=>'overflow:scroll'),
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
                    'header' => 'Client name',
                    'value' => 'Entries::model()->find("pnr_no=$data->pnr_no")->client_name',
                ),
                
                array(
                    'name' => 'pnr_no',
                    'header' => 'Hotel',
                    'value' => 'HotelMaster::model()->findByPk(Entries::model()->find("pnr_no=$data->pnr_no")->choose_hotel)->hotel_name',
                ),
                
                array(
                    'name' => 'pnr_no',
                    'header' => 'Status',
                    'value'=>'Arrival::model()->find("pnr_no=$data->pnr_no")->status'
                ),
                array(
                    'name' => 'pnr_no',
                    'header' => 'Conf. By',
                    'value'=>'Arrival::model()->find("pnr_no=$data->pnr_no")->confBy'
                    
                ),
                array(
                    'name' => 'pnr_no',
                    'header' => 'Room No.',
                    'value'=>'Arrival::model()->find("pnr_no=$data->pnr_no")->hotel_room_no'
                    
                ),
                array(
                    'name' => 'pnr_no',
                    'header' => 'Arrival Time',
                    'value' => 'date("H:i:s",strtotime(Arrival::model()->find("pnr_no=$data->pnr_no")->arrival_time))',
                ),
                array(
                    'name' => 'pnr_no',
                    'header' => 'Asst. Required',
                    'value' => 'Entries::model()->find("pnr_no=$data->pnr_no")->assistance_on_arrival',
                ),
                
                array(
                    'name' => 'stuff',
                    'header' => 'Stuff Duty',
                    'value' => 'StaffMaster::model()->findByPk($data->stuff)->staff_name',
                ),
                array(
                    'name' => 'driver_name',
                    'header' => 'Driver Name',
                    'value' => 'FromDeparture::model()->getDriverName($data->pnr_no,$data->outside_driver_name)',
                ),
                array(
                    'name' => 'outside_mobile_no',
                    'header' => 'Mobile No.',
                    'value' => 'FromDeparture::model()->getDriverMobileNo($data->pnr_no,$data->outside_mobile_no)',
                ),
                
                array(
                    'name' => 'pnr_no',
                    'header' => 'Total Bag',
                    'value' => 'Arrival::model()->find("pnr_no=$data->pnr_no")->totalBag',
                ),
                /*array(
                    'name' => 'pnr_no',
                    'header' => 'Arrival Date',
                    'type' => 'raw',
                    'value'=>'Arrival::model()->getArrivalDateField($data->pnr_no,$data->id)',
                    'htmlOptions' => array("style"=>"width:200px"),
                ),*/
                array(
                    'name' => 'dep_time',
                    'header' => 'Check Out Time',
                    'type' => 'raw',
                    'value'=>'FromDeparture::model()->getCheckOutTimeField($data->dep_time)',
                    'htmlOptions' => array("style"=>"width:200px"),
                ),
                array(
                    'name' => 'voucherCollectedBy',
                    'type' => 'raw',
                    'header' => 'Voucher Collected By',
                    'value' => 'CHtml::textField("FromDeparture[voucherCollectedBy][]",$data->voucherCollectedBy,array("style"=>"width:100px;"))',
                ),
                array(
                    'name' => 'pnr_no',
                    'type' => 'raw',
                    'header' => '',
                    'value' => 'CHtml::textField("FromDeparture[id][]",$data->id,array("style"=>"width:50px;"))',
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
