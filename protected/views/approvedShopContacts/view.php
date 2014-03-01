<?php
/* @var $this ApprovedMoredetailController */
/* @var $model approvedMoredetail */
$this->layout="travel_view";
$this->breadcrumbs=array(
	'Approved Moredetails'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List approvedMoredetail', 'url'=>array('index')),
	array('label'=>'Create approvedMoredetail', 'url'=>array('create')),
	array('label'=>'Update approvedMoredetail', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete approvedMoredetail', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage approvedMoredetail', 'url'=>array('admin')),
);
?>

<h1>View Shop Master Contact Detail - <?php echo $model->name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		
		
		array(
			'name'=>'shops_name',
			'value'=>approvedMoredetail::model()->getBranchname($model->shops_name),
		),
		'name',
		'mobile_no',
		'email_id',
	),
)); ?>
