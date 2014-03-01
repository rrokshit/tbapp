<?php
/* @var $this HotelMasterController */
/* @var $model HotelMaster */

             $this->breadcrumbs=array(
	          'Hotel Masters'=>array('index'),
	          $model->id=>array('view','id'=>$model->id),
	          'Update',
);

$this->menu=array(
	array('label'=>'List HotelMaster', 'url'=>array('index')),
	array('label'=>'Create HotelMaster', 'url'=>array('create')),
	array('label'=>'View HotelMaster', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage HotelMaster', 'url'=>array('admin')),
);
?>


<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>