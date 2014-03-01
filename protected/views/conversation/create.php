<?php
/* @var $this ConversationController */
/* @var $model Conversation */

$this->breadcrumbs=array(
	'Conversations'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Conversation', 'url'=>array('index')),
	array('label'=>'Manage Conversation', 'url'=>array('admin')),
);
?>

<h1>Create Conversation</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>