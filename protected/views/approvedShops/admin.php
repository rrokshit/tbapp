<div class="<?php echo $this->message_type; ?>"><?php echo $this->message_content; ?></div>
<div class="box gradient">
    <div class="title">
        <h3>
            <i class="icon-book"></i>
			<span>Approved Shops Master
				<span class="botton_mergin3"></span>
				<span class="botton_margin1">
					<a href="<?php echo Yii::app()->createUrl("ApprovedShops/upload"); ?>" class="btn btn-success">Upload</a> 
					<a href="<?php echo Yii::app()->createUrl("ApprovedShops/create"); ?>" class="btn btn-success">Create</a>          
				</span>        
				</span>
        </h3>
    </div>
<script>
	$(document).ajaxStop(function() {
		<?php
			$this->widget('application.extensions.fancybox.EFancyBox', array(
				'target' => 'a[rel=gallery]',
				'config' => array('width' => '200', 'height' => '200'),
					)
			);
		?>
	});
</script>
<?php
	$this->widget('application.extensions.fancybox.EFancyBox', array(
		'target' => 'a[rel=gallery]',
		'config' => array('width' => '100', 'height' => '100'),
		));
?>

    <?php
    $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'approved-master-grid',
        'dataProvider' => $model->search(),
        'ajaxUpdate' => false,
        'filter' => $model,
        'columns' => array(
            array
                (
                'name' => 'shops_name',
            ),
            array
                (
                'name' => 'address',
            ),
            array
                (
                'name' => 'phone_r',
            ),
            array
                (
                'name' => 'mobile_no',
            ),
			array
                (
				'class' => 'CButtonColumn',
                'template' => '{add_contacts}{view}{update}{delete}',
                'buttons' => array(
					'add_contacts' => array(
						'label' => '',
						'imageUrl' => Yii::app()->request->baseUrl . '/images/add-contacts.png',
						'url' => 'Yii::app()->createUrl("ApprovedShopContacts/create", array("id"=>$data->id))',
						'options' => array(
							'class' =>'iframe show',
							'title'=>'Add Contacts',
						),
					),
                    'view' => array(
                        'label' => '',
                        'imageUrl' => Yii::app()->request->baseUrl . '/images/edit.png',
                        'url' => 'Yii::app()->createUrl("ApprovedShops/view", array("id"=>$data->id))',
                        'options' => array(
                            'class' => 'iframe show',
                            'rel' => 'gallery',
                            'title' => 'View',
                        ),
                    ),
                    'update' => array(
                        'label' => '',
                        'imageUrl' => Yii::app()->request->baseUrl . '/images/view.png',
                        'options' => array(
                            'title' => 'Edit',
                        ),
                    ),
                    'delete' => array(
                        'label' => '',
                        'imageUrl' => Yii::app()->request->baseUrl . '/images/delete.png',
                        'options' => array(
                            'title' => 'Delete',
                        ),
                    ),
                ),
                'header' => 'Action',
            ),
        ),
        'itemsCssClass' => 'responsive table table-striped table-bordered',
    ));
    ?>
</div>
</div>

</div>