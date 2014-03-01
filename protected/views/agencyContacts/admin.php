<div class="<?php echo $this->message_type; ?>"><?php echo $this->message_content; ?></div>
   <div class="box gradient">
       <div class="title">
            <h3> <i class="icon-book"></i><span>View Contact <span class="botton_mergin3"></span>
				<span class="botton_margin1">
					<a href="<?php echo Yii::app()->createUrl("AgencyContacts/upload"); ?>" class="btn btn-success">Upload</a>
					<a href="<?php echo Yii::app()->createUrl("AgencyContacts/create", array("id"=>$this->id)); ?>" class="btn btn-success">Create</a>
					<a href="<?php echo Yii::app()->createUrl("AgencyAccounts/admin", array("id"=>$this->id)); ?>" class="btn btn-success">Agency Accounts</a>
					<a href="<?php echo Yii::app()->createUrl("AgencyMaster/admin"); ?>" class="btn btn-success">Agency</a>
				</span></span></span>
             </h3>
          </div>
		  
      <script>
       $(document).ajaxStop(function() {
         <?php
         $this->widget('application.extensions.fancybox.EFancyBox', array
		 (
                'target'=>'a[rel=gallery]',
                'config'=>array('width'=>'200','height'=>'200'),
				));
              ?>
           });
     </script>
             <?php

               $this->widget('application.extensions.fancybox.EFancyBox', array(
                'target'=>'a[rel=gallery]',
                'config'=>array('width'=>'100','height'=>'100'),
                ));
            ?>	 

   <?php $this->widget('zii.widgets.grid.CGridView', array(
    	 'id'=>'agencymoredetail-grid',
	     'dataProvider'=>$model->search(),
	     'filter'=>$model,
	     'ajaxUpdate'=>false,
	     'columns' => array
		 (
			array(
				'header' => 'Agency Name',					
				'value'=>'$data->agencyContactIdFk->name',
			),
			array(
				'name' => 'name',
			),
			array(
				'name' => 'mobile',
			),
			array(
				'name' => 'designation',
			),
			array
				(// display a column with "view", "update" and "delete" buttons
				'class' => 'CButtonColumn',
				'template' => '{view}{update}{delete}',
				
				  'buttons' => array(
					
						'view' => array(
							'label' => '',
							'imageUrl' => Yii::app()->request->baseUrl . '/images/edit.png',
							 'url' => 'Yii::app()->createUrl("/AgencyContacts/".$data->id)',
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