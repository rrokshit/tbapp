<div class="box gradient">
    <div class="title">
        <h4><i class="icon-tasks"></i> <span>Hotel Room Update For  Arrival From <?php echo date("Y-m-d", strtotime($sdate)); ?> To <?php echo date("Y-m-d", strtotime($edate)); ?><span class="botton_mergin3"></span></h4>
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
                    'header' => 'Client Name',
                    'value' => 'Entries::model()->find("pnr_no=$data->pnr_no")->client_name',
                ),
                array(
                    'name' => 'pnr_no',
                    'header' => 'Hotel',
                    'value' => 'HotelMaster::model()->findByPk(Entries::model()->find("pnr_no=$data->pnr_no")->choose_hotel)->hotel_name',
                ),
                
                array(
                    'name' => 'status',
                    'header' => 'Status',
                    //'type' => 'raw',
                    //'value' => 'CHtml::textField("Arrival[status][]",$data->status,array("style"=>"width:50px;"))',
                ),
                array(
                    'name' => 'confBy',
                    'header' => 'Conf. By',
                    //'type' => 'raw',
                    //'value' => 'CHtml::textField("Arrival[confBy][]",$data->confBy,array("style"=>"width:50px;"))',
                    
                ),
                array(
                    'name' => 'hotel_room_no',
                    'header' => 'Room No.',
                    'type' => 'raw',
                    'value' => 'CHtml::textField("Arrival[hotel_room_no][]",$data->hotel_room_no,array("style"=>"width:50px;"))',
                ),
                array(
                    'name' => 'pnr_no',
                    'header' => 'Chk. In Time',
                    'type' => 'raw',
                    'value'=>'Arrival::model()->getArrivalTimeField($data->arrival_time)',
                    'htmlOptions' => array("style"=>"width:200px"),
                ),
                array(
                    'name' => 'pnr_no',
                    'header' => 'Arr. Date',
                    'value' => 'date("Y-m-d",strtotime(Arrival::model()->find("pnr_no=$data->pnr_no")->arrival_date))',
                ),
                array(
                    'name'=>'arrived',
                    'header' => 'Arrived',
                    'type' => 'raw',
                    'value' => 'CHtml::dropDownList("Arrival[arrived][]",$data->arrived,array("No"=>"No","Yes"=>"Yes"),array("style"=>"width:50px;"))',
                    'htmlOptions' => array("style"=>"width:200px"),
                ),
                array(
                    'name' => 'totalBag',
                    'header' => 'Total Bag',
                    'type' => 'raw',
                    'value' => 'CHtml::textField("Arrival[totalBag][]",$data->totalBag,array("style"=>"width:50px;"))',
                ),
                array(
                    'name' => 'porterage',
                    'header' => 'Porterage',
                    'type' => 'raw',
                    'value' => 'CHtml::textField("Arrival[porterage][]",$data->porterage,array("style"=>"width:50px;"))',
                ),
                array(
                    'name' => 'remarks',
                    'header' => 'Remark',
                    'type' => 'raw',
                    'value' => 'CHtml::textField("Arrival[remarks][]",$data->remarks,array("style"=>"width:250px;"))',
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
                    'value' => 'Arrival::model()->getDriverName($data->pnr_no,$data->outsite_drivername)',
                ),
                array(
                    'name' => 'mobile_no',
                    'header' => 'Mobile No.',
                    'value' => 'Arrival::model()->getDriverMobileNo($data->pnr_no,$data->outside_mobile_no)',
                ),
                array(
                    'name'=>'pax',
                    'header'=>'PAX',
                ),
                array(
                    'name' => 'pnr_no',
                    'header' => 'Single',
                    'value' => 'Entries::model()->find("pnr_no=$data->pnr_no")->single',
                ),
                array(
                    'name' => 'pnr_no',
                    'header' => 'Double',
                    'value' => 'Entries::model()->find("pnr_no=$data->pnr_no")->double',
                ),
                array(
                    'name' => 'pnr_no',
                    'header' => 'Triple',
                    'value' => 'Entries::model()->find("pnr_no=$data->pnr_no")->triple',
                ),
                
                
                /*array(
                    'name' => 'pnr_no',
                    'header' => 'Arrival Date',
                    'type' => 'raw',
                    'value'=>'Arrival::model()->getArrivalDateField($data->pnr_no,$data->id)',
                    'htmlOptions' => array("style"=>"width:200px"),
                ),*/
                
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
