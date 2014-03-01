<?php
/* @var $this ServiceMasterController */
/* @var $data ServiceMaster */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('service_name')); ?>:</b>
	<?php echo CHtml::encode($data->service_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('short_code')); ?>:</b>
	<?php echo CHtml::encode($data->short_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('choose_branch')); ?>:</b>
	<?php echo CHtml::encode($data->choose_branch); ?>
	<br />


</div>