<div class="box gradient">
    <div class="title">
        <h4><i class="icon-tasks"></i> <span>Hotel Room Update For  Sightseeing From <?php echo date("Y-m-d", strtotime($sdate)); ?> To <?php echo date("Y-m-d", strtotime($edate)); ?><span class="botton_mergin3"></span></h4>
    </div>
    <div class="content top ">

        

        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'enableAjaxValidation' => true,
            'action' => $this->createUrl('//hotelRoomUpdate/update/'),
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
                    'header' => 'Hotel',
                    'value' => 'HotelMaster::model()->findByPk(Entries::model()->find("pnr_no=$data->pnr_no")->choose_hotel)->hotel_name',
                ),
                array(
                    'name' => 'pnr_no',
                    'header' => 'Client name',
                    'value' => 'Entries::model()->find("pnr_no=$data->pnr_no")->client_name',
                ),
                
                array(
                    'name' => 'pnr_no',
                    'header' => 'Status',
                    'value' => 'Arrival::model()->find("pnr_no=$data->pnr_no")->status'
                ),
                array(
                    'name' => 'pnr_no',
                    'header' => 'Conf. By',
                    'value' => 'Arrival::model()->find("pnr_no=$data->pnr_no")->confBy'
                ),
                array(
                    'name' => 'pnr_no',
                    'header' => 'Room No.',
                    'value' => 'Arrival::model()->find("pnr_no=$data->pnr_no")->hotel_room_no'
                ),
                array(
                    'name' => 'pnr_no',
                    'header' => 'Check In Time',
                    'value' => 'date("H:i:s",strtotime(Arrival::model()->find("pnr_no=$data->pnr_no")->arrival_time))',
                ),
                array(
                    'name' => 'pnr_no',
                    'header' => 'Arr. Date',
                    'value' => 'date("Y-m-d",strtotime(Arrival::model()->find("pnr_no=$data->pnr_no")->arrival_date))',
                ),
                array(
                    'name' => 'pnr_no',
                    'header' => 'Asst. Required',
                    'value' => 'Entries::model()->find("pnr_no=$data->pnr_no")->assistance_on_arrival',
                ),
                array(
                    'name' => 'pnr_no',
                    'header' => 'Book By',
                    'value' => 'StaffMaster::model()->findByPk(Sightseen::model()->findByPk($data->sightSeenId)->bookBy)->staff_name',
                ),
                array(
                    'name' => 'pnr_no',
                    'header' => 'Driver Name',
                    'value' => 'Sightseen::model()->getDriverName($data->sightSeenId,$data->pnr_no)',
                ),
                array(
                    'name' => 'pnr_no',
                    'header' => 'Mobile No.',
                    'value' => 'Sightseen::model()->getDriverMobile($data->sightSeenId,$data->pnr_no)',
                ),
                array(
                    'name' => 'pnr_no',
                    'header' => 'Total Bag',
                    'value' => 'Arrival::model()->find("pnr_no=$data->pnr_no")->totalBag',
                ),
                array(
                    'name' => 'entranceBy',
                    'header' => 'Entrance By',
                    'type'=>'raw',
                    'value' => 'CHtml::dropDownList("ServiceUpdate[entranceBy][]",$data->entranceBy,array("TB"=>"TB","DIR"=>"DIR","Escort"=>"Escort","Not Clear"=>"Not Clear","Indian TB"=>"Indian TB"),array("style"=>"width:100px;"))',
                    
                ),
                array(
                    'name' => 'serviceName',
                    'header' => 'Service Name',
                    'type'=>'raw',
                    //'value' => 'CHtml::dropDownList("ServiceUpdate[entranceBy][]",$data->entranceBy,array("TB"=>"TB","DIR"=>"DIR","Escort"=>"Escort","Not Clear"=>"Not Clear","Indian TB"=>"Indian TB"),array("style"=>"width:100px;"))',
                    'value'=>'SightSeen::model()->makeSrvDropDown($data->sightSeenId,$data->serviceName)',
                    
                ),
                
                array(
                    'name' => 'serviceDate',
                    'type' => 'raw',
                    'header' => 'Srv. Date',
                    'value' => 'CHtml::textField("ServiceUpdate[serviceDate][]",date("Y-m-d",strtotime($data->serviceDate)),array("style"=>"width:100px;"))',
                ),
                array(
                    'name' => 'serviceTime',
                    'type' => 'raw',
                    'header' => 'Srv. Time',
                    'value' => 'CHtml::textField("ServiceUpdate[serviceTime][]",$data->serviceTime,array("style"=>"width:100px;"))',
                ),
                array(
                    'name' => 'sightSeenId',
                    'type' => 'raw',
                    'header' => '',
                    'value' => 'CHtml::textField("ServiceUpdate[sightSeenId][]",$data->sightSeenId,array("style"=>"width:50px;"))',
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
