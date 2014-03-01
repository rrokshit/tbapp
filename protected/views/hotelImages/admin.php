<div class="<?php echo $this->message_type; ?>"><?php echo $this->message_content; ?></div>
 <div class="box gradient">
	 <div class="title">
		<h3> 
			<i class="icon-book"></i>
			<span>Hotel Images
				<span class="botton_margin1">
					<a href="<?php echo Yii::app()->createUrl("HotelImages/upload"); ?>" class="btn btn-success">Upload</a>
					<a href="<?php echo Yii::app()->createUrl("HotelMaster/admin"); ?>" class="btn btn-success">Hotels</a>
					<a href="<?php echo Yii::app()->createUrl("HotelContacts/admin", array('id'=>$this->hotel_id)); ?>" class="btn btn-success">Contacts</a>
					<a href="<?php echo Yii::app()->createUrl("HotelTariff/admin", array('id'=>$this->hotel_id)); ?>" class="btn btn-success">Tarrif</a>
					<a href="<?php echo Yii::app()->createUrl("HotelImages/create", array('id'=>$this->hotel_id)); ?>" class="btn btn-success">Create</a>
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
	'id'=>'hotel-images-grid',
	'dataProvider'=>$model->search(),
	'ajaxUpdate'=>false,
	'filter'=>$model,
	'columns'=>array(
		'id',
		array(
			'header'=>'Image',
			'name'=>'url',
			'value'=>'CHtml::image($data->url,"$data->caption",array("height"=>"20","width"=>"50"))',
			'type'=>'raw'
		),
		'caption',
		array(
			'header'=>'Hotel',
			'value'=>'$data->hotelIdFk->name'
		),
		array
			(
			'class' => 'CButtonColumn',
			'template' => '{view}{update}{delete}',
			
			'buttons' => array(
					
						'view' => array(
							'label' => '',
							'imageUrl' => Yii::app()->request->baseUrl . '/images/edit.png',
							'url' => 'Yii::app()->createUrl("/HotelImages/".$data->id)',
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
							'options' => array(
								'title'=>'Delete',
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

<style>
    .button-column{
        width:115px!important;
    }
</style>

