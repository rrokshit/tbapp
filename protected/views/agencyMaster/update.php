<?php
/* @var $this AgencyMasterController */
/* @var $model AgencyMaster */

$this->breadcrumbs=array(
	'Agency Masters'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List AgencyMaster', 'url'=>array('index')),
	array('label'=>'Create AgencyMaster', 'url'=>array('create')),
	array('label'=>'View AgencyMaster', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage AgencyMaster', 'url'=>array('admin')),
);



?>
<?php echo $this->renderPartial('_form', array('model'=>$model));?>