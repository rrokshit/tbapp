<?php
/* @var $this ApprovedMoredetailController */
/* @var $model approvedMoredetail */

$this->breadcrumbs=array(
	'Approved Moredetails'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List approvedMoredetail', 'url'=>array('index')),
	array('label'=>'Create approvedMoredetail', 'url'=>array('create')),
	array('label'=>'View approvedMoredetail', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage approvedMoredetail', 'url'=>array('admin')),
);
?>


<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>