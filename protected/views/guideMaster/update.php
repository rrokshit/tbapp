<?php
/* @var $this GuideMasterController */
/* @var $model GuideMaster */

$this->breadcrumbs=array(
	'Guide Masters'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List GuideMaster', 'url'=>array('index')),
	array('label'=>'Create GuideMaster', 'url'=>array('create')),
	array('label'=>'View GuideMaster', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage GuideMaster', 'url'=>array('admin')),
);
?>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>