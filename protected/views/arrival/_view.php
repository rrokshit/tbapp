<?php
/* @var $this ArrivalController */
/* @var $data Arrival */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('arrival')); ?>:</b>
	<?php echo CHtml::encode($data->arrival); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('train_flight_no')); ?>:</b>
	<?php echo CHtml::encode($data->train_flight_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('surface_location')); ?>:</b>
	<?php echo CHtml::encode($data->surface_location); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('from')); ?>:</b>
	<?php echo CHtml::encode($data->from); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('at')); ?>:</b>
	<?php echo CHtml::encode($data->at); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vehicle_required')); ?>:</b>
	<?php echo CHtml::encode($data->vehicle_required); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('choose_vehicle')); ?>:</b>
	<?php echo CHtml::encode($data->choose_vehicle); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vehicle_category')); ?>:</b>
	<?php echo CHtml::encode($data->vehicle_category); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vehicle_ac_requrement')); ?>:</b>
	<?php echo CHtml::encode($data->vehicle_ac_requrement); ?>
	<br />

	*/ ?>

</div>