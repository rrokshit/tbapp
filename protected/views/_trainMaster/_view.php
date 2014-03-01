<?php
/* @var $this TrainMasterController */
/* @var $data TrainMaster */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('train_flight_master')); ?>:</b>
	<?php echo CHtml::encode($data->train_flight_master); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('short_code')); ?>:</b>
	<?php echo CHtml::encode($data->short_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('number')); ?>:</b>
	<?php echo CHtml::encode($data->number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('from')); ?>:</b>
	<?php echo CHtml::encode($data->from); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('to')); ?>:</b>
	<?php echo CHtml::encode($data->to); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('arrival_time')); ?>:</b>
	<?php echo CHtml::encode($data->arrival_time); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('dept_time')); ?>:</b>
	<?php echo CHtml::encode($data->dept_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('choose_branch')); ?>:</b>
	<?php echo CHtml::encode($data->choose_branch); ?>
	<br />

	*/ ?>

</div>