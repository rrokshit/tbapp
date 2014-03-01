<div class="<?php echo $this->message_type; ?>"><?php echo $this->message_content; ?></div>

	<div class="box gradient">

      <div class="title">
		<h3>
			<i class=" icon-bar-chart"></i> 
			<span>View Vehicle Master
				<span class="botton_mergin3"></span>
				<span class="botton_margin1">
					<span class="botton_mergin3"></span>
					<a href="<?php echo Yii::app()->createUrl("VehicleMaster/upload"); ?>" class="btn btn-success">Upload</a> 
					<a href="<?php echo Yii::app()->createUrl("VehicleMaster/create"); ?>" class="btn btn-success">Create</a>
				</span>
			</span>
            </h3>
            
        </div><!-- End .title -->
     
        <div class="content top">

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
	'id'=>'vehicle-master-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'ajaxUpdate'=>false,
	'columns'=>array(
		array(
			'header'=>'Image',
			'name'=>'image',
			'value'=>'CHtml::image($data->image,"$data->name",array("height"=>"20","width"=>"50"))',
			'type'=>'raw'
		),
		array(
			'name' => 'name',
		),
		array
			(
			'name' => 'registration_number',
		),
		array
			(
			'name' => 'short_code',
		),
		array
			(
			'name' => 'type',
		),
		array
			(
			'name' => 'owner',
		),
		array
			(
			'name' => 'seating_capacity',
		),
		array
			(
			'header' => 'Branch',
			'value' => '$data->branchIdFk->branch_name'
		),
		array
			(
			'header' => 'Category',
			'value' => '$data->categoryIdFk->category'
		),
		array
			(// display a column with "view", "update" and "delete" buttons
			'class' => 'CButtonColumn',
			'template' => '{add_attach}{view}{update}{delete}',
			'buttons' => array(
				'add_attach' => array(
					'label' => '',
					'imageUrl' => Yii::app()->request->baseUrl . '/images/add_attach.png',
					'url' => 'Yii::app()->createUrl("VehicleAttachments/create", array("id"=>$data->id))',
					'options' => array(
						'class' =>'iframe show',
						'title'=>'Add Vehicle Attachments',
					),
				),
				'view' => array(
					'label' => '',
					'imageUrl' => Yii::app()->request->baseUrl . '/images/edit.png',
					'url' => 'Yii::app()->createUrl("VehicleMaster/view", array("id"=>$data->id))',
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
