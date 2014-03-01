<?php
/* @var $this ConversationController */
/* @var $model Conversation */

$this->breadcrumbs=array(
	'Conversations'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Conversation', 'url'=>array('index')),
	array('label'=>'Create Conversation', 'url'=>array('create')),
	array('label'=>'View Conversation', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Conversation', 'url'=>array('admin')),
);
?>

<h1>Update Conversation <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>