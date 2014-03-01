<?php
/* @var $this SightseenController */
/* @var $model Sightseen */
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
		<?php echo $form->label($model,'sight_seeing'); ?>
		<?php echo $form->textField($model,'sight_seeing',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'service_date'); ?>
		<?php echo $form->textField($model,'service_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'choose_shop'); ?>
		<?php echo $form->textField($model,'choose_shop',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vehicle_requrement'); ?>
		<?php echo $form->textField($model,'vehicle_requrement',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'choose_vehicle'); ?>
		<?php echo $form->textField($model,'choose_vehicle',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'choose_vehicle_category'); ?>
		<?php echo $form->textField($model,'choose_vehicle_category',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vehicle_ac_requrement'); ?>
		<?php echo $form->textField($model,'vehicle_ac_requrement',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'reporting_place'); ?>
		<?php echo $form->textField($model,'reporting_place',array('size'=>40,'maxlength'=>40)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'time'); ?>
		<?php echo $form->textField($model,'time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'remark'); ?>
		<?php echo $form->textField($model,'remark',array('size'=>60,'maxlength'=>70)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->