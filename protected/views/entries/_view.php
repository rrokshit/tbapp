<div class="box gradient">
	<div class="title">
		<h3>
			<i class="icon-book"></i>
			<span>Entries
			<span class="botton_mergin3"></span>
			<span class="botton_margin1">
				<a href="<?php echo Yii::app()->createUrl("entries/create");?>" class="btn btn-success" >Create</a>
				<span class="botton_mergin3"></span>
				<a href="<?php echo Yii::app()->createUrl("entries/admin");?>" class="btn btn-success" >Entries</a>
				<span class="botton_mergin3"></span>
				<a href="<?php echo Yii::app()->createUrl("arrival/admin");?>" class="btn btn-success" >Arrivals</a>
				<span class="botton_mergin3"></span>
				<a href="<?php echo Yii::app()->createUrl("sightseen/admin");?>" class="btn btn-success" >Siteseens</a>
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
	'id'=>'arrival-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns' => array
		(		
		array
			(
			'name' => 'arrival',
			'htmlOptions' => array("style" => "text-align:center"),
		),
		array
			(
			'name' => 'train_flight_no',
			'htmlOptions' => array("style" => "text-align:center"),
		),
		array
			(
			'name' => 'surface_location',
			'htmlOptions' => array("style" => "text-align:center"),
		),
		
		array
			(
			'name' => 'vehicle_required',
			'htmlOptions' => array("style" => "text-align:center"),
		),
		array
			(
			'name' => 'choose_vehicle',
			'htmlOptions' => array("style" => "text-align:center"),
		),
		array
			(
			'name' => 'vehicle_category',
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
					'url' => 'Yii::app()->createUrl("/Arrival/".$data->id)',
					'options' => array(
						'class' =>'iframe show',
						//'id'=>'show',
                        'rel'=>'gallery',
						'title'=>'View',
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
        width:150px!important;
    }
</style>

<?php 
/*$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); 
*/?>

</div>