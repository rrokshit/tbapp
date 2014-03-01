<div class="box gradient">
    <div class="title">
        <h4><i class="icon-tasks"></i> <span>Display Arrival From <?php echo date("Y-m-d", strtotime($date)); ?><span class="botton_mergin3"></span></h4>
    </div>
    <div class="content top ">
        <h3>Hotel Update</h3>
        <?php
        $form=$this->beginWidget('CActiveForm', array(
            'enableAjaxValidation'=>true,
            'action'=>$this->createUrl('//hotelUpdate/update/'),
            'htmlOptions'=>array(
                'style'=>'overflow:scroll',
            )
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
                    'name' => 'arrival.pnr_no',
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
                    'type'=>'raw',
                    'header' => 'Single',
                    'value'=>'CHtml::textField("Entries[single][]",Entries::model()->find("pnr_no=$data->pnr_no")->single,array("style"=>"width:50px;"))',
                ),
                array(
                    'name' => 'status',
                    'type'=>'raw',
                    'header' => 'Double',
                    'value'=>'CHtml::textField("Entries[double][]",Entries::model()->find("pnr_no=$data->pnr_no")->double,array("style"=>"width:50px;"))',
                ),
                array(
                    'name' => 'status',
                    'type'=>'raw',
                    'header' => 'Triple',
                    'value'=>'CHtml::textField("Entries[triple][]",Entries::model()->find("pnr_no=$data->pnr_no")->triple,array("style"=>"width:50px;"))',
                ),
                array(
                    'name' => 'status',
                    'type'=>'raw',
                    'header' => 'Status',
                    'value'=>'CHtml::textField("Arrival[status][]",$data->status,array("style"=>"width:50px;"))',
                ),
                array(
                    'name' => 'pnr_no',
                    'header' => 'Conf. By',
                    'type'=>'raw',
                    'value'=>'CHtml::textField("Arrival[confBy][]",$data->confBy,array("style"=>"width:50px;"))',
                ),
               
                array(
                    'name' => 'pax',
                    'header' => 'PAX',
                    'type'=>'raw',
                    'value'=>'CHtml::textField("Arrival[pax][]",Entries::model()->calPax($data->pnr_no,$data->pax),array("style"=>"width:50px;"))',
                ),
                array(
                    'name' => 'pnr_no',
                    'header' => 'Departure Date',
                    'value' => 'Arrival::model()->getDepartureDate($data->pnr_no)',
                ),
                array(
                    'name' => 'arrival',
                    'header' => 'By',
                    
                ),
                array(
                    'name' => 'from',
                    'header' => 'From',
                    'value'=>'Arrival::model()->getFrom($data->arrival,$data->surface_location,$data->from)',
                ),
                
                
                array(
                    'name' => 'pnr_no',
                    'header' => 'Others',
                    'type'=>'raw',
                    'value'=>'CHtml::textField("Arrival[others][]",$data->others,array("style"=>"width:150px;"))',
                ),
                                                                              
                array(
                    'name'=>'pnr_no',
                    'type'=>'raw',
                    'header'=>'',
                    'value'=>'CHtml::textField("Arrival[id][]",$data->id,array("style"=>"width:50px;"))',
                    'htmlOptions'=>array("style"=>"display:none"),
                ),
            ),
            'itemsCssClass' => 'responsive table table-striped table-bordered',
                
        ));
        
        echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save');
        
        $this->endWidget();
        ?>
    </div>
</div>
