<?php
/* @var $this LoginController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Logins',
);

$this->menu=array(
	array('label'=>'Create Login', 'url'=>array('create')),
	array('label'=>'Manage Login', 'url'=>array('admin')),
);
?>
<a href="<?php echo Yii::app()->request->baseurl?>/index.php/login/create">
<h1>Logins</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
