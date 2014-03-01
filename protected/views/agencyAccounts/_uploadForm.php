<?php
/* @var $this PlayerController */
/* @var $model Player */
/* @var $form CActiveForm */

Yii::app()->clientScript->registerScript(
   'validatePlayerForm',
   '$("#agency-accounts-upload-form").submit(function(e){
		var validate=true,
			message="<b>Solve all the input errors:</b><br/><br/>",
			email_exp=/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
		$("#validationMessage").html("");
		if($("#flFile").val()==""){
			validate=false;
			message+="Please Select File.<br/>";
		}
		
		
		if(validate)
		{
			return true;
		}	
		else
		{
			$("#validationMessage").show().append(message);
			return false;
		}
		
   });',
   CClientScript::POS_READY
);

?>
<div class="span12">
	<div class="<?php echo $this->message_type; ?>"><?php echo $this->message_content; ?></div>
	<div id="validationMessage" style="display:none;" class="alert"></div>	
	
    <div class="box gradient">
        <div>
			<div class="title">
                <h3>
					<i class="icon-book"></i>
					<span>Agency Accounts Master
						<span class="botton_mergin3"></span>
						<span class="botton_margin1">
							<a href="<?php echo Yii::app()->createUrl("AgencyAccounts/admin"); ?>" class="btn btn-success">Shops</a>
						</span>        
						</span>
				</h3>
            </div>
        </div>
        <div class="content">
		
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'agency-accounts-upload-form',
			'enableAjaxValidation'=>false,
			'enableClientValidation'=>true,
			'htmlOptions'=>array('enctype'=>'multipart/form-data'),
		)); 
		?>


	
	<?php echo $form->errorSummary($model); ?>

	
	<div class="form-row control-group row-fluid">
		<div class="form-horizontal span6">
			<div class="form-row control-group row-fluid fluid">
				<label>Agency Accounts Master File</label>
				<?php echo $form->fileField($model, 'file',array('id'=>'flFile')); ?>
				<span>Select only <b>.xls</b> File</span>
			</div>
		</div>
		<div class="form-horizontal span6">
			<div class="form-row control-group row-fluid fluid">
			</div>
		</div>
	</div>
	
	<div class="form-row control-group row-fluid">
		<div class="form-horizontal span12">
			<div class="form-row control-group row-fluid fluid">
				<?php if(isset($this->importStatus)){?>
					<table style="width:100%;">
						<tr>
							<th>Upload Agency Contacts Master Status</th>
						</tr>	
						<?php foreach($this->importStatus as $status){ ?>
						<tr>
							<td
								<?php
									if($status[1]=="success"){
										echo "style='background:#369236;color:#FFF;border: 1px solid #000;'";
									}
									else if($status[1]=="fail"){ 
										echo "style='background:#FF0000;color:#FFF;border: 1px solid #000;'";
									}
									else if($status[1]=="warning"){ 
										echo "style='background:#F57900;;color:#000;border: 1px solid #000;'";
									}
								?>
								
							>
								<?php echo $status[0]; ?>
								
							</td>
						<tr>
						<?php } ?>
					</table>
				<?php } ?>
			</div>
		</div>
	</div>
	
	<div class="form-row control-group row-fluid">
		<div class="form-horizontal span12">
			<div class="form-row control-group row-fluid fluid">
				<div>
					<p>Please refer below format for the data:<br/></p>
					<p>* Insure that email field value should not be Hyperlink.<br/></p>
					<p>* Date should be in YYYY-MM-DD format.<br/></p>
					<p>* Used Short Code in place for Related Columns.<br/></p>
					<div style="overflow:auto;"><img src="images/excel_snapshots/agency_account.PNG"/></div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="form-actions row-fluid">
		<div class="span7 offset3">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Submit' : 'Save Changes', array('class' => 'btn btn-primary')); ?>
			<button type="reset" class="btn btn-secondary">Cancel</button>
		</div>
	</div>
	<?php $this->endWidget(); ?>
</div><!-- form -->

</div>
