<div class="<?php echo $this->message_type; ?>"><?php echo $this->message_content; ?></div>
    
	<div class="box gradient">
		<div class="title">
		      <h3>
					<i class=" icon-bar-chart"></i> <span>View Contact Detail 
					<span class="botton_margin1">
						<a href="<?php echo Yii::app()->createUrl("HotelContacts/upload"); ?>" class="btn btn-success">Upload</a>
						<a href="<?php echo Yii::app()->createUrl("HotelMaster/admin"); ?>" class="btn btn-success">Hotels</a>
						<a href="<?php echo Yii::app()->createUrl("HotelTariff/admin", array('id'=>$this->hotel_id)); ?>" class="btn btn-success">Tarrif</a>
						<a href="<?php echo Yii::app()->createUrl("HotelImages/admin", array('id'=>$this->hotel_id)); ?>" class="btn btn-success">Images</a>
						<a href="<?php echo Yii::app()->createUrl("HotelContacts/create", array('id'=>$this->hotel_id)); ?>" class="btn btn-success">Create</a>
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
               <?php $this->widget('application.extensions.fancybox.EFancyBox', array(
                'target'=>'a[rel=gallery]',
                'config'=>array('width'=>'100','height'=>'100'),
                       )
                    );
               ?>

          <?php $this->widget('zii.widgets.grid.CGridView', array(
	     'id'=>'HotelContacts-grid',
	     'dataProvider'=>$model->search(),
	     'filter'=>$model,
	     'columns' => array
		(
			array
			(
				'header'=>'Hotel',
				'value' => '$data->hotelIdFk->name',
			),
			array
				(
				'name' => 'name',
			),
			array
				(
				'name' => 'designation',
			),
			array
				(
				'name' => 'mobile',
			),
			array
				(
				'name' => 'email',
			),
			array
				(// display a column with "view", "update" and "delete" buttons
				'class' => 'CButtonColumn',
				'template' => '{view}{update}{delete}',
				'buttons' => array(
					'view' => array(
						'label' => '',
						'imageUrl' => Yii::app()->request->baseUrl . '/images/edit.png',
						'url' => 'Yii::app()->createUrl("/HotelContacts/".$data->id)',
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


