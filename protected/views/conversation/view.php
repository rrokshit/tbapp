<?php
/* @var $this ConversationController */
/* @var $model Conversation */

$this->breadcrumbs=array(
	'Conversations'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Conversation', 'url'=>array('index')),
	array('label'=>'Create Conversation', 'url'=>array('create')),
	array('label'=>'Update Conversation', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Conversation', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Conversation', 'url'=>array('admin')),
);
?>

<h1>View Conversation #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'to',
		'from',
		'date',
		'subject',
		'message',
		'entry_id_fk',
	),
)); ?>
