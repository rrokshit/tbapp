<?php
/* @var $this VehicleMasterController */
/* @var $model VehicleMaster */
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
		<?php echo $form->label($model,'vehicle_name'); ?>
		<?php echo $form->textField($model,'vehicle_name',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'short_code'); ?>
		<?php echo $form->textField($model,'short_code',array('size'=>3,'maxlength'=>3)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'owner_name'); ?>
		<?php echo $form->textField($model,'owner_name',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fathers_husband_name'); ?>
		<?php echo $form->textField($model,'fathers_husband_name',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'address'); ?>
		<?php echo $form->textField($model,'address',array('size'=>40,'maxlength'=>40)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'registration_number'); ?>
		<?php echo $form->textField($model,'registration_number',array('size'=>40,'maxlength'=>40)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'registration_date'); ?>
		<?php echo $form->textField($model,'registration_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'model'); ?>
		<?php echo $form->textField($model,'model',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'engine_number'); ?>
		<?php echo $form->textField($model,'engine_number',array('size'=>40,'maxlength'=>40)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'chesis_number'); ?>
		<?php echo $form->textField($model,'chesis_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'permit_number'); ?>
		<?php echo $form->textField($model,'permit_number',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'permit_validity'); ?>
		<?php echo $form->textField($model,'permit_validity'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'type_vehicle'); ?>
		<?php echo $form->textField($model,'type_vehicle',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vehicle_category'); ?>
		<?php echo $form->textField($model,'vehicle_category',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vehicle_type'); ?>
		<?php echo $form->textField($model,'vehicle_type',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vehicle_number'); ?>
		<?php echo $form->textField($model,'vehicle_number',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'seating_capacity'); ?>
		<?php echo $form->textField($model,'seating_capacity'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'attachment_name'); ?>
		<?php echo $form->textField($model,'attachment_name',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'file_upload'); ?>
		<?php echo $form->textField($model,'file_upload',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'choose_branch'); ?>
		<?php echo $form->textField($model,'choose_branch',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->