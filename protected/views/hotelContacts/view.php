<?php
/* @var $this HotelmoreDetailController */
/* @var $model hotelmoreDetail */
$this->layout="travel_view";
$this->breadcrumbs=array(
	'Hotelmore Details'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List hotelmoreDetail', 'url'=>array('index')),
	array('label'=>'Create hotelmoreDetail', 'url'=>array('create')),
	array('label'=>'Update hotelmoreDetail', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete hotelmoreDetail', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage hotelmoreDetail', 'url'=>array('admin')),
);
?>

<h1>View Contact Detail <?php echo $model->name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
	
		array(
			'name'=>'hotel_name',
			'value'=>HotelMaster::model()->getBranchname1($model->hotel_name),
		),
		'designation',
		'name',
		'mobile_no',
		'email_id',
	),
)); ?>
