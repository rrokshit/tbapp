<?php
/* @var $this ServiceMasterController */
/* @var $model ServiceMaster */

$this->breadcrumbs=array(
	'Service Masters'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ServiceMaster', 'url'=>array('index')),
	array('label'=>'Create ServiceMaster', 'url'=>array('create')),
	array('label'=>'View ServiceMaster', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ServiceMaster', 'url'=>array('admin')),
);
?>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>