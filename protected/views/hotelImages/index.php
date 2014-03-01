<?php
/* @var $this HotelImagesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Hotel Images',
);

$this->menu=array(
	array('label'=>'Create HotelImages', 'url'=>array('create')),
	array('label'=>'Manage HotelImages', 'url'=>array('admin')),
);
?>

<h1>Hotel Images</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
