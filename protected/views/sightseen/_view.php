<?php
/* @var $this SightseenController */
/* @var $data Sightseen */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sight_seeing')); ?>:</b>
	<?php echo CHtml::encode($data->sight_seeing); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('service_date')); ?>:</b>
	<?php echo CHtml::encode($data->service_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('choose_shop')); ?>:</b>
	<?php echo CHtml::encode($data->choose_shop); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vehicle_requrement')); ?>:</b>
	<?php echo CHtml::encode($data->vehicle_requrement); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('choose_vehicle')); ?>:</b>
	<?php echo CHtml::encode($data->choose_vehicle); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('choose_vehicle_category')); ?>:</b>
	<?php echo CHtml::encode($data->choose_vehicle_category); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('vehicle_ac_requrement')); ?>:</b>
	<?php echo CHtml::encode($data->vehicle_ac_requrement); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reporting_place')); ?>:</b>
	<?php echo CHtml::encode($data->reporting_place); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('time')); ?>:</b>
	<?php echo CHtml::encode($data->time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('remark')); ?>:</b>
	<?php echo CHtml::encode($data->remark); ?>
	<br />

	*/ ?>

</div>