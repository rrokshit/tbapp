<?php
/* @var $this BranchContactsController */
/* @var $model branchmasterMoredetail */

$this->breadcrumbs=array(
	'Branchmaster Moredetails'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List branchmasterMoredetail', 'url'=>array('index')),
	array('label'=>'Create branchmasterMoredetail', 'url'=>array('create')),
	array('label'=>'View branchmasterMoredetail', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage branchmasterMoredetail', 'url'=>array('admin')),
);
?>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>