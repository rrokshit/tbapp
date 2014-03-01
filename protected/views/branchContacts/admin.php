<div class="<?php echo $this->message_type; ?>"><?php echo $this->message_content; ?></div>
<div class="box gradient">
	<div class="title">
		<h3> 
			<i class="icon-book"></i>
			<span>View Branch Contacts
				<span class="botton_mergin3"></span>
				<span class="botton_margin1">
					<a href="<?php echo Yii::app()->createUrl("BranchMaster/admin"); ?>" class="btn btn-success" >Branches</a>
					<a href="<?php echo Yii::app()->createUrl("BranchContacts/upload"); ?>" class="btn btn-success" >Upload</a>
					<a href="<?php echo Yii::app()->createUrl("BranchContacts/create", array("id"=>$this->id)); ?>" class="btn btn-success" >Create</a>
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
	'id'=>'branchmaster-moredetail-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'ajaxUpdate'=>false,
	'columns'=>array(
		array
			(
			'header'=>'Branch Name',
			'name' => 'branch_id_fk',
			'htmlOptions' => array("style" => "text-align:center"),
			'value'=>'$data->branchIdFk->branch_name',
		),
		array(
			'name' => 'name',
		),
		
		array
			(
			'name' => 'residence_number',
		),
		array
			(
			'name' => 'mobile_no',
		),
		array
			(// display a column with "view", "update" and "delete" buttons
			'class' => 'CButtonColumn',
			'template' => '{view}{update}{delete}',
			'buttons' => array(
						'view' => array(
							'label' => '',
							'imageUrl' => Yii::app()->request->baseUrl . '/images/edit.png',
							'url' => 'Yii::app()->createUrl("BranchContacts/view", array("id"=>$data->id))',
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
</div>
</div>
</div>
