<?php
/* @var $this FlightMasterController */
/* @var $model FlightMaster */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'flight_name'); ?>
		<?php echo $form->textField($model,'flight_name',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'short_code'); ?>
		<?php echo $form->textField($model,'short_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'flight_number'); ?>
		<?php echo $form->textField($model,'flight_number',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'flight'); ?>
		<?php echo $form->textField($model,'flight',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'form'); ?>
		<?php echo $form->textField($model,'form',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'to'); ?>
		<?php echo $form->textField($model,'to',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'arrival_time'); ?>
		<?php echo $form->textField($model,'arrival_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'departure_time'); ?>
		<?php echo $form->textField($model,'departure_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'choose_branch'); ?>
		<?php echo $form->textField($model,'choose_branch',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->