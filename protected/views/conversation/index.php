<?php
/* @var $this ConversationController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Conversations',
);

$this->menu=array(
	array('label'=>'Create Conversation', 'url'=>array('create')),
	array('label'=>'Manage Conversation', 'url'=>array('admin')),
);
?>

<h1>Conversations</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
