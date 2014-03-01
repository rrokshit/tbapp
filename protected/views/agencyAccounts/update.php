<?php
/* @var $this AgencyAccountdetailController */
/* @var $model agencyAccountdetail */

$this->breadcrumbs=array(
	'Agency Accountdetails'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List agencyAccountdetail', 'url'=>array('index')),
	array('label'=>'Create agencyAccountdetail', 'url'=>array('create')),
	array('label'=>'View agencyAccountdetail', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage agencyAccountdetail', 'url'=>array('admin')),
);
?>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>