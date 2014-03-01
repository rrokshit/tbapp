<div class="<?php echo $this->message_type; ?>"><?php echo $this->message_content; ?></div>
 <div class="box gradient">
 <div class="title">
	<h3> 
		<i class="icon-book"></i>
		<span>View Shop Master Contact Details
			<span class="botton_mergin3"></span>
			<span class="botton_margin1">
			    <a href="<?php echo Yii::app()->createUrl("ApprovedShopContacts/upload"); ?>" class="btn btn-success">Upload</a>
				<a href="<?php echo Yii::app()->createUrl("ApprovedShopContacts/create",array("id"=>$this->id));?>" class="btn btn-success">Create</a>
				<a href="<?php echo Yii::app()->createUrl("ApprovedShops/admin"); ?>" class="btn btn-success">Approved Shops</a>
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
	'id'=>'approved-moredetail-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'ajaxUpdate'=>false,
	'columns'=>array(
		array
			(
			'header' => 'Approved Shop',
			'value'=>'$data->aproovedShopIdFk->shops_name',
		),
		array
			(
			'name' => 'name',
		),
		array
			(
			'name' => 'mobile_no',
		),
		array
			(
			'name' => 'email_id',
		),
		
		array
			(
			'class' => 'CButtonColumn',
			'template' => '{view}{update}{delete}',
			
			'buttons' => array(
					
						'view' => array(
							'label' => '',
							'imageUrl' => Yii::app()->request->baseUrl . '/images/edit.png',
							'url' => 'Yii::app()->createUrl("/approvedMoredetail/".$data->id)',
							'options' => array(
								'class' =>'iframe show',
								'title'=>'View',
								'rel'=>'gallery',
								
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