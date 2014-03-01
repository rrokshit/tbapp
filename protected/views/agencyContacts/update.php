<?php
/* @var $this AgencymoredetailController */
/* @var $model Agencymoredetail */

$this->breadcrumbs=array(
	'Agencymoredetails'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Agencymoredetail', 'url'=>array('index')),
	array('label'=>'Create Agencymoredetail', 'url'=>array('create')),
	array('label'=>'View Agencymoredetail', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Agencymoredetail', 'url'=>array('admin')),
);
?>



<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>