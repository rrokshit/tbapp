<div class="box gradient">
    <div class="title">
        <h4><i class="icon-tasks"></i> <span>Display Departure From <?php echo date("Y-m-d", strtotime($date)); ?><span class="botton_mergin3"></span></h4>
    </div>
    <div class="content top ">

        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'enableAjaxValidation' => true,
            'action' => $this->createUrl('//stuffUpdate/update/'),
            //'htmlOptions' => array('style' => 'overflow:scroll'),
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
                    'name' => 'pnr_no',
                    'header' => 'Room No.',
                    //'value' => 'CHtml::textField("Arrival[hotel_room_no][]",$data->hotel_room_no,array("style"=>"width:50px;"))',
                    'value'=>'Arrival::model()->find("pnr_no=$data->pnr_no")->hotel_room_no',
                ),
                array(
                    'name' => 'pnr_no',
                    'header' => 'Departure Time',
                    'value' => 'FromDeparture::model()->getDepartureDate($data->pnr_no)',
                ),
                
                array(
                    'name' => 'stuff',
                    'type' => 'raw',
                    'header' => 'Stuff Duty',
                    //'value' => 'StaffMaster::model()->findByPk($data->stuff)->staff_name',
                    'value' => 'CHtml::dropDownList("FromDeparture[stuff][]",$data->stuff, CHtml::listData(StaffMaster::model()->findAll(), "id", "staff_name"),array("empty"=>"Select Stuff"))                        
'
                ),
                
                array(
                    'name' => 'pnr_no',
                    'header' => 'Voucher Collected By',
                    'value' => 'FromDeparture::model()->find("pnr_no=$data->pnr_no")->voucherCollectedBy',
                ),
                array(
                    'name' => 'pnr_no',
                    'header' => 'Bags',
                    'value' => 'Arrival::model()->find("pnr_no=$data->pnr_no")->totalBag',
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
