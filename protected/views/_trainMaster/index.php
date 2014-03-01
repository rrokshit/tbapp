<div class="box gradient">
 <div class="title">
            <h3>		
            <i class="icon-book"></i><span>Train Master<span class="botton_mergin3"></span>
		<span class=botton_margin1><a href="<?php echo Yii::app()->request->baseurl?>/index.php/trainMaster/create"><button class="btn btn-success" rel="tooltip" data-placement="right">Create</button></a><span class="botton_mergin3"></span><a href="<?php echo Yii::app()->request->baseurl?>/index.php/busMaster/index"><button class="btn btn-success" rel="tooltip" data-placement="right">List Bus Master</button></a><span class="botton_mergin3"></span><a href="<?php echo Yii::app()->request->baseurl?>/index.php/flightMaster/index"><button class="btn btn-success" rel="tooltip" data-placement="right">List Flight Master</button></a></span></span></span>
            </h3>
          </div>
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
			'name' => 'train_flight_master',
			'htmlOptions' => array("style" => "text-align:center"),
		),
		array
			(
			'name' => 'short_code',
			'htmlOptions' => array("style" => "text-align:center"),
		),
		
		array
			(
			'name' => 'dept_time',
			'htmlOptions' => array("style" => "text-align:center"),
		),
		array
			(
			'name' => 'choose_branch',
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


<!-- End .content -->
</div>
</div>

<style>
    .button-column{
        width:115px!important;
    }
</style>

<?php 
/*$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); 
*/?>

</div>