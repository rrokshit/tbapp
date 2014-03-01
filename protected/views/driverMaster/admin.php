<div class="<?php echo $this->message_type; ?>"><?php echo $this->message_content; ?></div>
<div class="box gradient">
	<div class="title">
		<h3>
			<i class="icon-book"></i>
			<span>Driver Master
				<span class="botton_mergin"></span>
				<span class="botton_margin1">
					<a href="<?php echo Yii::app()->createUrl("DriverMaster/upload"); ?>" class="btn btn-success">Upload</a>
					<a href="<?php echo Yii::app()->createUrl("DriverMaster/create"); ?>" class="btn btn-success">Create</a>
				</span>
			</span>
		</h3>
	</div>
<script>
$(document).ajaxStop(function() {
    <?php
    $this->widget('application.extensions.fancybox.EFancyBox', array(
                'target'=>'a[rel=gallery]',
                'config'=>array('width'=>'200','height'=>'200'),
                )
            );
    ?>
});
</script>
<?php

$this->widget('application.extensions.fancybox.EFancyBox', array(
                'target'=>'a[rel=gallery]',
                'config'=>array('width'=>'100','height'=>'100'),
                )
            );
?> 

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'driver-master-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'ajaxUpdate'=>false,
	'columns'=>array(
			
		array
			(
			'name' => 'name',
		),
		array(
			'header'=>'Photo',
			'name'=>'photo',
			'value'=>'CHtml::image($data->photo,"$data->name",array("height"=>"50","width"=>"20"))',
			'type'=>'raw'
		),
		array
			(
			'name' => 'license_number',
		),
		array
			(
			'name' => 'issue_date',
			'value'=>'date("Y-m-d", strtotime($data->issue_date))',
		),
		array
			(
			'name' => 'expiry_date',
			'value'=>'date("Y-m-d",strtotime($data->expiry_date))',
		),
		array
			(
			'name' => 'licence_authority',
		),
		array
			(
			'header' => 'Branch',
			'value'=>'$data->branchIdFk->branch_name',
		),
		array
			(
			'class' => 'CButtonColumn',
			'template' => '{view}{update}{delete}',
			'buttons' => array(
			
				'view' => array(
					'label' => '',
					'imageUrl' => Yii::app()->request->baseUrl . '/images/edit.png',
					'url' => 'Yii::app()->createUrl("DriverMaster/view", array("id"=>$data->id))',
					'options' => array(
						'class' =>'iframe show',
                        'rel'=>'gallery',
						'title'=>'View',
					),
				),
				'update' => array(
					'label' => '',
					'imageUrl' => Yii::app()->request->baseUrl . '/images/view.png',
					'options' => array(
						'title'=>'Update',
						
					),
				),
				'delete' => array(
                        'label' => '',
                        'imageUrl' => Yii::app()->request->baseUrl . '/images/delete.png',
                        'url' => 'Yii::app()->controller->createUrl("delete",array("id"=>$data->id))',
						'options' => array(
						    'title' => 'Delete',
                        	'confirm' => 'Are you sure wants to delete this item ?',
							'class' => 'grid_action_set1',
							'ajax' => array(
										'type' => 'POST',
										'url' => "js:$(this).attr('href')", 
										'success' => 'function(data){
											if(data.indexOf("http")>-1){
												window.location.href=data;
											}
											else{
												alert(data);
											}
										}',
									),
								),
                    ),
				
			),
			'header' => 'Action',
			
			
		),
	),
	'itemsCssClass'=>'responsive table table-striped table-bordered',
));
?>
</div>
</div>
</div>