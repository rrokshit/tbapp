<div class="box gradient">

      <div class="title">
				  <h3>
			 <i class="icon-bar-chart"></i><span> Hotel Tariff<span class="botton_mergin3"></span>
			<span class=botton_margin1><a href="<?php echo Yii::app()->request->baseurl?>/index.php/HotelMaster/create"><button class="btn btn-success" rel="tooltip" data-placement="right">create</button></a><span class="botton_mergin3"></span><a href="<?php echo Yii::app()->request->baseurl?>/index.php/hotelMaster/index"><button class="btn btn-success" rel="tooltip" data-placement="right">List Hotel Master</button></a><span class="botton_mergin3"></span><a href="<?php echo Yii::app()->request->baseurl?>/index.php/hotelmoreDetail/index"><button class="btn btn-success" rel="tooltip" data-placement="right">List hotel Conatact</button></a><span class="botton_mergin3"></span><a href="<?php echo Yii::app()->request->baseurl?>/index.php/hotelInfo/index"><button class="btn btn-success" rel="tooltip" data-placement="right">List Hotel Information</button></a></span></span></span></span>
            </h3>	       
        </div><!-- End .title -->
     
        <div class="content top">
		<?php
	
$this->widget('zii.widgets.grid.CGridView', array
	(
	'dataProvider' => $dataProvider,
	'summaryText' => '',
	
	'emptyText' => 'There is no Branch Information in your database',
	'columns' => array
		(
		
		array
			(
			'name' => 'hotel_name',
			'htmlOptions' => array("style" => "text-align:center"),
			'value'=>'HotelTariff::model()->getBranchname($data->hotel_name)',
		),
		
		array
			(
			'name' => 'room_category',
			'htmlOptions' => array("style" => "text-align:center"),
		),
		array
			(
			'name' => 'room_type',
			'htmlOptions' => array("style" => "text-align:center"),
		),
		
		array
			(
			'name' => 's_cpai',
			'htmlOptions' => array("style" => "text-align:center"),
		),
		
		array
			(
			'name' => 's_mapi',
			'htmlOptions' => array("style" => "text-align:center"),
		),
		array
			(
			'name' => 's_apai',
			'htmlOptions' => array("style" => "text-align:center"),
		),
		array
			(// display a column with "view", "update" and "delete" buttons
			'class' => 'CButtonColumn',
			
			'template' => '{view}{update}{delete}',
			'buttons' => array(
			
				'view' => array(
					'label' => '',
					'imageUrl' => Yii::app()->request->baseUrl . '/images/edit.png',
					//'url' => 'Yii::app()->createUrl("view", array("id"=>$data->id))',
					'options' => array(
						//'class' =>'gicon-eye-open btn btn-small',
						'style' => 'margin-right:6px;',
						
					),
				),
				'update' => array(
					'label' => '',
					'imageUrl' => Yii::app()->request->baseUrl . '/images/view.png',
					//'url' => 'Yii::app()->createUrl("view", array("id"=>$data->id))',
					'options' => array(
						//'class' =>'gicon-eye-open btn btn-small',
						'style' => 'margin-right:6px;',
						
					),
				),
				'delete' => array(
					'label' => '',
					'imageUrl' => Yii::app()->request->baseUrl . '/images/delete.png',
					//'url' => 'Yii::app()->createUrl("view", array("id"=>$data->id))',
					'options' => array(
						//'class' =>'gicon-eye-open btn btn-small',
						'style' => 'margin-right:6px;',
						
					),
				),
				
			),
			'header' => 'Action',
			
			
		),
	),
	'itemsCssClass'=>'responsive table table-striped table-bordered',
	//'htmlOptions'=>array('class'=>'responsive table table-striped table-bordered'),
));
?>

<?php ///echo CHtml::button('Button Text', array('submit' => array('controller/action'))); ?>
<!-- End .content -->
</div>
</div>

<style>
    .button-column{
        width:115px!important;
    }
</style>


<?php //$this->widget('zii.widgets.CListView', array(
	//'dataProvider'=>$dataProvider,
	//'itemView'=>'_view',
//)); ?>
