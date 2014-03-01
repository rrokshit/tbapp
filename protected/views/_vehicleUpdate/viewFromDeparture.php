<div class="box gradient">
    <div class="title">
        <h4>Departure Vehicle Update - Display Data From <?php echo date("Y-m-d", strtotime($sdate)); ?> To <?php echo date("Y-m-d", strtotime($edate)); ?><span class="botton_mergin3"></span></h4>
    </div>
    <div class="content top ">
<script>
    $(document).ajaxStop(function() {
<?php
$this->widget('application.extensions.fancybox.EFancyBox', array(
    'target' => 'a[rel=gallery]',
    'config' => array('width' => '200', 'height' => '200'),
        )
);
?>
    });
</script>
<?php
$this->widget('application.extensions.fancybox.EFancyBox', array(
    'target' => 'a[rel=gallery]',
    'config' => array('width' => '200', 'height' => '200'),
        )
);
?>


<?php
$this->widget('zii.widgets.grid.CGridView', array
    (
    'dataProvider' => $departureDataProvider,
    'summaryText' => '',
    'emptyText' => 'There is no Branch Information in your database',
    'columns' => array
        (
        'pnr_no',
        array(
          'name'=>'pnr_no',
            'header'=>'Agency Name',
            'value'=> 'AgencyMaster::model()->findByPk(Entries::model()->find("pnr_no=$data->pnr_no")->agency)->agency_name',
        ),
        
        array(
          'name'=>'pnr_no',
            'header'=>'Client Name',
            'value'=> 'Entries::model()->find("pnr_no=$data->pnr_no")->client_name',
        ),
        
        array(
          'name'=>'pnr_no',
            'header'=>'Hotel',
            'value'=> 'HotelMaster::model()->findByPk(Entries::model()->find("pnr_no=$data->pnr_no")->choose_hotel)->hotel_name',
        ),
        
        array(
          'name'=>'pnr_no',
            'header'=>'Status',
            'value'=> 'Arrival::model()->find("pnr_no=$data->pnr_no")->status',
        ),
        
        array(
          'name'=>'pnr_no',
            'header'=>'Conf. By',
            'value'=> '',
        ),
        
        array(
          'name'=>'pnr_no',
            'header'=>'Room No.',
            'value'=> 'Arrival::model()->find("pnr_no=$data->pnr_no")->hotel_room_no',
        ),
        
        array(
          'name'=>'pnr_no',
            'header'=>'Assistance By',
            'value'=> '',
        ),
        
        array(
          'name'=>'pnr_no',
            'header'=>'Staff Duty',
            'value'=> 'StaffMaster::model()->findByPk(Arrival::model()->find("pnr_no=$data->pnr_no")->stuff)->staff_name',
        ),
        
        array(
          'name'=>'pnr_no',
            'header'=>'Remark',
            'value'=> 'Arrival::model()->find("pnr_no=$data->pnr_no")->remarks',
        ),
        
        array(
          'name'=>'pnr_no',
            'header'=>'Service Name',
            'value'=> '',
        ),
        
        array
            (// display a column with "view", "update" and "delete" buttons

            'class' => 'CButtonColumn',
            'template' => '{av}',
            'buttons' => array(
                'av' => array(
                    'label' => 'Add Vehicle',
                    //'imageUrl' => Yii::app()->request->baseUrl . '/images/edit.png',
                    'url' => 'Yii::app()->createUrl("//vehicleUpdate/update", array("id"=>$data->id,"type"=>"fromDeparture"))',
                    'options' => array(
                        'class' => 'iframe show',
                        'style' => 'margin-right:6px;',
                        'rel' => 'gallery',
                    ),
                ),
            ),
            'header' => 'Action',
        ),
    ),
    'itemsCssClass' => 'responsive table table-striped table-bordered',
        //'htmlOptions'=>array('class'=>'responsive table table-striped table-bordered'),
));
?>
    </div>
</div>
