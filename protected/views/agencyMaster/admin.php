<div class="<?php echo $this->message_type; ?>"><?php echo $this->message_content; ?></div>
	<div class="box gradient">
		<div class="title">
			<h3>
				<i class="icon-book"></i>
				<span>Agency Master
					<span class="botton_mergin3"></span>
					<span class="botton_margin1">
						<a href="<?php echo Yii::app()->createUrl("AgencyMaster/upload"); ?>" class="btn btn-success">Upload</a> 
						<a href="<?php echo Yii::app()->createUrl("AgencyMaster/create"); ?>" class="btn btn-success">Create</a>
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
	'id'=>'agency-master-grid',
	'dataProvider'=>$model->search(),
	'ajaxUpdate'=>false,
	'filter'=>$model,
	'columns'=>array(
		
		array
			(
			'name' => 'name',
		),
		array
			(
			'name' => 'short_code',
		),		
		array
			(
			'name' => 'phone',
		),
		array
			(
			'name' => 'email_id',
		),
		array
			(// display a column with "view", "update" and "delete" buttons
			'class' => 'CButtonColumn',
			'template' => '{add_contacts}{add_accounts}{view}{update}{delete}',
			'buttons' => array(
				'add_contacts' => array(
					'label' => '',
					'imageUrl' => Yii::app()->request->baseUrl . '/images/add-contacts.png',
					'url' => 'Yii::app()->createUrl("AgencyContacts/create", array("id"=>$data->id))',
					'options' => array(
						'class' =>'iframe show',
						'title'=>'Add Contacts',
					),
				),
				'add_accounts' => array(
					'label' => '',
					'imageUrl' => Yii::app()->request->baseUrl . '/images/add-bank-account.png',
					'url' => 'Yii::app()->createUrl("AgencyAccounts/create", array("id"=>$data->id))',
					'options' => array(
						'class' =>'iframe show',
						'title'=>'Add Accounts',
					),
				),
				'view' => array(
					'label' => '',
					'imageUrl' => Yii::app()->request->baseUrl . '/images/edit.png',
					'url' => 'Yii::app()->createUrl("AgencyMaster/view", array("id"=>$data->id))',
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

     </div>