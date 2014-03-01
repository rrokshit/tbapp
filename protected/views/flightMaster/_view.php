<?php
/* @var $this FlightMasterController */
/* @var $data FlightMaster */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('flight_name')); ?>:</b>
	<?php echo CHtml::encode($data->flight_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('short_code')); ?>:</b>
	<?php echo CHtml::encode($data->short_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('flight_number')); ?>:</b>
	<?php echo CHtml::encode($data->flight_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('flight')); ?>:</b>
	<?php echo CHtml::encode($data->flight); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('form')); ?>:</b>
	<?php echo CHtml::encode($data->form); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('to')); ?>:</b>
	<?php echo CHtml::encode($data->to); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('arrival_time')); ?>:</b>
	<?php echo CHtml::encode($data->arrival_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('departure_time')); ?>:</b>
	<?php echo CHtml::encode($data->departure_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('choose_branch')); ?>:</b>
	<?php echo CHtml::encode($data->choose_branch); ?>
	<br />

	*/ ?>

</div>