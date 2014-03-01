 <div class="box gradient">
<div class="title">

            <h3>
				<i class="icon-book"></i>
				<span>Agency Master<span class="botton_mergin3"></span>
				<span class="botton_margin1">
					<a href="<?php echo Yii::app()->createUrl("AgencyMaster/create");?>">create</a>
					<span class="botton_mergin3"></span>
					<a href="<?php echo Yii::app()->createUrl("AgencyContacts/admin", array("id"=>$this->id));?>" class="btn btn-success">Agency Accounts</a>
					<span class="botton_mergin3"></span>
					<a href="<?php echo Yii::app()->createUrl("AgencyContacts/admin", array("id"=>$this->id))?>" class="btn btn-success" >Agency Contacts</a>
					</span>
				</span></span>
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
			'name' => 'agency_name',
			'htmlOptions' => array("style" => "text-align:center"),
		),
		array
			(
			'name' => 'short_code',
			'htmlOptions' => array("style" => "text-align:center"),
		),
		array
			(
			'name' => 'address',
			'htmlOptions' => array("style" => "text-align:center"),
		),
		
		array
			(
			'name' => 'phone_no',
			'htmlOptions' => array("style" => "text-align:center"),
		),
		
		
		array
			(
			'name' => 'mobile_no',
			'htmlOptions' => array("style" => "text-align:center"),
		),
		array
			(
			'name' => 'email_id',
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
					
						//'class' =>'gicon-eye-open btn btn-small  ',
						'style' => 'margin-right:6px;',
						
					),
				),
				'update' => array(
					'label' => '',
					'imageUrl' => Yii::app()->request->baseUrl . '/images/view.png',
					//'url' => 'Yii::app()->createUrl("view", array("id"=>$data->id))',
					'options' => array(
						//'class' =>'gicon-eye-open btn btn-small fancybox fancybox.iframe',
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