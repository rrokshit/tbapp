<div class="<?php echo $this->message_type; ?>"><?php echo $this->message_content; ?></div>
<div class="box gradient">
      <div class="title">
          <h3>
             <i class="icon-book"></i><span>Hotel Master
				<span class="botton_margin1">
					<a href="<?php echo Yii::app()->createUrl("HotelMaster/upload"); ?>" class="btn btn-success">Upload</a>  
					<a href="<?php echo Yii::app()->createUrl("HotelMaster/create"); ?>" class="btn btn-success">Create</a>
				</span>	
		  </h3>
      </div><br />
    
       <script>
          $(document).ajaxStop(function()
  		   {
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
         'id' => 'hotel-master-grid',
         'dataProvider' => $model->search(),
         'filter' => $model,
         'columns' => array(
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
					'name' => 'address',
				),
				array
					(
					'name' => 'phone',
				),
				array
					(
					'header'=>'Branch',
					'value' => '$data->branchIdFk->branch_name',
				),
				array
					(
					'name' => 'rating',
				),
				array
					(// display a column with "view", "update" and "delete" buttons
					'class' => 'CButtonColumn',
					'template' => '{add_terrif}{add_images}{add_contacts}{view}{update}{delete}',
					'buttons' => array(
						'add_terrif' => array(
							'label' => '',
							'imageUrl' => Yii::app()->request->baseUrl . '/images/add_terrif.png',
							'url' => 'Yii::app()->createUrl("HotelTariff/create", array("id"=>$data->id))',
							'options' => array(
								'class' =>'iframe show',
								'title'=>'Add Hotel Tarrif',
							),
						),
						'add_images' => array(
							'label' => '',
							'imageUrl' => Yii::app()->request->baseUrl . '/images/add_images.png',
							'url' => 'Yii::app()->createUrl("HotelImages/create", array("id"=>$data->id))',
							'options' => array(
								'class' =>'iframe show',
								'title'=>'Add Hotel Images',
							),
						),						
						'add_contacts' => array(
							'label' => '',
							'imageUrl' => Yii::app()->request->baseUrl . '/images/add-contacts.png',
							'url' => 'Yii::app()->createUrl("HotelContacts/create", array("id"=>$data->id))',
							'options' => array(
								'class' =>'iframe show',
								'title'=>'Add Contacts',
							),
						),
						'view' => array(
							'label' => '',
							'imageUrl' => Yii::app()->request->baseUrl . '/images/edit.png',
							'url' => 'Yii::app()->createUrl("HotelMaster/view", array("id"=>$data->id))',
							'options' => array(
								'class' => 'iframe show',
								'rel' => 'gallery',
								'title' => 'View',
							),
						),
						'update' => array(
							'label' => '',
							'imageUrl' => Yii::app()->request->baseUrl . '/images/view.png',
							'url' => 'Yii::app()->createUrl("update", array("id"=>$data->id))',
							'options' => array(
								'title' => 'Update',
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
            'itemsCssClass' => 'responsive table table-striped table-bordered',
        ));
      ?>
	</div>

  </div>