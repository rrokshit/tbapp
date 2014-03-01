<div class="box gradient">
    <div class="title">
        <h4>Guide Update For Sightseen From <?php echo date("Y-m-d", strtotime($date)); ?><span class="botton_mergin3"></span></h4>
    </div>
    <div class="content top ">

        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'enableAjaxValidation' => true,
            'action' => $this->createUrl('//guideUpdate/update/'),
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
                    'header' => 'Client name',
                    'value' => 'Entries::model()->find("pnr_no=$data->pnr_no")->client_name',
                ),
                
                 array(
                    'name' => 'language',
                    'header' => 'Language',
                    'type' => 'raw',
                    'value'=>'Sightseen::model()->getLanguageDropDown($data->id)'
                    //'value' => 'CHtml::dropDownList("Sightseen[language][]",$data->language, CHtml::listData(LanguageMaster::model()->findAll(), "id", "name"), array("empty"=>"Select Language","id"=>"GuideUpdateLanguage_$data->id"))'
                ),
                
                array(
                    'name' => 'pnr_no',
                    'header' => 'Hotel',
                    'value' => 'HotelMaster::model()->findByPk(Entries::model()->find("pnr_no=$data->pnr_no")->choose_hotel)->hotel_name',
                ),
                
                array(
                    'name' => 'guide_name',
                    'header' => 'Guide Name',
                    'type' => 'raw',
                    'value'=>'Sightseen::model()->getGuideDropDown($data->id)'
                    //'value' => 'CHtml::dropDownList("Sightseen[guide_name][]",$data->guide_name, CHtml::listData(GuideMaster::model()->findAll(), "id", "guide_name"),array("empty"=>"Select Guide","class"=>"GuideUpdateName","for"=>$data->id))'
                ),
                
                array(
                    'name' => 'entrance',
                    'header' => 'Entrance By',
                    'type' => 'raw',
                    'value' => 'CHtml::dropDownList("ServiceUpdate[entranceBy][]",ServiceUpdate::model()->find("sightSeenId=$data->id")->entranceBy, array("TB"=>"TB","DIR"=>"DIR","Escort"=>"Escort","Not Clear"=>"Not Clear","Indian TB"=>"Indian TB"), array("empty"=>"Select Entrance","style"=>"width:150px"))',
                    //'value'=>'ServiceUpdate::model()->find("sightSeenId=$data->id")->entranceBy'
                ),
                
                array(
                  'name'=>'pnr_no',
                    'header'=>'Work Type',
                    'type'=>'raw',
                    'value'=>'Sightseen::model()->getWorkType($data->id)',
                ),
                
                 array(
                    'name' => 'service_name',
                    'header' => 'Service',
                    'value' => 'Sightseen::model()->showService($data->id)'
                ),
             
               
               
                array(
                    'name' => 'bookBy',
                    'header' => 'Book By',
                    'type' => 'raw',
                    'value' => 'CHtml::dropDownList("Sightseen[bookBy][]",$data->bookBy, CHtml::listData(StaffMaster::model()->findAll(), "id", "staff_name"), array("empty"=>"Select Staff","style"=>"width:150px"))',
                ),
                array(
                    'name' => 'recBy',
                    'header' => 'Rec By',
                    'type' => 'raw',
                    'value' => 'CHtml::dropDownList("Sightseen[recBy][]",$data->recBy, CHtml::listData(StaffMaster::model()->findAll(), "id", "staff_name"), array("empty"=>"Select Staff","style"=>"width:150px"))',
                ),
                array(
                    'name' => 'driver_name',
                    'header' => 'Driver Name',
                    'value' => 'Sightseen::model()->getDriverName($data->id,$data->pnr_no)',
                ),
                array(
                    'name' => 'mobile_no',
                    'header' => 'Mobile No.',
                    'value' => 'Sightseen::model()->getDriverMobile($data->id,$data->pnr_no)',
                ),
                array(
                    'name' => 'pnr_no',
                    'header' => 'PAX',
                    'value' => 'Arrival::model()->find("pnr_no=$data->pnr_no")->pax'
                    //'value' => 'Sightseen::model()->totalPax($data->pnr_no)'
                ),
                
                array(
                  'name'=>'reporting_place',
                    'header'=>'Rpt. Plc',
                    'type' => 'raw',
                    'value' => 'CHtml::textField("Sightseen[reporting_place][]",$data->reporting_place,array("style"=>"width:70px;"))',
                ),
                array(
                    'name' => 'pnr_no',
                    'header' => 'Reporting Time',
                    'type' => 'raw',
                    'value' => 'CHtml::textField("ServiceUpdate[serviceTime][]",ServiceUpdate::model()->find("sightSeenId=$data->id")->serviceTime,array("style"=>"width:70px;"))',
                    //'value'=>'ServiceUpdate::model()->find("sightSeenId=$data->id")->serviceTime'
                ),
                
                array(
                    'name' => 'choose_shop',
                    'header' => 'Approved Shop',
                    //'value' => 'Sightseen::model()->showShop($data->choose_shop)',
                    'type' => 'raw',
                    'value' => 'GuideUpdateController::getShopDropDown($data->id,$data->pnr_no,$data->choose_shop)',
                ),
                
                array(
                    'name' => 'remark',
                    'header' => 'Remarks',
                    'type' => 'raw',
                    'value' => 'CHtml::textField("Sightseen[remark][]",$data->remark,array("style"=>"width:150px;"))',
                ),
                array(
                    'name' => 'pnr_no',
                    'type' => 'raw',
                    'header' => '',
                    'value' => 'CHtml::textField("Sightseen[id][]",$data->id,array("style"=>"width:50px;"))',
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

<script>
    $(".GuideUpdateName").change(function() {
        var ids = $(this).attr('for');
        $.post('<?php echo $this->createUrl('//entries/getGuideLanguage'); ?>', {val: $(this).val()}, function(data) {
            $("#GuideUpdateLanguage_"+ids).html(data);
        });
    });
</script>